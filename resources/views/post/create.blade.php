<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Create New Post') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Share your thoughts and ideas with the community
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('post.view') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Posts
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                            1
                        </div>
                        <span class="text-sm font-medium text-blue-600">Basic Info</span>
                    </div>
                    <div class="w-12 h-0.5 bg-gray-300"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">
                            2
                        </div>
                        <span class="text-sm font-medium text-gray-500">Content</span>
                    </div>
                    <div class="w-12 h-0.5 bg-gray-300"></div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">
                            3
                        </div>
                        <span class="text-sm font-medium text-gray-500">Media</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 sm:p-8">
                    <!-- Regular form without Alpine.js for basic functionality -->
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" id="postForm">
                        @csrf

                        <!-- Title Section -->
                        <div class="mb-8">
                            <x-input-label for="title" :value="__('Post Title')" class="text-lg font-semibold" />
                            <p class="text-sm text-gray-600 mb-3">
                                Choose a catchy title that describes your post
                            </p>
                            <x-text-input
                                id="title"
                                class="block mt-1 w-full text-lg border-gray-300"
                                type="text"
                                name="title"
                                :value="old('title')"
                                required
                                autofocus
                                placeholder="Enter a compelling title..."
                            />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            <div class="mt-1 text-xs text-gray-500" id="titleCounter">0/100 characters</div>
                        </div>

                        <!-- Description Section -->
                        <div class="mb-8">
                            <x-input-label for="description" :value="__('Post Content')" class="text-lg font-semibold" />
                            <p class="text-sm text-gray-600 mb-3">
                                Write your post content. You can use markdown-style formatting
                            </p>

                            <!-- Formatting Toolbar -->
                            <div class="flex flex-wrap gap-2 mb-3 p-3 bg-gray-50 rounded-lg" id="formattingToolbar">
                                <button type="button" data-format="bold"
                                        class="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100 transition-colors"
                                        title="Bold">
                                    <strong>B</strong>
                                </button>
                                <button type="button" data-format="italic"
                                        class="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100 transition-colors"
                                        title="Italic">
                                    <em>I</em>
                                </button>
                                <button type="button" data-format="bullet"
                                        class="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100 transition-colors"
                                        title="Bullet Point">
                                    •
                                </button>
                                <button type="button" data-format="heading"
                                        class="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100 transition-colors"
                                        title="Heading">
                                    H
                                </button>
                            </div>

                            <textarea
                                id="description"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm min-h-[200px]"
                                name="description"
                                required
                                placeholder="Write your post content here..."
                            >{{ old('description') }}</textarea>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            <div class="mt-1 text-xs text-gray-500" id="descriptionCounter">0/5000 characters</div>
                        </div>

                        <!-- Media Upload Section -->
                        <div class="mb-8">
                            <x-input-label :value="__('Media Attachment')" class="text-lg font-semibold" />
                            <p class="text-sm text-gray-600 mb-3">
                                Add images or videos to enhance your post (Max: 10MB)
                            </p>

                            <div id="mediaDropZone"
                                 class="group relative flex flex-col items-center justify-center gap-4 px-6 py-12 border-2 border-dashed border-gray-300 rounded-xl bg-white hover:border-blue-500 transition-all duration-300 cursor-pointer">

                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 group-hover:text-blue-500 mb-3 transition-colors"></i>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">
                                        Drop your file here
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-4">
                                        or click to browse your files
                                    </p>

                                    <button type="button"
                                            id="mediaSelectButton"
                                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200 transform hover:scale-105">
                                        <i class="fas fa-plus-circle mr-2"></i>
                                        Choose File
                                    </button>

                                    <p class="text-xs text-gray-400 mt-3">
                                        Supports: JPG, PNG, GIF, MP4, WebM (Max 10MB)
                                    </p>
                                </div>

                                <input class="sr-only" type="file" name="media" id="media" accept="image/*,video/*">
                            </div>

                            <x-input-error :messages="$errors->get('media')" class="mt-2" />

                            <!-- Preview Container -->
                            <div id="previewContainer" class="mt-6 grid gap-4"></div>
                        </div>

                        <!-- Category Section -->
                        <div class="mb-8">
                            <x-input-label for="category" :value="__('Category')" class="text-lg font-semibold" />
                            <p class="text-sm text-gray-600 mb-3">
                                Select the most relevant category for your post
                            </p>

                            <div class="relative">
                                <select name="category" id="category"
                                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm py-3 pl-3 pr-10 appearance-none cursor-pointer">
                                    <option value="">Select a category...</option>
                                    <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Technology</option>
                                    <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>Lifestyle</option>
                                    <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Education</option>
                                    <option value="4" {{ old('category') == '4' ? 'selected' : '' }}>Entertainment</option>
                                    <option value="5" {{ old('category') == '5' ? 'selected' : '' }}>Business</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>

                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <!-- Submit Section -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                Your post will be visible to the public after submission
                            </div>

                            <div class="flex items-center space-x-4">
                                <button type="button" id="saveDraft"
                                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
                                    Save Draft
                                </button>

                                <x-primary-button type="submit" class="px-8 py-3 text-base font-medium" id="submitButton">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    Create Post
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Formatting Guide -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-blue-900 mb-3 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Formatting Guide
                </h3>
                <div class="grid md:grid-cols-2 gap-4 text-sm text-blue-800">
                    <div class="space-y-2">
                        <p><strong>**Bold Text**</strong> → <strong>Bold Text</strong></p>
                        <p><em>*Italic Text*</em> → <em>Italic Text</em></p>
                    </div>
                    <div class="space-y-2">
                        <p><strong>**Heading**</strong> → Creates a section heading</p>
                        <p><strong>- Bullet point</strong> → Creates a list item</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Character counters
            const titleInput = document.getElementById('title');
            const descriptionInput = document.getElementById('description');
            const titleCounter = document.getElementById('titleCounter');
            const descriptionCounter = document.getElementById('descriptionCounter');

            if (titleInput && titleCounter) {
                titleInput.addEventListener('input', function() {
                    titleCounter.textContent = `${this.value.length}/100 characters`;
                });
                // Initialize counter
                titleCounter.textContent = `${titleInput.value.length}/100 characters`;
            }

            if (descriptionInput && descriptionCounter) {
                descriptionInput.addEventListener('input', function() {
                    descriptionCounter.textContent = `${this.value.length}/5000 characters`;
                });
                // Initialize counter
                descriptionCounter.textContent = `${descriptionInput.value.length}/5000 characters`;
            }

            // Formatting toolbar functionality
            const formattingToolbar = document.getElementById('formattingToolbar');
            if (formattingToolbar && descriptionInput) {
                formattingToolbar.addEventListener('click', function(e) {
                    if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                        const button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
                        const format = button.dataset.format;

                        const start = descriptionInput.selectionStart;
                        const end = descriptionInput.selectionEnd;
                        const selectedText = descriptionInput.value.substring(start, end);

                        let newText = '';
                        let newCursorPos = start;

                        switch(format) {
                            case 'bold':
                                newText = '**' + selectedText + '**';
                                newCursorPos = start + 2;
                                break;
                            case 'italic':
                                newText = '*' + selectedText + '*';
                                newCursorPos = start + 1;
                                break;
                            case 'bullet':
                                newText = '- ' + (selectedText || 'List item');
                                newCursorPos = start + 2;
                                break;
                            case 'heading':
                                newText = '**' + (selectedText || 'Heading') + '**\n';
                                newCursorPos = start + 2;
                                break;
                        }

                        descriptionInput.value = descriptionInput.value.substring(0, start) +
                                               newText +
                                               descriptionInput.value.substring(end);

                        // Set cursor position
                        descriptionInput.setSelectionRange(newCursorPos, newCursorPos);
                        descriptionInput.focus();

                        // Update character counter
                        descriptionCounter.textContent = `${descriptionInput.value.length}/5000 characters`;
                    }
                });
            }

            // Media upload functionality
            const mediaInput = document.getElementById('media');
            const mediaDropZone = document.getElementById('mediaDropZone');
            const mediaSelectButton = document.getElementById('mediaSelectButton');
            const previewContainer = document.getElementById('previewContainer');

            if (mediaSelectButton && mediaInput) {
                mediaSelectButton.addEventListener('click', () => mediaInput.click());
            }

            if (mediaDropZone) {
                // Drag and drop events
                mediaDropZone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    mediaDropZone.classList.add('border-blue-500', 'bg-blue-50');
                });

                mediaDropZone.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    mediaDropZone.classList.remove('border-blue-500', 'bg-blue-50');
                });

                mediaDropZone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    mediaDropZone.classList.remove('border-blue-500', 'bg-blue-50');
                    const file = e.dataTransfer.files && e.dataTransfer.files[0];
                    if (file) {
                        processFile(file);
                    }
                });
            }

            if (mediaInput) {
                mediaInput.addEventListener('change', function(event) {
                    const file = event.target.files && event.target.files[0];
                    if (file) {
                        processFile(file);
                    }
                });
            }

            function processFile(file) {
                // Validate file
                const maxSize = 10 * 1024 * 1024; // 10MB
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/webm'];

                if (!validTypes.includes(file.type)) {
                    showNotification('Please select a valid image or video file', 'error');
                    return;
                }

                if (file.size > maxSize) {
                    showNotification('File size must be less than 10MB', 'error');
                    return;
                }

                // Clear previous preview
                previewContainer.innerHTML = '';

                // Create preview
                const url = URL.createObjectURL(file);
                const card = document.createElement('div');
                card.className = 'relative bg-gray-50 rounded-lg p-4 border border-gray-200';

                card.innerHTML = `
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-4 flex-1">
                            <div class="flex-shrink-0 w-20 h-20 bg-white rounded-lg overflow-hidden">
                                ${file.type.startsWith('image/') ?
                                    `<img src="${url}" alt="${file.name}" class="w-full h-full object-cover">` :
                                    `<video src="${url}" class="w-full h-full object-cover" preload="metadata"></video>`
                                }
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 truncate">${file.name}</h4>
                                <p class="text-sm text-gray-500">${formatFileSize(file.size)}</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                    <div class="bg-green-600 h-2 rounded-full transition-all duration-300 upload-progress" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="remove-media flex-shrink-0 p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Remove file">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;

                previewContainer.appendChild(card);

                // Simulate upload progress
                simulateUploadProgress(card);

                // Add remove event listener
                const removeButton = card.querySelector('.remove-media');
                removeButton.addEventListener('click', function() {
                    URL.revokeObjectURL(url);
                    previewContainer.removeChild(card);
                    mediaInput.value = '';
                });
            }

            function simulateUploadProgress(card) {
                const progressBar = card.querySelector('.upload-progress');
                let progress = 0;
                const interval = setInterval(() => {
                    progress += Math.random() * 15;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(interval);
                    }
                    progressBar.style.width = progress + '%';
                }, 100);
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white z-50 transform transition-transform duration-300 ${
                    type === 'error' ? 'bg-red-500' : 'bg-blue-500'
                }`;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 5000);
            }

            // Save draft functionality
            const saveDraftButton = document.getElementById('saveDraft');
            if (saveDraftButton) {
                saveDraftButton.addEventListener('click', function() {
                    showNotification('Draft saved successfully!', 'success');
                });
            }

            // Form submission handling
            const postForm = document.getElementById('postForm');
            const submitButton = document.getElementById('submitButton');

            if (postForm && submitButton) {
                postForm.addEventListener('submit', function(e) {
                    // Basic validation
                    const title = document.getElementById('title').value.trim();
                    const description = document.getElementById('description').value.trim();
                    const category = document.getElementById('category').value;

                    if (!title) {
                        e.preventDefault();
                        showNotification('Please enter a title', 'error');
                        return;
                    }

                    if (!description) {
                        e.preventDefault();
                        showNotification('Please enter post content', 'error');
                        return;
                    }

                    if (!category) {
                        e.preventDefault();
                        showNotification('Please select a category', 'error');
                        return;
                    }

                    // Show loading state
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
                });
            }
        });
    </script>

    <style>
        .upload-progress {
            transition: width 0.3s ease;
        }
    </style>
</x-app-layout>
