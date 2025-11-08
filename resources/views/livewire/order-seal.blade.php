<div>
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

{{-- Custom Confirmation Modal --}}
<div id="purchaseModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 items-center justify-center" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0 max-w-md w-full mx-4" id="purchaseModalContent">
        {{-- Modal Header --}}
        <div class="bg-blue-800 rounded-t-xl px-6 py-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white">Confirm Purchase</h3>
            </div>
        </div>
        
        {{-- Modal Body --}}
        <div class="px-6 py-6">
            <p class="text-gray-700 mb-4">Are you sure you want to order these seals?</p>
            <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-800">
                <div class="text-sm">
                    <div class="font-medium text-blue-800">Order Details:</div>
                    <div class="text-blue-700 mt-1" id="orderQuantity"></div>
                    <div class="text-blue-700" id="orderTotal"></div>
                </div>
            </div>
        </div>
        
        {{-- Modal Footer --}}
        <div class="px-6 py-4 bg-gray-50 rounded-b-xl">
            <div class="flex items-center justify-end space-x-3">
                <button onclick="hidePurchaseModal()" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors duration-200">
                    Cancel
                </button>
                <button onclick="confirmPurchaseOrder()" 
                        class="px-4 py-2 bg-blue-800 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Yes, Order!
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Success Modal --}}
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 items-center justify-center" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0 max-w-sm w-full mx-4" id="successModalContent">
        <div class="px-6 py-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Success!</h3>
            <p class="text-gray-600 text-sm">Your seal purchase has been processed successfully.</p>
            <button onclick="hideSuccessModal()" class="mt-4 px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Continue
            </button>
        </div>
    </div>
</div>

{{-- Error Modal --}}
<div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 items-center justify-center" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0 max-w-sm w-full mx-4" id="errorModalContent">
        <div class="px-6 py-6 text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Error!</h3>
            <p class="text-gray-600 text-sm" id="errorMessage"></p>
            <button onclick="hideErrorModal()" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                Try Again
            </button>
        </div>
    </div>
</div>

    <!-- JavaScript -->
    <script>
    function confirmPurchase() {
        const quantity = document.querySelector('input[type="number"]').value || 1;
        const total = formatPrice(basePrice * quantity);
        
        document.getElementById('orderQuantity').textContent = `Quantity: ${quantity} seals`;
        document.getElementById('orderTotal').textContent = `Total: ${total}`;
        
        showPurchaseModal();
    }
    
    function showPurchaseModal() {
        const modal = document.getElementById('purchaseModal');
        const content = document.getElementById('purchaseModalContent');
        
        modal.style.display = 'flex';
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function hidePurchaseModal() {
        const modal = document.getElementById('purchaseModal');
        const content = document.getElementById('purchaseModalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    function confirmPurchaseOrder() {
        const confirmButton = event.target;
        const originalText = confirmButton.innerHTML;
        confirmButton.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...';
        confirmButton.disabled = true;
        
        @this.createSeal();
    }
    
    function showSuccessModal() {
        const modal = document.getElementById('successModal');
        const content = document.getElementById('successModalContent');
        
        modal.style.display = 'flex';
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function hideSuccessModal() {
        const modal = document.getElementById('successModal');
        const content = document.getElementById('successModalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }
    
    function showErrorModal(message) {
        document.getElementById('errorMessage').textContent = message;
        
        const modal = document.getElementById('errorModal');
        const content = document.getElementById('errorModalContent');
        
        modal.style.display = 'flex';
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function hideErrorModal() {
        const modal = document.getElementById('errorModal');
        const content = document.getElementById('errorModalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    Livewire.on('purchaseSuccess', () => {
        hidePurchaseModal();
        showSuccessModal();
    });

    Livewire.on('purchaseError', (message) => {
        hidePurchaseModal();
        showErrorModal(message);
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

<style>
    /* Custom animations */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
    
    /* Loading animation */
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    </style>
</div>
