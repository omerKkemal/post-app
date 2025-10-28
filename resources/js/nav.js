// Enhanced navigation functionality
function navigation(initialRoute = '') {
    return {
        // State
        scrolled: false,
        showMobileMenu: false,
        showMobileSearch: false,
        isMobile: window.innerWidth < 768,
        currentTheme: localStorage.getItem('theme') || 'light',
        currentRoute: initialRoute || this.getCurrentRouteFromPath(),
        loadingProgress: 0,
        unreadCount: 3,
        searchResults: [],
        notifications: [],
        query: '',

        init() {
            console.log('Enhanced navigation initialized');
            console.log('Initial route:', this.currentRoute);

            // Initialize mobile detection
            this.checkMobile();
            window.addEventListener('resize', this.checkMobile.bind(this));

            // Initialize theme
            this.applyTheme(this.currentTheme);

            // Initialize route tracking
            this.trackRouteChanges();

            // Initialize loading simulation
            this.simulateLoading();

            // Initialize search functionality
            this.initSearch();

            console.log('Navigation enhancements loaded');
        },

        getCurrentRouteFromPath() {
            const path = window.location.pathname;
            console.log('Getting route from path:', path);

            if (path === '/' || path === '') return 'home';
            if (path === '/dashboard') return 'dashboard';
            if (path.includes('/posts/create')) return 'post.create';
            if (path === '/about') return 'about';
            if (path === '/contact') return 'contact';
            if (path.includes('/posts/har') || path.includes('/posts/eng')) return 'post.view';
            if (path.includes('/login')) return 'login';
            if (path.includes('/register')) return 'register';
            if (path.includes('/profile')) return 'profile.edit';

            // Extract route name from path as fallback
            return path.replace(/^\//, '').split('/')[0] || 'home';
        },

        checkMobile() {
            this.isMobile = window.innerWidth < 768;
            if (!this.isMobile) {
                this.showMobileMenu = false;
                this.showMobileSearch = false;
            }
        },

        toggleTheme() {
            this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
            localStorage.setItem('theme', this.currentTheme);
            this.applyTheme(this.currentTheme);
        },

        applyTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        },

        toggleMobileMenu() {
            this.showMobileMenu = !this.showMobileMenu;
            this.showMobileSearch = false;

            if (this.showMobileMenu) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        },

        closeMobileMenu() {
            this.showMobileMenu = false;
            document.body.style.overflow = '';
        },

        trackRouteChanges() {
            // Update route when navigation occurs
            const observer = new MutationObserver(() => {
                this.currentRoute = this.getCurrentRouteFromPath();
            });

            // Observe body for changes that might indicate route change
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        },

        simulateLoading() {
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 30;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    setTimeout(() => this.loadingProgress = 0, 500);
                }
                this.loadingProgress = progress;
            }, 200);
        },

        initSearch() {
            // Search functionality placeholder
        },

        async performSearch(query) {
            // Search functionality placeholder
        },

        async loadNotifications() {
            // Simulate loading notifications
            try {
                await new Promise(resolve => setTimeout(resolve, 500));
                this.unreadCount = Math.floor(Math.random() * 5);
            } catch (error) {
                console.error('Failed to load notifications:', error);
            }
        },

        // Helper to check if current route matches
        isCurrentRoute(route) {
            return this.currentRoute === route;
        }
    }
}

// Make navigation function available globally
window.navigation = navigation;

// Close dropdowns when clicking outside
document.addEventListener('click', function(e) {
    // Close user dropdown
    const userDropdown = document.querySelector('.dropdown-container');
    const userTrigger = document.getElementById('user-dropdown-trigger');

    if (userDropdown && userTrigger && !userDropdown.contains(e.target)) {
        const alpineData = userDropdown.__x;
        if (alpineData && alpineData.$data.open !== undefined) {
            alpineData.$data.open = false;
        }
    }

    // Close view post dropdown
    const viewPostDropdown = document.querySelector('[x-data="{ open: false }"]');
    if (viewPostDropdown && !viewPostDropdown.contains(e.target)) {
        const alpineData = viewPostDropdown.__x;
        if (alpineData && alpineData.$data.open !== undefined) {
            alpineData.$data.open = false;
        }
    }
});

// Handle escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('[x-data]').forEach(element => {
            const alpineData = element.__x;
            if (alpineData) {
                if (alpineData.$data.open !== undefined) {
                    alpineData.$data.open = false;
                }
                if (alpineData.$data.showMobileMenu !== undefined) {
                    alpineData.$data.showMobileMenu = false;
                    document.body.style.overflow = '';
                }
            }
        });
    }
});

console.log('Navigation JS loaded');
