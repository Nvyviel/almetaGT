@extends('layouts.main')
@section('title', 'Dashboard Admin')
@section('component')
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
                        <p class="text-gray-600 mt-1">Monitor and manage your system overview</p>
                    </div>
                    <div>
                        {{-- free space (required) --}}
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Users Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-blue-300 transition-all duration-300">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Total Users</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                                <p class="text-xs text-blue-600 font-medium mt-2">↗ Active users</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Admins Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-amber-300 transition-all duration-300">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-amber-500 to-amber-600 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Total Admins</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalAdmins }}</p>
                                <p class="text-xs text-amber-600 font-medium mt-2">→ System admins</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Ships Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-green-300 transition-all duration-300">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Available Ships</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalShipments }}</p>
                                <p class="text-xs text-green-600 font-medium mt-2">↗ Ready to sail</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stock Seals Card -->
                <div
                    class="group relative bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-purple-300 transition-all duration-300">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    </div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Stock Seals</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalSeals }}</p>
                                <p class="text-xs text-purple-600 font-medium mt-2">→ In inventory</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Management Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <!-- Header & Search -->
                <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-6 border-b border-gray-200">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">User Management</h2>
                            <p class="text-gray-600 mt-1">Manage and monitor user accounts</p>
                        </div>
                    </div>

                    <!-- Status Filter Buttons & Search Form -->
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <!-- Status Filter Buttons -->
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('admin.bills.list') }}" wire:navigate
                                class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Bills Management
                                <span class="ml-2 px-2.5 py-1 bg-white bg-opacity-30 text-xs font-bold rounded-md">
                                    {{ App\Models\Bill::where('status', 'Under Verification')->count() }}
                                </span>
                            </a>

                            <a href="{{ route('dashboard-admin', ['status' => 'Under Verification']) }}" wire:navigate
                                class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pending Users
                                <span class="ml-2 px-2.5 py-1 bg-white bg-opacity-30 text-xs font-bold rounded-md">
                                    {{ $pendingUsersCount ?? App\Models\User::where('status', 'Under Verification')->count() }}
                                </span>
                            </a>

                            <a href="{{ route('dashboard-admin', ['status' => 'Warned']) }}" wire:navigate
                                class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                Warned Users
                                <span class="ml-2 px-2.5 py-1 bg-white bg-opacity-30 text-xs font-bold rounded-md">
                                    {{ $warnedUsersCount ?? App\Models\User::where('status', 'Warned')->count() }}
                                </span>
                            </a>
                        </div>

                        <!-- Search Form -->
                        <form action="{{ route('dashboard-admin') }}" method="GET" class="flex gap-3 lg:w-auto w-full">
                            <div class="flex-grow lg:w-80">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="search" placeholder="Search users"
                                        value="{{ request('search') }}"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                </div>
                            </div>
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Search
                            </button>
                            @if (request('search'))
                                <a href="{{ route('dashboard-admin') }}" wire:navigate
                                    class="px-3 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
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
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                        <span class="text-sm text-gray-700 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of
                            {{ $users->total() }} entries
                        </span>
                        <span class="hidden sm:block text-sm text-gray-500">
                            Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                        </span>
                    </div>
                </div>

                <!-- Mobile View (Card Layout) -->
                <div class="block lg:hidden">
                    @forelse ($users as $user)
                        <div class="p-6 border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <span
                                            class="text-white font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <button
                                            class="bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1 rounded-md cursor-pointer hover:bg-gray-200 transition-colors duration-200"
                                            onclick="navigator.clipboard.writeText('{{ $user->user_id }}').then(() => { this.innerText = 'Copied!'; setTimeout(() => { this.innerText = 'ID: {{ $user->user_id }}'; }, 1000); });"
                                            type="button">
                                            ID: {{ $user->user_id }}
                                        </button>
                                    </div>
                                </div>
                                <a href="{{ route('detail-user', $user->id) }}" wire:navigate
                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-md transition duration-200">
                                    View Details
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                            <div class="grid grid-cols-1 gap-3">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500 font-medium mb-1">Email</span>
                                    <span class="text-sm font-medium text-gray-800">{{ $user->email }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500 font-medium mb-1">Name</span>
                                    <span class="text-sm font-medium text-gray-800">{{ $user->name }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-medium mb-1">Company</span>
                                        <span class="text-sm font-medium text-gray-800">{{ $user->company_name }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-medium mb-1">Location</span>
                                        <span
                                            class="text-sm font-medium text-gray-800">{{ $user->company_location }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500 font-medium mb-1">Status</span>
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium w-fit
                            {{ $user->status == 'Under Verification'
                                ? 'bg-yellow-100 text-yellow-800'
                                : ($user->status == 'Warned'
                                    ? 'bg-red-100 text-red-800'
                                    : 'bg-green-100 text-green-800') }}">
                                        {{ $user->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-gray-500 font-medium">No users found</p>
                            <p class="text-gray-400 text-sm mt-1">Try adjusting your search criteria</p>
                        </div>
                    @endforelse
                </div>

                <!-- Desktop View (Table) -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    User</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Contact</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Company</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Location</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $iteration = 0; @endphp
                            @forelse ($users as $user)
                                @php $iteration++; @endphp
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <button
                                            class="text-gray-500 text-xs font-medium cursor-pointer"
                                            onclick="navigator.clipboard.writeText('{{ $user->user_id }}').then(() => { this.innerText = 'Copied!'; setTimeout(() => { this.innerText = 'ID: {{ $user->user_id }}'; }, 1000); });"
                                            type="button">
                                            ID: {{ $user->user_id }}
                                        </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->company_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->company_location }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium
                                {{ $user->status == 'Under Verification'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : ($user->status == 'Warned'
                                        ? 'bg-red-100 text-red-800'
                                        : 'bg-green-100 text-green-800') }}">
                                            {{ $user->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if ($user->id !== 1)
                                            <a href="{{ route('detail-user', $user->user_id) }}" wire:navigate
                                                class="inline-flex items-center text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-md transition duration-200">
                                                View Details
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
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
                                    <td colspan="6" class="px-6 py-8 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-gray-500 font-medium">No users found</p>
                                        <p class="text-gray-400 text-sm mt-1">Try adjusting your search criteria</p>
                                    </td>
                                </tr>
                            @endforelse

                            @if ($iteration == 0 && count($users) > 0)
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center">
                                        <p class="text-gray-500 font-medium">No active users found</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-center">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
