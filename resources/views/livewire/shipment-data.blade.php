<div class="min-h-screen py-6 sm:py-12">
    <!-- Notifications - Modern design -->
    @if (session()->has('success'))
        <div class="fixed top-4 left-4 right-4 sm:left-1/2 sm:transform sm:-translate-x-1/2 z-50 sm:w-full sm:max-w-md">
            <div
                class="bg-gradient-to-r from-green-400 to-green-500 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center backdrop-blur-sm">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm sm:text-base font-semibold">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()"
                    class="ml-4 text-white hover:text-gray-200 transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 left-4 right-4 sm:left-1/2 sm:transform sm:-translate-x-1/2 z-50 sm:w-full sm:max-w-md">
            <div
                class="bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center backdrop-blur-sm">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm sm:text-base font-semibold">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()"
                    class="ml-4 text-white hover:text-gray-200 transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Create Shipment Form Section -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden border border-gray-200 mb-8">
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 p-6 sm:p-8">
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Create Shipment Schedule</h1>
                    <p class="text-blue-100 mt-2">Fill in the details to create a new shipment schedule</p>
                </div>
            </div>

            <div class="p-6 sm:p-8">
                <form wire:submit.prevent="addSchedule" class="space-y-8">
                    <!-- Vessel Name -->
                    <div class="space-y-2">
                        <label for="vessel_name" class="flex items-center text-gray-800 font-semibold text-lg">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                                </svg>
                            </div>
                            Vessel Information
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-ship text-gray-400"></i>
                            </div>
                            <input type="text" wire:model.defer="vessel_name" id="vessel_name"
                                class="w-full pl-12 pr-4 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500 focus:ring-opacity-20 focus:border-blue-500 transition-all duration-300 bg-gray-50 focus:bg-white"
                                placeholder="Enter vessel name" style="text-transform: uppercase;">
                        </div>
                    </div>

                    <!-- Rates Section -->
                    <div class="space-y-6">
                        <div class="flex items-center text-gray-800 font-semibold text-lg">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            Pricing Information
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-gray-700 font-medium">Base Rate (IDR)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium">Rp</span>
                                    </div>
                                    <input type="text" wire:model.defer="rate"
                                        class="w-full pl-12 pr-4 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-500 focus:ring-opacity-20 focus:border-green-500 transition-all duration-300 bg-gray-50 focus:bg-white"
                                        placeholder="Enter base rate" oninput="formatNumber(this)"
                                        onblur="formatNumber(this)">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-gray-700 font-medium">Rate Per Container (IDR)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium">Rp</span>
                                    </div>
                                    <input type="text" wire:model.defer="rate_per_container"
                                        class="w-full pl-12 pr-4 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-500 focus:ring-opacity-20 focus:border-green-500 transition-all duration-300 bg-gray-50 focus:bg-white"
                                        placeholder="Enter container rate" oninput="formatNumber(this)"
                                        onblur="formatNumber(this)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Section -->
                    <div class="space-y-6">
                        <div class="flex items-center text-gray-800 font-semibold text-lg">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            Schedule Information
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div class="space-y-2">
                                <label class="block text-gray-700 font-medium">Closing Cargo</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" wire:model.defer="closing_cargo"
                                        class="w-full pl-12 pr-4 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-500 focus:ring-opacity-20 focus:border-purple-500 transition-all duration-300 bg-gray-50 focus:bg-white">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-gray-700 font-medium">ETB</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" wire:model.defer="etb"
                                        class="w-full pl-12 pr-4 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-500 focus:ring-opacity-20 focus:border-purple-500 transition-all duration-300 bg-gray-50 focus:bg-white">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-gray-700 font-medium">ETD</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" wire:model.defer="etd"
                                        class="w-full pl-12 pr-4 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-500 focus:ring-opacity-20 focus:border-purple-500 transition-all duration-300 bg-gray-50 focus:bg-white">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-gray-700 font-medium">ETA</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" wire:model.defer="eta"
                                        class="w-full pl-12 pr-4 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-500 focus:ring-opacity-20 focus:border-purple-500 transition-all duration-300 bg-gray-50 focus:bg-white">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Port Information -->
                    <div class="space-y-6">
                        <div class="flex items-center text-gray-800 font-semibold text-lg">
                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            Port Information
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-gray-700 font-medium">Port of Loading (POL)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                    <select wire:model.defer="from_city"
                                        class="w-full pl-12 pr-12 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-orange-500 focus:ring-opacity-20 focus:border-orange-500 transition-all duration-300 bg-gray-50 focus:bg-white appearance-none">
                                        <option value="">Select Port of Loading</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-gray-700 font-medium">Port of Discharge (POD)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                    <select wire:model.defer="to_city"
                                        class="w-full pl-12 pr-12 py-4 text-base border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-orange-500 focus:ring-opacity-20 focus:border-orange-500 transition-all duration-300 bg-gray-50 focus:bg-white appearance-none">
                                        <option value="">Select Port of Discharge</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-6">
                        <button type="submit"
                            class="w-full sm:w-auto px-12 py-4 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 text-white text-lg font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300">
                            <span wire:loading.remove class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create Shipment Schedule
                            </span>
                            <span wire:loading class="flex items-center justify-center">
                                <svg class="animate-spin h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Shipments List Section -->
        <div class="space-y-6">
            <!-- Header -->
            <div class="text-center">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-md mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Active Shipments</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Manage and monitor your current shipment schedules</p>
            </div>

            @if ($shipments->count() > 0)
                <div class="grid gap-6">
                    @foreach ($shipments as $shipment)
                        <div
                            class="bg-white rounded-md shadow-xl border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Header Section -->
                            <div class="bg-gradient-to-r from-slate-50 to-blue-50 p-6 border-b border-gray-100">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-3">
                                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 flex items-center">
                                                <div
                                                    class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                                    <i class="fa-solid fa-ship text-blue-600 text-lg"></i>
                                                </div>
                                                {{ $shipment->vessel_name }}
                                            </h3>
                                            <div
                                                class="flex items-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl px-4 py-2 shadow-sm">
                                                <span
                                                    class="font-bold text-sm">{{ strtoupper($shipment->from_city) }}</span>
                                                <div class="mx-3 flex items-center">
                                                    <div class="w-2 h-0.5 bg-white rounded-full"></div>
                                                    <div class="w-1 h-0.5 bg-white rounded-full mx-1"></div>
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <span
                                                    class="font-bold text-sm">{{ strtoupper($shipment->to_city) }}</span>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center text-red-600 bg-red-50 rounded-lg px-3 py-2 w-fit">
                                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-sm font-semibold">Closing:
                                                {{ \Carbon\Carbon::parse($shipment->closing_cargo)->format('d M Y - H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-end">
                                        <span
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-400 to-green-500 text-white text-sm font-semibold rounded-2xl shadow-sm">
                                            <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                                            Available
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Section - Without Progress Bar -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                                    <!-- ETB -->
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">ETB
                                        </p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ \Carbon\Carbon::parse($shipment->etb)->format('d M Y') }}</p>
                                        <p
                                            class="text-sm text-gray-500 bg-gray-100 rounded-full px-3 py-1 inline-block mt-1">
                                            {{ \Carbon\Carbon::parse($shipment->etb)->format('H:i') }}</p>
                                    </div>

                                    <!-- ETD -->
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-1">ETD
                                        </p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ \Carbon\Carbon::parse($shipment->etd)->format('d M Y') }}</p>
                                        <p
                                            class="text-sm text-gray-500 bg-gray-100 rounded-full px-3 py-1 inline-block mt-1">
                                            {{ \Carbon\Carbon::parse($shipment->etd)->format('H:i') }}</p>
                                    </div>

                                    <!-- ETA -->
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-xs font-bold text-purple-600 uppercase tracking-wider mb-1">ETA
                                        </p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ \Carbon\Carbon::parse($shipment->eta)->format('d M Y') }}</p>
                                        <p
                                            class="text-sm text-gray-500 bg-gray-100 rounded-full px-3 py-1 inline-block mt-1">
                                            {{ \Carbon\Carbon::parse($shipment->eta)->format('H:i') }}</p>
                                    </div>

                                    <!-- Destination Icon -->
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                            <i class="fa-solid fa-anchor text-white text-2xl"></i>
                                        </div>
                                        <p class="text-xs font-bold text-green-600 uppercase tracking-wider mb-1">
                                            Destination</p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ strtoupper($shipment->to_city) }}</p>
                                        <p
                                            class="text-sm text-gray-500 bg-gray-100 rounded-full px-3 py-1 inline-block mt-1">
                                            Port</p>
                                    </div>
                                </div>

                                <!-- Price and Actions -->
                                <div
                                    class="flex flex-col lg:flex-row items-center justify-between gap-6 pt-6 border-t border-gray-100">
                                    <div class="text-center lg:text-left">
                                        <p class="text-sm font-medium text-gray-600 mb-2">Container Pricing</p>
                                        <div class="flex items-baseline justify-center lg:justify-start">
                                            <span class="text-4xl font-bold text-gray-900">Rp
                                                {{ number_format($shipment->rate_per_container, 0, ',', '.') }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">per container unit</p>
                                    </div>

                                    <div class="flex gap-4 w-full lg:w-auto">
                                        <a href="{{ route('edit-shipment', $shipment->id) }}" wire:navigate
                                            class="flex-1 lg:flex-none inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Edit Schedule
                                        </a>
                                        <button wire:click="deleteShipment({{ $shipment->id }})"
                                            wire:confirm="Are you sure you want to delete this shipment?"
                                            class="flex-1 lg:flex-none inline-flex items-center justify-center px-6 py-3 bg-white text-red-600 border-2 border-red-200 font-semibold rounded-2xl hover:bg-red-50 hover:border-red-300 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-3xl shadow-xl p-12 text-center border border-gray-200">
                    <div
                        class="w-24 h-24 mx-auto bg-gradient-to-r from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mb-6">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No Shipments Available</h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-8">There are no active shipments at the moment. Create
                        your first shipment schedule to get started with managing your cargo operations.</p>
                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 text-white font-semibold rounded-2xl hover:shadow-xl transform hover:scale-105 transition-all duration-300 shadow-lg">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Create Your First Shipment
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.formatNumber = function(input) {
            let cursorPos = input.selectionStart;
            let value = input.value.replace(/\D/g, '');
            let originalLength = input.value.length;

            let formattedValue = '';
            while (value.length > 3) {
                formattedValue = '.' + value.substr(value.length - 3) + formattedValue;
                value = value.substr(0, value.length - 3);
            }
            formattedValue = value + formattedValue;

            let newLength = formattedValue.length;
            let lengthDiff = newLength - originalLength;
            let newCursorPos = cursorPos + lengthDiff;

            input.value = formattedValue;

            if (cursorPos <= originalLength) {
                input.setSelectionRange(newCursorPos, newCursorPos);
            }
        };

        // Auto-remove notifications after 5 seconds
        const notifications = document.querySelectorAll('[class*="fixed top-4"]');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-100%)';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        });
    });
</script>
