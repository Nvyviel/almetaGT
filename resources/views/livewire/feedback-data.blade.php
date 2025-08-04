{{-- resources/views/livewire/feedback-data.blade.php --}}

<div class="max-w-xl mx-auto p-4 bg-white">
    {{-- Header with Back Button --}}
    <div class="mb-4">
        <div class="text-center">
            <h2 class="text-xl font-semibold text-gray-900">Send Feedback</h2>
            <p class="text-sm text-gray-600 mt-1">Share your thoughts with us</p>
        </div>
    </div>

    {{-- Success Message --}}
    @if ($showSuccess)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => {
            show = false;
            $wire.hideSuccessMessage();
        }, 4000)"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
            class="mb-3 p-3 bg-white border border-blue-200 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-600 rounded-full flex items-center justify-center mr-2">
                        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Feedback sent successfully!</p>
                        <p class="text-xs text-gray-600">ID: <span
                                class="font-mono text-blue-600">{{ $submittedFeedbackId }}</span></p>
                    </div>
                </div>
                <button @click="show = false; $wire.hideSuccessMessage()"
                    class="w-5 h-5 text-gray-400 hover:text-red-500 transition-colors">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Flash Messages --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
            class="mb-3 p-3 bg-white border border-blue-200 rounded-lg">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-blue-600 rounded-full mr-2"></div>
                <p class="text-sm text-gray-900">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
            class="mb-3 p-3 bg-white border border-red-200 rounded-lg">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-red-500 rounded-full mr-2"></div>
                <p class="text-sm text-gray-900">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Form --}}
    <div x-data="{
        messageText: @entangle('message'),
        messageLength: 0,
        init() {
            this.messageLength = this.messageText.length;
            this.$watch('messageText', value => {
                this.messageLength = value.length;
            });
            this.$wire.on('form-reset', () => {
                this.messageText = '';
                this.messageLength = 0;
            });
        }
    }" class="bg-white border border-gray-200 rounded-lg p-4">

        <form wire:submit="submit" class="space-y-3">
            {{-- Name Field --}}
            <div class="flex items-center justify-between mb-2">
                <a href="{{ route('landing-page') }}"
                    class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors">
                    <i class='fas fa-arrow-left text-lg'></i>
                </a>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" wire:model.blur="name"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror"
                    placeholder="Your full name">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Field --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" wire:model.blur="email"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror"
                    placeholder="your@email.com">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type Field --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                    Type <span class="text-red-500">*</span>
                </label>
                <select id="type" wire:model.change="type"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('type') border-red-500 @enderror">
                    <option value="general">General</option>
                    <option value="bug">Bug Report</option>
                    <option value="feature">Feature Request</option>
                </select>
                @error('type')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Message Field --}}
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                    Message <span class="text-red-500">*</span>
                </label>
                <textarea id="message" x-model="messageText" wire:model.blur="message" rows="4"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none @error('message') border-red-500 @enderror"
                    placeholder="Your feedback..."></textarea>

                <div class="flex justify-between items-center mt-1">
                    @error('message')
                        <p class="text-xs text-red-600">{{ $message }}</p>
                    @else
                        <p class="text-xs text-gray-500">Min 10 chars</p>
                    @enderror
                    <p class="text-xs text-gray-400 font-mono">
                        <span x-text="messageLength" :class="messageLength > 2800 ? 'text-red-500' : ''"></span>/3000
                    </p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="pt-2 space-y-2">
                <button type="submit" x-bind:disabled="$wire.isSubmitting"
                    class="w-full bg-blue-600 text-white py-2.5 px-4 text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">

                    <span x-show="!$wire.isSubmitting" class="flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Send Feedback
                    </span>

                    <span x-show="$wire.isSubmitting" class="flex items-center justify-center">
                        <svg class="animate-spin w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" />
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                        </svg>
                        Sending...
                    </span>
                </button>
            </div>
        </form>
    </div>

    {{-- Footer Note --}}
    <div class="mt-3 p-3 bg-gray-50 rounded-lg border-l-2 border-red-500">
        <p class="text-xs text-gray-600">
            <span class="font-medium text-gray-700">Note:</span>
            Your feedback is important to us. We'll review it and improve our services and user experience.
            Thank you for your input!
        </p>
    </div>

    <div class="text-center py-4 border-t border-gray-200 mt-12">
        <p class="text-xs text-gray-500">
            © {{ date('Y') }} PT. ALMETA GLOBAL TRILINDO All
            rights reserved.
        </p>
    </div>
</div>
