<div class="container mx-auto px-4 py-6 md:py-12 max-w-3xl">
    <div class="space-y-3 mb-4">
        @if (session('success'))
            <div class="flex items-center justify-between bg-green-50 border-l-4 border-green-500 px-4 py-3 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-3"></i>
                    <span class="text-green-800 font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="flex items-center justify-between bg-red-50 border-l-4 border-red-600 px-4 py-3 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                    <span class="text-red-800 font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <div class="bg-blue-800 px-4 py-3 border-b border-gray-200 flex items-center justify-between">
            <a href="{{ route('seal') }}" wire:navigate
                class="text-white hover:text-blue-100 flex items-center space-x-2">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span class="text-sm font-medium">Back</span>
            </a>
            <h2 class="text-lg font-bold text-white">Purchase Seal</h2>
            @if (auth()->user()->is_admin == true)
                <a href="{{ route('add-stock') }}" wire:navigate
                    class="px-3 py-1.5 rounded text-sm font-medium bg-white text-blue-800 hover:bg-blue-50">
                    Add Stock
                </a>
            @else
                <div></div>
            @endif
        </div>

        <form wire:submit.prevent="createSeal" class="p-4 space-y-4">
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Point</label>
                    <select wire:model="pickup_point"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800
                        {{ $availableStock == 0 ? 'cursor-not-allowed opacity-50' : '' }}"
                        {{ $availableStock == 0 ? 'disabled' : '' }}>
                        @php
                            $fromCities = [
                                'Surabaya', 'Pontianak', 'Semarang', 'Banjarmasin', 'Sampit', 'Jakarta',
                                'Kumai', 'Samarinda', 'Balikpapan', 'Berau', 'Palu', 'Bitung',
                                'Gorontalo', 'Ambon', 'Makassar', 'Morowali', 'Kendari', 'Pomala',
                                'Ternate', 'Jayapura', 'Kupang', 'Sorong', 'Manokwari', 'Merauke',
                                'Bau-Bau', 'Maumere', 'Tual', 'Fak-Fak', 'Bintuni', 'Nabire', 'Serui'
                            ];
                        @endphp
                        <option value="" disabled selected>Select Pickup Point</option>
                        @foreach ($fromCities as $city)
                            <option value="{{ $city }}" {{ request('pickup_point') == $city ? 'selected' : '' }}>
                                {{ strtoupper($city) }}
                            </option>
                        @endforeach
                    </select>
                    @error('pickup_point')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Quantity <span class="text-blue-800 font-medium">(Available: {{ $availableStock }})</span>
                    </label>
                    <input type="number" wire:model="quantity" id="quantity-input"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800
                        {{ $availableStock == 0 ? 'cursor-not-allowed opacity-50' : '' }}"
                        min="1" max="{{ $availableStock }}" {{ $availableStock == 0 ? 'disabled' : '' }}
                        onchange="updateTotalPrice(this.value)" oninput="updateTotalPrice(this.value)">
                    @error('quantity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @if ($quantity > $availableStock)
                        <p class="mt-1 text-sm text-red-600">Quantity cannot exceed available stock ({{ $availableStock }})</p>
                    @endif
                </div>
            </div>

            <!-- Price Details -->
            <div class="bg-blue-50 rounded border border-blue-200 p-4 space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-medium">Price per Unit:</span>
                    <span class="text-lg font-bold text-blue-800" id="price-per-unit">Rp. {{ number_format($price, 0, ',', '.') }}</span>
                </div>
                <hr class="border-blue-200">
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-medium">Total Price:</span>
                    <span class="text-xl font-bold text-blue-800" id="total-price">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Submit Button or Stock Unavailable Message -->
            @if ($availableStock == 0)
                <div class="bg-red-50 border-l-4 border-red-600 px-4 py-3 rounded flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                    <span class="text-red-800 font-medium">Stock is currently unavailable</span>
                </div>
            @else
                <button type="button" {{ $quantity > $availableStock ? 'disabled' : '' }} onclick="confirmPurchase()"
                    class="w-full px-6 py-3 {{ $quantity > $availableStock ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-800 hover:bg-blue-900' }} 
                    text-white rounded font-medium focus:outline-none focus:ring-2 focus:ring-blue-800 flex items-center justify-center">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Purchase Seal
                </button>
            @endif
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
    function confirmPurchase() {
        Swal.fire({
            title: 'Confirm Purchase',
            text: 'Are you sure you want to order these seals?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e40af',
            cancelButtonColor: '#dc2626',
            confirmButtonText: 'Yes, order!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.createSeal();
            }
        });
    }

    Livewire.on('purchaseSuccess', () => {
        Swal.fire({
            title: 'Success!',
            text: 'Your seal purchase has been processed successfully.',
            icon: 'success',
            confirmButtonColor: '#1e40af'
        });
    });

    Livewire.on('purchaseError', (message) => {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error',
            confirmButtonColor: '#dc2626'
        });
    });
</script>
<script>
    // Get the base price from PHP
    const basePrice = {{ $price }};
    const availableStock = {{ $availableStock }};

    function formatPrice(price) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(price).replace('IDR', 'Rp.');
    }

    function updateTotalPrice(quantity) {
        // Validate quantity
        quantity = parseInt(quantity) || 0;
        if (quantity < 1) quantity = 1;
        if (quantity > availableStock) quantity = availableStock;

        // Calculate total price
        const totalPrice = quantity * basePrice;

        // Update the display
        document.getElementById('total-price').textContent = formatPrice(totalPrice);

        // Update Livewire component's quantity
        Livewire.dispatch('quantity-updated', {
            quantity: quantity
        });
    }

    // Initialize total price on page load
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity-input');
        updateTotalPrice(quantityInput.value || 1);
    });

    // Listen for direct input changes
    document.getElementById('quantity-input').addEventListener('input', function(e) {
        updateTotalPrice(e.target.value);
    });
</script>
