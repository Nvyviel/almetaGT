@extends('layouts.fullscreen')

@section('title', 'Payment Confirmation')

@section('component')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Back Button --}}
        <div class="mb-4">
            <a href="{{ route('detail-bill', $bill->bill_id) }}" class="inline-flex items-center text-sm text-blue-800 hover:text-blue-600 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Bill Detail
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            {{-- Header with Progress --}}
            <div class="bg-blue-800 px-5 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">Payment Confirmation</h1>
                            <p class="text-blue-100 text-sm">Submit payment proof for Bill {{ $bill->bill_id }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-blue-100 text-xs mb-1">Step 2 of 3</div>
                        <div class="flex space-x-1">
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            <div class="w-3 h-3 rounded-full bg-white"></div>
                            <div class="w-3 h-3 rounded-full bg-white bg-opacity-50"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bill Summary --}}
            <div class="px-5 py-3 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-gray-600">Bill ID:</span>
                        <span class="font-semibold text-gray-900 ml-2">{{ $bill->bill_id }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                        <span class="text-gray-600">Amount:</span>
                        <span class="font-bold text-green-600 ml-2">Rp {{ number_format($bill->grand_total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-600">Status:</span>
                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium
                            @if ($bill->status === 'Unpaid') bg-red-600 text-white
                            @elseif($bill->status === 'Under Verification') bg-yellow-500 text-black
                            @else bg-green-600 text-white @endif ml-2">
                            {{ $bill->status }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Payment Form --}}
            <form action="{{ route('bills.confirm-payment', $bill->bill_id) }}" method="POST" enctype="multipart/form-data" class="px-5 py-5">
                @csrf
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-5 bg-red-50 border border-red-600 p-4 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please correct the errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-5">
                    <!-- Payment Date -->
                    <div>
                        <label for="paid_at" class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 inline text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Payment Date
                        </label>
                        <input type="date" 
                               id="paid_at" 
                               name="paid_at" 
                               value="{{ old('paid_at') }}"
                               max="{{ date('Y-m-d') }}"
                               class="block w-full px-3 py-2 border @error('paid_at') border-red-600 @else border-gray-300 @enderror rounded focus:outline-none focus:ring-2 focus:ring-blue-800 focus:border-blue-800">
                        @error('paid_at')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 inline text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Payment Proof (Image/PDF)
                        </label>
                        <div class="mt-1 flex justify-center px-5 pt-4 pb-4 border-2 @error('upload_confirmation') border-red-600 @else border-gray-300 @enderror border-dashed rounded hover:border-blue-800">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="upload_confirmation" class="relative cursor-pointer bg-white rounded font-medium text-blue-800 hover:text-blue-600">
                                        <span>Upload a file</span>
                                        <input id="upload_confirmation" 
                                               name="upload_confirmation" 
                                               type="file" 
                                               accept=".jpg,.jpeg,.png,.pdf" 
                                               required
                                               class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, PDF up to 5MB
                                </p>
                            </div>
                        </div>
                        @error('upload_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- File Status Indicator -->
                        <div id="file-status" class="mt-2 text-sm text-gray-600 hidden">
                            <span class="inline-flex items-center">
                                <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                File selected and ready to upload
                            </span>
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="bg-blue-50 border border-blue-800 rounded-lg p-3">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Important Notes</h3>
                                <ul class="mt-2 text-sm text-blue-700 list-disc list-inside space-y-1">
                                    <li>Upload clear image or PDF of payment receipt</li>
                                    <li>Amount must match: <strong>Rp {{ number_format($bill->grand_total, 0, ',', '.') }}</strong></li>
                                    <li>File must be less than 5MB (JPG, PNG, or PDF format)</li>
                                    <li>Wait for "File selected" message before submitting</li>
                                    <li>Payment will be verified by our team</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-5 border-t border-gray-200 mt-5">
                    <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                        <a href="{{ route('detail-bill', $bill->bill_id) }}" 
                           class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex justify-center items-center px-5 py-2 border border-transparent rounded text-sm font-medium text-white bg-blue-800 hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Submit Payment Confirmation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('upload_confirmation');
    const dropZone = fileInput.closest('.border-dashed');
    const originalContent = dropZone.innerHTML;
    
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            displaySelectedFile(this.files[0]);
            // Show file status indicator
            document.getElementById('file-status').classList.remove('hidden');
        }
    });
    
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-blue-800', 'bg-blue-50');
    });
    
    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-800', 'bg-blue-50');
    });
    
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-800', 'bg-blue-50');
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            displaySelectedFile(e.dataTransfer.files[0]);
        }
    });
    
    function displaySelectedFile(file) {
        const fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        
        // Create preview without removing the original input
        const preview = document.createElement('div');
        preview.className = 'space-y-2 text-center';
        preview.innerHTML = `
            <svg class="mx-auto h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="text-sm">
                <p class="font-medium text-gray-900">${file.name}</p>
                <p class="text-gray-500">${fileSize}</p>
            </div>
            <button type="button" onclick="resetFileUpload()" class="text-sm text-red-600 hover:text-red-700">
                Remove file
            </button>
        `;
        
        // Hide original content and show preview
        dropZone.innerHTML = '';
        dropZone.appendChild(preview);
        
        // Keep the original input but hidden
        fileInput.style.display = 'none';
        dropZone.appendChild(fileInput);
    }
    
    window.resetFileUpload = function() {
        fileInput.value = '';
        fileInput.style.display = 'block';
        dropZone.innerHTML = originalContent;
        
        // Hide file status indicator
        document.getElementById('file-status').classList.add('hidden');
        
        // Re-attach the input
        const newFileInput = dropZone.querySelector('#upload_confirmation');
        if (newFileInput) {
            newFileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    displaySelectedFile(this.files[0]);
                    // Show file status indicator
                    document.getElementById('file-status').classList.remove('hidden');
                }
            });
        }
    };
    
    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const fileInputValue = document.getElementById('upload_confirmation');
        
        console.log('Form submission started');
        console.log('File input element:', fileInputValue);
        console.log('Files:', fileInputValue ? fileInputValue.files : 'No input found');
        
        if (!fileInputValue || !fileInputValue.files || fileInputValue.files.length === 0) {
            e.preventDefault();
            alert('Please select a payment confirmation file before submitting.');
            console.log('Form submission blocked: No file selected');
            return false;
        }
        
        // Check file size (5MB limit)
        const file = fileInputValue.files[0];
        console.log('Selected file:', file.name, 'Size:', file.size, 'Type:', file.type);
        
        if (file.size > 5 * 1024 * 1024) {
            e.preventDefault();
            alert('File size must be less than 5MB.');
            console.log('Form submission blocked: File too large');
            return false;
        }
        
        // Check file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        if (!allowedTypes.includes(file.type)) {
            e.preventDefault();
            alert('Please upload only JPG, PNG, or PDF files.');
            console.log('Form submission blocked: Invalid file type');
            return false;
        }
        
        console.log('Form validation passed, submitting...');
        // Show loading state
        const submitButton = this.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Uploading...
            `;
        }
    });
});
</script>
@endsection
