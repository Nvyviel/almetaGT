<?php

namespace App\Livewire;

use App\Models\Consignee;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ConsigneeManagement extends Component
{
    use WithFileUploads;

    public $industry;
    public $name_consignee;
    public $email;
    public $city;
    public $phone_number;
    public $consignee_address;
    public $ktp;
    public $npwp;

    protected $cities = [
        'Surabaya',
        'Pontianak',
        'Semarang',
        'Banjarmasin',
        'Sampit',
        'Jakarta',
        'Kumai',
        'Samarinda',
        'Balikpapan',
        'Berau',
        'Palu',
        'Bitung',
        'Gorontalo',
        'Ambon',
        'Makassar',
        'Morowali',
        'Kendari',
        'Pomala',
        'Ternate',
        'Jayapura',
        'Kupang',
        'Sorong',
        'Manokwari',
        'Merauke',
        'Bau-Bau',
        'Maumere',
        'Tual',
        'Fak-Fak',
        'Bintuni',
        'Nabire',
        'Serui'
    ];

    // Aturan validasi
    protected function rules()
    {
        return [
            'industry' => 'required|string',
            'name_consignee' => 'required|string',
            'email' => 'required|email|unique:consignees,consignee_email',
            'city' => 'required|string|in:' . implode(',', $this->cities),
            'phone_number' => 'required|numeric',
            'consignee_address' => 'required|string',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'npwp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ];
    }

    // Custom validation messages
    protected function messages()
    {
        return [
            'industry.required' => 'Industri wajib diisi.',
            'name_consignee.required' => 'Nama consignee wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'city.required' => 'Kota wajib dipilih.',
            'city.in' => 'Kota yang dipilih tidak valid.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
            'consignee_address.required' => 'Alamat consignee wajib diisi.',
            'ktp.required' => 'File KTP wajib diunggah.',
            'ktp.file' => 'File KTP tidak valid.',
            'ktp.mimes' => 'File KTP harus berformat JPG, JPEG, PNG, atau PDF.',
            'ktp.max' => 'Ukuran file KTP maksimal 2MB.',
            'npwp.required' => 'File NPWP wajib diunggah.',
            'npwp.file' => 'File NPWP tidak valid.',
            'npwp.mimes' => 'File NPWP harus berformat JPG, JPEG, PNG, atau PDF.',
            'npwp.max' => 'Ukuran file NPWP maksimal 2MB.',
        ];
    }

    public function store()
    {
        Log::info('ConsigneeManagement store function called.');

        try {
            Log::info('Starting validation.');
            Log::info('Form data:', [
                'industry' => $this->industry,
                'name_consignee' => $this->name_consignee,
                'email' => $this->email,
                'city' => $this->city,
                'phone_number' => $this->phone_number,
                'consignee_address' => $this->consignee_address,
                'ktp' => $this->ktp ? 'File uploaded' : 'No file',
                'npwp' => $this->npwp ? 'File uploaded' : 'No file'
            ]);
            Log::info('Valid cities:', $this->cities);

            $this->validate();

            // Validasi tambahan untuk memastikan file ada
            if (!$this->ktp || !$this->npwp) {
                Log::error('One or more required files are missing.');
                session()->flash('error', 'Semua file (KTP, NPWP) wajib diunggah.');
                return;
            }

            $consigneeId = $this->generateConsigneeId();

            // Store documents under the generated legacy consignee ID.
            Log::info('Uploading files...');
            try {
                $ktpPath = $this->ktp->storeAs("consignee/{$consigneeId}", 'ktp.' . $this->ktp->getClientOriginalExtension(), 'public');
                $npwpPath = $this->npwp->storeAs("consignee/{$consigneeId}", 'npwp.' . $this->npwp->getClientOriginalExtension(), 'public');

                Log::info('All files uploaded successfully');
                Log::info('KTP Path: ' . $ktpPath);
                Log::info('NPWP Path: ' . $npwpPath);
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                session()->flash('error', 'Gagal mengunggah file. Silakan coba lagi.');
                return;
            }

            Log::info('Creating consignee...');

            $consignee = Consignee::create([
                'user_id' => Auth::id(),
                'consignee_id' => $consigneeId,
                'industry' => $this->industry,
                'city' => $this->city,
                'consignee_name' => $this->name_consignee,
                'consignee_email' => $this->email,
                'consignee_phone' => $this->phone_number,
                'consignee_address' => $this->consignee_address,
            ]);

            Log::info('Consignee created with ID: ' . $consignee->id);

            // Reset form
            $this->reset([
                'industry',
                'name_consignee',
                'email',
                'city',
                'phone_number',
                'consignee_address',
                'ktp',
                'npwp'
            ]);

            session()->flash('message', 'Data Consignee berhasil ditambahkan.');
            Log::info('Redirecting to consignee route.');

            return redirect()->route('consignee');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error in ConsigneeManagement store function: ' . $e->getMessage());
            session()->flash('error', 'Data Consignee gagal disimpan. Periksa kembali data dan format file KTP/NPWP.');
        }
    }

    protected function generateConsigneeId(): string
    {
        do {
            $consigneeId = 'CG' . strtoupper(Str::random(8));
        } while (Consignee::where('consignee_id', $consigneeId)->exists());

        return $consigneeId;
    }

    public function getCitiesProperty()
    {
        return $this->cities;
    }

    public function render()
    {
        return view('livewire.consignee-management', [
            'availableCities' => $this->cities
        ]);
    }
}
