@extends('layouts.main')

@section('title', 'List Bills')
@section('component')
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="bg-blue-800 rounded-lg shadow-sm p-4 mb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-white/10 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">Bills Management</h1>
                        <p class="text-blue-100 text-sm">Manage and track your shipping bills</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-blue-100 text-xs">Total Bills</div>
                    <div class="text-white font-semibold">{{ $bills->total() }}</div>
                </div>
            </div>
        </div>

        {{-- Alert Messages --}}
        @if (session()->has('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4" role="alert">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- Filter Navigation --}}
        <div class="mb-4">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('list-bill', ['filter' => 'all']) }}" wire:navigate
                    class="px-3 py-1.5 rounded-lg text-sm font-medium {{ request()->input('filter', 'all') === 'all' ? 'bg-blue-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    All Bills
                </a>
                <a href="{{ route('list-bill', ['filter' => 'paid']) }}" wire:navigate
                    class="px-3 py-1.5 rounded-lg text-sm font-medium {{ request()->input('filter') === 'paid' ? 'bg-blue-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Paid
                </a>
                <a href="{{ route('list-bill', ['filter' => 'unpaid']) }}" wire:navigate
                    class="px-3 py-1.5 rounded-lg text-sm font-medium {{ request()->input('filter') === 'unpaid' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Unpaid
                </a>
            </div>
        </div>

        {{-- Bills List --}}
        <div class="space-y-3">
            @forelse ($bills as $bill)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-sm">
                    <div class="p-4 grid grid-cols-1 lg:grid-cols-12 gap-3 items-start lg:items-center">
                        {{-- Left Section: Bill Details --}}
                        <div class="lg:col-span-9 space-y-3">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 text-xs font-semibold rounded cursor-pointer hover:bg-blue-200"
                                    onclick="navigator.clipboard.writeText('{{ $bill->bill_id }}').then(() => { 
                                        const originalText = this.innerText;
                                        this.innerText = 'Copied!'; 
                                        setTimeout(() => { this.innerText = originalText; }, 1000); 
                                    });"
                                    title="Click to copy">
                                    {{ $bill->bill_id }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $bill->created_at->format('d M Y') }}
                                </span>
                                @php
                                    $statusClasses = [
                                        'Paid' => 'bg-green-100 text-green-800',
                                        'Unpaid' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusClass = $statusClasses[$bill->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $statusClass }}">
                                    <span class="mr-1 h-1.5 w-1.5 rounded-full" style="background-color: currentColor"></span>
                                    {{ $bill->status }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div>
                                    <p class="font-medium text-sm text-gray-900">{{ $bill->user->company_name }}</p>
                                    <p class="text-xs text-gray-500">Company</p>
                                </div>
                                <div>
                                    <p class="font-medium text-sm text-gray-900">{{ $bill->shipment->vessel_name }}</p>
                                    <p class="text-xs text-gray-500">Vessel</p>
                                </div>
                                <div>
                                    <p class="font-medium text-sm text-gray-900">
                                        {{ strtoupper($bill->shipment->from_city) }} → {{ strtoupper($bill->shipment->to_city) }}
                                    </p>
                                    <p class="text-xs text-gray-500">Route</p>
                                </div>
                            </div>
                        </div>

                        {{-- Right Section: Action Buttons --}}
                        <div class="lg:col-span-3 flex justify-start lg:justify-end space-x-2">
                            @if ($bill->status === 'Unpaid')
                                <form id="payment-form">
                                    @csrf
                                    <button type="button" onclick="payBill({{ $bill->id }})"
                                        class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Pay
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('detail-bill', $bill->id) }}"
                                class="inline-flex items-center px-3 py-2 bg-blue-800 hover:bg-blue-900 text-white rounded-lg text-sm font-medium">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-6 bg-gray-50 rounded-lg">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-sm font-medium text-gray-900 mb-1">No bills found</h3>
                    <p class="text-sm text-gray-600">Try adjusting your filter or create a new bill</p>
                </div>
            @endforelse
        </div>
        
        {{-- Pagination --}}
        @if ($bills->hasPages())
            <div class="mt-4">
                {{ $bills->links() }}
            </div>
        @endif
    </div>

    <script>
        function payBill(billId) {
            if (confirm('Are you sure you want to confirm payment for this bill?')) {
                // Add your payment logic here
                console.log('Payment confirmed for bill ID:', billId);
                // You can add AJAX call or form submission here
            }
        }
    </script>
@endsection
