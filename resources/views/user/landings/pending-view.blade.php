<x-guest-layout>
    @section('title-guest', 'Account Verification')

    <div class="min-h-screen bg-grey-50 relative overflow-hidden">
        <!-- Subtle background patterns -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/50"></div>
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.02]">
            <div class="absolute top-20 left-20 w-96 h-96 rounded-full bg-blue-500"></div>
            <div class="absolute bottom-32 right-32 w-64 h-64 rounded-full bg-indigo-500"></div>
            <div class="absolute top-1/2 left-1/3 w-32 h-32 rounded-full bg-purple-500"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-12">
            <!-- Header Section -->
            <header class="mb-12">
                <div class="bg-white/80 backdrop-blur-sm border border-slate-200/50 shadow-sm">
                    <!-- Top bar with gradient -->
                    <div class="h-1 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600"></div>

                    <div class="p-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <!-- Avatar with sophisticated design -->
                                <div class="relative">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                        {{ substr(Auth::user()->name ?? 'Unknown', 0, 1) }}
                                    </div>
                                    <div
                                        class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-2 border-white shadow-sm flex items-center justify-center">
                                        <div class="w-2 h-2 bg-white"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center space-x-3 mb-1">
                                        <h1 class="text-2xl font-bold text-slate-900">
                                            {{ Auth::user()->name ?? 'Unknown' }}</h1>
                                        @if (auth()->user()->status === 'Warned')
                                            <span
                                                class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 border border-red-200">WARNED</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">UNDER
                                                VERIFICATION</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-slate-600 mb-2">Account Verification Required</p>
                                    <div class="flex items-center space-x-4 text-xs text-slate-500">
                                        <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            ID: <span
                                                class="font-mono ml-1 text-slate-700">{{ Auth::user()->user_id ?? 'N/A' }}</span>
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ date('M j, Y \a\t g:i A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="group flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-0.5 transition-transform duration-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Status Alert -->
            @if (auth()->user()->status === 'Warned')
                <div class="mb-8 bg-red-50/80 backdrop-blur-sm border border-red-200/50 p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-red-900 mb-1">Account Warning</h3>
                            <p class="text-sm text-red-800">Your account requires immediate attention. Please verify
                                your documents to continue.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="mb-8 bg-amber-50/80 backdrop-blur-sm border border-amber-200/50 p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-amber-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-amber-900 mb-1">Verification in Progress</h3>
                            <p class="text-sm text-amber-800">Your documents are being reviewed. Estimated completion:
                                1-2 business days.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
                <!-- Documents Section -->
                <div class="xl:col-span-3">
                    <div class="bg-white/80 backdrop-blur-sm border border-slate-200/50 shadow-sm">
                        <div class="border-b border-slate-100 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900">Required Documents</h2>
                                    <p class="text-sm text-slate-600 mt-1">Complete your verification by uploading all
                                        required documents</p>
                                </div>
                                <div class="flex items-center space-x-2 text-xs text-slate-500">
                                    <div class="w-2 h-2 bg-green-500"></div>
                                    <span>Uploaded</span>
                                    <div class="w-2 h-2 bg-red-500 ml-4"></div>
                                    <span>Required</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach ([['key' => 'ktp', 'title' => 'KTP', 'subtitle' => 'Identity Card', 'icon' => 'M10 2L3 7v10c0 5.55 3.84 10 9 10s9-4.45 9-10V7l-7-5zM12 17.3c-.72 0-1.3-.58-1.3-1.3s.58-1.3 1.3-1.3 1.3.58 1.3 1.3-.58 1.3-1.3 1.3zm1-4.3h-2v-6h2v6z'], ['key' => 'npwp', 'title' => 'NPWP', 'subtitle' => 'Tax Identification', 'icon' => 'M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z'], ['key' => 'nib', 'title' => 'NIB', 'subtitle' => 'Business License', 'icon' => 'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z']] as $doc)
                                    <div
                                        class="group relative bg-white border border-slate-200/80 hover:border-slate-300 transition-all duration-300 hover:shadow-lg">
                                        <div class="p-6">
                                            <!-- Header -->
                                            <div class="flex items-start justify-between mb-6">
                                                <div class="flex items-center space-x-3">
                                                    <div
                                                        class="w-10 h-10 bg-slate-100 flex items-center justify-center group-hover:bg-blue-50 transition-colors duration-300">
                                                        <svg class="w-5 h-5 text-slate-600 group-hover:text-blue-600"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="{{ $doc['icon'] }}"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-bold text-slate-900">{{ $doc['title'] }}</h3>
                                                        <p class="text-xs text-slate-500">{{ $doc['subtitle'] }}</p>
                                                    </div>
                                                </div>
                                                @if (Auth::user()->{$doc['key']})
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 border border-green-200">
                                                        ✓ Uploaded
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 border border-red-200">
                                                        ! Required
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- File Info -->
                                            @if (Auth::user()->{$doc['key']})
                                                <div class="mb-4 p-3 bg-slate-50 border border-slate-200">
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-2">
                                                            <svg class="w-4 h-4 text-slate-500" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span
                                                                class="text-xs text-slate-600 truncate">{{ basename(Auth::user()->{$doc['key']}) }}</span>
                                                        </div>
                                                        <button onclick="toggleImage('{{ $doc['key'] }}Image')"
                                                            class="text-xs text-blue-600 hover:text-blue-700">
                                                            View
                                                        </button>
                                                    </div>
                                                </div>
                                                <img id="{{ $doc['key'] }}Image"
                                                    src="{{ asset('storage/' . Auth::user()->{$doc['key']}) }}"
                                                    alt="{{ $doc['title'] }}"
                                                    class="hidden w-full border border-slate-200 mb-4">
                                            @else
                                                <div class="mb-4 p-3 bg-red-50 border border-red-200">
                                                    <p class="text-xs text-red-600">No file uploaded</p>
                                                </div>
                                            @endif

                                            <!-- Actions -->
                                            <div class="space-y-2">
                                                <button onclick="openDocumentModal('{{ $doc['key'] }}')"
                                                    class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                    <svg class="w-4 h-4 inline mr-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    {{ Auth::user()->{$doc['key']} ? 'Replace' : 'Upload' }}
                                                    {{ $doc['title'] }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="xl:col-span-1 space-y-6">
                    <!-- Verification Status -->
                    <div class="bg-white/80 backdrop-blur-sm border border-slate-200/50 shadow-sm">
                        <div class="p-6">
                            <h3 class="font-bold text-slate-900 mb-4">Verification Status</h3>
                            <div class="space-y-4">
                                @foreach (['Documents Upload', 'Review Process', 'Account Approval'] as $index => $step)
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-6 h-6 {{ $index === 0 ? 'bg-blue-600' : ($index === 1 ? 'bg-amber-500' : 'bg-slate-300') }} flex items-center justify-center text-white text-xs font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                        <span
                                            class="text-sm {{ $index === 0 ? 'text-blue-600 font-medium' : ($index === 1 ? 'text-amber-600' : 'text-slate-500') }}">{{ $step }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white/80 backdrop-blur-sm border border-slate-200/50 shadow-sm">
                        <div class="p-6">
                            <h3 class="font-bold text-slate-900 mb-4">Document Summary</h3>
                            <div class="space-y-3">
                                @php
                                    $uploaded = collect(['ktp', 'npwp', 'nib'])
                                        ->filter(fn($doc) => Auth::user()->{$doc})
                                        ->count();
                                    $total = 3;
                                @endphp
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-slate-600">Uploaded</span>
                                    <span
                                        class="font-bold text-green-600">{{ $uploaded }}/{{ $total }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-slate-600">Remaining</span>
                                    <span class="font-bold text-red-600">{{ $total - $uploaded }}</span>
                                </div>
                                <div class="pt-2">
                                    <div class="w-full bg-slate-200 h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-green-500 h-2 transition-all duration-500"
                                            style="width: {{ ($uploaded / $total) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Support -->
            <div class="max-w-sm">
                <div class="p-6">
                    <h3 class="font-bold text-slate-900 mb-4">Need Assistance?</h3>
                    <div class="flex space-x-3">
                        <a href="mailto:cs@almetagt.com"
                            class="flex items-center space-x-2 text-sm text-slate-600 hover:text-red-600 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                </path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span>Email Support</span>
                        </a>
                        @php
                            $customerName = Auth::user()->name ?? 'Customer';
                            $companyName = Auth::user()->company_name ?? 'PT ...';
                            $whatsappNumber = '6282142534093';
                            $message = "Halo, CS Almeta Global Trilindo. Saya $customerName dari $companyName ingin meminta bantuan terkait Approval Document.";
                            $encodedMessage = urlencode($message);
                            $whatsappLink = "https://wa.me/$whatsappNumber?text=$encodedMessage";
                        @endphp

                        <div class="flex items-center space-x-3 text-sm">
                            <a href="{{ $whatsappLink }}" target="_blank"
                                class="flex items-center text-slate-600 hover:text-green-600 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                </svg>
                                <span>WhatsApp Support</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="documentModal"
            class="hidden fixed inset-0 bg-slate-900/75 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white shadow-2xl border border-slate-200 w-full max-w-md">
                <div class="border-b border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <h3 id="modalTitle" class="font-bold text-slate-900">Upload Document</h3>
                        <button id="closeDocumentModalButton" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <form method="post" action="{{ route('update-document') }}" enctype="multipart/form-data"
                    class="p-6">
                    @csrf
                    @method('patch')
                    <input type="hidden" id="documentType" name="document_type" value="">

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Select File</label>
                        <div
                            class="border-2 border-dashed border-slate-300 p-6 text-center hover:border-blue-400 transition-colors duration-200">
                            <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="flex text-sm text-slate-600">
                                <label for="documentFile"
                                    class="relative cursor-pointer bg-white font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>Choose file</span>
                                    <input id="documentFile" name="document" type="file" accept="image/*,.pdf"
                                        class="sr-only" required>
                                </label>
                                <span class="pl-1">or drag and drop</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">PNG, JPG, PDF up to 2MB</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancelDocumentButton"
                            class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 hover:bg-slate-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Upload Document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleImage(imageId) {
            const image = document.getElementById(imageId);
            image.classList.toggle('hidden');
        }

        function openDocumentModal(documentType) {
            document.getElementById('documentType').value = documentType;
            const titles = {
                ktp: 'KTP (Identity Card)',
                npwp: 'NPWP (Tax ID)',
                nib: 'NIB (Business License)'
            };
            document.getElementById('modalTitle').textContent = `Upload ${titles[documentType]}`;
            document.getElementById('documentModal').classList.remove('hidden');
        }

        ['closeDocumentModalButton', 'cancelDocumentButton'].forEach(id => {
            document.getElementById(id).addEventListener('click', () => {
                document.getElementById('documentModal').classList.add('hidden');
            });
        });

        document.getElementById('documentModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('documentModal')) {
                document.getElementById('documentModal').classList.add('hidden');
            }
        });
    </script>
</x-guest-layout>
