// Extracted guest layout JS from layouts/guest.blade.php
function guestData() {
    return {
        init() {
            console.log('Guest layout initialized');
            this.initLoadingBar();
            this.initAnimations();
            this.initPerformanceMonitoring();
        },

        initLoadingBar() {
            const loadingBar = document.getElementById('loadingBar');
            if (loadingBar) {
                let progress = 0;
                const interval = setInterval(() => {
                    progress += Math.random() * 15;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(interval);
                        setTimeout(() => {
                            loadingBar.style.opacity = '0';
                            setTimeout(() => loadingBar.remove(), 500);
                        }, 300);
                    }
                    loadingBar.style.width = progress + '%';
                }, 100);
            }
        },

        initAnimations() { console.log('Guest animations initialized'); },

        initPerformanceMonitoring() {
            if ('performance' in window) {
                window.addEventListener('load', () => {
                    const perfData = performance.timing;
                    const loadTime = perfData.loadEventEnd - perfData.navigationStart;
                    console.log(`Guest page loaded in ${loadTime}ms`);
                });
            }
        },

        scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); },

        showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white ${ type === 'info' ? 'bg-blue-500' : type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-yellow-500' } z-50 transform transition-transform duration-300 translate-x-full`;
            notification.textContent = message;
            document.body.appendChild(notification);
            requestAnimationFrame(() => notification.classList.remove('translate-x-full'));
            setTimeout(() => { notification.classList.add('translate-x-full'); setTimeout(() => { if (notification.parentNode) notification.parentNode.removeChild(notification); }, 300); }, 3000);
        }
    };
}

// DOM ready handlers from guest layout
document.addEventListener('DOMContentLoaded', function() {
    console.log('Guest layout DOM loaded');

    document.querySelectorAll('img').forEach(img => { img.addEventListener('error', function() { console.warn('Image failed to load:', this.src); this.style.opacity = '0.5'; }); });

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
                setTimeout(() => {
                    if (!this.checkValidity()) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = submitBtn.getAttribute('data-original-text') || 'Submit';
                    }
                }, 5000);
            }
        });
    });

    document.addEventListener('keydown', function(e) { if (e.key === 'Tab') document.body.classList.add('keyboard-navigation'); });
    document.addEventListener('mousedown', function() { document.body.classList.remove('keyboard-navigation'); });

    const checkViewport = () => {
        const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
        const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
        if (vw < 640 || vh < 480) console.warn('Viewport size may affect user experience');
    };

    checkViewport();
    window.addEventListener('resize', checkViewport);

    window.addEventListener('online', function() { console.log('Connection restored'); });
    window.addEventListener('offline', function() { console.warn('Connection lost'); });
});

window.addEventListener('error', function(e) { console.error('Guest layout error:', e.error); e.preventDefault(); });
