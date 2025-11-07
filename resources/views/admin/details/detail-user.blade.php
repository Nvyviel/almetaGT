@extends('layouts.fullscreen')
@section('title', 'User Detail')
@section('component')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-5xl mx-auto bg-white rounded shadow border border-gray-200">
            {{-- Header Section --}}
            <div class="bg-blue-800 px-6 py-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <a href="{{ route('dashboard-admin') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-white text-blue-800 rounded font-medium hover:bg-gray-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Dashboard
                    </a>
                    <h1 class="text-2xl font-semibold text-white mb-2 md:mb-0 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        User Detail
                    </h1>
                </div>
            </div>

            {{-- User Status Badges --}}
            <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
                <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                    <span class="px-3 py-1 rounded text-sm font-medium bg-blue-800 text-white">
                        {{ $user->is_admin ? 'Administrator' : 'Standard User' }}
                    </span>
                    <span class="px-3 py-1 rounded text-sm font-medium
                        {{ $user->status == 'Approved' ? 'bg-green-100 text-green-800' : 
                           ($user->status == 'Warned' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-800') }}">
                        {{ $user->status }}
                    </span>
                </div>
            </div>

            {{-- Admin Actions Section --}}
            @if (auth()->user()->is_admin && $user->id != 1)
                <div class="px-6 py-3 bg-white border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800 mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-800" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Admin Actions
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        {{-- Admin Status Toggle Button --}}
                        @if (auth()->user()->id == 1 && $user->status == 'Approved')
                            <form id="adminStatusForm" action="{{ route('isadmin', $user->id) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="button"
                                    onclick="confirmAdminStatusChange('{{ $user->name }}', {{ $user->is_admin }})"
                                    class="inline-flex items-center px-3 py-1 rounded text-sm font-medium
                                    {{ $user->is_admin ? 'bg-gray-600 text-white hover:bg-gray-700' : 'bg-blue-800 text-white hover:bg-blue-900' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $user->is_admin
                                                ? 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'
                                                : 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' }}" />
                                    </svg>
                                    {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                </button>
                            </form>
                        @elseif (auth()->user()->id == 1 && $user->status != 'Approved')
                            <div class="inline-flex items-center px-3 py-1 rounded text-sm font-medium bg-gray-100 text-gray-500 border cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Admin Actions (Requires Approval)
                            </div>
                        @endif

                        {{-- Approve Button - Only show if user is not Approved --}}
                        @if ($user->status != 'Approved')
                            <form action="{{ route('update-status', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Approved">
                                <button type="button"
                                    onclick="confirmStatusChange(this.form, 'Approved', '{{ $user->name }}')"
                                    class="inline-flex items-center px-3 py-1 rounded text-sm font-medium bg-green-600 text-white hover:bg-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Approve
                                </button>
                            </form>
                        @endif

                        {{-- Under Verification Button - Show if user is Warned --}}
                        @if ($user->status == 'Warned')
                            <form action="{{ route('update-status', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Under Verification">
                                <button type="button"
                                    onclick="confirmStatusChange(this.form, 'Under Verification', '{{ $user->name }}')"
                                    class="inline-flex items-center px-3 py-1 rounded text-sm font-medium bg-yellow-600 text-white hover:bg-yellow-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Under Verification
                                </button>
                            </form>
                        @endif

                        {{-- Warn Button - Show if user is Under Verification --}}
                        @if ($user->status == 'Under Verification')
                            <form action="{{ route('update-status', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Warned">
                                <button type="button"
                                    onclick="confirmStatusChange(this.form, 'Warned', '{{ $user->name }}')"
                                    class="inline-flex items-center px-3 py-1 rounded text-sm font-medium bg-red-600 text-white hover:bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Warn
                                </button>
                            </form>
                        @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Content --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                {{-- Account Information --}}
                <div class="bg-white border border-gray-200 rounded shadow-sm">
                    <div class="bg-blue-800 px-4 py-3 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Account Information
                        </h2>
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="flex flex-col p-3 bg-gray-50 rounded border-l-4 border-blue-800">
                            <span class="text-xs font-medium text-gray-600 mb-1">Email Address</span>
                            <span class="text-sm font-medium text-gray-900">{{ $user->email }}</span>
                        </div>
                        <div class="flex flex-col p-3 bg-gray-50 rounded border-l-4 border-blue-800">
                            <span class="text-xs font-medium text-gray-600 mb-1">Full Name</span>
                            <span class="text-sm font-medium text-gray-900">{{ $user->name }}</span>
                        </div>
                        <div class="flex flex-col p-3 bg-gray-50 rounded border-l-4 border-blue-800">
                            <span class="text-xs font-medium text-gray-600 mb-1">Account Type</span>
                            <span class="inline-flex items-center px-2 py-1 rounded text-sm font-medium w-fit mt-1 bg-blue-800 text-white">
                                {{ $user->is_admin ? 'Administrator' : 'Standard User' }}
                            </span>
                        </div>
                        <div class="flex flex-col p-3 rounded border-l-4 
                            {{ $user->status == 'Approved' ? 'bg-green-50 border-green-500' : 
                               ($user->status == 'Warned' ? 'bg-red-50 border-red-600' : 'bg-gray-50 border-gray-400') }}">
                            <span class="text-xs font-medium text-gray-600 mb-1">Account Status</span>
                            <span class="text-sm font-medium 
                                {{ $user->status == 'Approved' ? 'text-green-700' : 
                                   ($user->status == 'Warned' ? 'text-red-700' : 'text-gray-700') }}">
                                {{ $user->status }}
                            </span>
                            <span class="text-xs mt-1 text-gray-500">
                                Last updated: {{ $user->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Company Information --}}
                <div class="bg-white border border-gray-200 rounded shadow-sm">
                    <div class="bg-blue-800 px-4 py-3 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Company Information
                        </h2>
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="flex flex-col p-3 bg-gray-50 rounded border-l-4 border-blue-800">
                            <span class="text-xs font-medium text-gray-600 mb-1">Company Name</span>
                            <span class="text-sm font-medium text-gray-900">{{ $user->company_name }}</span>
                        </div>
                        <div class="flex flex-col p-3 bg-gray-50 rounded border-l-4 border-blue-800">
                            <span class="text-xs font-medium text-gray-600 mb-1">Phone Number</span>
                            <span class="text-sm font-medium text-gray-900">+62 {{ $user->company_phone_number }}</span>
                        </div>
                        <div class="flex flex-col p-3 bg-gray-50 rounded border-l-4 border-blue-800">
                            <span class="text-xs font-medium text-gray-600 mb-1">Company Location</span>
                            <span class="text-sm font-medium text-gray-900">{{ $user->company_location }}</span>
                        </div>
                        <div class="flex flex-col p-3 bg-gray-50 rounded border-l-4 border-blue-800">
                            <span class="text-xs font-medium text-gray-600 mb-1">Company Address</span>
                            <span class="text-sm font-medium text-gray-900">{{ $user->company_address }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Statistics --}}
            <div class="bg-white border-t border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="bg-blue-800 text-white p-2 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </span>
                        Account Overview
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        {{-- Documents Status --}}
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                            @php
                                $docCount = 0;
                                if($user->ktp) $docCount++;
                                if($user->npwp) $docCount++;
                                if($user->nib) $docCount++;
                            @endphp
                            <div class="text-2xl font-bold text-green-800 mb-1">{{ $docCount }}/3</div>
                            <div class="text-sm text-green-600">Dokumen</div>
                        </div>
                        
                        {{-- Status Color --}}
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold mb-1 {{ $user->status == 'Approved' ? 'text-green-600' : ($user->status == 'Warned' ? 'text-red-600' : 'text-yellow-600') }}">
                                {{ ucfirst($user->status) }}
                            </div>
                            <div class="text-sm text-gray-600">Status Akun</div>
                        </div>
                        
                        {{-- Last Update --}}
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-purple-800 mb-1">
                                {{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans(null, true) }}
                            </div>
                            <div class="text-sm text-purple-600">Terakhir Update</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Documents Section --}}
            <div class="bg-gray-50 border-t border-gray-200">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="bg-blue-800 text-white p-2 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </span>
                        Required Documents
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach (['ktp' => 'KTP', 'npwp' => 'NPWP', 'nib' => 'NIB'] as $doc => $label)
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-blue-800 p-2 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                            </svg>
                                        </div>
                                        <h3 class="font-semibold text-gray-800">{{ $label }}</h3>
                                    </div>
                                    @if($user->$doc)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                            Belum Ada
                                        </span>
                                    @endif
                                </div>
                                @if($user->$doc)
                                    <button
                                        onclick="openModal('{{ asset('storage/' . $user->$doc) }}', '{{ $label }}')"
                                        class="w-full bg-blue-800 text-white py-2 px-4 rounded text-sm hover:bg-blue-900 transition-colors flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                @else
                                    <div class="text-center py-2 text-gray-500 text-sm">
                                        Dokumen belum diupload
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Timeline --}}
        @if ($user->id != 1)
            <div class="mt-6 bg-white border border-gray-200 rounded-lg p-6 max-w-5xl mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="bg-blue-800 text-white p-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        Riwayat Status
                    </h3>
                    <div class="text-sm text-gray-500">
                        <span class="font-medium">Terakhir Update:</span>
                        {{ $user->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                    </div>
                </div>

                <div class="space-y-4">
                    {{-- Current Status --}}
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border">
                        <div class="flex items-center gap-3">
                            <span class="flex h-8 w-8 rounded-full {{ $user->status == 'Approved' ? 'bg-green-100 text-green-600' : ($user->status == 'Warned' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600') }} items-center justify-center">
                                @if ($user->status == 'Approved')
                                    ✓
                                @elseif($user->status == 'Warned')
                                    ⚠
                                @else
                                    ⏳
                                @endif
                            </span>
                            <div>
                                <h4 class="font-semibold text-gray-800">Status Saat Ini: {{ $user->status }}</h4>
                                <p class="text-sm text-gray-600">Diperbarui oleh administrator</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">Aktif</span>
                    </div>

                    {{-- Account Creation --}}
                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border">
                        <div class="flex items-center gap-3">
                            <span class="flex h-8 w-8 rounded-full bg-blue-800 text-white items-center justify-center">
                                👤
                            </span>
                            <div>
                                <h4 class="font-semibold text-gray-800">Akun Dibuat</h4>
                                <p class="text-sm text-gray-600">{{ $user->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</span>
                    </div>
                </div>

                <p class="text-center text-xs text-gray-500 mt-4 pt-4 border-t">
                    Dilihat oleh {{ auth()->user()->name }} pada {{ now()->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                </p>
            </div>
        @endif
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 items-center justify-center">
        <div class="relative max-w-4xl mx-auto p-4">
            <!-- Close button -->
            <button onclick="closeModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 p-2 rounded bg-black bg-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Image container -->
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <div id="imageLoading" class="hidden items-center justify-center p-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-2 border-blue-800 border-t-transparent"></div>
                </div>
                <img id="modalImage" src="" alt="Document" class="max-w-full max-h-[80vh] object-contain">
                <div class="p-4 bg-blue-800 text-white text-center">
                    <h3 id="modalTitle" class="font-semibold"></h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        function confirmStatusChange(form, status, userName) {
            let title, text, confirmButtonText, confirmButtonColor, icon;
            
            switch(status) {
                case 'Approved':
                    title = 'Approve User?';
                    text = `Are you sure you want to approve ${userName}?`;
                    confirmButtonText = 'Yes, Approve!';
                    confirmButtonColor = '#1e40af'; // blue-800
                    icon = 'success';
                    break;
                case 'Under Verification':
                    title = 'Set to Under Verification?';
                    text = `Are you sure you want to set ${userName}'s status to under verification?`;
                    confirmButtonText = 'Yes, Set to Under Verification!';
                    confirmButtonColor = '#1e40af'; // blue-800
                    icon = 'question';
                    break;
                case 'Warned':
                    title = 'Warn User?';
                    text = `Are you sure you want to warn ${userName}?`;
                    confirmButtonText = 'Yes, Set Warning!';
                    confirmButtonColor = '#dc2626'; // red-600
                    icon = 'warning';
                    break;
                default:
                    title = 'Confirm Action';
                    text = `Are you sure you want to change ${userName}'s status?`;
                    confirmButtonText = 'Yes, Continue!';
                    confirmButtonColor = '#1e40af';
                    icon = 'question';
            }

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: '#dc2626', // red-600
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title',
                    content: 'custom-swal-content',
                    confirmButton: 'custom-swal-confirm',
                    cancelButton: 'custom-swal-cancel'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

    <script>
        function openModal(src, title) {
            const modal = document.getElementById('modal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');

            // Set image source and title
            modalImage.src = src;
            if(modalTitle) modalTitle.textContent = title;

            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('modal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });

        function confirmAdminStatusChange(userName, isAdmin) {
            const newStatus = isAdmin ? 'User' : 'Administrator';
            const icon = isAdmin ? 'warning' : 'question';
            const confirmButtonColor = '#1e40af'; // blue-800

            Swal.fire({
                title: 'Change Admin Status?',
                html: `Do you want to change <strong>${userName}</strong>'s status to <strong>${newStatus}</strong>?`,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: '#dc2626', // red-600
                confirmButtonText: `Yes, make ${newStatus}!`,
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title',
                    content: 'custom-swal-content',
                    confirmButton: 'custom-swal-confirm',
                    cancelButton: 'custom-swal-cancel'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('adminStatusForm').submit();
                }
            });
        }
    </script>

    {{-- Custom SweetAlert Styling --}}
    <style>
        /* Custom SweetAlert Popup */
        .custom-swal-popup {
            border-radius: 8px !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
            border: 2px solid #e5e7eb !important;
        }

        /* Custom Title */
        .custom-swal-title {
            color: #1f2937 !important;
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            margin-bottom: 1rem !important;
        }

        /* Custom Content */
        .custom-swal-content {
            color: #4b5563 !important;
            font-size: 1rem !important;
            line-height: 1.5 !important;
        }

        /* Custom Confirm Button */
        .custom-swal-confirm {
            background-color: #1e40af !important;
            color: white !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 8px 16px !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            transition: all 0.2s !important;
            margin: 0 4px !important;
        }

        .custom-swal-confirm:hover {
            background-color: #1d4ed8 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 8px rgba(30, 64, 175, 0.3) !important;
        }

        /* Custom Cancel Button */
        .custom-swal-cancel {
            background-color: #dc2626 !important;
            color: white !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 8px 16px !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            transition: all 0.2s !important;
            margin: 0 4px !important;
        }

        .custom-swal-cancel:hover {
            background-color: #b91c1c !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3) !important;
        }

        /* Icon Styling */
        .swal2-icon.swal2-success {
            border-color: #1e40af !important;
            color: #1e40af !important;
        }

        .swal2-icon.swal2-success .swal2-success-ring {
            border-color: #1e40af !important;
        }

        .swal2-icon.swal2-success .swal2-success-fix {
            background-color: #1e40af !important;
        }

        .swal2-icon.swal2-warning {
            border-color: #dc2626 !important;
            color: #dc2626 !important;
        }

        .swal2-icon.swal2-question {
            border-color: #1e40af !important;
            color: #1e40af !important;
        }

        /* Button Container */
        .swal2-actions {
            gap: 8px !important;
            margin-top: 1.5rem !important;
        }
    </style>

@endsection
