<div>
    <div class="max-w-2xl mx-auto p-4">
        {{-- Header Bar --}}
        <div class="bg-blue-800 rounded-lg mb-4">
            <div class="px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ session('feedback_return_url', route('dashboard')) }}"
                            class="text-white hover:text-blue-200">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    @else
                        <a href="{{ route('landing-page') }}"
                            class="text-white hover:text-blue-200">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    @endauth
                    <div class="h-6 w-px bg-blue-600"></div>
                    <h1 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-comment-dots mr-2"></i>
                        Send Feedback
                    </h1>
                </div>
                <div class="text-blue-200 text-sm">
                    <i class="fas fa-heart mr-1"></i>
                    Your voice matters!
                </div>
            </div>
        </div>

        {{-- Success Message --}}
        @if ($showSuccess)
            <div class="mb-4 p-4 bg-blue-50 border-l-4 border-blue-800 rounded">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-6 h-6 bg-blue-800 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-blue-900">Feedback sent successfully!</p>
                            <p class="text-xs text-blue-700">ID: <span
                                    class="font-mono">{{ $submittedFeedbackId }}</span></p>
                        </div>
                    </div>
                    <button wire:click="hideSuccessMessage"
                        class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Flash Messages --}}
        @if (session()->has('success'))
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded flex items-center">
                <div class="w-4 h-4 bg-blue-800 rounded-full mr-3 flex items-center justify-center">
                    <i class="fas fa-check text-white text-xs"></i>
                </div>
                <p class="text-sm text-blue-900">{{ session('success') }}</p>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded flex items-center">
                <div class="w-4 h-4 bg-red-600 rounded-full mr-3 flex items-center justify-center">
                    <i class="fas fa-times text-white text-xs"></i>
                </div>
                <p class="text-sm text-red-900">{{ session('error') }}</p>
            </div>
        @endif

        {{-- User Status & Form --}}
        <div class="bg-white rounded-lg border border-gray-200">
            {{-- User Status Header --}}
            <div class="px-4 py-3 border-b border-gray-200">
                @auth
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-800 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-blue-800">Authenticated user</p>
                        </div>
                    </div>
                @else
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user-plus text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Guest User</p>
                            <p class="text-xs text-gray-600">Please provide your details</p>
                        </div>
                    </div>
                @endauth
            </div>

            <div class="p-4">
                <form wire:submit="submit" 
                    x-data="{
                        messageText: @entangle('message'),
                        messageLength: 0,
                        init() {
                            this.messageLength = this.messageText.length;
                            this.$watch('messageText', value => {
                                this.messageLength = value.length;
                            });
                        }
                    }" class="space-y-4">
                    {{-- Grid Layout for Name and Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Name <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="name" wire:model.blur="name"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 
                                @error('name') !border-red-600 @enderror"
                                placeholder="Your full name">
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email <span class="text-red-600">*</span>
                            </label>
                            <input type="email" id="email" wire:model.blur="email"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800
                                @error('email') !border-red-600 @enderror"
                                placeholder="your@email.com">
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Type Field with Icons --}}
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                            Feedback Type <span class="text-red-600">*</span>
                        </label>
                        <select id="type" wire:model.change="type"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800
                            @error('type') !border-red-600 @enderror">
                            <option value="general">💬 General Feedback</option>
                            <option value="bug">🐛 Bug Report</option>
                            <option value="feature">💡 Feature Request</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Message Field --}}
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                            Your Message <span class="text-red-600">*</span>
                        </label>
                        <textarea id="message" x-model="messageText" wire:model.blur="message" rows="5"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 resize-none
                            @error('message') !border-red-600 @enderror"
                            placeholder="Tell us about your experience, report bugs, or suggest improvements..."></textarea>

                        <div class="flex justify-between items-center mt-1">
                            @error('message')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @else
                                <p class="text-xs text-gray-500">Minimum 10 characters</p>
                            @enderror
                            <p class="text-xs font-mono" 
                                :class="messageLength > 2800 ? 'text-red-600' : 'text-gray-400'">
                                <span x-text="messageLength"></span>/3000
                            </p>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-center mt-6">
                        <button type="submit" x-bind:disabled="$wire.isSubmitting"
                            class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-blue-800 rounded hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed">
                            
                            <span x-show="!$wire.isSubmitting" class="flex items-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Submit Feedback
                            </span>

                            <span x-show="$wire.isSubmitting" class="flex items-center">
                                <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                </svg>
                                Submitting...
                            </span>
                        </button>
                    </div>
                </form>

                {{-- Creative Footer --}}
                <div class="mt-6 p-4 bg-blue-50 rounded border-l-4 border-blue-800">
                    <div class="flex items-center justify-center space-x-6 mb-2 text-sm">
                        <div class="flex items-center text-blue-800">
                            <i class="fas fa-shield-alt mr-1"></i>
                            <span>Secure</span>
                        </div>
                        <div class="flex items-center text-blue-800">
                            <i class="fas fa-clock mr-1"></i>
                            <span>24h Response</span>
                        </div>
                        <div class="flex items-center text-blue-800">
                            <i class="fas fa-heart mr-1"></i>
                            <span>We Care</span>
                        </div>
                    </div>
                    <p class="text-xs text-center text-gray-600">
                        Your feedback helps us improve AlmetaGT for everyone
                    </p>
                </div>
            </div>

            {{-- Company Footer --}}
            <div class="text-center py-4 border-t border-gray-200 mt-8">
                <p class="text-xs text-gray-500">
                    © {{ date('Y') }} PT. ALMETA GLOBAL TRILINDO - All rights reserved
                </p>
            </div>
        </div>
</div>
