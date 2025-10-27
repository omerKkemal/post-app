// Extracted media handling and form helpers from post/create.blade.php
document.addEventListener('DOMContentLoaded', function () {
    // Character counters
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const titleCounter = document.getElementById('titleCounter');
    const descriptionCounter = document.getElementById('descriptionCounter');

    if (titleInput && titleCounter) {
        titleInput.addEventListener('input', function() { titleCounter.textContent = `${this.value.length}/100 characters`; });
        titleCounter.textContent = `${titleInput.value.length}/100 characters`;
    }

    if (descriptionInput && descriptionCounter) {
        descriptionInput.addEventListener('input', function() { descriptionCounter.textContent = `${this.value.length}/5000 characters`; });
        descriptionCounter.textContent = `${descriptionInput.value.length}/5000 characters`;
    }

    // Formatting toolbar
    const formattingToolbar = document.getElementById('formattingToolbar');
    if (formattingToolbar && descriptionInput) {
        formattingToolbar.addEventListener('click', function(e) {
            if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                const button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
                const format = button.dataset.format;
                const start = descriptionInput.selectionStart; const end = descriptionInput.selectionEnd;
                const selectedText = descriptionInput.value.substring(start, end);
                let newText = '';
                let newCursorPos = start;
                switch(format) {
                    case 'bold': newText = '**' + selectedText + '**'; newCursorPos = start + 2; break;
                    case 'italic': newText = '*' + selectedText + '*'; newCursorPos = start + 1; break;
                    case 'bullet': newText = '- ' + (selectedText || 'List item'); newCursorPos = start + 2; break;
                    case 'heading': newText = '**' + (selectedText || 'Heading') + '**\n'; newCursorPos = start + 2; break;
                }
                descriptionInput.value = descriptionInput.value.substring(0, start) + newText + descriptionInput.value.substring(end);
                descriptionInput.setSelectionRange(newCursorPos, newCursorPos); descriptionInput.focus();
                descriptionCounter.textContent = `${descriptionInput.value.length}/5000 characters`;
            }
        });
    }

    // Media upload functionality
    const mediaInput = document.getElementById('media');
    const mediaDropZone = document.getElementById('mediaDropZone');
    const mediaSelectButton = document.getElementById('mediaSelectButton');
    const previewContainer = document.getElementById('previewContainer');

    if (mediaSelectButton && mediaInput) mediaSelectButton.addEventListener('click', () => mediaInput.click());

    if (mediaDropZone) {
        mediaDropZone.addEventListener('dragover', (e) => { e.preventDefault(); mediaDropZone.classList.add('border-blue-500', 'bg-blue-50'); });
        mediaDropZone.addEventListener('dragleave', (e) => { e.preventDefault(); mediaDropZone.classList.remove('border-blue-500', 'bg-blue-50'); });
        mediaDropZone.addEventListener('drop', (e) => {
            e.preventDefault(); mediaDropZone.classList.remove('border-blue-500', 'bg-blue-50');
            const file = e.dataTransfer.files && e.dataTransfer.files[0]; if (file) processFile(file);
        });
    }

    if (mediaInput) mediaInput.addEventListener('change', function(event) { const file = event.target.files && event.target.files[0]; if (file) processFile(file); });

    function processFile(file) {
        const maxSize = 10 * 1024 * 1024; const validTypes = ['image/jpeg','image/png','image/gif','video/mp4','video/webm'];
        if (!validTypes.includes(file.type)) { showNotification('Please select a valid image or video file', 'error'); return; }
        if (file.size > maxSize) { showNotification('File size must be less than 10MB', 'error'); return; }
        previewContainer.innerHTML = '';
        const url = URL.createObjectURL(file);
        const card = document.createElement('div'); card.className = 'relative bg-gray-50 rounded-lg p-4 border border-gray-200';
        card.innerHTML = `
            <div class="flex items-start justify-between">
                <div class="flex items-center space-x-4 flex-1">
                    <div class="flex-shrink-0 w-20 h-20 bg-white rounded-lg overflow-hidden">
                        ${file.type.startsWith('image/') ? `<img src="${url}" alt="${file.name}" class="w-full h-full object-cover">` : `<video src="${url}" class="w-full h-full object-cover" preload="metadata"></video>`}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-medium text-gray-900 truncate">${file.name}</h4>
                        <p class="text-sm text-gray-500">${formatFileSize(file.size)}</p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2"><div class="bg-green-600 h-2 rounded-full transition-all duration-300 upload-progress" style="width: 0%"></div></div>
                    </div>
                </div>
                <button type="button" class="remove-media flex-shrink-0 p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Remove file"><i class="fas fa-times"></i></button>
            </div>`;
        previewContainer.appendChild(card);
        simulateUploadProgress(card);
        const removeButton = card.querySelector('.remove-media');
        removeButton.addEventListener('click', function() { URL.revokeObjectURL(url); previewContainer.removeChild(card); mediaInput.value = ''; });
    }

    function simulateUploadProgress(card) { const progressBar = card.querySelector('.upload-progress'); let progress = 0; const interval = setInterval(() => { progress += Math.random() * 15; if (progress >= 100) { progress = 100; clearInterval(interval); } progressBar.style.width = progress + '%'; }, 100); }

    function formatFileSize(bytes) { if (bytes === 0) return '0 Bytes'; const k = 1024; const sizes = ['Bytes','KB','MB','GB']; const i = Math.floor(Math.log(bytes)/Math.log(k)); return parseFloat((bytes/Math.pow(k,i)).toFixed(2)) + ' ' + sizes[i]; }

    function showNotification(message, type = 'info') { const notification = document.createElement('div'); notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white z-50 transform transition-transform duration-300 ${ type === 'error' ? 'bg-red-500' : 'bg-blue-500' }`; notification.textContent = message; document.body.appendChild(notification); setTimeout(() => { notification.remove(); }, 5000); }

    // Save draft
    const saveDraftButton = document.getElementById('saveDraft'); if (saveDraftButton) saveDraftButton.addEventListener('click', function() { showNotification('Draft saved successfully!', 'success'); });

    // Form submission handling
    const postForm = document.getElementById('postForm'); const submitButton = document.getElementById('submitButton');
    if (postForm && submitButton) {
        postForm.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            const category = document.getElementById('category').value;
            if (!title) { e.preventDefault(); showNotification('Please enter a title', 'error'); return; }
            if (!description) { e.preventDefault(); showNotification('Please enter post content', 'error'); return; }
            if (!category) { e.preventDefault(); showNotification('Please select a category', 'error'); return; }
            submitButton.disabled = true; submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
        });
    }
});
