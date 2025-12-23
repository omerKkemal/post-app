document.addEventListener("DOMContentLoaded", () => {
    const loadMoreBtn = document.getElementById("load-more-btn");
    const postsContainer = document.getElementById("posts-container");
    const noMorePostsText = document.getElementById("no-more-posts");
    const spinner = document.getElementById("load-more-spinner");
    const categoryFilterContainer = document.getElementById('category-filters-container');

    if (!loadMoreBtn || !postsContainer) return;

    let clickCount = 1;
    let isLoading = false;
    let hasMore = true;
    let currentFilter = 'all';
    let allCategories = new Set();

    // ✅ Helper: safely parse language from URL
    const parts = window.location.pathname.split("/").filter(Boolean);
    const language = parts[parts.length - 1] || "har";

    // Initialize categories from existing posts
    initializeCategories();

    // Load More functionality
    loadMoreBtn.addEventListener("click", async () => {
        if (isLoading || !hasMore) return;
        isLoading = true;

        loadMoreBtn.disabled = true;
        loadMoreBtn.classList.add("btn-loading");
        spinner.classList.remove("hidden");

        try {
            console.log(`Loading page ${clickCount + 1} for language: ${language}`);

            const response = await fetch(`/load-more-posts/${clickCount}/${language}`);
            const data = await response.json();
            console.log("--->Response:", data);

            if (data.success && data.posts.length > 0) {
                data.posts.forEach(post => {
                    const postHTML = createPostElement(post);
                    postsContainer.insertAdjacentHTML("beforeend", postHTML);

                    // Add new categories to our set
                    if (post.category && !allCategories.has(post.category)) {
                        allCategories.add(post.category);
                        createCategoryFilterButton(post.category);
                    }
                });

                clickCount++;
                hasMore = data.hasMore;

                // Apply current filter to newly loaded posts
                applyFilter(currentFilter);

                if (!hasMore) {
                    loadMoreBtn.classList.add("hidden");
                    noMorePostsText.classList.remove("hidden");
                }
            } else {
                loadMoreBtn.classList.add("hidden");
                noMorePostsText.classList.remove("hidden");
            }
        } catch (error) {
            console.error("Error loading more posts:", error);
        } finally {
            isLoading = false;
            loadMoreBtn.disabled = false;
            loadMoreBtn.classList.remove("btn-loading");
            spinner.classList.add("hidden");
        }
    });

    // Initialize categories from existing posts
    function initializeCategories() {
        const initialPosts = document.querySelectorAll('.post-card');
        initialPosts.forEach(post => {
            const category = post.dataset.category;
            if (category && category !== 'uncategorized') {
                allCategories.add(category);
            }
        });
    }

    // Create new category filter button
    function createCategoryFilterButton(category) {
        const buttonHTML = `
            <button class="filter-btn category-filter-btn" data-category="${category}">
                <span class="category-badge">${category}</span>
            </button>
        `;

        // Insert before the "All Categories" button
        const allButton = categoryFilterContainer.querySelector('[data-category="all"]');
        if (allButton) {
            allButton.insertAdjacentHTML('beforebegin', buttonHTML);
        } else {
            categoryFilterContainer.insertAdjacentHTML('beforeend', buttonHTML);
        }

        // Add event listener to the new button
        const newButton = categoryFilterContainer.querySelector(`[data-category="${category}"]`);
        if (newButton) {
            newButton.addEventListener('click', handleCategoryFilter);
        }
    }

    // Category filter functionality
    function handleCategoryFilter(event) {
        const button = event.currentTarget;
        const category = button.dataset.category;

        // Update active state
        document.querySelectorAll('.category-filter-btn').forEach(btn => {
            btn.classList.remove('category-filter-active');
        });
        button.classList.add('category-filter-active');

        // Apply filter
        currentFilter = category;
        applyFilter(category);
    }

    // Apply filter to posts
    function applyFilter(category) {
        const allPosts = document.querySelectorAll('.post-card');

        allPosts.forEach(post => {
            if (category === 'all' || post.dataset.category === category) {
                post.style.display = 'block';
                post.classList.remove('hidden');
            } else {
                post.style.display = 'none';
                post.classList.add('hidden');
            }
        });
    }

    // Add event listeners to existing filter buttons
    document.querySelectorAll('.category-filter-btn').forEach(button => {
        button.addEventListener('click', handleCategoryFilter);
    });

    // ✅ Creates the same post card markup as your Blade file
    function createPostElement(post) {
        const createdAt = new Date(post.created_at).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });

        // Format description with proper line breaks
        const description = formatDescription(post.description || "");

        let mediaHTML = "";
        const media = post.media_url || "";
        const ext = media.split(".").pop()?.toLowerCase();

        if (media) {
            const mediaUrl = media.startsWith("/storage") ? media : `/storage/${media.replace(/^\/?storage\//, "")}`;

            if (["jpg", "jpeg", "png", "gif"].includes(ext)) {
                mediaHTML = `<img src="${mediaUrl}" alt="Post Image" class="rounded-lg mt-4 max-w-full h-auto">`;
            } else if (["mp4", "webm", "ogg"].includes(ext)) {
                mediaHTML = `
                    <video controls class="rounded-lg mt-4 max-w-full h-auto">
                        <source src="${mediaUrl}" type="video/${ext}">
                        Your browser does not support the video tag.
                    </video>`;
            }
        }

        const youtubeHTML = post.Youtube_link
            ? `<div class="mt-4">
                   <iframe width="100%" height="400" src="${post.Youtube_link}" frameborder="0"
                       allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                       allowfullscreen class="rounded-lg"></iframe>
               </div>`
            : "";

        return `
        <article class="post-card fade-in" data-category="${post.category || "uncategorized"}">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <p class="text-sm text-gray-500">Posted on ${createdAt}</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        <span class="inline-flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274
                                       4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Public Post
                        </span>
                    </div>
                </div>

                <h1 class="text-2xl font-bold text-gray-900 mb-4">${post.title}</h1>
                <div class="flex flex-wrap gap-2">
                    <span class="category-tag">${post.category || "Uncategorized"}</span>
                </div>
            </div>

            <div class="p-6">
                <div class="prose">${description}</div>
                ${mediaHTML}
                ${youtubeHTML}
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0
                                       0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7
                                       20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61
                                       3.61 0 01-.608 2.006L7 11v9m7-10h-2M7
                                       20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>243</span>
                        </button>
                        <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0
                                       4.418-4.03 8-9 8a9.863 9.863 0
                                       01-4.255-.949L3 20l1.395-3.72C3.512
                                       15.042 3 13.574 3 12c0-4.418
                                       4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <span>42</span>
                        </button>
                    </div>
                    <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                        <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8.684 13.342C8.886 12.938 9
                                   12.482 9 12c0-.482-.114-.938-.316-1.342m0
                                   2.684a3 3 0 110-2.684m0 2.684l6.632
                                   3.316m-6.632-6l6.632-3.316m0 0a3
                                   3 0 105.367-2.684 3 3 0
                                   00-5.367 2.684zm0 9.316a3 3 0
                                   105.368 2.684 3 3 0
                                   00-5.368-2.684z" />
                        </svg>
                        <span>Share</span>
                    </button>
                </div>
            </div>
        </article>`;
    }

    // Helper function to format description with proper HTML
    function formatDescription(description) {
        const lines = description.split('\n');
        let html = '';

        lines.forEach(line => {
            const trimmed = line.trim();

            if (trimmed.startsWith('**') && trimmed.endsWith('**')) {
                html += `<h3 class="text-lg font-semibold mt-4 mb-2">${trimmed.slice(2, -2)}</h3>`;
            } else if (trimmed.startsWith('*')) {
                html += `<ul class="list-disc list-inside mb-2"><li>${trimmed.slice(1).trim()}</li></ul>`;
            } else if (trimmed.startsWith('-')) {
                html += `<p class="mb-2">${trimmed.slice(1).trim()}</p>`;
            } else if (trimmed === '') {
                html += '<br>';
            } else {
                html += `<p class="mb-2">${trimmed}</p>`;
            }
        });

        return html;
    }
});

