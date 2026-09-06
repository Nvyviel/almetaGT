@extends('layouts.main')

@section('title', 'Consignee')
@section('component')
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-800 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Consignees Management</h1>
                            <p class="text-sm text-gray-600">Manage your consignee information</p>
                        </div>
                    </div>
                    <div class="mt-3 sm:mt-0 flex items-center space-x-2">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ $consignees->total() }} Total</p>
                            <p class="text-xs text-gray-500">Consignees</p>
                        </div>
                        <a href="{{ route('create-consignee') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                            <i class="fas fa-plus mr-2"></i>
                            Add New
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error') || request()->boolean('needs_consignee'))
                <div class="mb-6 overflow-hidden rounded-xl border border-red-200 bg-gradient-to-r from-red-50 to-white shadow-sm">
                    <div class="flex flex-col gap-4 p-4 sm:flex-row sm:items-center sm:justify-between sm:p-5">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div>
                                <h2 class="text-sm font-bold text-red-900">Consignee diperlukan</h2>
                                <p class="mt-1 max-w-2xl text-sm leading-relaxed text-red-800">
                                    {{ session('error') ?? 'Anda belum memiliki Consignee. Buat minimal satu Consignee sebelum mengajukan Shipping Instruction.' }}
                                    Data consignee akan digunakan untuk melengkapi Shipping Instruction Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Consignees Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @forelse($consignees as $consignee)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md">
                        <div class="p-4">
                            <!-- Header -->
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-md font-semibold text-gray-900 truncate">
                                        {{ $consignee->name_consignee }}
                                    </h3>
                                    <span
                                        class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded mt-1">
                                        {{ $consignee->industry }}
                                    </span>
                                </div>
                                <div class="flex ml-2">
                                    <a href="{{ route('consignee-edit', $consignee->id) }}" wire:navigate
                                        class="p-1 text-gray-400 hover:text-blue-800 hover:bg-blue-50 rounded">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('consignee-destroy', $consignee->id) }}" method="POST"
                                        class="inline ml-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this consignee?')"
                                            class="p-1 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="space-y-2">
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-envelope w-4 text-gray-400 mr-2"></i>
                                    <span class="text-gray-600 truncate">{{ $consignee->email }}</span>
                                </div>

                                <div class="flex items-center text-sm">
                                    <i class="fas fa-phone w-4 text-gray-400 mr-2"></i>
                                    <span class="text-gray-600">{{ $consignee->phone_number }}</span>
                                </div>

                                <div class="flex items-center text-sm">
                                    <i class="fas fa-map-marker-alt w-4 text-gray-400 mr-2"></i>
                                    <span class="text-gray-600 capitalize">{{ $consignee->city }}</span>
                                </div>
                            </div>

                            <!-- Address -->
                            @if ($consignee->consignee_address)
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-xs text-gray-500 font-medium mb-1">Address</p>
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $consignee->consignee_address }}</p>
                                </div>
                            @endif

                            <!-- Quick Actions -->
                            <div class="mt-3 pt-3 border-t border-gray-100">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500">Quick Actions</span>
                                    <div class="flex space-x-1">
                                        <a href="mailto:{{ $consignee->email }}"
                                            class="quick-action-link px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs rounded">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $consignee->phone_number) }}?text=Hello%20{{ urlencode($consignee->name_consignee) }},%20"
                                            target="_blank"
                                            class="quick-action-link px-2 py-1 bg-green-100 hover:bg-green-200 text-green-800 text-xs rounded">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                            <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-users text-2xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Consignees Found</h3>
                            <p class="text-sm text-gray-500 mb-6">Get started by adding your first consignee to manage
                                shipping information.</p>
                            <a href="{{ route('create-consignee') }}" wire:navigate
                                class="inline-flex items-center px-6 py-3 bg-blue-800 hover:bg-blue-900 text-white font-medium rounded-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Create First Consignee
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($consignees->hasPages())
                <div class="mt-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                        {{ $consignees->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Custom Styles -->
    <style>
        /* Remove excessive animations */
        .hover\:shadow-md:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.15s ease-in-out;
        }

        /* Line clamp for text truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Custom focus styles */
        input:focus,
        select:focus {
            outline: none;
        }

        /* Simple hover effects */
        .hover\:bg-blue-50:hover {
            background-color: #eff6ff;
        }

        .hover\:bg-red-50:hover {
            background-color: #fef2f2;
        }

        .hover\:bg-gray-200:hover {
            background-color: #e5e7eb;
        }

        .hover\:bg-blue-200:hover {
            background-color: #dbeafe;
        }

        .hover\:bg-green-200:hover {
            background-color: #dcfce7;
        }

        /* WhatsApp and Email link styles */
        .quick-action-link {
            transition: transform 0.15s ease-in-out;
        }

        .quick-action-link:hover {
            transform: scale(1.05);
        }


    </style>

    <script>
        // Auto-hide success messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('.bg-green-50');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.transform = 'translateY(-100%)';
                    successMessage.style.opacity = '0';
                    setTimeout(() => successMessage.remove(), 300);
                }, 5000);
            }
        });
    </script>
@endsection
