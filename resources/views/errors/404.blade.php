<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .error-container {
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .error-code {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1;
            color: #dc2626;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-2xl w-full bg-white border border-gray-300 error-container rounded">
        <!-- Header -->
        <div class="p-4 border-b border-gray-300 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="p-2 bg-red-100 text-red-600 mr-3 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </span>
                    <h1 class="error-code">404</h1>
                    <span class="ml-3 text-lg font-bold text-black">Page Not Found</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2 py-1 bg-blue-800 text-white text-xs rounded">ERROR</span>
                    <a href="{{ route('dashboard') }}" class="text-blue-800 hover:text-blue-900 font-medium text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Left Column - Error Info -->
                <div class="space-y-4">
                    <div>
                        <h2 class="text-xl font-bold text-black mb-2">What happened?</h2>
                        <p class="text-gray-600 text-sm">
                            The page you're looking for doesn't exist. It might have been moved, deleted, or you entered the wrong URL.
                        </p>
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-3">
                        <h3 class="text-sm font-semibold text-black">Quick Actions</h3>
                        <div class="space-y-2">
                            <a href="{{ url()->previous() }}" 
                                class="flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded text-sm border border-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Go Back to Previous Page
                            </a>
                            <a href="{{ route('dashboard') }}" 
                                class="flex items-center px-3 py-2 bg-blue-800 hover:bg-blue-900 text-white rounded text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Return to Dashboard
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Helpful Links -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-semibold text-black mb-3">Helpful Links</h3>
                        <div class="bg-gray-50 rounded p-4 space-y-2">
                            <a href="{{ route('dashboard') }}" class="block text-sm text-blue-800 hover:text-blue-900">
                                • Dashboard Home
                            </a>
                            @if(Auth::check())
                                <a href="{{ route('admin.bills.list') }}" class="block text-sm text-blue-800 hover:text-blue-900">
                                    • Bills Management
                                </a>
                                <a href="{{ route('dashboard-admin') }}" class="block text-sm text-blue-800 hover:text-blue-900">
                                    • User Management
                                </a>
                            @endif
                            <a href="{{ route('login') }}" class="block text-sm text-blue-800 hover:text-blue-900">
                                • Login Page
                            </a>
                        </div>
                    </div>

                    <!-- Error Details -->
                    <div class="bg-red-50 border border-red-200 rounded p-3">
                        <h4 class="text-sm font-semibold text-red-700 mb-2">Error Details</h4>
                        <div class="space-y-1 text-xs text-red-600">
                            <p>• Status: 404 Not Found</p>
                            <p>• URL: {{ request()->fullUrl() }}</p>
                            <p>• Time: {{ now()->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-6 pt-4 border-t border-gray-200 text-center text-xs text-gray-500">
                <p>© {{ date('Y') }} PT. ALMETA GLOBAL TRILINDO. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
