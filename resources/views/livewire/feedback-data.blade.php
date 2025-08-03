{{-- resources/views/livewire/feedback-data.blade.php --}}

<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Send Feedback</h2>
        <p class="text-gray-600">Help us improve by sharing your thoughts, suggestions, or reporting issues.</p>
    </div>

    {{-- Success Message with Auto-Hide --}}
    @if ($showSuccess)
        <div x-data="{
            show: true,
            init() {
                // Auto-hide setelah 5 detik
                setTimeout(() => {
                    this.show = false;
                    $wire.hideSuccessMessage();
                }, 5000);
            }
        }" x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 relative">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-medium text-green-800">Feedback Submitted Successfully!</h3>
                    <p class="text-sm text-green-700 mt-1">
                        Your feedback has been received. Reference ID: <strong>{{ $submittedFeedbackId }}</strong>
                    </p>
                    <p class="text-xs text-green-600 mt-1">This message will disappear in 5 seconds...</p>
                </div>
                <button @click="show = false; $wire.hideSuccessMessage()" class="flex-shrink-0 ml-3">
                    <svg class="h-4 w-4 text-green-400 hover:text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Flash Messages with Auto-Hide --}}
    @if (session()->has('success'))
        <div x-data="{
            show: true,
            init() {
                setTimeout(() => this.show = false, 4000);
            }
        }" x-show="show" x-transition
            class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{
            show: true,
            init() {
                setTimeout(() => this.show = false, 6000);
            }
        }" x-show="show" x-transition
            class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Form with Alpine.js for better UX --}}
    <div x-data="{
        messageText: @entangle('message'),
        messageLength: 0,
        init() {
            this.messageLength = this.messageText.length;
            this.$watch('messageText', value => {
                this.messageLength = value.length;
            });
    
            // Listen untuk event form-reset
            this.$wire.on('form-reset', () => {
                this.messageText = '';
                this.messageLength = 0;
            });
        }
    }">
        <form wire:submit="submit" class="space-y-6">
            {{-- Name Field --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" wire:model.blur="name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror"
                    placeholder="Enter your full name">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Field --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" wire:model.blur="email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror"
                    placeholder="Enter your email address">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type Field --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                    Feedback Type <span class="text-red-500">*</span>
                </label>
                <select id="type" wire:model.change="type"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('type') border-red-500 @enderror">
                    <option value="general">General Feedback</option>
                    <option value="bug">Bug Report</option>
                    <option value="feature">Feature Request</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Message Field --}}
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                    Message <span class="text-red-500">*</span>
                </label>
                <textarea id="message" x-model="messageText" wire:model.blur="message" rows="5"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none @error('message') border-red-500 @enderror"
                    placeholder="Please describe your feedback in detail..."></textarea>
                <div class="flex justify-between items-center mt-1">
                    @error('message')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @else
                        <p class="text-sm text-gray-500">Minimum 10 characters</p>
                    @enderror
                    <p class="text-sm text-gray-400" x-text="messageLength + '/3000'"></p>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex gap-3">
                <button type="submit" x-bind:disabled="$wire.isSubmitting"
                    class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!$wire.isSubmitting">Send Feedback</span>
                    <span x-show="$wire.isSubmitting" class="flex items-center justify-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Sending...
                    </span>
                </button>
            </div>
        </form>
    </div>

    {{-- Info --}}
    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
        <p class="text-sm text-gray-600">
            <strong>Note:</strong> Your feedback is important to us. We'll review it and get back to you if necessary.
            Please keep your reference ID for future correspondence.
        </p>
    </div>
</div>
