@extends('layouts.main')

@section('title', 'Approval Shipping Instructions')
@section('component')
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-4 max-w-7xl">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-signature text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Shipping Instructions Approval</h1>
                            <p class="text-sm text-gray-600">Review and approve pending shipping instructions</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ $shippingInstructions->where('status', 'Requested')->groupBy('container.id_order')->count() }} Pending</p>
                            <p class="text-xs text-gray-500">Orders</p>
                        </div>
                        <a href="{{ route('history-si') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                            <i class="fas fa-history mr-2"></i>
                            View History
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-md font-semibold text-gray-900">Search & Filter</h3>
                    <span class="text-sm text-gray-500">Find specific instructions</span>
                </div>
                <form method="GET" action="{{ route('approval-si') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <!-- Select Vessel -->
                        <div>
                            <label for="selectedVessel" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-ship text-blue-800 mr-1"></i>Vessel
                            </label>
                            <select id="selectedVessel" name="selectedVessel"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-800 text-sm">
                                <option value="">All Vessels</option>
                                @foreach ($availableVessel as $name)
                                    <option value="{{ $name }}" {{ request('selectedVessel') == $name ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search Field -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-search text-blue-800 mr-1"></i>Search
                            </label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="Company or industry..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-800 text-sm">
                        </div>

                        <!-- Order ID Field -->
                        <div>
                            <label for="order_id" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-hashtag text-blue-800 mr-1"></i>Order ID
                            </label>
                            <input type="text" id="order_id" name="order_id" value="{{ request('order_id') }}"
                                placeholder="Shipping instruction ID..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-800 text-sm">
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2 mt-3">
                        <button type="submit"
                            class="flex-1 bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-150">
                            <i class="fas fa-filter mr-2"></i>Filter
                        </button>
                        <a href="{{ route('approval-si') }}" wire:navigate
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-150 text-center">
                            <i class="fas fa-times mr-2"></i>Reset
                        </a>
                    </div>
                </form>

                @if (session('success'))
                    <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <p class="text-sm font-medium text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Shipping Instructions List -->
            <div class="space-y-3">
                @php
                    $groupedInstructions = $shippingInstructions->groupBy('container.order_id');
                @endphp

                @forelse($groupedInstructions as $orderId => $instructions)
                    <div class="bg-white border border-gray-200 rounded-lg">
                        <div class="p-4">
                            <!-- Header Row -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <!-- Instruction ID with copy functionality -->
                                    <button
                                        class="bg-blue-50 text-blue-800 px-3 py-1 border border-blue-200 text-xs font-medium rounded-lg hover:bg-blue-100"
                                        onclick="navigator.clipboard.writeText('{{ $instructions->first()->id }}').then(() => { 
                                            this.innerHTML = '<i class=\'fas fa-check mr-1\'></i>Copied!'; 
                                            setTimeout(() => { 
                                                this.innerHTML = '<i class=\'fas fa-copy mr-1\'></i>SI-{{ $instructions->first()->id }}'; 
                                            }, 2000); 
                                        });"
                                        type="button">
                                        <i class="fas fa-copy mr-1"></i>SI-{{ $instructions->first()->instructions_id }}
                                    </button>
                                    
                                    <!-- Status Badge -->
                                    <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $instructions->first()->status }}
                                    </span>
                                    
                                    <!-- Industry Name -->
                                    <span class="text-sm font-semibold text-gray-900">
                                        <i class="fas fa-industry text-blue-800 mr-1"></i>
                                        {{ $instructions->first()->consignee->industry ?? 'No Industry' }}
                                    </span>
                                </div>

                                <!-- Date -->
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 text-xs font-medium rounded">
                                    <i class="fas fa-calendar mr-1"></i>{{ \Carbon\Carbon::parse($instructions->first()->created_at)->format('d M Y') }}
                                </span>
                            </div>

                            <!-- Content Row -->
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-center mb-4">
                                <!-- Instruction Details -->
                                <div class="lg:col-span-2">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 text-xs">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-ship w-4 text-blue-800 mr-1"></i>
                                            <span class="font-medium">{{ $instructions->first()->container->shipment_container->vessel_name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-box w-4 text-blue-800 mr-1"></i>
                                            <span>{{ $instructions->first()->container->container_type ?? 'Unknown' }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-user w-4 text-blue-800 mr-1"></i>
                                            <span>{{ $instructions->first()->consignee->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    @if($instructions->first()->notes ?? null)
                                    <div class="mt-2 p-2 bg-gray-50 rounded text-xs">
                                        <i class="fas fa-comment text-gray-400 mr-1"></i>
                                        <span class="text-gray-600">{{ Str::limit($instructions->first()->notes, 100) }}</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- View Details Button -->
                                <div class="lg:text-right">
                                    <a href="{{ route('detail-si', $instructions->first()->id) }}" wire:navigate
                                        class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                                        <i class="fas fa-eye mr-2"></i>View Details
                                    </a>
                                </div>
                            </div>

                            <!-- Upload Section -->
                            <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                <div x-data="{ fileChosen: false }">
                                    <h4 class="text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                        <i class="fas fa-file-signature text-blue-800 mr-2"></i>
                                        Upload Shipping Instruction Document
                                    </h4>
                                    <label class="flex flex-col items-center justify-center px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 @error('si_file') border-red-600 @enderror">
                                        <input type="file" name="si_file" id="si_file" class="sr-only" accept=".pdf" x-on:change="fileChosen = true" required>
                                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                                        <span class="text-sm text-gray-600">Choose PDF file or drag here</span>
                                        <p class="text-xs text-gray-500">Max 10MB</p>
                                    </label>
                                    <div x-show="fileChosen" class="mt-2 p-2 bg-blue-50 rounded text-xs" style="display: none;">
                                        <i class="fas fa-check-circle text-blue-800 mr-1"></i>
                                        <span class="text-blue-800">File selected</span>
                                    </div>
                                    @error('si_file')
                                        <p class="mt-2 text-xs text-red-600">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-2">
                                <form action="{{ route('approved-si', $instructions->first()->id) }}" method="POST" class="flex-1" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="si_file" id="approve_si_file" class="hidden" accept=".pdf">
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                                        <i class="fas fa-check mr-2"></i>Approve Instruction
                                    </button>
                                </form>

                                <form action="{{ route('rejected-si', $instructions->first()->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                                        <i class="fas fa-times mr-2"></i>Reject Instruction
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-12 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-file-signature text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Pending Instructions</h3>
                        <p class="text-gray-600 text-sm max-w-sm mx-auto">
                            There are currently no shipping instructions waiting for approval. New requests will appear here.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($shippingInstructions->hasPages())
                <div class="mt-6 flex justify-center">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-2">
                        {{ $shippingInstructions->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Toast Notifications -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
            class="fixed top-4 right-4 bg-green-600 text-white px-6 py-4 rounded-lg shadow-lg z-50 min-w-80">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                <div class="flex-1">
                    <p class="font-medium">Success!</p>
                    <p class="text-sm text-green-100">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="ml-3 text-white hover:text-green-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
            class="fixed top-4 right-4 bg-red-600 text-white px-6 py-4 rounded-lg shadow-lg z-50 min-w-80">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                <div class="flex-1">
                    <p class="font-medium">Error!</p>
                    <p class="text-sm text-red-100">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="ml-3 text-white hover:text-red-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
            class="fixed top-4 right-4 bg-red-600 text-white px-6 py-4 rounded-lg shadow-lg z-50 min-w-80">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-3 text-lg"></i>
                <div class="flex-1">
                    <p class="font-medium">Validation Error!</p>
                    <p class="text-sm text-red-100">{{ $errors->first() }}</p>
                </div>
                <button @click="show = false" class="ml-3 text-white hover:text-red-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File selection handler
            const fileInput = document.getElementById('si_file');
            const approveInput = document.getElementById('approve_si_file');
            
            if (fileInput && approveInput) {
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        approveInput.files = dataTransfer.files;
                    }
                });
            }
        });
    </script>
@endsection