document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const deleteModal = document.getElementById('delete-modal');
        const deleteModalCancel = document.getElementById('delete-modal-cancel');
        const deleteModalConfirm = document.getElementById('delete-modal-confirm');
        const postsContainer = document.getElementById('posts-container');
        const resetLanguageFilter = document.getElementById('reset-language-filter');

        // Language filter functionality
        let currentLanguageFilter = 'all';
        let currentCategoryFilter = 'all';
        const languageFilterButtons = document.querySelectorAll('.language-filter-btn');
        const categoryFilterButtons = document.querySelectorAll('.category-filter-btn');

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

                    // Update category button labels
                    updateCategoryButtonLabels(language);

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
            const posts = document.querySelectorAll('.post-card');
            let visibleCount = 0;

            posts.forEach(post => {
                const postLanguage = Array.from(post.classList).find(cls =>
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
                    post.classList.add('fade-in');
                    visibleCount++;
                } else {
                    post.style.display = 'none';
                    post.classList.remove('fade-in');
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
                    postsContainer.appendChild(message);
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
                document.querySelector('.language-filter-btn[data-language="all"]').classList.add('language-filter-active');
                currentLanguageFilter = 'all';

                // Reset category button labels to English
                updateCategoryButtonLabels('all');

                applyFilters();
            });
        }

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

        // Initialize filters
        initializeLanguageFilter();
        initializeCategoryFilter();

        // Apply initial filters
        applyFilters();

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

                            // Re-apply filters after deletion
                            applyFilters();
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
                                postElement.className = `post-card fade-in ${post.language}`;
                                postElement.dataset.category = post.category || 'uncategorized';
                                postElement.dataset.postId = post.id;

                                // Determine language tag
                                let languageTag = '';
                                let languageClass = '';
                                if (post.language === 'harari') {
                                    languageTag = '<span class="language-tag bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">Harari</span>';
                                    languageClass = 'harari';
                                } else if (post.language === 'english') {
                                    languageTag = '<span class="language-tag bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">English</span>';
                                    languageClass = 'english';
                                } else if (post.language === 'amharic') {
                                    languageTag = '<span class="language-tag bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">Amharic</span>';
                                    languageClass = 'amharic';
                                }

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
                                            ${languageTag}
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

                                // Add language class
                                postElement.classList.add(languageClass);

                                // Re-initialize slideshow for the new post
                                setTimeout(() => {
                                    const newSlideshow = postElement.querySelector('.slideshow-container');
                                    if (newSlideshow) {
                                        initializeSingleSlideshow(newSlideshow);
                                    }

                                    // Apply current filters to new post
                                    const postLanguage = languageClass;
                                    const postCategory = post.category || 'uncategorized';

                                    const languageMatch = currentLanguageFilter === 'all' ||
                                                        postLanguage === currentLanguageFilter;

                                    const categoryMatch = currentCategoryFilter === 'all' ||
                                                        postCategory === currentCategoryFilter;

                                    if (languageMatch && categoryMatch) {
                                        postElement.style.display = 'block';
                                        postElement.classList.add('fade-in');
                                    } else {
                                        postElement.style.display = 'none';
                                        postElement.classList.remove('fade-in');
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
