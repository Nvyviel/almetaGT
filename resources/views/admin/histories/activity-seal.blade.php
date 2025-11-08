@extends('layouts.main')

@section('title', 'Activity Seal')
@section('component')
    <div class="container mx-auto px-4 sm:px-6 py-4">
        {{-- Header Section --}}
        <div class="bg-blue-800 rounded-lg px-5 py-4 mb-5">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <div class="flex items-center">
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Seal Activity</h2>
                        <p class="text-blue-100 text-sm">Monitor all seal orders and transactions</p>
                    </div>
                </div>
                @if (auth()->user()->is_admin == true)
                    <a href="{{ route('add-stock') }}" wire:navigate
                        class="flex items-center justify-center bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Stock
                    </a>
                @endif
            </div>
        </div>

        {{-- Summary Statistics --}}
        @if($seals->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Orders</p>
                            <p class="text-xl font-bold text-gray-900">{{ $seals->total() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Successful Orders</p>
                            <p class="text-xl font-bold text-green-600">{{ $seals->where('status', 'Success')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Processing</p>
                            <p class="text-xl font-bold text-yellow-600">{{ $seals->where('status', 'Payment Proccess')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="space-y-3">
            @forelse($seals as $seal)
                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                    <div class="p-4">
                        <div class="flex flex-col sm:flex-row justify-between items-start gap-3">
                            <div class="w-full">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-2 gap-2">
                                    <div class="flex items-center">
                                        <div class="bg-blue-800 bg-opacity-10 p-2 rounded-lg mr-3">
                                            <svg class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h5 class="text-base font-semibold text-gray-800 flex items-center gap-2">
                                                {{ $seal->user->name }}
                                                <span class="text-sm text-gray-500 font-normal">
                                                    (#{{ $seal->id_seal }})
                                                </span>
                                            </h5>
                                            <p class="text-sm text-gray-500">
                                                {{ $seal->user->company_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        @php
                                            $statusClasses = [
                                                'Success' => 'bg-green-600 text-white',
                                                'Canceled' => 'bg-red-600 text-white',
                                                'Payment Proccess' => 'bg-blue-800 text-white',
                                            ];
                                            $statusClass = $statusClasses[$seal->status] ?? 'bg-blue-800 text-white';
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $statusClass }}">
                                            {{ $seal->status }}
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-3 border-t border-gray-100 pt-3">
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500">Pickup Point</p>
                                            <p class="text-sm font-medium">{{ ucfirst($seal->pickup_point) }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500">Quantity</p>
                                            <p class="text-sm font-medium">{{ $seal->quantity }} seals</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500">Total Price</p>
                                            <p class="text-sm font-medium text-green-600">
                                                Rp {{ number_format($seal->total_price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500">Order Date</p>
                                            <p class="text-sm font-medium">{{ $seal->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm rounded-lg p-6 text-center border border-gray-200">
                    <div class="bg-blue-50 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="h-8 w-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Seal Activity</h3>
                    <p class="text-gray-500 mb-4">There are no seal orders to display at the moment.</p>
                    @if (auth()->user()->is_admin == true)
                        <a href="{{ route('add-stock') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add New Stock
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        @if($seals->hasPages())
            <div class="flex justify-center mt-5">
                {{ $seals->links() }}
            </div>
        @endif
    </div>
@endsection
