@extends('layouts.main')

@section('title', 'Bills Management - Admin')

@section('component')
<div class="container mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Bills Management</h1>
                <p class="text-gray-600 mt-2">Manage payment confirmations and bill statuses</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="bg-white rounded-lg shadow-sm border px-4 py-2">
                    <span class="text-sm text-gray-600">Total Bills: </span>
                    <span class="font-semibold text-gray-900">{{ $bills->total() ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Simple Bills List --}}
    @if($bills && count($bills->items()) > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Bills List</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($bills as $bill)
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">{{ $bill->bill_id ?? 'N/A' }}</h4>
                                <p class="text-sm text-gray-500">
                                    Company: {{ $bill->user->company_name ?? 'N/A' }} | 
                                    Status: {{ $bill->status ?? 'N/A' }} |
                                    Total: Rp {{ number_format($bill->grand_total ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('detail-bill', $bill->id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    View Detail
                                </a>
                                @if($bill->status === 'Under Verification' && $bill->upload_confirmation)
                                    <form action="{{ route('admin.bills.mark-paid', $bill->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                            Mark Paid
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $bills->links() }}
        </div>
    @else
        {{-- Empty State --}}
        <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No bills found</h3>
            <p class="text-gray-600">No bills available in the system.</p>
        </div>
    @endif
</div>
@endsection
