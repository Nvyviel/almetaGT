@extends('layouts.fullscreen')

@section('title', 'Bill Detail')
@section('component')
    <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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

        {{-- Back Button --}}
        <div class="mb-4">
            <a href="{{ route('list-bill') }}" class="inline-flex items-center text-blue-800 hover:text-blue-600 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Bills List
            </a>
        </div>

        {{-- Quick Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-800 rounded-lg p-4 text-white">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <div>
                        <p class="text-blue-200 text-sm">Bill ID</p>
                        <p class="font-bold">{{ $bill->bill_id }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Status</p>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if ($bill->status === 'Unpaid') bg-red-600 text-white
                            @elseif($bill->status === 'Paid') bg-green-600 text-white
                            @elseif($bill->status === 'Under Verification') bg-yellow-500 text-black
                            @else bg-red-600 text-white @endif">
                            {{ $bill->status }}
                        </span>
                    </div>
                    <div class="text-2xl">
                        @if ($bill->status === 'Paid') ✅
                        @elseif($bill->status === 'Under Verification') ⏳
                        @else ❌ @endif
                    </div>
                </div>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-600 text-sm font-medium">Grand Total</p>
                        <p class="text-xl font-bold text-green-800">Rp {{ number_format($bill->grand_total, 0, ',', '.') }}</p>
                    </div>
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Bill Information Cards Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">
            {{-- Company & Shipment Info --}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-blue-800 px-5 py-3">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Shipment Information
                    </h3>
                </div>
                <div class="p-5 space-y-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Company Name</label>
                            <p class="text-gray-900 font-semibold">{{ $bill->user->company_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Payment Term</label>
                            <p class="text-gray-900 font-semibold">{{ $bill->payment_term }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Vessel Name</label>
                            <p class="text-gray-900">{{ $bill->shipment->vessel_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Route</label>
                            <p class="text-gray-900 font-mono text-sm">{{ strtoupper($bill->shipment->from_city) }} → {{ strtoupper($bill->shipment->to_city) }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Container ID</label>
                            <p class="text-gray-900 font-mono text-sm">{{ $bill->container->id_order }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Container Type</label>
                            <p class="text-gray-900">{{ $bill->container->container_type }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Quantity</label>
                            <p class="text-gray-900">{{ $bill->container->quantity }} container(s)</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Weight</label>
                            <p class="text-gray-900">{{ number_format($bill->container->weight, 0, ',', '.') }} kg</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Document & Timestamps --}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-blue-800 px-5 py-3">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Bill Information
                    </h3>
                </div>
                <div class="p-5 space-y-3">
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Created Date</label>
                            <p class="text-gray-900">{{ $bill->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Last Updated</label>
                            <p class="text-gray-900">{{ $bill->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        @if($bill->upload_file)
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-600">Document</label>
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center justify-center w-8 h-8 bg-red-600 rounded-lg">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Bill Document</p>
                                    <p class="text-xs text-gray-500">PDF File</p>
                                </div>
                                <a href="{{ Storage::url($bill->upload_file) }}" target="_blank" 
                                   class="inline-flex items-center px-2 py-1 bg-blue-800 text-white text-xs font-medium rounded hover:bg-blue-700">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Payment Confirmation Info --}}
            @if($bill->upload_confirmation || $bill->payment_confirmed_at || $bill->paid_at)
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-blue-800 px-5 py-3">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Payment Confirmation
                    </h3>
                </div>
                <div class="p-5 space-y-3">
                    @if($bill->upload_confirmation)
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-600">Payment Proof</label>
                        <div class="flex items-center space-x-2">
                            <div class="flex items-center justify-center w-8 h-8 bg-green-600 rounded-lg">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Payment Confirmation</p>
                                <p class="text-xs text-gray-500">{{ strtoupper(pathinfo($bill->upload_confirmation, PATHINFO_EXTENSION)) }} File</p>
                            </div>
                            <a href="{{ Storage::url($bill->upload_confirmation) }}" target="_blank" 
                               class="inline-flex items-center px-2 py-1 bg-blue-800 text-white text-xs font-medium rounded hover:bg-blue-700">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                        </div>
                    </div>
                    @endif
                    
                    @if($bill->payment_confirmed_at)
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-600">Payment Confirmed At</label>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($bill->payment_confirmed_at)->format('d M Y, H:i') }}</p>
                    </div>
                    @endif
                    
                    @if($bill->paid_at)
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-600">Paid At</label>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($bill->paid_at)->format('d M Y, H:i') }}</p>
                    </div>
                    @endif
                    
                    @if($bill->status === 'Under Verification')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Under Verification</h3>
                                <p class="mt-1 text-sm text-yellow-700">Payment confirmation is being verified by our team.</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        {{-- Fee Breakdown --}}
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden mb-6">
            <div class="bg-blue-800 px-5 py-3">
                <div class="flex items-center">
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Fee Breakdown</h3>
                        <p class="text-blue-100 text-sm">Detailed breakdown of all charges</p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Description</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700 uppercase tracking-wider">Amount</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Type</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            {{-- Required Fees --}}
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">THC LOLO</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->thc_lolo, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-600 text-white">Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">Freight Surcharge</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->freight_surcharge, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-600 text-white">Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">BL/DO Fee</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->bl_do_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-600 text-white">Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">APBS Fee</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->apbs_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-600 text-white">Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">Trucking Buruh Fee</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->trucking_buruh_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-600 text-white">Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">Dooring Fee</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->dooring_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-600 text-white">Required</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">Others</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->others, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-600 text-white">Required</span>
                                </td>
                            </tr>

                            {{-- Optional Fees - Only show if > 0 --}}
                            @if($bill->seal_fee > 0)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">Seal Fee</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->seal_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-800 text-white">Optional</span>
                                </td>
                            </tr>
                            @endif
                            @if($bill->operational_fee > 0)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">Operational Fee</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->operational_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-800 text-white">Optional</span>
                                </td>
                            </tr>
                            @endif
                            @if($bill->refund_fee > 0)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">Refund Fee</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->refund_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-800 text-white">Optional</span>
                                </td>
                            </tr>
                            @endif
                            @if($bill->ppn > 0)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">PPN</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->ppn, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-800 text-white">Optional</span>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr class="bg-blue-800 border-t-2 border-blue-700">
                                <td class="px-4 py-4 text-lg font-bold text-white uppercase tracking-wider">Grand Total</td>
                                <td class="px-4 py-4 text-lg font-bold text-right text-white">
                                    Rp {{ number_format($bill->grand_total, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="inline-flex px-3 py-2 text-sm font-bold rounded-full bg-white text-blue-800">TOTAL</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 justify-end">
            @if($bill->status === 'Unpaid')
                <a href="{{ route('bills.payment-confirmation', $bill->id) }}"
                    class="inline-flex items-center justify-center px-5 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Payment Confirmation
                </a>
            @elseif($bill->status === 'Under Verification')
                <form action="{{ route('bills.cancel-payment-confirmation', $bill->id) }}" method="POST" class="inline-flex" onsubmit="return confirm('Are you sure you want to cancel the payment confirmation? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="inline-flex items-center justify-center px-5 py-2 bg-red-600 text-white font-semibold rounded hover:bg-red-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel Payment
                    </button>
                </form>
                
                @if(Auth::user()->is_admin)
                <button onclick="approveBill({{ $bill->id }})"
                    class="inline-flex items-center justify-center px-5 py-2 bg-blue-800 text-white font-semibold rounded hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Approve Payment
                </button>
                @endif
            @endif
            
            <button onclick="printBill({{ $bill->id }})"
                class="inline-flex items-center justify-center px-5 py-2 bg-gray-600 text-white font-semibold rounded hover:bg-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Bill
            </button>
        </div>
    </div>

    {{-- JavaScript Functions --}}
    <script>
        function approveBill(billId) {
            if (confirm('Are you sure you want to approve this payment?')) {
                fetch(`/bills/${billId}/approve`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to approve bill');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
            }
        }

        function printBill(billId) {
            window.open(`/bills/${billId}/print`, '_blank');
        }
    </script>
@endsection