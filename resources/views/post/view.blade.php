<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('create') }}
        </h2>
    </x-slot>

    <style>
        :root {
            --color-primary: 59, 130, 246;
            --color-secondary: 107, 114, 128;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: rgb(var(--color-primary));
            color: white;
        }

        .btn-primary:hover {
            background-color: rgba(var(--color-primary), 0.9);
            transform: translateY(-1px);
        }

        .btn-loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .post-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .prose {
            max-width: none;
            line-height: 1.75;
        }

        .prose h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .prose p {
            margin-bottom: 1.25rem;
        }

        .prose ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .prose blockquote {
            border-left: 4px solid rgb(var(--color-primary));
            padding-left: 1rem;
            font-style: italic;
            margin: 1.5rem 0;
        }
    </style>

    <!-- Public Post Content -->
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm text-gray-600" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
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
                <li class="text-gray-800" aria-current="page">Public Post</li>
            </ol>
        </nav>

        <!-- Posts Container -->
        <div id="posts-container">
            <!-- Initial posts loaded from server -->
            @foreach ($posts as $post)
            <article class="post-card bg-white mx-4 my-4 rounded-lg shadow-md overflow-hidden fade-in">
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
                        <span class="tag bg-blue-100 text-blue-800">{{ $post->category ?? 'Uncategorized' }}</span>
                    </div>
                </div>

                <!-- Post body -->
                <div class="p-6 prose">
                    @php
                        $lines = preg_split('/\r\n|\r|\n/', $post->description);
                    @endphp

                    <div class="p-6 prose">
                        @foreach ($lines as $line)
                            @php $trim = trim($line); @endphp

                            @if (str_starts_with($trim, '**') && str_ends_with($trim, '**'))
                                <h3 class="font-semibold text-lg mb-2">{{ trim($trim, '*') }}</h3>

                            @elseif (str_starts_with($trim, '*'))
                                <ul class="list-disc ml-6">
                                    <li>{{ ltrim($trim, '* ') }}</li>
                                </ul>

                            @elseif (str_starts_with($trim, '-'))
                                <p class="text-gray-700 mb-2">{{ ltrim($trim, '- ') }}</p>

                            @else
                                <p class="text-gray-700 mb-2">{{ $trim }}</p>
                            @endif
                        @endforeach
                    </div>

                    @if ($post->media_url)
                        @php
                            $extension = pathinfo($post->media_url, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($post->media_url) }}" alt="Post Image" class="rounded-lg mb-4 max-w-full h-auto">
                        @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                            <video controls class="rounded-lg mb-4 max-w-full h-auto">
                                <source src="{{ Storage::url($post->media_url) }}" type="video/{{ $extension }}">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    @endif

                    @if ($post->Youtube_link)
                        <div class="mt-4">
                            <iframe width="100%" height="400" src="{{ $post->Youtube_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

        <!-- Load More Button -->
        <div id="load-more-container" class="text-center mt-8 mb-8">
            <button id="load-more-btn" class="btn btn-primary">
                <span>Load More Posts</span>
                <svg id="load-more-spinner" class="hidden w-4 h-4 ml-2 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </div>
    </div>

    <script>
        let clickCount = 0;
        let isLoading = false;
        let hasMorePosts = true;

        // Add debug logging
        console.log('Script loaded. Initializing Load More functionality...');

        // Load More functionality - with better event listener
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('load-more-btn');
            console.log('DOM loaded. Button found:', loadMoreBtn);

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', loadMorePosts);
                console.log('Event listener attached to button');
            } else {
                console.error('Load More button not found!');
            }
        });

        // Alternative: Direct event listener (if DOM ready doesn't work)
        const loadMoreBtn = document.getElementById('load-more-btn');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', loadMorePosts);
            console.log('Direct event listener attached');
        }

        async function loadMorePosts() {
            console.log('Load More button clicked!');
            console.log('Current state:', { clickCount, isLoading, hasMorePosts });

            if (isLoading) {
                console.log('Already loading, ignoring click');
                return;
            }

            if (!hasMorePosts) {
                console.log('No more posts to load');
                return;
            }

            isLoading = true;
            const button = document.getElementById('load-more-btn');
            const spinner = document.getElementById('load-more-spinner');

            if (!button) {
                console.error('Button element not found!');
                isLoading = false;
                return;
            }

            // Show loading state
            button.classList.add('btn-loading');
            if (spinner) {
                spinner.classList.remove('hidden');
            }
            button.disabled = true;

            try {
                const pageToLoad = clickCount + 2;
                console.log(`Fetching page: ${pageToLoad}`);

                const lang = window.location.href.split('/');
                const language = lang[lang.length - 1];
                console.log('detected language:', language);
                const response = await fetch(`/load-more-posts/${pageToLoad}/${language}`);

                console.log('Response status:', response.status);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('API response data:', data);

                if (data.posts && data.posts.length > 0) {
                    console.log(`Received ${data.posts.length} posts`);

                    // Append new posts
                    data.posts.forEach((post, index) => {
                        const postElement = createPostElement(post);
                        document.getElementById('posts-container').appendChild(postElement);
                        console.log(`Appended post ${index + 1}`);
                    });

                    // Success - increment click count
                    clickCount++;
                    hasMorePosts = data.hasMore !== false;

                    console.log(`Updated state - clickCount: ${clickCount}, hasMorePosts: ${hasMorePosts}`);

                    if (!hasMorePosts) {
                        console.log('No more posts available');
                        document.getElementById('load-more-container').innerHTML =
                            '<p class="text-gray-500 py-4">You have loaded all posts!</p>';
                    }

                } else {
                    console.log('No posts received from API');
                    hasMorePosts = false;
                    document.getElementById('load-more-container').innerHTML =
                        '<p class="text-gray-500 py-4">No more posts to load.</p>';
                }

            } catch (error) {
                console.error('Error loading more posts:', error);

                // Show user-friendly error
                const errorDiv = document.createElement('div');
                errorDiv.className = 'text-red-500 text-center mt-4 p-3 bg-red-50 rounded-lg';
                errorDiv.innerHTML = `
                    <p>Failed to load posts. Please try again.</p>
                    <button onclick="retryLoadMore()" class="mt-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Retry
                    </button>
                `;

                const container = document.getElementById('load-more-container');
                if (container) {
                    container.appendChild(errorDiv);
                }

            } finally {
                isLoading = false;
                if (button) {
                    button.classList.remove('btn-loading');
                    button.disabled = false;
                }
                if (spinner) {
                    spinner.classList.add('hidden');
                }
                console.log('Load operation completed. isLoading:', isLoading);
            }
        }

        // Retry function
        function retryLoadMore() {
            console.log('Retrying load more...');
            const errorDiv = document.querySelector('.text-red-500');
            if (errorDiv) {
                errorDiv.remove();
            }
            loadMorePosts();
        }

        function createPostElement(post) {
            console.log('Creating post element for:', post.title);

            // Your existing createPostElement function here
            const article = document.createElement('article');
            article.className = 'post-card bg-white mx-4 my-4 rounded-lg shadow-md overflow-hidden fade-in';

            // Format the description with proper line parsing
            const descriptionHtml = formatDescription(post.description);

            // Format media URL
            let mediaHtml = '';
            if (post.media_url) {
                const extension = post.media_url.split('.').pop().toLowerCase();
                if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                    mediaHtml = `<img src="/storage/${post.media_url}" alt="Post Image" class="rounded-lg mb-4 max-w-full h-auto">`;
                } else if (['mp4', 'webm', 'ogg'].includes(extension)) {
                    mediaHtml = `
                        <video controls class="rounded-lg mb-4 max-w-full h-auto">
                            <source src="/storage/${post.media_url}" type="video/${extension}">
                            Your browser does not support the video tag.
                        </video>
                    `;
                }
            }

            article.innerHTML = `
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Posted on <time datetime="${post.created_at}">${new Date(post.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</time>
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

                    <h1 class="text-2xl font-bold text-gray-900 mb-4">${post.title}</h1>

                    <div class="flex flex-wrap gap-2">
                        <span class="tag bg-blue-100 text-blue-800">${post.category || 'Uncategorized'}</span>
                    </div>
                </div>

                <div class="p-6 prose">
                    ${descriptionHtml}
                    ${mediaHtml}
                </div>

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
            `;

            return article;
        }

        function formatDescription(description) {
            // Your existing formatDescription function
            const lines = description.split('\n');
            let html = '';

            lines.forEach(line => {
                const trim = line.trim();

                if (trim.startsWith('**') && trim.endsWith('**')) {
                    html += `<h3 class="font-semibold text-lg mb-2">${trim.slice(2, -2)}</h3>`;
                } else if (trim.startsWith('*')) {
                    html += `<ul class="list-disc ml-6"><li>${trim.slice(1).trim()}</li></ul>`;
                } else if (trim.startsWith('-')) {
                    html += `<p class="text-gray-700 mb-2">${trim.slice(1).trim()}</p>`;
                } else if (trim) {
                    html += `<p class="text-gray-700 mb-2">${trim}</p>`;
                }
            });

            return html;
        }

        // Test function to check if everything is working
        function testLoadMore() {
            console.log('=== Testing Load More Functionality ===');
            console.log('1. Button exists:', !!document.getElementById('load-more-btn'));
            console.log('2. Spinner exists:', !!document.getElementById('load-more-spinner'));
            console.log('3. Posts container exists:', !!document.getElementById('posts-container'));
            console.log('4. Load more container exists:', !!document.getElementById('load-more-container'));
            console.log('5. Current clickCount:', clickCount);
            console.log('6. isLoading:', isLoading);
            console.log('7. hasMorePosts:', hasMorePosts);
            console.log('=== Test Complete ===');
        }

        // Run test on load
        document.addEventListener('DOMContentLoaded', testLoadMore);
    </script>

    @stack('scripts')
</x-app-layout>
