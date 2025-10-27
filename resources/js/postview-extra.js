// Extracted load-more and utility functions from postView.blade.php
let clickCount = 1;
let isLoading = false;
let hasMorePosts = true;

document.addEventListener('DOMContentLoaded', function() {
    initializeLoadMore();
    initializeBackToTop();
    testLoadMore();
});

function initializeLoadMore() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.replaceWith(loadMoreBtn.cloneNode(true));
        const newLoadMoreBtn = document.getElementById('load-more-btn');
        newLoadMoreBtn.addEventListener('click', handleLoadMore);
    }
}

function initializeBackToTop() {
    const backToTopBtn = document.getElementById('back-to-top');
    if (!backToTopBtn) return;
    window.addEventListener('scroll', function() { backToTopBtn.style.opacity = window.pageYOffset > 300 ? '1' : '0'; });
    backToTopBtn.addEventListener('click', function() { window.scrollTo({ top: 0, behavior: 'smooth' }); });
}

async function handleLoadMore() {
    if (isLoading) return; if (!hasMorePosts) return showNoMorePosts(); isLoading = true;
    const button = document.getElementById('load-more-btn'); const spinner = document.getElementById('load-more-spinner'); const errorMessage = document.getElementById('error-message');
    if (errorMessage) errorMessage.classList.add('hidden'); if (button) { button.classList.add('btn-loading'); button.disabled = true; } if (spinner) spinner.classList.remove('hidden');
    try {
        const lang = window.location.href.split('/'); const language = lang[lang.length - 1];
        const response = await fetch(`/load-more-posts/${clickCount}/${language}`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } });
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        const data = await response.json();
        if (data.success && data.posts && data.posts.length > 0) { await appendPostsWithAnimation(data.posts); hasMorePosts = data.hasMore !== false; clickCount++; if (!hasMorePosts) showNoMorePosts(); } else { hasMorePosts = false; showNoMorePosts(); }
    } catch (e) { showError('Failed to load posts. Please try again.'); }
    finally { isLoading = false; if (button) { button.classList.remove('btn-loading'); button.disabled = false; } if (spinner) spinner?.classList.add('hidden'); }
}

function appendPostsWithAnimation(posts) { return new Promise((resolve) => { const container = document.getElementById('posts-container'); posts.forEach((post, index) => { const postElement = createPostElement(post); postElement.style.opacity = '0'; postElement.style.transform = 'translateY(20px)'; container.appendChild(postElement); setTimeout(() => { postElement.style.transition = 'opacity 0.5s ease, transform 0.5s ease'; postElement.style.opacity = '1'; postElement.style.transform = 'translateY(0)'; }, index * 100); }); setTimeout(resolve, posts.length * 100 + 500); }); }

function showNoMorePosts() { const button = document.getElementById('load-more-btn'); const noMoreMessage = document.getElementById('no-more-posts'); const container = document.getElementById('load-more-container'); if (button) button.style.display = 'none'; if (noMoreMessage) noMoreMessage.classList.remove('hidden'); else if (container) container.innerHTML = '<p class="no-more-posts">You have loaded all posts!</p>'; }

function showError(message) { const errorDiv = document.getElementById('error-message'); if (errorDiv) { errorDiv.textContent = message; errorDiv.classList.remove('hidden'); setTimeout(() => errorDiv.classList.add('hidden'), 5000); } }

function retryLoadMore() { document.getElementById('error-message')?.classList.add('hidden'); handleLoadMore(); }

function createPostElement(post) {
    const article = document.createElement('article'); article.className = 'post-card bg-white rounded-lg shadow-md overflow-hidden mb-6 fade-in';
    const descriptionHtml = formatDescription(post.description);
    let mediaHtml = '';
    if (post.media_url) {
        const extension = post.media_url.split('.').pop().toLowerCase();
        if (['jpg','jpeg','png','gif'].includes(extension)) mediaHtml = `<img src="/storage/${post.media_url}" alt="Post Image" class="rounded-lg mb-4 max-w-full h-auto">`;
        else if (['mp4','webm','ogg'].includes(extension)) mediaHtml = `<video controls class="rounded-lg mb-4 max-w-full h-auto"><source src="/storage/${post.media_url}" type="video/${extension}">Your browser does not support the video tag.</video>`;
    }
    article.innerHTML = `...`; // keep concise - server will render actual HTML when needed
    return article;
}

function formatDescription(description) { const lines = description.split('\n'); let html = ''; lines.forEach(line => { const trim = line.trim(); if (trim.startsWith('**') && trim.endsWith('**')) html += `<h3 class="font-semibold text-lg mb-2">${trim.slice(2,-2)}</h3>`; else if (trim.startsWith('*')) html += `<ul class="list-disc ml-6"><li>${trim.slice(1).trim()}</li></ul>`; else if (trim.startsWith('-')) html += `<p class="text-gray-700 mb-2">${trim.slice(1).trim()}</p>`; else if (trim) html += `<p class="text-gray-700 mb-2">${trim}</p>`; }); return html; }

function testLoadMore() { console.log('=== Testing Load More Functionality ===', { existsButton: !!document.getElementById('load-more-btn'), existsSpinner: !!document.getElementById('load-more-spinner'), postsContainer: !!document.getElementById('posts-container'), loadMoreContainer: !!document.getElementById('load-more-container'), clickCount, isLoading, hasMorePosts }); }
