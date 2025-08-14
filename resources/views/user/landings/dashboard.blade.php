@extends('layouts.main')

@section('title', 'Dashboard')
@section('component')
    @php
        $fromCities = [
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
            'ambon',
        ];
    @endphp

    <!-- Success Alert with animation -->
    @if (session('success'))
        <div id="success-alert"
            class="fixed top-4 right-4 z-50 flex items-center justify-between bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="document.getElementById('success-alert').classList.add('translate-x-full', 'opacity-0')"
                class="text-green-600 hover:text-green-800 focus:outline-none ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Search Form Section - EXACT COPY FROM FIRST CODE -->
    <div class="py-8 sm:py-12 lg:py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-10 lg:mb-14">
                <span
                    class="inline-block px-3 py-1.5 bg-blue-100 text-blue-800 text-xs sm:text-sm font-medium rounded-full mb-3 animate-pulse">Search
                    Routes</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-2 sm:mb-3">
                    Find Your Perfect Shipping Route
                </h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">Select ports and discover available
                    shipments with competitive rates</p>
            </div>

            <!-- Search Form with floating effect -->
            <form action="{{ route('dashboard') }}#result" method="GET"
                class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl p-4 sm:p-6 lg:p-10 mb-10 sm:mb-16 border border-gray-100 transform hover:translate-y-[-5px] transition-all duration-300"
                onsubmit="handleFormSubmit(event)">
                @csrf

                <!-- Error Message Display -->
                @if (isset($error))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ $error }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-5 items-end">
                    <!-- POL Selection -->
                    <div class="lg:col-span-5">
                        <label for="pol" class="block mb-2 text-sm font-bold text-gray-700">
                            <span class="flex items-center">
                                <i class="fas fa-anchor text-blue-600 mr-2"></i>
                                Port of Loading (POL)
                            </span>
                        </label>
                        <div class="relative group">
                            <select name="pol" id="pol"
                                class="block w-full pl-3 sm:pl-4 pr-10 sm:pr-12 py-3 sm:py-4 border-2 {{ isset($error) ? 'border-red-300 focus:border-red-500 focus:ring-red-100' : 'border-gray-200 hover:border-blue-400 focus:border-blue-500 focus:ring-blue-100' }} rounded-lg sm:rounded-xl focus:ring-4 appearance-none bg-white shadow-sm transition-colors text-sm sm:text-base">
                                <option disabled {{ !request('pol') && !isset($old_pol) ? 'selected' : '' }}>Select Port of Loading</option>
                                @foreach ($fromCities as $city)
                                    <option value="{{ $city }}" {{ request('pol') == $city || (isset($old_pol) && $old_pol == $city) ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>

                    <!-- Direction Icon with pulse animation -->
                    <div class="hidden lg:flex lg:col-span-2 justify-center items-center">
                        <div
                            class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-30"></span>
                            <i class="fa-solid fa-ship text-white text-lg"></i>
                        </div>
                    </div>

                    <!-- POD Selection -->
                    <div class="lg:col-span-5">
                        <label for="pod" class="block mb-2 text-sm font-bold text-gray-700">
                            <span class="flex items-center">
                                <i class="fas fa-anchor text-red-600 mr-2"></i>
                                Port of Discharge (POD)
                            </span>
                        </label>
                        <div class="relative group">
                            <select name="pod" id="pod"
                                class="block w-full pl-3 sm:pl-4 pr-10 sm:pr-12 py-3 sm:py-4 border-2 {{ isset($error) ? 'border-red-300 focus:border-red-500 focus:ring-red-100' : 'border-gray-200 hover:border-red-400 focus:border-red-500 focus:ring-red-100' }} rounded-lg sm:rounded-xl focus:ring-4 appearance-none bg-white shadow-sm transition-colors text-sm sm:text-base">
                                <option disabled {{ !request('pod') && !isset($old_pod) ? 'selected' : '' }}>Select Port of Discharge</option>
                                @foreach ($fromCities as $city)
                                    <option value="{{ $city }}" {{ request('pod') == $city || (isset($old_pod) && $old_pod == $city) ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="lg:col-span-12 pt-2 sm:pt-4">
                        <button id="submitButton" type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 sm:py-4 px-6 sm:px-8 rounded-lg sm:rounded-xl hover:from-blue-500 hover:to-blue-800 transition-all duration-300 font-bold flex items-center justify-center text-base sm:text-lg shadow-lg hover:shadow-blue-200">
                            <span id="buttonText" class="mr-2">Find Available Ships</span>
                            <i class="fas fa-search"></i>
                            <span id="loadingSpinner" class="hidden ml-2">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Results Section -->
            @if (request('pol') && request('pod'))
                <div class="space-y-6 sm:space-y-8" id="result">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 sm:mb-8 gap-3">
                        <div>
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">Available Shipments
                            </h2>
                            <p class="text-gray-500 mt-1">From {{ strtoupper(request('pol')) }} to
                                {{ strtoupper(request('pod')) }}</p>
                        </div>
                        <div
                            class="px-4 py-2 sm:px-5 sm:py-3 bg-gradient-to-r from-blue-100 to-blue-50 text-blue-800 rounded-full font-medium flex items-center shadow-sm text-sm sm:text-base">
                            <i class="fas fa-route mr-2"></i>
                            <span>{{ $shipments->count() }} routes found</span>
                        </div>
                    </div>

                    @if (isset($error))
                        <div
                            class="bg-white rounded-xl shadow-lg sm:shadow-xl p-6 sm:p-10 lg:p-16 text-center border border-gray-100">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-red-100 rounded-full mb-4 sm:mb-6 animate-pulse">
                                <i class="fas fa-exclamation-triangle text-3xl sm:text-4xl lg:text-5xl text-red-600"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">
                                Invalid Route
                            </h3>
                            <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto mb-4 sm:mb-6">
                                The selected Port of Loading and Port of Discharge are the same. Please select different ports.
                            </p>
                            <a href="#"
                                onclick="document.getElementById('pol').selectedIndex = 0; document.getElementById('pod').selectedIndex = 0;"
                                class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-red-100 hover:bg-red-200 text-red-800 font-medium rounded-lg transition-colors">
                                <i class="fas fa-search mr-2"></i>
                                Try Another Route
                            </a>
                        </div>
                    @elseif ($shipments->isEmpty())
                        <div
                            class="bg-white rounded-xl shadow-lg sm:shadow-xl p-6 sm:p-10 lg:p-16 text-center border border-gray-100">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-blue-50 rounded-full mb-4 sm:mb-6 animate-pulse">
                                <i class="fas fa-ship text-3xl sm:text-4xl lg:text-5xl text-blue-300"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">No
                                Routes Available</h3>
                            <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto mb-4 sm:mb-6">We couldn't
                                find any shipments
                                for the selected route. Please try different ports or check back later.</p>
                            <a href="#filtering"
                                class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium rounded-lg transition-colors">
                                <i class="fas fa-search mr-2"></i>
                                Try Another Route
                            </a>
                        </div>
                    @else
                        <div class="space-y-4 sm:space-y-6 lg:space-y-8">
                            @foreach ($shipments as $shipment)
                                <div
                                    class="bg-white rounded-md shadow-md sm:shadow-lg overflow-hidden border border-gray-100 hover:shadow-lg sm:hover:shadow-xl transition-all duration-300 transform hover:scale-[1.01] group">
                                    <!-- Shipment Card Header -->
                                    <div
                                        class="relative bg-gradient-to-r from-blue-600 to-blue-700 text-white p-3 sm:p-4 lg:p-6">
                                        <div
                                            class="absolute top-0 right-0 w-12 h-12 sm:w-16 sm:h-16 lg:w-20 lg:h-20">
                                            <div
                                                class="absolute transform rotate-45 bg-gradient-to-r from-green-500 to-green-400 text-center text-white font-semibold py-1 right-[-25px] sm:right-[-30px] lg:right-[-35px] top-[20px] sm:top-[24px] lg:top-[28px] w-[120px] sm:w-[140px] lg:w-[170px] shadow-md text-xs">
                                                Available
                                            </div>
                                        </div>

                                        <div class="pr-8 sm:pr-12 lg:pr-16">
                                            <h3
                                                class="text-lg sm:text-xl lg:text-2xl xl:text-3xl font-bold mb-2 break-words">
                                                {{ $shipment->vessel_name }}
                                            </h3>
                                            <div
                                                class="flex flex-col sm:flex-row sm:items-center text-white text-sm lg:text-base xl:text-lg">
                                                <span
                                                    class="font-medium">{{ strtoupper($shipment->from_city) }}</span>

                                                <!-- Mobile Route Indicator -->
                                                <div class="flex sm:hidden items-center justify-center my-2">
                                                    <div class="flex flex-col items-center space-y-1">
                                                    </div>
                                                </div>

                                                <!-- Desktop Route Indicator -->
                                                <div class="hidden sm:flex items-center mx-2 lg:mx-3 space-x-1">
                                                    <span
                                                        class="w-1.5 h-1.5 lg:w-2 lg:h-2 bg-white rounded-full"></span>
                                                    <span class="w-8 lg:w-16 h-0.5 bg-white"></span>
                                                    <span
                                                        class="w-1.5 h-1.5 lg:w-2 lg:h-2 bg-white rounded-full"></span>
                                                </div>

                                                <span
                                                    class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-3 sm:p-4 lg:p-6 xl:p-8">
                                        <!-- Timeline Section -->
                                        <div
                                            class="bg-gradient-to-r from-gray-50 to-white rounded-md p-3 sm:p-4 lg:p-6 mb-4 sm:mb-6 lg:mb-8 border border-gray-200 shadow-sm">
                                            <h4
                                                class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 mb-3 sm:mb-4 lg:mb-6 flex items-center">
                                                <i
                                                    class="fas fa-calendar-alt text-blue-600 mr-1.5 sm:mr-2 text-xs sm:text-sm lg:text-base"></i>
                                                <span class="text-sm sm:text-base lg:text-lg">Voyage
                                                    Schedule</span>
                                            </h4>

                                            <div class="relative">
                                                <!-- Desktop Timeline bar -->
                                                <div
                                                    class="hidden sm:block absolute top-1/2 left-0 right-0 h-1 bg-gray-200 transform -translate-y-1/2 z-0 mx-12 lg:mx-16 xl:mx-20">
                                                </div>

                                                <!-- Mobile: Vertical Timeline -->
                                                <div
                                                    class="sm:hidden absolute left-6 top-16 bottom-16 w-0.5 bg-gray-200 z-0">
                                                </div>

                                                <!-- Mobile: Connect lines between timeline items -->
                                                <div
                                                    class="sm:hidden space-y-6 relative">
                                                    @foreach (['etb', 'etd', 'eta'] as $index => $timeKey)
                                                        <div
                                                            class="flex items-center space-x-4 relative z-10">
                                                            <!-- Timeline dot -->
                                                            <div
                                                                class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center {{ $index == 0 ? 'bg-blue-100 text-blue-500' : ($index == 1 ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white' : 'bg-gradient-to-r from-blue-600 to-blue-700 text-white') }} shadow-md">
                                                                <i
                                                                    class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }} text-sm"></i>
                                                            </div>

                                                            <!-- Content -->
                                                            <div class="flex-1 bg-white rounded-lg p-3 shadow-sm border border-gray-100">
                                                                <p
                                                                    class="text-sm font-bold {{ $index == 0 ? 'text-blue-500' : ($index == 1 ? 'text-blue-600' : 'text-blue-700') }} mb-1">
                                                                    {{ strtoupper($timeKey) }}
                                                                </p>
                                                                <p class="font-bold text-gray-800 text-base">
                                                                    {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                                </p>
                                                                <p class="text-xs text-gray-500 mt-1 flex items-center">
                                                                    <i class="far fa-clock mr-1"></i>
                                                                    {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Desktop Timeline -->
                                                <div
                                                    class="hidden sm:grid sm:grid-cols-3 gap-6 lg:gap-10 relative">
                                                    @foreach (['etb', 'etd', 'eta'] as $index => $timeKey)
                                                        <div
                                                            class="bg-white rounded-lg p-4 shadow-md border border-gray-100 relative z-10 group hover:border-blue-200 transition-all duration-300 hover:shadow-lg text-center">
                                                            <div class="flex items-center justify-center mb-3">
                                                                <div
                                                                    class="flex items-center justify-center w-10 h-10 rounded-full {{ $index == 0 ? 'bg-blue-100 text-blue-500' : ($index == 1 ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white' : 'bg-gradient-to-r from-blue-600 to-blue-700 text-white') }} shadow-md group-hover:scale-110 transition-transform duration-300">
                                                                    <i
                                                                        class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }} text-sm"></i>
                                                                </div>
                                                            </div>
                                                            <p
                                                                class="text-sm font-bold {{ $index == 0 ? 'text-blue-500' : ($index == 1 ? 'text-blue-600' : 'text-blue-700') }} mb-2">
                                                                {{ strtoupper($timeKey) }}
                                                            </p>
                                                            <p class="font-bold text-gray-800 text-lg">
                                                                {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 mt-1 flex items-center justify-center">
                                                                <i class="far fa-clock mr-1"></i>
                                                                {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Book Now Button -->
                                        <div class="flex justify-center">
                                            <a href="{{ route('booking', ['shipment_id' => $shipment->id]) }}"
                                                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-3 lg:px-12 lg:py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold text-sm sm:text-base lg:text-lg rounded-md hover:from-blue-500 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-blue-200 group active:scale-95">
                                                <span class="mr-2">Book</span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 sm:h-5 sm:w-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <!-- Empty state when no search performed -->
                <div class="bg-white rounded-xl shadow-md p-8 text-center mt-8">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Start Your Search</h3>
                    <p class="text-gray-600 max-w-md mx-auto">Select your departure and arrival ports above to find
                        available
                        shipments.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function handleFormSubmit(event) {
            event.preventDefault();
            const submitButton = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            event.target.submit();
        }
    </script>
@endsection
