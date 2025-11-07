<x-guest-layout>
    @section('title-guest', 'Login')

    {{-- Notification Section --}}
    @if ($errors->any())
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
            <div class="mx-4 bg-red-50 border border-red-600 text-red-700 px-4 py-3 rounded shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-red-600 hover:text-red-700 focus:outline-none">
                        <span class="text-xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
            <div class="mx-4 bg-blue-50 border border-blue-800 text-blue-800 px-4 py-3 rounded shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm">
                            {{ session('success') }}
                        </span>
                    </div>
                    <button onclick="this.parentElement.remove()"
                        class="text-blue-800 hover:text-black focus:outline-none">
                        <span class="text-xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-white">
        <!-- Content Container -->
        <div class="min-h-screen flex items-center justify-center p-3">
            <div
                class="w-full max-w-5xl grid md:grid-cols-5 bg-white rounded border border-gray-300 shadow overflow-hidden">

                <!-- Left Column - Decorative Side with Background Image -->
                <div class="md:col-span-2 bg-center bg-blue-800 bg-no-repeat p-6 relative hidden md:block overflow-hidden"
                    style="background-image: url('{{ asset('assets/img/Almeta-ship.png') }}'); background-size: 120%; background-position: center;">

                    <!-- Dark overlay for better text readability -->
                    <div class="absolute inset-0 bg-black/50"></div>

                    <!-- Content -->
                    <div class="relative h-full flex flex-col justify-between text-white z-10">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">ALMETA GLOBAL</h2>
                            <div class="w-12 h-1 bg-white/50 mb-6"></div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-2xl font-bold leading-tight">Seamless Shipping Solutions For Your Business
                            </h3>
                            <p class="text-white/90 text-sm">Secure, reliable, and efficient logistics management for
                                your global business operations.</p>

                            <!-- Stats -->
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <div class="bg-white/10 p-3 rounded text-center">
                                    <div class="text-xl font-bold">500+</div>
                                    <div class="text-xs text-white/80">Clients</div>
                                </div>
                                <div class="bg-white/10 p-3 rounded text-center">
                                    <div class="text-xl font-bold">24/7</div>
                                    <div class="text-xs text-white/80">Support</div>
                                </div>
                            </div>
                        </div>

                        <div class="text-sm text-white/50">
                            &copy; {{ date('Y') }} Almeta Global Trilindo
                        </div>
                    </div>
                </div>

                <!-- Right Column - Form Side -->
                <div class="md:col-span-3 p-6 md:p-8 flex flex-col justify-center">
                    <div class="max-w-md w-full mx-auto">
                        <div class="text-center mb-6">
                            <h1 class="text-xl md:text-2xl font-bold text-black">Welcome Back</h1>
                            <p class="text-gray-600 mt-1 text-sm">Please sign in to access your account</p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-4">
                            @csrf

                            {{-- Email --}}
                            <div class="group">
                                <label for="email" class="block font-medium text-black text-sm mb-1">Email
                                    Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="block w-full pl-10 h-10 px-3 py-2 border @error('email') border-red-600 @else border-gray-300 @enderror rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 focus:outline-none text-sm"
                                        required placeholder="example@gmail.com">
                                </div>
                            </div>

                            {{-- Password with Show/Hide Toggle --}}
                            <div class="group">
                                <label for="password" class="block font-medium text-black text-sm mb-1">Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 z-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>

                                    <input id="password" type="password" name="password"
                                        class="block w-full pl-10 pr-12 h-10 px-3 py-2 border @error('password') border-red-600 @else border-gray-300 @enderror rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 focus:outline-none text-sm"
                                        required placeholder="••••••••">

                                    <!-- Enhanced Password Toggle Button -->
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 right-0 flex items-center justify-center w-10 h-full text-gray-500 hover:text-blue-800 focus:outline-none focus:text-blue-800"
                                        aria-label="Toggle password visibility">

                                        <!-- Eye Icon (Show Password) -->
                                        <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        <svg id="eyeSlashIcon" class="w-4 h-4 hidden" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.73 5.08A10.43 10.43 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 0 1-1.563 3.029" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.758 6.758A10.451 10.451 0 0 0 2.458 12C3.732 16.057 7.523 19 12 19a10.45 10.45 0 0 0 5.242-1.758" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Remember Me --}}
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember"
                                    class="w-4 h-4 rounded border-gray-300 text-blue-800 focus:border-blue-800 focus:ring-1 focus:ring-blue-800">
                                <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                            </div>

                            {{-- Submit --}}
                            <div>
                                <button type="submit"
                                    class="w-full px-6 py-2 bg-blue-800 text-white text-sm font-medium rounded hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-800">
                                    Sign In
                                </button>
                            </div>

                            {{-- Links --}}
                            <div
                                class="flex flex-col sm:flex-row items-center justify-between pt-2 space-y-2 sm:space-y-0">
                                <a href="{{ route('register') }}" wire:navigate
                                    class="text-sm text-gray-600 hover:text-blue-800">
                                    Don't have an account? <span class="font-semibold">Register</span>
                                </a>
                                <a href="{{ route('password.request') }}" wire:navigate
                                    class="text-sm text-gray-600 hover:text-blue-800">
                                    Forgot your password?
                                </a>
                            </div>
                        </form>

                        <!-- Mobile-only footer -->
                        <div class="md:hidden text-center text-xs text-gray-500 mt-6">
                            &copy; {{ date('Y') }} Almeta Global Trilindo. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Minimal styles for password toggle */
        #togglePassword:focus {
            outline: 2px solid rgba(30, 64, 175, 0.5);
            outline-offset: 2px;
        }
    </style>

    <!-- Password Toggle JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            function togglePasswordVisibility() {
                const isPassword = passwordInput.type === 'password';

                // Toggle password type
                passwordInput.type = isPassword ? 'text' : 'password';

                // Toggle icons
                if (isPassword) {
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                } else {
                    eyeSlashIcon.classList.add('hidden');
                    eyeIcon.classList.remove('hidden');
                }

                // Update aria-label for accessibility
                toggleButton.setAttribute('aria-label',
                    isPassword ? 'Hide password' : 'Show password'
                );

                // Focus back to input
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

            // Prevent form submission when clicking toggle
            toggleButton.addEventListener('mousedown', function(e) {
                e.preventDefault();
            });
        });
    </script>
</x-guest-layout>
