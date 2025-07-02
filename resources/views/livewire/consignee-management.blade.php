<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        @php
            $fromCities = [
                'surabaya',
                'pontianak',
                'semarang',
                'banjarmasin',
                'sampit',
                'jakarta',
                'kumai',
                'samarinda',
                'balikpapan',
                'berau',
                'palu',
                'bitung',
                'gorontalo',
                'ambon',
            ];
        @endphp
        <h2 class="text-2xl font-bold mb-6">Tambah Data Consignee</h2>

        <form wire:submit="store" class="space-y-6" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Industry -->
                <div>
                    <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                    <input type="text" wire:model="industry" id="industry"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('industry')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name Consignee -->
                <div>
                    <label for="name_consignee" class="block text-sm font-medium text-gray-700">Nama Consignee</label>
                    <input type="text" wire:model="name_consignee" id="name_consignee"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name_consignee')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" id="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label class="block text-gray-600 text-sm sm:text-base font-medium mb-2">Kota</label>
                    <select wire:model="city"
                        class="w-full px-3 py-2 sm:px-4 sm:py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2563EB] focus:border-[#2563EB]">
                        <option value="" selected>Select City</option>
                        @foreach ($fromCities as $city)
                            <option value="{{ $city }}">{{ strtoupper($city) }}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="number" wire:model="phone_number" id="phone_number"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('phone_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Address - Full Width -->
            <div>
                <label for="consignee_address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea wire:model="consignee_address" id="consignee_address" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('consignee_address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- File Upload Section -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Upload Dokumen</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- KTP Upload -->
                    <div>
                        <label for="ktp" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload KTP <span class="text-red-500">*</span>
                        </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-400 transition-colors">
                            <div class="space-y-1 text-center">
                                @if ($ktp)
                                    <div class="mb-3">
                                        <svg class="mx-auto h-8 w-8 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <p class="text-sm text-green-600 font-medium">
                                            {{ $ktp->getClientOriginalName() }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ number_format($ktp->getSize() / 1024, 2) }} KB</p>
                                    </div>
                                @else
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <label for="ktp"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                            <span>Upload file KTP</span>
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                                @endif
                                <input id="ktp" wire:model="ktp" type="file" class="sr-only"
                                    accept="image/*">
                            </div>
                        </div>
                        @error('ktp')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- NPWP Upload -->
                    <div>
                        <label for="npwp" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload NPWP <span class="text-red-500">*</span>
                        </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-indigo-400 transition-colors">
                            <div class="space-y-1 text-center">
                                @if ($npwp)
                                    <div class="mb-3">
                                        <svg class="mx-auto h-8 w-8 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <p class="text-sm text-green-600 font-medium">
                                            {{ $npwp->getClientOriginalName() }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ number_format($npwp->getSize() / 1024, 2) }} KB</p>
                                    </div>
                                @else
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <label for="npwp"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                            <span>Upload file NPWP</span>
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                                @endif
                                <input id="npwp" wire:model="npwp" type="file"
                                    class="sr-only" accept="image/*">
                            </div>
                        </div>
                        @error('npwp')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Upload Progress -->
            <div wire:loading wire:target="ktp,npwp"
                class="flex items-center justify-center space-x-2">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-indigo-600"></div>
                <span class="text-sm text-gray-600">Uploading file...</span>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="window.history.back()"
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kembali
                </button>
                <button type="submit" wire:loading.attr="disabled" wire:target="store"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="store">Simpan</span>
                    <span wire:loading wire:target="store" class="flex items-center">
                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="fixed bottom-4 right-4 z-50">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed bottom-4 right-4 z-50">
            <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
</div>

<script>
    // Auto hide flash messages after 5 seconds
    setTimeout(function() {
        const flashMessages = document.querySelectorAll('[class*="fixed bottom-4 right-4"]');
        flashMessages.forEach(function(message) {
            message.style.opacity = '0';
            message.style.transform = 'translateX(100%)';
            setTimeout(function() {
                message.remove();
            }, 300);
        });
    }, 5000);
</script>
