@extends('layouts.main')

@section('title','Edit Consignee')
@section('component')
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with Breadcrumb -->
            <div class="mb-6">
                <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-3">
                    <a href="{{ route('consignee') }}" class="hover:text-blue-800">
                        <i class="fas fa-users mr-1"></i>Consignees
                    </a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span class="text-gray-900 font-medium">Edit Consignee</span>
                </nav>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Consignee</h1>
                            <p class="text-sm text-gray-600">Update consignee information</p>
                        </div>
                    </div>
                    <a href="{{ route('consignee') }}" 
                       class="inline-flex items-center px-3 py-2 text-gray-600 hover:text-blue-800 text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                </div>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-600 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-700">Validation Errors</h3>
                            <div class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <div class="flex items-center text-sm text-red-600 mb-1">
                                        <i class="fas fa-dot-circle text-xs mr-2"></i>{{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user-edit text-blue-800"></i>
                            <h2 class="text-lg font-semibold text-gray-900">Consignee Information</h2>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle"></i>
                            <span>Required fields marked with *</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('consignee-update', $consignee->id) }}" method="POST" class="px-5 py-4 space-y-4" id="editForm">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="mb-4">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-info-circle text-blue-800 mr-2"></i>
                            <h3 class="text-md font-semibold text-gray-900">Basic Information</h3>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- Industry -->
                            <div>
                                <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-industry text-gray-400 mr-1"></i>Industry
                                </label>
                                <input type="text" 
                                       id="industry"
                                       name="industry" 
                                       value="{{ old('industry', $consignee->industry) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                       placeholder="Enter industry type">
                                @error('industry')
                                    <span class="text-red-600 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Name Consignee -->
                            <div>
                                <label for="name_consignee" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-user text-gray-400 mr-1"></i>Consignee Name *
                                </label>
                                <input type="text" 
                                       id="name_consignee"
                                       name="name_consignee"
                                       value="{{ old('name_consignee', $consignee->name_consignee) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                       placeholder="Enter consignee name" required>
                                @error('name_consignee')
                                    <span class="text-red-600 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="mb-4">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-address-book text-blue-800 mr-2"></i>
                            <h3 class="text-md font-semibold text-gray-900">Contact Information</h3>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-envelope text-gray-400 mr-1"></i>Email Address *
                                </label>
                                <input type="email" 
                                       id="email"
                                       name="email" 
                                       value="{{ old('email', $consignee->email) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                       placeholder="consignee@example.com" required>
                                @error('email')
                                    <span class="text-red-600 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>City *
                                </label>
                                <select id="city" 
                                        name="city" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                        required>
                                    <option value="">Select City</option>
                                    @foreach (['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'sampit', 'jakarta', 'kumai', 'samarinda', 'balikpapan', 'berau', 'palu', 'bitung', 'gorontalo', 'ambon'] as $city)
                                        <option value="{{ $city }}"
                                            {{ old('city', $consignee->city) == $city ? 'selected' : '' }}>
                                            {{ strtoupper($city) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <span class="text-red-600 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="lg:col-span-2">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-phone text-gray-400 mr-1"></i>Phone Number *
                                </label>
                                <input type="tel" 
                                       id="phone_number"
                                       name="phone_number"
                                       value="{{ old('phone_number', $consignee->phone_number) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                       placeholder="+62 XXX XXXX XXXX" required>
                                @error('phone_number')
                                    <span class="text-red-600 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Section -->
                    <div class="mb-4">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-map text-blue-800 mr-2"></i>
                            <h3 class="text-md font-semibold text-gray-900">Address Information</h3>
                        </div>

                        <div>
                            <label for="consignee_address" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-home text-gray-400 mr-1"></i>Complete Address
                            </label>
                            <textarea id="consignee_address"
                                      name="consignee_address" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                      placeholder="Enter complete address including street, district, etc.">{{ old('consignee_address', $consignee->consignee_address) }}</textarea>
                            @error('consignee_address')
                                <span class="text-red-600 text-sm flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            All changes will be saved immediately
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('consignee') }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                                <span class="flex items-center" id="submitText">
                                    <i class="fas fa-save mr-2"></i>Update Consignee
                                </span>
                                <span class="hidden items-center" id="loadingText">
                                    <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></div>
                                    Updating...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Quick Actions Card -->
            <div class="mt-4 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-bolt text-blue-800"></i>
                        <h3 class="text-md font-semibold text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="flex space-x-2">
                        <button type="button" onclick="duplicateConsignee()" class="px-3 py-1 text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg">
                            <i class="fas fa-copy mr-1"></i>Duplicate
                        </button>
                        <a href="{{ route('consignee') }}" class="px-3 py-1 text-xs bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg">
                            <i class="fas fa-list mr-1"></i>View All
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message Toast -->
        @if (session('success'))
            <div class="fixed top-4 right-4 z-50">
                <div class="bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center max-w-sm">
                    <i class="fas fa-check-circle mr-3"></i>
                    <div class="flex-1">
                        <p class="text-sm font-medium">Success</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-green-200 hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Custom Styles and Scripts -->
    <style>
        /* Remove excessive animations */
        * {
            transition-duration: 0.15s;
        }

        /* Custom focus styles */
        input:focus, select:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        /* Form validation styles */
        .has-error {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        /* Loading state */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            const submitText = document.getElementById('submitText');
            const loadingText = document.getElementById('loadingText');
            const inputs = form.querySelectorAll('input[required], select[required]');
            
            // Auto-hide toast messages after 5 seconds
            setTimeout(function() {
                const toast = document.querySelector('.fixed.top-4.right-4');
                if (toast) {
                    toast.style.transform = 'translateX(100%)';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 5000);
            
            // Real-time form validation
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

            // Form submission with loading state
            form.addEventListener('submit', function() {
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');
                loadingText.classList.add('flex');
                submitBtn.disabled = true;
                form.classList.add('loading');
            });

            // Phone number formatting
            const phoneInput = document.getElementById('phone_number');
            if (phoneInput) {
                phoneInput.addEventListener('input', function() {
                    let value = this.value.replace(/\D/g, '');
                    if (value.startsWith('62')) {
                        value = '+' + value;
                    } else if (value.startsWith('0')) {
                        value = '+62' + value.substring(1);
                    } else if (value && !value.startsWith('+62')) {
                        value = '+62' + value;
                    }
                    this.value = value;
                });
            }
        });

        // Quick duplicate function
        function duplicateConsignee() {
            if (confirm('Create a new consignee based on this data?')) {
                const form = document.createElement('form');
                form.method = 'GET';
                form.action = '{{ route("create-consignee") }}';
                
                const params = {
                    duplicate: '{{ $consignee->id }}',
                    industry: '{{ $consignee->industry }}',
                    city: '{{ $consignee->city }}'
                };
                
                Object.keys(params).forEach(key => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = params[key];
                    form.appendChild(input);
                });
                
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
