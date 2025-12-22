@extends('layouts.app')

@section('title', 'Library Management')
@section('description', 'Manage your document library')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header with Button -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Library Management
                    </h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Manage your document library
                    </p>
                </div>
            </div>
        </div>

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

        <!-- Category Filter -->
        <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Filter by Category
                </h3>
                <div class="flex flex-wrap gap-2" id="categoryFilters">
                    <button class="filter-btn px-3 py-1.5 text-sm font-medium rounded-full transition-all duration-200 bg-blue-600 text-white hover:bg-blue-700"
                            data-category="all">
                        All Categories
                    </button>
                    @foreach($categories as $category)
                        <button class="filter-btn px-3 py-1.5 text-sm font-medium rounded-full transition-all duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200"
                                data-category="{{ $category->id }}">
                            {{ $category->name }}
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
                    <div id="activeCategory" class="text-sm text-gray-600 hidden">
                        Filtered by: <span class="font-medium" id="currentCategory"></span>
                        <button id="clearFilter" class="ml-2 text-blue-600 hover:text-blue-800">✕ Clear</button>
                    </div>
                </div>

                @if($libraries->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="libraryGrid">
                        @foreach($libraries as $library)
                            <div class="library-item bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow duration-200"
                                 data-category="{{ $library->category_id ?? 'uncategorized' }}"
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
                                        // Use direct file URL for preview
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
                                    <button type="button"
                                            class="delete-file-btn inline-flex items-center px-3 py-1 text-xs bg-red-600 hover:bg-red-700 text-white rounded-md transition-colors"
                                            data-file-id="{{ $library->id }}"
                                            data-file-name="{{ $library->name }}">
                                        <i class="fas fa-trash mr-1"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12" id="noFilesMessage">
                        <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No files in your library</h3>
                        <p class="text-gray-500 mb-4">Start by uploading your first document</p>
                        <button type="button"
                                id="addFileBtnEmpty"
                                class="add-file-btn inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Add Your First File
                        </button>
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
                            name="category_id"
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900">Delete File</h3>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-500">
                    Are you sure you want to delete "<span id="deleteFileName"></span>"? This action cannot be undone.
                </p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button"
                        id="cancelDeleteBtn"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">
                    Cancel
                </button>
                <button type="button"
                        id="confirmDeleteBtn"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors">
                    <i class="fas fa-trash mr-2"></i>
                    Delete
                </button>
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

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Library Management script loaded');

    // Initialize all modals first
    initializeModals();

    // Initialize event listeners
    initializeEventListeners();

    // Initialize filter
    filterByCategory('all');
});

function initializeModals() {
    // Make sure modals are properly initialized
    const uploadModal = document.getElementById('uploadModal');
    const deleteModal = document.getElementById('deleteModal');
    const previewModal = document.getElementById('previewModal');

    // Set initial state
    if (uploadModal) uploadModal.style.display = 'none';
    if (deleteModal) deleteModal.style.display = 'none';
    if (previewModal) previewModal.style.display = 'none';
}

function initializeEventListeners() {
    // Add file buttons
    document.addEventListener('click', function(e) {
        // Add file button
        if (e.target.closest('.add-file-btn')) {
            e.preventDefault();
            console.log('Add file button clicked');
            const uploadModal = document.getElementById('uploadModal');
            if (uploadModal) {
                uploadModal.classList.remove('hidden');
                uploadModal.style.display = 'flex';
            }
        }

        // Preview button
        if (e.target.closest('.preview-file-btn')) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Preview button clicked');
            const button = e.target.closest('.preview-file-btn');
            openPreviewModal(button);
        }

        // Delete button
        if (e.target.closest('.delete-file-btn')) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Delete button clicked');
            const button = e.target.closest('.delete-file-btn');
            openDeleteModal(button);
        }
    });

    // Upload modal close buttons
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    [closeModalBtn, cancelBtn].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                closeModal('uploadModal');
                resetForm();
            });
        }
    });

    // Delete modal buttons
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeModal('deleteModal');
        });
    }

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            deleteFile();
        });
    }

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

    // File upload functionality
    const fileDropZone = document.getElementById('fileDropZone');
    const fileInput = document.getElementById('fileDocument');
    const removeFileBtn = document.getElementById('removeFile');
    const uploadForm = document.getElementById('uploadForm');

    if (fileDropZone && fileInput) {
        fileDropZone.addEventListener('click', function(e) {
            e.preventDefault();
            fileInput.click();
        });

        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });
    }

    if (removeFileBtn) {
        removeFileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (fileInput) fileInput.value = '';
            const fileInfo = document.getElementById('fileInfo');
            if (fileInfo) fileInfo.classList.add('hidden');
        });
    }

    if (uploadForm) {
        uploadForm.addEventListener('submit', handleFormSubmit);
    }

    // Filter functionality
    const categoryFilters = document.getElementById('categoryFilters');
    const clearFilter = document.getElementById('clearFilter');

    if (categoryFilters) {
        categoryFilters.addEventListener('click', function(e) {
            if (e.target.closest('.filter-btn')) {
                const filterBtn = e.target.closest('.filter-btn');
                const category = filterBtn.getAttribute('data-category');
                filterByCategory(category);
            }
        });
    }

    if (clearFilter) {
        clearFilter.addEventListener('click', function(e) {
            e.preventDefault();
            filterByCategory('all');
        });
    }

    // Close modals when clicking outside
    window.addEventListener('click', function(e) {
        // Upload modal
        const uploadModal = document.getElementById('uploadModal');
        if (uploadModal && e.target === uploadModal) {
            closeModal('uploadModal');
            resetForm();
        }

        // Delete modal
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal && e.target === deleteModal) {
            closeModal('deleteModal');
        }

        // Preview modal
        const previewModal = document.getElementById('previewModal');
        if (previewModal && e.target === previewModal) {
            closeModal('previewModal');
        }
    });
}

