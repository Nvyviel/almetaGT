<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FeedbackData extends Component
{
    public $name = '';
    public $email = '';
    public $type = 'general';
    public $message = '';

    public $showSuccess = false;
    public $submittedFeedbackId = '';
    public $isSubmitting = false;

    protected $rules = [
        'name' => 'required|string|min:3|max:100',
        'email' => 'required|email|max:150',
        'type' => 'required|in:bug,feature,general',
        'message' => 'required|string|min:10|max:3000',
    ];

    protected $messages = [
        'name.required' => 'Name required.',
        'name.min' => 'Minimum 3 characters.',
        'email.required' => 'Email required.',
        'email.email' => 'Email format is invalid.',
        'type.required' => 'Feedback type is required.',
        'type.in' => 'Feedback type is invalid.',
        'message.required' => 'Message required.',
        'message.min' => 'Message must be at least 10 characters.',
        'message.max' => 'Message may not be greater than 3,000 characters.',
    ];

    public function mount()
    {
        // Automatically fill name and email if user is authenticated
        if (Auth::check()) {
            if (Auth::user()->name) {
                $this->name = Auth::user()->name;
            }
            if (Auth::user()->email) {
                $this->email = Auth::user()->email;
            }
        }
    }

    // Computed property untuk character count
    public function getMessageLengthProperty()
    {
        return strlen($this->message);
    }

    public function submit()
    {
        $this->isSubmitting = true;
        $this->validate();

        try {
            DB::beginTransaction();

            $feedback = Feedback::create([
                'feedback_id' => $this->generateFeedbackId(),
                'name' => $this->name,
                'email' => $this->email,
                'type' => $this->type,
                'message' => $this->message,
            ]);

            DB::commit();

            // Set success data
            $this->submittedFeedbackId = $feedback->feedback_id;
            
            // Flash message untuk feedback
            session()->flash('success', 'Feedback submitted successfully! ID: ' . $this->submittedFeedbackId);

            // Determine redirect URL based on authentication status
            $redirectUrl = $this->getRedirectUrl();
            
            // Redirect with success message
            return redirect()->to($redirectUrl)->with('feedback_success', 'Thank you for your feedback! ID: ' . $this->submittedFeedbackId);

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', 'An error occurred while submitting feedback. Please try again.');

            Log::error('Feedback submission error: ' . $e->getMessage(), [
                'user_data' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'type' => $this->type
                ]
            ]);
        } finally {
            $this->isSubmitting = false;
        }
    }

    private function generateFeedbackId(): string
    {
        $maxAttempts = 10;
        $attempt = 0;

        do {
            $attempt++;

            $datePrefix = now()->format('Ymd');
            $randomSuffix = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);

            $feedbackId = $datePrefix . $randomSuffix;

            $exists = Feedback::where('feedback_id', $feedbackId)->exists();

            if (!$exists) {
                return $feedbackId;
            }

            if ($attempt >= $maxAttempts) {
                $fallbackId = $datePrefix . str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT);
                return $fallbackId;
            }
        } while ($exists && $attempt < $maxAttempts);

        return $feedbackId;
    }

    public function resetForm()
    {
        // Reset semua field ke nilai default
        $this->name = '';
        $this->email = '';
        $this->type = 'general';
        $this->message = '';
        
        // Reset validation errors
        $this->resetValidation();
        
        // Force refresh untuk memastikan form benar-benar ter-reset
        $this->dispatch('form-reset');
    }

    public function closeSuccess()
    {
        $this->showSuccess = false;
        $this->submittedFeedbackId = '';
    }

    // Method untuk auto-hide success message
    public function hideSuccessMessage()
    {
        $this->showSuccess = false;
        $this->submittedFeedbackId = '';
    }

    // Method untuk manual reset (jika diperlukan)
    public function manualReset()
    {
        $this->resetForm();
        $this->showSuccess = false;
        $this->submittedFeedbackId = '';
    }

    private function getRedirectUrl(): string
    {
        if (Auth::check()) {
            // Jika user sudah login, kembali ke halaman sebelumnya atau dashboard
            $returnUrl = session('feedback_return_url', route('dashboard'));
            
            // Clear the session data
            session()->forget('feedback_return_url');
            
            return $returnUrl;
        } else {
            // Jika user belum login, kembali ke landing page
            return route('landing-page');
        }
    }

    public function render()
    {
        return view('livewire.feedback-data');
    }
}