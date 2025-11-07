@extends('layouts.main')

@section('title', 'Release Order')
@section('component')
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-4 max-w-7xl">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shipping-fast text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Release Orders</h1>
                            <p class="text-sm text-gray-600">Manage and track cargo release orders</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ $container->count() }} Total</p>
                            <p class="text-xs text-gray-500">Orders</p>
                        </div>
                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                            <i class="fas fa-plus mr-2"></i>
                            New Order
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            {{-- Statistics are now passed from controller to avoid filter issues --}}
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                <div class="bg-white rounded-lg border border-gray-200 p-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-list text-blue-800 text-sm"></i>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-blue-800">{{ $totalOrders }}</div>
                            <div class="text-xs text-gray-600">Total</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 p-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-green-600">{{ $approvedCount }}</div>
                            <div class="text-xs text-gray-600">Approved</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 p-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-yellow-600">{{ $pendingCount }}</div>
                            <div class="text-xs text-gray-600">Pending</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 p-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-times text-red-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-red-600">{{ $canceledCount }}</div>
                            <div class="text-xs text-gray-600">Canceled</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-md font-semibold text-gray-900">Filter by Status</h3>
                    <span class="text-sm text-gray-500">Quick filters</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('release-order', ['filter' => 'all']) }}" wire:navigate
                        class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request('filter', 'all') === 'all' ? 'bg-blue-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <i class="fas fa-list mr-2"></i>All Orders
                        @if($totalOrders > 0)
                            <span class="ml-2 px-2 py-0.5 bg-white bg-opacity-20 rounded text-xs">{{ $totalOrders }}</span>
                        @endif
                    </a>
                    <a href="{{ route('release-order', ['filter' => 'Requested']) }}" wire:navigate
                        class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request('filter') === 'Requested' ? 'bg-blue-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <i class="fas fa-clock mr-2"></i>Pending
                        @if($pendingCount > 0)
                            <span class="ml-2 px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded text-xs">{{ $pendingCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('release-order', ['filter' => 'Approved']) }}" wire:navigate
                        class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request('filter') === 'Approved' ? 'bg-blue-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <i class="fas fa-check-circle mr-2"></i>Approved
                        @if($approvedCount > 0)
                            <span class="ml-2 px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs">{{ $approvedCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('release-order', ['filter' => 'Canceled']) }}" wire:navigate
                        class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request('filter') === 'Canceled' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <i class="fas fa-times-circle mr-2"></i>Canceled
                        @if($canceledCount > 0)
                            <span class="ml-2 px-2 py-0.5 bg-red-100 text-red-700 rounded text-xs">{{ $canceledCount }}</span>
                        @endif
                    </a>
                </div>
            </div>

            <!-- Release Orders List -->
            <div class="space-y-3">
                @forelse ($container as $container)
                    <div class="bg-white border border-gray-200 rounded-lg hover:shadow-sm">
                        <div class="p-4">
                            <!-- Header Row -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <!-- Order ID with copy functionality -->
                                    <button
                                        class="bg-blue-50 text-blue-800 px-3 py-1 border border-blue-200 text-xs font-medium rounded-lg hover:bg-blue-100"
                                        onclick="navigator.clipboard.writeText('{{ $container->id_order }}').then(() => { 
                                            this.innerHTML = '<i class=\'fas fa-check mr-1\'></i>Copied!'; 
                                            setTimeout(() => { 
                                                this.innerHTML = '<i class=\'fas fa-copy mr-1\'></i>{{ $container->id_order }}'; 
                                            }, 2000); 
                                        });"
                                        type="button">
                                        <i class="fas fa-copy mr-1"></i>{{ $container->id_order }}
                                    </button>
                                    
                                    <!-- Status Badge -->
                                    @php
                                        $status = $container->status;
                                        $statusConfig = [
                                            'Approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => 'fas fa-check-circle'],
                                            'Canceled' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'icon' => 'fas fa-times-circle'],
                                            'Requested' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'border' => 'border-yellow-200', 'icon' => 'fas fa-clock'],
                                        ];
                                        $config = $statusConfig[$status] ?? $statusConfig['Requested'];
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }} border">
                                        <i class="{{ $config['icon'] }} mr-1"></i>
                                        {{ $status }}
                                    </span>
                                </div>

                                <!-- Date and Container Count -->
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 text-xs font-medium rounded">
                                    <i class="fas fa-calendar mr-1"></i>{{ \Carbon\Carbon::parse($container->created_at)->format('d M Y') }}
                                </span>
                            </div>

                            <!-- Content Row -->
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-center">
                                <!-- Route and Order Info -->
                                <div class="lg:col-span-2">
                                    <h3 class="font-semibold text-gray-900 text-sm mb-2">
                                        <i class="fas fa-route text-blue-800 mr-2"></i>
                                        {{ strtoupper($container->shipment_container->from_city ?? 'N/A') }} → {{ strtoupper($container->shipment_container->to_city ?? 'N/A') }}
                                    </h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 text-xs">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-box w-4 text-gray-400 mr-1"></i>
                                            <span>{{ $container->quantity }} Container{{ $container->quantity > 1 ? 's' : '' }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-weight w-4 text-gray-400 mr-1"></i>
                                            <span>{{ number_format($container->weight) }} kg</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-cube w-4 text-gray-400 mr-1"></i>
                                            <span>{{ $container->commodity_type ?? 'General' }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-flag w-4 text-gray-400 mr-1"></i>
                                            <span class="{{ $container->priority === 'High' ? 'text-red-600 font-medium' : '' }}">{{ $container->priority ?? 'Standard' }}</span>
                                        </div>
                                    </div>
                                    @if($container->shipment_container)
                                    <div class="mt-2 flex items-center text-xs text-gray-500">
                                        <i class="fas fa-clock w-4 text-red-600 mr-1"></i>
                                        <span class="font-medium">Closing:</span>
                                        <span class="ml-1">{{ \Carbon\Carbon::parse($container->shipment_container->closing_cargo)->format('d M Y H:i') }}</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="lg:text-right">
                                    <a href="{{ route('show-detail', ['id_order' => $container->id_order, 'source' => 'release-order']) }}" wire:navigate
                                        class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                                        <i class="fas fa-eye mr-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-box-open text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Release Orders Found</h3>
                        <p class="text-gray-600 text-sm mb-6 max-w-sm mx-auto">
                            @if(request('filter') && request('filter') !== 'all')
                                No release orders match your current filter criteria. Try adjusting your search or filters.
                            @else
                                You don't have any release orders yet. They will appear here once created.
                            @endif
                        </p>
                        
                        @if(request('filter') && request('filter') !== 'all')
                            <a href="{{ route('release-order') }}" wire:navigate
                                    class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                                <i class="fas fa-times mr-2"></i>
                                Clear Filters
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" wire:navigate
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                                <i class="fas fa-plus mr-2"></i>
                                Create Your First Order
                            </a>
                        @endif
                    </div>
                @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .filter-chip.active {
            background-color: #1e40af;
            color: white;
        }
        
        .copy-btn {
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .group:hover .copy-btn {
            opacity: 1;
        }
        
        .filter-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            min-width: 20px;
            height: 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: white;
            background-color: #dc2626;
        }
        
        .animate-bounce-subtle {
            animation: bounce-subtle 2s infinite;
        }
        
        @keyframes bounce-subtle {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-3px);
            }
            60% {
                transform: translateY(-2px);
            }
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Copy to clipboard functionality
            window.copyToClipboard = function(text, type = 'info') {
                navigator.clipboard.writeText(text).then(function() {
                    showToast(`${type.charAt(0).toUpperCase() + type.slice(1)} copied to clipboard!`, 'success');
                }).catch(function(err) {
                    showToast('Failed to copy to clipboard', 'error');
                });
            };

            // Toast notification system
            window.showToast = function(message, type = 'info') {
                const toastContainer = document.getElementById('toast-container') || createToastContainer();
                const toast = createToast(message, type);
                toastContainer.appendChild(toast);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 3000);
            };

            function createToastContainer() {
                const container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'fixed top-4 right-4 z-50 space-y-2';
                document.body.appendChild(container);
                return container;
            }

            function createToast(message, type) {
                const toast = document.createElement('div');
                const bgColor = type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600';
                const icon = type === 'success' ? 'fas fa-check-circle' : type === 'error' ? 'fas fa-exclamation-circle' : 'fas fa-info-circle';
                
                toast.className = `${bgColor} text-white px-4 py-3 rounded-lg shadow-lg flex items-center min-w-80 transform transition-all duration-300 translate-x-full`;
                toast.innerHTML = `
                    <i class="${icon} mr-3"></i>
                    <span class="flex-1">${message}</span>
                    <button onclick="this.parentNode.remove()" class="ml-3 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                // Trigger animation
                setTimeout(() => {
                    toast.classList.remove('translate-x-full');
                }, 10);
                
                return toast;
            }

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // ESC to go back or clear filters
                if (e.key === 'Escape') {
                    if (window.location.search) {
                        window.location.href = window.location.pathname;
                    }
                }
            });
        });
    </script>

    <!-- Toast Notifications -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
            class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 min-w-80">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <span class="flex-1">{{ session('success') }}</span>
                <button @click="show = false" class="ml-3 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
            class="fixed top-4 right-4 bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 min-w-80">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <span class="flex-1">{{ session('error') }}</span>
                <button @click="show = false" class="ml-3 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif
@endsection
