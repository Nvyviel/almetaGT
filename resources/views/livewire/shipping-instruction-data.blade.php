<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="bg-white overflow-hidden rounded-lg shadow-sm border border-gray-100">
        {{-- Header Section --}}
        <div class="bg-white p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3 mb-4 sm:mb-0">
                <span class="p-2 rounded-lg bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                Create Shipping Instructions
            </h2>
            <a href="{{ route('shipping-instruction') }}" wire:navigate
                class="inline-flex items-center justify-center px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition duration-200 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </div>

        {{-- Selected Consignee Details --}}
        @if ($consignee_id)
            @php
                $selectedConsignee = $consignees->find($consignee_id);
            @endphp
            <div class="px-6 py-5 bg-gray-50 border-b border-gray-100">
                <h4 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <span class="p-1.5 rounded-lg bg-gray-100 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </span>
                    Consignee Details
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div
                        class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md">
                        <p class="text-xs font-medium text-gray-500 mb-1.5">Industry</p>
                        <p class="text-sm font-medium text-gray-800">{{ $selectedConsignee->industry }}</p>
                    </div>
                    <div
                        class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md">
                        <p class="text-xs font-medium text-gray-500 mb-1.5">City</p>
                        <p class="text-sm font-medium text-gray-800">{{ $selectedConsignee->city }}</p>
                    </div>
                    <div
                        class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md">
                        <p class="text-xs font-medium text-gray-500 mb-1.5">Email</p>
                        <p class="text-sm font-medium text-gray-800">{{ $selectedConsignee->email }}</p>
                    </div>
                    <div
                        class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md">
                        <p class="text-xs font-medium text-gray-500 mb-1.5">Phone Number</p>
                        <p class="text-sm font-medium text-gray-800">{{ $selectedConsignee->phone_number }}</p>
                    </div>
                    <div
                        class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md md:col-span-2 lg:col-span-3">
                        <p class="text-xs font-medium text-gray-500 mb-1.5">Address</p>
                        <p class="text-sm font-medium text-gray-800">{{ $selectedConsignee->consignee_address }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form wire:submit.prevent="store" class="p-6">
            {{-- Form Progress Indicator --}}
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Form Guide</h3>
                        <div class="mt-1 text-sm text-blue-700">
                            <p>Please complete the form in order: Select Consignee → Choose Shipment → Pick Container.
                                Fields will become available as you progress.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                {{-- Consignee Dropdown - Always Visible --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                    <label for="consignee_id" class="flex items-center gap-2 text-base font-medium text-gray-700 mb-3">
                        <span class="p-1.5 rounded-lg bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        Select Consignee
                        <span class="text-red-500 text-xs">*</span>
                    </label>
                    <select wire:model="consignee_id" id="consignee_id"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-sm @error('consignee_id') border-red-500 ring-red-500 @enderror">
                        <option value="">Choose a Consignee</option>
                        @foreach ($consignees as $consignee)
                            <option value="{{ $consignee->id }}">{{ $consignee->name_consignee }}</option>
                        @endforeach
                    </select>
                    @error('consignee_id')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Shipment Dropdown - Always Visible --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                    <label for="shipment_id" class="flex items-center gap-2 text-base font-medium text-gray-700 mb-3">
                        <span class="p-1.5 rounded-lg bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 16a5 5 0 00-5-5h-4a5 5 0 00-5 5m14 0v2a3 3 0 01-3 3H8a3 3 0 01-3-3v-2m14 0V6a3 3 0 00-3-3H8a3 3 0 00-3 3v10" />
                            </svg>
                        </span>
                        Select Shipment
                        <span class="text-red-500 text-xs">*</span>
                    </label>
                    <select wire:model.live="shipment_id" id="shipment_id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-sm
                        {{ !$consignee_id ? 'bg-gray-100 cursor-not-allowed text-gray-500' : 'bg-gray-50' }}
                        @error('shipment_id') border-red-500 ring-red-500 @enderror"
                        {{ !$consignee_id ? 'disabled' : '' }}>
                        <option value="">{{ !$consignee_id ? 'Select Consignee First' : 'Choose a Shipment' }}
                        </option>
                        @if ($consignee_id)
                            @foreach ($shipments as $shipment)
                                <option value="{{ $shipment->id }}">{{ $shipment->vessel_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('shipment_id')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Container Dropdown - Always Visible --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                    <label for="container_id"
                        class="flex items-center gap-2 text-base font-medium text-gray-700 mb-3">
                        <span class="p-1.5 rounded-lg bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </span>
                        Select Container
                        <span class="text-red-500 text-xs">*</span>
                    </label>
                    {{-- Container Dropdown --}}
                    <select wire:model.live="container_id" id="container_id" ...>
                        <option value="">{{ !$shipment_id ? 'Select Shipment First' : 'Choose a Container' }}
                        </option>
                        @if ($shipment_id && $containers->count() > 0)
                            @foreach ($containers as $container)
                                <option value="{{ $container->id }}">
                                    {{ $container->id_order }} - {{ $container->container_type }}
                                    ({{ $container->quantity }} Container{{ $container->quantity > 1 ? 's' : '' }})
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('container_id')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Container Details Section --}}
            @if ($container_id && count($container_numbers) > 0)
                <div class="space-y-5 mt-7">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">Container Details Ready</h3>
                                <div class="mt-1 text-sm text-green-700">
                                    <p>Please fill in the container details below for each container in this shipment.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach (range(0, count($container_numbers) - 1) as $index)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-50 text-green-600 rounded-lg p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Container {{ $index + 1 }}</h3>
                                <span
                                    class="ml-auto bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">
                                    Required Fields <span class="text-red-500">*</span>
                                </span>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Container Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" wire:model="container_numbers.{{ $index }}"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 text-sm @error("container_numbers.{$index}") border-red-500 ring-red-500 @enderror"
                                        placeholder="Enter container number">
                                    @error("container_numbers.{$index}")
                                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Seal Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" wire:model="seal_numbers.{{ $index }}"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 text-sm @error("seal_numbers.{$index}") border-red-500 ring-red-500 @enderror"
                                        placeholder="Enter seal number">
                                    @error("seal_numbers.{$index}")
                                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Notes <span class="text-gray-400 text-xs">(Optional)</span>
                                    </label>
                                    <textarea wire:model="container_notes.{{ $index }}" rows="3"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 text-sm @error("container_notes.{$index}") border-red-500 ring-red-500 @enderror"
                                        placeholder="Add any additional notes here"></textarea>
                                    @error("container_notes.{$index}")
                                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Form Status Indicator --}}
            @if (!$container_id)
                <div class="mt-7 bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-700">Waiting for Container Selection</h3>
                            <div class="mt-1 text-sm text-gray-500">
                                <p>Container details will appear once you select a container from the dropdown above.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Hidden input for container parameter --}}
            @if ($container_id)
                <input type="hidden" name="container" value="{{ $container_id }}">
            @endif

            {{-- Submit Button --}}
            <div class="mt-7">
                <button type="submit"
                    class="w-full py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center justify-center text-base font-medium
                    {{ $container_id && count($container_numbers) > 0 ? 'bg-blue-600 hover:bg-blue-700 text-white' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                    {{ !$container_id || count($container_numbers) == 0 ? 'disabled' : '' }}>
                    @if ($container_id && count($container_numbers) > 0)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Create Shipping Instructions
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m0 0v2m0-2h2m-2 0h-2m-3-2.5a4.5 4.5 0 01-.08-.83V6.25c0-1.45.2-2.67.5-3.75C8.96 1.54 10.34.75 12 .75s3.04.79 3.58 1.7c.3 1.08.5 2.3.5 3.75v7.17c0 .27-.03.55-.08.83M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Complete Form to Submit
                    @endif
                </button>
            </div>
        </form>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mx-6 mb-6 bg-green-50 border border-green-200 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-base font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="mx-6 mb-6 bg-red-50 border border-red-200 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="bg-red-100 p-2 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-base font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
