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
        <!-- Posts Container -->
        <div id="posts-container" class="space-y-6">
            <!-- Filter by Category -->
            <div class="mb-8 p-6 bg-white rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                    </svg>
                    Filter by Category
                </h3>
                <div class="flex flex-wrap gap-3" id="category-filters-container">
                    <button class="filter-btn category-filter-btn category-filter-active" data-category="all">
                        <span class="category-badge">All Categories</span>
                    </button>
                    @foreach ($categories as $category)
                        <button class="filter-btn category-filter-btn" data-category="{{ $category->name }}">
                            <span class="category-badge">{{ $category->name }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            @foreach ($posts as $post)
            <article class="post-card fade-in" data-category="{{ $post->category ?? 'uncategorized' }}" data-post-id="{{ $post->id }}">
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
                        <div class="flex items-center space-x-4">
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

                            <!-- Delete Button -->
                            <button
                                class="delete-post-btn flex items-center text-red-600 hover:text-red-800 transition-colors hover:bg-red-50 px-3 py-1 rounded-md"
                                data-post-id="{{ $post->id }}"
                                title="Delete Post"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span class="ml-1">Delete</span>
                            </button>
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                    <div class="flex flex-wrap gap-2">
                        <span class="category-tag">{{ $post->category ?? 'Uncategorized' }}</span>
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

                                        <!-- Dots indicator -->
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
                                $extension = pathinfo($mediaFiles[0], PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ Storage::url($mediaFiles[0]) }}" alt="Post Image" class="rounded-lg mt-4 max-w-full h-auto">
                            @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                <video controls class="rounded-lg mt-4 max-w-full h-auto">
                                    <source src="{{ Storage::url($mediaFiles[0]) }}" type="video/{{ $extension }}">
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

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-red-100 flex items-center justify-center mr-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.342 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Delete Post</h3>
                            <p class="text-gray-600">Are you sure you want to delete this post?</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">This action cannot be undone. The post will be permanently removed.</p>
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="delete-modal-cancel" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Cancel
                        </button>
                        <button type="button" id="delete-modal-confirm" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const deleteModal = document.getElementById('delete-modal');
        const deleteModalCancel = document.getElementById('delete-modal-cancel');
        const deleteModalConfirm = document.getElementById('delete-modal-confirm');
        const postsContainer = document.getElementById('posts-container');

        let postToDelete = null;
        let deleteButton = null;

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
                    nextBtn.addEventListener('click', nextSlide);
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', prevSlide);
                }

                // Event listeners for dots
                dots.forEach(dot => {
                    dot.addEventListener('click', function() {
                        const slideIndex = parseInt(this.getAttribute('data-slide-index'));
                        showSlide(slideIndex);
                    });
                });

                // Auto-advance slides (optional)
                if (slides.length > 1) {
                    slideInterval = setInterval(nextSlide, 5000);

                    // Pause auto-advance on hover
                    container.addEventListener('mouseenter', () => {
                        if (slideInterval) {
                            clearInterval(slideInterval);
                        }
                    });

                    container.addEventListener('mouseleave', () => {
                        if (slideInterval) {
                            clearInterval(slideInterval);
                        }
                        slideInterval = setInterval(nextSlide, 5000);
                    });
                }

                // Keyboard navigation
                container.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') prevSlide();
                    if (e.key === 'ArrowRight') nextSlide();
                });

                // Focus for accessibility
                container.setAttribute('tabindex', '0');

                // Initialize first slide
                showSlide(0);
            });
        }

        // Initialize all slideshows on page load
        initializeSlideshows();

        // EVENT DELEGATION - This is the key fix!
        // Attach event listener to the parent container that never gets removed
        postsContainer.addEventListener('click', function(e) {
            // Check if the clicked element is a delete button or inside one
            const deleteBtn = e.target.closest('.delete-post-btn');
            if (deleteBtn) {
                e.preventDefault();
                e.stopPropagation();

                postToDelete = deleteBtn.getAttribute('data-post-id');
                deleteButton = deleteBtn;

                // Show modal
                deleteModal.classList.remove('hidden');
            }
        });

        // Handle modal cancel
        deleteModalCancel.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
            resetModalState();
        });

        // Handle modal confirm
        deleteModalConfirm.addEventListener('click', function() {
            if (!postToDelete || !deleteButton) return;

            // Show loading state on button
            const originalContent = deleteButton.innerHTML;
            deleteButton.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="ml-1">Deleting...</span>
            `;
            deleteButton.disabled = true;

            // Disable modal buttons
            deleteModalConfirm.disabled = true;
            deleteModalCancel.disabled = true;
            deleteModalConfirm.innerHTML = 'Deleting...';

            // Send DELETE request
            fetch(`/posts/${postToDelete}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Find and remove post element
                    const postElement = document.querySelector(`.post-card[data-post-id="${postToDelete}"]`);
                    if (postElement) {
                        // Add fade out animation
                        postElement.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        postElement.style.opacity = '0';
                        postElement.style.transform = 'translateX(-20px)';

                        setTimeout(() => {
                            postElement.remove();
                            showNotification('Post deleted successfully!', 'success');

                            // Check if no posts left
                            const remainingPosts = document.querySelectorAll('.post-card');
                            if (remainingPosts.length === 0) {
                                const noPostsMessage = document.createElement('div');
                                noPostsMessage.className = 'text-center py-12';
                                noPostsMessage.innerHTML = `
                                    <div class="max-w-md mx-auto">
                                        <div class="mb-4">
                                            <svg class="h-16 w-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Posts Found</h3>
                                        <p class="text-gray-600">There are no posts to display. Create your first post!</p>
                                    </div>
                                `;
                                postsContainer.appendChild(noPostsMessage);
                            }
                        }, 300);
                    }

                    // Close modal
                    deleteModal.classList.add('hidden');
                } else {
                    throw new Error(data.error || 'Failed to delete post');
                }
            })
            .catch(error => {
                console.error('Error:', error);

                // Reset button states
                if (deleteButton) {
                    deleteButton.innerHTML = originalContent;
                    deleteButton.disabled = false;
                }

                deleteModalConfirm.disabled = false;
                deleteModalCancel.disabled = false;
                deleteModalConfirm.innerHTML = 'Delete';

                showNotification(error.message || 'An error occurred while deleting the post.', 'error');
            })
            .finally(() => {
                resetModalState();
            });
        });

        // Close modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                deleteModal.classList.add('hidden');
                resetModalState();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                deleteModal.classList.add('hidden');
                resetModalState();
            }
        });

        // Reset modal state
        function resetModalState() {
            postToDelete = null;
            deleteButton = null;
            deleteModalConfirm.disabled = false;
            deleteModalCancel.disabled = false;
            deleteModalConfirm.innerHTML = 'Delete';
        }

        // Notification function
        function showNotification(message, type = 'info') {
            // Remove any existing notifications
            document.querySelectorAll('.notification').forEach(n => n.remove());

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${type === 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'}"></path>
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
                notification.classList.add('translate-x-0');
            }, 10);

            // Remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 5000);

            // Click to dismiss
            notification.addEventListener('click', () => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            });
        }

        // Load more posts functionality
        const loadMoreBtn = document.getElementById('load-more-btn');
        const loadMoreSpinner = document.getElementById('load-more-spinner');
        const noMorePosts = document.getElementById('no-more-posts');
        let clickCount = 0;
        let isLoading = false;

        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                if (isLoading) return;

                isLoading = true;
                loadMoreBtn.disabled = true;
                loadMoreSpinner.classList.remove('hidden');

                clickCount++;

                fetch(`/posts/load-more/${clickCount}/{{ $language ?? 'har' }}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.posts.length > 0) {
                            data.posts.forEach(post => {
                                const mediaFiles = post.media_url || [];
                                const hasMultipleFiles = mediaFiles.length > 1;
                                let mediaHtml = '';

                                if (mediaFiles.length > 0) {
                                    if (hasMultipleFiles) {
                                        mediaHtml = `
                                            <div class="mt-6 relative slideshow-wrapper">
                                                <div class="slideshow-container rounded-lg overflow-hidden bg-black relative h-[500px]">
                                                    ${mediaFiles.map((file, index) => {
                                                        const extension = file.split('.').pop().toLowerCase();
                                                        const isImage = ['jpg', 'jpeg', 'png', 'gif'].includes(extension);
                                                        const isVideo = ['mp4', 'webm', 'ogg'].includes(extension);

                                                        let fileHtml = '';
                                                        if (isImage) {
                                                            fileHtml = `<img src="${file}" alt="Post Image ${index + 1}" class="max-w-full max-h-full object-contain">`;
                                                        } else if (isVideo) {
                                                            fileHtml = `<video controls class="max-w-full max-h-full"><source src="${file}" type="video/${extension}">Your browser does not support the video tag.</video>`;
                                                        }

                                                        return `<div class="slideshow-slide absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-500 flex items-center justify-center ${index === 0 ? 'active opacity-100 z-10' : ''}" data-slide-index="${index}">${fileHtml}</div>`;
                                                    }).join('')}

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

                                                    <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-20">
                                                        ${mediaFiles.map((_, index) => `<button class="slideshow-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all ${index === 0 ? 'active bg-opacity-100' : ''}" data-slide-index="${index}"></button>`).join('')}
                                                    </div>

                                                    <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm z-20">
                                                        <span class="slideshow-counter">1</span> / ${mediaFiles.length}
                                                    </div>
                                                </div>
                                            </div>`;
                                    } else {
                                        const extension = mediaFiles[0].split('.').pop().toLowerCase();
                                        const isImage = ['jpg', 'jpeg', 'png', 'gif'].includes(extension);
                                        const isVideo = ['mp4', 'webm', 'ogg'].includes(extension);

                                        if (isImage) {
                                            mediaHtml = `<img src="${mediaFiles[0]}" alt="Post Image" class="rounded-lg mt-4 max-w-full h-auto">`;
                                        } else if (isVideo) {
                                            mediaHtml = `<video controls class="rounded-lg mt-4 max-w-full h-auto"><source src="${mediaFiles[0]}" type="video/${extension}">Your browser does not support the video tag.</video>`;
                                        }
                                    }
                                }

                                // Parse description lines
                                const lines = post.description.split('\n');
                                let descriptionHtml = '<div class="prose">';

                                lines.forEach(line => {
                                    const trim = line.trim();
                                    if (trim.startsWith('**') && trim.endsWith('**')) {
                                        descriptionHtml += `<h3>${trim.slice(2, -2)}</h3>`;
                                    } else if (trim.startsWith('*')) {
                                        descriptionHtml += `<ul><li>${trim.slice(1).trim()}</li></ul>`;
                                    } else if (trim.startsWith('-')) {
                                        descriptionHtml += `<p>${trim.slice(1).trim()}</p>`;
                                    } else {
                                        descriptionHtml += `<p>${trim}</p>`;
                                    }
                                });

                                descriptionHtml += '</div>';

                                const postElement = document.createElement('article');
                                postElement.className = 'post-card fade-in';
                                postElement.dataset.category = post.category || 'uncategorized';
                                postElement.dataset.postId = post.id;

                                postElement.innerHTML = `
                                    <div class="p-6 border-b border-gray-200">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-3">
                                                <div>
                                                    <p class="text-sm text-gray-500">
                                                        Posted on <time datetime="${post.created_at}">${new Date(post.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</time>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <div class="text-sm text-gray-500">
                                                    <span class="inline-flex items-center">
                                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Public Post
                                                    </span>
                                                </div>
                                                <button class="delete-post-btn flex items-center text-red-600 hover:text-red-800 transition-colors hover:bg-red-50 px-3 py-1 rounded-md" data-post-id="${post.id}" title="Delete Post">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span class="ml-1">Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                        <h1 class="text-2xl font-bold text-gray-900 mb-4">${post.title}</h1>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="category-tag">${post.category || 'Uncategorized'}</span>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        ${descriptionHtml}
                                        ${mediaHtml}
                                        ${post.Youtube_link ? `<div class="mt-4"><iframe width="100%" height="400" src="${post.Youtube_link}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded-lg"></iframe></div>` : ''}
                                    </div>
                                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                    </svg>
                                                    <span>243</span>
                                                </button>
                                                <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                    </svg>
                                                    <span>42</span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                    </svg>
                                                    <span>Share</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                postsContainer.appendChild(postElement);

                                // Re-initialize slideshow for the new post
                                setTimeout(() => {
                                    const newSlideshow = postElement.querySelector('.slideshow-container');
                                    if (newSlideshow) {
                                        initializeSingleSlideshow(newSlideshow);
                                    }
                                }, 100);
                            });

                            if (!data.hasMore) {
                                loadMoreBtn.classList.add('hidden');
                                noMorePosts.classList.remove('hidden');
                            }
                        } else {
                            loadMoreBtn.classList.add('hidden');
                            noMorePosts.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading more posts:', error);
                        showNotification('Error loading more posts. Please try again.', 'error');
                    })
                    .finally(() => {
                        isLoading = false;
                        loadMoreBtn.disabled = false;
                        loadMoreSpinner.classList.add('hidden');
                    });
            });
        }

        // Helper function to initialize a single slideshow
        function initializeSingleSlideshow(container) {
            const slides = container.querySelectorAll('.slideshow-slide');
            const prevBtn = container.querySelector('.slideshow-prev');
            const nextBtn = container.querySelector('.slideshow-next');
            const dots = container.querySelectorAll('.slideshow-dot');
            const counter = container.querySelector('.slideshow-counter');

            let currentSlide = 0;
            let slideInterval = null;

            function showSlide(index) {
                slides.forEach(slide => {
                    slide.classList.remove('active');
                    slide.style.zIndex = '0';
                });

                dots.forEach(dot => {
                    dot.classList.remove('active');
                });

                slides[index].classList.add('active');
                slides[index].style.zIndex = '10';

                if (dots.length > 0) {
                    dots[index].classList.add('active');
                }

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

            if (nextBtn) {
                nextBtn.addEventListener('click', nextSlide);
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', prevSlide);
            }

            dots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const slideIndex = parseInt(this.getAttribute('data-slide-index'));
                    showSlide(slideIndex);
                });
            });

            if (slides.length > 1) {
                slideInterval = setInterval(nextSlide, 5000);

                container.addEventListener('mouseenter', () => {
                    if (slideInterval) {
                        clearInterval(slideInterval);
                    }
                });

                container.addEventListener('mouseleave', () => {
                    if (slideInterval) {
                        clearInterval(slideInterval);
                    }
                    slideInterval = setInterval(nextSlide, 5000);
                });
            }

            container.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prevSlide();
                if (e.key === 'ArrowRight') nextSlide();
            });

            container.setAttribute('tabindex', '0');
            showSlide(0);
        }
    });
    </script>
    @endpush

    <style>
    /* Modal styling */
    #delete-modal {
        display: none;
    }

    #delete-modal:not(.hidden) {
        display: block;
    }

    /* Spinner animation */
    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    /* Delete button hover effect */
    .delete-post-btn:hover {
        background-color: #fef2f2;
    }

    /* Fade in animation for posts */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

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

    /* Load more button styles */
    .loading-spinner {
        border: 2px solid #f3f3f3;
        border-top: 2px solid #3498db;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        animation: spin 1s linear infinite;
    }

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

    .no-more-posts {
        color: #6b7280;
        font-style: italic;
    }
    </style>
</x-app-layout>
