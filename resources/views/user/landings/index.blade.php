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
                            <img src="{{ asset('assets/img/Kop Surat Almeta Global Trilindo For Websites (BG Removed).png') }}"
                                alt="Almeta Logo" class="h-7 md:h-10 w-auto max-w-[230px] object-contain">
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div
                        class="hidden md:flex items-center space-x-4 lg:space-x-5 absolute left-1/2 transform -translate-x-1/2">
                        <a href="#"
                            class="text-gray-600 hover:text-blue-800 font-medium whitespace-nowrap">Home</a>
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-blue-800 font-medium whitespace-nowrap">Dashboard</a>
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
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-blue-800 hover:bg-gray-50">Dashboard</a>
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
                class="fixed top-20 right-4 z-50 flex items-center justify-between bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg max-w-sm"
                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)">
                <div class="flex items-center">
                    <i class="fas fa-comment-dots mr-3 text-green-700"></i>
                    <span class="font-medium text-sm">{{ session('feedback_success') }}</span>
                </div>
                <button onclick="document.getElementById('feedback-success-alert').style.display='none'"
                    class="text-green-600 hover:text-green-800 focus:outline-none ml-4 flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
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
                            <a href="{{ route('register') }}" wire:navigate
                                class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold rounded-full text-blue-800 bg-white hover:bg-gray-50 shadow-md w-full sm:w-auto"
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


        <!-- Features Section -->
        {{--  --}}

        <div class="relative">
            <!-- Desktop Timeline bar -->
            <div
                class="hidden sm:block absolute top-1/2 left-0 right-0 h-0.5 bg-gray-200 transform -translate-y-1/2 z-0 mx-8 lg:mx-12">
            </div>

            <!-- Mobile: Vertical Timeline -->
            <div class="sm:hidden absolute left-5 top-12 bottom-12 w-0.5 bg-gray-200 z-0">
            </div>


            <!-- Features Section -->
            <div id="features" class="pt-8 sm:pt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Header Section -->
                    <div class="text-center mb-8 sm:mb-12">
                        <h2
                            class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 sm:mb-4 flex items-center justify-center gap-3">
                            <img src="{{ asset('../assets/img/Logo Polos Almeta Global Trilindo.png') }}"
                                alt="Almeta Logo" class="h-20 sm:h-24 w-auto">
                            Company Background
                        </h2>
                        <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">
                            Experience superior logistics services backed by proven performance metrics and
                            comprehensive
                            solutions tailored for businesses across Indonesia
                        </p>
                    </div>

                    <!-- Key Metrics Section -->
                    <div class="bg-white shadow-sm border border-gray-200 rounded-lg mb-12 sm:mb-16 overflow-hidden">
                        <div class="px-4 py-3 bg-blue-800 text-white">
                            <h3 class="text-base font-semibold">Performance Metrics</h3>
                            <p class="text-xs text-blue-100 mt-1">Proven track record of excellence in logistics
                                services
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
                                <div class="text-2xl font-bold text-gray-900 mb-1">4.9<span
                                        class="text-base">/5</span>
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
                    <div class="mb-8 sm:mb-12">
                        <div class="text-center mb-4 sm:mb-6">
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Core Service Advantages</h3>
                            <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">
                                Three fundamental pillars that make companies the preferred logistics partner for
                                businesses
                                nationwide
                            </p>
                        </div>

                        <!-- Simplified Carousel Container -->
                        <div class="relative bg-white overflow-hidden">
                            <div id="services-carousel" class="relative">
                                <!-- Service 1 -->
                                <div class="carousel-slide opacity-100 p-3 sm:p-4" data-slide="0">
                                    <div
                                        class="flex flex-col lg:flex-row items-center lg:items-start gap-3 lg:gap-4 max-w-5xl mx-auto">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-800 text-white rounded-lg flex items-center justify-center">
                                                <i class="fas fa-shipping-fast text-sm sm:text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-center lg:text-left">
                                            <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-1 sm:mb-2">Fast &
                                                Efficient
                                                Delivery</h4>
                                            <p class="text-gray-600 mb-2 sm:mb-3 leading-relaxed text-xs sm:text-sm">
                                                Advanced logistics network ensuring quick delivery times across
                                                Indonesia's
                                                most challenging routes.
                                                Our optimized supply chain reduces transit time by up to 30% compared to
                                                traditional methods.
                                            </p>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-2">
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-blue-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-blue-800 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Express shipping
                                                        options
                                                        available</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-blue-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-blue-800 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Real-time tracking
                                                        system</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-blue-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-blue-800 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Priority handling for
                                                        urgent cargo</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-blue-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-blue-800 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Multi-modal
                                                        transportation</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service 2 -->
                                <div class="carousel-slide opacity-0 absolute inset-0 p-3 sm:p-4" data-slide="1">
                                    <div
                                        class="flex flex-col lg:flex-row-reverse items-center lg:items-start gap-3 lg:gap-4 max-w-5xl mx-auto">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-10 h-10 sm:w-12 sm:h-12 bg-red-600 text-white rounded-lg flex items-center justify-center">
                                                <i class="fas fa-shield-alt text-sm sm:text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-center lg:text-left">
                                            <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-1 sm:mb-2">Comprehensive
                                                Security & Safety</h4>
                                            <p class="text-gray-600 mb-2 sm:mb-3 leading-relaxed text-xs sm:text-sm">
                                                End-to-end cargo protection with advanced security measures, insurance
                                                coverage, and
                                                temperature-controlled environments for sensitive goods. Your cargo's
                                                safety
                                                is guaranteed.
                                            </p>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-2">
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-red-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-red-600 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Full cargo insurance
                                                        included</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-red-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-red-600 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">GPS tracking &
                                                        monitoring</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-red-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-red-600 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Secure warehouse
                                                        facilities</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-red-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-red-600 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Climate-controlled
                                                        storage</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service 3 -->
                                <div class="carousel-slide opacity-0 absolute inset-0 p-3 sm:p-4" data-slide="2">
                                    <div
                                        class="flex flex-col lg:flex-row items-center lg:items-start gap-3 lg:gap-4 max-w-5xl mx-auto">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-800 text-white rounded-lg flex items-center justify-center">
                                                <i class="fas fa-cogs text-sm sm:text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-center lg:text-left">
                                            <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-1 sm:mb-2">Reliable &
                                                Consistent Service</h4>
                                            <p class="text-gray-600 mb-2 sm:mb-3 leading-relaxed text-xs sm:text-sm">
                                                Proven track record with consistent performance across all service
                                                levels.
                                                Our experienced
                                                team and deep local market knowledge ensure dependable logistics
                                                solutions
                                                for your business needs.
                                            </p>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-2">
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-gray-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-gray-800 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">5+ years industry
                                                        experience</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-gray-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-gray-800 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Local expertise &
                                                        knowledge</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-gray-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-gray-800 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Predictable delivery
                                                        schedules</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-center lg:justify-start text-gray-700 bg-gray-50 p-1.5 sm:p-2 rounded">
                                                    <i class="fas fa-check text-gray-800 mr-1.5 text-xs"></i>
                                                    <span class="font-medium text-xs">Dedicated account
                                                        management</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Simple Progress Indicators -->
                            <div class="flex justify-center space-x-2 pb-2 pt-1">
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
                                Ready to experience reliable logistics solutions? Contact our team for a customized
                                quote.
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
                                            <h4 class="font-semibold text-gray-900 text-xs mb-0.5">Business Inquiries
                                            </h4>
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
                                            <h4 class="font-semibold text-gray-900 text-xs mb-0.5">Customer Service
                                            </h4>
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
                            {{-- <div>
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
                            </div> --}}
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
                                    V.1.5.3
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


                });



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

            <style>
                /* Carousel specific styles */
                #services-carousel {
                    min-height: 280px;
                    /* Reduced height for mobile */
                }

                /* Responsive height adjustments */
                @media (min-width: 640px) {
                    #services-carousel {
                        min-height: 320px;
                    }
                }

                @media (min-width: 1024px) {
                    #services-carousel {
                        min-height: 360px;
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
