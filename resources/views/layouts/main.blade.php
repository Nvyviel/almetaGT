<x-app-layout>
    @section('layout')
        <div class="min-h-screen">
            <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-40 px-6 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <img src="{{ asset('assets/img/Kop Surat Almeta Global Trilindo For Websites (BG Removed).png') }}" alt="Almeta Logo"
                            class="h-8 md:h-12 w-auto max-w-[230px] object-contain">
                    </a>
                    <div class="hidden md:block border-l border-gray-300 pl-4 text-gray-600 text-sm font-medium">
                        Logistics Management
                    </div>
                </div>

                <div class="flex items-center space-x-4" x-data="{ open: false }">
                    <button id="mobile-menu-button" class="md:hidden text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none text-gray-700 hover:text-blue-800">
                            <div class="hidden md:block text-right">
                                <div class="text-sm font-medium text-gray-800">
                                    {{ Auth::user()->company_name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ Auth::user()->is_admin ? 'Administrator' : Auth::user()->name }}
                                </div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 ml-2"></i>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
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
                                        <i class="fas fa-sign-out-alt mr-3 text-red-600"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div id="mobile-menu"
                class="md:hidden fixed w-full bg-white z-30 shadow-md transform transition-transform duration-300 -translate-y-full">
                <div class="px-4 py-3">
                    <nav class="flex flex-wrap gap-2">
                        @php
                            $mobileLinkClass =
                                'flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 ease-in-out';
                            $mobileActiveLinkClass = 'bg-blue-800 text-white';
                            $mobileInactiveLinkClass = 'text-gray-600 hover:bg-blue-50 hover:text-blue-800';
                        @endphp

                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('dashboard') || request()->routeIs('filtering-shipment') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-home mr-2"></i> Dashboard
                        </a>
                        <a href="{{ route('release-order') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('release-order') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-shipping-fast mr-2"></i> Release Order
                        </a>
                        @if (Auth::user()->is_admin)
                            <a href="{{ route('seal') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('seal') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fas fa-stamp mr-2"></i> Seal
                            </a>
                        @else
                            <div class="{{ $mobileLinkClass }} cursor-not-allowed bg-gray-100 text-gray-500 border border-gray-300 opacity-60" 
                                 title="This feature is only available for administrators">
                                <i class="fas fa-lock mr-2"></i> Seal (Access Restricted)
                            </div>
                        @endif
                        <a href="{{ route('shipping-instruction') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('shipping-instruction') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-file-alt mr-2"></i> Shipping Instruction
                        </a>
                        <a href="{{ route('list-bill') }}" wire:navigate
                            class="{{ $mobileLinkClass }} {{ request()->routeIs('list-bill') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                            <i class="fas fa-scroll mr-2"></i> Bills
                        </a>
                        <a href="#" class="{{ $mobileLinkClass }} {{ $mobileInactiveLinkClass }}">
                            <i class="fas fa-question-circle mr-2"></i> Help
                        </a>
                        <a href="{{ route('new-feedback') }}" class="{{ $mobileLinkClass }} {{ $mobileInactiveLinkClass }}">
                            <i class="fas fa-comment-alt mr-2"></i> Feedback
                        </a>

                        @if (Auth::user() && Auth::user()->is_admin)
                            <div class="w-full border-t border-gray-200 my-2"></div>
                            <a href="{{ route('dashboard-admin') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('dashboard-admin') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fas fa-house-user mr-2"></i> Admin Dashboard
                            </a>
                            <a href="{{ route('create-shipment') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('create-shipment') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fas fa-plus-circle mr-2"></i> Schedule
                            </a>
                            <!-- Mobile Dropdown: Approval -->
                            <div x-data="{ open: false }" class="w-full">
                                <button @click="open = !open" 
                                    class="{{ $mobileLinkClass }} {{ (request()->routeIs('approval-ro') || request()->routeIs('approval-si')) ? $mobileActiveLinkClass : $mobileInactiveLinkClass }} w-full justify-between">
                                    <div class="flex items-center">
                                        <i class="fas fa-clipboard-check mr-2"></i> Approval
                                    </div>
                                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" 
                                       :class="{'rotate-180': open}"></i>
                                </button>
                                <div x-show="open" x-transition class="ml-4 mt-1 space-y-1 border-l-2 border-gray-200 pl-4">
                                    <a href="{{ route('approval-ro') }}" wire:navigate
                                        class="flex items-center px-3 py-2 text-sm rounded-md transition-colors duration-200 {{ request()->routeIs('approval-ro') ? 'bg-blue-100 text-blue-800 font-medium' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-800' }}">
                                        <i class="fa-solid fa-file-contract mr-2 text-xs"></i> Release Order
                                    </a>
                                    <a href="{{ route('approval-si') }}" wire:navigate
                                        class="flex items-center px-3 py-2 text-sm rounded-md transition-colors duration-200 {{ request()->routeIs('approval-si') ? 'bg-blue-100 text-blue-800 font-medium' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-800' }}">
                                        <i class="fa-solid fa-ship mr-2 text-xs"></i> Shipping Instruction
                                    </a>
                                </div>
                            </div>
                            <a href="{{ route('activity-seal') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('activity-seal') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-stamp mr-2"></i> Activity Seal
                            </a>
                            <a href="{{ route('create-bill') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('create-bill') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-file-invoice mr-2"></i> Create Bills
                            </a>
                            <a href="{{ route('admin.bills.list') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('admin.bills.list') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-check-circle mr-2"></i> Confirmation
                            </a>
                            <a href="{{ route('feedback-received') }}" wire:navigate
                                class="{{ $mobileLinkClass }} {{ request()->routeIs('feedback-received') ? $mobileActiveLinkClass : $mobileInactiveLinkClass }}">
                                <i class="fa-solid fa-comments mr-2"></i> Feedback Received
                            </a>
                        @endif
                    </nav>
                </div>
            </div>

            <div class="hidden md:block fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200">
                <div class="pt-16 md:pt-20 px-4 pb-4 h-full overflow-y-auto">
                    <nav>
                        @php
                            $linkClass =
                                'flex items-center px-3 py-2 text-sm font-medium rounded-md';
                            $activeLinkClass = 'bg-blue-800 text-white';
                            $inactiveLinkClass = 'text-gray-600 hover:bg-blue-50 hover:text-blue-800';
                        @endphp

                        <div class="space-y-0.5">
                            <a href="{{ route('dashboard') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('dashboard') || request()->routeIs('filtering-shipment') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-home mr-3"></i> Dashboard
                            </a>
                            <a href="{{ route('release-order') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('release-order') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-shipping-fast mr-3"></i> Release Order
                            </a>
                            @if (Auth::user()->is_admin)
                                <a href="{{ route('seal') }}" wire:navigate
                                    class="{{ $linkClass }} {{ request()->routeIs('seal') ? $activeLinkClass : $inactiveLinkClass }}">
                                    <i class="fas fa-stamp mr-3"></i> Seal
                                </a>
                            @else
                                <div class="{{ $linkClass }} cursor-not-allowed bg-gray-100 text-gray-500 border border-gray-300 pointer-events-none opacity-60" 
                                     title="This feature is only available for administrators">
                                    <i class="fas fa-lock mr-3"></i> Seal (Admin Only)
                                </div>
                            @endif
                            <a href="{{ route('shipping-instruction') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('shipping-instruction') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-file-alt mr-3"></i> Shipping Instruction
                            </a>
                            <a href="{{ route('list-bill') }}" wire:navigate
                                class="{{ $linkClass }} {{ request()->routeIs('list-bill') ? $activeLinkClass : $inactiveLinkClass }}">
                                <i class="fas fa-scroll mr-3"></i> Bill
                            </a>
                            <a href="#" class="{{ $linkClass }} {{ $inactiveLinkClass }}">
                                <i class="fas fa-question-circle mr-3"></i> Help
                            </a>
                            <a href="{{ route('new-feedback') }}" class="{{ $linkClass }} {{ $inactiveLinkClass }}">
                                <i class="fas fa-comment-alt mr-3"></i> Feedback
                            </a>

                            @if (!Auth::user()->is_admin)
                                {{-- Quick Stats for Non-Admin Users --}}
                                <div class="mt-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <h3 class="text-sm font-semibold text-blue-800 mb-2">📊 Account Status</h3>
                                    <div class="space-y-1 text-xs">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Status:</span>
                                            <span class="font-medium {{ Auth::user()->status == 'Approved' ? 'text-green-600' : (Auth::user()->status == 'Warned' ? 'text-red-600' : 'text-yellow-600') }}">
                                                {{ Auth::user()->status }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Since:</span>
                                            <span class="font-medium text-blue-800">{{ Auth::user()->created_at->format('M Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Quick Actions Card --}}
                                <div class="mt-3 p-3 bg-gray-50 rounded-lg border">
                                    <h3 class="text-sm font-semibold text-gray-800 mb-2">⚡ Quick Actions</h3>
                                    <div class="space-y-1">
                                        <a href="{{ route('release-order') }}" class="block text-xs text-blue-600 hover:text-blue-800 font-medium">
                                            → New Release Order
                                        </a>
                                        <a href="{{ route('shipping-instruction') }}" class="block text-xs text-blue-600 hover:text-blue-800 font-medium">
                                            → Shipping Instructions
                                        </a>
                                        <a href="{{ route('new-feedback') }}" class="block text-xs text-blue-600 hover:text-blue-800 font-medium">
                                            → Send Feedback
                                        </a>
                                    </div>
                                </div>

                                {{-- Support Info --}}
                                <div class="mt-3 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                    <h3 class="text-sm font-semibold text-yellow-800 mb-1">💡 Need Help?</h3>
                                    <p class="text-xs text-yellow-700 mb-1">Contact our support team</p>
                                    <a href="mailto:cs@almetagt.com" class="text-xs text-yellow-600 hover:text-yellow-800 font-medium">
                                        📧 cs@almetagt.com
                                    </a>
                                </div>
                            @endif

                            @if (Auth::user() && Auth::user()->is_admin)
                                <div class="border-t border-blue-200 my-2"></div>
                                <div class="mb-2 p-2 bg-blue-800 text-white rounded-lg">
                                    <h3 class="text-sm font-semibold mb-1">🔧 Admin Panel</h3>
                                    <p class="text-xs text-blue-200">Manage system operations</p>
                                </div>

                                <div class="space-y-0.5">
                                    <a href="{{ route('dashboard-admin') }}" wire:navigate
                                        class="{{ $linkClass }} {{ request()->routeIs('dashboard-admin') ? $activeLinkClass : $inactiveLinkClass }}">
                                        <i class="fas fa-house-user mr-3"></i> Admin Dashboard
                                    </a>
                                    <a href="{{ route('create-shipment') }}" wire:navigate
                                        class="{{ $linkClass }} {{ request()->routeIs('create-shipment') ? $activeLinkClass : $inactiveLinkClass }}">
                                        <i class="fas fa-plus-circle mr-3"></i> Schedule
                                    </a>
                                    <!-- Dropdown Menu: Approval -->
                                    <div x-data="{ open: false }" class="relative">
                                        <button @click="open = !open" 
                                            class="{{ $linkClass }} {{ (request()->routeIs('approval-ro') || request()->routeIs('approval-si')) ? $activeLinkClass : $inactiveLinkClass }} w-full justify-between">
                                            <div class="flex items-center">
                                                <i class="fas fa-clipboard-check mr-3"></i> Approval
                                            </div>
                                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" 
                                               :class="{'rotate-180': open}"></i>
                                        </button>
                                        <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                                             x-transition:enter-start="opacity-0 transform scale-95" 
                                             x-transition:enter-end="opacity-100 transform scale-100" 
                                             x-transition:leave="transition ease-in duration-150" 
                                             x-transition:leave-start="opacity-100 transform scale-100" 
                                             x-transition:leave-end="opacity-0 transform scale-95"
                                             class="ml-4 mt-1 space-y-0.5 border-l-2 border-gray-200 pl-4">
                                            <a href="{{ route('approval-ro') }}" wire:navigate
                                                class="flex items-center px-3 py-2 text-sm rounded-md transition-colors duration-200 {{ request()->routeIs('approval-ro') ? 'bg-blue-100 text-blue-800 font-medium border-l-2 border-blue-500' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-800' }}">
                                                <i class="fa-solid fa-file-contract mr-2 text-xs"></i> Release Order
                                            </a>
                                            <a href="{{ route('approval-si') }}" wire:navigate
                                                class="flex items-center px-3 py-2 text-sm rounded-md transition-colors duration-200 {{ request()->routeIs('approval-si') ? 'bg-blue-100 text-blue-800 font-medium border-l-2 border-blue-500' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-800' }}">
                                                <i class="fa-solid fa-ship mr-2 text-xs"></i> Shipping Instruction
                                            </a>
                                        </div>
                                    </div>
                                    <a href="{{ route('activity-seal') }}" wire:navigate
                                        class="{{ $linkClass }} {{ request()->routeIs('activity-seal') ? $activeLinkClass : $inactiveLinkClass }}">
                                        <i class="fa-solid fa-stamp mr-3"></i> Activity Seal
                                    </a>
                                    <a href="{{ route('create-bill') }}" wire:navigate
                                        class="{{ $linkClass }} {{ request()->routeIs('create-bill') ? $activeLinkClass : $inactiveLinkClass }}">
                                        <i class="fa-solid fa-file-invoice mr-3"></i> Create Bills
                                    </a>
                                    <a href="{{ route('admin.bills.list') }}" wire:navigate
                                        class="{{ $linkClass }} {{ request()->routeIs('admin.bills.list') ? $activeLinkClass : $inactiveLinkClass }}">
                                        <i class="fa-solid fa-check-circle mr-3"></i> Confirmation
                                    </a>
                                    <a href="{{ route('feedback-received') }}" wire:navigate
                                        class="{{ $linkClass }} {{ request()->routeIs('feedback-received') ? $activeLinkClass : $inactiveLinkClass }}">
                                        <i class="fas fa-comment-dots mr-3"></i> Feedback Received
                                    </a>
                                </div>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>

            <main class="md:ml-64 bg-gray-50 pt-16 min-h-screen flex flex-col">
                <div class="p-6 flex-grow">
                    @yield('component')
                </div>
                <footer class="w-full text-gray-500 py-2 sm:py-2 mt-auto">
                    <div class="pt-3 sm:pt-2 text-center">
                        <p class="text-sm sm:text-base text-gray-500">Powered by PT. ALMETA GLOBAL TRILINDO</p>
                        <p class="text-xs sm:text-sm text-gray-500 mt-2">&copy; 2025 All rights reserved.</p>
                    </div>
                </footer>
            </main>
        </div>

        <style>
            /* Custom tooltip styles */
            [title] {
                position: relative;
            }
            
            [title]:hover::before {
                content: attr(title);
                position: absolute;
                left: 100%;
                top: 50%;
                transform: translateY(-50%);
                margin-left: 10px;
                padding: 8px 12px;
                background: #1e40af; /* blue-800 */
                color: white;
                font-size: 12px;
                font-weight: 500;
                border-radius: 6px;
                white-space: nowrap;
                z-index: 1000;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                opacity: 0;
                animation: tooltipFadeIn 0.3s ease forwards;
            }
            
            [title]:hover::after {
                content: '';
                position: absolute;
                left: 100%;
                top: 50%;
                transform: translateY(-50%);
                margin-left: 4px;
                border: 6px solid transparent;
                border-right-color: #1e40af; /* blue-800 */
                z-index: 1000;
                opacity: 0;
                animation: tooltipFadeIn 0.3s ease forwards;
            }
            
            @keyframes tooltipFadeIn {
                from { opacity: 0; transform: translateY(-50%) translateX(-5px); }
                to { opacity: 1; transform: translateY(-50%) translateX(0); }
            }
            
            /* Abbreviation styling */
            .abbr-style {
                border-bottom: 1px dotted #1e40af;
                cursor: help;
                text-decoration: none;
            }
            
            .abbr-style:hover {
                border-bottom-color: #dc2626;
                color: #1e40af;
            }
            
            /* Dropdown styling */
            .dropdown-submenu {
                border-left: 2px solid #e5e7eb;
                margin-left: 8px;
                padding-left: 8px;
            }
            
            .dropdown-submenu a:hover {
                border-left-color: #1e40af;
            }
            
            /* Hide tooltip on mobile devices */
            @media (max-width: 768px) {
                [title]:hover::before,
                [title]:hover::after {
                    display: none;
                }
            }
            
            /* Custom modal animations */
            .transition-all {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .backdrop-blur-sm {
                backdrop-filter: blur(4px);
            }
            
            /* Loading animation */
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            .animate-spin {
                animation: spin 1s linear infinite;
            }
        </style>

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
                
                // Animate modal appearance
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
                // Show loading state
                const confirmButton = event.target;
                const originalText = confirmButton.innerHTML;
                confirmButton.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Logging out...';
                confirmButton.disabled = true;
                
                // Submit the form
                document.getElementById('logout-form').submit();
            }

            // Close modal when clicking outside
            document.getElementById('logoutModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideLogoutModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !document.getElementById('logoutModal').classList.contains('hidden')) {
                    hideLogoutModal();
                }
            });

            document.addEventListener('DOMContentLoaded', initMobileMenu);
            document.addEventListener('livewire:navigated', initMobileMenu);

            function initMobileMenu() {
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenuButton && mobileMenu) {
                    // Hapus event listener lama untuk menghindari duplikasi
                    mobileMenuButton.removeEventListener('click', toggleMobileMenu);
                    // Tambahkan event listener baru
                    mobileMenuButton.addEventListener('click', toggleMobileMenu);

                    // Pastikan menu tertutup saat halaman dimuat/navigasi selesai
                    mobileMenu.classList.add('-translate-y-full');
                    mobileMenu.classList.remove('translate-y-16');
                }
            }

            function toggleMobileMenu() {
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenu.classList.contains('-translate-y-full')) {
                    mobileMenu.classList.remove('-translate-y-full');
                    mobileMenu.classList.add('translate-y-16');
                } else {
                    mobileMenu.classList.add('-translate-y-full');
                    mobileMenu.classList.remove('translate-y-16');
                }
            }
        </script>
    @endsection
</x-app-layout>
