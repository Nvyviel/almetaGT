@extends('layouts.main')

@section('title','Edit Consignee')
@section('component')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('consignee') }}" 
                   class="inline-flex items-center text-gray-600 hover:text-indigo-600 mb-4 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Consignees
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Edit Consignee</h1>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Consignee Information</h2>
                    <p class="mt-1 text-sm text-gray-500">Update consignee details below</p>
                </div>

                <form action="{{ route('consignee-update', $consignee->id) }}" method="POST" class="px-6 py-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Industry -->
                        <div>
                            <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">
                                Industry
                            </label>
                            <input type="text" 
                                   id="industry"
                                   name="industry" 
                                   value="{{ old('industry', $consignee->industry) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>

                        <!-- Name Consignee -->
                        <div>
                            <label for="name_consignee" class="block text-sm font-medium text-gray-700 mb-2">
                                Consignee Name
                            </label>
                            <input type="text" 
                                   id="name_consignee"
                                   name="name_consignee"
                                   value="{{ old('name_consignee', $consignee->name_consignee) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" 
                                   id="email"
                                   name="email" 
                                   value="{{ old('email', $consignee->email) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                City
                            </label>
                            <select id="city" 
                                    name="city" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                @foreach (['surabaya', 'pontianak', 'semarang', 'banjarmasin', 'sampit', 'jakarta', 'kumai', 'samarinda', 'balikpapan', 'berau', 'palu', 'bitung', 'gorontalo', 'ambon'] as $city)
                                    <option value="{{ $city }}"
                                        {{ old('city', $consignee->city) == $city ? 'selected' : '' }}>
                                        {{ ucfirst($city) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input type="text" 
                                   id="phone_number"
                                   name="phone_number"
                                   value="{{ old('phone_number', $consignee->phone_number) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                        </div>

                        <!-- Address -->
                        <div class="lg:col-span-2">
                            <label for="consignee_address" class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea id="consignee_address"
                                      name="consignee_address" 
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">{{ old('consignee_address', $consignee->consignee_address) }}</textarea>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('consignee') }}"
                           class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
