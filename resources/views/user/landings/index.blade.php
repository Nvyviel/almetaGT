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
        ];
    @endphp

    <div class="min-h-screen bg-white relative overflow-hidden">
        <!-- Navigation -->
        <nav class="border-b border-gray-100 bg-white fixed w-full top-0 z-50 shadow-sm backdrop-blur-md bg-white/95">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 md:h-20 relative">
                    <!-- Logo Section - Overflow Height -->
                    <div class="flex items-center relative z-10">
                        <a href="#" class="flex items-center">
                            <img src="{{ asset('assets/img/Almeta Logo Landing Page V-1.webp') }}" alt="Almeta Logo"
                                class="h-20 md:h-24 w-auto object-contain">
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#"
                            class="text-gray-600 hover:text-red-600 font-medium transition-colors">Home</a>
                        <a href="#filtering" class="text-gray-600 hover:text-red-600 font-medium transition-colors">Find
                            Routes</a>
                        <a href="#features" class="text-gray-600 hover:text-red-600 font-medium transition-colors">Why
                            Us</a>
                        <a href="#contact"
                            class="text-gray-600 hover:text-red-600 font-medium transition-colors">Contact</a>
                    </div>

                    <!-- Desktop Login Button -->
                    <div class="hidden md:flex items-center">
                        <a href="{{ route('login') }}" wire:navigate
                            class="inline-flex items-center px-4 md:px-6 py-2 md:py-2.5 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-blue-200">
                            <i class="fas fa-user mr-2"></i>
                            <span>Login</span>
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button type="button" id="mobile-menu-button"
                            class="text-gray-600 hover:text-red-600 focus:outline-none p-2">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-gray-200 shadow-lg">
                <div class="px-4 py-3 space-y-2">
                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50">Home</a>
                    <a href="#filtering"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50">Find
                        Routes</a>
                    <a href="#features"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50">Why
                        Us</a>
                    <a href="#contact"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50">Contact</a>
                    <div class="pt-2 pb-1">
                        <a href="{{ route('login') }}" wire:navigate
                            class="inline-flex w-full items-center justify-center px-4 py-2 border-2 border-blue-600 text-sm font-semibold rounded-full text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-300">
                            <i class="fas fa-user mr-2"></i>
                            <span>Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section with animated background -->
        <div class="pt-20 md:pt-24 bg-blue-600 relative">
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="py-10 sm:py-12 lg:py-16">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Left side - Text content -->
                        <div class="text-left">
                            <h1
                                class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-blue-100 drop-shadow-sm pb-2 mb-2 animate-fade-in">
                                Almeta Global Trilindo
                            </h1>
                            <div class="animate-fade-in animation-delay-600">
                                <p class="text-lg sm:text-xl text-white leading-relaxed font-light mb-3 md:mb-4">
                                    <span class="border-b-4 border-yellow-300 pb-1">Fast, Safe, and Reliable</span>
                                    <span class="hidden sm:inline"> Domestic Logistics solutions for your
                                        business.</span>
                                </p>
                                <p class="sm:hidden text-white leading-relaxed font-light mb-3">
                                    Domestic Logistics solutions for your business.
                                </p>
                                <p class="text-sm sm:text-base text-blue-100 leading-relaxed max-w-lg">
                                    In a fast-paced business world, small and medium industries (IKM) need fast, safe
                                    and reliable logistics solutions.
                                </p>
                            </div>
                            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row gap-3 animate-fade-up">
                                <a href="#filtering"
                                    class="inline-flex items-center justify-center px-5 py-2.5 sm:px-6 sm:py-3 text-base sm:text-lg font-semibold rounded-lg text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 shadow-lg hover:shadow-red-200/50 transition-all duration-300 w-full sm:w-auto"
                                    style="position: relative; z-index: 10;">
                                    Search Route
                                    <i class="fas fa-search ml-2"></i>
                                </a>
                                <a href="{{ route('register') }}" wire:navigate
                                    class="inline-flex items-center justify-center px-5 py-2.5 sm:px-6 sm:py-3 text-base sm:text-lg font-semibold rounded-lg text-blue-600 bg-white hover:bg-blue-50 shadow-lg hover:shadow-blue-200/50 transition-all duration-300 w-full sm:w-auto"
                                    style="position: relative; z-index: 10;">
                                    Get Started
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Right side - Image -->
                        <div class="flex justify-center lg:justify-end mt-4 lg:mt-0">
                            <div
                                class=" relative w-4/5 sm:w-2/3 lg:w-full max-w-md aspect-square overflow-hidden transform hover:scale-[1.02] transition-transform duration-300">
                                <img src="{{ asset('assets/img/Almeta-ship.png') }}" alt="Almeta Ship"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wave separator -->
            <div class="absolute bottom-[-2px] left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
                    <path fill="#ffffff" fill-opacity="1"
                        d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
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
                        shipments with competitive rates</p>
                </div>

                <!-- Search Form with floating effect -->
                <form action="{{ route('landing-page') }}#results" method="GET"
                    class="bg-white rounded-md sm:rounded-lg shadow-lg p-3 sm:p-4 lg:p-10 mb-6 sm:mb-10 lg:mb-16 border border-gray-100 transform hover:translate-y-[-2px] sm:hover:translate-y-[-5px] transition-all duration-300"
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
                                    class="block w-full pl-3 pr-8 sm:pl-4 sm:pr-10 py-2.5 sm:py-3 lg:py-4 border-2 {{ isset($error) ? 'border-red-300 focus:border-red-500 focus:ring-red-100' : 'border-gray-200 hover:border-blue-400 focus:border-blue-500 focus:ring-blue-100' }} rounded-md focus:ring-2 sm:focus:ring-4 appearance-none bg-white shadow-sm transition-colors text-sm">
                                    <option disabled {{ !request('pol') && !isset($old_pol) ? 'selected' : '' }}>Select
                                        Port of Loading</option>
                                    @foreach ($fromCities as $city)
                                        <option value="{{ $city }}"
                                            {{ request('pol') == $city || (isset($old_pol) && $old_pol == $city) ? 'selected' : '' }}>
                                            {{ strtoupper($city) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Direction Icon - Hidden on mobile, visible on large screens -->
                        <div class="hidden lg:flex lg:col-span-2 justify-center items-center">
                            <div
                                class="w-12 h-12 lg:w-16 lg:h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-30"></span>
                                <i class="fa-solid fa-ship text-white text-sm lg:text-lg"></i>
                            </div>
                        </div>

                        <!-- Mobile Direction Arrow - Only visible on mobile -->
                        <div class="flex lg:hidden justify-center py-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-md rotate-90">
                                <i class="fas fa-arrow-right text-white text-xs"></i>
                            </div>
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
                                    class="block w-full pl-3 pr-8 sm:pl-4 sm:pr-10 py-2.5 sm:py-3 lg:py-4 border-2 {{ isset($error) ? 'border-red-300 focus:border-red-500 focus:ring-red-100' : 'border-gray-200 hover:border-red-400 focus:border-red-500 focus:ring-red-100' }} rounded-md focus:ring-2 sm:focus:ring-4 appearance-none bg-white shadow-sm transition-colors text-sm">
                                    <option disabled {{ !request('pod') && !isset($old_pod) ? 'selected' : '' }}>Select
                                        Port of Discharge</option>
                                    @foreach ($fromCities as $city)
                                        <option value="{{ $city }}"
                                            {{ request('pod') == $city || (isset($old_pod) && $old_pod == $city) ? 'selected' : '' }}>
                                            {{ strtoupper($city) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="lg:col-span-12 pt-3 sm:pt-4" id="filtering">
                            <button id="submitButton" type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 sm:py-4 px-4 sm:px-6 lg:px-8 rounded-md hover:from-blue-500 hover:to-blue-800 transition-all duration-300 font-bold flex items-center justify-center text-sm sm:text-base lg:text-lg shadow-lg hover:shadow-blue-200 active:scale-95">
                                <span id="buttonText" class="mr-2">Find Available Ships</span>
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
                        <div
                            class="flex flex-col gap-3 sm:gap-4 md:flex-row md:items-center md:justify-between mb-4 sm:mb-6 lg:mb-8">
                            <div class="text-center md:text-left">
                                <h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-gray-900">
                                    Available Shipments</h2>
                                <p class="text-gray-500 mt-1 text-sm sm:text-base">From
                                    {{ strtoupper(request('pol')) }} to {{ strtoupper(request('pod')) }}</p>
                            </div>
                            <div
                                class="px-3 py-2 sm:px-4 sm:py-2 lg:px-5 lg:py-3 bg-gradient-to-r from-blue-100 to-blue-50 text-blue-800 rounded-md font-medium flex items-center justify-center shadow-sm text-xs sm:text-sm lg:text-base">
                                <i class="fas fa-route mr-1.5 sm:mr-2 text-xs sm:text-sm"></i>
                                <span>{{ $shipments->count() }} routes found</span>
                            </div>
                        </div>

                        @if (isset($error))
                            <div
                                class="bg-white rounded-md shadow-lg p-6 sm:p-8 lg:p-16 text-center border border-gray-100">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 lg:w-24 lg:h-24 bg-red-100 rounded-full mb-4 sm:mb-6 animate-pulse">
                                    <i
                                        class="fas fa-exclamation-triangle text-xl sm:text-2xl lg:text-4xl text-red-600"></i>
                                </div>
                                <h3 class="text-base sm:text-lg lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">
                                    Invalid
                                    Route</h3>
                                <p class="text-gray-600 text-sm sm:text-base lg:text-lg max-w-md mx-auto mb-4 sm:mb-6">
                                    The selected Port of Loading and Port of Discharge are the same. Please select
                                    different ports.</p>
                                <a href="#filtering"
                                    class="inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-3 bg-red-100 hover:bg-red-200 text-red-800 font-medium rounded-md transition-colors text-sm sm:text-base">
                                    <i class="fas fa-search mr-1.5 sm:mr-2"></i>
                                    Try Another Route
                                </a>
                            </div>
                        @elseif ($shipments->isEmpty())
                            <div
                                class="bg-white rounded-md shadow-lg p-6 sm:p-8 lg:p-16 text-center border border-gray-100">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 lg:w-24 lg:h-24 bg-blue-50 rounded-full mb-4 sm:mb-6 animate-pulse">
                                    <i class="fas fa-ship text-xl sm:text-2xl lg:text-4xl text-blue-300"></i>
                                </div>
                                <h3 class="text-base sm:text-lg lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">No
                                    Routes Available</h3>
                                <p class="text-gray-600 text-sm sm:text-base lg:text-lg max-w-md mx-auto mb-4 sm:mb-6">
                                    We couldn't find any shipments for the selected route. Please try different ports or
                                    check back later.</p>
                                <a href="#filtering"
                                    class="inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-3 bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium rounded-md transition-colors text-sm sm:text-base">
                                    <i class="fas fa-search mr-1.5 sm:mr-2"></i>
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
                                                                <span class="w-1 h-1 bg-white rounded-full"></span>
                                                                <span class="w-0.5 h-8 bg-white"></span>
                                                                <span class="w-1 h-1 bg-white rounded-full"></span>
                                                            </div>
                                                        </div>

                                                        <!-- Desktop Route Indicator -->
                                                        <div
                                                            class="hidden sm:flex items-center mx-2 lg:mx-3 space-x-1">
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
                                                            class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 xl:gap-10 relative">
                                                            @foreach (['etb', 'etd', 'eta'] as $index => $timeKey)
                                                                <div
                                                                    class="bg-white rounded-md p-3 sm:p-4 shadow-md border border-gray-100 relative z-10 group hover:border-blue-200 transition-all duration-300 hover:shadow-lg">
                                                                    <div
                                                                        class="flex items-center justify-between mb-2 sm:mb-3">
                                                                        <p
                                                                            class="text-xs sm:text-sm font-bold {{ $index == 0 ? 'text-blue-500' : ($index == 1 ? 'text-blue-600' : 'text-blue-700') }}">
                                                                            {{ strtoupper($timeKey) }}
                                                                        </p>
                                                                        <div
                                                                            class="flex items-center justify-center w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 rounded-full {{ $index == 0 ? 'bg-blue-100 text-blue-500' : ($index == 1 ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white' : 'bg-gradient-to-r from-blue-600 to-blue-700 text-white') }} shadow-md group-hover:scale-110 transition-transform duration-300">
                                                                            <i
                                                                                class="fas {{ $index == 0 ? 'fa-ship' : ($index == 1 ? 'fa-anchor' : 'fa-check') }} text-xs sm:text-sm"></i>
                                                                        </div>
                                                                    </div>
                                                                    <p
                                                                        class="font-bold text-gray-800 text-sm sm:text-base lg:text-lg xl:text-xl">
                                                                        {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('d M Y') }}
                                                                    </p>
                                                                    <p
                                                                        class="text-xs sm:text-sm text-gray-500 mt-1 flex items-center">
                                                                        <i class="far fa-clock mr-1"></i>
                                                                        {{ \Carbon\Carbon::parse($shipment->$timeKey)->format('H:i') }}
                                                                    </p>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <!-- Mobile: Connect lines between timeline items -->
                                                        <div
                                                            class="sm:hidden absolute left-1/2 top-0 bottom-0 w-0.5 bg-gray-200 transform -translate-x-1/2 z-0">
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
        <div class="pt-16 sm:pt-20 lg:pt-28" id="features">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                    <div class="inline-block">
                        <span
                            class="inline-block px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md mb-4 shadow-sm">
                            Our Promise
                        </span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                        Why Choose Almeta?
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Experience superior logistics services backed by proven performance metrics and comprehensive
                        solutions tailored for businesses across Indonesia
                    </p>
                </div>

                <!-- Key Metrics Section -->
                <div class="bg-white shadow-sm border border-gray-200 rounded-md mb-16 sm:mb-20 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-900 text-white">
                        <h3 class="text-lg font-semibold">Performance Metrics</h3>
                        <p class="text-sm text-gray-300 mt-1">Proven track record of excellence in logistics services
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200">
                        <div class="p-6 text-center hover:bg-gray-50 transition-colors duration-200">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-100 text-blue-600 rounded-md mx-auto mb-3">
                                <i class="fas fa-anchor text-lg"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">10+</div>
                            <div class="text-sm text-gray-600 font-medium">Major Ports Connected</div>
                            <p class="text-xs text-gray-500 mt-2">Comprehensive port coverage across Indonesia</p>
                        </div>

                        <div class="p-6 text-center hover:bg-gray-50 transition-colors duration-200">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-green-100 text-green-600 rounded-md mx-auto mb-3">
                                <i class="fas fa-clock text-lg"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">98%</div>
                            <div class="text-sm text-gray-600 font-medium">On-Time Delivery Rate</div>
                            <p class="text-xs text-gray-500 mt-2">Consistent punctuality you can rely on</p>
                        </div>

                        <div class="p-6 text-center hover:bg-gray-50 transition-colors duration-200">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-yellow-100 text-yellow-600 rounded-md mx-auto mb-3">
                                <i class="fas fa-star text-lg"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">4.9<span class="text-lg">/5</span>
                            </div>
                            <div class="text-sm text-gray-600 font-medium">Customer Satisfaction</div>
                            <p class="text-xs text-gray-500 mt-2">Based on 500+ verified reviews</p>
                        </div>

                        <div class="p-6 text-center hover:bg-gray-50 transition-colors duration-200">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-purple-100 text-purple-600 rounded-md mx-auto mb-3">
                                <i class="fas fa-headset text-lg"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">24/7</div>
                            <div class="text-sm text-gray-600 font-medium">Customer Support</div>
                            <p class="text-xs text-gray-500 mt-2">Round-the-clock assistance available</p>
                        </div>
                    </div>
                </div>

                <!-- Core Services Section -->
                <div class="mb-16 sm:mb-20">
                    <div class="text-center mb-12">
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Core Service Advantages</h3>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Three fundamental pillars that make Almeta the preferred logistics partner for businesses
                            nationwide
                        </p>
                    </div>

                    <div class="space-y-8 lg:space-y-12">
                        <!-- Service 1 -->
                        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-16 h-16 bg-blue-600 text-white rounded-md flex items-center justify-center shadow-sm">
                                    <i class="fas fa-shipping-fast text-2xl"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-center lg:text-left">
                                <h4 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Fast & Efficient Delivery
                                </h4>
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    Advanced logistics network ensuring quick delivery times across Indonesia's most
                                    challenging routes.
                                    Our optimized supply chain reduces transit time by up to 30% compared to traditional
                                    methods.
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Express shipping options available
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Real-time tracking system
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Priority handling for urgent cargo
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Multi-modal transportation
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service 2 -->
                        <div class="flex flex-col lg:flex-row-reverse items-center lg:items-start gap-8">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-16 h-16 bg-gray-700 text-white rounded-md flex items-center justify-center shadow-sm">
                                    <i class="fas fa-shield-alt text-2xl"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-center lg:text-left">
                                <h4 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Comprehensive Security &
                                    Safety</h4>
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    End-to-end cargo protection with advanced security measures, insurance coverage, and
                                    temperature-controlled environments for sensitive goods. Your cargo's safety is
                                    guaranteed.
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Full cargo insurance included
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        GPS tracking & monitoring
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Secure warehouse facilities
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Climate-controlled storage
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service 3 -->
                        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-16 h-16 bg-green-600 text-white rounded-md flex items-center justify-center shadow-sm">
                                    <i class="fas fa-cogs text-2xl"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-center lg:text-left">
                                <h4 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Reliable & Consistent
                                    Service</h4>
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    Proven track record with consistent performance across all service levels. Our
                                    experienced team
                                    and deep local market knowledge ensure dependable logistics solutions for your
                                    business needs.
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        5+ years industry experience
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Local expertise & knowledge
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Predictable delivery schedules
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-start text-gray-700">
                                        <i class="fas fa-check text-green-600 mr-2"></i>
                                        Dedicated account management
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Testimonial -->
                <div class="bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden">
                    <div class="px-6 py-4 bg-gray-900 text-white">
                        <h3 class="text-lg font-semibold">Customer Success Story</h3>
                        <p class="text-sm text-gray-300 mt-1">Real feedback from our valued business partners</p>
                    </div>

                    <div class="p-8 sm:p-10">
                        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-16 h-16 bg-blue-600 text-white rounded-md flex items-center justify-center font-bold text-xl">
                                    PI
                                </div>
                            </div>
                            <div class="flex-1 text-center lg:text-left">
                                <div class="flex justify-center lg:justify-start space-x-1 mb-4">
                                    {!! str_repeat('<i class="fas fa-star text-yellow-400"></i>', 5) !!}
                                </div>
                                <blockquote class="text-lg text-gray-700 italic mb-6">
                                    "Almeta has significantly improved our supply chain efficiency. Their professional
                                    approach,
                                    reliable delivery schedules, and excellent customer service make them our preferred
                                    logistics partner.
                                    We've seen a 25% reduction in shipping delays since partnering with them."
                                </blockquote>
                                <div>
                                    <div class="font-semibold text-gray-900">PT. Pacific Industries</div>
                                    <div class="text-sm text-gray-600">Manufacturing Company - Jakarta, Indonesia</div>
                                    <div class="text-xs text-gray-500 mt-1">Partnership since 2022 • 200+ successful
                                        shipments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mt-12 text-center">
                    <div
                        class="inline-flex items-center px-6 py-3 bg-blue-50 text-blue-700 rounded-md text-sm font-medium">
                        <i class="fas fa-info-circle mr-2"></i>
                        Ready to experience reliable logistics solutions? Contact our team for a customized quote.
                    </div>
                </div>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f3f4f6" fill-opacity="1" d="M0,320L1440,192L1440,320L0,320Z"></path>
        </svg>

        <!-- Footer with improved styling -->
        <footer class="bg-gray-100 text-black" id="contact">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-16 lg:py-10">
                <!-- Logo and Description -->
                <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                    <a href="#" class="inline-flex items-center justify-center mb-4 sm:mb-6">
                        <span
                            class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-500">
                            PT. Almeta Global Trilindo
                        </span>
                    </a>
                    <p class="max-w-3xl mx-auto text-base sm:text-lg text-gray-600 leading-relaxed">
                        Your trusted partner in domestic logistics solutions since 2020, providing fast, safe and
                        reliable shipping services throughout Indonesia.
                    </p>
                </div>

                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10 lg:gap-12 mb-12 sm:mb-16">
                    <!-- Contact Information -->
                    <div class="sm:col-span-1 lg:col-span-1">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-6 relative pb-2">
                            Contact Information
                            <span class="absolute bottom-0 left-0 w-12 h-1 bg-red-600 rounded-full"></span>
                        </h3>
                        <div class="space-y-5">
                            <div class="group">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-red-50 rounded-md flex items-center justify-center group-hover:bg-red-100 transition-colors">
                                        <i class="fas fa-map-marker-alt text-red-600 text-sm"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Office Address</h4>
                                        <p class="text-sm text-gray-600 leading-relaxed">
                                            Jasamarga Green Residence AD. 6 No. 7<br>
                                            Sidoarjo, East Java, Indonesia
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-green-50 rounded-md flex items-center justify-center group-hover:bg-green-100 transition-colors">
                                        <i class="fas fa-phone text-green-600 text-sm"></i>
                                    </div>
                                    <div class="flex-1">
                                        @php
                                            $customerName = Auth::user()->name ?? 'Customer baru';
                                            $whatsappNumber = '6282139808850';
                                            $message = "Halo, Almeta Global Trilindo. Saya $customerName, ada kebutuhan pengiriman. Apa bisa dibantu?";
                                            $encodedMessage = urlencode($message);
                                        @endphp
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">WhatsApp</h4>
                                        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $encodedMessage }}"
                                            target="_blank"
                                            class="text-sm text-gray-600 hover:text-green-600 transition-colors hover:underline">
                                            +62 821-3980-8850
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Information -->
                    <div class="sm:col-span-1 lg:col-span-1">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-6 relative pb-2">
                            Email Us
                            <span class="absolute bottom-0 left-0 w-12 h-1 bg-blue-600 rounded-full"></span>
                        </h3>
                        <div class="space-y-5">
                            <div class="group">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-blue-50 rounded-md flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-envelope text-blue-600 text-sm"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Bussines Inquiries</h4>
                                        <a href="mailto:hendra@almetagt.com"
                                            class="text-sm text-gray-600 hover:text-blue-600 transition-colors hover:underline">
                                            hendra@almetagt.com
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-blue-50 rounded-md flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-headset text-blue-600 text-sm"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Customer Service</h4>
                                        <a href="mailto:cs@almetagt.com"
                                            class="text-sm text-gray-600 hover:text-blue-600 transition-colors hover:underline">
                                            cs@almetagt.com
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter & Social -->
                    <div class="sm:col-span-2 lg:col-span-1">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-6 relative pb-2">
                            Feedback
                            <span class="absolute bottom-0 left-0 w-12 h-1 bg-green-600 rounded-full"></span>
                        </h3>

                        <!-- Feedback -->
                        <div class="mb-8">
                            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                                This website's under Development, your any feedback help us to improve.
                            </p>
                            <a href="#" class="text-sm text-gray-600 hover:text-blue-600 transition-colors hover:underline">Click here to Feedback</a>
                        </div>

                        <!-- Social Media -->
                        <div>
                            <p class="text-sm font-semibold text-gray-700 mb-4">Follow Us</p>
                            <div class="flex space-x-3">
                                <a href="#"
                                    class="w-10 h-10 rounded-md bg-white border border-gray-200 flex items-center justify-center hover:border-blue-500 hover:bg-blue-50 transition-all duration-200 group">
                                    <i
                                        class="fab fa-facebook-f text-blue-600 group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-md bg-white border border-gray-200 flex items-center justify-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 group">
                                    <i
                                        class="fab fa-twitter text-blue-400 group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-md bg-white border border-gray-200 flex items-center justify-center hover:border-red-500 hover:bg-red-50 transition-all duration-200 group">
                                    <i
                                        class="fab fa-instagram text-red-500 group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-md bg-white border border-gray-200 flex items-center justify-center hover:border-blue-700 hover:bg-blue-50 transition-all duration-200 group">
                                    <i
                                        class="fab fa-linkedin-in text-blue-700 group-hover:scale-110 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-300 pt-8 sm:pt-10">
                    <!-- Bottom Footer -->
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <div class="text-center sm:text-left">
                            <p class="text-sm text-gray-500">
                                &copy; {{ date('Y') }} PT. ALMETA GLOBAL TRILINDO. All rights reserved.
                            </p>
                        </div>
                        <div class="flex flex-wrap justify-center sm:justify-end items-center gap-4 sm:gap-6">
                            <a href="#"
                                class="text-sm text-gray-500 hover:text-red-600 transition-colors hover:underline">
                                Privacy Policy
                            </a>
                            <a href="#"
                                class="text-sm text-gray-500 hover:text-red-600 transition-colors hover:underline">
                                Terms of Service
                            </a>
                            <a href="#"
                                class="text-sm text-gray-500 hover:text-red-600 transition-colors hover:underline">
                                FAQ
                            </a>
                            <span class="text-sm text-gray-400 bg-gray-200 px-2 py-1 rounded-md">
                                V.1.2.2
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

            // Form submission handling
            window.handleFormSubmit = function(event) {
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
        </script>
    </div>
</x-guest-layout>
