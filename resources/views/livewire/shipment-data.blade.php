<div class="min-h-screen py-4 sm:py-6">
    <!-- Notifications -->
    @if (session()->has('success'))
        <div class="fixed top-4 left-4 right-4 sm:left-1/2 sm:transform sm:-translate-x-1/2 z-50 sm:w-full sm:max-w-md">
            <div class="bg-green-600 text-white px-6 py-4 rounded-lg shadow-lg flex items-center">
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
                    class="ml-4 text-white hover:text-gray-200">
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
            <div class="bg-red-600 text-white px-6 py-4 rounded-lg shadow-lg flex items-center">
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
                    class="ml-4 text-white hover:text-gray-200">
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
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 mb-6">
            <div class="bg-blue-800 p-4 sm:p-5">
                <div class="text-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Create Shipment Schedule</h1>
                    <p class="text-white text-opacity-80 mt-1 text-sm sm:text-base">Fill in the details to create a new shipment schedule</p>
                </div>
            </div>

            <div class="p-4 sm:p-6">
                <form wire:submit.prevent="addSchedule" class="space-y-6">
                    <!-- Vessel Name -->
                    <div class="space-y-2">
                        <label for="vessel_name" class="flex items-center text-gray-800 font-semibold">
                            <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                                </svg>
                            </div>
                            Vessel Information
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-ship text-gray-400 text-sm"></i>
                            </div>
                            <input type="text" wire:model.defer="vessel_name" id="vessel_name"
                                class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white"
                                placeholder="Enter vessel name" style="text-transform: uppercase;">
                        </div>
                    </div>

                    <!-- Rates Section -->
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-800 font-semibold">
                            <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            Pricing Information
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="block text-gray-700 font-medium text-sm">Freight 20 (IDR)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium text-sm">Rp</span>
                                    </div>
                                    <input type="text" wire:model.defer="freight_20"
                                        class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white freight-input"
                                        placeholder="Enter base rate" data-format="currency" onfocus="this.select()">
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-gray-700 font-medium text-sm">Freight 40 (IDR)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium text-sm">Rp</span>
                                    </div>
                                    <input type="text" wire:model.defer="freight_40"
                                        class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white freight-input"
                                        placeholder="Enter container rate" data-format="currency" onfocus="this.select()">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Section -->
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-800 font-semibold">
                            <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            Schedule Information
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="space-y-1">
                                <label class="block text-gray-700 font-medium text-sm">Open Stack</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" wire:model.defer="open_stack"
                                        class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white">
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-gray-700 font-medium text-sm">Closing Cargo</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" wire:model.defer="closing_cargo"
                                        class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white">
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-gray-700 font-medium text-sm">ETD</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" wire:model.defer="etd"
                                        class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white">
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-gray-700 font-medium text-sm">ETA</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" wire:model.defer="eta"
                                        class="w-full pl-10 pr-3 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Port Information -->
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-800 font-semibold">
                            <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            Port Information
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="block text-gray-700 font-medium text-sm">Port of Loading (POL)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                    <select wire:model.defer="from_city"
                                        class="w-full pl-10 pr-8 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white appearance-none">
                                        <option value="">Select Port of Loading</option>
                                        @php
                                            $sortedCitiesPOL = collect($cities)->sort()->values();
                                        @endphp
                                        @foreach ($sortedCitiesPOL as $city)
                                            <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-gray-700 font-medium text-sm">Port of Discharge (POD)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                    <select wire:model.defer="to_city"
                                        class="w-full pl-10 pr-8 py-2 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white appearance-none">
                                        <option value="">Select Port of Discharge</option>
                                        @php
                                            $sortedCitiesPOD = collect($cities)->sort()->values();
                                        @endphp
                                        @foreach ($sortedCitiesPOD as $city)
                                            <option value="{{ strtoupper($city) }}">{{ strtoupper($city) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-4">
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-blue-800 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-800 transition-colors duration-150">
                            <span wire:loading.remove class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create Shipment Schedule
                            </span>
                            <span wire:loading class="flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
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

        <!-- Active Shipments Section -->
        <div class="space-y-4 sm:space-y-6 lg:space-y-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 sm:mb-8 gap-3">
                <div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">Active Shipments</h2>
                    <p class="text-gray-500 mt-1">Manage and monitor your current shipment schedules</p>
                </div>
                <div
                    class="px-4 py-2 sm:px-5 sm:py-3 bg-blue-800 text-white rounded-full font-medium flex items-center shadow-sm text-sm sm:text-base">
                    <i class="fas fa-ship mr-2"></i>
                    <span>{{ $shipments->count() }} active shipments</span>
                </div>
            </div>

            @if ($shipments->count() > 0)
                <div class="space-y-4 sm:space-y-6">
                    @foreach ($shipments as $shipment)
                        <div
                            class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow">
                            <!-- Shipment Card Header -->
                            <div class="relative bg-blue-800 text-white p-3 sm:p-4">
                                <div class="absolute top-0 right-0 w-10 h-10 sm:w-12 sm:h-12">
                                    <div
                                        class="absolute transform rotate-45 bg-blue-600 text-center text-white font-semibold py-0.5 right-[-20px] sm:right-[-25px] top-[16px] sm:top-[20px] w-[100px] sm:w-[120px] shadow-md text-xs">
                                        ACTIVE
                                    </div>
                                </div>

                                <div class="pr-6 sm:pr-8">
                                    <div class="flex flex-wrap items-baseline gap-2 mb-1.5">
                                        <h3 class="text-base sm:text-lg lg:text-xl font-bold break-words">
                                            {{ $shipment->vessel_name }}
                                        </h3>
                                        <div class="flex items-center text-white text-xs bg-red-600 px-2.5 py-1.5 rounded-full">
                                            <svg class="h-2.5 w-2.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-medium text-xs">{{ \Carbon\Carbon::parse($shipment->open_stack)->format('d M Y - H:i') }}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center text-white text-sm">
                                        <span class="font-medium">{{ strtoupper($shipment->from_city) }}</span>

                                        <!-- Mobile Route Indicator -->
                                        <div class="flex sm:hidden items-center justify-center my-1.5">
                                            <div class="flex flex-col items-center space-y-0.5">
                                                <span class="w-1 h-1 bg-white rounded-full"></span>
                                                <span class="w-0.5 h-6 bg-white"></span>
                                                <span class="w-1 h-1 bg-white rounded-full"></span>
                                            </div>
                                        </div>

                                        <!-- Desktop Route Indicator -->
                                        <div class="hidden sm:flex items-center mx-2 space-x-1">
                                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                            <span class="w-6 lg:w-8 h-0.5 bg-white"></span>
                                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        </div>

                                        <span class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
                                    </div>
                                </div>
                            </div>

                                <div class="p-3 sm:p-4">
                                <!-- Timeline Section -->
                                <div
                                    class="bg-gray-50 rounded-lg p-3 mb-3 border border-gray-200">
                                    <h4
                                        class="text-sm font-bold text-gray-900 mb-2.5 flex items-center">
                                        <i
                                            class="fas fa-calendar-alt text-blue-800 mr-1.5 text-xs"></i>
                                        <span class="text-sm">Voyage Schedule</span>
                                    </h4>

                                    <div class="relative">
                                        <!-- Desktop Timeline bar -->
                                        <div
                                            class="hidden sm:block absolute top-1/2 left-0 right-0 h-0.5 bg-gray-200 transform -translate-y-1/2 z-0 mx-8 lg:mx-12">
                                        </div>

                                        <!-- Mobile: Vertical Timeline -->
                                        <div
                                            class="sm:hidden absolute left-5 top-12 bottom-12 w-0.5 bg-gray-200 z-0">
                                        </div>

                                        <!-- Mobile: Connect lines between timeline items -->
                                        <div class="sm:hidden space-y-4 relative">
                                            @foreach (['closing_cargo', 'etd', 'eta'] as $index => $timeKey)
                                                <div class="flex items-center space-x-3 relative z-10">
                                                    <!-- Timeline dot -->
                                                    <div
                                                        class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center shadow-sm {{ $index == 0 ? 'bg-green-100 text-green-800' : ($index == 1 ? 'bg-blue-100 text-blue-800' : 'bg-blue-800 text-white') }}">
                                                        <i
                                                            class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }} text-xs"></i>
                                                    </div>

                                                    <!-- Content -->
                                                    <div
                                                        class="flex-1 bg-white rounded-lg p-2.5 shadow-sm border border-gray-200">
                                                        <p class="text-xs font-bold text-blue-800 mb-0.5">
                                                            {{ strtoupper(str_replace('_', ' ', $timeKey)) }}
                                                        </p>
                                                        <p class="font-bold text-gray-800 text-sm">
                                                            {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                        </p>
                                                        <p class="text-xs text-gray-500 mt-0.5 flex items-center">
                                                            <i class="far fa-clock mr-1"></i>
                                                            {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Desktop Timeline -->
                                        <div class="hidden sm:grid sm:grid-cols-3 gap-4 lg:gap-6 relative">
                                            @foreach (['closing_cargo', 'etd', 'eta'] as $index => $timeKey)
                                                <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200 relative z-10 text-center">
                                                    <div class="flex items-center justify-center mb-2">
                                                        <div
                                                            class="flex items-center justify-center w-8 h-8 rounded-full shadow-sm {{ $index == 0 ? 'bg-green-100 text-green-800' : ($index == 1 ? 'bg-blue-100 text-blue-800' : 'bg-blue-800 text-white') }}">
                                                            <i
                                                                class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }} text-xs"></i>
                                                        </div>
                                                    </div>
                                                    <p class="text-xs font-bold text-blue-800 mb-1">
                                                        {{ strtoupper(str_replace('_', ' ', $timeKey)) }}
                                                    </p>
                                                    <p class="font-bold text-gray-800 text-sm">
                                                        {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-0.5 flex items-center justify-center">
                                                        <i class="far fa-clock mr-1"></i>
                                                        {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>                                <!-- Admin Actions Section -->
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('edit-shipment', $shipment) }}" wire:navigate
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-blue-800 hover:bg-blue-700 text-white font-bold text-sm rounded-lg shadow-lg">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        <span>Edit</span>
                                    </a>
                                    <button wire:click="deleteShipment({{ $shipment->id }})"
                                        wire:confirm="Are you sure you want to delete this shipment?"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-lg shadow-lg">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 lg:p-10 text-center border border-gray-200">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-blue-100 rounded-full mb-4 sm:mb-6">
                        <i class="fas fa-ship text-3xl sm:text-4xl text-blue-900"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">No Shipments Available</h3>
                    <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto mb-4 sm:mb-6">There are no active shipments at the moment. Create your first shipment schedule to get started with managing your cargo operations.</p>
                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                        class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-blue-800 hover:bg-blue-700 text-white font-medium rounded-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Create Your First Shipment
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Define formatCurrency function globally, before DOMContentLoaded
    window.formatCurrency = function(input) {
        if (!input) return;

        // Get current cursor position
        let cursorPos = input.selectionStart;
        let oldValue = input.value;

        // Remove all non-numeric characters
        let rawValue = input.value.replace(/[^\d]/g, '');

        // Format with thousand separators (dots)
        let formattedValue = '';
        if (rawValue) {
            // Add thousand separators
            formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Only update if value actually changed
        if (formattedValue !== oldValue) {
            // Calculate new cursor position
            let dotsAdded = (formattedValue.match(/\./g) || []).length - (oldValue.match(/\./g) || []).length;
            let newCursorPos = cursorPos + dotsAdded;

            // Ensure cursor doesn't go beyond the end
            newCursorPos = Math.min(newCursorPos, formattedValue.length);

            // Update input value
            input.value = formattedValue;

            // Restore cursor position
            if (input === document.activeElement) {
                setTimeout(() => {
                    input.setSelectionRange(newCursorPos, newCursorPos);
                }, 0);
            }
        }
    };

    // Legacy function for backward compatibility
    window.formatNumber = function(input) {
        window.formatCurrency(input);
    };

    // Function to initialize freight formatting
    function initializeFreightFormatting() {
        console.log('Initializing freight formatting...');

        // Use both selectors for maximum compatibility
        const freightInputs = document.querySelectorAll(
            '.freight-input, input[wire\\:model\\.defer="freight_20"], input[wire\\:model\\.defer="freight_40"]');
        console.log('Found freight inputs:', freightInputs.length);

        freightInputs.forEach((input, index) => {
            console.log(`Processing input ${index + 1}:`, input.value);

            // Skip if already processed
            if (input.dataset.formatted === 'true') {
                return;
            }

            // Mark as processed
            input.dataset.formatted = 'true';

            // Add fresh event listeners using addEventListener (more reliable)
            input.addEventListener('input', function(e) {
                window.formatCurrency(e.target);
            }, {
                passive: true
            });

            input.addEventListener('blur', function(e) {
                window.formatCurrency(e.target);
            }, {
                passive: true
            });

            input.addEventListener('keyup', function(e) {
                // Only format on certain keys to avoid conflicts
                if (e.key !== 'ArrowLeft' && e.key !== 'ArrowRight' && e.key !== 'ArrowUp' && e.key !==
                    'ArrowDown') {
                    window.formatCurrency(e.target);
                }
            }, {
                passive: true
            });

            // Format existing value if it's a raw number
            if (input.value && /^\d+$/.test(input.value)) {
                console.log('Formatting existing value:', input.value);
                window.formatCurrency(input);
            }
        });
    }

    // Initialize immediately when script loads
    initializeFreightFormatting();

    // Multiple initialization strategies for maximum compatibility
    setTimeout(function() {
        console.log('Delayed initialization (100ms)');
        initializeFreightFormatting();
    }, 100);

    setTimeout(function() {
        console.log('Delayed initialization (500ms)');
        initializeFreightFormatting();
    }, 500);

    // Also initialize on DOMContentLoaded as backup
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOMContentLoaded fired');
        setTimeout(initializeFreightFormatting, 50);

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

    // Initialize for Livewire events
    document.addEventListener('livewire:load', function() {
        console.log('Livewire loaded');
        setTimeout(initializeFreightFormatting, 100);
    });

    document.addEventListener('livewire:update', function() {
        console.log('Livewire updated');
        setTimeout(initializeFreightFormatting, 100);
    });

    // For older Livewire versions
    document.addEventListener('livewire:component:loaded', function() {
        console.log('Livewire component loaded');
        setTimeout(initializeFreightFormatting, 100);
    });

    // Use MutationObserver as final fallback
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                const addedNodes = Array.from(mutation.addedNodes);
                const hasFreightInputs = addedNodes.some(node => {
                    if (node.nodeType === 1) { // Element node
                        return node.querySelector && (
                            node.querySelector('.freight-input') ||
                            node.querySelector(
                                'input[wire\\:model\\.defer="freight_20"]') ||
                            node.querySelector(
                                'input[wire\\:model\\.defer="freight_40"]') ||
                            (node.classList && node.classList.contains('freight-input'))
                        );
                    }
                    return false;
                });

                if (hasFreightInputs) {
                    console.log('Freight inputs detected via MutationObserver');
                    setTimeout(initializeFreightFormatting, 50);
                }
            }
        });
    });

    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Final fallback - check if window is fully loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initializeFreightFormatting, 100);
        });
    } else if (document.readyState === 'interactive') {
        setTimeout(initializeFreightFormatting, 50);
    } else {
        // Document is already complete
        initializeFreightFormatting();
    }

    // Window load event as ultimate fallback
    window.addEventListener('load', function() {
        console.log('Window fully loaded');
        setTimeout(initializeFreightFormatting, 100);
    });
</script>
