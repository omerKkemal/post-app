@vite(['resources/css/view.css', 'resources/js/app.js'])
<style>
    /* Fade in animation for filter */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .library-item {
        animation: fadeIn 0.3s ease-in;
    }

    /* Filter button styles */
    .filter-btn {
        transition: all 0.2s ease;
    }

    .filter-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Modal styles */
    #uploadModal, #deleteModal, #previewModal {
        display: none;
        align-items: flex-start;
        justify-content: center;
    }

    #uploadModal.hidden, #deleteModal.hidden, #previewModal.hidden {
        display: none !important;
    }

    /* Loading spinner */
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        border-top-color: #3b82f6;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Button hover effects */
    .add-file-btn:hover, .preview-file-btn:hover, .delete-file-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* File preview overlay */
    .group:hover .group-hover\:opacity-100 {
        opacity: 1 !important;
    }

    /* Preview content styles */
    #textContent {
        font-family: 'Courier New', monospace;
        line-height: 1.5;
        tab-size: 4;
    }

    #pdfPreview iframe {
        width: 100%;
        height: 100%;
    }

    /* Language Filter Styles */
    .language-filter-btn {
        padding: 8px 16px;
        background-color: #f3f4f6;
        border: 2px solid transparent;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .language-filter-btn:hover {
        background-color: #e5e7eb;
        transform: translateY(-1px);
    }

    .language-filter-active {
        background-color: #3b82f6 !important;
        color: white;
        border-color: #3b82f6;
    }

    .language-badge {
        font-weight: 500;
        font-size: 0.875rem;
    }

    /* Category Filter Active State */
    .category-filter-btn {
        padding: 8px 16px;
        background-color: #f3f4f6;
        border: 2px solid transparent;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .category-filter-btn:hover {
        background-color: #e5e7eb;
        transform: translateY(-1px);
    }

    .category-filter-active {
        background-color: #3b82f6 !important;
        color: white;
        border-color: #3b82f6;
    }

    /* Animation for filter changes */
    .library-item {
        transition: all 0.3s ease;
    }


</style>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Library Management') }}
            </h2>
            <p class="text-sm text-gray-600">
                {{ __('Manage your document library') }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Language Filter -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                            </svg>
                            Language Filter
                        </h3>
                        <button id="reset-language-filter" class="text-sm text-blue-600 hover:text-blue-800 transition-colors">
                            Reset Filter
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-3" id="language-filters-container">
                        <button class="filter-btn language-filter-btn" data-language="harari">
                            <span class="english language-badge catagory-badge" data-am="ሀረሪ" data-har="ሀረሪ" data-en="Harari">Harari</span>
                        </button>
                        <button class="filter-btn language-filter-btn" data-language="english">
                            <span class="category-badge language-badge" data-am="እንግሊዝኛ" data-har="እንግሊዝኛ" data-en="English">English</span>
                        </button>
                        <button class="filter-btn language-filter-btn" data-language="amharic">
                            <span class="category-badge language-badge" data-am="አማርኛ" data-har="አማርኛ" data-en="Amharic">Amharic</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                        </svg>
                        Filter by Category
                    </h3>
                    <div class="flex flex-wrap gap-3" id="categoryFilters">
                        <button class="filter-btn category-filter-btn category-filter-active" data-category="all">
                            <span class="category-badge" data-en="All Categories" data-har="ሁሉም ምድቦች" data-am="ሁሉም ምድቦች">All Categories</span>
                        </button>
                        @foreach($categories as $category)
                            <button class="filter-btn category-filter-btn"
                                    data-category="{{ $category->id }}"
                                    data-category-name="{{ $category->name }}"
                                    data-category-en="{{ $category->name }}"
                                    data-category-har="{{ $category->har }}"
                                    data-category-am="{{ $category->am }}">
                                <span class="category-badge"
                                      data-en="{{ $category->name }}"
                                      data-har="{{ $category->har }}"
                                      data-am="{{ $category->am }}">
                                    {{ $category->name }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Library Files Grid -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            Your Library Files
                            <span id="fileCount">({{ $libraries->count() }})</span>
                        </h3>
                    </div>

                    @if($libraries->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="libraryGrid">
                            @foreach($libraries as $library)
                                <div class="library-item bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow duration-200"
                                     data-category="{{ $library->catagory_id ?? 0 }}"
                                     data-category-name="{{ $library->category->name ?? 'Uncategorized' }}">
                                    <!-- Category Badge -->
                                    @if($library->category)
                                        <div class="mb-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $library->category->name }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- File Preview -->
                                    <div class="flex items-center justify-center h-32 bg-white rounded-lg mb-3 border relative group">
                                        @php
                                            $extension = pathinfo($library->location, PATHINFO_EXTENSION);
                                            $iconClass = match(strtolower($extension)) {
                                                'pdf' => 'fas fa-file-pdf text-red-500',
                                                'doc', 'docx' => 'fas fa-file-word text-blue-500',
                                                'txt' => 'fas fa-file-alt text-gray-500',
                                                'xls', 'xlsx' => 'fas fa-file-excel text-green-500',
                                                'ppt', 'pptx' => 'fas fa-file-powerpoint text-orange-500',
                                                default => 'fas fa-file text-gray-400'
                                            };
                                            $previewable = in_array(strtolower($extension), ['pdf', 'txt']);
                                            $fileUrl = route('library.view', ['id' => $library->id]);
                                            $downloadUrl = url('/download/' . $library->id);
                                        @endphp
                                        <i class="{{ $iconClass }} text-4xl"></i>

                                        <!-- Preview overlay for previewable files -->
                                        @if($previewable)
                                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                                                <button type="button"
                                                        class="preview-file-btn inline-flex items-center px-3 py-1.5 bg-white/90 hover:bg-white text-gray-800 rounded-md transition-colors"
                                                        data-file-id="{{ $library->id }}"
                                                        data-file-name="{{ $library->name }}"
                                                        data-file-extension="{{ $extension }}"
                                                        data-file-url="{{ $fileUrl }}"
                                                        data-download-url="{{ $downloadUrl }}">
                                                    <i class="fas fa-eye mr-1.5"></i>
                                                    Preview
                                                </button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- File Info -->
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-900 truncate" title="{{ $library->name }}">
                                            {{ $library->name }}
                                        </h4>
                                        @if($library->description)
                                            <p class="text-xs text-gray-600 mt-1 line-clamp-2" title="{{ $library->description }}">
                                                {{ $library->description }}
                                            </p>
                                        @endif
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="text-xs text-gray-500">
                                                {{ $library->created_at->format('M d, Y') }}
                                            </span>
                                            <span class="text-xs text-gray-500 uppercase">
                                                {{ strtoupper($extension) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200">
                                        <div class="flex space-x-2">
                                            <!-- Preview Button (for previewable files) -->
                                            @if($previewable)
                                                <button type="button"
                                                        class="preview-file-btn inline-flex items-center px-3 py-1 text-xs bg-purple-600 hover:bg-purple-700 text-white rounded-md transition-colors"
                                                        data-file-id="{{ $library->id }}"
                                                        data-file-name="{{ $library->name }}"
                                                        data-file-extension="{{ $extension }}"
                                                        data-file-url="{{ $fileUrl }}"
                                                        data-download-url="{{ $downloadUrl }}">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    Preview
                                                </button>
                                            @endif

                                            <!-- Download Button -->
                                            <a href="{{ $downloadUrl }}"
                                               class="inline-flex items-center px-3 py-1 text-xs bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                                <i class="fas fa-download mr-1"></i>
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12" id="noFilesMessage">
                            <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No files in your library</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Upload New File</h3>
                    <button type="button" id="closeModalBtn" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="uploadForm" enctype="multipart/form-data" action="{{ route('library.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="fileName" class="block text-sm font-medium text-gray-700 mb-2">File Name *</label>
                        <input type="text"
                               id="fileName"
                               name="name"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter file name">
                    </div>

                    <div class="mb-4">
                        <label for="fileCategory" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select id="fileCategory"
                                name="catagory_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Category (Optional)</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="fileDescription" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                        <textarea id="fileDescription"
                                  name="description"
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Enter file description"></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="fileDocument" class="block text-sm font-medium text-gray-700 mb-2">Select File *</label>
                        <div class="relative">
                            <input type="file"
                                   id="fileDocument"
                                   name="document"
                                   accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.ppt,.pptx"
                                   required
                                   class="hidden">
                            <div class="flex items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition-colors cursor-pointer"
                                 id="fileDropZone">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600">Click to browse or drag and drop</p>
                                    <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, TXT, XLS, XLSX, PPT, PPTX (Max 10MB)</p>
                                </div>
                            </div>
                        </div>
                        <div id="fileInfo" class="mt-2 hidden">
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <span id="selectedFileName" class="text-sm text-gray-700"></span>
                                <button type="button" id="removeFile" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button"
                                id="cancelBtn"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                id="submitBtn"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-upload mr-2"></i>
                            Upload File
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-5 mx-auto p-0 border shadow-lg rounded-md bg-white max-w-4xl w-full">
            <div class="sticky top-0 bg-white border-b border-gray-200 p-4 z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-eye text-purple-600 text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900" id="previewFileName">File Preview</h3>
                            <p class="text-xs text-gray-500" id="previewFileType">Loading...</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="#"
                           id="previewDownloadBtn"
                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                            <i class="fas fa-download mr-1.5"></i>
                            Download
                        </a>
                        <button type="button"
                                id="closePreviewBtn"
                                class="inline-flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preview Content -->
            <div class="p-0">
                <!-- PDF Preview -->
                <div id="pdfPreview" class="hidden h-[70vh]">
                    <iframe id="pdfIframe" class="w-full h-full border-0" title="PDF Preview"></iframe>
                </div>

                <!-- Text Preview -->
                <div id="textPreview" class="hidden h-[70vh] overflow-auto">
                    <div class="p-6">
                        <pre id="textContent" class="text-sm font-mono whitespace-pre-wrap bg-gray-50 p-4 rounded-lg border border-gray-200 max-h-[60vh] overflow-auto"></pre>
                    </div>
                </div>

                <!-- Unsupported File Type -->
                <div id="unsupportedPreview" class="hidden">
                    <div class="py-16 text-center">
                        <i class="fas fa-file text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Preview Not Available</h3>
                        <p class="text-gray-500 mb-6 max-w-md mx-auto">
                            Preview is only available for PDF and text files. For other file types, please download the file to view it.
                        </p>
                        <div class="flex justify-center space-x-3">
                            <a href="#"
                               id="unsupportedDownloadBtn"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors">
                                <i class="fas fa-download mr-2"></i>
                                Download File
                            </a>
                            <button type="button"
                                    id="closeUnsupportedBtn"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-md transition-colors">
                                Close
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Loading State -->
                <div id="previewLoading" class="hidden">
                    <div class="py-20 text-center">
                        <div class="loading-spinner mx-auto mb-4"></div>
                        <p class="text-gray-600 font-medium">Loading preview...</p>
                    </div>
                </div>

                <!-- Error State -->
                <div id="previewError" class="hidden">
                    <div class="py-20 text-center">
                        <i class="fas fa-exclamation-circle text-6xl text-red-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Unable to Load Preview</h3>
                        <p class="text-gray-500 mb-6 max-w-md mx-auto">
                            There was an error loading the file preview. Please download the file to view it.
                        </p>
                        <div class="flex justify-center space-x-3">
                            <a href="#"
                               id="errorDownloadBtn"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors">
                                <i class="fas fa-download mr-2"></i>
                                Download File
                            </a>
                            <button type="button"
                                    id="closeErrorBtn"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-md transition-colors">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    // ==================== COOKIE HELPERS ====================
    function getCookie(name) {
        const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }
    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
    }

    // ==================== NAVIGATION & CATEGORY BUTTON TEXTS ====================
    function updateNavigationLanguage(language) {
        document.querySelectorAll('.nav-eng, .nav-har, .nav-am').forEach(span => span.style.display = 'none');
        if (language === 'english' || language === 'all')
            document.querySelectorAll('.nav-eng').forEach(span => span.style.display = 'inline');
        else if (language === 'harari')
            document.querySelectorAll('.nav-har').forEach(span => span.style.display = 'inline');
        else if (language === 'amharic')
            document.querySelectorAll('.nav-am').forEach(span => span.style.display = 'inline');
    }

    function updateCategoryButtonLabels(language) {
        document.querySelectorAll('.category-filter-btn .category-badge').forEach(badge => {
            let text = '';
            if (language === 'harari')
                text = badge.getAttribute('data-har') || badge.getAttribute('data-en');
            else if (language === 'amharic')
                text = badge.getAttribute('data-am') || badge.getAttribute('data-en');
            else
                text = badge.getAttribute('data-en');
            if (text) badge.textContent = text;
        });
    }

    function updateLanguageButtonLabels(language) {
        document.querySelectorAll('.language-filter-btn').forEach(btn => {
            const span = btn.querySelector('.language-badge') || btn.querySelector('span');
            if (!span) return;
            let text = '';
            if (language === 'harari') text = span.getAttribute('data-har') || span.getAttribute('data-en');
            else if (language === 'amharic') text = span.getAttribute('data-am') || span.getAttribute('data-en');
            else text = span.getAttribute('data-en') || span.textContent;
            if (text) span.textContent = text;
        });
    }

    function normalizeLanguageCode(language) {
        if (!language) return 'all';
        const code = language.toLowerCase().trim();
        if (code === 'har' || code === 'harari') return 'harari';
        if (code === 'eng' || code === 'english') return 'english';
        if (code === 'am' || code === 'amharic') return 'amharic';
        if (code === 'all') return 'all';
        return code;
    }

    // ==================== FILTER STATE ====================
    let currentLanguageFilter = getCookie('selected_library_language') || 'harari';

    // ==================== CORE FILTER FUNCTION (NO CLASS DEPENDENCY) ====================
    function applyFilters() {
        const libraryGrid = document.getElementById('libraryGrid');
        const items = libraryGrid ? libraryGrid.querySelectorAll('.library-item') : document.querySelectorAll('.library-item');
        let visibleCount = 0;
        const activeCategoryBtn = document.querySelector('.category-filter-btn.category-filter-active');
        const activeCategory = activeCategoryBtn ? activeCategoryBtn.getAttribute('data-category') : 'all';
        const normalizedCurrentLanguage = normalizeLanguageCode(currentLanguageFilter);

        items.forEach(item => {
            const itemLanguage = normalizeLanguageCode(item.getAttribute('data-language') || 'all');
            const itemCategory = item.getAttribute('data-category') || 'all';

            const languageMatch = (normalizedCurrentLanguage === 'all') ||
                                  (itemLanguage === 'all') ||
                                  (itemLanguage === normalizedCurrentLanguage);
            const categoryMatch = (activeCategory === 'all') || (itemCategory === activeCategory);

            if (languageMatch && categoryMatch) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Update "no files" message only, keep the header count fixed to the original total
        const noFilesMsg = document.getElementById('noFilesMessage');
        if (noFilesMsg) noFilesMsg.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // ==================== INITIALIZE FILTER BUTTONS ====================
    function initializeCategoryFilter() {
        const btns = document.querySelectorAll('.category-filter-btn');
        btns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                btns.forEach(b => b.classList.remove('category-filter-active'));
                this.classList.add('category-filter-active');
                applyFilters();
            });
        });
        // Ensure "All Categories" is active by default
        if (!document.querySelector('.category-filter-btn.category-filter-active')) {
            const allBtn = document.querySelector('.category-filter-btn[data-category="all"]');
            if (allBtn) allBtn.classList.add('category-filter-active');
        }
    }

    function initializeLanguageFilter() {
        const langBtns = document.querySelectorAll('.language-filter-btn');
        const resetBtn = document.getElementById('reset-language-filter');
        langBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const lang = this.getAttribute('data-language');
                langBtns.forEach(b => b.classList.remove('language-filter-active'));
                this.classList.add('language-filter-active');
                currentLanguageFilter = lang;
                setCookie('selected_library_language', lang, 30);
                updateNavigationLanguage(lang);
                updateCategoryButtonLabels(lang);
                updateLanguageButtonLabels(lang);
                applyFilters();
            });
        });
        if (resetBtn) {
            resetBtn.addEventListener('click', function(e) {
                e.preventDefault();
                langBtns.forEach(b => b.classList.remove('language-filter-active'));
                const harBtn = document.querySelector('.language-filter-btn[data-language="harari"]');
                if (harBtn) harBtn.classList.add('language-filter-active');
                currentLanguageFilter = 'harari';
                setCookie('selected_library_language', 'harari', 30);
                updateNavigationLanguage('harari');
                updateCategoryButtonLabels('harari');
                updateLanguageButtonLabels('harari');
                applyFilters();
            });
        }
        const initialLang = document.querySelector(`.language-filter-btn[data-language="${currentLanguageFilter}"]`);
        if (initialLang) initialLang.classList.add('language-filter-active');
        else document.querySelector('.language-filter-btn[data-language="harari"]')?.classList.add('language-filter-active');
    }

    // ==================== PREVIEW MODAL FUNCTIONS ====================
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }
        if (modalId === 'previewModal') {
            const iframe = document.getElementById('pdfIframe');
            if (iframe) iframe.src = '';
        }
    }

    function showPreviewSection(section) {
        const sections = {
            pdf: document.getElementById('pdfPreview'),
            text: document.getElementById('textPreview'),
            unsupported: document.getElementById('unsupportedPreview'),
            loading: document.getElementById('previewLoading'),
            error: document.getElementById('previewError')
        };
        Object.values(sections).forEach(el => {
            if (el) el.classList.add('hidden');
        });
        if (sections[section]) sections[section].classList.remove('hidden');
    }

    function loadPdfPreview(file) {
        const iframe = document.getElementById('pdfIframe');
        if (!iframe) return;
        iframe.src = file.url;
        const timeout = setTimeout(() => {
            iframe.src = `https://docs.google.com/viewer?url=${encodeURIComponent(file.url)}&embedded=true`;
            const fallback = setTimeout(() => showPreviewSection('error'), 5000);
            iframe.onload = () => { clearTimeout(fallback); showPreviewSection('pdf'); };
        }, 3000);
        iframe.onload = () => { clearTimeout(timeout); showPreviewSection('pdf'); };
        iframe.onerror = () => { clearTimeout(timeout); iframe.src = `https://docs.google.com/viewer?url=${encodeURIComponent(file.url)}&embedded=true`; };
    }

    async function loadTextPreview(file) {
        try {
            const response = await fetch(file.url, { credentials: 'same-origin' });
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            let text = await response.text();
            const maxLen = 100000;
            if (text.length > maxLen) text = text.substring(0, maxLen) + '\n\n... (preview truncated)';
            const textContent = document.getElementById('textContent');
            if (textContent) textContent.textContent = text;
            showPreviewSection('text');
        } catch (err) {
            console.error(err);
            const textContent = document.getElementById('textContent');
            if (textContent) textContent.textContent = `Unable to load file content.\nError: ${err.message}`;
            showPreviewSection('text');
        }
    }

    function loadPreview(file) {
        if (file.extension === 'pdf') loadPdfPreview(file);
        else if (file.extension === 'txt') loadTextPreview(file);
        else showPreviewSection('unsupported');
    }

    function openPreviewModal(button) {
        const file = {
            id: button.getAttribute('data-file-id'),
            name: button.getAttribute('data-file-name'),
            extension: button.getAttribute('data-file-extension').toLowerCase(),
            url: button.getAttribute('data-file-url'),
            downloadUrl: button.getAttribute('data-download-url')
        };
        document.getElementById('previewFileName').textContent = file.name;
        document.getElementById('previewFileType').textContent = `${file.extension.toUpperCase()} File`;
        const downloadBtn = document.getElementById('previewDownloadBtn');
        if (downloadBtn) downloadBtn.href = file.downloadUrl;
        const unsupportedBtn = document.getElementById('unsupportedDownloadBtn');
        if (unsupportedBtn) unsupportedBtn.href = file.downloadUrl;
        const errorBtn = document.getElementById('errorDownloadBtn');
        if (errorBtn) errorBtn.href = file.downloadUrl;
        showPreviewSection('loading');
        const modal = document.getElementById('previewModal');
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        loadPreview(file);
    }

    // ==================== GLOBAL EVENT LISTENERS ====================
    function initializeEventListeners() {
        // Preview button clicks
        document.addEventListener('click', function(e) {
            const previewBtn = e.target.closest('.preview-file-btn');
            if (previewBtn) {
                e.preventDefault();
                e.stopPropagation();
                openPreviewModal(previewBtn);
            }
        });
        // Close modal buttons
        const closePreviewBtn = document.getElementById('closePreviewBtn');
        const closeUnsupportedBtn = document.getElementById('closeUnsupportedBtn');
        const closeErrorBtn = document.getElementById('closeErrorBtn');
        [closePreviewBtn, closeUnsupportedBtn, closeErrorBtn].forEach(btn => {
            if (btn) {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    closeModal('previewModal');
                });
            }
        });
        // Click outside to close
        window.addEventListener('click', (e) => {
            const previewModal = document.getElementById('previewModal');
            if (previewModal && e.target === previewModal) closeModal('previewModal');
        });
    }

    // ==================== DOM READY ====================
    document.addEventListener('DOMContentLoaded', function() {
        const savedNavLang = getCookie('selected_library_language') || 'harari';
        currentLanguageFilter = savedNavLang;
        updateNavigationLanguage(savedNavLang);
        initializeLanguageFilter();
        initializeCategoryFilter();
        initializeEventListeners();
        updateCategoryButtonLabels(currentLanguageFilter);
        updateLanguageButtonLabels(currentLanguageFilter);
        applyFilters();
    });
</script>
    @endpush
</x-app-layout>