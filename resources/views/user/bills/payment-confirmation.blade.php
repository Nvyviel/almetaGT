@extends('layouts.main')

@section('title', 'Payment Confirmation')

@section('component')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('detail-bill', $bill) }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Bill Detail
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-6 border-b">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Payment Confirmation</h1>
                        <p class="text-gray-600 mt-1">Submit proof of payment for Bill {{ $bill->bill_id }}</p>
                    </div>
                </div>
            </div>

            {{-- Bill Summary --}}
            <div class="px-6 py-4 bg-gray-50 border-b">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Bill ID:</span>
                        <span class="font-semibold text-gray-900 ml-2">{{ $bill->bill_id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Amount:</span>
                        <span class="font-bold text-blue-600 ml-2">Rp {{ number_format($bill->grand_total, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Status:</span>
                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 ml-2">
                            {{ $bill->status }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Payment Form --}}
            <form action="{{ route('bills.confirm-payment', $bill) }}" method="POST" enctype="multipart/form-data" class="px-6 py-6">
                @csrf
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Payment Date -->
                    <div>
                        <label for="paid_at" class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 inline text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Payment Date
                        </label>
                        <input type="date" 
                               id="paid_at" 
                               name="paid_at" 
                               value="{{ old('paid_at') }}"
                               max="{{ date('Y-m-d') }}"
                               class="block w-full px-3 py-2 border @error('paid_at') border-red-300 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('paid_at')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 inline text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Payment Proof (Image/PDF)
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 @error('upload_confirmation') border-red-300 @else border-gray-300 @enderror border-dashed rounded-md hover:border-blue-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="upload_confirmation" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="upload_confirmation" name="upload_confirmation" type="file" accept=".jpg,.jpeg,.png,.pdf" class="sr-only">
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
                    </div>

                    <!-- Important Notes -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Important Notes</h3>
                                <ul class="mt-2 text-sm text-blue-700 list-disc list-inside space-y-1">
                                    <li>Upload clear image or PDF of your payment receipt</li>
                                    <li>Ensure the amount matches: <strong>Rp {{ number_format($bill->grand_total, 0, ',', '.') }}</strong></li>
                                    <li>Your payment will be verified by our team</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-200 mt-6">
                    <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                        <a href="{{ route('detail-bill', $bill) }}" 
                           class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex justify-center items-center px-6 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
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
    
    // Handle file input change
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            displaySelectedFile(this.files[0]);
        }
    });
    
    // Handle drag and drop
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-blue-400', 'bg-blue-50');
    });
    
    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-400', 'bg-blue-50');
    });
    
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-400', 'bg-blue-50');
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            displaySelectedFile(e.dataTransfer.files[0]);
        }
    });
    
    function displaySelectedFile(file) {
        const fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        dropZone.innerHTML = `
            <div class="space-y-2 text-center">
                <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm">
                    <p class="font-medium text-gray-900">${file.name}</p>
                    <p class="text-gray-500">${fileSize}</p>
                </div>
                <button type="button" onclick="resetFileUpload()" class="text-sm text-red-600 hover:text-red-800">
                    Remove file
                </button>
            </div>
        `;
    }
    
    window.resetFileUpload = function() {
        location.reload();
    }
});
</script>
@endsection