// Modal functions
function openDeleteModal(button) {
    const fileId = button.dataset.fileId;
    const fileName = button.dataset.fileName;

    // Store file ID for deletion
    window.currentFileToDelete = fileId;

    // Update modal content
    document.getElementById('deleteFileName').textContent = fileName;

    // Show modal
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.classList.remove('hidden');
        deleteModal.style.display = 'flex';
    }
}

async function deleteFile() {
    if (!window.currentFileToDelete) {
        alert('No file selected for deletion');
        return;
    }

    const deleteBtn = document.getElementById('confirmDeleteBtn');
    const originalText = deleteBtn.innerHTML;

    try {
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Deleting...';

        const response = await fetch(`/library/${window.currentFileToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (result.success) {
            closeModal('deleteModal');
            // Show success message
            alert('File deleted successfully!');
            // Reload page to reflect changes
            window.location.reload();
        } else {
            alert(result.message || 'Failed to delete file');
        }
    } catch (error) {
        console.error('Delete error:', error);
        alert('An error occurred while deleting the file');
    } finally {
        deleteBtn.disabled = false;
        deleteBtn.innerHTML = originalText;
        window.currentFileToDelete = null;
    }
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

        // Try alternative approach for local files
        try {
            // If it's a local file URL, try to fetch from a dedicated endpoint
            if (file.url.includes('/library/view/')) {
                const altResponse = await fetch(`/library/preview-text/${file.id}`, {
                    credentials: 'same-origin'
                });

                if (altResponse.ok) {
                    const text = await altResponse.text();
                    const textContent = document.getElementById('textContent');

                    const maxLength = 100000;
                    let displayText = text.length > maxLength ?
                        text.substring(0, maxLength) + '\n\n... (preview truncated)' :
                        text;

                    textContent.textContent = displayText;
                    showPreviewSection('text');
                    return;
                }
            }
        } catch (altError) {
            console.error('Alternative text load also failed:', altError);
        }

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

    // Clean up delete reference
    if (modalId === 'deleteModal') {
        window.currentFileToDelete = null;
    }
}

// File upload functions
function handleFileSelect(file) {
    // Validate file type
    const allowedExtensions = ['.pdf', '.doc', '.docx', '.txt', '.xls', '.xlsx', '.ppt', '.pptx'];
    const fileExtension = '.' + file.name.split('.').pop().toLowerCase();

    if (!allowedExtensions.includes(fileExtension)) {
        alert('Please select a valid file type (PDF, DOC, DOCX, TXT, XLS, XLSX, PPT, PPTX)');
        return;
    }

    // Validate file size (10MB)
    if (file.size > 10 * 1024 * 1024) {
        alert('File size must be less than 10MB');
        return;
    }

    const selectedFileName = document.getElementById('selectedFileName');
    const fileInfo = document.getElementById('fileInfo');

    if (selectedFileName) selectedFileName.textContent = file.name;
    if (fileInfo) fileInfo.classList.remove('hidden');
}

async function handleFormSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;

    // Validate file is selected
    const fileInput = document.getElementById('fileDocument');
    if (!fileInput.files[0]) {
        alert('Please select a file to upload');
        return;
    }

    try {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

        const formData = new FormData(form);

        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const result = await response.json();

        if (result.success) {
            closeModal('uploadModal');
            resetForm();
            alert('File uploaded successfully!');
            window.location.reload();
        } else {
            alert(result.message || 'Upload failed');
        }
    } catch (error) {
        console.error('Upload error:', error);
        alert('An error occurred during upload');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
}

function resetForm() {
    const uploadForm = document.getElementById('uploadForm');
    const fileInfo = document.getElementById('fileInfo');
    const fileInput = document.getElementById('fileDocument');

    if (uploadForm) uploadForm.reset();
    if (fileInfo) fileInfo.classList.add('hidden');
    if (fileInput) fileInput.value = '';
}

// Filter functions
function filterByCategory(categoryId) {
    const items = document.querySelectorAll('.library-item');
    let visibleCount = 0;

    items.forEach(item => {
        const itemCategory = item.getAttribute('data-category');

        if (categoryId === 'all' || categoryId === itemCategory) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    // Update file count
    const fileCount = document.getElementById('fileCount');
    if (fileCount) {
        fileCount.textContent = `(${visibleCount})`;
    }

    // Update active filter display
    const activeCategory = document.getElementById('activeCategory');
    if (categoryId === 'all') {
        if (activeCategory) activeCategory.classList.add('hidden');
    } else {
        if (activeCategory) {
            activeCategory.classList.remove('hidden');
            const filterBtn = document.querySelector(`[data-category="${categoryId}"]`);
            const currentCategory = document.getElementById('currentCategory');
            if (currentCategory && filterBtn) {
                currentCategory.textContent = filterBtn.textContent.trim();
            }
        }
    }

    // Update filter button states
    updateFilterButtons(categoryId);
}

function updateFilterButtons(activeCategoryId) {
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        const category = btn.getAttribute('data-category');
        if (category === activeCategoryId) {
            btn.classList.remove('bg-gray-100', 'text-gray-700');
            btn.classList.add('bg-blue-600', 'text-white');
        } else {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('bg-gray-100', 'text-gray-700');
        }
    });
}
</script>
@endpush

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
</style>
