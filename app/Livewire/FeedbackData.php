<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            $this->showSuccess = true;
            
            // Reset form setelah berhasil
            $this->resetForm();

            // Flash message untuk backup
            session()->flash('success', 'Feedback submitted successfully! ID: ' . $this->submittedFeedbackId);

            // Auto-hide success message setelah 5 detik
            $this->dispatch('auto-hide-success');

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

    public function render()
    {
        return view('livewire.feedback-data');
    }
}