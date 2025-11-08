@extends('layouts.main')

@section('title', 'Bills Management - Admin')

@section('component')
<div class="container mx-auto px-4 py-6">
    {{-- Compact Header with Stats --}}
    <div class="bg-blue-800 rounded-lg mb-6">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Invoices Management</h1>
                    <p class="text-blue-200 text-sm mt-1">Admin Dashboard</p>
                </div>
                <div class="flex items-center space-x-4">
                    {{-- Quick Stats --}}
                    <div class="bg-blue-700 rounded px-3 py-2">
                        <div class="text-xs text-blue-200">Total Bills</div>
                        <div class="text-lg font-bold text-white">{{ $bills->total() ?? 0 }}</div>
                    </div>
                    <div class="bg-blue-700 rounded px-3 py-2">
                        <div class="text-xs text-blue-200">Under Verification</div>
                        <div class="text-lg font-bold text-white">
                            {{ $bills->where('status', 'Under Verification')->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Compact Flash Messages --}}
    @if(session('success'))
        <div class="mb-4 bg-blue-50 border-l-4 border-blue-800 p-3">
            <p class="text-sm font-medium text-blue-800">✓ {{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-50 border-l-4 border-red-600 p-3">
            <p class="text-sm font-medium text-red-700">✗ {{ session('error') }}</p>
        </div>
    @endif

    {{-- Enhanced Bills Grid --}}
    @if($bills && count($bills->items()) > 0)
        <div class="bg-white rounded-lg shadow-sm border">
            {{-- Table Header --}}
            <div class="bg-blue-800 px-4 py-3 rounded-t-lg">
                <h3 class="text-lg font-semibold text-white">Bills Overview</h3>
            </div>
            
            {{-- Responsive Bills Grid --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-xs text-gray-600 uppercase tracking-wider">
                            <th class="px-4 py-2 text-left">Bill ID</th>
                            <th class="px-4 py-2 text-left">Company</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-right">Total</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($bills as $bill)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-blue-800 text-sm">{{ $bill->bill_id ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ $bill->created_at ? $bill->created_at->format('d M Y') : 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ Str::limit($bill->user->company_name ?? 'N/A', 20) }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $bill->user->email ?? 'N/A' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($bill->status === 'Paid') bg-blue-100 text-blue-800
                                        @elseif($bill->status === 'Under Verification') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-700 @endif">
                                        {{ $bill->status ?? 'N/A' }}
                                    </span>
                                    @if($bill->upload_confirmation)
                                        <div class="text-xs text-blue-600 mt-1">📎 File attached</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="text-sm font-semibold text-gray-900">
                                        Rp {{ number_format($bill->grand_total ?? 0, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('detail-bill', $bill->bill_id) }}" 
                                           class="inline-flex items-center px-2 py-1 border border-blue-800 text-xs font-medium rounded text-blue-800 bg-white hover:bg-blue-50">
                                            View
                                        </a>
                                        @if($bill->status === 'Under Verification' && $bill->upload_confirmation)
                                            <button onclick="showConfirmModal('{{ $bill->bill_id }}', '{{ $bill->user->company_name ?? 'N/A' }}')"
                                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-blue-800 hover:bg-blue-700">
                                                Approve
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Compact Pagination --}}
        <div class="mt-4">
            {{ $bills->links() }}
        </div>
    @else
        {{-- Enhanced Empty State --}}
        <div class="bg-white rounded-lg shadow-sm border p-8 text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-blue-800 mb-2">No Bills Available</h3>
            <p class="text-gray-600 text-sm">No bills have been created in the system yet.</p>
            <div class="mt-4 p-3 bg-blue-50 rounded text-sm text-blue-700">
                💡 Bills will appear here once users create shipment orders
            </div>
        </div>
    @endif
</div>

{{-- Custom Confirmation Modal --}}
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0 max-w-md w-full mx-4" id="modalContent">
        {{-- Modal Header --}}
        <div class="bg-blue-800 rounded-t-xl px-6 py-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white">Confirm Payment Approval</h3>
            </div>
        </div>
        
        {{-- Modal Body --}}
        <div class="px-6 py-6">
            <div class="mb-4">
                <p class="text-gray-700 mb-2">Are you sure you want to approve this payment?</p>
                <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-800">
                    <div class="text-sm">
                        <div class="font-medium text-blue-800">Bill ID: <span id="modalBillId"></span></div>
                        <div class="text-blue-700 mt-1">Company: <span id="modalCompanyName"></span></div>
                    </div>
                </div>
            </div>
            
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-4 w-4 text-yellow-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">This action cannot be undone. The bill status will be marked as "Paid".</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Modal Footer --}}
        <div class="px-6 py-4 bg-gray-50 rounded-b-xl">
            <div class="flex items-center justify-end space-x-3">
                <button onclick="hideConfirmModal()" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors duration-200">
                    Cancel
                </button>
                <button onclick="confirmApproval()" 
                        class="px-4 py-2 bg-blue-800 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Approve Payment
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Hidden Forms for Each Bill --}}
@foreach($bills as $bill)
    @if($bill->status === 'Under Verification' && $bill->upload_confirmation)
        <form id="approveForm_{{ $bill->bill_id }}" action="{{ route('admin.bills.mark-paid', $bill->bill_id) }}" method="POST" class="hidden">
            @csrf
        </form>
    @endif
@endforeach

{{-- Success Modal --}}
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-95 opacity-0 max-w-sm w-full mx-4" id="successModalContent">
        <div class="px-6 py-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Payment Approved!</h3>
            <p class="text-gray-600 text-sm">The bill has been successfully marked as paid.</p>
        </div>
    </div>
</div>

<script>
let currentBillId = '';

function showConfirmModal(billId, companyName) {
    currentBillId = billId;
    document.getElementById('modalBillId').textContent = billId;
    document.getElementById('modalCompanyName').textContent = companyName;
    
    const modal = document.getElementById('confirmModal');
    const content = document.getElementById('modalContent');
    
    modal.classList.remove('hidden');
    
    // Animate modal appearance
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 50);
}

function hideConfirmModal() {
    const modal = document.getElementById('confirmModal');
    const content = document.getElementById('modalContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function confirmApproval() {
    if (currentBillId) {
        // Show loading state
        const confirmButton = event.target;
        const originalText = confirmButton.innerHTML;
        confirmButton.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...';
        confirmButton.disabled = true;
        
        // Submit the form
        document.getElementById('approveForm_' + currentBillId).submit();
    }
}

// Close modal when clicking outside
document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideConfirmModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideConfirmModal();
    }
});
</script>

{{-- Add some custom styles for better mobile responsiveness --}}
<style>
    @media (max-width: 640px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        table {
            font-size: 0.75rem;
        }
        
        .stats-mobile {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        #modalContent {
            margin: 1rem;
        }
    }
    
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
@endsection
