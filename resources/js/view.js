let clickCount = 0;
let isLoading = false;
let hasMorePosts = true;

document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', loadMorePosts);
    }
});

async function loadMorePosts() {
    if (isLoading || !hasMorePosts) return;

    isLoading = true;
    const button = document.getElementById('load-more-btn');
    const spinner = document.getElementById('load-more-spinner');

    if (button) {
        button.classList.add('btn-loading');
        button.disabled = true;
    }
    if (spinner) {
        spinner.classList.remove('hidden');
    }

    try {
        const pageToLoad = clickCount + 2;
        const lang = window.location.href.split('/');
        const language = lang[lang.length - 1];

        const response = await fetch(`/load-more-posts/${pageToLoad}/${language}`);

        if (!response.ok) throw new Error('Network response was not ok');

        const data = await response.json();

        if (data.posts && data.posts.length > 0) {
            data.posts.forEach(post => {
                const postElement = createPostElement(post);
                document.getElementById('posts-container').appendChild(postElement);
            });

            clickCount++;
            hasMorePosts = data.hasMore !== false;

            if (!hasMorePosts) {
                showNoMorePosts();
            }
        } else {
            hasMorePosts = false;
            showNoMorePosts();
        }

    } catch (error) {
        console.error('Error loading more posts:', error);
        showError('Failed to load posts. Please try again.');
    } finally {
        isLoading = false;
        if (button) {
            button.classList.remove('btn-loading');
            button.disabled = false;
        }
        if (spinner) {
            spinner.classList.add('hidden');
        }
    }
}

function showNoMorePosts() {
    const button = document.getElementById('load-more-btn');
    const noMoreMessage = document.getElementById('no-more-posts');

    if (button) button.style.display = 'none';
    if (noMoreMessage) noMoreMessage.classList.remove('hidden');
}

function showError(message) {
    const container = document.getElementById('load-more-container');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-red-600 bg-red-50 p-3 rounded-lg mt-4';
    errorDiv.innerHTML = `
        <p class="mb-2">${message}</p>
        <button onclick="this.parentElement.remove()" class="text-sm text-red-700 hover:text-red-800">
            Dismiss
        </button>
    `;
    container.appendChild(errorDiv);
}

function createPostElement(post) {
    const article = document.createElement('article');
    article.className = 'post-card fade-in';

    const descriptionHtml = formatDescription(post.description);
    let mediaHtml = '';

    if (post.media_url) {
        const extension = post.media_url.split('.').pop().toLowerCase();
        if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
            mediaHtml = `<img src="/storage/${post.media_url}" alt="Post Image" class="rounded-lg mt-4 max-w-full h-auto">`;
        } else if (['mp4', 'webm', 'ogg'].includes(extension)) {
            mediaHtml = `
                <video controls class="rounded-lg mt-4 max-w-full h-auto">
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
                <span class="tag">${post.category || 'Uncategorized'}</span>
            </div>
        </div>

        <div class="p-6">
            <div class="prose">
                ${descriptionHtml}
            </div>
            ${mediaHtml}
            ${post.Youtube_link ? `
                <div class="mt-4">
                    <iframe width="100%" height="400" src="${post.Youtube_link}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded-lg"></iframe>
                </div>
            ` : ''}
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
            html += `<h3>${trim.slice(2, -2)}</h3>`;
        } else if (trim.startsWith('*')) {
            html += `<ul><li>${trim.slice(1).trim()}</li></ul>`;
        } else if (trim.startsWith('-')) {
            html += `<p>${trim.slice(1).trim()}</p>`;
        } else if (trim) {
            html += `<p>${trim}</p>`;
        }
    });

    return html;
}
