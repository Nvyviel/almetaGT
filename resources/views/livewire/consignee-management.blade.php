<div class="container mx-auto px-4 py-4">
    @php
        $fromCities = [
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
            'Serui',
        ];
    @endphp

    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-user-plus text-white"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Add New Consignee</h2>
                    <p class="text-sm text-gray-600">Fill in the consignee information and required documents</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-blue-800">Step 1 of 1</p>
                <p class="text-xs text-gray-500">Consignee Registration</p>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">

        <form wire:submit="store" class="space-y-4" enctype="multipart/form-data">
            <!-- Basic Information Section -->
            <div class="mb-6">
                <div class="flex items-center mb-3">
                    <i class="fas fa-info-circle text-blue-800 mr-2"></i>
                    <h3 class="text-md font-semibold text-gray-900">Basic Information</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Industry -->
                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry / Company
                            *</label>
                        <input type="text" wire:model="industry" id="industry"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                            placeholder="PT. Example Company / CV. Example Company">
                        @error('industry')
                            <span class="text-red-600 text-sm flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Name Consignee -->
                    <div>
                        <label for="name_consignee" class="block text-sm font-medium text-gray-700 mb-1">Consignee Name
                            *</label>
                        <input type="text" wire:model="name_consignee" id="name_consignee"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                            placeholder="Enter consignee name">
                        @error('name_consignee')
                            <span class="text-red-600 text-sm flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address
                            *</label>
                        <input type="email" wire:model="email" id="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                            placeholder="consignee@example.com">
                        @error('email')
                            <span class="text-red-600 text-sm flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- City -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                        <select wire:model="city"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800">
                            <option value="">Select City</option>
                            @foreach ($fromCities as $city)
                                <option value="{{ $city }}">{{ strtoupper($city) }}</option>
                            @endforeach
                        </select>
                        @error('city')
                            <span class="text-red-600 text-sm flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number
                            *</label>
                        <input type="tel" wire:model="phone_number" id="phone_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                            placeholder="+62 XXX XXXX XXXX">
                        @error('phone_number')
                            <span class="text-red-600 text-sm flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Address - Full Width -->
                    <div class="md:col-span-2">
                        <label for="consignee_address"
                            class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea wire:model="consignee_address" id="consignee_address" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                            placeholder="Enter full address"></textarea>
                        @error('consignee_address')
                            <span class="text-red-600 text-sm flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Document Upload Section -->
            <div class="border-t border-gray-200 pt-4">
                <div class="flex items-center mb-3">
                    <i class="fas fa-file-upload text-blue-800 mr-2"></i>
                    <h3 class="text-md font-semibold text-gray-900">Required Documents</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- KTP Upload -->
                    <div>
                        <label for="ktp" class="block text-sm font-medium text-gray-700 mb-2">
                            ID Card (KTP) <span class="text-red-600">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400">
                            @if ($ktp)
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <p class="text-sm text-green-600 font-medium">{{ $ktp->getClientOriginalName() }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ number_format($ktp->getSize() / 1024, 2) }} KB
                                    </p>
                                    <button type="button" wire:click="$set('ktp', null)"
                                        class="text-xs text-red-600 hover:text-red-800 mt-1">
                                        <i class="fas fa-trash mr-1"></i>Remove
                                    </button>
                                </div>
                            @else
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-cloud-upload-alt text-gray-400"></i>
                                    </div>
                                    <label for="ktp" class="cursor-pointer">
                                        <span class="text-sm text-blue-800 font-medium hover:text-blue-900">Choose KTP
                                            file</span>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG up to 2MB</p>
                                    </label>
                                </div>
                            @endif
                            <input id="ktp" wire:model="ktp" type="file" class="sr-only" accept="image/*">
                        </div>
                        @error('ktp')
                            <span class="text-red-600 text-sm flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- NPWP Upload -->
                    <div>
                        <label for="npwp" class="block text-sm font-medium text-gray-700 mb-2">
                            Tax ID (NPWP) <span class="text-red-600">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400">
                            @if ($npwp)
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <p class="text-sm text-green-600 font-medium">{{ $npwp->getClientOriginalName() }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ number_format($npwp->getSize() / 1024, 2) }}
                                        KB</p>
                                    <button type="button" wire:click="$set('npwp', null)"
                                        class="text-xs text-red-600 hover:text-red-800 mt-1">
                                        <i class="fas fa-trash mr-1"></i>Remove
                                    </button>
                                </div>
                            @else
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-cloud-upload-alt text-gray-400"></i>
                                    </div>
                                    <label for="npwp" class="cursor-pointer">
                                        <span class="text-sm text-blue-800 font-medium hover:text-blue-900">Choose NPWP
                                            file</span>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG up to 2MB</p>
                                    </label>
                                </div>
                            @endif
                            <input id="npwp" wire:model="npwp" type="file" class="sr-only"
                                accept="image/*">
                        </div>
                        @error('npwp')
                            <span class="text-red-600 text-sm flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Upload Progress -->
            <div wire:loading wire:target="ktp,npwp" class="flex items-center justify-center py-2">
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 border-2 border-blue-800 border-t-transparent rounded-full animate-spin"></div>
                    <span class="text-sm text-gray-600">Uploading file...</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    All fields marked with * are required
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="window.history.back()"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="store"
                        class="inline-flex items-center px-6 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="store">
                            <i class="fas fa-save mr-2"></i>Save Consignee
                        </span>
                        <span wire:loading wire:target="store" class="flex items-center">
                            <div
                                class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2">
                            </div>
                            Saving...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center max-w-sm">
                <i class="fas fa-check-circle mr-3"></i>
                <div class="flex-1">
                    <p class="text-sm font-medium">Success</p>
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()"
                    class="ml-2 text-green-200 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center max-w-sm">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <div class="flex-1">
                    <p class="text-sm font-medium">Error</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()"
                    class="ml-2 text-red-200 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Form Progress Indicator -->
    <div class="fixed bottom-4 right-4 z-40" id="formProgress" style="display: none;">
        <div class="bg-blue-800 text-white px-4 py-2 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></div>
                <span class="text-sm">Processing form...</span>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        /* Remove excessive animations */
        * {
            transition-duration: 0.15s;
        }

        /* Custom focus styles */
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        /* File upload hover effects */
        .hover\:border-blue-400:hover {
            border-color: #60a5fa;
        }

        /* Loading spinner */
        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Form validation styles */
        .has-error {
            border-color: #dc2626 !important;
        }

        /* Progress bar */
        .progress-bar {
            background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
            height: 4px;
            border-radius: 2px;
        }
    </style>

    <script>
        // Auto hide flash messages after 4 seconds
        setTimeout(function() {
            const flashMessages = document.querySelectorAll('.fixed.top-4.right-4');
            flashMessages.forEach(function(message) {
                message.style.opacity = '0';
                message.style.transform = 'translateX(100%)';
                setTimeout(function() {
                    message.remove();
                }, 200);
            });
        }, 4000);

        // Form validation enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input[required], select[required]');

            // Add real-time validation
            inputs.forEach(function(input) {
                input.addEventListener('blur', function() {
                    if (!this.value.trim()) {
                        this.classList.add('has-error');
                    } else {
                        this.classList.remove('has-error');
                    }
                });

                input.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('has-error');
                    }
                });
            });

            // Form submission progress
            form.addEventListener('submit', function() {
                document.getElementById('formProgress').style.display = 'block';
            });
        });

        // Drag and drop functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropZones = document.querySelectorAll('[class*="border-dashed"]');

            dropZones.forEach(function(zone) {
                zone.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('border-blue-400');
                });

                zone.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('border-blue-400');
                });

                zone.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('border-blue-400');
                    // Handle file drop logic here if needed
                });
            });
        });
    </script>
</div>
