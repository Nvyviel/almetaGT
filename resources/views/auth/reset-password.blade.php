<x-guest-layout>
    @section('title-guest', 'Reset Password')

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

    @if (session('status'))
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
            <div class="mx-4 bg-green-50 border border-green-500 text-green-700 px-4 py-3 rounded shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm">
                            {{ session('status') }}
                        </span>
                    </div>
                    <button onclick="this.parentElement.remove()"
                        class="text-green-700 hover:text-green-900 focus:outline-none">
                        <span class="text-xl">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-white">
        <!-- Content Container -->
        <div class="min-h-screen flex items-center justify-center p-3">
            <div class="w-full max-w-5xl grid md:grid-cols-5 bg-white rounded border border-gray-300 shadow overflow-hidden">
                
                <!-- Left Column - Decorative Side with Background Image -->
                <div class="md:col-span-2 bg-center bg-blue-800 bg-no-repeat p-6 relative hidden md:block overflow-hidden"
                    style="background-image: url('{{ asset('assets/img/Almeta-ship.png') }}'); background-size: 120%; background-position: center;">
                    <!-- Dark overlay -->
                    <div class="absolute inset-0 bg-blue-900 bg-opacity-70"></div>
                    
                    <!-- Content over overlay -->
                    <div class="relative z-10 h-full flex flex-col justify-center text-white">
                        <div class="space-y-6">
                            <!-- Logo/Brand -->
                            <div>
                                <h1 class="text-4xl font-bold mb-2">AlmetaGT</h1>
                                <div class="w-12 h-1 bg-white rounded"></div>
                            </div>
                            
                            <!-- Welcome Text -->
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold">Create New Password</h2>
                                <p class="text-blue-100 leading-relaxed">
                                    You're almost done! Create a strong, secure password for your AlmetaGT account. Make sure to choose something memorable but secure.
                                </p>
                            </div>
                            
                            <!-- Security Tips -->
                            <div class="space-y-3 pt-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                    <span class="text-sm text-blue-100">At least 8 characters long</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                    <span class="text-sm text-blue-100">Mix of letters and numbers</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                    <span class="text-sm text-blue-100">Include special characters</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Reset Password Form -->
                <div class="md:col-span-3 p-6 md:p-12 flex flex-col justify-center">
                    <div class="w-full max-w-md mx-auto">
                        <!-- Mobile Logo -->
                        <div class="md:hidden text-center mb-8">
                            <h1 class="text-3xl font-bold text-blue-800 mb-1">AlmetaGT</h1>
                            <div class="w-8 h-1 bg-blue-800 rounded mx-auto"></div>
                        </div>

                        <!-- Header -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-black mb-2">Set New Password</h2>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Enter your new password below. Make sure it's strong and secure to protect your shipping management account.
                            </p>
                        </div>

                        <!-- Reset Password Form -->
                        <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            {{-- Email (Read Only) --}}
                            <div class="group">
                                <label for="email" class="block font-medium text-black text-sm mb-1">Email Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                                        class="block w-full pl-10 h-10 px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 focus:outline-none text-sm bg-gray-50"
                                        required readonly autofocus autocomplete="username">
                                </div>
                            </div>

                            {{-- New Password with Show/Hide Toggle --}}
                            <div class="group">
                                <label for="password" class="block font-medium text-black text-sm mb-1">New Password</label>
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
                                        required autocomplete="new-password" placeholder="Enter new password">

                                    <!-- Password Toggle Button -->
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 right-0 flex items-center justify-center w-10 h-full text-gray-500 hover:text-blue-800 focus:outline-none focus:text-blue-800"
                                        aria-label="Toggle password visibility">
                                        <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eyeSlashIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 0 1-1.563 3.029" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.758 6.758A10.451 10.451 0 0 0 2.458 12C3.732 16.057 7.523 19 12 19a10.45 10.45 0 0 0 5.242-1.758" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Confirm Password with Show/Hide Toggle --}}
                            <div class="group">
                                <label for="password_confirmation" class="block font-medium text-black text-sm mb-1">Confirm New Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 z-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>

                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        class="block w-full pl-10 pr-12 h-10 px-3 py-2 border @error('password_confirmation') border-red-600 @else border-gray-300 @enderror rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 focus:outline-none text-sm"
                                        required autocomplete="new-password" placeholder="Confirm your password">

                                    <!-- Password Toggle Button -->
                                    <button type="button" id="togglePasswordConfirmation"
                                        class="absolute inset-y-0 right-0 flex items-center justify-center w-10 h-full text-gray-500 hover:text-blue-800 focus:outline-none focus:text-blue-800"
                                        aria-label="Toggle password visibility">
                                        <svg id="eyeIconConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eyeSlashIconConfirm" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 0 1-1.563 3.029" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.758 6.758A10.451 10.451 0 0 0 2.458 12C3.732 16.057 7.523 19 12 19a10.45 10.45 0 0 0 5.242-1.758" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div>
                                <button type="submit"
                                    class="w-full px-6 py-2 bg-blue-800 text-white text-sm font-medium rounded hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-800 transition duration-200">
                                    <span class="flex items-center justify-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Update Password</span>
                                    </span>
                                </button>
                            </div>

                            {{-- Back to Login Link --}}
                            <div class="text-center pt-4">
                                <a href="{{ route('login') }}" wire:navigate
                                    class="text-sm text-gray-600 hover:text-blue-800 inline-flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    <span>Back to Login</span>
                                </a>
                            </div>
                        </form>

                        <!-- Mobile-only footer -->
                        <div class="md:hidden text-center text-xs text-gray-500 mt-8">
                            &copy; {{ date('Y') }} Almeta Global Trilindo. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Toggle JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password field toggle
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            // Password confirmation field toggle
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const toggleButtonConfirm = document.getElementById('togglePasswordConfirmation');
            const eyeIconConfirm = document.getElementById('eyeIconConfirm');
            const eyeSlashIconConfirm = document.getElementById('eyeSlashIconConfirm');

            function togglePasswordVisibility(input, eyeShow, eyeHide) {
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                
                if (isPassword) {
                    eyeShow.classList.add('hidden');
                    eyeHide.classList.remove('hidden');
                } else {
                    eyeHide.classList.add('hidden');
                    eyeShow.classList.remove('hidden');
                }
            }

            toggleButton?.addEventListener('click', () => {
                togglePasswordVisibility(passwordInput, eyeIcon, eyeSlashIcon);
            });

            toggleButtonConfirm?.addEventListener('click', () => {
                togglePasswordVisibility(passwordConfirmationInput, eyeIconConfirm, eyeSlashIconConfirm);
            });
        });
    </script>
</x-guest-layout>
