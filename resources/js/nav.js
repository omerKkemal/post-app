// Enhanced navigation functionality
function navigation() {
    return {
        // State
        scrolled: false,
        showMobileMenu: false,
        showMobileSearch: false,
        isMobile: window.innerWidth < 768,
        currentTheme: localStorage.getItem('theme') || 'light',
        currentRoute: '{{ Route::currentRouteName() }}',
        loadingProgress: 0,
        unreadCount: 3, // Example count
        searchResults: [],
        notifications: [],
        query: '',

        init() {
            console.log('Enhanced navigation initialized');

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

        checkMobile() {
            this.isMobile = window.innerWidth < 768;
            if (!this.isMobile) {
                this.showMobileMenu = false;
                this.showMobileSearch = false;
            }
        },

        toggleTheme() {
            this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
            this.applyTheme(this.currentTheme);

            // Emit custom event for other components
            window.dispatchEvent(new CustomEvent('themeChanged', {
                detail: { theme: this.currentTheme }
            }));
        },

        applyTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        },

        toggleMobileMenu() {
            this.showMobileMenu = !this.showMobileMenu;
            this.showMobileSearch = false;

            // Focus management for accessibility
            if (this.showMobileMenu) {
                this.$nextTick(() => {
                    const firstLink = this.$el.querySelector('.mobile-nav-link');
                    if (firstLink) firstLink.focus();
                });
            }
        },

        toggleMobileSearch() {
            this.showMobileSearch = !this.showMobileSearch;
            this.showMobileMenu = false;

            if (this.showMobileSearch) {
                this.$nextTick(() => {
                    this.$refs.mobileSearchInput?.focus();
                });
            }
        },

        trackRouteChanges() {
            // Track route changes for active state management
            window.addEventListener('popstate', () => {
                this.currentRoute = '{{ Route::currentRouteName() }}';
            });
        },

        simulateLoading() {
            // Simulate loading progress for demo purposes
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 10;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    setTimeout(() => this.loadingProgress = 0, 500);
                }
                this.loadingProgress = progress;
            }, 200);
        },

        initSearch() {
            // Initialize search functionality
            this.$watch('query', (value) => {
                if (value.length > 2) {
                    this.performSearch(value);
                } else {
                    this.searchResults = [];
                }
            });
        },

        async performSearch(query) {
            // Simulate search API call
            try {
                // In a real app, this would be an API call
                await new Promise(resolve => setTimeout(resolve, 300));

                this.searchResults = [
                    {
                        id: 1,
                        title: 'Dashboard Overview',
                        description: 'View your main dashboard',
                        url: '/dashboard',
                        icon: 'fas fa-tachometer-alt'
                    },
                    {
                        id: 2,
                        title: 'User Settings',
                        description: 'Manage your account settings',
                        url: '/profile',
                        icon: 'fas fa-cog'
                    },
                    {
                        id: 3,
                        title: 'Team Members',
                        description: 'View and manage team members',
                        url: '/team',
                        icon: 'fas fa-users'
                    }
                ].filter(item =>
                    item.title.toLowerCase().includes(query.toLowerCase()) ||
                    item.description.toLowerCase().includes(query.toLowerCase())
                );
            } catch (error) {
                console.error('Search failed:', error);
                this.searchResults = [];
            }
        },

        async loadNotifications() {
            // Simulate loading notifications
            try {
                await new Promise(resolve => setTimeout(resolve, 500));

                this.notifications = [
                    {
                        id: 1,
                        title: 'Welcome to the new dashboard!',
                        message: 'Check out the new features we added',
                        type: 'info',
                        icon: 'fas fa-info-circle',
                        time: new Date(Date.now() - 1000 * 60 * 5), // 5 minutes ago
                        read: false
                    },
                    {
                        id: 2,
                        title: 'Profile updated successfully',
                        message: 'Your profile information has been updated',
                        type: 'success',
                        icon: 'fas fa-check-circle',
                        time: new Date(Date.now() - 1000 * 60 * 30), // 30 minutes ago
                        read: true
                    },
                    {
                        id: 3,
                        title: 'Security alert',
                        message: 'New login from unknown device',
                        type: 'warning',
                        icon: 'fas fa-exclamation-triangle',
                        time: new Date(Date.now() - 1000 * 60 * 60 * 2), // 2 hours ago
                        read: false
                    }
                ];

                this.unreadCount = this.notifications.filter(n => !n.read).length;
            } catch (error) {
                console.error('Failed to load notifications:', error);
            }
        },

        formatTime(date) {
            const now = new Date();
            const diff = now - date;
            const minutes = Math.floor(diff / 60000);
            const hours = Math.floor(diff / 3600000);
            const days = Math.floor(diff / 86400000);

            if (minutes < 1) return 'Just now';
            if (minutes < 60) return `${minutes}m ago`;
            if (hours < 24) return `${hours}h ago`;
            if (days < 7) return `${days}d ago`;
            return date.toLocaleDateString();
        }
    }
}

// Initialize Alpine when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Alpine will auto-initialize components with x-data
    console.log('Navigation initialized');
});
