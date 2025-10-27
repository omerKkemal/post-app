<x-app-layout>

@push('styles')
    {{-- Per-page stylesheet for post view (kept public and separate from global Tailwind) --}}
    <link href="{{ asset('css/postView.css') }}" rel="stylesheet">
@endpush

    <main id="main-content" class="flex-grow container mx-auto px-4 py-8 fade-in">
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </main>

        <!-- Post view scripts moved to resources/js/postview-extra.js -->
    </x-app-layout>
                // Auto-hide error after 5 seconds
                setTimeout(() => {
                    errorDiv.classList.add('hidden');
                }, 5000);
            }
        }

        // Retry function
        function retryLoadMore() {
            console.log('Retrying load more...');
            const errorDiv = document.getElementById('error-message');
            if (errorDiv) {
                errorDiv.classList.add('hidden');
            }
            handleLoadMore();
        }

        function createPostElement(post) {
            console.log('Creating post element for:', post.title);

            const article = document.createElement('article');
            article.className = 'post-card bg-white rounded-lg shadow-md overflow-hidden mb-6 fade-in';

            // Format the description
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

        // Test function
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
    </script>

    @stack('scripts')
</body>
</html>
