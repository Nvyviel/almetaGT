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
            'makassar',
            'morowali',
            'kendari',
            'pomala',
            'ternate',
            'jayapura',
            'kupang',
            'sorong',
            'manokwari',
            'merauke',
            'bau-bau',
            'maumere',
            'tual',
            'fak-fak',
            'bintuni',
            'nabire',
            'serui',
        ];
    @endphp

    <!-- Success Alert -->
    @if (session('success'))
        <div id="success-alert"
            class="fixed top-4 right-4 z-50 flex items-center justify-between bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="document.getElementById('success-alert').style.display='none'"
                class="text-green-600 hover:text-green-800 focus:outline-none ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Search Form Section -->
    <div class="py-6 sm:py-8 lg:py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-6 sm:mb-8 lg:mb-10">
                <span
                    class="inline-block px-3 py-1.5 bg-blue-800 text-white text-xs sm:text-sm font-medium rounded-full mb-3">Search
                    Routes</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-2 sm:mb-3">
                    Find Your Perfect Shipping Route
                </h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">Select ports and discover available
                    shipments with competitive rates</p>
            </div>

            <!-- Search Form -->
            <form action="{{ route('dashboard') }}#result" method="GET"
                class="bg-white rounded-xl shadow-lg p-4 sm:p-6 lg:p-8 mb-8 sm:mb-12 border border-gray-200"
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
                        <label for="pol" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="flex items-center">
                                <i class="fas fa-anchor text-blue-800 mr-2"></i>
                                Port of Loading (POL)
                            </span>
                        </label>
                        <div class="relative">
                            <select name="pol" id="pol"
                                class="block w-full pl-3 pr-8 py-2 border-2 {{ isset($error) ? 'border-red-500 focus:border-red-600' : 'border-gray-300 hover:border-blue-800 focus:border-blue-800' }} rounded-md appearance-none bg-white shadow-sm transition-colors text-sm">
                                <option disabled {{ !request('pol') && !isset($old_pol) ? 'selected' : '' }}>Select Port of
                                    Loading</option>
                                @php
                                    $sortedFromCities = collect($fromCities)->sort()->values();
                                @endphp
                                @foreach ($sortedFromCities as $city)
                                    <option value="{{ $city }}"
                                        {{ request('pol') == $city || (isset($old_pol) && $old_pol == $city) ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <!-- Route Swap Button - Hidden on mobile, visible on large screens -->
                    <div class="hidden lg:flex lg:col-span-2 justify-center items-center">
                        <button type="button" id="swapRouteBtn" onclick="swapPorts()"
                            class="group w-12 h-12 lg:w-14 lg:h-14 bg-blue-800 hover:bg-red-600 rounded-full flex items-center justify-center shadow-lg transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <i
                                class="fas fa-exchange-alt text-white text-sm lg:text-base group-hover:rotate-180 transition-transform duration-300"></i>
                        </button>
                    </div>

                    <!-- Mobile Route Swap Button - Only visible on mobile -->
                    <div class="flex lg:hidden justify-center py-2 lg:col-span-12">
                        <button type="button" onclick="swapPorts()"
                            class="group w-10 h-10 bg-blue-800 hover:bg-red-600 rounded-full flex items-center justify-center shadow-md transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <i
                                class="fas fa-exchange-alt text-white text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                        </button>
                    </div>

                    <!-- POD Selection -->
                    <div class="lg:col-span-5">
                        <label for="pod" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="flex items-center">
                                <i class="fas fa-anchor text-red-600 mr-2"></i>
                                Port of Discharge (POD)
                            </span>
                        </label>
                        <div class="relative">
                            <select name="pod" id="pod"
                                class="block w-full pl-3 pr-8 py-2 border-2 {{ isset($error) ? 'border-red-500 focus:border-red-600' : 'border-gray-300 hover:border-red-600 focus:border-red-600' }} rounded-md appearance-none bg-white shadow-sm transition-colors text-sm">
                                <option disabled {{ !request('pod') && !isset($old_pod) ? 'selected' : '' }}>Select Port of
                                    Discharge</option>
                                @php
                                    $sortedToCities = collect($fromCities)->sort()->values();
                                @endphp
                                @foreach ($sortedToCities as $city)
                                    <option value="{{ $city }}"
                                        {{ request('pod') == $city || (isset($old_pod) && $old_pod == $city) ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="lg:col-span-12 pt-2 sm:pt-4">
                        <button id="submitButton" type="submit"
                            class="w-full bg-blue-800 text-white py-2.5 px-6 rounded-md hover:bg-blue-700 transition-colors font-semibold flex items-center justify-center text-sm shadow-md">
                            <span id="buttonText">Find Available Ships</span>
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
                            class="px-4 py-2 sm:px-5 sm:py-3 bg-blue-800 text-white rounded-full font-medium flex items-center shadow-sm text-sm sm:text-base">
                            <i class="fas fa-route mr-2"></i>
                            <span>{{ $shipments->count() }} routes found</span>
                        </div>
                    </div>

                    @if (isset($error))
                        <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 lg:p-10 text-center border border-gray-200">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-red-100 rounded-full mb-4 sm:mb-6">
                                <i class="fas fa-exclamation-triangle text-3xl sm:text-4xl text-red-600"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">
                                Invalid Route
                            </h3>
                            <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto mb-4 sm:mb-6">
                                The selected Port of Loading and Port of Discharge are the same. Please select different
                                ports.
                            </p>
                            <a href="#"
                                onclick="document.getElementById('pol').selectedIndex = 0; document.getElementById('pod').selectedIndex = 0;"
                                class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                                Try Another Route
                            </a>
                        </div>
                    @elseif ($shipments->isEmpty())
                        <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 lg:p-10 text-center border border-gray-200">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-blue-100 rounded-full mb-4 sm:mb-6">
                                <i class="fas fa-ship text-3xl sm:text-4xl text-blue-900"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">No
                                Routes Available</h3>
                            <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto mb-4 sm:mb-6">We couldn't
                                find any shipments
                                for the selected route. Please try different ports or check back later.</p>
                            <a href="#filtering"
                                class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-blue-800 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                Try Another Route
                            </a>
                        </div>
                    @else
                        <div class="space-y-4 sm:space-y-6">
                            @foreach ($shipments as $shipment)
                                <div
                                    class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow">
                                    <!-- Shipment Card Header -->
                                    <div class="relative bg-blue-800 text-white p-3 sm:p-4">
                                        <div class="absolute top-0 right-0 w-10 h-10 sm:w-12 sm:h-12">
                                            <div
                                                class="absolute transform rotate-45 bg-green-600 text-center text-white font-semibold py-0.5 right-[-20px] sm:right-[-25px] top-[16px] sm:top-[20px] w-[100px] sm:w-[120px] shadow-md text-xs">
                                                Available
                                            </div>
                                        </div>

                                        <div class="pr-6 sm:pr-8">
                                            <div class="flex flex-wrap items-baseline gap-2 mb-1.5">
                                                <h3 class="text-base sm:text-lg lg:text-xl font-bold break-words">
                                                    {{ $shipment->vessel_name }}
                                                </h3>
                                                <div
                                                    class="flex items-center text-white text-xs bg-red-600 px-2.5 py-1.5 rounded-full">
                                                    <svg class="h-2.5 w-2.5 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span
                                                        class="font-medium text-xs">{{ \Carbon\Carbon::parse($shipment->open_stack)->format('d M Y - H:i') }}</span>
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
                                                                class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center shadow-sm {{ $index == 0 ? 'bg-blue-100 text-blue-800' : 'bg-blue-800 text-white' }}">
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
                                                        <div
                                                            class="bg-white rounded-lg p-3 shadow-sm border border-gray-200 relative z-10 hover:border-blue-800 transition-colors text-center">
                                                            <div class="flex items-center justify-center mb-2">
                                                                <div
                                                                    class="flex items-center justify-center w-8 h-8 rounded-full shadow-sm {{ $index == 0 ? 'bg-blue-100 text-blue-800' : 'bg-blue-800 text-white' }}">
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
                                                            <p
                                                                class="text-xs text-gray-500 mt-0.5 flex items-center justify-center">
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
                                            <a href="{{ route('booking', ['shipment_id' => $shipment->shipment_id]) }}"
                                                class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-blue-800 text-white font-semibold text-sm rounded-md hover:bg-blue-700 transition-colors shadow-md">
                                                <span class="mr-2">Book</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
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
                <div class="bg-white rounded-xl shadow-lg p-6 text-center mt-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"
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
        // Function to save POL/POD values to localStorage
        function savePortSelections() {
            const polSelect = document.getElementById('pol');
            const podSelect = document.getElementById('pod');

            if (polSelect && podSelect) {
                const searchData = {
                    pol: polSelect.value,
                    pod: podSelect.value,
                    timestamp: new Date().getTime(),
                    url: window.location.href
                };

                // Save to localStorage
                localStorage.setItem('almetagt_search_data', JSON.stringify(searchData));
                console.log('Search data saved:', searchData);
            }
        }

        // Function to restore POL/POD values from localStorage and server session
        function restorePortSelections() {
            try {
                const polSelect = document.getElementById('pol');
                const podSelect = document.getElementById('pod');

                if (!polSelect || !podSelect) return;

                let shouldAutoSearch = false;
                let restoredPol = '';
                let restoredPod = '';

                // First, try to get data from server session (higher priority)
                @if (isset($savedSearchData) && !empty($savedSearchData))
                    const serverData = @json($savedSearchData);
                    if (serverData && serverData.pol && serverData.pod) {
                        // Server data exists, use it
                        if (serverData.pol !== 'Select Port of Loading' && serverData.pol !== '') {
                            polSelect.value = serverData.pol;
                            restoredPol = serverData.pol;
                        }
                        if (serverData.pod !== 'Select Port of Discharge' && serverData.pod !== '') {
                            podSelect.value = serverData.pod;
                            restoredPod = serverData.pod;
                        }

                        if (restoredPol && restoredPod) {
                            shouldAutoSearch = true;
                        }

                        console.log('Search data restored from server:', serverData);

                        // Update localStorage with server data
                        const searchData = {
                            pol: serverData.pol,
                            pod: serverData.pod,
                            timestamp: serverData.timestamp || new Date().getTime(),
                            source: 'server'
                        };
                        localStorage.setItem('almetagt_search_data', JSON.stringify(searchData));
                    }
                @endif

                // Fallback to localStorage if no server data and no search performed yet
                if (!shouldAutoSearch) {
                    const savedData = localStorage.getItem('almetagt_search_data');
                    if (savedData) {
                        const searchData = JSON.parse(savedData);

                        if (searchData.pol && searchData.pod) {
                            // Check if the saved data is not older than 24 hours
                            const hoursDiff = (new Date().getTime() - searchData.timestamp) / (1000 * 60 * 60);

                            if (hoursDiff < 24) {
                                if (searchData.pol !== 'Select Port of Loading' && searchData.pol !== '') {
                                    polSelect.value = searchData.pol;
                                    restoredPol = searchData.pol;
                                }
                                if (searchData.pod !== 'Select Port of Discharge' && searchData.pod !== '') {
                                    podSelect.value = searchData.pod;
                                    restoredPod = searchData.pod;
                                }

                                if (restoredPol && restoredPod) {
                                    shouldAutoSearch = true;
                                }

                                console.log('Search data restored from localStorage:', searchData);
                            } else {
                                // Clear old data
                                localStorage.removeItem('almetagt_search_data');
                            }
                        }
                    }
                }

                // Auto-submit form if we have both POL and POD restored
                // But only if no search results are currently displayed (to prevent infinite loops)
                const hasCurrentResults = document.getElementById('result') ||
                    document.querySelector('.space-y-4.sm\\:space-y-6') ||
                    window.location.search.includes('pol=') ||
                    window.location.search.includes('pod=');

                if (shouldAutoSearch && restoredPol && restoredPod && restoredPol !== restoredPod && !hasCurrentResults) {
                    // Show loading indicator
                    const submitButton = document.getElementById('submitButton');
                    const buttonText = document.getElementById('buttonText');
                    const loadingSpinner = document.getElementById('loadingSpinner');

                    if (submitButton && buttonText && loadingSpinner) {
                        submitButton.disabled = true;
                        buttonText.textContent = 'Loading Previous Search...';
                        loadingSpinner.classList.remove('hidden');
                    }

                    setTimeout(() => {
                        console.log('Auto-submitting search form with restored data:', {
                            pol: restoredPol,
                            pod: restoredPod
                        });

                        // Create and submit form with restored data
                        const currentUrl = new URL(window.location.href);
                        currentUrl.searchParams.set('pol', restoredPol);
                        currentUrl.searchParams.set('pod', restoredPod);
                        currentUrl.hash = 'result';

                        // Redirect to show results
                        window.location.href = currentUrl.toString();
                    }, 800); // Small delay to ensure DOM is ready
                }
            } catch (error) {
                console.log('Error restoring search data:', error);
            }
        }

        // Function to send search data to server (for logged-in users)
        function sendSearchDataToServer() {
            const savedData = localStorage.getItem('almetagt_search_data');
            if (savedData) {
                const searchData = JSON.parse(savedData);

                // Send to server via fetch API
                fetch('{{ route('save-search-data') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content') || '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            pol: searchData.pol,
                            pod: searchData.pod,
                            timestamp: searchData.timestamp
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Search data saved to server successfully');
                        }
                    })
                    .catch(error => {
                        console.log('Error saving search data to server:', error);
                    });
            }
        }

        // Function to swap POL and POD values
        window.swapPorts = function() {
            const polSelect = document.getElementById('pol');
            const podSelect = document.getElementById('pod');

            if (polSelect && podSelect) {
                // Get current values (store them before swapping)
                const polValue = polSelect.value;
                const podValue = podSelect.value;

                // Simply swap the values - no validation needed
                // This allows swapping even with empty/default values
                polSelect.value = podValue;
                podSelect.value = polValue;

                // Save the swapped values
                savePortSelections();

                // Add visual feedback - temporary animation
                const swapBtn = document.getElementById('swapRouteBtn') || event.target.closest('button');
                if (swapBtn) {
                    // Rotate animation
                    swapBtn.style.transform = 'rotate(180deg)';
                    setTimeout(() => {
                        swapBtn.style.transform = 'rotate(0deg)';
                    }, 300);
                }

                // Log the swap action for debugging
                console.log('Ports swapped successfully:', {
                    'POL': polValue + ' → ' + podValue,
                    'POD': podValue + ' → ' + polValue
                });
            }
        };

        // Initialize port selections restoration and save listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Restore saved port selections on page load
            setTimeout(restorePortSelections, 100);

            // Add change listeners to save data when user selects ports
            const polSelect = document.getElementById('pol');
            const podSelect = document.getElementById('pod');

            if (polSelect) {
                polSelect.addEventListener('change', function() {
                    savePortSelections();
                });
            }

            if (podSelect) {
                podSelect.addEventListener('change', function() {
                    savePortSelections();
                });
            }

            // For logged-in users, send existing localStorage data to server on page load
            setTimeout(function() {
                const savedData = localStorage.getItem('almetagt_search_data');
                if (savedData) {
                    try {
                        const searchData = JSON.parse(savedData);
                        // Send to server if data exists and is recent
                        const hoursDiff = (new Date().getTime() - searchData.timestamp) / (1000 * 60 * 60);
                        if (hoursDiff < 24 && searchData.pol && searchData.pod) {
                            sendSearchDataToServer();
                        }
                    } catch (error) {
                        console.log('Error processing stored search data:', error);
                    }
                }
            }, 500);
        });

        function handleFormSubmit(event) {
            event.preventDefault();

            // Save current search data before form submission
            savePortSelections();

            const submitButton = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');

            setTimeout(() => {
                event.target.submit();
            }, 300);
        }
    </script>

    <style>
        /* Route Swap Button Styles */
        #swapRouteBtn,
        button[onclick="swapPorts()"] {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        #swapRouteBtn:hover,
        button[onclick="swapPorts()"]:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        #swapRouteBtn:active,
        button[onclick="swapPorts()"]:active {
            transform: scale(0.95);
        }

        #swapRouteBtn:focus,
        button[onclick="swapPorts()"]:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
    </style>
@endsection
