<div class=" py-4 px-3 sm:px-6">
    <form wire:submit.prevent="addContainer" class="max-w-6xl mx-auto space-y-4">
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-600 p-3">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-medium text-red-700">Please fix the following errors:</h3>
                        <div class="mt-1 text-sm text-red-600">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Hidden Fields -->
        <input type="hidden" wire:model="shipment_id" name="shipment_id" value="{{ $shipmentId }}">
        <input type="hidden" wire:model="user_id" name="user_id" value="{{ $userId }}">
        <input type="hidden" name="is_danger" value="No">

        <!-- Shipment Information Section -->
        <div
            class="bg-white rounded-lg shadow border border-gray-300 overflow-hidden">
            <div class="border-b border-gray-300 bg-blue-800 px-4 py-3">
                <h1 class="text-lg font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Shipment Information
                </h1>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-black">Stuffing Location</label>
                        <div class="flex rounded border">
                            <label class="relative flex-1">
                                <input type="radio" wire:model="stuffing" name="stuffing" value="Indoor"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-3 py-2 bg-white border border-gray-300 text-sm font-medium rounded-l peer-checked:bg-blue-800 peer-checked:border-blue-800 peer-checked:text-white cursor-pointer w-full">
                                    Indoor
                                </span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="stuffing" name="stuffing" value="Outdoor"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-3 py-2 bg-white border border-l-0 border-gray-300 text-sm font-medium rounded-r peer-checked:bg-blue-800 peer-checked:border-blue-800 peer-checked:text-white cursor-pointer w-full">
                                    Outdoor
                                </span>
                            </label>
                        </div>
                        @error('stuffing')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-black">Notes</label>
                        <div class="relative">
                            <input type="text"
                                class="w-full rounded border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm px-3 py-2"
                                wire:model="notes" placeholder="Add any additional notes">
                        </div>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-black">Container Ownership</label>
                        <div class="flex rounded border">
                            <label class="relative flex-1">
                                <input type="radio" wire:model="ownership_container" name="ownership_container"
                                    value="COC" class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-3 py-2 bg-white border border-gray-300 text-sm font-medium rounded-l peer-checked:bg-blue-800 peer-checked:border-blue-800 peer-checked:text-white cursor-pointer w-full">COC</span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="ownership_container" name="ownership_container"
                                    value="SOC" class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-3 py-2 bg-white border border-l-0 border-gray-300 text-sm font-medium rounded-r peer-checked:bg-blue-800 peer-checked:border-blue-800 peer-checked:text-white cursor-pointer w-full">SOC</span>
                            </label>
                        </div>
                        @error('ownership_container')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-black">Load Type</label>
                        <div class="flex rounded border">
                            <label class="relative flex-1">
                                <input type="radio" wire:model="load_type" name="load_type" value="Full"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-3 py-2 bg-white border border-gray-300 text-sm font-medium rounded-l peer-checked:bg-blue-800 peer-checked:border-blue-800 peer-checked:text-white cursor-pointer w-full">
                                    Full
                                </span>
                            </label>
                            <label class="relative flex-1">
                                <input type="radio" wire:model="load_type" name="load_type" value="Empty"
                                    class="peer sr-only">
                                <span
                                    class="flex items-center justify-center px-3 py-2 bg-white border border-l-0 border-gray-300 text-sm font-medium rounded-r peer-checked:bg-blue-800 peer-checked:border-blue-800 peer-checked:text-white cursor-pointer w-full">
                                    Empty
                                </span>
                            </label>
                        </div>
                        @error('load_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Container Details Section -->
        <div
            class="bg-white rounded-lg shadow border border-gray-300 overflow-hidden">
            <div class="border-b border-gray-300 bg-blue-800 px-4 py-3">
                <h1 class="text-lg font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Container Details
                </h1>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-black">Container Type</label>
                        <div class="relative">
                            <select wire:model="container_type" name="container_type"
                                class="appearance-none w-full rounded border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm px-3 py-2">
                                <option value="" selected>Select Type</option>
                                 <option value="20 GP">20 GP</option>
                                <option value="20 Iso Tank">20 Iso Tank</option>
                                <option value="20 Open Top">20 Open Top</option>
                                <option value="40 GP">40 GP</option>
                                <option value="40 Iso Tank">40 Iso Tank</option>
                                <option value="40 Open Top">40 Open Top</option>
                                <option value="40 High Cube">40 High Cube</option>
                                <option value="45 Open Top">45 Open Top</option>
                                <option value="45 High Cube">45 High Cube</option>
                            </select>
                        </div>
                        @error('container_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-black">Quantity</label>
                        <div class="relative">
                            <input type="number" wire:model="quantity" min="1"
                                class="w-full rounded border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm px-3 py-2"
                                placeholder="Enter quantity">
                        </div>
                        @error('quantity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-black">Commodity</label>
                        <div class="relative">
                            <input type="text" wire:model="commodity"
                                class="w-full rounded border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm uppercase px-3 py-2"
                                placeholder="Enter commodity" autofocus>
                        </div>
                        @error('commodity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-black">Weight (KG)</label>
                        <div class="relative">
                            <input type="number" wire:model="weight"
                                class="w-full rounded border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm pl-3 pr-12 py-2"
                                placeholder="Enter weight">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-600 text-sm font-medium">KG</span>
                            </div>
                        </div>
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Dangerous Goods Section -->
        <div
            class="bg-white rounded-lg shadow border border-gray-300 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 bg-red-100 rounded flex items-center justify-center">
                            <i class="fa-solid fa-skull-crossbones text-lg text-red-600"></i>
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" wire:model="is_danger" id="is_danger"
                                class="rounded border-gray-300 text-red-600 focus:ring-red-600 h-4 w-4"
                                value="Yes" @if ($is_danger === 'Yes') checked @endif>
                            <span class="text-sm font-medium text-black">This shipment contains dangerous
                                goods</span>
                        </label>
                        <p class="mt-1 text-sm text-gray-600 ml-6">Including explosives, flammable/toxic gases,
                            flammable
                            liquids, radioactive materials, toxic and infectious substances.</p>
                        @error('is_danger')
                            <p class="mt-1 text-sm text-red-600 ml-6">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" wire:loading.attr="disabled"
                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create New RO
                </span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Processing...
                </span>
            </button>
        </div>
    </form>
</div>
