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
                                class="block w-full pl-3 sm:pl-4 pr-10 sm:pr-12 py-3 sm:py-4 border-2 {{ isset($error) ? 'border-red-500 focus:border-red-600' : 'border-gray-300 hover:border-blue-800 focus:border-blue-800' }} rounded-lg appearance-none bg-white shadow-sm transition-colors text-sm sm:text-base">
                                <option disabled {{ !request('pol') && !isset($old_pol) ? 'selected' : '' }}>Select Port of Loading</option>
                                @php
                                    $sortedFromCities = collect($fromCities)->sort()->values();
                                @endphp
                                @foreach ($sortedFromCities as $city)
                                    <option value="{{ $city }}" {{ request('pol') == $city || (isset($old_pol) && $old_pol == $city) ? 'selected' : '' }}>
                                        {{ strtoupper($city) }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>

                    <!-- Direction Icon -->
                    <div class="hidden lg:flex lg:col-span-2 justify-center items-center">
                        <div
                            class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-800 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fa-solid fa-ship text-white text-lg"></i>
                        </div>
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
                                class="block w-full pl-3 sm:pl-4 pr-10 sm:pr-12 py-3 sm:py-4 border-2 {{ isset($error) ? 'border-red-500 focus:border-red-600' : 'border-gray-300 hover:border-red-600 focus:border-red-600' }} rounded-lg appearance-none bg-white shadow-sm transition-colors text-sm sm:text-base">
                                <option disabled {{ !request('pod') && !isset($old_pod) ? 'selected' : '' }}>Select Port of Discharge</option>
                                @php
                                    $sortedToCities = collect($fromCities)->sort()->values();
                                @endphp
                                @foreach ($sortedToCities as $city)
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
                            class="w-full bg-blue-800 text-white py-3 sm:py-4 px-6 sm:px-8 rounded-lg hover:bg-blue-700 transition-colors font-bold flex items-center justify-center text-base sm:text-lg shadow-lg">
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
                            class="px-4 py-2 sm:px-5 sm:py-3 bg-blue-800 text-white rounded-full font-medium flex items-center shadow-sm text-sm sm:text-base">
                            <i class="fas fa-route mr-2"></i>
                            <span>{{ $shipments->count() }} routes found</span>
                        </div>
                    </div>

                    @if (isset($error))
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 sm:p-8 lg:p-10 text-center border border-gray-200">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-red-100 rounded-full mb-4 sm:mb-6">
                                <i class="fas fa-exclamation-triangle text-3xl sm:text-4xl text-red-600"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">
                                Invalid Route
                            </h3>
                            <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto mb-4 sm:mb-6">
                                The selected Port of Loading and Port of Discharge are the same. Please select different ports.
                            </p>
                            <a href="#"
                                onclick="document.getElementById('pol').selectedIndex = 0; document.getElementById('pod').selectedIndex = 0;"
                                class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                                <i class="fas fa-search mr-2"></i>
                                Try Another Route
                            </a>
                        </div>
                    @elseif ($shipments->isEmpty())
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 sm:p-8 lg:p-10 text-center border border-gray-200">
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
                                <i class="fas fa-search mr-2"></i>
                                Try Another Route
                            </a>
                        </div>
                    @else
                        <div class="space-y-4 sm:space-y-6">
                            @foreach ($shipments as $shipment)
                                <div
                                    class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow">
                                    <!-- Shipment Card Header -->
                                    <div
                                        class="relative bg-blue-800 text-white p-3 sm:p-4 lg:p-5">
                                        <div
                                            class="absolute top-0 right-0 w-12 h-12 sm:w-16 sm:h-16">
                                            <div
                                                class="absolute transform rotate-45 bg-green-600 text-center text-white font-semibold py-1 right-[-25px] sm:right-[-30px] top-[20px] sm:top-[24px] w-[120px] sm:w-[140px] shadow-md text-xs">
                                                Available
                                            </div>
                                        </div>

                                        <div class="pr-8 sm:pr-12">
                                            <h3
                                                class="text-lg sm:text-xl lg:text-2xl font-bold mb-2 break-words">
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

                                    <div class="p-3 sm:p-4 lg:p-5">
                                        <!-- Timeline Section -->
                                        <div
                                            class="bg-gray-50 rounded-lg p-3 sm:p-4 lg:p-5 mb-4 sm:mb-5 border border-gray-200">
                                            <h4
                                                class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 mb-3 sm:mb-4 flex items-center">
                                                <i
                                                    class="fas fa-calendar-alt text-blue-800 mr-1.5 sm:mr-2 text-xs sm:text-sm lg:text-base"></i>
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
                                                    @foreach (['open stack', 'etd', 'eta'] as $index => $timeKey)
                                                        <div
                                                            class="flex items-center space-x-4 relative z-10">
                                                            <!-- Timeline dot -->
                                                            <div
                                                                class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center shadow-md {{ $index == 0 ? 'bg-blue-100 text-blue-800' : 'bg-blue-800 text-white' }}">
                                                                <i
                                                                    class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }} text-sm"></i>
                                                            </div>

                                                            <!-- Content -->
                                                            <div class="flex-1 bg-white rounded-lg p-3 shadow-sm border border-gray-200">
                                                                <p
                                                                    class="text-sm font-bold text-blue-800 mb-1">
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
                                                    @foreach (['open stack', 'etd', 'eta'] as $index => $timeKey)
                                                        <div
                                                            class="bg-white rounded-lg p-4 shadow-md border border-gray-200 relative z-10 hover:border-blue-800 transition-colors text-center">
                                                            <div class="flex items-center justify-center mb-3">
                                                                <div
                                                                    class="flex items-center justify-center w-10 h-10 rounded-full shadow-md {{ $index == 0 ? 'bg-blue-100 text-blue-800' : 'bg-blue-800 text-white' }}">
                                                                    <i
                                                                        class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }} text-sm"></i>
                                                                </div>
                                                            </div>
                                                            <p
                                                                class="text-sm font-bold text-blue-800 mb-2">
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
                                                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-3 lg:px-10 lg:py-3 bg-blue-800 text-white font-bold text-sm sm:text-base lg:text-lg rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                                                <span class="mr-2">Book</span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 sm:h-5 sm:w-5"
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
