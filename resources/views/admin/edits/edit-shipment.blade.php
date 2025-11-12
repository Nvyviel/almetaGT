@extends('layouts.main')
@section('title', 'Edit Shipment')
@section('component')
    <div class="min-h-screen py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-4" aria-label="Breadcrumb">
                <div class="flex items-center space-x-2 text-sm">
                    <a href="{{ route('create-shipment') }}"
                        class="flex items-center text-gray-500 hover:text-blue-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Shipments
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="font-semibold text-gray-700">Edit Shipment</span>
                </div>
            </nav>

            <!-- Main Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                <!-- Header -->
                <div class="bg-blue-800 px-4 sm:p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-xl sm:text-2xl font-bold text-white">Edit Shipment</h1>
                                <p class="text-blue-100 text-sm mt-0.5">Update details for vessel: <span
                                        class="font-semibold">{{ $shipment->vessel_name }}</span></p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="bg-white bg-opacity-10 rounded-lg px-3 py-2">
                                <p class="text-blue-100 text-xs">Last Updated</p>
                                <p class="text-white font-semibold text-sm">{{ date('M d, Y', strtotime($shipment->updated_at)) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('update-shipment', $shipment) }}" method="POST" class="p-4 sm:p-6"
                    id="shipmentForm">
                    @csrf
                    @method('PUT')

                    <!-- Port Information Section -->
                    <div class="mb-6">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="font-bold text-gray-900">Port Information</h2>
                                <p class="text-gray-600 text-sm">Configure loading and discharge ports</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- From City -->
                            <div class="space-y-1">
                                <label for="from_city" class="flex items-center text-gray-800 font-semibold text-sm">
                                    <svg class="w-4 h-4 mr-1 text-blue-800" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Port of Loading (POL)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-anchor text-gray-400 text-sm"></i>
                                    </div>
                                    <select name="from_city" id="from_city"
                                        class="w-full pl-10 pr-8 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white appearance-none @error('from_city') border-red-600 ring-red-600 @enderror">
                                        @foreach ($cities as $key => $city)
                                            <option value="{{ $key }}"
                                                {{ $shipment->from_city == $key ? 'selected' : '' }}>
                                                {{ $city }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('from_city')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- To City -->
                            <div class="space-y-1">
                                <label for="to_city" class="flex items-center text-gray-800 font-semibold text-sm">
                                    <svg class="w-4 h-4 mr-1 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Port of Discharge (POD)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-anchor text-gray-400 text-sm"></i>
                                    </div>
                                    <select name="to_city" id="to_city"
                                        class="w-full pl-10 pr-8 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white appearance-none @error('to_city') border-red-600 ring-red-600 @enderror">
                                        @foreach ($cities as $key => $city)
                                            <option value="{{ $key }}"
                                                {{ $shipment->to_city == $key ? 'selected' : '' }}>
                                                {{ $city }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('to_city')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Vessel Information Section -->
                    <div class="mb-6">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="font-bold text-gray-900">Vessel & Pricing Information</h2>
                                <p class="text-gray-600 text-sm">Update vessel details and pricing structure</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                            <!-- Vessel Name -->
                            <div class="space-y-1">
                                <label for="vessel_name" class="block text-gray-800 font-semibold text-sm">Vessel Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-solid fa-ship text-gray-400 text-sm"></i>
                                    </div>
                                    <input type="text" name="vessel_name" id="vessel_name"
                                        value="{{ old('vessel_name', $shipment->vessel_name) }}"
                                        class="w-full pl-10 pr-3 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white @error('vessel_name') border-red-600 ring-red-600 @enderror"
                                        placeholder="Enter vessel name">
                                </div>
                                @error('vessel_name')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Base Rate -->
                            <div class="space-y-1">
                                <label for="freight_20" class="block text-gray-800 font-semibold text-sm">Freight 20 (IDR)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium text-sm">Rp</span>
                                    </div>
                                    <input type="text" name="freight_20" id="freight_20"
                                        value="{{ old('freight_20', $shipment->freight_20) }}"
                                        class="w-full pl-10 pr-3 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white thousand-format @error('freight_20') border-red-600 ring-red-600 @enderror"
                                        placeholder="Enter rate">
                                </div>
                                @error('freight_20')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Rate Per Container -->
                            <div class="space-y-1">
                                <label for="freight_40" class="block text-gray-800 font-semibold text-sm">Freight 40 (IDR)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium text-sm">Rp</span>
                                    </div>
                                    <input type="text" name="freight_40" id="freight_40"
                                        value="{{ old('freight_40', $shipment->freight_40) }}"
                                        class="w-full pl-10 pr-3 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white thousand-format @error('freight_40') border-red-600 ring-red-600 @enderror"
                                        placeholder="Enter rate">
                                </div>
                                @error('freight_40')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Information Section -->
                    <div class="mb-6">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-blue-800" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="font-bold text-gray-900">Schedule Information</h2>
                                <p class="text-gray-600 text-sm">Set departure and arrival times</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Open Stack -->
                            <div class="space-y-1">
                                <label for="open_stack" class="block text-gray-800 font-semibold text-sm">Open Stack</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" name="open_stack" id="open_stack"
                                        value="{{ old('open_stack', date('Y-m-d\TH:i', strtotime($shipment->open_stack))) }}"
                                        class="w-full pl-10 pr-3 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white @error('open_stack') border-red-600 ring-red-600 @enderror">
                                </div>
                                @error('open_stack')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Closing Cargo -->
                            <div class="space-y-1">
                                <label for="closing_cargo" class="block text-gray-800 font-semibold text-sm">Closing Cargo</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" name="closing_cargo" id="closing_cargo"
                                        value="{{ old('closing_cargo', date('Y-m-d\TH:i', strtotime($shipment->closing_cargo))) }}"
                                        class="w-full pl-10 pr-3 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white @error('closing_cargo') border-red-600 ring-red-600 @enderror">
                                </div>
                                @error('closing_cargo')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- ETD -->
                            <div class="space-y-1">
                                <label for="etd" class="block text-gray-800 font-semibold text-sm">ETD</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" name="etd" id="etd"
                                        value="{{ old('etd', date('Y-m-d\TH:i', strtotime($shipment->etd))) }}"
                                        class="w-full pl-10 pr-3 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white @error('etd') border-red-600 ring-red-600 @enderror">
                                </div>
                                @error('etd')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- ETA -->
                            <div class="space-y-1">
                                <label for="eta" class="block text-gray-800 font-semibold text-sm">ETA</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" name="eta" id="eta"
                                        value="{{ old('eta', date('Y-m-d\TH:i', strtotime($shipment->eta))) }}"
                                        class="w-full pl-10 pr-3 py-3 text-sm border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-800 focus:border-blue-800 bg-gray-50 focus:bg-white @error('eta') border-red-600 ring-red-600 @enderror">
                                </div>
                                @error('eta')
                                    <p class="text-xs text-red-600 flex items-center mt-0.5">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('create-shipment') }}" wire:navigate
                            class="inline-flex items-center justify-center px-4 py-2 border-2 border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200 font-semibold text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel Changes
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-800 font-semibold text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update Shipment
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Info -->
            <div class="mt-4 bg-white rounded-lg shadow border border-gray-200 p-3">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-1 sm:space-y-0">
                    <div class="text-xs text-gray-600">
                        <p class="flex items-center">
                            <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Last updated: <span
                                class="font-semibold text-gray-800 ml-1">{{ date('M d, Y \a\t H:i', strtotime($shipment->updated_at)) }}</span>
                        </p>
                    </div>
                    <div class="text-xs text-gray-600">
                        <p class="flex items-center">
                            <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Edited by: <span
                                class="font-semibold text-blue-800">{{ auth()->user()->name ?? 'Nvyviel' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Format initial values for all thousand-format inputs
    const thousandInputs = document.querySelectorAll('.thousand-format');
    thousandInputs.forEach(input => {
        formatThousand(input);
    });

    // Add event listeners for input formatting
    thousandInputs.forEach(input => {
        input.addEventListener('input', function() {
            formatThousand(this);
        });
    });

    // Handle form submission to ensure the server gets the raw numbers
    document.getElementById('shipmentForm').addEventListener('submit', function(e) {
        // Handle freight_20 field
        const freight20Input = document.getElementById('freight_20');
        if (freight20Input) {
            // Convert formatted value to raw number
            freight20Input.value = freight20Input.value.replace(/\./g, '');
        }

        // Handle freight_40 field  
        const freight40Input = document.getElementById('freight_40');
        if (freight40Input) {
            // Convert formatted value to raw number
            freight40Input.value = freight40Input.value.replace(/\./g, '');
        }
    });

    function formatThousand(input) {
        // Save cursor position
        const cursorPos = input.selectionStart;

        // Get input value and remove all non-digits
        const value = input.value.replace(/\./g, '');

        // Store original string length for cursor position calculation
        const originalLength = input.value.length;

        if (value === '') {
            input.value = '';
            return;
        }

        // Format with thousand separator
        let formattedValue = '';
        for (let i = 0; i < value.length; i++) {
            if (i > 0 && (value.length - i) % 3 === 0) {
                formattedValue += '.';
            }
            formattedValue += value[i];
        }

        // Calculate new cursor position
        const newLength = formattedValue.length;

        // Set new value
        input.value = formattedValue;

        // Calculate how many separators were before the cursor
        const beforeCursor = input.value.substring(0, cursorPos);
        const separatorsBefore = (beforeCursor.match(/\./g) || []).length;

        // The number of separators that were already in this string
        const previousSeparators = (originalLength - value.length);

        // New separators added specifically before our cursor position
        const newSeparatorsBefore = separatorsBefore - (previousSeparators > 0 ? previousSeparators : 0);

        // Adjust cursor position
        const adjustedCursorPos = Math.min(
            cursorPos + (newSeparatorsBefore > 0 ? newSeparatorsBefore : 0),
            formattedValue.length
        );

        input.setSelectionRange(adjustedCursorPos, adjustedCursorPos);
    }
});
</script>
@endsection
