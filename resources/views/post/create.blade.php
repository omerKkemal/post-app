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
                        <!-- Youtube Link Section -->
                        <div class="mb-8">
                            <x-input-label for="Youtube_link" :value="__('YouTube Link (Optional)')" class="text-lg font-semibold" />
                            <p class="text-sm text-gray-600 mb-3">
                                Add a YouTube link to embed a video in your post
                            </p>
                            <x-text-input
                                id="Youtube_link"
                                class="block mt-1 w-full text-lg border-gray-300"
                                type="url"
                                name="Youtube_link"
                                :value="old('Youtube_link')"
                                placeholder="https://www.youtube.com/watch?v=example"
                            />
                            <x-input-error :messages="$errors->get('Youtube_link')" class="mt-2" />
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

                        <!-- Language Section -->
                        <div class="mb-8">
                            <x-input-label for="language" :value="__('Language')" class="text-lg font-semibold" />
                            <p class="text-sm text-gray-600 mb-3">
                                Select the language of your post
                            </p>
                            <div class="relative">
                                <select name="language" id="language"
                                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm py-3 pl-3 pr-10 appearance-none cursor-pointer">
                                    <option value="har" {{ old('language') == 'har' ? 'selected' : '' }}>Harari</option>
                                    <option value="eng" {{ old('language') == 'eng' ? 'selected' : '' }}>English</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>

                            <x-input-error :messages="$errors->get('language')" class="mt-2" />

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
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->name }}" {{ old('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
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

    <!-- Page-specific JS/CSS moved to resources/js/create.js and resources/css/create.css -->
</x-app-layout>
