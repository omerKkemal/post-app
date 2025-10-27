// Extracted from layouts/app.blade.php - initialize global UI behaviors
document.addEventListener('DOMContentLoaded', function() {
    // Remove loading spinner
    function removeLoadingSpinner() {
        const spinner = document.getElementById('loading-spinner');
        if (spinner) {
            spinner.style.transition = 'opacity 0.3s ease';
            spinner.style.opacity = '0';
            setTimeout(() => {
                if (spinner.parentNode) spinner.parentNode.removeChild(spinner);
            }, 300);
        }
    }

    // Initialize page transition
    function initPageTransition() {
        const mainElement = document.querySelector('main');
        if (mainElement) mainElement.classList.add('page-enter-active');
    }

    // Handle flash messages
    function initFlashMessages() {
        setTimeout(() => {
            document.querySelectorAll('.flash-message').forEach(message => {
                message.style.transition = 'all 0.3s ease';
                message.style.opacity = '0';
                message.style.maxHeight = '0';
                message.style.margin = '0';
                message.style.padding = '0';
                message.style.overflow = 'hidden';
                setTimeout(() => { if (message.parentNode) message.parentNode.removeChild(message); }, 300);
            });
        }, 5000);

        document.querySelectorAll('.close-flash').forEach(button => {
            button.addEventListener('click', function() {
                const message = this.closest('.flash-message');
                if (message) {
                    message.style.transition = 'all 0.3s ease';
                    message.style.opacity = '0';
                    message.style.maxHeight = '0';
                    message.style.margin = '0';
                    message.style.padding = '0';
                    message.style.overflow = 'hidden';
                    setTimeout(() => { if (message.parentNode) message.parentNode.removeChild(message); }, 300);
                }
            });
        });
    }

    // Initialize everything
    function initializeApp() {
        removeLoadingSpinner();
        initPageTransition();
        initFlashMessages();
    }

    initializeApp();

    // Fallback: remove spinner if page takes too long
    setTimeout(removeLoadingSpinner, 3000);

    // Ensure spinner removal on full load
    window.addEventListener('load', function() { removeLoadingSpinner(); });
});

// Global error handling
window.addEventListener('error', function(e) { console.error('Error:', e.error); });
window.addEventListener('unhandledrejection', function(e) { console.error('Unhandled promise rejection:', e.reason); });
