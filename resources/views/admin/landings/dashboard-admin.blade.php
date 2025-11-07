@extends('layouts.main')
@section('title', 'Dashboard Admin')
@section('component')
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <!-- Header Section -->
            <div class="mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-black">Dashboard Admin</h1>
                        <p class="text-gray-600 text-sm">Monitor and manage your system overview</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Quick Status Indicator -->
                        <div class="bg-blue-800 text-white px-3 py-1 rounded text-sm font-medium">
                            System Active
                        </div>
                        @if($pendingUsersCount ?? App\Models\User::where('status', 'Under Verification')->count() > 0)
                            <div class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold">
                                {{ $pendingUsersCount ?? App\Models\User::where('status', 'Under Verification')->count() }} Pending
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <!-- Total Users Card -->
                <div class="bg-white rounded-lg border border-gray-300 hover:border-blue-800">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Users</p>
                                <p class="text-2xl font-bold text-black">{{ $totalUsers }}</p>
                                <p class="text-xs text-blue-800 font-medium mt-1">Active users</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-800 rounded flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Admins Card -->
                <div class="bg-white rounded-lg border border-gray-300 hover:border-blue-800">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Admins</p>
                                <p class="text-2xl font-bold text-black">{{ $totalAdmins }}</p>
                                <p class="text-xs text-blue-800 font-medium mt-1">System admins</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-800 rounded flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Ships Card -->
                <div class="bg-white rounded-lg border border-gray-300 hover:border-blue-800">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Available Ships</p>
                                <p class="text-2xl font-bold text-black">{{ $totalShipments }}</p>
                                <p class="text-xs text-blue-800 font-medium mt-1">Ready to sail</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-800 rounded flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stock Seals Card -->
                <div class="bg-white rounded-lg border border-gray-300 hover:border-blue-800">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Stock Seals</p>
                                <p class="text-2xl font-bold text-black">{{ $totalSeals }}</p>
                                <p class="text-xs text-blue-800 font-medium mt-1">In inventory</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-800 rounded flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Summary -->
            <div class="bg-gray-50 rounded-lg border border-gray-300 p-3 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Verified Users:</span>
                        <span class="font-bold text-black">{{ App\Models\User::where('status', 'Verified')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Pending Verification:</span>
                        <span class="font-bold text-blue-800">{{ App\Models\User::where('status', 'Under Verification')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Bills:</span>
                        <span class="font-bold text-black">{{ App\Models\Bill::count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">System Health:</span>
                        <span class="font-bold text-blue-800">Operational</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Bar -->
            <div class="bg-white rounded-lg border border-gray-300 p-3 mb-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-black">Quick Actions</h3>
                    <div class="flex items-center gap-2">
                        <button onclick="window.location.reload()" 
                            class="px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Refresh
                        </button>
                        <a href="{{ route('admin.bills.list') }}" wire:navigate
                            class="px-3 py-1 bg-blue-800 text-white rounded hover:bg-blue-900 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Manage Bills
                        </a>
                        @if($warnedUsersCount ?? App\Models\User::where('status', 'Warned')->count() > 0)
                            <a href="{{ route('dashboard-admin', ['status' => 'Warned']) }}" wire:navigate
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                Review Warned ({{ $warnedUsersCount ?? App\Models\User::where('status', 'Warned')->count() }})
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- User Management Section -->
            <div class="bg-white rounded-lg border border-gray-300 overflow-hidden">
                <!-- Header & Search -->
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-300">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-3">
                        <div>
                            <h2 class="text-lg font-bold text-black">User Management</h2>
                            <p class="text-gray-600 text-sm">Manage and monitor user accounts</p>
                        </div>
                    </div>

                    <!-- Status Filter Buttons & Search Form -->
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                        <!-- Status Filter Buttons -->
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.bills.list') }}" wire:navigate
                                class="inline-flex items-center px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-900">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Bills Management
                                <span class="ml-2 px-2 py-1 bg-white text-blue-800 text-xs font-bold rounded">
                                    {{ App\Models\Bill::where('status', 'Under Verification')->count() }}
                                </span>
                            </a>

                            <a href="{{ route('dashboard-admin', ['status' => 'Under Verification']) }}" wire:navigate
                                class="inline-flex items-center px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-900">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pending Users
                                <span class="ml-2 px-2 py-1 bg-white text-blue-800 text-xs font-bold rounded">
                                    {{ $pendingUsersCount ?? App\Models\User::where('status', 'Under Verification')->count() }}
                                </span>
                            </a>

                            <a href="{{ route('dashboard-admin', ['status' => 'Warned']) }}" wire:navigate
                                class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                Warned Users
                                <span class="ml-2 px-2 py-1 bg-white text-red-600 text-xs font-bold rounded">
                                    {{ $warnedUsersCount ?? App\Models\User::where('status', 'Warned')->count() }}
                                </span>
                            </a>
                        </div>

                        <!-- Search Form -->
                        <form action="{{ route('dashboard-admin') }}" method="GET" class="flex gap-2 lg:w-auto w-full">
                            <div class="flex-grow lg:w-64">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="search" placeholder="Search users"
                                        value="{{ request('search') }}"
                                        class="block w-full pl-9 pr-3 py-2 border border-gray-300 rounded bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-800 focus:border-blue-800">
                                </div>
                            </div>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-800 text-white font-medium rounded hover:bg-blue-900 focus:outline-none focus:ring-1 focus:ring-blue-800 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Search
                            </button>
                            @if (request('search'))
                                <a href="{{ route('dashboard-admin') }}" wire:navigate
                                    class="px-2 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 focus:outline-none">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6L6 18" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6 6L18 18" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Results Info -->
                <div class="px-4 py-2 bg-gray-100 border-b border-gray-300">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-1">
                        <span class="text-sm text-gray-700 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries
                        </span>
                        <span class="hidden sm:block text-sm text-gray-500">
                            Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                        </span>
                    </div>
                </div>

                <!-- Mobile View (Card Layout) -->
                <div class="block lg:hidden">
                    @forelse ($users as $user)
                        <div class="p-4 border-b border-gray-200 hover:bg-gray-50">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-800 rounded flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <button
                                            class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded cursor-pointer hover:bg-gray-200"
                                            onclick="navigator.clipboard.writeText('{{ $user->user_id }}').then(() => { this.innerText = 'Copied!'; setTimeout(() => { this.innerText = 'ID: {{ $user->user_id }}'; }, 1000); });"
                                            type="button">
                                            ID: {{ $user->user_id }}
                                        </button>
                                    </div>
                                </div>
                                <a href="{{ route('detail-user', $user->id) }}" wire:navigate
                                    class="inline-flex items-center text-sm text-blue-800 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-2 py-1 rounded">
                                    View Details
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Email</span>
                                        <p class="text-sm font-medium text-black">{{ $user->email }}</p>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Name</span>
                                        <p class="text-sm font-medium text-black">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Company</span>
                                        <p class="text-sm font-medium text-black">{{ $user->company_name }}</p>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Location</span>
                                        <p class="text-sm font-medium text-black">{{ $user->company_location }}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs text-gray-500">Status</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium w-fit
                            {{ $user->status == 'Under Verification'
                                ? 'bg-blue-100 text-blue-800'
                                : ($user->status == 'Warned'
                                    ? 'bg-red-100 text-red-600'
                                    : 'bg-gray-100 text-black') }}">
                                        {{ $user->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-gray-500 font-medium">No users found</p>
                            <p class="text-gray-400 text-sm">Try adjusting your search criteria</p>
                        </div>
                    @endforelse
                </div>

                <!-- Desktop View (Table) -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">User</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Contact</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Company</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Location</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $iteration = 0; @endphp
                            @forelse ($users as $user)
                                @php $iteration++; @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-black">{{ $user->name }}</div>
                                                <button
                                                    class="text-gray-500 text-xs cursor-pointer hover:text-gray-700"
                                                    onclick="navigator.clipboard.writeText('{{ $user->user_id }}').then(() => { this.innerText = 'Copied!'; setTimeout(() => { this.innerText = 'ID: {{ $user->user_id }}'; }, 1000); });"
                                                    type="button">
                                                    ID: {{ $user->user_id }}
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-black">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-black">{{ $user->company_name }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-black">{{ $user->company_location }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                                {{ $user->status == 'Under Verification'
                                    ? 'bg-blue-100 text-blue-800'
                                    : ($user->status == 'Warned'
                                        ? 'bg-red-100 text-red-600'
                                        : 'bg-gray-100 text-black') }}">
                                            {{ $user->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        @if ($user->id !== 1)
                                            <a href="{{ route('detail-user', $user->user_id) }}" wire:navigate
                                                class="inline-flex items-center text-blue-800 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-2 py-1 rounded">
                                                View Details
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-sm">Super Admin</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center">
                                        <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-gray-500 font-medium">No users found</p>
                                        <p class="text-gray-400 text-sm">Try adjusting your search criteria</p>
                                    </td>
                                </tr>
                            @endforelse

                            @if ($iteration == 0 && count($users) > 0)
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center">
                                        <p class="text-gray-500 font-medium">No active users found</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-300">
                    <div class="flex items-center justify-center">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
