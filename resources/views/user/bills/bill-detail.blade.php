@extends('layouts.fullscreen')

@section('title', 'Bill Detail')
@section('component')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
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
        <div class="mb-6">
            <a href="{{ route('list-bill') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>

        {{-- Bill Header --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-8">
            <div class="border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $bill->bill_id }}</h1>
                            <p class="text-gray-600 text-sm mt-1">Bill Details & Breakdown</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="mb-2">
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if ($bill->status === 'Unpaid') bg-yellow-100 text-yellow-800 
                                @elseif($bill->status === 'Paid') bg-green-100 text-green-800 
                                @elseif($bill->status === 'Under Verification') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $bill->status }}
                            </span>
                        </div>
                        <p class="text-lg font-bold text-gray-900">
                            Rp {{ number_format($bill->grand_total, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bill Information Cards Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            {{-- Company & Shipment Info --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">Shipment Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Company Name</label>
                            <p class="text-gray-900 font-semibold">{{ $bill->user->company_name }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Payment Term</label>
                            <p class="text-gray-900 font-semibold">{{ $bill->payment_term }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Vessel Name</label>
                            <p class="text-gray-900">{{ $bill->shipment->vessel_name }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Route</label>
                            <p class="text-gray-900">{{ strtoupper($bill->shipment->from_city) }} → {{ strtoupper($bill->shipment->to_city) }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Container ID</label>
                            <p class="text-gray-900 font-mono">{{ $bill->container->id_order }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Container Type</label>
                            <p class="text-gray-900">{{ $bill->container->container_type }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Quantity</label>
                            <p class="text-gray-900">{{ $bill->container->quantity }} container(s)</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Weight</label>
                            <p class="text-gray-900">{{ number_format($bill->container->weight, 0, ',', '.') }} kg</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Document & Timestamps --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">Bill Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Created Date</label>
                            <p class="text-gray-900">{{ $bill->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Last Updated</label>
                            <p class="text-gray-900">{{ $bill->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        @if($bill->upload_file)
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Uploaded Document</label>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Bill Document</p>
                                    <p class="text-xs text-gray-500">PDF File</p>
                                </div>
                                <a href="{{ Storage::url($bill->upload_file) }}" target="_blank" 
                                   class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="border-b border-gray-200 bg-blue-50 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">Payment Confirmation</h3>
                </div>
                <div class="p-6 space-y-4">
                    @if($bill->upload_confirmation)
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Payment Proof</label>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Payment Confirmation File</p>
                                <p class="text-xs text-gray-500">{{ pathinfo($bill->upload_confirmation, PATHINFO_EXTENSION) }} File</p>
                            </div>
                            <a href="{{ Storage::url($bill->upload_confirmation) }}" target="_blank" 
                               class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                        </div>
                    </div>
                    @endif
                    
                    @if($bill->payment_confirmed_at)
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Payment Confirmed At</label>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($bill->payment_confirmed_at)->format('d M Y, H:i') }}</p>
                    </div>
                    @endif
                    
                    @if($bill->paid_at)
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600">Paid At</label>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($bill->paid_at)->format('d M Y, H:i') }}</p>
                    </div>
                    @endif
                    
                    @if($bill->status === 'Under Verification')
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Payment Under Verification</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <p>Your payment confirmation has been submitted and is currently being verified by our team.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        {{-- Fee Breakdown --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-8">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-6">
                <div class="flex items-center">
                    <div class="bg-green-100 p-2 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Fee Breakdown</h3>
                        <p class="text-gray-600 text-sm mt-1">Detailed breakdown of all charges</p>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Type</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            {{-- Required Fees --}}
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">THC LOLO</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->thc_lolo, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Freight Surcharge</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->freight_surcharge, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">BL/DO Fee</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->bl_do_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">APBS Fee</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->apbs_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Trucking Buruh Fee</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->trucking_buruh_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Dooring Fee</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->dooring_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Others</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->others, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Required</span>
                                </td>
                            </tr>

                            {{-- Optional Fees - Only show if > 0 --}}
                            @if($bill->seal_fee > 0)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Seal Fee</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->seal_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Optional</span>
                                </td>
                            </tr>
                            @endif
                            @if($bill->operational_fee > 0)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Operational Fee</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->operational_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Optional</span>
                                </td>
                            </tr>
                            @endif
                            @if($bill->refund_fee > 0)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Refund Fee</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->refund_fee, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Optional</span>
                                </td>
                            </tr>
                            @endif
                            @if($bill->ppn > 0)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">PPN</td>
                                <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                    Rp {{ number_format($bill->ppn, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Optional</span>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 border-t-2 border-indigo-200">
                                <td class="px-6 py-6 text-lg font-bold text-indigo-900 uppercase tracking-wider">Grand Total</td>
                                <td class="px-6 py-6 text-lg font-bold text-right text-indigo-900">
                                    Rp {{ number_format($bill->grand_total, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="inline-flex px-3 py-2 text-sm font-bold rounded-full bg-indigo-100 text-indigo-800">TOTAL</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            @if($bill->status === 'Unpaid')
                <a href="{{ route('bills.payment-confirmation', $bill->id) }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Payment Confirmation
                </a>
            @elseif($bill->status === 'Under Verification')
                <form action="{{ route('bills.cancel-payment-confirmation', $bill->id) }}" method="POST" class="inline-flex" onsubmit="return confirm('Are you sure you want to cancel the payment confirmation? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel Payment Confirmation
                    </button>
                </form>
                
                @if(Auth::user()->is_admin)
                <button onclick="approveBill({{ $bill->id }})"
                    class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Approve Payment
                </button>
                @endif
            @endif
            
            <button onclick="printBill({{ $bill->id }})"
                class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Bill
            </button>
        </div>
    </div>

    {{-- JavaScript Functions --}}
    <script>
        function markAsPaid(billId) {
            if (confirm('Are you sure you want to mark this bill as paid?')) {
                // Add your AJAX call or form submission here
                fetch(`/bills/${billId}/mark-paid`, {
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
                        alert('Failed to update bill status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
            }
        }

        function approveBill(billId) {
            if (confirm('Are you sure you want to approve this payment?')) {
                // Add your AJAX call or form submission here
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