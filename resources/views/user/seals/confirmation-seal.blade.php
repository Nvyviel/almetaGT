@extends('layouts.main')

@section('title', 'Confirmation')
@section('component')
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-4 max-w-7xl">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center">
                            <i class="fas fa-lock text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Seal Confirmation</h1>
                            <p class="text-sm text-gray-600">Complete your seal verification process</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('seal') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-blue-800 text-sm font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Seals
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <!-- Card Header -->
                <div class="bg-blue-800 text-white p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold mb-1">Seal Information</h2>
                            <button class="text-blue-100 cursor-pointer hover:text-white font-medium"
                                onclick="navigator.clipboard.writeText('{{ $seal->id_seal }}').then(() => { 
                                    this.innerHTML = '<i class=\'fas fa-check mr-1\'></i>Copied!'; 
                                    setTimeout(() => { 
                                        this.innerHTML = '<i class=\'fas fa-copy mr-1\'></i>{{ $seal->id_seal }}'; 
                                    }, 2000); 
                                });"
                                type="button">
                                <i class="fas fa-copy mr-1"></i>{{ $seal->id_seal }}
                            </button>
                        </div>
                        <div class="w-8 h-8 bg-white bg-opacity-20 rounded flex items-center justify-center">
                            <i class="fas fa-lock text-white"></i>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-4">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <!-- Seal Details - Column 1 -->
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <div class="w-6 h-6 bg-blue-800 rounded flex items-center justify-center mr-2">
                                    <i class="fas fa-info-circle text-white text-xs"></i>
                                </div>
                                Seal Details
                            </h3>

                            <div class="space-y-2">
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded border">
                                    <span class="font-medium text-gray-700 text-sm">Seal ID:</span>
                                    <span class="text-gray-900 font-semibold">{{ $seal->id_seal ?? 'N/A' }}</span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded border">
                                    <span class="font-medium text-gray-700 text-sm">Status:</span>
                                    @php
                                        $status = $seal->status ?? 'Unknown';
                                        $statusConfig = [
                                            'Payment Proccess' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'border' => 'border-yellow-200', 'icon' => 'fas fa-credit-card'],
                                            'Confirmed' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => 'fas fa-check-circle'],
                                            'Success' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => 'fas fa-check-circle'],
                                        ];
                                        $config = $statusConfig[$status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'border' => 'border-gray-200', 'icon' => 'fas fa-question-circle'];
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }} border">
                                        <i class="{{ $config['icon'] }} mr-1"></i>
                                        {{ $status }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded border">
                                    <span class="font-medium text-gray-700 text-sm">Quantity:</span>
                                    <span class="text-gray-900 font-semibold">{{ $seal->quantity ?? '1' }} Seal{{ ($seal->quantity ?? 1) > 1 ? 's' : '' }}</span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded border">
                                    <span class="font-medium text-gray-700 text-sm">Total Price:</span>
                                    <span class="text-blue-800 font-bold">Rp {{ number_format($seal->total_price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Process Status - Column 2 -->
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <div class="w-6 h-6 bg-blue-800 rounded flex items-center justify-center mr-2">
                                    <i class="fas fa-tasks text-white text-xs"></i>
                                </div>
                                Process Timeline
                            </h3>

                            <div class="space-y-2">
                                <div class="flex items-center p-2 bg-green-50 rounded border border-green-200">
                                    <div class="w-6 h-6 bg-green-600 rounded flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 text-sm">Order Created</p>
                                        <p class="text-green-700 text-xs">{{ \Carbon\Carbon::parse($seal->created_at)->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-2 bg-yellow-50 rounded border border-yellow-200">
                                    <div class="w-6 h-6 bg-yellow-600 rounded flex items-center justify-center mr-3">
                                        <i class="fas fa-credit-card text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 text-sm">Payment Required</p>
                                        <p class="text-yellow-700 text-xs">Awaiting payment confirmation</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-2 bg-blue-50 rounded border border-blue-200">
                                    <div class="w-6 h-6 bg-blue-800 rounded flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 text-sm">Submit Payment Info</p>
                                        <p class="text-blue-700 text-xs">Complete form to proceed</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information Form - Column 3 -->
                        <div class="space-y-3">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <div class="w-6 h-6 bg-blue-800 rounded flex items-center justify-center mr-2">
                                    <i class="fas fa-credit-card text-white text-xs"></i>
                                </div>
                                Payment Information
                            </h3>

                            <form id="paymentForm" action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="space-y-3">
                                    <!-- Tanggal Pembayaran -->
                                    <div>
                                        <label for="payment_date" class="block text-xs font-medium text-gray-700 mb-1">
                                            <i class="fas fa-calendar-alt mr-1 text-blue-800"></i>Payment Date *
                                        </label>
                                        <input type="date" id="payment_date" name="payment_date"
                                            value="{{ old('payment_date', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 @error('payment_date') border-red-600 @enderror"
                                            required>
                                        @error('payment_date')
                                            <p class="text-red-600 text-xs mt-1 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Jenis Bank -->
                                    <div>
                                        <label for="bank_type" class="block text-xs font-medium text-gray-700 mb-1">
                                            <i class="fas fa-university mr-1 text-blue-800"></i>Bank Type *
                                        </label>
                                        <select id="bank_type" name="bank_type"
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 @error('bank_type') border-red-600 @enderror"
                                            required>
                                            <option value="">Select Bank</option>
                                            <option value="BCA" {{ old('bank_type') == 'BCA' ? 'selected' : '' }}>BCA
                                            </option>
                                            <option value="BNI" {{ old('bank_type') == 'BNI' ? 'selected' : '' }}>BNI
                                            </option>
                                            <option value="BRI" {{ old('bank_type') == 'BRI' ? 'selected' : '' }}>BRI
                                            </option>
                                            <option value="Mandiri" {{ old('bank_type') == 'Mandiri' ? 'selected' : '' }}>
                                                Mandiri</option>
                                            <option value="CIMB Niaga"
                                                {{ old('bank_type') == 'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga
                                            </option>
                                            <option value="Other" {{ old('bank_type') == 'Other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select>
                                        @error('bank_type')
                                            <p class="text-red-600 text-xs mt-1 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Nomor Rekening -->
                                    <div>
                                        <label for="bank_number" class="block text-xs font-medium text-gray-700 mb-1">
                                            <i class="fas fa-hashtag mr-1 text-blue-800"></i>Account Number *
                                        </label>
                                        <input type="text" id="bank_number" name="bank_number"
                                            value="{{ old('bank_number') }}" placeholder="Enter account number"
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 @error('bank_number') border-red-600 @enderror"
                                            pattern="[0-9]{10,20}" title="10-20 digits required" required>
                                        @error('bank_number')
                                            <p class="text-red-600 text-xs mt-1 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Upload Bukti Transfer -->
                                    <div>
                                        <label for="transfer_proof"
                                            class="block text-xs font-medium text-gray-700 mb-1">
                                            <i class="fas fa-upload mr-1 text-blue-800"></i>Transfer Proof *
                                        </label>
                                        <input type="file" id="transfer_proof" name="transfer_proof"
                                            accept="image/*,.pdf"
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-800 hover:file:bg-blue-100 @error('transfer_proof') border-red-600 @enderror"
                                            onchange="previewFile(this)" required>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, PDF (Max: 5MB)</p>
                                        @error('transfer_proof')
                                            <p class="text-red-600 text-xs mt-1 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror

                                        <!-- File Preview -->
                                        <div id="filePreview" class="mt-2 hidden">
                                            <div class="flex items-center p-2 bg-gray-50 rounded border">
                                                <i class="fas fa-file-alt text-gray-500 mr-2 text-sm"></i>
                                                <div>
                                                    <p id="fileName" class="text-xs font-medium text-gray-900"></p>
                                                    <p id="fileSize" class="text-xs text-gray-500"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Notes -->
                                    <div>
                                        <label for="notes" class="block text-xs font-medium text-gray-700 mb-1">
                                            <i class="fas fa-sticky-note mr-1 text-blue-800"></i>Notes (Optional)
                                        </label>
                                        <textarea id="notes" name="notes" rows="2" placeholder="Additional information..."
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 resize-none">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
                            <button onclick="submitPaymentForm()" id="submitBtn"
                                class="w-full sm:w-auto px-6 py-2 bg-blue-800 hover:bg-blue-900 text-white font-medium rounded flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Submit Payment Info
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .btn-loading {
            pointer-events: none;
            opacity: 0.7;
        }

        /* File preview styling */
        .file-preview {
            transition: all 0.2s ease;
        }

        /* Form validation styling */
        input:invalid, select:invalid, textarea:invalid {
            border-color: #dc2626;
        }

        input:valid, select:valid, textarea:valid {
            border-color: #16a34a;
        }
    </style>

    <!-- JavaScript -->
    <script>
        function submitPaymentForm() {
            const form = document.getElementById('paymentForm');
            const btn = document.getElementById('submitBtn');

            // Validate form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            if (confirm('Are you sure you want to submit this payment information?')) {
                // Show loading state
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';
                btn.classList.add('btn-loading');
                btn.disabled = true;

                // Submit form (uncomment the line below when you have the actual route)
                // form.submit();

                // Simulate submission for now
                setTimeout(() => {
                    alert('Payment information submitted successfully!');
                    btn.innerHTML = '<i class="fas fa-check mr-2"></i>Submitted!';
                    btn.classList.add('bg-green-600');
                    btn.classList.remove('bg-blue-800', 'hover:bg-blue-900');
                }, 2000);
            }
        }

        function previewFile(input) {
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileSizeInMB = (file.size / 1024 / 1024).toFixed(2);

                // Validate file size (5MB limit)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    input.value = '';
                    filePreview.classList.add('hidden');
                    return;
                }

                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Please select a valid file type (JPG, PNG, or PDF)');
                    input.value = '';
                    filePreview.classList.add('hidden');
                    return;
                }

                fileName.textContent = file.name;
                fileSize.textContent = `${fileSizeInMB} MB`;
                filePreview.classList.remove('hidden');
            } else {
                filePreview.classList.add('hidden');
            }
        }

        // Form validation and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-resize textarea
            const textarea = document.getElementById('notes');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.min(this.scrollHeight, 80) + 'px';
                });
            }
        });
    </script>
@endsection
