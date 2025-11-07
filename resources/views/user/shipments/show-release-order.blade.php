@extends('layouts.fullscreen')

@section('title', 'Detail')
@section('component')
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-800 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-shipping-fast text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-blue-800">Release Order Details</h1>
                            <button class="text-lg font-semibold mt-1 text-gray-600 hover:text-blue-800 transition-colors"
                                onclick="navigator.clipboard.writeText('{{ $container->id_order }}').then(() => { this.innerText = 'Copied!'; setTimeout(() => { this.innerText = '{{ $container->id_order }}'; }, 1000); });"
                                type="button" title="Click to copy">
                                <i class="fas fa-copy mr-2"></i>{{ $container->id_order }}
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <!-- Status Badge -->
                        @php
                            $statusConfig = [
                                'Requested' => ['bg' => 'bg-gray-600', 'icon' => 'fa-clock'],
                                'Approved' => ['bg' => 'bg-green-600', 'icon' => 'fa-check-circle'],
                                'Canceled' => ['bg' => 'bg-red-600', 'icon' => 'fa-times-circle'],
                            ];
                            $config = $statusConfig[$container->status] ?? ['bg' => 'bg-gray-600', 'icon' => 'fa-clock'];
                        @endphp
                        <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold text-white {{ $config['bg'] }}">
                            <i class="fas {{ $config['icon'] }} mr-2"></i>
                            {{ $container->status }}
                        </span>

                        <!-- Download Button or Error Message -->
                        @if ($container->status === 'Approved' && $container->pdf_ro)
                            <a href="{{ Storage::url($container->pdf_ro) }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                <i class="fas fa-download mr-2"></i>
                                Download RO
                            </a>
                        @elseif ($container->status === 'Approved' && !$container->pdf_ro)
                            <div class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <div>
                                    <p class="font-semibold text-sm">Document Error</p>
                                    <p class="text-xs opacity-90">Contact Customer Service</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Info Bar -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <p class="text-xl font-bold text-blue-800">{{ $container->quantity }}</p>
                            <p class="text-xs text-gray-600">Quantity</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <p class="text-xl font-bold text-blue-800">{{ number_format($container->weight) }}kg</p>
                            <p class="text-xs text-gray-600">Weight</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <p class="text-xl font-bold text-blue-800">{{ $container->container_type }}</p>
                            <p class="text-xs text-gray-600">Container Type</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <p class="text-xl font-bold {{ $container->is_danger === 'Yes' ? 'text-red-600' : 'text-blue-800' }}">
                                {{ $container->is_danger === 'Yes' ? 'Dangerous' : 'Safe' }}
                            </p>
                            <p class="text-xs text-gray-600">Cargo Status</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Shipment Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="bg-blue-800 text-white px-4 py-3 rounded-t-lg">
                        <h2 class="text-lg font-semibold flex items-center">
                            <i class="fas fa-ship mr-3"></i>
                            Shipment Information
                        </h2>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-warehouse text-blue-800 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Stuffing Location</p>
                                    <p class="font-semibold text-gray-900">{{ $container->stuffing }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-800 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Container Ownership</p>
                                    <p class="font-semibold text-gray-900">{{ $container->ownership_container }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-box text-blue-800 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Load Type</p>
                                    <p class="font-semibold text-gray-900">{{ $container->load_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Container Details -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="bg-blue-800 text-white px-4 py-3 rounded-t-lg">
                        <h2 class="text-lg font-semibold flex items-center">
                            <i class="fas fa-boxes mr-3"></i>
                            Container Details
                        </h2>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-cube text-blue-800 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Container Type</p>
                                    <p class="font-semibold text-gray-900">{{ $container->container_type }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-tag text-blue-800 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Commodity</p>
                                    <p class="font-semibold text-gray-900">{{ $container->commodity }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-blue-800 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Created Date</p>
                                    <p class="font-semibold text-gray-900">{{ $container->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="bg-blue-800 text-white px-4 py-3 rounded-t-lg">
                    <h2 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Additional Information
                    </h2>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Notes Section -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-sticky-note mr-2 text-blue-800"></i>
                                Notes
                            </h3>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    {{ $container->notes ?: 'No additional notes provided for this container.' }}
                                </p>
                            </div>
                        </div>

                        <!-- Metadata -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-database mr-2 text-blue-800"></i>
                                Order Information
                            </h3>
                            <div class="space-y-3">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600">Order ID</p>
                                    <p class="font-mono text-sm font-semibold text-gray-900">{{ $container->id_order }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600">Last Updated</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $container->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                                @if ($container->pdf_ro)
                                    <div class="bg-green-50 rounded-lg p-3 border border-green-200">
                                        <p class="text-xs text-gray-600">Document Status</p>
                                        <p class="text-sm font-semibold text-green-600 flex items-center">
                                            <i class="fas fa-check-circle mr-2"></i>PDF RO Available
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Route Information Card -->
            @if($container->shipment_container)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="bg-blue-800 text-white px-4 py-3 rounded-t-lg">
                    <h2 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-route mr-3"></i>
                        Route Information
                    </h2>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg mx-auto mb-2 flex items-center justify-center">
                                <i class="fas fa-anchor text-blue-800"></i>
                            </div>
                            <p class="text-xs text-gray-600">From</p>
                            <p class="font-semibold text-blue-800">{{ strtoupper($container->shipment_container->from_city) }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-red-100 rounded-lg mx-auto mb-2 flex items-center justify-center">
                                <i class="fas fa-arrow-right text-red-600"></i>
                            </div>
                            <p class="text-xs text-gray-600">Closing Date</p>
                            <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($container->shipment_container->closing_cargo)->format('M d, Y') }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg mx-auto mb-2 flex items-center justify-center">
                                <i class="fas fa-flag-checkered text-blue-800"></i>
                            </div>
                            <p class="text-xs text-gray-600">To</p>
                            <p class="font-semibold text-blue-800">{{ strtoupper($container->shipment_container->to_city) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
                <a href="{{ route(request('source', 'release-order')) }}" wire:navigate
                    class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to List
                </a>
                
                @if ($container->status === 'Approved' && $container->pdf_ro)
                    <a href="{{ Storage::url($container->pdf_ro) }}" target="_blank"
                        class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                        <i class="fas fa-file-pdf mr-2"></i>
                        View PDF Document
                    </a>
                @endif
                
                <button onclick="window.print()"
                    class="inline-flex items-center px-6 py-3 bg-blue-800 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    <i class="fas fa-print mr-2"></i>
                    Print Details
                </button>
            </div>
        </div>
    </div>
@endsection
