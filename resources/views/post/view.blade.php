<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('create') }}
        </h2>
    </x-slot>

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

            <!-- Post content -->
            @foreach ($posts as $post)
            <article class="post-card bg-white rounded-lg shadow-md overflow-hidden">
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
            <!-- Optional Scripts -->
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Back to top button
        window.addEventListener('scroll', function() {
            const backToTopButton = document.getElementById('back-to-top');
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0');
                backToTopButton.classList.add('opacity-100');
            } else {
                backToTopButton.classList.remove('opacity-100');
                backToTopButton.classList.add('opacity-0');
            }
        });

        document.getElementById('back-to-top').addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Close flash messages after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Add hover effects to post cards
        document.querySelectorAll('.post-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });
    </script>

    @stack('scripts')
</x-app-layout>
