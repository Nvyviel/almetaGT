@extends('layouts.fullscreen')

@section('title', 'Detail')
@section('component')
    <div class="min-h-screenpy-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex items-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mr-6">
                            <i class="fa-solid fa-ship text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Container Details</h1>
                            <p class="text-xl text-blue-600 font-semibold mt-1">{{ $container->id_order }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <!-- Status Badge -->
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-2xl text-sm font-semibold shadow-sm
                            {{ $container->status == 'Requested'
                                ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-white'
                                : ($container->status == 'Approved'
                                    ? 'bg-gradient-to-r from-green-400 to-green-500 text-white'
                                    : 'bg-gradient-to-r from-red-400 to-red-500 text-white') }}">
                            <div class="w-2 h-2 bg-white rounded-full mr-2"></div>
                            {{ $container->status }}
                        </span>

                        <!-- Download Button or Error Message -->
                        @if ($container->status === 'Approved' && $container->pdf_ro)
                            <a href="{{ Storage::url('containers/' . $container->pdf_ro) }}" target="_blank"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download RO
                            </a>
                        @elseif ($container->status === 'Approved' && !$container->pdf_ro)
                            <div
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-2xl shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                <div class="text-center">
                                    <p class="font-semibold">Error</p>
                                    <p class="text-sm opacity-90">Please contact our Customer Service</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Info Bar -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600">{{ $container->quantity }}</p>
                            <p class="text-sm text-gray-500">Quantity</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600">{{ $container->weight }}kg</p>
                            <p class="text-sm text-gray-500">Weight</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-purple-600">{{ $container->container_type }}</p>
                            <p class="text-sm text-gray-500">Type</p>
                        </div>
                        <div class="text-center">
                            <p
                                class="text-2xl font-bold {{ $container->is_danger === 'Yes' ? 'text-red-600' : 'text-green-600' }}">
                                {{ $container->is_danger }}
                            </p>
                            <p class="text-sm text-gray-500">Danger</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Shipment Information -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            Shipment Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Stuffing Location</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $container->stuffing }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Container Ownership</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $container->ownership_container }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 4v10a2 2 0 002 2h6a2 2 0 002-2V8M7 8h10m-5 4v4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Load Type</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $container->load_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Container Details -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            Container Details
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Container Type</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $container->container_type }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Commodity</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $container->commodity }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">Created Date</p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ $container->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        Additional Information
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Notes Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Notes
                            </h3>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $container->notes ?: 'No additional notes provided for this container.' }}
                                </p>
                            </div>
                        </div>

                        <!-- Metadata -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Metadata
                            </h3>
                            <div class="space-y-4">
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p class="text-sm text-gray-500 mb-1">Order ID</p>
                                    <p class="font-mono text-lg font-semibold text-gray-900">{{ $container->id_order }}
                                    </p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p class="text-sm text-gray-500 mb-1">Last Updated</p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ $container->updated_at->format('M d, Y \a\t H:i') }}</p>
                                </div>
                                @if ($container->pdf_ro)
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <p class="text-sm text-gray-500 mb-1">Document Status</p>
                                        <p class="text-lg font-semibold text-green-600">PDF RO Available</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="flex justify-center">
                <a href="{{ route(request('source', 'release-order')) }}" wire:navigate
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white rounded-2xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Container List
                </a>
            </div>
        </div>
    </div>
@endsection
