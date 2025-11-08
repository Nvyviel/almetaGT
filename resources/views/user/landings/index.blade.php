<x-guest-layout>
    @section('title-guest', 'Almeta Global Trilindo')

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

    <div class="min-h-screen bg-white relative overflow-hidden">
        <!-- Navigation -->
        <nav class="border-b border-gray-100 bg-white fixed w-full top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-14 md:h-16 relative">
                    <!-- Logo Section -->
                    <div class="flex items-center relative z-10 flex-shrink-0">
                        <a href="#" class="flex items-center">
                            <img src="{{ asset('assets/img/Kop Surat Almeta Global Trilindo For Websites (BG Removed).png') }}" alt="Almeta Logo"
                                class="h-7 md:h-10 w-auto max-w-[230px] object-contain">
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div
                        class="hidden md:flex items-center space-x-4 lg:space-x-5 absolute left-1/2 transform -translate-x-1/2">
                        <a href="#"
                            class="text-gray-600 hover:text-blue-800 font-medium whitespace-nowrap">Home</a>
                        <a href="#filtering"
                            class="text-gray-600 hover:text-blue-800 font-medium whitespace-nowrap">Find Routes</a>
                        <a href="#features" class="text-gray-600 hover:text-blue-800 font-medium whitespace-nowrap">Why
                            Us</a>
                        <a href="#contact"
                            class="text-gray-600 hover:text-blue-800 font-medium whitespace-nowrap">Contact</a>
                    </div>

                    <!-- Desktop Login Button -->
                    <div class="hidden md:flex items-center flex-shrink-0">
                        <a href="{{ route('login') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 border-2 border-blue-800 text-sm font-semibold rounded-lg text-blue-800 hover:bg-blue-800 hover:text-white">
                            <i class="fas fa-user mr-1.5"></i>
                            <span>Login</span>
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center ml-4">
                        <button type="button" id="mobile-menu-button"
                            class="text-gray-600 hover:text-blue-800 focus:outline-none p-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-gray-200 shadow-sm">
                <div class="px-4 py-2 space-y-1">
                    <a href="#"
                        class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-blue-800 hover:bg-gray-50">Home</a>
                    <a href="#filtering"
                        class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-blue-800 hover:bg-gray-50">Find
                        Routes</a>
                    <a href="#features"
                        class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-blue-800 hover:bg-gray-50">Why
                        Us</a>
                    <a href="#contact"
                        class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-blue-800 hover:bg-gray-50">Contact</a>
                    <div class="pt-2 pb-1">
                        <a href="{{ route('login') }}" wire:navigate
                            class="inline-flex w-full items-center justify-center px-4 py-2 border-2 border-blue-800 text-sm font-semibold rounded-lg text-blue-800 hover:bg-blue-800 hover:text-white">
                            <i class="fas fa-user mr-1.5"></i>
                            <span>Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Feedback Success Alert -->
        @if (session('feedback_success'))
            <div id="feedback-success-alert"
                class="fixed top-20 right-4 z-50 flex items-center justify-between bg-blue-100 border-l-4 border-blue-800 text-blue-800 p-4 rounded-lg shadow-lg max-w-sm"
                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)">
                <div class="flex items-center">
                    <i class="fas fa-comment-dots mr-3 text-blue-800"></i>
                    <span class="font-medium text-sm">{{ session('feedback_success') }}</span>
                </div>
                <button onclick="document.getElementById('feedback-success-alert').style.display='none'"
                    class="text-blue-600 hover:text-blue-800 focus:outline-none ml-4 flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Hero Section -->
        <div class="pt-16 md:pt-18 relative min-h-[55vh] sm:min-h-[60vh] lg:min-h-[65vh] flex items-center"
            style="background: linear-gradient(rgba(30, 64, 175, 0.7), rgba(30, 64, 175, 0.8)), url('{{ asset('assets/img/1st-birth-almeta.png') }}'); 
                    background-size: cover; 
                    background-position: center; 
                    background-repeat: no-repeat;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
                <div class="py-8 sm:py-12 lg:py-16">
                    <!-- Centered Content -->
                    <div class="text-center max-w-4xl mx-auto">
                        <h1
                            class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white mb-3 sm:mb-4">
                            Logistics Solutions
                        </h1>
                        <div>
                            <p
                                class="text-base sm:text-lg md:text-xl text-white leading-relaxed font-medium mb-3 sm:mb-4">
                                <span class="border-b-2 border-red-600 pb-1">Fast, Secure & Trusted</span>
                                <span class="block sm:inline mt-1 sm:mt-0"> freight forwarding services for your cargo
                                    needs.</span>
                            </p>
                            <p
                                class="text-sm sm:text-base md:text-lg text-blue-100 leading-relaxed max-w-3xl mx-auto mb-6 sm:mb-8">
                                Professional EMKL services connecting businesses across Indonesia with comprehensive
                                land & sea freight solutions. Your trusted logistics partner for efficient cargo
                                delivery.
                            </p>
                        </div>
                        <div
                            class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center max-w-lg mx-auto">
                            <a href="#filtering"
                                class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold rounded-md text-white bg-red-600 hover:bg-red-700 shadow-md w-full sm:w-auto"
                                style="position: relative; z-index: 10;">
                                Find Routes
                                <i class="fas fa-route ml-1.5"></i>
                            </a>
                            <a href="{{ route('register') }}" wire:navigate
                                class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold rounded-md text-blue-800 bg-white hover:bg-gray-50 shadow-md w-full sm:w-auto"
                                style="position: relative; z-index: 10;">
                                Get Started
                                <i class="fas fa-arrow-right ml-1.5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple separator -->
            <div class="absolute bottom-[-1px] left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60">
                    <path fill="#ffffff" fill-opacity="1"
                        d="M0,32L80,34.7C160,37,320,43,480,40C640,37,800,27,960,24C1120,21,1280,27,1360,29.3L1440,32L1440,60L1360,60C1280,60,1120,60,960,60C800,60,640,60,480,60C320,60,160,60,80,60L0,60Z">
                    </path>
                </svg>
            </div>
        </div>

        <!-- Search Section -->
        <div class="py-8 sm:py-12 lg:py-24 bg-white relative" id="filtering">
            <div class="max-w-6xl mx-auto px-3 sm:px-4 lg:px-8">
                <div class="text-center mb-6 sm:mb-8 lg:mb-14">
                    <h2
                        class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-2 sm:mb-3 px-2">
                        Find Your Perfect Shipping Route
                    </h2>
                    <p class="text-sm sm:text-base lg:text-lg text-gray-600 max-w-2xl mx-auto px-4">Select ports and
                        discover available
                        shipments</p>
                </div>

                <!-- Search Form -->
                <form action="{{ route('landing-page') }}#results" method="GET"
                    class="bg-white rounded-xl shadow-lg p-4 sm:p-6 lg:p-8 mb-8 sm:mb-12 border border-gray-200"
                    onsubmit="handleFormSubmit(event)">
                    @csrf

                    <!-- Error Message Display -->
                    @if (isset($error))
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-md">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-red-500 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700 font-medium">
                                        {{ $error }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-4 lg:space-y-0 lg:grid lg:grid-cols-12 lg:gap-5 lg:items-end">
                        <!-- POL Selection -->
                        <div class="lg:col-span-5">
                            <label for="pol" class="block mb-2 text-xs sm:text-sm font-bold text-gray-700">
                                <span class="flex items-center">
                                    <i class="fas fa-anchor text-blue-600 mr-1.5 sm:mr-2 text-xs sm:text-sm"></i>
                                    <span class="text-xs sm:text-sm">Port of Loading (POL)</span>
                                </span>
                            </label>
                            <div class="relative group">
                                <select name="pol" id="pol"
                                    class="block w-full pl-3 pr-8 py-2 border-2 {{ isset($error) ? 'border-red-500 focus:border-red-600' : 'border-gray-300 hover:border-blue-800 focus:border-blue-800' }} rounded-md appearance-none bg-white shadow-sm transition-colors text-sm">
                                    <option disabled {{ !request('pol') && !isset($old_pol) ? 'selected' : '' }}>Select
                                        Port of Loading</option>
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
                        <div class="flex lg:hidden justify-center py-2">
                            <button type="button" onclick="swapPorts()"
                                class="group w-10 h-10 bg-blue-800 hover:bg-red-600 rounded-full flex items-center justify-center shadow-md transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <i
                                    class="fas fa-exchange-alt text-white text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                        </div>

                        <!-- POD Selection -->
                        <div class="lg:col-span-5">
                            <label for="pod" class="block mb-2 text-xs sm:text-sm font-bold text-gray-700">
                                <span class="flex items-center">
                                    <i class="fas fa-anchor text-red-600 mr-1.5 sm:mr-2 text-xs sm:text-sm"></i>
                                    <span class="text-xs sm:text-sm">Port of Discharge (POD)</span>
                                </span>
                            </label>
                            <div class="relative group">
                                <select name="pod" id="pod"
                                    class="block w-full pl-3 pr-8 py-2 border-2 {{ isset($error) ? 'border-red-500 focus:border-red-600' : 'border-gray-300 hover:border-red-600 focus:border-red-600' }} rounded-md appearance-none bg-white shadow-sm transition-colors text-sm">
                                    <option disabled {{ !request('pod') && !isset($old_pod) ? 'selected' : '' }}>Select
                                        Port of Discharge</option>
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
                    <div class="space-y-4 sm:space-y-6 lg:space-y-8" id="results">
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
                                    The selected Port of Loading and Port of Discharge are the same. Please select
                                    different ports.
                                </p>
                                <a href="#"
                                    onclick="document.getElementById('pol').selectedIndex = 0; document.getElementById('pod').selectedIndex = 0;"
                                    class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
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
                                    find any shipments for the selected route. Please try different ports or check back
                                    later.</p>
                                <a href="#filtering"
                                    class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-blue-800 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                    Try Another Route
                                </a>
                            </div>
                        @else
                            <div class="space-y-4 sm:space-y-6">
                                @foreach ($shipments as $shipment)
                                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
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
                                                        <svg class="h-2.5 w-2.5 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
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
                                                    <span
                                                        class="font-medium">{{ strtoupper($shipment->from_city) }}</span>
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
                                                        <span
                                                            class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                                        <span class="w-6 lg:w-8 h-0.5 bg-white"></span>
                                                        <span
                                                            class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                                    </div>

                                                    <span
                                                        class="font-medium">{{ strtoupper($shipment->to_city) }}</span>
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
                                                                    <p
                                                                        class="text-xs text-gray-500 mt-0.5 flex items-center">
                                                                        <i class="far fa-clock mr-1"></i>
                                                                        {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <!-- Desktop Timeline -->
                                                    <div
                                                        class="hidden sm:grid sm:grid-cols-3 gap-4 lg:gap-6 relative">
                                                        @foreach (['closing_cargo', 'etd', 'eta'] as $index => $timeKey)
                                                            <div
                                                                class="bg-white rounded-lg p-3 shadow-sm border border-gray-200 relative z-10 text-center">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-8 sm:py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="text-center mb-8 sm:mb-12">
                    <h2
                        class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 sm:mb-4 flex items-center justify-center gap-3">
                        <img src="{{ asset('../assets/img/Logo Polos Almeta Global Trilindo.png') }}" alt="Almeta Logo"
                            class="h-20 sm:h-24 w-auto">
                        Company Background
                    </h2>
                    <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">
                        Experience superior logistics services backed by proven performance metrics and comprehensive
                        solutions tailored for businesses across Indonesia
                    </p>
                </div>

                <!-- Key Metrics Section -->
                <div class="bg-white shadow-sm border border-gray-200 rounded-lg mb-12 sm:mb-16 overflow-hidden">
                    <div class="px-4 py-3 bg-blue-800 text-white">
                        <h3 class="text-base font-semibold">Performance Metrics</h3>
                        <p class="text-xs text-blue-100 mt-1">Proven track record of excellence in logistics services
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200">
                        <div class="p-4 text-center hover:bg-gray-50">
                            <div
                                class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-800 rounded-lg mx-auto mb-2">
                                <i class="fas fa-anchor text-sm"></i>
                            </div>
                            <div class="text-2xl font-bold text-gray-900 mb-1">10+</div>
                            <div class="text-xs text-gray-600 font-medium">Major Ports Connected</div>
                            <p class="text-xs text-gray-500 mt-1">Comprehensive port coverage across Indonesia</p>
                        </div>

                        <div class="p-4 text-center hover:bg-gray-50">
                            <div
                                class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-800 rounded-lg mx-auto mb-2">
                                <i class="fas fa-clock text-sm"></i>
                            </div>
                            <div class="text-2xl font-bold text-gray-900 mb-1">98%</div>
                            <div class="text-xs text-gray-600 font-medium">On-Time Delivery Rate</div>
                            <p class="text-xs text-gray-500 mt-1">Consistent punctuality you can rely on</p>
                        </div>

                        <div class="p-4 text-center hover:bg-gray-50">
                            <div
                                class="flex items-center justify-center w-10 h-10 bg-red-100 text-red-600 rounded-lg mx-auto mb-2">
                                <i class="fas fa-star text-sm"></i>
                            </div>
                            <div class="text-2xl font-bold text-gray-900 mb-1">4.9<span class="text-base">/5</span>
                            </div>
                            <div class="text-xs text-gray-600 font-medium">Customer Satisfaction</div>
                            <p class="text-xs text-gray-500 mt-1">Based on 500+ verified reviews</p>
                        </div>

                        <div class="p-4 text-center hover:bg-gray-50">
                            <div
                                class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-800 rounded-lg mx-auto mb-2">
                                <i class="fas fa-headset text-sm"></i>
                            </div>
                            <div class="text-2xl font-bold text-gray-900 mb-1">24/7</div>
                            <div class="text-xs text-gray-600 font-medium">Customer Support</div>
                            <p class="text-xs text-gray-500 mt-1">Round-the-clock assistance available</p>
                        </div>
                    </div>
                </div>

                <!-- Core Services Section -->
                <div class="mb-12 sm:mb-16">
                    <div class="text-center mb-8">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Core Service Advantages</h3>
                        <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">
                            Three fundamental pillars that make companies the preferred logistics partner for businesses
                            nationwide
                        </p>
                    </div>

                    <!-- Simplified Carousel Container -->
                    <div class="relative bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div id="services-carousel" class="relative">
                            <!-- Service 1 -->
                            <div class="carousel-slide opacity-100 p-4 sm:p-6" data-slide="0">
                                <div
                                    class="flex flex-col lg:flex-row items-center lg:items-start gap-4 lg:gap-6 max-w-5xl mx-auto">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-12 h-12 sm:w-14 sm:h-14 bg-blue-800 text-white rounded-lg flex items-center justify-center">
                                            <i class="fas fa-shipping-fast text-lg sm:text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 text-center lg:text-left">
                                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">Fast & Efficient
                                            Delivery</h4>
                                        <p class="text-gray-600 mb-3 leading-relaxed text-sm sm:text-base">
                                            Advanced logistics network ensuring quick delivery times across Indonesia's
                                            most challenging routes.
                                            Our optimized supply chain reduces transit time by up to 30% compared to
                                            traditional methods.
                                        </p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-blue-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-blue-800 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Express shipping options
                                                    available</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-blue-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-blue-800 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Real-time tracking
                                                    system</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-blue-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-blue-800 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Priority handling for
                                                    urgent cargo</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-blue-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-blue-800 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Multi-modal
                                                    transportation</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Service 2 -->
                            <div class="carousel-slide opacity-0 absolute inset-0 p-4 sm:p-6" data-slide="1">
                                <div
                                    class="flex flex-col lg:flex-row-reverse items-center lg:items-start gap-4 lg:gap-6 max-w-5xl mx-auto">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-12 h-12 sm:w-14 sm:h-14 bg-red-600 text-white rounded-lg flex items-center justify-center">
                                            <i class="fas fa-shield-alt text-lg sm:text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 text-center lg:text-left">
                                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">Comprehensive
                                            Security & Safety</h4>
                                        <p class="text-gray-600 mb-3 leading-relaxed text-sm sm:text-base">
                                            End-to-end cargo protection with advanced security measures, insurance
                                            coverage, and
                                            temperature-controlled environments for sensitive goods. Your cargo's safety
                                            is guaranteed.
                                        </p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-red-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-red-600 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Full cargo insurance
                                                    included</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-red-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-red-600 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">GPS tracking &
                                                    monitoring</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-red-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-red-600 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Secure warehouse
                                                    facilities</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-red-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-red-600 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Climate-controlled
                                                    storage</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Service 3 -->
                            <div class="carousel-slide opacity-0 absolute inset-0 p-4 sm:p-6" data-slide="2">
                                <div
                                    class="flex flex-col lg:flex-row items-center lg:items-start gap-4 lg:gap-6 max-w-5xl mx-auto">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-12 h-12 sm:w-14 sm:h-14 bg-gray-800 text-white rounded-lg flex items-center justify-center">
                                            <i class="fas fa-cogs text-lg sm:text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 text-center lg:text-left">
                                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">Reliable &
                                            Consistent Service</h4>
                                        <p class="text-gray-600 mb-3 leading-relaxed text-sm sm:text-base">
                                            Proven track record with consistent performance across all service levels.
                                            Our experienced
                                            team and deep local market knowledge ensure dependable logistics solutions
                                            for your business needs.
                                        </p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-gray-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-gray-800 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">5+ years industry
                                                    experience</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-gray-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-gray-800 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Local expertise &
                                                    knowledge</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-gray-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-gray-800 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Predictable delivery
                                                    schedules</span>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start text-gray-700 bg-gray-50 p-2 rounded-lg">
                                                <i class="fas fa-check text-gray-800 mr-2 text-sm"></i>
                                                <span class="font-medium text-xs sm:text-sm">Dedicated account
                                                    management</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Simple Progress Indicators -->
                        <div class="flex justify-center space-x-2 pb-4">
                            <button id="indicator-0" class="w-2 h-2 bg-blue-800 rounded-full"></button>
                            <button id="indicator-1" class="w-2 h-2 bg-gray-300 rounded-full"></button>
                            <button id="indicator-2" class="w-2 h-2 bg-gray-300 rounded-full"></button>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mt-12 text-center">
                    <div
                        class="inline-flex items-center px-6 py-3 bg-blue-50 text-blue-700 rounded-md text-sm font-medium">
                        <a href="#contact">
                            <i class="fas fa-info-circle mr-2"></i>
                            Ready to experience reliable logistics solutions? Contact our team for a customized quote.
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f3f4f6" fill-opacity="1" d="M0,320L1440,192L1440,320L0,320Z"></path>
        </svg>

        <!-- Footer with improved styling -->
        <footer class="bg-gray-100 text-black" id="contact">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-10">
                <!-- Logo and Description -->
                <div class="text-center mb-8 sm:mb-10">
                    <a href="#" class="inline-flex items-center justify-center mb-3 sm:mb-4">
                        <span class="text-xl sm:text-2xl lg:text-3xl font-bold text-blue-800">
                            PT. ALMETA GLOBAL <span class="text-red-600">TRILINDO</span>
                        </span>
                    </a>
                    <p class="max-w-3xl mx-auto text-sm sm:text-base text-gray-600 leading-relaxed">
                        Your trusted partner in domestic logistics solutions since 2020, providing fast, safe and
                        reliable shipping services throughout Indonesia.
                    </p>
                </div>

                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 mb-8 sm:mb-10">
                    <!-- Contact Information -->
                    <div class="sm:col-span-1 lg:col-span-1">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-4 relative pb-1">
                            Contact Information
                            <span class="absolute bottom-0 left-0 w-8 h-0.5 bg-red-600 rounded-full"></span>
                        </h3>
                        <div class="space-y-3">
                            <div class="group">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="flex-shrink-0 w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-map-marker-alt text-red-600 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-xs mb-0.5">Office Address</h4>
                                        <p class="text-xs text-gray-600 leading-relaxed">
                                            Jasamarga Green Residence AD. 6 No. 7<br>
                                            Sidoarjo, East Java, Indonesia
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="flex-shrink-0 w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-phone text-blue-800 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        @php
                                            $customerName = Auth::user()->name ?? 'Customer baru';
                                            $whatsappNumber = '6282139808850';
                                            $message = "Halo, Almeta Global Trilindo. Saya $customerName, ada kebutuhan pengiriman. Apa bisa dibantu?";
                                            $encodedMessage = urlencode($message);
                                        @endphp
                                        <h4 class="font-semibold text-gray-900 text-xs mb-0.5">WhatsApp</h4>
                                        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $encodedMessage }}"
                                            target="_blank" class="text-xs text-gray-600 hover:text-blue-800">
                                            +62 821-3980-8850
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Information -->
                    <div class="sm:col-span-1 lg:col-span-1">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-4 relative pb-1">
                            Email Us
                            <span class="absolute bottom-0 left-0 w-8 h-0.5 bg-blue-800 rounded-full"></span>
                        </h3>
                        <div class="space-y-3">
                            <div class="group">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="flex-shrink-0 w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-envelope text-blue-800 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-xs mb-0.5">Business Inquiries</h4>
                                        <a href="mailto:hendra@almetagt.com"
                                            class="text-xs text-gray-600 hover:text-blue-800">
                                            hendra@almetagt.com
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="flex-shrink-0 w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-headset text-blue-800 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-xs mb-0.5">Customer Service</h4>
                                        <a href="mailto:cs@almetagt.com"
                                            class="text-xs text-gray-600 hover:text-blue-800">
                                            cs@almetagt.com
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter & Social -->
                    <div class="sm:col-span-2 lg:col-span-1">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-4 relative pb-1">
                            Feedback
                            <span class="absolute bottom-0 left-0 w-8 h-0.5 bg-red-600 rounded-full"></span>
                        </h3>

                        <!-- Feedback -->
                        <div class="mb-4">
                            <p class="text-xs text-gray-600 mb-2 leading-relaxed">
                                This website's under Development, your any feedback help us to improve.
                            </p>
                            <a href="{{ route('new-feedback') }}"
                                class="text-xs text-gray-600 hover:text-blue-800">Click here to Feedback</a>
                        </div>

                        <!-- Social Media -->
                        <div>
                            <p class="text-xs font-semibold text-gray-700 mb-2">Follow Us</p>
                            <div class="flex space-x-2">
                                <a href="#"
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center hover:border-blue-800 hover:bg-blue-50">
                                    <i class="fab fa-facebook-f text-blue-800 text-xs"></i>
                                </a>
                                <a href="#"
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center hover:border-blue-800 hover:bg-blue-50">
                                    <i class="fab fa-twitter text-blue-800 text-xs"></i>
                                </a>
                                <a href="#"
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center hover:border-red-600 hover:bg-red-50">
                                    <i class="fab fa-instagram text-red-600 text-xs"></i>
                                </a>
                                <a href="#"
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center hover:border-blue-800 hover:bg-blue-50">
                                    <i class="fab fa-linkedin-in text-blue-800 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-300 pt-4">
                    <!-- Bottom Footer -->
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
                        <div class="text-center md:text-left">
                            <p class="text-gray-500 text-xs">
                                &copy; {{ date('Y') }} PT. ALMETA GLOBAL TRILINDO. All rights reserved.
                            </p>
                        </div>
                        <div class="flex flex-wrap justify-center md:justify-end items-center gap-4">
                            <a href="#" class="text-gray-500 hover:text-red-600 text-xs">
                                Privacy Policy
                            </a>
                            <a href="#" class="text-gray-500 hover:text-red-600 text-xs">
                                Terms of Service
                            </a>
                            <a href="#" class="text-gray-500 hover:text-red-600 text-xs">
                                FAQ
                            </a>
                            <span class="text-gray-400 bg-gray-200 px-2 py-0.5 rounded text-xs">
                                V.1.4.3
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mobile Menu Toggle Function
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener('click', function() {
                        // Toggle menu visibility
                        if (mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.remove('hidden');
                        } else {
                            mobileMenu.classList.add('hidden');
                        }
                    });

                    // Close menu when clicking links
                    const mobileMenuLinks = mobileMenu.querySelectorAll('a');
                    mobileMenuLinks.forEach(link => {
                        link.addEventListener('click', function() {
                            mobileMenu.classList.add('hidden');
                        });
                    });

                    // Close menu when resizing to desktop
                    window.addEventListener('resize', function() {
                        if (window.innerWidth >= 768) { // md breakpoint in Tailwind
                            mobileMenu.classList.add('hidden');
                        }
                    });
                }

                // Auto Carousel for Core Services
                console.log('Initializing carousel...'); // Debug log
                const servicesCarousel = document.getElementById('services-carousel');
                console.log('Carousel element found:', servicesCarousel); // Debug log

                const totalSlides = 3;
                let currentSlide = 0;
                let carouselInterval;

                function updateCarousel() {
                    if (servicesCarousel) {
                        console.log(`Updating carousel to slide ${currentSlide}`); // Debug log

                        // Hide all slides first
                        const slides = servicesCarousel.querySelectorAll('.carousel-slide');
                        slides.forEach((slide, index) => {
                            if (index === currentSlide) {
                                slide.classList.remove('opacity-0');
                                slide.classList.add('opacity-100');
                            } else {
                                slide.classList.remove('opacity-100');
                                slide.classList.add('opacity-0');
                            }
                        });

                        // Update indicators
                        for (let i = 0; i < totalSlides; i++) {
                            const indicator = document.getElementById(`indicator-${i}`);
                            if (indicator) {
                                if (i === currentSlide) {
                                    indicator.classList.remove('bg-gray-300');
                                    indicator.classList.add('bg-blue-600', 'scale-125');
                                } else {
                                    indicator.classList.remove('bg-blue-600', 'scale-125');
                                    indicator.classList.add('bg-gray-300');
                                }
                            }
                        }
                    }
                }

                function nextSlide() {
                    currentSlide = (currentSlide + 1) % totalSlides;
                    console.log(`Moving to slide ${currentSlide}`);
                    updateCarousel();
                }

                function startCarousel() {
                    console.log('Starting carousel timer...');
                    carouselInterval = setInterval(nextSlide, 3000);
                }

                function stopCarousel() {
                    if (carouselInterval) {
                        console.log('Stopping carousel timer...');
                        clearInterval(carouselInterval);
                    }
                }

                // Initialize carousel
                if (servicesCarousel) {
                    console.log('Carousel found, initializing...');
                    updateCarousel();

                    // Start carousel after a small delay to ensure everything is loaded
                    setTimeout(() => {
                        startCarousel();
                        console.log('Carousel started with automatic rotation'); // Debug log
                    }, 1000);

                    // Pause carousel on hover
                    servicesCarousel.addEventListener('mouseenter', function() {
                        console.log('Mouse entered, pausing carousel'); // Debug log
                        stopCarousel();
                    });

                    servicesCarousel.addEventListener('mouseleave', function() {
                        console.log('Mouse left, resuming carousel'); // Debug log
                        startCarousel();
                    });

                    // Pause carousel when page is not visible
                    document.addEventListener('visibilitychange', function() {
                        if (document.hidden) {
                            console.log('Page hidden, pausing carousel'); // Debug log
                            stopCarousel();
                        } else {
                            console.log('Page visible, resuming carousel'); // Debug log
                            startCarousel();
                        }
                    });
                } else {
                    console.error('Carousel element not found!'); // Debug log
                }

                // Form submission handling
                function handleFormSubmit(event) {
                    event.preventDefault();

                    const submitButton = document.getElementById('submitButton');
                    const buttonText = document.getElementById('buttonText');
                    const loadingSpinner = document.getElementById('loadingSpinner');

                    if (submitButton && buttonText && loadingSpinner) {
                        submitButton.disabled = true;
                        buttonText.classList.add('hidden');
                        loadingSpinner.classList.remove('hidden');

                        setTimeout(() => {
                            event.target.submit();
                        }, 300);
                    }
                }

                // Add form submit handler to any search forms
                const searchForm = document.querySelector('form[action="{{ route('landing-page') }}"]');
                if (searchForm) {
                    searchForm.addEventListener('submit', handleFormSubmit);
                }
            });

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
                @auth
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
            @endauth
            });

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

            // Form submission handling
            window.handleFormSubmit = function(event) {
                event.preventDefault();

                // Save current search data before form submission
                savePortSelections();

                const submitButton = document.getElementById('submitButton');
                const buttonText = document.getElementById('buttonText');
                const loadingSpinner = document.getElementById('loadingSpinner');

                if (submitButton && buttonText && loadingSpinner) {
                    submitButton.disabled = true;
                    buttonText.classList.add('hidden');
                    loadingSpinner.classList.remove('hidden');

                    setTimeout(() => {
                        event.target.submit();
                    }, 300);
                }
            };

            // Add form submit handler to any search forms
            const searchForm = document.querySelector('form[action="{{ route('landing-page') }}"]');
            if (searchForm) {
                searchForm.addEventListener('submit', handleFormSubmit);
            }

            // Fix for smooth scrolling to anchors
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

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

                    // First, try to get data from server session (higher priority)
                    @if (isset($savedSearchData) && !empty($savedSearchData))
                        const serverData = @json($savedSearchData);
                        if (serverData && serverData.pol && serverData.pod) {
                            // Server data exists, use it
                            if (serverData.pol !== 'Select Port of Loading' && serverData.pol !== '') {
                                polSelect.value = serverData.pol;
                            }
                            if (serverData.pod !== 'Select Port of Discharge' && serverData.pod !== '') {
                                podSelect.value = serverData.pod;
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
                            return;
                        }
                    @endif

                    // Fallback to localStorage if no server data
                    const savedData = localStorage.getItem('almetagt_search_data');
                    if (savedData) {
                        const searchData = JSON.parse(savedData);

                        if (searchData.pol && searchData.pod) {
                            // Check if the saved data is not older than 24 hours
                            const hoursDiff = (new Date().getTime() - searchData.timestamp) / (1000 * 60 * 60);

                            if (hoursDiff < 24) {
                                if (searchData.pol !== 'Select Port of Loading' && searchData.pol !== '') {
                                    polSelect.value = searchData.pol;
                                }
                                if (searchData.pod !== 'Select Port of Discharge' && searchData.pod !== '') {
                                    podSelect.value = searchData.pod;
                                }
                                console.log('Search data restored from localStorage:', searchData);
                            } else {
                                // Clear old data
                                localStorage.removeItem('almetagt_search_data');
                            }
                        }
                    }
                } catch (error) {
                    console.log('Error restoring search data:', error);
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
        </script>
        </script>

        <style>
            /* Carousel specific styles */
            #services-carousel {
                min-height: 350px;
                /* Reduced height for mobile */
            }

            /* Responsive height adjustments */
            @media (min-width: 640px) {
                #services-carousel {
                    min-height: 400px;
                }
            }

            @media (min-width: 1024px) {
                #services-carousel {
                    min-height: 450px;
                }
            }

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

            .carousel-slide {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                transition: opacity 1000ms cubic-bezier(0.4, 0, 0.2, 1);
                visibility: visible;
            }

            .carousel-slide.opacity-0 {
                visibility: hidden;
            }

            .carousel-slide.opacity-100 {
                visibility: visible;
            }

            /* Smooth scale transition for indicators */
            .transition-all {
                transition: all 300ms ease;
            }

            /* Enhanced hover effects */
            .transform.hover\:scale-105:hover {
                transform: scale(1.05);
            }

            #services-carousel+div [id^="indicator-"] {
                transition: background-color 300ms ease, transform 300ms ease;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .flex-col.lg\:flex-row,
            .flex-col.lg\:flex-row-reverse {
                animation: fadeInUp 0.6s ease-out;
            }
        </style>
    </div>
</x-guest-layout>
