@vite(['resources/css/view.css', 'resources/js/app.js'])
<style>
    /* Slideshow styles */
    .slideshow-container {
        position: relative;
        height: 500px;
    }

    .slideshow-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.5s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        background: black;
    }

    .slideshow-slide.active {
        opacity: 1;
        z-index: 10;
    }

    .slideshow-slide img,
    .slideshow-slide video {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .slideshow-nav {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slideshow-dot.active {
        background-color: #3b82f6 !important;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create') }}
            </h2>
        </div>
    </x-slot>

    <!-- Public Post Content -->
    <div class="max-w-4xl mx-auto px-4 py-6">
        <!-- Posts Container -->
        <div id="posts-container" class="space-y-6">
            <!-- Language Filter and Category Filter Container -->
            <div class="mb-8 space-y-6">
                <!-- Language Filter Dropdown -->
                <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-100">
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
                        <button class="filter-btn language-filter-btn" data-language="english">
                            <span class="english language-badge">English</span>
                            <span class="harari hidden1 language-badge">እንግሊዝኛ</span>
                            <span class="amharic hidden1 language-badge">እንግሊዝኛ</span>
                        </button>
                        <button class="filter-btn language-filter-btn" data-language="harari">
                            <span class="english language-badge">Harari</span>
                            <span class="harari hidden1 language-badge">ሀረሪ</span>
                            <span class="amharic hidden1 language-badge">ሀረሪ</span>
                        </button>
                        <button class="filter-btn language-filter-btn" data-language="amharic">
                            <span class="english language-badge">Amharic</span>
                            <span class="harari hidden1 language-badge">አማርኛ</span>
                            <span class="amharic hidden1 language-badge">አማርኛ</span>
                        </button>
                    </div>
                </div>

                <!-- Filter by Category -->
                <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                        </svg>
                        Filter by Category
                    </h3>
                    <div class="flex flex-wrap gap-3" id="category-filters-container">
                        <!-- All Categories button - dynamic based on selected language -->
                        <button class="filter-btn category-filter-btn category-filter-active" data-category="all" data-language="all">
                            <span class="category-badge" data-en="All Categories" data-har="ሁሉም ምድቦች" data-am="ሁሉም ምድቦች">All Categories</span>
                        </button>

                        @foreach ($categories as $category)
                            <button class="filter-btn category-filter-btn"
                                    data-category="{{ $category->name }}"
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

            <!-- Harari Posts -->
            @foreach ($posts_harari as $post)
            <article class="harari post-card fade-in" data-category="{{ $post->category ?? 'uncategorized' }}" data-language="harari">
                <!-- Post header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Posted on <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('M d, Y') }}</time>
                                </p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="inline-flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Public Post
                            </span>
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                    <div class="flex flex-wrap gap-2">
                        <span class="category-tag">{{ $post->category ?? 'Uncategorized' }}</span>
                        <span class="language-tag bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                            Harari
                        </span>
                    </div>
                </div>

                <!-- Post body -->
                <div class="p-6">
                    <div class="prose">
                        @php
                            $lines = preg_split('/\r\n|\r|\n/', $post->description);
                        @endphp

                        @foreach ($lines as $line)
                            @php $trim = trim($line); @endphp

                            @if (str_starts_with($trim, '**') && str_ends_with($trim, '**'))
                                <h3>{{ trim($trim, '*') }}</h3>

                            @elseif (str_starts_with($trim, '*'))
                                <ul>
                                    <li>{{ ltrim($trim, '* ') }}</li>
                                </ul>

                            @elseif (str_starts_with($trim, '-'))
                                <p>{{ ltrim($trim, '- ') }}</p>

                            @else
                                <p>{{ $trim }}</p>
                            @endif
                        @endforeach
                    </div>

                    @if ($post->media_url)
                        @php
                            $mediaFiles = explode(',', $post->media_url);
                            $hasMultipleFiles = count($mediaFiles) > 1;
                        @endphp

                        @if ($hasMultipleFiles)
                            <!-- Slideshow for multiple files -->
                            <div class="mt-6 relative slideshow-wrapper">
                                <div class="slideshow-container rounded-lg overflow-hidden bg-black relative h-[500px]">
                                    @foreach ($mediaFiles as $index => $mediaFile)
                                        @php
                                            $extension = pathinfo($mediaFile, PATHINFO_EXTENSION);
                                        @endphp

                                        <div class="slideshow-slide absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-500 flex items-center justify-center @if($index === 0) active opacity-100 z-10 @endif" data-slide-index="{{ $index }}">
                                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ Storage::url($mediaFile) }}"
                                                     alt="Post Image {{ $index + 1 }}"
                                                     class="max-w-full max-h-full object-contain">
                                            @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                                <video controls class="max-w-full max-h-full">
                                                    <source src="{{ Storage::url($mediaFile) }}" type="video/{{ $extension }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach

                                    <!-- Navigation arrows -->
                                    @if (count($mediaFiles) > 1)
                                        <button class="slideshow-nav slideshow-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all z-20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                        <button class="slideshow-nav slideshow-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all z-20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    @endif

                                    <!-- Dots indicator -->
                                    @if (count($mediaFiles) > 1)
                                        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-20">
                                            @foreach ($mediaFiles as $index => $mediaFile)
                                                <button class="slideshow-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all @if($index === 0) active bg-opacity-100 @endif" data-slide-index="{{ $index }}"></button>
                                            @endforeach
                                        </div>

                                        <!-- Slide counter -->
                                        <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm z-20">
                                            <span class="slideshow-counter">1</span> / {{ count($mediaFiles) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <!-- Single file display -->
                            @php
                                $mediaFile = trim($mediaFiles[0]);
                                $extension = pathinfo($mediaFile, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ Storage::url($mediaFile) }}" alt="Post Image" class="rounded-lg mt-4 max-w-full h-auto">
                            @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                <video controls class="rounded-lg mt-4 max-w-full h-auto">
                                    <source src="{{ Storage::url($mediaFile) }}" type="video/{{ $extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endif
                    @endif

                    @if ($post->Youtube_link)
                        <div class="mt-4">
                            <iframe width="100%" height="400" src="{{ $post->Youtube_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded-lg"></iframe>
                        </div>
                    @endif
                </div>

                <!-- Post footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img
                                src="{{ asset('image/logo.jpg') }}"
                                alt="{{ config('app.name', 'Laravel') }}"
                                class="relative w-10 h-10 rounded-full object-cover border-2 border-white shadow-lg transition-all duration-300 group-hover:shadow-xl group-hover:border-blue-200 dark:border-gray-600"
                                loading="eager"
                            />
                        </div>
                        <div>
                            <h1 class="">ሀረሪ መጀሊስ</h1>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach

            <!-- English Posts -->
            @foreach ($posts_english as $post)
            <article class="english post-card fade-in" data-category="{{ $post->category ?? 'uncategorized' }}" data-language="english">
                <!-- Post header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Posted on <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('M d, Y') }}</time>
                                </p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="inline-flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Public Post
                            </span>
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                    <div class="flex flex-wrap gap-2">
                        <span class="category-tag">{{ $post->category ?? 'Uncategorized' }}</span>
                        <span class="language-tag bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                            English
                        </span>
                    </div>
                </div>

                <!-- Post body -->
                <div class="p-6">
                    <div class="prose">
                        @php
                            $lines = preg_split('/\r\n|\r|\n/', $post->description);
                        @endphp

                        @foreach ($lines as $line)
                            @php $trim = trim($line); @endphp

                            @if (str_starts_with($trim, '**') && str_ends_with($trim, '**'))
                                <h3>{{ trim($trim, '*') }}</h3>

                            @elseif (str_starts_with($trim, '*'))
                                <ul>
                                    <li>{{ ltrim($trim, '* ') }}</li>
                                </ul>

                            @elseif (str_starts_with($trim, '-'))
                                <p>{{ ltrim($trim, '- ') }}</p>

                            @else
                                <p>{{ $trim }}</p>
                            @endif
                        @endforeach
                    </div>

                    @if ($post->media_url)
                        @php
                            $mediaFiles = explode(',', $post->media_url);
                            $hasMultipleFiles = count($mediaFiles) > 1;
                        @endphp

                        @if ($hasMultipleFiles)
                            <!-- Slideshow for multiple files -->
                            <div class="mt-6 relative slideshow-wrapper">
                                <div class="slideshow-container rounded-lg overflow-hidden bg-black relative h-[500px]">
                                    @foreach ($mediaFiles as $index => $mediaFile)
                                        @php
                                            $extension = pathinfo($mediaFile, PATHINFO_EXTENSION);
                                        @endphp

                                        <div class="slideshow-slide absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-500 flex items-center justify-center @if($index === 0) active opacity-100 z-10 @endif" data-slide-index="{{ $index }}">
                                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ Storage::url($mediaFile) }}"
                                                     alt="Post Image {{ $index + 1 }}"
                                                     class="max-w-full max-h-full object-contain">
                                            @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                                <video controls class="max-w-full max-h-full">
                                                    <source src="{{ Storage::url($mediaFile) }}" type="video/{{ $extension }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach

                                    <!-- Navigation arrows -->
                                    @if (count($mediaFiles) > 1)
                                        <button class="slideshow-nav slideshow-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all z-20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                        <button class="slideshow-nav slideshow-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all z-20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    @endif

                                    <!-- Dots indicator -->
                                    @if (count($mediaFiles) > 1)
                                        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-20">
                                            @foreach ($mediaFiles as $index => $mediaFile)
                                                <button class="slideshow-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all @if($index === 0) active bg-opacity-100 @endif" data-slide-index="{{ $index }}"></button>
                                            @endforeach
                                        </div>

                                        <!-- Slide counter -->
                                        <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm z-20">
                                            <span class="slideshow-counter">1</span> / {{ count($mediaFiles) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <!-- Single file display -->
                            @php
                                $mediaFile = trim($mediaFiles[0]);
                                $extension = pathinfo($mediaFile, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ Storage::url($mediaFile) }}" alt="Post Image" class="rounded-lg mt-4 max-w-full h-auto">
                            @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                <video controls class="rounded-lg mt-4 max-w-full h-auto">
                                    <source src="{{ Storage::url($mediaFile) }}" type="video/{{ $extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endif
                    @endif

                    @if ($post->Youtube_link)
                        <div class="mt-4">
                            <iframe width="100%" height="400" src="{{ $post->Youtube_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded-lg"></iframe>
                        </div>
                    @endif
                </div>

                <!-- Post footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img
                                src="{{ asset('image/logo.jpg') }}"
                                alt="{{ config('app.name', 'Laravel') }}"
                                class="relative w-10 h-10 rounded-full object-cover border-2 border-white shadow-lg transition-all duration-300 group-hover:shadow-xl group-hover:border-blue-200 dark:border-gray-600"
                                loading="eager"
                            />
                        </div>
                        <div>
                            <h1 class="">{{ config('app.name', 'Laravel') }}</h1>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach

            <!-- Amharic Posts -->
            @foreach ($posts_amharic as $post)
            <article class="amharic post-card fade-in" data-category="{{ $post->category ?? 'uncategorized' }}" data-language="amharic">
                <!-- Post header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Posted on <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('M d, Y') }}</time>
                                </p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="inline-flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Public Post
                            </span>
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                    <div class="flex flex-wrap gap-2">
                        <span class="category-tag">{{ $post->category ?? 'Uncategorized' }}</span>
                        <span class="language-tag bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">
                            Amharic
                        </span>
                    </div>
                </div>

                <!-- Post body -->
                <div class="p-6">
                    <div class="prose">
                        @php
                            $lines = preg_split('/\r\n|\r|\n/', $post->description);
                        @endphp

                        @foreach ($lines as $line)
                            @php $trim = trim($line); @endphp

                            @if (str_starts_with($trim, '**') && str_ends_with($trim, '**'))
                                <h3>{{ trim($trim, '*') }}</h3>

                            @elseif (str_starts_with($trim, '*'))
                                <ul>
                                    <li>{{ ltrim($trim, '* ') }}</li>
                                </ul>

                            @elseif (str_starts_with($trim, '-'))
                                <p>{{ ltrim($trim, '- ') }}</p>

                            @else
                                <p>{{ $trim }}</p>
                            @endif
                        @endforeach
                    </div>

                    @if ($post->media_url)
                        @php
                            $mediaFiles = explode(',', $post->media_url);
                            $hasMultipleFiles = count($mediaFiles) > 1;
                        @endphp

                        @if ($hasMultipleFiles)
                            <!-- Slideshow for multiple files -->
                            <div class="mt-6 relative slideshow-wrapper">
                                <div class="slideshow-container rounded-lg overflow-hidden bg-black relative h-[500px]">
                                    @foreach ($mediaFiles as $index => $mediaFile)
                                        @php
                                            $extension = pathinfo($mediaFile, PATHINFO_EXTENSION);
                                        @endphp

                                        <div class="slideshow-slide absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-500 flex items-center justify-center @if($index === 0) active opacity-100 z-10 @endif" data-slide-index="{{ $index }}">
                                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ Storage::url($mediaFile) }}"
                                                     alt="Post Image {{ $index + 1 }}"
                                                     class="max-w-full max-h-full object-contain">
                                            @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                                <video controls class="max-w-full max-h-full">
                                                    <source src="{{ Storage::url($mediaFile) }}" type="video/{{ $extension }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach

                                    <!-- Navigation arrows -->
                                    @if (count($mediaFiles) > 1)
                                        <button class="slideshow-nav slideshow-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all z-20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                        <button class="slideshow-nav slideshow-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all z-20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    @endif

                                    <!-- Dots indicator -->
                                    @if (count($mediaFiles) > 1)
                                        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-20">
                                            @foreach ($mediaFiles as $index => $mediaFile)
                                                <button class="slideshow-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all @if($index === 0) active bg-opacity-100 @endif" data-slide-index="{{ $index }}"></button>
                                            @endforeach
                                        </div>

                                        <!-- Slide counter -->
                                        <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm z-20">
                                            <span class="slideshow-counter">1</span> / {{ count($mediaFiles) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <!-- Single file display -->
                            @php
                                $mediaFile = trim($mediaFiles[0]);
                                $extension = pathinfo($mediaFile, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ Storage::url($mediaFile) }}" alt="Post Image" class="rounded-lg mt-4 max-w-full h-auto">
                            @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                <video controls class="rounded-lg mt-4 max-w-full h-auto">
                                    <source src="{{ Storage::url($mediaFile) }}" type="video/{{ $extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endif
                    @endif

                    @if ($post->Youtube_link)
                        <div class="mt-4">
                            <iframe width="100%" height="400" src="{{ $post->Youtube_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded-lg"></iframe>
                        </div>
                    @endif
                </div>

                <!-- Post footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img
                                src="{{ asset('image/logo.jpg') }}"
                                alt="{{ config('app.name', 'Laravel') }}"
                                class="relative w-10 h-10 rounded-full object-cover border-2 border-white shadow-lg transition-all duration-300 group-hover:shadow-xl group-hover:border-blue-200 dark:border-gray-600"
                                loading="eager"
                            />
                        </div>
                        <div>
                            <h1 class="">ሐረሪ ኮንግረስ</h1>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Load More Section -->
        <div id="load-more-container" class="text-center mt-8 mb-8">
            <button id="load-more-btn" class="btn btn-primary">
                <span>Load More Posts</span>
                <div id="load-more-spinner" class="loading-spinner hidden ml-2"></div>
            </button>
            <p id="no-more-posts" class="no-more-posts hidden">You've reached the end! No more posts to load.</p>
        </div>
    </div>

    <!-- Add this CSS to your view.css file -->
    <style>
        .category-filter-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: white;
            color: #6b7280;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .category-filter-btn:hover {
            border-color: #3b82f6;
            color: #3b82f6;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .category-filter-active {
            border-color: #3b82f6;
            background: #3b82f6;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }

        .category-filter-active:hover {
            border-color: #2563eb;
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }

        .category-badge {
            font-weight: 600;
            font-size: 14px;
        }

        .category-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            height: 24px;
            padding: 0 6px;
            background: #f3f4f6;
            color: #6b7280;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .category-filter-active .category-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .category-filter-btn:hover .category-count {
            background: #e5e7eb;
            color: #374151;
        }

        .category-tag {
            display: inline-block;
            padding: 4px 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .language-tag {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 2px 8px;
            border-radius: 9999px;
        }

        /* Animation for filter changes */
        .post-card {
            transition: all 0.3s ease;
        }

        .post-card.hidden {
            opacity: 0;
            transform: translateY(-10px);
            height: 0;
            margin: 0;
            overflow: hidden;
        }

        /* Load More Button Styles */
        .btn {
            padding: 10px 20px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #2563eb;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .loading-spinner {
            border: 2px solid #f3f4f6;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
        }

        .no-more-posts {
            color: #6b7280;
            font-style: italic;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive design */
        @media (max-width: 640px) {
            .category-filter-btn {
                padding: 8px 12px;
                font-size: 13px;
            }

            .category-count {
                min-width: 20px;
                height: 20px;
                font-size: 11px;
            }

            .language-filter-btn {
                padding: 6px 12px;
                font-size: 0.75rem;
            }
        }
    </style>

    <!-- Filter Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const languageFilterButtons = document.querySelectorAll('.language-filter-btn');
            const categoryFilterButtons = document.querySelectorAll('.category-filter-btn');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const posts = document.querySelectorAll('.post-card');
            const resetLanguageFilter = document.getElementById('reset-language-filter');

            // Cookie functions
            function setCookie(name, value, days) {
                const expires = new Date();
                expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
            }

            function getCookie(name) {
                const nameEQ = name + '=';
                const ca = document.cookie.split(';');
                for(let i = 0; i < ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            // Language filter functionality
            let currentLanguageFilter = getCookie('selected_language') || 'all';
            let currentCategoryFilter = 'all';

            // Function to hide/show navigation language spans
            function updateNavigationLanguage(language) {
                // Hide all navigation spans first
                document.querySelectorAll('.nav-eng, .nav-har, .nav-am').forEach(span => {
                    span.style.display = 'none';
                });

                // Show only the navigation spans for the selected language
                switch(language) {
                    case 'english':
                    case 'all': // When "all" is selected, show English
                        document.querySelectorAll('.nav-eng').forEach(span => {
                            span.style.display = 'inline';
                        });
                        break;
                    case 'harari':
                        document.querySelectorAll('.nav-har').forEach(span => {
                            span.style.display = 'inline';
                        });
                        break;
                    case 'amharic':
                        document.querySelectorAll('.nav-am').forEach(span => {
                            span.style.display = 'inline';
                        });
                        break;
                }
            }

            // Function to update category button labels based on selected language
            function updateCategoryButtonLabels(language) {
                categoryFilterButtons.forEach(button => {
                    const badge = button.querySelector('.category-badge');
                    if (badge) {
                        // Get the language-specific text from data attributes
                        let text = '';
                        switch(language) {
                            case 'harari':
                                text = badge.getAttribute('data-har') || badge.getAttribute('data-en');
                                break;
                            case 'amharic':
                                text = badge.getAttribute('data-am') || badge.getAttribute('data-en');
                                break;
                            case 'english':
                            case 'all':
                            default:
                                text = badge.getAttribute('data-en');
                                break;
                        }

                        // Update the button text
                        if (text) {
                            badge.textContent = text;
                        }
                    }
                });
            }

            function updateLanguageButtonLabels(language) {
                languageFilterButtons.forEach(button => {
                    const englishSpan = button.querySelector('.english');
                    const harariSpan = button.querySelector('.harari');
                    const amharicSpan = button.querySelector('.amharic');
                    if (!englishSpan || !harariSpan || !amharicSpan) return;

                    englishSpan.style.display = 'none';
                    harariSpan.style.display = 'none';
                    amharicSpan.style.display = 'none';

                    switch(language) {
                        case 'harari':
                            harariSpan.style.display = 'inline';
                            break;
                        case 'amharic':
                            amharicSpan.style.display = 'inline';
                            break;
                        case 'english':
                        case 'all':
                        default:
                            englishSpan.style.display = 'inline';
                            break;
                    }
                });
            }

            // Initialize language filter
            function initializeLanguageFilter() {
                languageFilterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const language = this.getAttribute('data-language');

                        // Update active state
                        languageFilterButtons.forEach(btn => {
                            btn.classList.remove('language-filter-active');
                        });
                        this.classList.add('language-filter-active');

                        // Update current filter
                        currentLanguageFilter = language;
                        setCookie('selected_language', language, 30);

                        // Update navigation language spans
                        updateNavigationLanguage(language);

                        // Update category and language button labels
                        updateCategoryButtonLabels(language);
                        updateLanguageButtonLabels(language);

                        // Apply filters
                        applyFilters();
                    });
                });
            }

            // Initialize category filter
            function initializeCategoryFilter() {
                categoryFilterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const category = this.getAttribute('data-category');

                        // Update active state
                        categoryFilterButtons.forEach(btn => {
                            btn.classList.remove('category-filter-active');
                        });
                        this.classList.add('category-filter-active');

                        // Update current filter
                        currentCategoryFilter = category;

                        // Apply filters
                        applyFilters();
                    });
                });
            }

            // Apply both language and category filters
            function applyFilters() {
                let visibleCount = 0;

                posts.forEach(post => {
                    const postLanguage = post.getAttribute('data-language') ||
                                        Array.from(post.classList).find(cls =>
                                            ['harari', 'english', 'amharic'].includes(cls)
                                        ) || 'unknown';

                    const postCategory = post.getAttribute('data-category');

                    // Check language filter
                    const languageMatch = currentLanguageFilter === 'all' ||
                                        postLanguage === currentLanguageFilter;

                    // Check category filter
                    const categoryMatch = currentCategoryFilter === 'all' ||
                                        postCategory === currentCategoryFilter;

                    if (languageMatch && categoryMatch) {
                        post.style.display = 'block';
                        setTimeout(() => {
                            post.style.opacity = '1';
                            post.style.transform = 'translateY(0)';
                        }, 50);
                        visibleCount++;
                    } else {
                        post.style.opacity = '0';
                        post.style.transform = 'translateY(-10px)';
                        setTimeout(() => {
                            post.style.display = 'none';
                        }, 300);
                    }
                });

                // Show message if no posts visible
                const noPostsMessage = document.getElementById('no-posts-message');
                if (visibleCount === 0) {
                    if (!noPostsMessage) {
                        const message = document.createElement('div');
                        message.id = 'no-posts-message';
                        message.className = 'text-center py-12 bg-white rounded-lg border border-gray-200';
                        message.innerHTML = `
                            <div class="max-w-md mx-auto">
                                <div class="mb-4">
                                    <svg class="h-16 w-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No Posts Found</h3>
                                <p class="text-gray-600">No posts match your current filters. Try selecting different filters.</p>
                            </div>
                        `;
                        document.getElementById('posts-container').appendChild(message);
                    }
                } else if (noPostsMessage) {
                    noPostsMessage.remove();
                }
            }

            // Reset language filter
            if (resetLanguageFilter) {
                resetLanguageFilter.addEventListener('click', function() {
                    languageFilterButtons.forEach(btn => {
                        btn.classList.remove('language-filter-active');
                    });
                    const englishBtn = document.querySelector('.language-filter-btn[data-language="english"]');
                    if (englishBtn) englishBtn.classList.add('language-filter-active');
                    currentLanguageFilter = 'english';
                    setCookie('selected_language', 'english', 30);

                    // Update navigation language spans to show English
                    updateNavigationLanguage('english');

                    // Reset category button labels to English
                    updateCategoryButtonLabels('english');
                    updateLanguageButtonLabels('english');

                    applyFilters();
                });
            }

            // Initialize filters
            initializeLanguageFilter();
            initializeCategoryFilter();

            // Set initial active language button
            const initialLanguageBtn = document.querySelector(`.language-filter-btn[data-language="${currentLanguageFilter}"]`);
            if (initialLanguageBtn) {
                initialLanguageBtn.classList.add('language-filter-active');
            } else {
                const englishBtn = document.querySelector('.language-filter-btn[data-language="english"]');
                if (englishBtn) englishBtn.classList.add('language-filter-active');
            }

            // Apply initial filters and set initial navigation language
            updateNavigationLanguage(currentLanguageFilter);
            updateCategoryButtonLabels(currentLanguageFilter);
            updateLanguageButtonLabels(currentLanguageFilter);
            applyFilters();

            // Initialize slideshows
            initializeSlideshows();
        });

        // Initialize slideshows
        function initializeSlideshows() {
            document.querySelectorAll('.slideshow-container').forEach(container => {
                const slides = container.querySelectorAll('.slideshow-slide');
                const prevBtn = container.querySelector('.slideshow-prev');
                const nextBtn = container.querySelector('.slideshow-next');
                const dots = container.querySelectorAll('.slideshow-dot');
                const counter = container.querySelector('.slideshow-counter');

                let currentSlide = 0;
                let slideInterval = null;

                function resetInterval() {
                    if (slideInterval) {
                        clearInterval(slideInterval);
                    }
                    if (slides.length > 1) {
                        slideInterval = setInterval(nextSlide, 5000);
                    }
                }

                function showSlide(index) {
                    // Hide all slides
                    slides.forEach(slide => {
                        slide.classList.remove('active');
                        slide.style.zIndex = '0';
                    });

                    // Remove active class from all dots
                    dots.forEach(dot => {
                        dot.classList.remove('active');
                    });

                    // Show current slide
                    slides[index].classList.add('active');
                    slides[index].style.zIndex = '10';

                    if (dots.length > 0) {
                        dots[index].classList.add('active');
                    }

                    // Update counter
                    if (counter) {
                        counter.textContent = index + 1;
                    }

                    currentSlide = index;
                }

                function nextSlide() {
                    let nextIndex = currentSlide + 1;
                    if (nextIndex >= slides.length) {
                        nextIndex = 0;
                    }
                    showSlide(nextIndex);
                }

                function prevSlide() {
                    let prevIndex = currentSlide - 1;
                    if (prevIndex < 0) {
                        prevIndex = slides.length - 1;
                    }
                    showSlide(prevIndex);
                }

                // Event listeners for navigation
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        nextSlide();
                        resetInterval();
                    });
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        prevSlide();
                        resetInterval();
                    });
                }

                // Event listeners for dots
                dots.forEach(dot => {
                    dot.addEventListener('click', function() {
                        const slideIndex = parseInt(this.getAttribute('data-slide-index'));
                        showSlide(slideIndex);
                        resetInterval();
                    });
                });

                // Auto-advance slides (optional)
                if (slides.length > 1) {
                    resetInterval();

                    // Pause auto-advance on hover
                    container.addEventListener('mouseenter', () => {
                        if (slideInterval) {
                            clearInterval(slideInterval);
                        }
                    });

                    container.addEventListener('mouseleave', resetInterval);
                }

                // Keyboard navigation
                container.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        prevSlide();
                        resetInterval();
                    }
                    if (e.key === 'ArrowRight') {
                        nextSlide();
                        resetInterval();
                    }
                });

                // Focus for accessibility
                container.setAttribute('tabindex', '0');

                // Initialize first slide
                showSlide(0);
            });
        }
    </script>
</x-app-layout>
