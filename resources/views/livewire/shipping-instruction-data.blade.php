<div class="max-w-7xl mx-auto px-4 py-4">
    <div class="bg-white overflow-hidden rounded-lg shadow-sm border border-gray-200">
        {{-- Header Section --}}
        <div class="bg-gray-50 p-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Create Shipping Instructions</h2>
                        <p class="text-sm text-gray-600">Complete the form below to create new shipping instructions</p>
                    </div>
                </div>
                <a href="{{ route('shipping-instruction') }}" wire:navigate
                    class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>

        {{-- Selected Consignee Details --}}
        @if ($consignee_id)
            @php
                $selectedConsignee = $consignees->find($consignee_id);
            @endphp
            <div class="px-4 py-3 bg-blue-50 border-b border-gray-200">
                <div class="flex items-center mb-3">
                    <i class="fas fa-user-check text-blue-800 mr-2"></i>
                    <h4 class="text-md font-semibold text-gray-900">Selected Consignee</h4>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-500 font-medium">Industry</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $selectedConsignee->industry }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-500 font-medium">City</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $selectedConsignee->city }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-500 font-medium">Email</p>
                        <p class="text-sm text-gray-900 font-medium truncate">{{ $selectedConsignee->email }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <p class="text-xs text-gray-500 font-medium">Phone</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $selectedConsignee->phone_number }}</p>
                    </div>
                    @if($selectedConsignee->consignee_address)
                    <div class="bg-white p-3 rounded-lg border border-gray-200 col-span-2 lg:col-span-4">
                        <p class="text-xs text-gray-500 font-medium">Address</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $selectedConsignee->consignee_address }}</p>
                    </div>
                    @endif
                </div>
            </div>
        @endif

        <form wire:submit.prevent="store" class="p-4">
            {{-- Form Progress Steps --}}
            <div class="mb-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-md font-semibold text-gray-900">Form Progress</h3>
                    <span class="text-sm text-gray-500">Complete steps 1-3</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-full {{ $consignee_id ? 'bg-blue-800 text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center text-xs font-medium">1</div>
                        <span class="text-sm {{ $consignee_id ? 'text-blue-800 font-medium' : 'text-gray-500' }}">Consignee</span>
                    </div>
                    <div class="flex-1 h-0.5 {{ $consignee_id ? 'bg-blue-800' : 'bg-gray-200' }}"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-full {{ $shipment_id ? 'bg-blue-800 text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center text-xs font-medium">2</div>
                        <span class="text-sm {{ $shipment_id ? 'text-blue-800 font-medium' : 'text-gray-500' }}">Shipment</span>
                    </div>
                    <div class="flex-1 h-0.5 {{ $shipment_id ? 'bg-blue-800' : 'bg-gray-200' }}"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-full {{ $container_id ? 'bg-blue-800 text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center text-xs font-medium">3</div>
                        <span class="text-sm {{ $container_id ? 'text-blue-800 font-medium' : 'text-gray-500' }}">Container</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Consignee Dropdown --}}
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <label for="consignee_id" class="flex items-center space-x-2 text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-blue-800"></i>
                        <span>Select Consignee *</span>
                    </label>
                    <select wire:model.live="consignee_id" id="consignee_id"
                        class="w-full px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 text-sm {{ $errors->has('consignee_id') ? 'border-red-600 ring-red-600/20' : 'border border-gray-300' }}">
                        <option value="">Choose a Consignee</option>
                        @foreach ($consignees as $consignee)
                            <option value="{{ $consignee->id }}">{{ $consignee->name_consignee }}</option>
                        @endforeach
                    </select>
                    @error('consignee_id')
                        <div class="mt-2 flex items-start gap-2 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
                            <i class="fas fa-exclamation-circle mt-0.5 flex-shrink-0"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Shipment Dropdown --}}
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <label for="shipment_id" class="flex items-center space-x-2 text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-ship text-blue-800"></i>
                        <span>Select Shipment *</span>
                    </label>
                    <select wire:model.live="shipment_id" id="shipment_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 text-sm
                        {{ !$consignee_id ? 'bg-gray-100 cursor-not-allowed text-gray-500' : '' }}
                        @error('shipment_id') border-red-600 ring-red-600/20 @enderror"
                        {{ !$consignee_id ? 'disabled' : '' }}>
                        <option value="">{{ !$consignee_id ? 'Select Consignee First' : 'Choose a Shipment' }}</option>
                        @if ($consignee_id)
                            @foreach ($shipments as $shipment)
                                <option value="{{ $shipment->id }}">{{ $shipment->vessel_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('shipment_id')
                        <span class="text-red-600 text-sm flex items-center mt-1">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Container Dropdown --}}
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <label for="container_id" class="flex items-center space-x-2 text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-box text-blue-800"></i>
                        <span>Select Container *</span>
                    </label>
                    <select wire:model.live="container_id" id="container_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 text-sm
                        {{ !$shipment_id ? 'bg-gray-100 cursor-not-allowed text-gray-500' : '' }}
                        @error('container_id') border-red-600 ring-red-600/20 @enderror"
                        {{ !$shipment_id ? 'disabled' : '' }}>
                        <option value="">{{ !$shipment_id ? 'Select Shipment First' : 'Choose a Container' }}</option>
                        @if ($shipment_id && $containers->count() > 0)
                            @foreach ($containers as $container)
                                <option value="{{ $container->id }}">
                                    {{ $container->id_order }} - {{ $container->container_type }}
                                    ({{ $container->quantity }} Container{{ $container->quantity > 1 ? 's' : '' }})
                                </option>
                            @endforeach
                        @elseif ($shipment_id && $containers->count() == 0)
                            <option value="" disabled>No containers available for this shipment</option>
                        @endif
                    </select>
                    @error('container_id')
                        <span class="text-red-600 text-sm flex items-center mt-1">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            {{-- No containers warning --}}
            @if ($shipment_id && $containers->count() == 0)
                <div class="mt-4 bg-red-50 border border-red-600 rounded-lg p-3">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                        <div>
                            <h3 class="text-sm font-medium text-red-700">No Containers Available</h3>
                            <p class="text-sm text-red-600 mt-1">No approved containers found for this shipment. Contact admin or select another shipment.</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Container Details Section --}}
            @if ($container_id && count($container_numbers) > 0)
                <div class="space-y-4 mt-4">
                    <div class="bg-green-50 border border-green-600 rounded-lg p-3">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <div>
                                <h3 class="text-sm font-medium text-green-700">Container Details Required</h3>
                                <p class="text-sm text-green-600 mt-1">Fill container information for {{ count($container_numbers) }} container(s) below.</p>
                            </div>
                        </div>
                    </div>

                    @foreach (range(0, count($container_numbers) - 1) as $index)
                        <div class="bg-white rounded-lg border border-gray-200 p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-blue-800 text-white rounded-lg flex items-center justify-center text-sm font-medium">
                                        {{ $index + 1 }}
                                    </div>
                                    <h3 class="text-md font-semibold text-gray-900">Container {{ $index + 1 }}</h3>
                                </div>
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">
                                    Required *
                                </span>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-barcode text-gray-400 mr-1"></i>Container Number *
                                    </label>
                                    <input type="text" wire:model="container_numbers.{{ $index }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 text-sm @error("container_numbers.{$index}") border-red-600 ring-red-600/20 @enderror"
                                        placeholder="Enter container number" maxlength="12">
                                    @error("container_numbers.{$index}")
                                        <span class="text-red-600 text-sm flex items-center mt-1">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-lock text-gray-400 mr-1"></i>Seal Number *
                                    </label>
                                    <input type="text" wire:model="seal_numbers.{{ $index }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 text-sm @error("seal_numbers.{$index}") border-red-600 ring-red-600/20 @enderror"
                                        placeholder="Enter seal number">
                                    @error("seal_numbers.{$index}")
                                        <span class="text-red-600 text-sm flex items-center mt-1">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-sticky-note text-gray-400 mr-1"></i>Notes (Optional)
                                    </label>
                                    <textarea wire:model="container_notes.{{ $index }}" rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800 text-sm @error("container_notes.{$index}") border-red-600 ring-red-600/20 @enderror"
                                        placeholder="Add any additional notes here"></textarea>
                                    @error("container_notes.{$index}")
                                        <span class="text-red-600 text-sm flex items-center mt-1">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Waiting Status --}}
            @if (!$container_id)
                <div class="mt-4 bg-gray-50 border border-gray-300 rounded-lg p-3">
                    <div class="flex items-center">
                        <i class="fas fa-hourglass-half text-gray-400 mr-2"></i>
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Awaiting Container Selection</h3>
                            <p class="text-sm text-gray-500 mt-1">Complete the form above to proceed with container details.</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Hidden input for container parameter --}}
            @if ($container_id)
                <input type="hidden" name="container" value="{{ $container_id }}">
            @endif

            {{-- Submit Section --}}
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-1"></i>
                        @if($container_id && count($container_numbers) > 0)
                            Ready to create shipping instructions
                        @else
                            Complete all required fields to proceed
                        @endif
                    </div>
                    @if($container_id && count($container_numbers) > 0)
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded font-medium">
                            Form Complete
                        </span>
                    @endif
                </div>
                
                <button type="submit" wire:loading.attr="disabled"
                    class="w-full py-3 px-6 rounded-lg flex items-center justify-center text-sm font-medium
                    {{ $container_id && count($container_numbers) > 0 ? 'bg-blue-800 hover:bg-blue-900 text-white' : 'bg-gray-500 hover:bg-gray-600 text-white' }}">
                    @if ($container_id && count($container_numbers) > 0)
                        <i class="fas fa-paper-plane mr-2"></i>
                        Create Shipping Instructions
                    @else
                        <i class="fas fa-check-circle mr-2"></i>
                        Validate Required Fields
                    @endif
                </button>
            </div>
        </form>

        {{-- Toast Messages --}}
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

        @if (session('error'))
            <div class="fixed top-4 right-4 z-50">
                <div class="bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center max-w-sm">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    <div class="flex-1">
                        <p class="text-sm font-medium">Error</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-red-200 hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('info'))
            <div class="fixed top-4 right-4 z-50">
                <div class="bg-blue-800 text-white px-4 py-3 rounded-lg shadow-lg flex items-center max-w-sm">
                    <i class="fas fa-info-circle mr-3"></i>
                    <div class="flex-1">
                        <p class="text-sm font-medium">Information</p>
                        <p class="text-sm">{{ session('info') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-blue-200 hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Custom Styles -->
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

        /* Progress step line animation */
        .progress-line {
            transition: background-color 0.3s ease;
        }

        /* Loading state for form submission */
        .form-loading {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Smooth container reveal */
        .container-detail-enter {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide toast messages after 5 seconds
            setTimeout(function() {
                const toasts = document.querySelectorAll('.fixed.top-4.right-4');
                toasts.forEach(function(toast) {
                    toast.style.transform = 'translateX(100%)';
                    setTimeout(() => toast.remove(), 300);
                });
            }, 5000);

            // Form validation enhancement
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input[required], select[required]');
            
            // Real-time validation
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

            // Form submission loading state
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
                submitBtn.disabled = true;
                form.classList.add('form-loading');
                
                // Re-enable if form submission fails (fallback)
                setTimeout(function() {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    form.classList.remove('form-loading');
                }, 10000);
            });

            // Container details animation
            const containerSection = document.querySelector('.container-detail-enter');
            if (containerSection) {
                containerSection.classList.add('container-detail-enter');
            }
        });

        // Livewire hooks for dynamic content
        document.addEventListener('livewire:updated', function() {
            // Re-apply animations to new container details
            const newContainers = document.querySelectorAll('[class*="container-detail"]');
            newContainers.forEach(function(container) {
                container.classList.add('container-detail-enter');
            });
        });
    </script>
</div>
