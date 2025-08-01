<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-6 bg-transparent">
    {{-- Alert Messages --}}
    @if (session()->has('success'))
        <div class="transform transition-all duration-300 ease-in-out hover:scale-[1.02]">
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-sm"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="transform transition-all duration-300 ease-in-out hover:scale-[1.02]">
            <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        </div>
    @endif

    {{-- Title Section --}}
    <div class="text-center mb-8">
        <div class="flex items-center justify-center mb-4">
            <div class="bg-indigo-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
        <h1 class="text-4xl font-bold text-gray-900 tracking-tight mb-2">Bills Management</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Generate comprehensive shipping bills with detailed fee
            breakdown and professional documentation</p>
        <div class="mt-4 flex items-center justify-center text-sm text-gray-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Current User: <strong>Nvyviel</strong> | {{ now()->format('F d, Y - H:i') }} UTC</span>
        </div>
    </div>

    {{-- Selection Forms Card --}}
    <div
        class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
        <div class="border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-blue-50 px-8 py-6">
            <div class="flex items-center">
                <div class="bg-indigo-100 p-2 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Select Shipment Details</h2>
                    <p class="text-gray-600 text-sm mt-1">Choose company, shipment, and container to generate bill</p>
                </div>
            </div>
        </div>

        <div class="p-8 space-y-6">
            {{-- Form Progress Indicator --}}
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Selection Guide</h3>
                        <div class="mt-1 text-sm text-blue-700">
                            <p>Complete the selection in order: <strong>Company → Shipment → Container</strong>. Each
                                selection will unlock the next step.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                {{-- Company Name Dropdown - Always Visible --}}
                <div class="space-y-3">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <span class="bg-green-100 text-green-600 rounded-full p-1 mr-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        Company Name
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <select wire:model.live="user_id"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 bg-white @error('user_id') border-red-500 ring-red-500 @enderror">
                            <option value="">Select Company</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->company_name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    @error('user_id')
                        <p class="text-sm text-red-600 flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Shipment Details Dropdown - Always Visible --}}
                <div class="space-y-3">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <span
                            class="rounded-full p-1 mr-2 {{ $user_id ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                            @if ($user_id)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @endif
                        </span>
                        Shipment Details
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <select wire:model.live="shipment_id"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border-2 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 
                            {{ !$user_id ? 'bg-gray-100 border-gray-200 cursor-not-allowed text-gray-500' : 'bg-white border-gray-300' }}
                            @error('shipment_id') border-red-500 ring-red-500 @enderror"
                            {{ !$user_id ? 'disabled' : '' }}>
                            <option value="">{{ !$user_id ? 'Select Company First' : 'Choose Shipment' }}
                            </option>
                            @if ($user_id)
                                @foreach ($shipments as $shipment)
                                    <option value="{{ $shipment->id }}">
                                        {{ $shipment->vessel_name }} ({{ $shipment->from_city }} →
                                        {{ $shipment->to_city }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 {{ !$user_id ? 'text-gray-300' : 'text-gray-400' }}" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                            </svg>
                        </div>
                    </div>
                    @error('shipment_id')
                        <p class="text-sm text-red-600 flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Container Dropdown - Always Visible --}}
                <div class="space-y-3">
                    <label class="flex items-center text-sm font-semibold text-gray-700">
                        <span
                            class="rounded-full p-1 mr-2 {{ $shipment_id ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                            @if ($shipment_id)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @endif
                        </span>
                        Container
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <select wire:model.live="container_id"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border-2 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200
                            {{ !$shipment_id ? 'bg-gray-100 border-gray-200 cursor-not-allowed text-gray-500' : 'bg-white border-gray-300' }}
                            @error('container_id') border-red-500 ring-red-500 @enderror"
                            {{ !$shipment_id ? 'disabled' : '' }}>
                            <option value="">{{ !$shipment_id ? 'Select Shipment First' : 'Choose Container' }}
                            </option>
                            @if ($shipment_id)
                                @foreach ($containers as $container)
                                    <option value="{{ $container->id }}">
                                        {{ $container->id_order }} ({{ $container->container_type }} -
                                        {{ $container->quantity }} unit{{ $container->quantity > 1 ? 's' : '' }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 {{ !$shipment_id ? 'text-gray-300' : 'text-gray-400' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    @error('container_id')
                        <p class="text-sm text-red-600 flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    @if ($selectedData)
        {{-- Bill Details Card --}}
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-6">
                <div class="flex items-center">
                    <div class="bg-green-100 p-2 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Bill Details</h2>
                        <p class="text-gray-600 text-sm mt-1">Review selected shipment information</p>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Vessel Name</label>
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <p class="text-lg font-semibold text-gray-900">{{ $selectedData['vessel_name'] }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Route</label>
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <p class="text-lg font-semibold text-gray-900">{{ $selectedData['route'] }}</p>
                            </div>
                        </div>

                        <!-- Payment Term Selection -->
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700">Payment Term <span
                                    class="text-red-500">*</span></label>
                            <select wire:model.live="payment_term"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 @error('payment_term') border-red-500 ring-red-500 @enderror">
                                <option value="Port To Port">Port To Port</option>
                                <option value="Door To Door">Door To Door</option>
                                <option value="Door To Port">Door To Port</option>
                                <option value="Port To Door">Port To Door</option>
                            </select>
                            @error('payment_term')
                                <p class="text-sm text-red-600 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Container Details</label>
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <p class="text-lg font-semibold text-gray-900">{{ $selectedData['id_order'] }}</p>
                                <p class="text-sm text-gray-600">{{ $selectedData['container_type'] }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Quantity & Weight</label>
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <p class="text-lg font-semibold text-gray-900">{{ $selectedData['quantity'] }}
                                    unit{{ $selectedData['quantity'] > 1 ? 's' : '' }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ number_format($selectedData['weight'], 0, ',', '.') }} kg</p>
                            </div>
                        </div>

                        <!-- Status Selection -->
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700">Bill Status <span
                                    class="text-red-500">*</span></label>
                            <select wire:model.live="status"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 @error('status') border-red-500 ring-red-500 @enderror">
                                <option value="Unpaid">Unpaid</option>
                                <option value="Under Verification">Under Verification</option>
                                <option value="Paid">Paid</option>
                                <option value="Error">Error</option>
                            </select>
                            @error('status')
                                <p class="text-sm text-red-600 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fee Configuration Card --}}
        {{-- Fee Configuration Card --}}
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
    <div class="border-b border-gray-200 bg-gradient-to-r from-purple-50 to-indigo-50 px-8 py-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-purple-100 p-2 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900">Fee Configuration</h3>
                    <p class="text-gray-600 text-sm mt-1">Configure all fees and charges for this shipment</p>
                </div>
            </div>
            <div class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">
                Auto-calculated
            </div>
        </div>
    </div>
    <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Required Fees Section -->
            <div class="lg:col-span-3 mb-4">
                <div class="flex items-center mb-4">
                    <h4 class="text-lg font-semibold text-gray-900 mr-3">Required Fees</h4>
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="ml-3 bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">Required</span>
                </div>
            </div>

            <!-- THC LOLO -->
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-700">THC LOLO <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="thc_lolo"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 @error('thc_lolo') border-red-500 ring-red-500 @enderror"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
                @error('thc_lolo')
                    <p class="text-sm text-red-600 flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Freight Surcharge -->
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-700">Freight Surcharge <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="freight_surcharge"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 @error('freight_surcharge') border-red-500 ring-red-500 @enderror"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
                @error('freight_surcharge')
                    <p class="text-sm text-red-600 flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- BL/DO Fee -->
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-700">BL/DO Fee <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="bl_do_fee"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 @error('bl_do_fee') border-red-500 ring-red-500 @enderror"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
                @error('bl_do_fee')
                    <p class="text-sm text-red-600 flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- APBS Fee -->
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-700">APBS Fee <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="apbs_fee"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 @error('apbs_fee') border-red-500 ring-red-500 @enderror"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
                @error('apbs_fee')
                    <p class="text-sm text-red-600 flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Trucking Buruh Fee -->
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-700">Trucking Buruh Fee <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="trucking_buruh_fee"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 @error('trucking_buruh_fee') border-red-500 ring-red-500 @enderror"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
                @error('trucking_buruh_fee')
                    <p class="text-sm text-red-600 flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Dooring Fee -->
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-700">Dooring Fee <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="dooring_fee"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 @error('dooring_fee') border-red-500 ring-red-500 @enderror"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
                @error('dooring_fee')
                    <p class="text-sm text-red-600 flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Others -->
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-700">Others <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="others"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 @error('others') border-red-500 ring-red-500 @enderror"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
                @error('others')
                    <p class="text-sm text-red-600 flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Optional Fees Section -->
            <div class="lg:col-span-3 mb-4 mt-8">
                <div class="flex items-center mb-4">
                    <h4 class="text-lg font-semibold text-gray-900 mr-3">Optional Fees</h4>
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="ml-3 bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">Optional</span>
                </div>
            </div>

            <!-- Seal Fee -->
            <div class="space-y-3">
                <label class="block text-sm font-medium text-gray-600">Seal Fee <span class="text-gray-400 text-xs">(Optional)</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="seal_fee"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
            </div>

            <!-- Operational Fee -->
            <div class="space-y-3">
                <label class="block text-sm font-medium text-gray-600">Operational Fee <span class="text-gray-400 text-xs">(Optional)</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="operational_fee"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
            </div>

            <!-- Refund Fee -->
            <div class="space-y-3">
                <label class="block text-sm font-medium text-gray-600">Refund Fee <span class="text-gray-400 text-xs">(Optional)</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="refund_fee"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
            </div>

            <!-- PPN -->
            <div class="space-y-3">
                <label class="block text-sm font-medium text-gray-600">PPN <span class="text-gray-400 text-xs">(Optional)</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                    <input type="text" wire:model.live="ppn"
                        class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                        placeholder="0" oninput="formatCurrency(this)">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bill Summary Card --}}
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
    <div class="border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-teal-50 px-8 py-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-emerald-100 p-2 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900">Bill Summary</h3>
                    <p class="text-gray-600 text-sm mt-1">Comprehensive breakdown of all charges</p>
                </div>
            </div>
            <div class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full text-sm font-bold">
                Total: Rp {{ number_format((float) $grand_total, 0, ',', '.') }}
            </div>
        </div>
    </div>
    <div class="p-8">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">THC LOLO</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $thc_lolo, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Freight Surcharge</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $freight_surcharge, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">BL/DO Fee</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $bl_do_fee, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">APBS Fee</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $apbs_fee, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Trucking Buruh Fee</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $trucking_buruh_fee, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Dooring Fee</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $dooring_fee, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Others</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $others, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                        </td>
                    </tr>

                    {{-- Optional Fees - Only show if > 0 --}}
                    @if((float) $seal_fee > 0)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Seal Fee</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $seal_fee, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Optional</span>
                        </td>
                    </tr>
                    @endif
                    @if((float) $operational_fee > 0)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Operational Fee</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $operational_fee, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Optional</span>
                        </td>
                    </tr>
                    @endif
                    @if((float) $refund_fee > 0)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Refund Fee</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $refund_fee, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Optional</span>
                        </td>
                    </tr>
                    @endif
                    @if((float) $ppn > 0)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">PPN</td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                            Rp {{ number_format((float) $ppn, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Optional</span>
                        </td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 border-t-2 border-indigo-200">
                        <td class="px-6 py-6 text-lg font-bold text-indigo-900 uppercase tracking-wider">Grand Total</td>
                        <td class="px-6 py-6 text-lg font-bold text-right text-indigo-900">
                            Rp {{ number_format((float) $grand_total, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-6 text-center">
                            <span class="inline-flex px-3 py-2 text-sm font-bold rounded-full bg-indigo-100 text-indigo-800">TOTAL</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

        {{-- Upload Documents Card --}}
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="border-b border-gray-200 bg-gradient-to-r from-orange-50 to-red-50 px-8 py-6">
                <div class="flex items-center">
                    <div class="bg-orange-100 p-2 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Upload Documents</h3>
                        <p class="text-gray-600 text-sm mt-1">Upload supporting PDF documents for this bill</p>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div class="space-y-4">
                    <div x-data="{ fileChosen: false }" class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            Upload Supporting Document <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex items-center space-x-4">
                            <div class="flex-1">
                                <label
                                    class="flex flex-col items-center justify-center px-6 py-8 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 @error('uploadFile') border-red-500 bg-red-50 @enderror">
                                    <input type="file" wire:model="uploadFile" class="sr-only" accept=".pdf">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="text-lg font-medium text-gray-900 mb-2">Drop your PDF file here, or
                                            click to browse</p>
                                        <p class="text-sm text-gray-500 mb-4">PDF files only, max 10MB</p>
                                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>Select PDF Document</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @error('uploadFile')
                            <p class="text-sm text-red-600 flex items-center mt-2">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror

                        {{-- File Upload Progress --}}
                        <div wire:loading wire:target="uploadFile" class="mt-4">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="text-sm text-blue-700 font-medium">Uploading file...</span>
                                </div>
                            </div>
                        </div>

                        {{-- File Upload Success --}}
                        @if ($uploadFile)
                            <div class="mt-4 bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-green-800">File uploaded successfully!</p>
                                        <p class="text-sm text-green-600">{{ $uploadFile->getClientOriginalName() }}
                                        </p>
                                    </div>
                                    <button type="button" wire:click="removeFile"
                                        class="text-green-600 hover:text-green-800 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons Card --}}
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="p-8">
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    {{-- Reset Button --}}
                    <button type="button" wire:click="resetForm"
                        wire:confirm="Are you sure you want to reset the form? All data will be lost."
                        class="flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-all duration-200 text-sm border border-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Form
                    </button>

                    {{-- Create Bill Button --}}
                    <button type="button" wire:click="createBill" wire:loading.attr="disabled"
                        class="flex items-center justify-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-lg transition-all duration-200 text-sm shadow-lg hover:shadow-xl transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                        <div wire:loading wire:target="createBill" class="mr-2">
                            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                        <div wire:loading.remove wire:target="createBill">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <span wire:loading.remove wire:target="createBill">Create Bill</span>
                        <span wire:loading wire:target="createBill">Creating...</span>
                    </button>
                </div>

                {{-- Form Validation Summary --}}
                @if ($errors->any())
                    <div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @else
        {{-- Empty State - When no container is selected --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-12 text-center">
                <div class="bg-gray-100 p-4 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Ready to Create Bill</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Please select a company, shipment, and container from the dropdowns above to start creating your
                    bill.
                </p>
                <div class="flex items-center justify-center space-x-8 text-sm text-gray-500">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold">1</span>
                        </div>
                        <span>Select Company</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-gray-400 font-semibold">2</span>
                        </div>
                        <span>Choose Shipment</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-gray-400 font-semibold">3</span>
                        </div>
                        <span>Pick Container</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function formatCurrency(input) {
            // Remove all non-digit characters
            let value = input.value.replace(/\D/g, '');

            // Convert to number and back to handle leading zeros
            value = parseInt(value || '0').toString();

            // Add thousand separators (dots)
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Update input value
            input.value = value;

            // Trigger Livewire update with numeric value
            let numericValue = parseInt(input.value.replace(/\./g, '') || '0');
            input.dispatchEvent(new CustomEvent('input', {
                detail: {
                    value: numericValue
                }
            }));
        }

        // Initialize currency formatting on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Apply formatting to all currency inputs
            document.querySelectorAll('input[type="text"]').forEach(function(input) {
                if (input.placeholder === '0') {
                    input.addEventListener('input', function() {
                        formatCurrency(this);
                    });
                }
            });
        });

        // Livewire hook to reapply formatting after updates
        document.addEventListener('livewire:updated', function() {
            document.querySelectorAll('input[type="text"]').forEach(function(input) {
                if (input.placeholder === '0') {
                    input.addEventListener('input', function() {
                        formatCurrency(this);
                    });
                }
            });
        });
    </script>

    {{-- Additional Styles --}}
    <style>
        /* Custom scrollbar for tables */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Animation for form sections */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Loading state for inputs */
        input:disabled {
            background-color: #f8fafc !important;
            color: #64748b !important;
            cursor: not-allowed !important;
        }

        /* Hover effects for cards */
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Focus styles for better accessibility */
        input:focus,
        select:focus {
            outline: none;
            ring: 2px;
            ring-offset: 2px;
        }

        /* Custom file upload styling */
        input[type="file"] {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        /* Responsive table improvements */
        @media (max-width: 768px) {
            .overflow-x-auto table {
                min-width: 600px;
            }

            .overflow-x-auto th,
            .overflow-x-auto td {
                padding: 8px 12px;
                font-size: 14px;
            }
        }

        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }

            .print-full-width {
                width: 100% !important;
                max-width: none !important;
            }
        }
    </style>
</div>
