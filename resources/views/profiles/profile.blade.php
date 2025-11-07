@extends('layouts.fullscreen')

@section('title', 'Profile')
@section('component')
    <div class="min-h-screen bg-gray-50 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto space-y-6">
            <!-- Header with Back Button -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="inline-flex items-center px-3 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Dashboard
                        </a>
                        <div class="ml-4">
                            <h1 class="text-xl font-bold text-gray-900">User Profile</h1>
                            <p class="text-sm text-gray-600">Manage your account information and settings</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">
                            <i class="fas fa-circle text-green-400 mr-1" style="font-size: 6px;"></i>
                            Active
                        </span>
                    </div>
                </div>
            </div>

            <!-- Account Data Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-blue-800 px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-circle text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-white">Account Information</h2>
                            <p class="text-blue-100 text-sm">Manage your profile and view account details</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Success Message -->
                    @if (session('status') === 'profile-updated')
                        <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                <span class="text-green-800 font-medium text-sm">Profile updated successfully!</span>
                            </div>
                        </div>
                    @endif

                    <!-- Profile Information Display -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                            <button id="editProfileButton"
                                class="inline-flex items-center px-4 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium rounded-lg">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Profile
                            </button>
                        </div>

                        <!-- Personal & Company Information Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
                            <!-- Personal Information -->
                            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                <h4 class="text-md font-semibold text-gray-900 mb-3 flex items-center">
                                    <i class="fas fa-user text-blue-800 mr-2"></i>
                                    Personal Information
                                </h4>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Name</label>
                                        <p class="text-gray-900 font-medium">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                                        <p class="text-gray-900 font-medium">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Information -->
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h4 class="text-md font-semibold text-gray-900 mb-3 flex items-center">
                                    <i class="fas fa-building text-gray-700 mr-2"></i>
                                    Company Information
                                </h4>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Company Name</label>
                                        <p class="text-gray-900 font-medium">
                                            {{ Auth::user()->company_name ?: 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Company Phone</label>
                                        <p class="text-gray-900 font-medium">
                                            {{ Auth::user()->company_phone_number ?: 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Company Address</label>
                                        <p class="text-gray-900 font-medium">
                                            {{ Auth::user()->company_address ?: 'Not specified' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <h4 class="text-md font-semibold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-file-alt text-blue-800 mr-2"></i>
                                Documents
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <!-- KTP -->
                                <div class="text-center bg-white rounded-lg p-3 border border-gray-200">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">KTP</label>
                                    @if (Auth::user()->ktp)
                                        <button type="button"
                                            class="w-full px-3 py-2 text-sm font-medium rounded-lg text-white bg-blue-800 hover:bg-blue-900"
                                            onclick="toggleImage('ktpImage')">
                                            <span id="ktpButtonText">View KTP</span>
                                        </button>
                                        <img id="ktpImage" src="{{ asset('storage/' . Auth::user()->ktp) }}"
                                            alt="KTP Image"
                                            class="mt-2 w-full hidden rounded-lg shadow-sm border border-gray-200">
                                    @else
                                        <div class="w-full px-3 py-2 text-sm text-gray-500 bg-gray-100 rounded-lg border border-gray-200">
                                            No file uploaded
                                        </div>
                                    @endif
                                </div>

                                <!-- NPWP -->
                                <div class="text-center bg-white rounded-lg p-3 border border-gray-200">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">NPWP</label>
                                    @if (Auth::user()->npwp)
                                        <button type="button"
                                            class="w-full px-3 py-2 text-sm font-medium rounded-lg text-white bg-blue-800 hover:bg-blue-900"
                                            onclick="toggleImage('npwpImage')">
                                            <span id="npwpButtonText">View NPWP</span>
                                        </button>
                                        <img id="npwpImage" src="{{ asset('storage/' . Auth::user()->npwp) }}"
                                            alt="NPWP Image"
                                            class="mt-2 w-full hidden rounded-lg shadow-sm border border-gray-200">
                                    @else
                                        <div class="w-full px-3 py-2 text-sm text-gray-500 bg-gray-100 rounded-lg border border-gray-200">
                                            No file uploaded
                                        </div>
                                    @endif
                                </div>

                                <!-- NIB -->
                                <div class="text-center bg-white rounded-lg p-3 border border-gray-200">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">NIB</label>
                                    @if (Auth::user()->nib)
                                        <button type="button"
                                            class="w-full px-3 py-2 text-sm font-medium rounded-lg text-white bg-blue-800 hover:bg-blue-900"
                                            onclick="toggleImage('nibImage')">
                                            <span id="nibButtonText">View NIB</span>
                                        </button>
                                        <img id="nibImage" src="{{ asset('storage/' . Auth::user()->nib) }}"
                                            alt="NIB Image"
                                            class="mt-2 w-full hidden rounded-lg shadow-sm border border-gray-200">
                                    @else
                                        <div class="w-full px-3 py-2 text-sm text-gray-500 bg-gray-100 rounded-lg border border-gray-200">
                                            No file uploaded
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                            <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                                <dt class="text-sm font-medium text-gray-600 mb-1">Account Created</dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ Auth::user()->created_at->format('M d, Y') }}</dd>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                                <dt class="text-sm font-medium text-gray-600 mb-1">Last Updated</dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ Auth::user()->updated_at->format('M d, Y') }}</dd>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                <dt class="text-sm font-medium text-gray-600 mb-1">Account ID</dt>
                                <button
                                    class="text-lg font-semibold text-gray-900 font-mono cursor-pointer hover:bg-gray-100 px-2 py-1 rounded"
                                    onclick="navigator.clipboard.writeText('{{ str_pad(Auth::user()->user_id, 6, '0', STR_PAD_LEFT) }}').then(() => { this.innerText = 'Copied!'; setTimeout(() => { this.innerText = '{{ str_pad(Auth::user()->user_id, 6, '0', STR_PAD_LEFT) }}'; }, 1000); });"
                                    type="button">
                                    {{ str_pad(Auth::user()->user_id, 6, '0', STR_PAD_LEFT) }}
                                </button>
                            </div>
                            <div class="bg-green-50 rounded-lg p-3 border border-green-200">
                                <dt class="text-sm font-medium text-gray-600 mb-1">Status</dt>
                                <dd>
                                    <span class="inline-flex items-center px-2 py-1 rounded text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-circle text-green-400 mr-1" style="font-size: 6px;"></i>
                                        Active
                                    </span>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-blue-800 px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-lock text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-white">Security Settings</h2>
                            <p class="text-blue-100 text-sm">Update your password to keep your account secure</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="max-w-2xl mx-auto">
                        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                            @csrf
                            @method('put')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label for="update_password_current_password"
                                        class="block text-sm font-medium text-gray-700 mb-1">
                                        Current Password
                                    </label>
                                    <input id="update_password_current_password" name="current_password" type="password"
                                        class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                        autocomplete="current-password" />
                                </div>

                                <div>
                                    <label for="update_password_password"
                                        class="block text-sm font-medium text-gray-700 mb-1">
                                        New Password
                                    </label>
                                    <input id="update_password_password" name="password" type="password"
                                        class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                        autocomplete="new-password" />
                                </div>

                                <div>
                                    <label for="update_password_password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-1">
                                        Confirm Password
                                    </label>
                                    <input id="update_password_password_confirmation" name="password_confirmation"
                                        type="password"
                                        class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-800/20 focus:border-blue-800"
                                        autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex items-center">
                                    @if (session('status') === 'password-updated')
                                        <div class="flex items-center text-green-600">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            <span class="text-sm font-medium">Password updated successfully!</span>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-2 bg-blue-800 hover:bg-blue-900 text-white font-medium rounded-lg">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-white rounded-lg shadow-sm border border-red-200 overflow-hidden">
                <div class="bg-red-600 px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-white">Danger Zone</h2>
                            <p class="text-red-100 text-sm">Permanently delete your account and all data</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="max-w-2xl mx-auto">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete Account</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Once your account is deleted, all resources and data will be permanently deleted. 
                                Please download any data you wish to retain before proceeding.
                            </p>

                            <button
                                onclick="document.getElementById('confirm-user-deletion-modal').style.display = 'block';"
                                class="inline-flex items-center px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Delete Account
                            </button>
                        </div>

                        <!-- Delete Account Modal -->
                        <div id="confirm-user-deletion-modal" style="display: none;"
                            class="fixed inset-0 bg-gray-900/75 flex items-center justify-center z-50 p-4">
                            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
                                <div class="bg-red-600 px-6 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold text-white">Delete Account Confirmation</h3>
                                </div>

                                <form method="post" action="{{ route('profile-destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                                        </div>
                                        <p class="text-sm text-gray-600">
                                            This action cannot be undone. All data will be permanently deleted.
                                        </p>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                            Confirm your password to continue
                                        </label>
                                        <input id="password" name="password" type="password"
                                            class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600/20 focus:border-red-600"
                                            placeholder="Enter your password" />
                                    </div>

                                    <div class="flex justify-end gap-3">
                                        <button type="button"
                                            onclick="document.getElementById('confirm-user-deletion-modal').style.display = 'none';"
                                            class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            Cancel
                                        </button>

                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg">
                                            <i class="fas fa-trash-alt mr-2"></i>
                                            Delete Account
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center py-6">
                <div class="bg-white rounded-lg px-6 py-3 inline-block border border-gray-200">
                    <p class="text-sm text-gray-600">
                        Need help?
                        <a href="mailto:almetagt@gmail.com" class="text-blue-800 hover:text-blue-900 font-medium ml-1">
                            Contact support team
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Profile Update -->
    <div id="profileModal" class="hidden fixed inset-0 bg-black/60 z-50">
        <div class="flex justify-center items-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="bg-blue-800 px-6 py-4 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-white">Update Profile Information</h2>
                        <button id="closeModalButton" class="text-blue-200 hover:text-white">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Form -->
                <form method="post" action="{{ route('profile-update') }}" class="p-6 space-y-4" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                            <div class="flex">
                                <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-0.5"></i>
                                <div>
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                                    <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Personal Information -->
                        <div class="space-y-3">
                            <h3 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-1">Personal Information</h3>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input id="name" name="name" type="text"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm"
                                    value="{{ old('name', Auth::user()->name) }}" required />
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input id="email" name="email" type="email"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm"
                                    value="{{ old('email', Auth::user()->email) }}" required />
                            </div>
                        </div>

                        <!-- Company Information -->
                        <div class="space-y-3">
                            <h3 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-1">Company Information</h3>

                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                                <input id="company_name" name="company_name" type="text"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm"
                                    value="{{ old('company_name', Auth::user()->company_name) }}" />
                            </div>

                            <div>
                                <label for="company_phone_number" class="block text-sm font-medium text-gray-700 mb-1">Company Phone</label>
                                <input id="company_phone_number" name="company_phone_number" type="tel"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm"
                                    value="{{ old('company_phone_number', Auth::user()->company_phone_number) }}" />
                            </div>

                            <div>
                                <label for="company_location" class="block text-sm font-medium text-gray-700 mb-1">Company Location</label>
                                <input id="company_location" name="company_location" type="text"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm"
                                    value="{{ old('company_location', Auth::user()->company_location) }}" />
                            </div>
                        </div>

                        <!-- Company Address (Full Width) -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Company Address</label>
                            <textarea id="company_address" name="company_address" rows="2"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-800 focus:ring-blue-800 text-sm">{{ old('company_address', Auth::user()->company_address) }}</textarea>
                        </div>

                        <!-- Document Updates -->
                        <div class="col-span-1 md:col-span-2 space-y-3">
                            <h3 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-1">Document Updates</h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div>
                                    <label for="ktp" class="block text-sm font-medium text-gray-700 mb-1">KTP</label>
                                    <input id="ktp" name="ktp" type="file" accept="image/*"
                                        class="w-full text-sm text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-800" />
                                    @if (Auth::user()->ktp)
                                        <p class="mt-1 text-xs text-gray-500">Current: {{ basename(Auth::user()->ktp) }}</p>
                                    @endif
                                </div>

                                <div>
                                    <label for="npwp" class="block text-sm font-medium text-gray-700 mb-1">NPWP</label>
                                    <input id="npwp" name="npwp" type="file" accept="image/*"
                                        class="w-full text-sm text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-800" />
                                    @if (Auth::user()->npwp)
                                        <p class="mt-1 text-xs text-gray-500">Current: {{ basename(Auth::user()->npwp) }}</p>
                                    @endif
                                </div>

                                <div>
                                    <label for="nib" class="block text-sm font-medium text-gray-700 mb-1">NIB</label>
                                    <input id="nib" name="nib" type="file" accept="image/*"
                                        class="w-full text-sm text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-800" />
                                    @if (Auth::user()->nib)
                                        <p class="mt-1 text-xs text-gray-500">Current: {{ basename(Auth::user()->nib) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end pt-4 border-t border-gray-200 space-x-3">
                        <button type="button" id="cancelButton"
                            class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-800 hover:bg-blue-900">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal handlers
            document.getElementById('editProfileButton').addEventListener('click', () => {
                document.getElementById('profileModal').classList.remove('hidden');
            });

            document.getElementById('closeModalButton').addEventListener('click', () => {
                document.getElementById('profileModal').classList.add('hidden');
            });

            document.getElementById('cancelButton').addEventListener('click', () => {
                document.getElementById('profileModal').classList.add('hidden');
            });

            // Close modal when clicking outside
            document.getElementById('profileModal').addEventListener('click', (e) => {
                if (e.target === document.getElementById('profileModal')) {
                    document.getElementById('profileModal').classList.add('hidden');
                }
            });

            // ESC key to close modal
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    document.getElementById('profileModal').classList.add('hidden');
                }
            });
        });

        function toggleImage(imageId) {
            const image = document.getElementById(imageId);
            const buttonText = document.getElementById(imageId.replace('Image', 'ButtonText'));

            if (image.classList.contains('hidden')) {
                image.classList.remove('hidden');
                buttonText.textContent = buttonText.textContent.replace('View', 'Hide');
            } else {
                image.classList.add('hidden');
                buttonText.textContent = buttonText.textContent.replace('Hide', 'View');
            }
        }
    </script>

    <style>
        /* Remove excessive animations and focus styles */
        input[type="password"],
        input[type="email"],
        input[type="text"],
        textarea {
            box-shadow: none !important;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none !important;
        }

        /* Simple hover effects only */
        .hover-effect {
            transition: background-color 0.2s ease;
        }
    </style>
@endsection
