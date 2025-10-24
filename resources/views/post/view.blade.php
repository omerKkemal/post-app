@vite(['resources/css/view.css', 'resources/js/app.js'])
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
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm text-gray-600" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex items-center">
                <li class="flex items-center">
                    <a href="{{ url('/') }}" class="hover:text-blue-600 transition-colors">Home</a>
                    <svg class="h-4 w-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="#" class="hover:text-blue-600 transition-colors">Posts</a>
                    <svg class="h-4 w-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </li>
                <li class="text-gray-800 font-medium" aria-current="page">Public Post</li>
            </ol>
        </nav>

        <!-- Posts Container -->
        <div id="posts-container" class="space-y-6">
            @foreach ($posts as $post)
            <article class="post-card fade-in">
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
                        <span class="tag">{{ $post->category ?? 'Uncategorized' }}</span>
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
                            $extension = pathinfo($post->media_url, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($post->media_url) }}" alt="Post Image" class="rounded-lg mt-4 max-w-full h-auto">
                        @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                            <video controls class="rounded-lg mt-4 max-w-full h-auto">
                                <source src="{{ Storage::url($post->media_url) }}" type="video/{{ $extension }}">
                                Your browser does not support the video tag.
                            </video>
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
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                <span>243</span>
                            </button>
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span>42</span>
                            </button>
                        </div>
                        <div>
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                <span>Share</span>
                            </button>
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
</x-app-layout>
