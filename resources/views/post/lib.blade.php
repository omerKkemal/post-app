<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Library Management') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Manage your document library
                </p>
            </div>
            <button type="button"
                    id="addFileBtn"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200">
                <i class="fas fa-plus-circle mr-2"></i>
                Add New File
            </button>
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

            <!-- Library Files Grid -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Your Library Files ({{ $libraries->count() }})
                    </h3>

                    @if($libraries->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="libraryGrid">
                            @foreach($libraries as $library)
                                <div class="library-item bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                                    <!-- File Preview -->
                                    <div class="flex items-center justify-center h-32 bg-white rounded-lg mb-3 border">
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
                                        @endphp
                                        <i class="{{ $iconClass }} text-4xl"></i>
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
                                        <a href="{{ route('library.download', $library->id) }}"
                                           class="inline-flex items-center px-3 py-1 text-xs bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                            <i class="fas fa-download mr-1"></i>
                                            Download
                                        </a>
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
                        <div class="text-center py-12">
                            <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No files in your library</h3>
                            <p class="text-gray-500 mb-4">Start by uploading your first document</p>
                            <button type="button"
                                    id="addFileBtnEmpty"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200">
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

                <form id="uploadForm" enctype="multipart/form-data">
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadModal = document.getElementById('uploadModal');
        const deleteModal = document.getElementById('deleteModal');
        const addFileBtn = document.getElementById('addFileBtn');
        const addFileBtnEmpty = document.getElementById('addFileBtnEmpty');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const uploadForm = document.getElementById('uploadForm');
        const fileDropZone = document.getElementById('fileDropZone');
        const fileInput = document.getElementById('fileDocument');
        const fileInfo = document.getElementById('fileInfo');
        const selectedFileName = document.getElementById('selectedFileName');
        const removeFileBtn = document.getElementById('removeFile');
        const submitBtn = document.getElementById('submitBtn');

        let fileToDelete = null;

        // Modal controls
        [addFileBtn, addFileBtnEmpty].forEach(btn => {
            if (btn) {
                btn.addEventListener('click', () => {
                    uploadModal.classList.remove('hidden');
                });
            }
        });

        [closeModalBtn, cancelBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                uploadModal.classList.add('hidden');
                resetForm();
            });
        });

        // File drop zone
        fileDropZone.addEventListener('click', () => fileInput.click());

        fileDropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileDropZone.classList.add('border-blue-500', 'bg-blue-50');
        });

        fileDropZone.addEventListener('dragleave', () => {
            fileDropZone.classList.remove('border-blue-500', 'bg-blue-50');
        });

        fileDropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            fileDropZone.classList.remove('border-blue-500', 'bg-blue-50');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileSelect(files[0]);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });

        function handleFileSelect(file) {
            // Validate file type
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please select a valid file type (PDF, DOC, DOCX, TXT, XLS, XLSX, PPT, PPTX)');
                return;
            }

            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB');
                return;
            }

            selectedFileName.textContent = file.name;
            fileInfo.classList.remove('hidden');
        }

        removeFileBtn.addEventListener('click', () => {
            fileInput.value = '';
            fileInfo.classList.add('hidden');
        });

        // Form submission
        uploadForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(uploadForm);
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

            try {
                const response = await fetch('{{ route("library.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const result = await response.json();

                if (result.success) {
                    uploadModal.classList.add('hidden');
                    resetForm();
                    location.reload(); // Refresh to show new file
                } else {
                    alert(result.message || 'Upload failed');
                }
            } catch (error) {
                alert('An error occurred during upload');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-upload mr-2"></i>Upload File';
            }
        });

        function resetForm() {
            uploadForm.reset();
            fileInfo.classList.add('hidden');
        }

        // Delete functionality
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-file-btn')) {
                const btn = e.target.closest('.delete-file-btn');
                fileToDelete = btn.dataset.fileId;
                document.getElementById('deleteFileName').textContent = btn.dataset.fileName;
                deleteModal.classList.remove('hidden');
            }
        });

        document.getElementById('cancelDeleteBtn').addEventListener('click', () => {
            deleteModal.classList.add('hidden');
            fileToDelete = null;
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', async () => {
            if (!fileToDelete) return;

            try {
                const response = await fetch(`{{ url('/library') }}/${fileToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const result = await response.json();

                if (result.success) {
                    deleteModal.classList.add('hidden');
                    location.reload(); // Refresh to remove deleted file
                } else {
                    alert(result.message || 'Delete failed');
                }
            } catch (error) {
                alert('An error occurred during deletion');
            }
        });
    });
    </script>
</x-app-layout>
