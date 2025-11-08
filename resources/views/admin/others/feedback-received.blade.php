@extends('layouts.main')
@section('title', 'Feedback Received')
@section('component')
    <div class="container mx-auto px-4 py-6 max-w-6xl">
        {{-- Header Bar --}}
        <div class="bg-blue-800 rounded-lg shadow-sm mb-6">
            <div class="px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-comments mr-2"></i>
                        Feedback Management
                    </h1>
                </div>
                <div class="text-white text-sm">
                    <i class="fas fa-clock mr-1"></i>
                    {{ now()->format('M d, Y H:i') }}
                </div>
            </div>
        </div>

        {{-- Compact Statistics --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded flex items-center justify-center mr-3">
                        <i class="fas fa-comments text-blue-800"></i>
                    </div>
                    <div>
                        <div class="text-lg font-bold text-blue-800">{{ number_format($stats['total']) }}</div>
                        <div class="text-xs text-gray-600">Total</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded flex items-center justify-center mr-3">
                        <i class="fas fa-calendar-day text-blue-800"></i>
                    </div>
                    <div>
                        <div class="text-lg font-bold text-blue-800">{{ number_format($stats['today']) }}</div>
                        <div class="text-xs text-gray-600">Today</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded flex items-center justify-center mr-3">
                        <i class="fas fa-calendar-alt text-blue-800"></i>
                    </div>
                    <div>
                        <div class="text-lg font-bold text-blue-800">{{ number_format($stats['this_month']) }}</div>
                        <div class="text-xs text-gray-600">This Month</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-100 rounded flex items-center justify-center mr-3">
                        <i class="fas fa-bug text-red-600"></i>
                    </div>
                    <div>
                        <div class="text-lg font-bold text-red-600">{{ number_format($stats['by_type']['bug']) }}</div>
                        <div class="text-xs text-gray-600">Bug Reports</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Compact Filter Form --}}
        <div class="bg-white rounded-lg border border-gray-200 mb-6">
            <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-sm font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-filter text-blue-800 mr-2"></i>
                    Filters
                </h3>
                <div class="text-xs text-gray-500">{{ $feedbacks->total() }} results</div>
            </div>
            <div class="p-4">
                <form method="GET" action="{{ route('feedback-received') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 mb-3">
                        <div>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="Search..."
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 text-sm">
                        </div>

                        <div>
                            <select id="type" name="type"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 text-sm">
                                <option value="all" {{ request('type') === 'all' ? 'selected' : '' }}>All Types</option>
                                <option value="general" {{ request('type') === 'general' ? 'selected' : '' }}>General</option>
                                <option value="bug" {{ request('type') === 'bug' ? 'selected' : '' }}>Bug Report</option>
                                <option value="feature" {{ request('type') === 'feature' ? 'selected' : '' }}>Feature Request</option>
                            </select>
                        </div>

                        <div>
                            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 text-sm">
                        </div>

                        <div>
                            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-800 focus:ring-1 focus:ring-blue-800 text-sm">
                        </div>

                        <div class="flex space-x-2">
                            <button type="submit"
                                class="flex-1 px-3 py-2 bg-blue-800 text-white rounded hover:bg-blue-900 text-sm font-medium">
                                <i class="fas fa-search mr-1"></i>
                                Filter
                            </button>
                            <a href="{{ route('feedback-received') }}"
                                class="px-3 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50 text-sm">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Feedback Table --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-base font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list text-blue-800 mr-2"></i>
                    Feedback List
                </h3>
                <span class="text-sm text-gray-500">{{ $feedbacks->total() }} total</span>
            </div>

            @if ($feedbacks->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Message</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($feedbacks as $feedback)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-800 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white font-medium text-xs">
                                                    {{ strtoupper(substr($feedback->name, 0, 2)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $feedback->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $feedback->email }}</div>
                                                <div class="text-xs text-gray-400">{{ $feedback->feedback_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($feedback->type === 'bug')
                                            <span class="inline-flex px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded">
                                                <i class="fas fa-bug mr-1"></i>
                                                Bug Report
                                            </span>
                                        @elseif ($feedback->type === 'feature')
                                            <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">
                                                <i class="fas fa-lightbulb mr-1"></i>
                                                Feature
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded">
                                                <i class="fas fa-comment mr-1"></i>
                                                {{ ucfirst($feedback->type) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <p class="truncate">{{ Str::limit($feedback->message, 80) }}</p>
                                            @if (strlen($feedback->message) > 80)
                                                <button onclick="showFullMessage('{{ addslashes($feedback->message) }}', '{{ $feedback->name }}', '{{ $feedback->feedback_id }}')"
                                                    class="text-blue-800 hover:text-blue-900 text-xs font-medium">
                                                    Read more →
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-900">{{ $feedback->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $feedback->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="mailto:{{ $feedback->email }}?subject=Re: Feedback {{ $feedback->feedback_id }}"
                                                class="text-blue-800 hover:text-blue-900 p-1 rounded hover:bg-blue-50" 
                                                title="Reply via Email">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                            <button onclick="copyFeedbackId('{{ $feedback->feedback_id }}')"
                                                class="text-gray-600 hover:text-gray-900 p-1 rounded hover:bg-gray-50"
                                                title="Copy ID">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-4 py-3 border-t border-gray-200 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Showing {{ $feedbacks->firstItem() ?? 0 }} to {{ $feedbacks->lastItem() ?? 0 }} of {{ $feedbacks->total() }} results
                    </div>
                    <div>{{ $feedbacks->links() }}</div>
                </div>
            @else
                <div class="px-4 py-8 text-center">
                    <div class="text-gray-400 mb-2">
                        <i class="fas fa-inbox text-3xl"></i>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900 mb-1">No feedback found</h3>
                    <p class="text-xs text-gray-500">Try adjusting your filter criteria.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Message Modal --}}
    <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 z-50" style="display: none;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-3xl w-full shadow-lg">
                <div class="bg-blue-800 rounded-t-lg px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-white">Feedback Message</h3>
                            <p class="text-blue-200 text-sm" id="modalSender"></p>
                        </div>
                        <button onclick="closeModal()" class="text-white hover:text-blue-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="max-h-80 overflow-y-auto">
                        <div id="modalContent" class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap bg-gray-50 p-4 rounded border"></div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showFullMessage(message, senderName, feedbackId) {
            document.getElementById('modalContent').textContent = message;
            document.getElementById('modalSender').textContent = `From: ${senderName} (ID: ${feedbackId})`;
            document.getElementById('messageModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('messageModal').style.display = 'none';
        }

        function copyFeedbackId(feedbackId) {
            navigator.clipboard.writeText(feedbackId).then(function() {
                const button = event.target.closest('button');
                const originalIcon = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check text-green-600"></i>';
                setTimeout(() => {
                    button.innerHTML = originalIcon;
                }, 1500);
            }).catch(function() {
                const button = event.target.closest('button');
                button.innerHTML = '<i class="fas fa-times text-red-600"></i>';
                setTimeout(() => {
                    button.innerHTML = '<i class="fas fa-copy"></i>';
                }, 1500);
            });
        }

        // Close modal when clicking outside
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection