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

    // Media upload functionality is now handled in the blade template
});

