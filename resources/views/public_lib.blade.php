<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Public Library') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Browse and download public documents
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Library Files Grid -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Available Documents ({{ $libraries->count() }})
                    </h3>

                    @if($libraries->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($libraries as $library)
                                <div class="library-item bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                                    <!-- File Preview with Preview Button -->
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
                                            $fileUrl = asset('storage/' . $library->location);
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
                                    <div class="flex items-center justify-center mt-3 pt-3 border-t border-gray-200 space-x-2">
                                        <!-- Preview Button (for previewable files) -->
                                        @if($previewable)
                                            <button type="button"
                                                    class="preview-file-btn inline-flex items-center px-3 py-1.5 text-xs bg-purple-600 hover:bg-purple-700 text-white rounded-md transition-colors"
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
                                           class="inline-flex items-center px-3 py-1.5 text-xs bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                            <i class="fas fa-download mr-1"></i>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No documents available</h3>
                            <p class="text-gray-500">Check back later for new documents</p>
                        </div>
                    @endif
                </div>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Public Library script loaded');

        // Initialize modal
        initializeModal();

        // Initialize event listeners
        initializeEventListeners();
    });

    function initializeModal() {
        // Make sure modal is properly initialized
        const previewModal = document.getElementById('previewModal');
        if (previewModal) {
            previewModal.style.display = 'none';
        }
    }

    function initializeEventListeners() {
        // Preview button
        document.addEventListener('click', function(e) {
            if (e.target.closest('.preview-file-btn')) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Preview button clicked');
                const button = e.target.closest('.preview-file-btn');
                openPreviewModal(button);
            }
        });

        // Preview modal close buttons
        const closePreviewBtn = document.getElementById('closePreviewBtn');
        const closeUnsupportedBtn = document.getElementById('closeUnsupportedBtn');
        const closeErrorBtn = document.getElementById('closeErrorBtn');

        [closePreviewBtn, closeUnsupportedBtn, closeErrorBtn].forEach(btn => {
            if (btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeModal('previewModal');
                });
            }
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const previewModal = document.getElementById('previewModal');
            if (previewModal && e.target === previewModal) {
                closeModal('previewModal');
            }
        });
    }

    function openPreviewModal(button) {
        const fileId = button.dataset.fileId;
        const fileName = button.dataset.fileName;
        const fileExtension = button.dataset.fileExtension.toLowerCase();
        const fileUrl = button.dataset.fileUrl;
        const downloadUrl = button.dataset.downloadUrl;

        console.log('Opening preview for:', fileName, 'Extension:', fileExtension, 'URL:', fileUrl);

        // Store file info
        window.currentPreviewFile = {
            id: fileId,
            name: fileName,
            extension: fileExtension,
            url: fileUrl,
            downloadUrl: downloadUrl
        };

        // Update modal title
        document.getElementById('previewFileName').textContent = fileName;
        document.getElementById('previewFileType').textContent = `${fileExtension.toUpperCase()} File`;

        // Set download URLs for all download buttons
        const previewDownloadBtn = document.getElementById('previewDownloadBtn');
        const unsupportedDownloadBtn = document.getElementById('unsupportedDownloadBtn');
        const errorDownloadBtn = document.getElementById('errorDownloadBtn');

        if (previewDownloadBtn && downloadUrl) {
            previewDownloadBtn.href = downloadUrl;
        }
        if (unsupportedDownloadBtn && downloadUrl) {
            unsupportedDownloadBtn.href = downloadUrl;
        }
        if (errorDownloadBtn && downloadUrl) {
            errorDownloadBtn.href = downloadUrl;
        }

        // Show loading state
        showPreviewSection('loading');

        // Show modal
        const previewModal = document.getElementById('previewModal');
        if (previewModal) {
            previewModal.classList.remove('hidden');
            previewModal.style.display = 'flex';
        }

        // Load preview immediately
        loadPreview(window.currentPreviewFile);
    }

    function loadPreview(file) {
        console.log('Loading preview for file:', file);

        if (file.extension === 'pdf') {
            loadPdfPreview(file);
        } else if (file.extension === 'txt') {
            loadTextPreview(file);
        } else {
            console.log('Unsupported file type:', file.extension);
            showPreviewSection('unsupported');
        }
    }

    function loadPdfPreview(file) {
        console.log('Loading PDF preview for:', file.url);
        const pdfIframe = document.getElementById('pdfIframe');

        // Try direct embedding first (works for same-origin PDFs)
        pdfIframe.src = file.url;

        // Set timeout to check if PDF loaded successfully
        const loadTimeout = setTimeout(() => {
            console.log('PDF load timeout, trying Google Docs viewer');
            // Fallback to Google Docs viewer
            const googleDocsViewer = `https://docs.google.com/viewer?url=${encodeURIComponent(file.url)}&embedded=true`;
            pdfIframe.src = googleDocsViewer;

            // Second fallback timeout
            const fallbackTimeout = setTimeout(() => {
                console.log('Google Docs viewer timeout, showing error');
                showPreviewSection('error');
            }, 5000);

            pdfIframe.onload = () => {
                clearTimeout(fallbackTimeout);
                showPreviewSection('pdf');
            };

        }, 3000);

        pdfIframe.onload = () => {
            console.log('PDF loaded directly');
            clearTimeout(loadTimeout);
            showPreviewSection('pdf');
        };

        pdfIframe.onerror = () => {
            console.log('Direct PDF load failed');
            clearTimeout(loadTimeout);
            // Try Google Docs viewer immediately
            const googleDocsViewer = `https://docs.google.com/viewer?url=${encodeURIComponent(file.url)}&embedded=true`;
            pdfIframe.src = googleDocsViewer;

            const fallbackTimeout = setTimeout(() => {
                console.log('All PDF loading methods failed');
                showPreviewSection('error');
            }, 5000);

            pdfIframe.onload = () => {
                clearTimeout(fallbackTimeout);
                showPreviewSection('pdf');
            };
        };
    }

    async function loadTextPreview(file) {
        console.log('Loading text preview for:', file.url);
        try {
            // Use fetch with credentials for same-origin requests
            const response = await fetch(file.url, {
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error(`Failed to load text file: ${response.status} ${response.statusText}`);
            }

            const text = await response.text();
            console.log('Text loaded successfully, length:', text.length);

            const textContent = document.getElementById('textContent');

            // Truncate very large files
            const maxLength = 100000; // 100KB max for preview
            let displayText = text;

            if (text.length > maxLength) {
                console.log('Text truncated from', text.length, 'to', maxLength);
                displayText = text.substring(0, maxLength) + '\n\n... (preview truncated - file is very large)';
            }

            textContent.textContent = displayText;
            showPreviewSection('text');
        } catch (error) {
            console.error('Error loading text preview:', error);

            // Show error state
            const textContent = document.getElementById('textContent');
            textContent.textContent = `Unable to load file content.\nError: ${error.message}\n\nPlease download the file to view it.`;
            showPreviewSection('text');
        }
    }

    function showPreviewSection(section) {
        console.log('Showing preview section:', section);

        const sections = {
            pdf: document.getElementById('pdfPreview'),
            text: document.getElementById('textPreview'),
            unsupported: document.getElementById('unsupportedPreview'),
            loading: document.getElementById('previewLoading'),
            error: document.getElementById('previewError')
        };

        // Hide all sections
        Object.values(sections).forEach(el => {
            if (el) el.classList.add('hidden');
        });

        // Show selected section
        if (sections[section]) {
            sections[section].classList.remove('hidden');
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }

        // Clean up preview iframe
        if (modalId === 'previewModal') {
            const pdfIframe = document.getElementById('pdfIframe');
            if (pdfIframe) {
                pdfIframe.src = '';
            }
            window.currentPreviewFile = null;
        }
    }
    </script>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Modal styles */
    #previewModal {
        display: none;
        align-items: flex-start;
        justify-content: center;
    }

    #previewModal.hidden {
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
    .preview-file-btn:hover {
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
    </style>
</x-app-layout>
