<x-guest-layout>
    @section('title-guest', 'Forgot Password')

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
                                <h2 class="text-xl font-semibold">Reset Your Password</h2>
                                <p class="text-blue-100 leading-relaxed">
                                    Secure your account access. We'll send you a link to create a new password for your AlmetaGT shipping management account.
                                </p>
                            </div>
                            
                            <!-- Features List -->
                            <div class="space-y-3 pt-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                    <span class="text-sm text-blue-100">Secure password reset process</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                    <span class="text-sm text-blue-100">Email verification required</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                    <span class="text-sm text-blue-100">24/7 support available</span>
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
                            <h2 class="text-2xl font-bold text-black mb-2">Forgot Password?</h2>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                No problem! Enter your email address below and we'll send you a link to reset your password. 
                                The link will be valid for 60 minutes.
                            </p>
                        </div>

                        <!-- Reset Password Form -->
                        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                            @csrf

                            {{-- Email --}}
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
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="block w-full pl-10 h-10 px-3 py-2 border @error('email') border-red-600 @else border-gray-300 @enderror rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 focus:outline-none text-sm"
                                        required autofocus placeholder="example@almetagt.com">
                                </div>
                                @error('email')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div>
                                <button type="submit"
                                    class="w-full px-6 py-2 bg-blue-800 text-white text-sm font-medium rounded hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-800 transition duration-200">
                                    <span class="flex items-center justify-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span>Send Password Reset Link</span>
                                    </span>
                                </button>
                            </div>

                            {{-- Support Info --}}
                            <div class="bg-blue-50 border border-blue-200 rounded p-4 mt-6">
                                <div class="flex items-start space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <h4 class="text-sm font-medium text-blue-800 mb-1">Need Help?</h4>
                                        <p class="text-xs text-blue-700 mb-2">
                                            If you don't receive the email, check your spam folder or contact our support team.
                                        </p>
                                        <a href="mailto:support@almetagt.com" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                            📧 support@almetagt.com
                                        </a>
                                    </div>
                                </div>
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
</x-guest-layout>
