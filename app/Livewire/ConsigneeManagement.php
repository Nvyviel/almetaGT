<?php

namespace App\Livewire;

use App\Models\Consignee;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

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
        'surabaya',
        'pontianak',
        'semarang',
        'banjarmasin',
        'sampit',
        'jakarta',
        'kumai',
        'samarinda',
        'balikpapan',
        'berau',
        'palu',
        'bitung',
        'gorontalo',
        'ambon'
    ];

    // Aturan validasi
    protected function rules()
    {
        return [
            'industry' => 'required|string',
            'name_consignee' => 'required|string',
            'email' => 'required|email|unique:consignees,email',
            'city' => 'required|string|in:' . implode(',', $this->cities),
            'phone_number' => 'required|numeric',
            'consignee_address' => 'required|string',
            'ktp' => 'required|image|max:2048',
            'npwp' => 'required|image|max:2048'
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
            'ktp.image' => 'File KTP harus berupa gambar.',
            'ktp.max' => 'Ukuran file KTP maksimal 2MB.',
            'npwp.required' => 'File NPWP wajib diunggah.',
            'npwp.image' => 'File NPWP harus berupa gambar.',
            'npwp.max' => 'Ukuran file NPWP maksimal 2MB.',
        ];
    }

    public function store()
    {
        Log::info('ConsigneeManagement store function called.');

        try {
            Log::info('Starting validation.');

            $this->validate();

            // Validasi tambahan untuk memastikan file ada
            if (!$this->ktp || !$this->npwp) {
                Log::error('One or more required files are missing.');
                session()->flash('error', 'Semua file (KTP, NPWP) wajib diunggah.');
                return;
            }

            // Upload files
            Log::info('Uploading files...');
            try {
                $ktpPath = $this->ktp->store('consignee/ktp', 'public');
                $npwpPath = $this->npwp->store('consignee/npwp', 'public');

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
                'user_id' => auth()->id(),
                'industry' => $this->industry,
                'name_consignee' => $this->name_consignee,
                'email' => $this->email,
                'city' => $this->city,
                'phone_number' => $this->phone_number,
                'consignee_address' => $this->consignee_address,
                'ktp' => $ktpPath,
                'npwp' => $npwpPath,
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
            // Livewire akan otomatis menampilkan error validasi
        } catch (\Exception $e) {
            Log::error('Error in ConsigneeManagement store function: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.consignee-management');
    }
}
