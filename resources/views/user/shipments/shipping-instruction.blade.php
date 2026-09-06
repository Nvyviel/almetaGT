@extends('layouts.main')

@section('title', 'Shipping Instruction')
@section('component')
    <div class="container mx-auto px-4 py-4 max-w-7xl">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Shipping Instructions</h1>
                        <p class="text-sm text-gray-600">Manage and track shipping instruction requests</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ $containers->total() ?? count($containers) }} Total</p>
                        <p class="text-xs text-gray-500">Instructions</p>
                    </div>
                    <a href="{{ $hasConsignee ? route('request-si') : route('consignee', ['needs_consignee' => 1]) }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                        <i class="fas fa-plus mr-2"></i>
                        New Request
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-md font-semibold text-gray-900">Filter by Status</h3>
                <span class="text-sm text-gray-500">Quick filters</span>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('shipping-instruction', ['filter' => 'all']) }}" wire:navigate
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request('filter', 'all') === 'all' ? 'bg-blue-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-list mr-2"></i>All Instructions
                    @php $allCount = $containers->total() ?? count($containers); @endphp
                    @if($allCount > 0)
                        <span class="ml-2 px-2 py-0.5 bg-white bg-opacity-20 rounded text-xs">{{ $allCount }}</span>
                    @endif
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'requested']) }}" wire:navigate
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request('filter') === 'requested' ? 'bg-blue-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-clock mr-2"></i>Pending
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'approved']) }}" wire:navigate
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request('filter') === 'approved' ? 'bg-blue-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-check-circle mr-2"></i>Approved
                </a>
                <a href="{{ route('shipping-instruction', ['filter' => 'rejected']) }}" wire:navigate
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request('filter') === 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-times-circle mr-2"></i>Rejected
                </a>
            </div>
        </div>

        <!-- Instructions List -->
        <div class="space-y-3">
            @forelse ($containers as $container)
                <div class="bg-white border border-gray-200 rounded-lg hover:shadow-sm">
                    <div class="p-4">
                        <!-- Header Row -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <!-- Instruction ID with copy functionality -->
                                <button
                                    class="bg-blue-50 text-blue-800 px-3 py-1 border border-blue-200 text-xs font-medium rounded-lg hover:bg-blue-100"
                                    onclick="navigator.clipboard.writeText('{{ $container->shippingInstructions->first()->instructions_id }}').then(() => { 
                                        this.innerHTML = '<i class=\'fas fa-check mr-1\'></i>Copied!'; 
                                        setTimeout(() => { 
                                            this.innerHTML = '<i class=\'fas fa-copy mr-1\'></i>{{ $container->shippingInstructions->first()->instructions_id }}'; 
                                        }, 2000); 
                                    });"
                                    type="button"
                                    title="Click to copy ID">
                                    <i class="fas fa-copy mr-1"></i>{{ $container->shippingInstructions->first()->instructions_id }}
                                </button>
                                
                                <!-- Status Badge -->
                                @php
                                    $status = $container->shippingInstructions->first()?->status;
                                    $statusConfig = [
                                        'Approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => 'fas fa-check-circle'],
                                        'Rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'icon' => 'fas fa-times-circle'],
                                        'Submitted' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'border' => 'border-yellow-200', 'icon' => 'fas fa-clock'],
                                        'Requested' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'border' => 'border-yellow-200', 'icon' => 'fas fa-clock'],
                                    ];
                                    $config = $statusConfig[$status] ?? $statusConfig['Requested'];
                                @endphp
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }} border">
                                    <i class="{{ $config['icon'] }} mr-1"></i>
                                    {{ $status }}
                                </span>
                            </div>

                            <!-- Container Count -->
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 text-xs font-medium rounded">
                                <i class="fas fa-box mr-1"></i>{{ $container->quantity }} Container{{ $container->quantity > 1 ? 's' : '' }}
                            </span>
                        </div>

                        <!-- Content Row -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-center">
                            <!-- Consignee Info -->
                            <div class="lg:col-span-2">
                                <h3 class="font-semibold text-gray-900 text-sm mb-2">
                                    <i class="fas fa-building text-blue-800 mr-2"></i>
                                    {{ optional($container->shippingInstructions->first()->consignee)->name_consignee ?? 'Unknown Consignee' }}
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-xs">
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-industry w-4 text-gray-400 mr-1"></i>
                                        <span class="truncate">{{ optional($container->shippingInstructions->first()->consignee)->industry ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-cube w-4 text-gray-400 mr-1"></i>
                                        <span>{{ $container->container_type }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-calendar w-4 text-gray-400 mr-1"></i>
                                        <span>{{ \Carbon\Carbon::parse($container->created_at)->format('d M Y') }}</span>
                                    </div>
                                </div>
                                @if(optional($container->shippingInstructions->first()->consignee)->city)
                                <div class="mt-1 flex items-center text-xs text-gray-500">
                                    <i class="fas fa-map-marker-alt w-4 text-gray-400 mr-1"></i>
                                    <span>{{ optional($container->shippingInstructions->first()->consignee)->city }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="lg:text-right">
                                <a href="{{ route('shipping-instruction-detail', $container->id) }}" wire:navigate
                                    class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                                    <i class="fas fa-eye mr-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-file-alt text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Shipping Instructions Found</h3>
                        <p class="text-sm text-gray-500 mb-6">
                            @if(request('filter') && request('filter') !== 'all')
                                No instructions match your current filter. Try changing the filter or create a new instruction.
                            @else
                                Get started by creating your first shipping instruction request.
                            @endif
                        </p>
                        <div class="flex items-center justify-center space-x-3">
                            @if(request('filter') && request('filter') !== 'all')
                                <a href="{{ route('shipping-instruction') }}" 
                                   class="px-4 py-2 text-gray-600 hover:text-blue-800 text-sm font-medium">
                                    <i class="fas fa-filter mr-1"></i>Clear Filters
                                </a>
                            @endif
                            <a href="{{ $hasConsignee ? route('request-si') : route('consignee', ['needs_consignee' => 1]) }}" wire:navigate
                                class="inline-flex items-center px-6 py-3 bg-blue-800 hover:bg-blue-900 text-white font-medium rounded-lg">
                                <i class="fas fa-plus mr-2"></i>Create New Instruction
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(method_exists($containers, 'hasPages') && $containers->hasPages())
        <div class="mt-6">
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                {{ $containers->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- Quick Stats Dashboard -->
    <div class="fixed bottom-4 right-4 z-40" id="quickStats" style="display: none;">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-3 max-w-xs">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-semibold text-gray-900">Quick Stats</h4>
                <button onclick="document.getElementById('quickStats').style.display='none'" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div class="text-center">
                    <div class="font-medium text-gray-900" id="totalCount">{{ $containers->total() ?? count($containers) }}</div>
                    <div class="text-gray-500">Total</div>
                </div>
                <div class="text-center">
                    <div class="font-medium text-blue-800" id="currentFilter">{{ ucfirst(request('filter', 'all')) }}</div>
                    <div class="text-gray-500">Filter</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        /* Remove excessive animations */
        * {
            transition-duration: 0.15s;
        }

        /* Custom focus styles */
        input:focus, select:focus, button:focus {
            outline: none;
        }

        /* Hover effects for cards */
        .hover\:shadow-sm:hover {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        /* Copy button animation */
        .copy-success {
            animation: pulse 0.3s ease-in-out;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Status badge styles */
        .status-badge {
            position: relative;
            overflow: hidden;
        }

        .status-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .status-badge:hover::before {
            left: 100%;
        }

        /* Filter button enhancement */
        .filter-active {
            box-shadow: 0 0 0 2px rgba(30, 64, 175, 0.2);
        }

        /* Smooth transitions */
        .transition-smooth {
            transition: all 0.15s ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show quick stats after 3 seconds
            setTimeout(function() {
                const quickStats = document.getElementById('quickStats');
                if (quickStats) {
                    quickStats.style.display = 'block';
                    quickStats.style.opacity = '0';
                    quickStats.style.transform = 'translateY(20px)';
                    quickStats.style.transition = 'all 0.3s ease-out';
                    
                    setTimeout(() => {
                        quickStats.style.opacity = '1';
                        quickStats.style.transform = 'translateY(0)';
                    }, 100);
                }
            }, 3000);

            // Copy button enhancement
            document.querySelectorAll('[onclick*="clipboard"]').forEach(function(button) {
                button.addEventListener('click', function() {
                    this.classList.add('copy-success');
                    setTimeout(() => {
                        this.classList.remove('copy-success');
                    }, 300);
                });
            });

            // Filter button active state enhancement
            document.querySelectorAll('a[href*="filter"]').forEach(function(filterBtn) {
                if (filterBtn.classList.contains('bg-blue-800')) {
                    filterBtn.classList.add('filter-active');
                }
            });

            // Add smooth transitions to all interactive elements
            document.querySelectorAll('button, a, [onclick]').forEach(function(el) {
                el.classList.add('transition-smooth');
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + N for new instruction
                if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                    e.preventDefault();
                    const newBtn = document.querySelector('a[href*="request-si"]');
                    if (newBtn) newBtn.click();
                }

                // Number keys for filters
                if (e.key >= '1' && e.key <= '4') {
                    const filters = ['all', 'requested', 'approved', 'rejected'];
                    const filterIndex = parseInt(e.key) - 1;
                    if (filters[filterIndex]) {
                        const filterBtn = document.querySelector(`a[href*="filter=${filters[filterIndex]}"]`);
                        if (filterBtn) filterBtn.click();
                    }
                }
            });

            // Enhanced copy functionality with better UX
            window.copyToClipboard = function(text, button) {
                navigator.clipboard.writeText(text).then(function() {
                    const originalHtml = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-check mr-1 text-green-600"></i>Copied!';
                    button.classList.add('bg-green-50', 'border-green-200', 'text-green-800');
                    button.classList.remove('bg-blue-50', 'border-blue-200', 'text-blue-800');
                    
                    setTimeout(function() {
                        button.innerHTML = originalHtml;
                        button.classList.remove('bg-green-50', 'border-green-200', 'text-green-800');
                        button.classList.add('bg-blue-50', 'border-blue-200', 'text-blue-800');
                    }, 2000);
                }).catch(function() {
                    console.error('Failed to copy text');
                });
            };
        });

        // Auto-refresh data every 30 seconds (optional)
        // setInterval(function() {
        //     if (document.hasFocus()) {
        //         window.location.reload();
        //     }
        // }, 30000);
    </script>
@endsection
