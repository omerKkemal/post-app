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
