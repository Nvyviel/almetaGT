<x-app-layout>
    @section('layout')
        <div class="flex min-h-screen">
            <!-- Navbar -->
            <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-40 px-6 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <img src="{{ asset('assets/img/Kop Surat Almeta Global Trilindo For Websites (BG Removed).png') }}" alt="Almeta Logo"
                            class="h-8 md:h-12 w-auto max-w-[230px] object-contain">
                    </a>
                    <div class="hidden md:block border-l border-gray-300 pl-4 text-gray-400 text-sm">
                        Logistics Management
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="flex items-center space-x-4" x-data="{ open: false }">
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div class="relative">
                            </div>
                            <div class="hidden md:block">
                                <div class="text-sm font-medium text-gray-700">
                                    {{ Auth::user()->company_name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ Auth::user()->is_admin ? 'Administrator' : Auth::user()->name }}
                                </div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 ml-2"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->company_name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile-edit') }}" wire:navigate
                                    class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <i class="fas fa-user mr-3"></i> Profile
                                </a>
                                <a href="{{ route('consignee') }}" wire:navigate
                                    class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <i class="fas fa-users mr-3"></i> Consignee
                                </a>
                            </div>
                            <div class="border-t border-gray-200 py-1">
                                <form method="POST" action="{{ route('logout') }}" wire:navigate id="logout-form">
                                    @csrf
                                    <button type="button" onclick="showLogoutModal()"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="flex-1 bg-gray-50 pt-28 min-h-screen">
                <div>
                    @yield('component')
                </div>
                <footer class="relative z-10 text-gray-500 py-2 sm:py-2">
                    <div class="pt-3 sm:pt-2 text-center">
                        <p class="text-sm sm:text-base text-gray-500">Powered by PT. ALMETA GLOBAL TRILINDO</p>
                        <p class="text-xs sm:text-sm text-gray-500 mt-2">&copy; 2025 All rights reserved.</p>
                    </div>
                </footer>
            </main>
        </div>

        {{-- Custom Logout Confirmation Modal --}}
        <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0 max-w-md w-full mx-4" id="logoutModalContent">
                {{-- Modal Header --}}
                <div class="bg-red-600 rounded-t-xl px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Confirm Logout</h3>
                    </div>
                </div>
                
                {{-- Modal Body --}}
                <div class="px-6 py-6">
                    <div class="mb-4">
                        <p class="text-gray-700 mb-3">Are you sure you want to logout from your account?</p>
                        <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-800">
                            <div class="text-sm">
                                <div class="font-medium text-blue-800">Logged in as:</div>
                                <div class="text-blue-700 mt-1">{{ Auth::user()->company_name ?? 'N/A' }}</div>
                                <div class="text-blue-600 text-xs mt-1">{{ Auth::user()->email ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-4 w-4 text-yellow-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">You will need to login again to access your account.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Modal Footer --}}
                <div class="px-6 py-4 bg-gray-50 rounded-b-xl">
                    <div class="flex items-center justify-end space-x-3">
                        <button onclick="hideLogoutModal()" 
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors duration-200">
                            Cancel
                        </button>
                        <button onclick="confirmLogout()" 
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showLogoutModal() {
                const modal = document.getElementById('logoutModal');
                const content = document.getElementById('logoutModalContent');
                
                modal.classList.remove('hidden');
                
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 50);
            }

            function hideLogoutModal() {
                const modal = document.getElementById('logoutModal');
                const content = document.getElementById('logoutModalContent');
                
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }

            function confirmLogout() {
                const confirmButton = event.target;
                confirmButton.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Logging out...';
                confirmButton.disabled = true;
                
                document.getElementById('logout-form').submit();
            }

            document.getElementById('logoutModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideLogoutModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !document.getElementById('logoutModal').classList.contains('hidden')) {
                    hideLogoutModal();
                }
            });
        </script>
    @endsection
</x-app-layout>
