<div>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        {{-- Header with Actions --}}
        <div class="bg-blue-800 rounded-lg shadow-sm mb-6">
            <div class="px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="text-white hover:text-blue-200 flex items-center font-medium">
                        <i class="fa-solid fa-arrow-left-long mr-2"></i>
                        <span>Back</span>
                    </a>
                    <div class="h-6 w-px bg-blue-600"></div>
                    <h1 class="text-xl font-bold text-white">Stock Management</h1>
                </div>
                <div class="text-white text-sm">
                    <i class="fas fa-boxes mr-1"></i>
                    Total: <span class="font-bold">{{ number_format($totalStock) }}</span>
                </div>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            {{-- Quick Add Stock --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-plus-circle text-blue-800 mr-2"></i>
                        Add Stock
                    </h3>
                    <form wire:submit.prevent="save" class="space-y-3">
                        <div>
                            <input type="number" wire:model="update_stock" placeholder="Quantity"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 text-sm"
                                min="1">
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white rounded font-medium text-sm">
                            <span wire:loading.remove class="flex items-center justify-center">
                                <i class="fas fa-plus mr-1"></i>
                                Add Stock
                            </span>
                            <span wire:loading>Adding...</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Stock Statistics --}}
            <div class="lg:col-span-2">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
                        <div class="text-2xl font-bold text-blue-800">{{ number_format($totalStock) }}</div>
                        <div class="text-sm text-gray-600">Current Stock</div>
                    </div>
                    <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
                        <div class="text-2xl font-bold text-gray-800">{{ count($stocks) }}</div>
                        <div class="text-sm text-gray-600">Total Records</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stock History --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-history text-blue-800 mr-2"></i>
                    Stock History
                </h3>
                <div class="text-sm text-gray-500">{{ count($stocks) }} records</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Added By</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($stocks as $stock)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $stock->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $stock->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $stock->user->name }}</div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">
                                        +{{ number_format($stock->stock) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right">
                                    <div class="flex justify-end space-x-2">
                                        <button wire:click="editModal({{ $stock->id }})"
                                            class="text-blue-800 hover:text-blue-900 text-sm font-medium">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $stock->id }})"
                                            class="text-red-600 hover:text-red-700 text-sm font-medium">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if (count($stocks) === 0)
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-inbox text-2xl mb-2"></i>
                                        <div class="text-sm">No stock records found</div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 {{ $isModalOpen ? 'flex' : 'hidden' }} items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
            <div class="bg-blue-800 rounded-t-lg px-6 py-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">Edit Stock</h3>
                    <button wire:click="closeModal" type="button" class="text-white hover:text-blue-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <form wire:submit.prevent="updateStock" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <input type="number" wire:model="editStock"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800">
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white rounded font-medium">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Custom Alert Modal --}}
    <div id="alertModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center" style="display: none;">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full mx-4" id="alertModalContent">
            <div class="p-6 text-center">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3" id="alertIcon">
                    <!-- Icon will be dynamically set -->
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2" id="alertTitle">Title</h3>
                <p class="text-gray-600 text-sm mb-4" id="alertText">Message</p>
                <button onclick="hideAlertModal()" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-900">
                    OK
                </button>
            </div>
        </div>
    </div>

    {{-- Custom Confirmation Modal --}}
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center" style="display: none;">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4" id="confirmationModalContent">
            {{-- Modal Header --}}
            <div class="bg-red-600 rounded-t-lg px-6 py-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 bg-red-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-exclamation text-white text-sm"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white" id="confirmationTitle">Confirm Delete</h3>
                </div>
            </div>
            
            {{-- Modal Body --}}
            <div class="p-6">
                <p class="text-gray-700 mb-4" id="confirmationText">Are you sure you want to delete this stock record?</p>
                <div class="bg-red-50 border-l-4 border-red-400 p-3 rounded">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-red-400 mt-1"></i>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button onclick="hideConfirmationModal()" 
                            class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button onclick="confirmAction()" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded flex items-center">
                        <i class="fas fa-trash mr-2"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentConfirmationId = null;
        
        function showAlertModal(title, text, type) {
            document.getElementById('alertTitle').textContent = title;
            document.getElementById('alertText').textContent = text;
            
            const iconContainer = document.getElementById('alertIcon');
            
            if (type === 'success') {
                iconContainer.className = 'w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3';
                iconContainer.innerHTML = '<i class="fas fa-check text-green-600"></i>';
            } else if (type === 'error') {
                iconContainer.className = 'w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3';
                iconContainer.innerHTML = '<i class="fas fa-times text-red-600"></i>';
            } else {
                iconContainer.className = 'w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3';
                iconContainer.innerHTML = '<i class="fas fa-info text-blue-800"></i>';
            }
            
            document.getElementById('alertModal').style.display = 'flex';
        }

        function hideAlertModal() {
            document.getElementById('alertModal').style.display = 'none';
        }

        function showConfirmationModal(title, text, id) {
            document.getElementById('confirmationTitle').textContent = title;
            document.getElementById('confirmationText').textContent = text;
            currentConfirmationId = id;
            
            document.getElementById('confirmationModal').style.display = 'flex';
        }

        function hideConfirmationModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function confirmAction() {
            if (currentConfirmationId) {
                Livewire.dispatch('delete', {
                    id: currentConfirmationId
                });
            }
            hideConfirmationModal();
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('showAlert', (event) => {
                showAlertModal(event[0].title, event[0].text, event[0].type);
            });

            Livewire.on('showConfirmation', (event) => {
                showConfirmationModal(event[0].title, event[0].text, event[0].id);
            });
        });
    </script>
</div>
