<x-guest-layout>
    @section('title-guest', 'Register')

    {{-- Notification Section --}}
    @if ($errors->any())
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
            <div
                class="mx-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-red-700 hover:text-red-900 focus:outline-none">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-b from-blue-500/10 to-purple-500/5 -z-10"></div>
        <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-gradient-to-t from-blue-500/5 to-transparent -z-10"></div>
        <div class="absolute top-20 left-20 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-20 right-20 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl -z-10"></div>

        <!-- Grid pattern background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.015] -z-10"></div>

        <!-- Content Container -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-6xl grid md:grid-cols-5 bg-white rounded-lg shadow-xl overflow-hidden">

                <!-- Left Column - Decorative Side with Background Image -->
                <div class="md:col-span-2 bg-cover bg-center bg-blue-600 bg-no-repeat p-8 relative hidden md:block overflow-hidden"
                    style="background-image: url('{{ asset('assets/img/Almeta-ship.png') }}');">

                    <!-- Dark overlay for better text readability -->
                    <div class="absolute inset-0 bg-black/40"></div>

                    <!-- Content -->
                    <div class="relative h-full flex flex-col justify-between text-white z-10">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">ALMETA GLOBAL</h2>
                            <div class="w-12 h-1 bg-white/50 mb-6"></div>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-3xl font-bold leading-tight">Join Our Network of Trusted Partners</h3>
                            <p class="text-white/90">Create your account today and gain access to our comprehensive
                                logistics platform. Streamline your shipping operations with Almeta.</p>

                            <!-- Testimonial -->
                            <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm mt-8">
                                <p class="italic text-white/80 text-sm mb-3">"Since partnering with Almeta, our shipping
                                    process has become significantly more efficient, reliable and cost-effective."</p>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-bold">CT</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Cargo Trust</p>
                                        <p class="text-xs text-white/70">Client since 2021</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-sm text-white/50">
                            &copy; {{ date('Y') }} Almeta Global Trilindo
                        </div>
                    </div>
                </div>

                <!-- Right Column - Form Side -->
                <div class="md:col-span-3 p-6 md:p-10 flex flex-col justify-center">
                    <div class="w-full mx-auto">
                        <div class="text-center mb-6">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Create Account</h1>
                            <p class="text-gray-600 mt-2">Register to access our shipping services</p>
                        </div>

                        <!-- Improved Sections Tabs -->
                        <div class="mb-6 border-b border-gray-200">
                            <ul class="flex space-x-1 text-sm md:text-base font-medium text-center overflow-hidden">
                                <li class="flex-1">
                                    <a href="#personal"
                                        class="inline-block w-full py-3 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active transition-colors"
                                        onclick="showSection('personal'); return false;">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Personal
                                        </div>
                                    </a>
                                </li>
                                <li class="flex-1">
                                    <a href="#business"
                                        class="inline-block w-full py-3 text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 rounded-t-lg transition-colors"
                                        onclick="showSection('business'); return false;">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            Business
                                        </div>
                                    </a>
                                </li>
                                <li class="flex-1">
                                    <a href="#documents"
                                        class="inline-block w-full py-3 text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 rounded-t-lg transition-colors"
                                        onclick="showSection('documents'); return false;">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Documents
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Personal Information Section --}}
                            <div id="personal-section" class="section-content">
                                <div class="space-y-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        {{-- Email --}}
                                        <div class="group">
                                            <label for="email"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Email Address
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                </span>
                                                <input id="email" type="email" name="email"
                                                    value="{{ old('email') }}"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('email') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="example@gmail.com">
                                            </div>
                                            @error('email')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Full Name --}}
                                        <div class="group">
                                            <label for="name"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Full Name
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </span>
                                                <input id="name" type="text" name="name"
                                                    value="{{ old('name') }}"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('name') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="Full name">
                                            </div>
                                            @error('name')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Password --}}
                                        <div class="group">
                                            <label for="password"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Password
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors z-10">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                </span>
                                                <input id="password" type="password" name="password"
                                                    class="block w-full pl-10 pr-14 h-12 py-3 border border-gray-300 rounded-lg shadow-sm
                @error('password') border-red-500 @enderror 
                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all duration-200"
                                                    required placeholder="••••••••">

                                                <button type="button" id="togglePassword"
                                                    class="absolute inset-y-0 right-0 flex items-center justify-center w-12 h-full text-gray-400 hover:text-gray-600 focus:outline-none focus:text-blue-600 transition-all duration-200 group/toggle rounded-r-lg hover:bg-gray-50"
                                                    aria-label="Toggle password visibility">

                                                    <svg id="eyeIcon"
                                                        class="w-5 h-5 transition-all duration-200 group-hover/toggle:scale-110"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>

                                                    <svg id="eyeSlashIcon"
                                                        class="w-5 h-5 hidden transition-all duration-200 group-hover/toggle:scale-110"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10.73 5.08A10.43 10.43 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 0 1-1.563 3.029" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6.758 6.758A10.451 10.451 0 0 0 2.458 12C3.732 16.057 7.523 19 12 19a10.45 10.45 0 0 0 5.242-1.758" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M3 3l18 18" />
                                                    </svg>

                                                    <span id="ripple"
                                                        class="absolute inset-0 rounded-r-lg opacity-0 bg-blue-200 pointer-events-none"></span>
                                                </button>
                                            </div>
                                            @error('password')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div class="group">
                                            <label for="password_confirmation"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Confirm Password
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors z-10">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                </span>
                                                <input id="password_confirmation" type="password"
                                                    name="password_confirmation"
                                                    class="block w-full pl-10 pr-14 h-12 py-3 border border-gray-300 rounded-lg shadow-sm
                                                        @error('password_confirmation') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all duration-200"
                                                    required placeholder="••••••••">

                                                <button type="button" id="togglePasswordConfirm"
                                                    class="absolute inset-y-0 right-0 flex items-center justify-center w-12 h-full text-gray-400 hover:text-gray-600 focus:outline-none focus:text-blue-600 transition-all duration-200 group/toggle rounded-r-lg hover:bg-gray-50"
                                                    aria-label="Toggle password confirmation visibility">

                                                    <svg id="eyeIconConfirm"
                                                        class="w-5 h-5 transition-all duration-200 group-hover/toggle:scale-110"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>

                                                    <svg id="eyeSlashIconConfirm"
                                                        class="w-5 h-5 hidden transition-all duration-200 group-hover/toggle:scale-110"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10.73 5.08A10.43 10.43 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 0 1-1.563 3.029" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6.758 6.758A10.451 10.451 0 0 0 2.458 12C3.732 16.057 7.523 19 12 19a10.45 10.45 0 0 0 5.242-1.758" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M3 3l18 18" />
                                                    </svg>

                                                    <span id="rippleConfirm"
                                                        class="absolute inset-0 rounded-r-lg opacity-0 bg-blue-200 pointer-events-none"></span>
                                                </button>
                                            </div>
                                            @error('password_confirmation')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-end mt-8">
                                        <button type="button"
                                            class="px-8 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-md
                                            hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center"
                                            onclick="showSection('business')">
                                            <span>Next: Business Details</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Business Information Section --}}
                            <div id="business-section" class="section-content hidden">
                                <div class="space-y-5">
                                    {{-- Company Name --}}
                                    <div class="group">
                                        <label for="company_name"
                                            class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                            Company Name
                                        </label>
                                        <div class="relative">
                                            <span
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            </span>
                                            <input id="company_name" type="text" name="company_name"
                                                value="{{ old('company_name') }}"
                                                class="uppercase block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('company_name') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                required placeholder="CV. EXAMPLE / PT. EXAMPLE">
                                        </div>
                                        @error('company_name')
                                            <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                        {{-- Company Phone Number --}}
                                        <div class="group">
                                            <label for="company_phone_number"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Company Phone Number
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                    </svg>
                                                </span>
                                                <input id="company_phone_number" type="number"
                                                    name="company_phone_number"
                                                    value="{{ old('company_phone_number') }}"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('company_phone_number') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="0812345678910">
                                            </div>
                                            @error('company_phone_number')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Company Location --}}
                                        <div class="group">
                                            <label for="company_location"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Company Location
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </span>
                                                <input id="company_location" type="text" name="company_location"
                                                    value="{{ old('company_location') }}"
                                                    class="block w-full pl-10 h-12 p-2 border border-gray-300 rounded-lg shadow-sm
                                                        @error('company_location') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="City">
                                            </div>
                                            @error('company_location')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Company Address --}}
                                        <div class="group md:col-span-2">
                                            <label for="company_address"
                                                class="block font-medium text-gray-700 text-sm mb-2 ml-1 group-focus-within:text-blue-600 transition-colors">
                                                Company Address
                                            </label>
                                            <div class="relative">
                                                <span
                                                    class="absolute top-3 left-3 flex items-start text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                    </svg>
                                                </span>
                                                <textarea id="company_address" name="company_address"
                                                    class="w-full resize-none pl-10 h-24 mt-1 p-2 block rounded-lg border border-gray-300 shadow-sm
                                                        @error('company_address') border-red-500 @enderror 
                                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 focus:outline-none transition-all duration-200"
                                                    required placeholder="Example Street No. 99, Surabaya, East Java">{{ old('company_address') }}</textarea>
                                            </div>
                                            @error('company_address')
                                                <p class="text-red-600 text-sm mt-2 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between mt-8">
                                        <button type="button"
                                            class="px-8 py-3 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg shadow-md
                                            hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center"
                                            onclick="showSection('personal')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                            <span>Back: Personal Info</span>
                                        </button>
                                        <button type="button"
                                            class="px-8 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-md
                                            hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center"
                                            onclick="showSection('documents')">
                                            <span>Next: Documents</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Document Upload Section --}}
                            {{-- Document Upload Section --}}
                            <div id="documents-section" class="section-content hidden">
                                <div class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                        <!-- KTP Upload -->
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm"
                                            id="ktp-container">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-2 text-blue-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                                Upload KTP
                                            </label>

                                            <!-- Upload Area -->
                                            <div class="flex items-center justify-center w-full" id="ktp-upload-area">
                                                <label for="ktp"
                                                    class="flex flex-col items-center justify-center w-full h-28 border border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <div class="flex flex-col items-center justify-center pt-4 pb-4">
                                                        <svg class="w-8 h-8 mb-2 text-gray-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-1 text-sm text-gray-700"><span
                                                                class="font-medium text-blue-600">Click to
                                                                upload</span></p>
                                                        <p class="text-xs text-gray-500">PNG, JPG (Max. 2MB)</p>
                                                    </div>
                                                    <input id="ktp" type="file" name="ktp"
                                                        accept="image/*" class="hidden" />
                                                </label>
                                            </div>

                                            <!-- Success State (Hidden by default) -->
                                            <div class="hidden w-full" id="ktp-success-area">
                                                <div
                                                    class="flex flex-col items-center justify-center p-4 bg-green-50 border-2 border-green-200 border-dashed rounded-md">
                                                    <!-- Success Icon -->
                                                    <div
                                                        class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-3">
                                                        <svg class="w-8 h-8 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </div>
                                                    <!-- File Info -->
                                                    <div class="text-center mb-3">
                                                        <p class="text-sm font-medium text-green-800"
                                                            id="ktp-filename">Document uploaded</p>
                                                        <p class="text-xs text-green-600" id="ktp-filesize">0 KB</p>
                                                    </div>
                                                    <!-- Upload Button -->
                                                    <button type="button" onclick="retriggerUpload('ktp')"
                                                        class="px-4 py-2 text-xs font-medium text-blue-600 bg-white border border-blue-200 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                                        Upload File
                                                    </button>
                                                </div>
                                            </div>

                                            @error('ktp')
                                                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- NPWP Upload -->
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm"
                                            id="npwp-container">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-2 text-blue-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                Upload NPWP
                                            </label>

                                            <!-- Upload Area -->
                                            <div class="flex items-center justify-center w-full"
                                                id="npwp-upload-area">
                                                <label for="npwp"
                                                    class="flex flex-col items-center justify-center w-full h-28 border border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <div class="flex flex-col items-center justify-center pt-4 pb-4">
                                                        <svg class="w-8 h-8 mb-2 text-gray-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-1 text-sm text-gray-700"><span
                                                                class="font-medium text-blue-600">Click to
                                                                upload</span></p>
                                                        <p class="text-xs text-gray-500">PNG, JPG (Max. 2MB)</p>
                                                    </div>
                                                    <input id="npwp" type="file" name="npwp"
                                                        accept="image/*" class="hidden" />
                                                </label>
                                            </div>

                                            <!-- Success State (Hidden by default) -->
                                            <div class="hidden w-full" id="npwp-success-area">
                                                <div
                                                    class="flex flex-col items-center justify-center p-4 bg-green-50 border-2 border-green-200 border-dashed rounded-md">
                                                    <!-- Success Icon -->
                                                    <div
                                                        class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-3">
                                                        <svg class="w-8 h-8 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </div>
                                                    <!-- File Info -->
                                                    <div class="text-center mb-3">
                                                        <p class="text-sm font-medium text-green-800"
                                                            id="npwp-filename">Document uploaded</p>
                                                        <p class="text-xs text-green-600" id="npwp-filesize">0 KB</p>
                                                    </div>
                                                    <!-- Upload Button -->
                                                    <button type="button" onclick="retriggerUpload('npwp')"
                                                        class="px-4 py-2 text-xs font-medium text-blue-600 bg-white border border-blue-200 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                                        Upload File
                                                    </button>
                                                </div>
                                            </div>

                                            @error('npwp')
                                                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- NIB Upload -->
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm"
                                            id="nib-container">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-2 text-blue-600" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                                </svg>
                                                Upload NIB
                                            </label>

                                            <!-- Upload Area -->
                                            <div class="flex items-center justify-center w-full" id="nib-upload-area">
                                                <label for="nib"
                                                    class="flex flex-col items-center justify-center w-full h-28 border border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <div class="flex flex-col items-center justify-center pt-4 pb-4">
                                                        <svg class="w-8 h-8 mb-2 text-gray-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-1 text-sm text-gray-700"><span
                                                                class="font-medium text-blue-600">Click to
                                                                upload</span></p>
                                                        <p class="text-xs text-gray-500">PNG, JPG (Max. 2MB)</p>
                                                    </div>
                                                    <input id="nib" type="file" name="nib"
                                                        accept="image/*" class="hidden" />
                                                </label>
                                            </div>

                                            <!-- Success State (Hidden by default) -->
                                            <div class="hidden w-full" id="nib-success-area">
                                                <div
                                                    class="flex flex-col items-center justify-center p-4 bg-green-50 border-2 border-green-200 border-dashed rounded-md">
                                                    <!-- Success Icon -->
                                                    <div
                                                        class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-3">
                                                        <svg class="w-8 h-8 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </div>
                                                    <!-- File Info -->
                                                    <div class="text-center mb-3">
                                                        <p class="text-sm font-medium text-green-800"
                                                            id="nib-filename">Document uploaded</p>
                                                        <p class="text-xs text-green-600" id="nib-filesize">0 KB</p>
                                                    </div>
                                                    <!-- Upload Button -->
                                                    <button type="button" onclick="retriggerUpload('nib')"
                                                        class="px-4 py-2 text-xs font-medium text-blue-600 bg-white border border-blue-200 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                                        Upload File
                                                    </button>
                                                </div>
                                            </div>

                                            @error('nib')
                                                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between mt-8">
                                        <button type="button"
                                            class="px-8 py-3 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg shadow-md
                                            hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center"
                                            onclick="showSection('business')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                            <span>Back: Business Info</span>
                                        </button>
                                        <button type="submit"
                                            class="px-8 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-md
                                            hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                            transition-all duration-300 flex items-center">
                                            <span>Create Account</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- Login Link --}}
                        <div class="mt-6 text-center">
                            <a href="{{ route('login') }}" wire:navigate
                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                </svg>
                                Already have an account? <span class="font-semibold ml-1">Login</span>
                            </a>
                        </div>

                        <!-- Mobile-only footer -->
                        <div class="md:hidden text-center text-xs text-gray-500 mt-10">
                            &copy; {{ date('Y') }} Almeta Global Trilindo. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('register-script')
        <script>
            function showSection(sectionId) {
                // Hide all sections
                document.querySelectorAll('.section-content').forEach(section => {
                    section.classList.add('hidden');
                });

                // Show the selected section
                document.getElementById(sectionId + '-section').classList.remove('hidden');

                // Update active tab
                document.querySelectorAll('a[href^="#"]').forEach(tab => {
                    if (tab.getAttribute('href') === '#' + sectionId) {
                        tab.classList.add('text-blue-600', 'border-blue-600');
                        tab.classList.remove('text-gray-500', 'border-transparent', 'hover:text-gray-700',
                            'hover:border-gray-300');
                    } else {
                        tab.classList.remove('text-blue-600', 'border-blue-600');
                        tab.classList.add('text-gray-500', 'border-transparent', 'hover:text-gray-700',
                            'hover:border-gray-300');
                    }
                });
            }

            // Password Toggle Functionality for Register Form
            function setupPasswordToggle(inputId, toggleId, eyeId, eyeSlashId, rippleId) {
                const passwordInput = document.getElementById(inputId);
                const toggleButton = document.getElementById(toggleId);
                const eyeIcon = document.getElementById(eyeId);
                const eyeSlashIcon = document.getElementById(eyeSlashId);
                const ripple = document.getElementById(rippleId);

                if (!passwordInput || !toggleButton || !eyeIcon || !eyeSlashIcon) return;

                function createRippleEffect() {
                    if (ripple) {
                        ripple.classList.add('ripple-animation');
                        setTimeout(() => {
                            ripple.classList.remove('ripple-animation');
                        }, 300);
                    }
                }

                function togglePasswordVisibility() {
                    const isPassword = passwordInput.type === 'password';

                    // Toggle password type
                    passwordInput.type = isPassword ? 'text' : 'password';

                    // Toggle icons with animation
                    if (isPassword) {
                        eyeIcon.classList.add('hidden');
                        eyeSlashIcon.classList.remove('hidden');
                        eyeSlashIcon.classList.add('icon-fade-in');
                    } else {
                        eyeSlashIcon.classList.add('hidden');
                        eyeIcon.classList.remove('hidden');
                        eyeIcon.classList.add('icon-fade-in');
                    }

                    // Remove animation class after animation completes
                    setTimeout(() => {
                        eyeIcon.classList.remove('icon-fade-in');
                        eyeSlashIcon.classList.remove('icon-fade-in');
                    }, 200);

                    // Update aria-label for accessibility
                    toggleButton.setAttribute('aria-label',
                        isPassword ? 'Hide password' : 'Show password'
                    );

                    // Create ripple effect
                    createRippleEffect();

                    // Brief focus back to input for better UX
                    passwordInput.focus();
                }

                // Click event
                toggleButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    togglePasswordVisibility();
                });

                // Keyboard support
                toggleButton.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        togglePasswordVisibility();
                    }
                });

                // Touch support for mobile
                let touchStarted = false;
                toggleButton.addEventListener('touchstart', function() {
                    touchStarted = true;
                });

                toggleButton.addEventListener('touchend', function(e) {
                    if (touchStarted) {
                        e.preventDefault();
                        togglePasswordVisibility();
                        touchStarted = false;
                    }
                });

                // Prevent form submission when clicking toggle
                toggleButton.addEventListener('mousedown', function(e) {
                    e.preventDefault();
                });
            }

            // Enhanced File Upload with Success State
            function setupEnhancedFileUpload() {
                const fileInputs = ['ktp', 'npwp', 'nib'];

                fileInputs.forEach(inputId => {
                    const input = document.getElementById(inputId);
                    if (input) {
                        input.addEventListener('change', function() {
                            const file = this.files[0];
                            if (file) {
                                handleFileUploadSuccess(inputId, file);
                            }
                        });
                    }
                });
            }

            function handleFileUploadSuccess(inputId, file) {
                const uploadArea = document.getElementById(`${inputId}-upload-area`);
                const successArea = document.getElementById(`${inputId}-success-area`);
                const filenameElement = document.getElementById(`${inputId}-filename`);
                const filesizeElement = document.getElementById(`${inputId}-filesize`);

                // Format file size
                const fileSize = formatFileSize(file.size);

                // Update success area content
                if (filenameElement) {
                    filenameElement.textContent = file.name;
                }
                if (filesizeElement) {
                    filesizeElement.textContent = fileSize;
                }

                // Hide upload area and show success area
                if (uploadArea && successArea) {
                    uploadArea.classList.add('hidden');
                    successArea.classList.remove('hidden');

                    // Add success animation
                    successArea.style.opacity = '0';
                    successArea.style.transform = 'scale(0.95)';

                    requestAnimationFrame(() => {
                        successArea.style.transition = 'all 0.3s ease-out';
                        successArea.style.opacity = '1';
                        successArea.style.transform = 'scale(1)';
                    });
                }

                // Update container styling
                const container = document.getElementById(`${inputId}-container`);
                if (container) {
                    container.classList.remove('bg-gray-50', 'border-gray-200');
                    container.classList.add('bg-green-50', 'border-green-200');
                }
            }

            function retriggerUpload(inputId) {
                const input = document.getElementById(inputId);
                const uploadArea = document.getElementById(`${inputId}-upload-area`);
                const successArea = document.getElementById(`${inputId}-success-area`);
                const container = document.getElementById(`${inputId}-container`);

                // Reset file input
                if (input) {
                    input.value = '';
                    input.click();
                }

                // Show upload area and hide success area
                if (uploadArea && successArea) {
                    successArea.classList.add('hidden');
                    uploadArea.classList.remove('hidden');
                }

                // Reset container styling
                if (container) {
                    container.classList.remove('bg-green-50', 'border-green-200');
                    container.classList.add('bg-gray-50', 'border-gray-200');
                }
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';

                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));

                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // DOM Content Loaded Event - Main Initialization
            document.addEventListener('DOMContentLoaded', function() {

                // Initialize Password Toggle Functions
                setupPasswordToggle('password', 'togglePassword', 'eyeIcon', 'eyeSlashIcon', 'ripple');
                setupPasswordToggle('password_confirmation', 'togglePasswordConfirm', 'eyeIconConfirm',
                    'eyeSlashIconConfirm', 'rippleConfirm');

                // Setup enhanced file upload
                setupEnhancedFileUpload();

                // Password Strength Checker (Optional Enhancement)
                const passwordInput = document.getElementById('password');
                if (passwordInput) {
                    passwordInput.addEventListener('input', function() {
                        const password = this.value;
                        // You can add password strength validation here if needed
                        // For example: checkPasswordStrength(password);
                    });
                }

                // Password Confirmation Validation
                const passwordConfirmInput = document.getElementById('password_confirmation');
                if (passwordConfirmInput && passwordInput) {
                    function validatePasswordMatch() {
                        const password = passwordInput.value;
                        const passwordConfirm = passwordConfirmInput.value;

                        if (passwordConfirm && password !== passwordConfirm) {
                            passwordConfirmInput.setCustomValidity('Password tidak cocok');
                            passwordConfirmInput.classList.add('border-red-500');
                            passwordConfirmInput.classList.remove('border-gray-300');
                        } else {
                            passwordConfirmInput.setCustomValidity('');
                            passwordConfirmInput.classList.remove('border-red-500');
                            passwordConfirmInput.classList.add('border-gray-300');
                        }
                    }

                    passwordConfirmInput.addEventListener('input', validatePasswordMatch);
                    passwordInput.addEventListener('input', function() {
                        if (passwordConfirmInput.value) {
                            validatePasswordMatch();
                        }
                    });
                }

                // Form Validation Enhancement
                const form = document.querySelector('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        // Additional validation can be added here
                        const requiredFields = form.querySelectorAll('[required]');
                        let isValid = true;

                        requiredFields.forEach(field => {
                            if (!field.value.trim()) {
                                field.classList.add('border-red-500');
                                isValid = false;
                            } else {
                                field.classList.remove('border-red-500');
                            }
                        });

                        if (!isValid) {
                            e.preventDefault();
                            showSection('personal');
                        }
                    });
                }

                function checkSectionCompletion(sectionId) {
                    const section = document.getElementById(sectionId + '-section');
                    if (!section) return false;

                    const requiredFields = section.querySelectorAll('[required]');
                    return Array.from(requiredFields).every(field => field.value.trim() !== '');
                }

                // Auto-advance to next section when current section is completed (Optional)
                document.querySelectorAll('input[required], textarea[required], select[required]').forEach(field => {
                    field.addEventListener('blur', function() {
                        const currentSection = this.closest('.section-content');
                        if (currentSection) {
                            const sectionId = currentSection.id.replace('-section', '');
                            if (checkSectionCompletion(sectionId)) {
                                // Optional: Auto-advance to next section
                                // Uncomment the next lines if you want auto-advance
                                // if (sectionId === 'personal') showSection('business');
                                // else if (sectionId === 'business') showSection('documents');
                            }
                        }
                    });
                });

                console.log('Register form initialized successfully');
            });

            // Utility function for password strength (if needed later)
            function checkPasswordStrength(password) {
                let score = 0;

                if (password.length >= 8) score += 1;
                if (password.length >= 12) score += 1;
                if (/[a-z]/.test(password)) score += 1;
                if (/[A-Z]/.test(password)) score += 1;
                if (/[0-9]/.test(password)) score += 1;
                if (/[^A-Za-z0-9]/.test(password)) score += 1;

                // Return strength level
                if (score < 2) return {
                    level: 'weak',
                    color: 'red'
                };
                if (score < 4) return {
                    level: 'fair',
                    color: 'orange'
                };
                if (score < 5) return {
                    level: 'good',
                    color: 'yellow'
                };
                if (score < 6) return {
                    level: 'strong',
                    color: 'blue'
                };
                return {
                    level: 'very-strong',
                    color: 'green'
                };
            }

            // Additional utility functions
            function formatPhoneNumber(input) {
                // Format phone number as user types (Optional)
                let value = input.value.replace(/\D/g, '');
                if (value.startsWith('0')) {
                    value = '+62' + value.substring(1);
                }
                return value;
            }

            // Initialize additional features when needed
            function initializeAdvancedFeatures() {
                // Phone number formatting
                const phoneInput = document.getElementById('company_phone_number');
                if (phoneInput) {
                    phoneInput.addEventListener('input', function() {
                        // Optional: Format phone number
                        // this.value = formatPhoneNumber(this);
                    });
                }

                // Company name uppercase transformation
                const companyNameInput = document.getElementById('company_name');
                if (companyNameInput) {
                    companyNameInput.addEventListener('input', function() {
                        this.value = this.value.toUpperCase();
                    });
                }

                // File drag and drop support
                const fileContainers = ['ktp', 'npwp', 'nib'];
                fileContainers.forEach(containerId => {
                    const container = document.getElementById(`${containerId}-upload-area`);
                    if (container) {
                        container.addEventListener('dragover', function(e) {
                            e.preventDefault();
                            container.classList.add('border-blue-400', 'bg-blue-50');
                        });

                        container.addEventListener('dragleave', function(e) {
                            e.preventDefault();
                            container.classList.remove('border-blue-400', 'bg-blue-50');
                        });

                        container.addEventListener('drop', function(e) {
                            e.preventDefault();
                            container.classList.remove('border-blue-400', 'bg-blue-50');

                            const files = e.dataTransfer.files;
                            if (files.length > 0) {
                                const input = document.getElementById(containerId);
                                if (input) {
                                    input.files = files;
                                    const event = new Event('change', {
                                        bubbles: true
                                    });
                                    input.dispatchEvent(event);
                                }
                            }
                        });
                    }
                });
            }

            // Call advanced features initialization
            document.addEventListener('DOMContentLoaded', initializeAdvancedFeatures);

            // File validation function
            function validateFile(file, maxSize = 2 * 1024 * 1024) { // 2MB default
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

                if (!allowedTypes.includes(file.type)) {
                    alert('File type not supported. Please upload JPG, JPEG, or PNG files only.');
                    return false;
                }

                if (file.size > maxSize) {
                    alert('File size too large. Please upload files smaller than 2MB.');
                    return false;
                }

                return true;
            }

            // Enhanced file upload with validation
            function enhancedFileHandler(inputId, file) {
                if (validateFile(file)) {
                    handleFileUploadSuccess(inputId, file);
                } else {
                    // Reset input if validation fails
                    const input = document.getElementById(inputId);
                    if (input) {
                        input.value = '';
                    }
                }
            }
        </script>
    @endpush

    <style>
        /* Background grid pattern */
        .bg-grid-pattern {
            background-size: 20px 20px;
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
        }

        /* Basic animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Password toggle button styles */
        #togglePassword,
        #togglePasswordConfirm {
            border-left: 1px solid transparent;
            transition: all 0.2s ease-in-out;
        }

        #togglePassword:hover,
        #togglePasswordConfirm:hover {
            border-left-color: rgba(229, 231, 235, 0.8);
        }

        #togglePassword:focus,
        #togglePasswordConfirm:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
            border-radius: 0 0.5rem 0.5rem 0;
        }

        /* Input focus enhancement */
        #password:focus+button,
        #password_confirmation:focus+button {
            border-left-color: rgba(59, 130, 246, 0.3);
        }

        /* Ripple animation for password toggle */
        @keyframes ripple {
            0% {
                transform: scale(0);
                opacity: 0.6;
            }

            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        .ripple-animation {
            animation: ripple 0.3s ease-out;
        }

        /* Icon animation on toggle */
        @keyframes iconFadeIn {
            0% {
                opacity: 0;
                transform: scale(0.8) rotate(-10deg);
            }

            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        .icon-fade-in {
            animation: iconFadeIn 0.2s ease-out;
        }

        /* Enhanced file upload animations */
        @keyframes successPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .upload-success-enter {
            animation: successPulse 0.5s ease-out;
        }

        /* Success state transitions */
        .success-area-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Upload button hover effects */
        .upload-retry-btn {
            transition: all 0.2s ease-in-out;
        }

        .upload-retry-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        /* Container state changes */
        .upload-container-success {
            border-color: #10b981 !important;
            background-color: #ecfdf5 !important;
        }

        /* File upload drag and drop styles */
        .drag-over {
            border-color: #3b82f6 !important;
            background-color: #eff6ff !important;
        }

        /* Remove number input arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Enhanced focus styles */
        input:focus,
        textarea:focus,
        select:focus,
        button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Form validation styles */
        .border-red-500 {
            border-color: #ef4444 !important;
        }

        .border-green-500 {
            border-color: #10b981 !important;
        }

        /* Tab navigation enhancements */
        .tab-indicator {
            position: relative;
        }

        .tab-indicator::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: currentColor;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .tab-indicator.active::after {
            transform: scaleX(1);
        }

        /* Loading states */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Button enhancements */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* File upload area enhancements */
        .file-upload-area {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .file-upload-area::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
            opacity: 0;
        }

        .file-upload-area:hover::before {
            opacity: 1;
            animation: shimmer 1.5s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        /* Success state styling */
        .success-state {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            animation: successGlow 2s ease-in-out;
        }

        @keyframes successGlow {

            0%,
            100% {
                box-shadow: 0 0 5px rgba(16, 185, 129, 0.3);
            }

            50% {
                box-shadow: 0 0 20px rgba(16, 185, 129, 0.6);
            }
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .bg-grid-pattern {
                background-size: 15px 15px;
            }

            .file-upload-area {
                min-height: 120px;
            }

            .upload-retry-btn {
                padding: 8px 16px;
                font-size: 12px;
            }
        }

        /* Dark mode support (optional) */
        @media (prefers-color-scheme: dark) {
            .bg-grid-pattern {
                background-image:
                    linear-gradient(to right, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            }
        }

        /* Accessibility improvements */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {

            input,
            textarea,
            button {
                border-width: 2px !important;
            }

            .upload-retry-btn {
                border-width: 2px !important;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Print styles */
        @media print {

            .file-upload-area,
            .upload-retry-btn,
            button {
                display: none !important;
            }
        }
    </style>
</x-guest-layout>
