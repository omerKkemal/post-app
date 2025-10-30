// Enhanced navigation functionality - FIXED DUPLICATE ISSUE
function navigation(initialRoute = '') {
    return {
        // State
        scrolled: false,
        showMobileMenu: false,
        showMobileSearch: false,
        isMobile: window.innerWidth < 768,
        currentTheme: localStorage.getItem('theme') || 'light',
        currentRoute: '',
        loadingProgress: 0,
        unreadCount: 0,
        searchResults: [],
        notifications: [],
        query: '',

        init() {
            console.log('Navigation initialized');

            // Initialize mobile detection
            this.checkMobile();
            this.debouncedCheckMobile = this.debounce(this.checkMobile.bind(this), 250);
            window.addEventListener('resize', this.debouncedCheckMobile);

            // Initialize theme
            this.applyTheme(this.currentTheme);

            // Set current route
            this.currentRoute = initialRoute || this.getCurrentRouteFromPath();

            // Initialize route tracking
            this.trackRouteChanges();

            // Initialize loading simulation
            this.simulateLoading();

            // Initialize search functionality
            this.initSearch();

            // Fix duplicates after DOM is fully loaded
            setTimeout(() => this.fixNavigationDuplicates(), 200);

            console.log('Navigation loaded - Route:', this.currentRoute);
        },

        // Fixed duplicate detection for non-logged-in users
        fixNavigationDuplicates() {
            console.log('Fixing navigation duplicates...');

            // Check if user is NOT logged in (public user)
            const isPublicUser = !document.querySelector('.dropdown-container');

            if (isPublicUser) {
                console.log('Public user detected - fixing duplicates');
                this.fixPublicUserDuplicates();
            }

            // Always ensure center navigation is visible
            this.ensureCenterNavigationVisible();
        },

        fixPublicUserDuplicates() {
            // Find all navigation containers in the right section
            const rightSectionContainers = document.querySelectorAll('.flex.items-center.space-x-4 .flex.items-center.space-x-3');

            rightSectionContainers.forEach((container, index) => {
                const hasMainNavLinks = container.querySelector('a[href*="/"], a[href*="about"], a[href*="contact"], .fa-newspaper');
                const hasAuthButtons = container.querySelector('a[href*="login"], a[href*="register"]');

                console.log('Container', index, 'hasMainNavLinks:', hasMainNavLinks, 'hasAuthButtons:', hasAuthButtons);

                // If this container has main navigation links (not auth buttons) in the right section, hide it
                // The main nav links should only be in the center section
                if (hasMainNavLinks && !hasAuthButtons) {
                    console.log('Hiding duplicate main navigation in right section:', container);
                    container.style.display = 'none';
                    container.classList.add('nav-duplicate-hidden');
                }
            });

            // Also fix any duplicate "What's New" dropdowns in the right section
            this.fixDuplicateDropdowns();
        },

        fixDuplicateDropdowns() {
            // Find all "What's New" dropdowns
            const whatsNewDropdowns = document.querySelectorAll('.relative[x-data*="open"]');
            let foundCenterDropdown = false;

            whatsNewDropdowns.forEach((dropdown, index) => {
                const isInCenterNav = dropdown.closest('.hidden.md\\:flex.flex-1.justify-evenly.items-center');
                const isInRightSection = dropdown.closest('.flex.items-center.space-x-4');

                if (isInCenterNav) {
                    foundCenterDropdown = true;
                    console.log('Found center dropdown - keeping');
                } else if (isInRightSection && foundCenterDropdown) {
                    console.log('Hiding duplicate dropdown in right section:', dropdown);
                    dropdown.style.display = 'none';
                    dropdown.classList.add('nav-duplicate-hidden');
                }
            });
        },

        ensureCenterNavigationVisible() {
            const centerNav = document.querySelector('.hidden.md\\:flex.flex-1.justify-evenly.items-center');
            if (centerNav) {
                centerNav.style.display = 'flex';
                centerNav.style.visibility = 'visible';
                centerNav.style.opacity = '1';

                // Ensure all links in center nav are visible
                const centerNavLinks = centerNav.querySelectorAll('.nav-link');
                centerNavLinks.forEach(link => {
                    link.style.display = 'flex';
                    link.style.visibility = 'visible';
                    link.style.opacity = '1';
                });
            }
        },

        getCurrentRouteFromPath() {
            const path = window.location.pathname;
            const searchParams = new URLSearchParams(window.location.search);

            console.log('Getting route from path:', path);

            // Comprehensive route mapping
            const routeMap = {
                '/': 'home',
                '/dashboard': 'dashboard',
                '/posts/create': 'post.create',
                '/about': 'about',
                '/contact': 'contact',
                '/login': 'login',
                '/register': 'register',
                '/profile': 'profile.edit',
                '/congress': 'congress.view',
                '/categories': 'category.show',
                '/category': 'post.category'
            };

            // Check exact matches first
            if (routeMap[path]) {
                return routeMap[path];
            }

            // Check for post view routes
            if (path.includes('/posts/') || path.includes('/p/')) {
                return 'post.view';
            }

            // Check for post view with language parameter
            if (path === '/p' && searchParams.get('language')) {
                return 'postView';
            }

            // Check for congress routes
            if (path.includes('/congress')) {
                return 'congress.view';
            }

            // Check for category routes
            if (path.includes('/categories') || path.includes('/category')) {
                return 'post.category';
            }

            // Fallback: extract first path segment
            const route = path.replace(/^\//, '').split('/')[0] || 'home';
            return route;
        },

        checkMobile() {
            this.isMobile = window.innerWidth < 768;
            if (!this.isMobile) {
                this.showMobileMenu = false;
                this.showMobileSearch = false;
                document.body.style.overflow = '';
            }
        },

        debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
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
            // Update active states when route changes
            const updateActiveStates = () => {
                const newRoute = this.getCurrentRouteFromPath();
                if (newRoute !== this.currentRoute) {
                    this.currentRoute = newRoute;
                    this.updateNavActiveStates();
                    console.log('Route changed to:', this.currentRoute);
                }
            };

            // Observe URL changes
            this.routeObserver = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'childList' ||
                        (mutation.type === 'attributes' && mutation.attributeName === 'class')) {
                        updateActiveStates();
                    }
                });
            });

            this.routeObserver.observe(document.body, {
                childList: true,
                subtree: true,
                attributes: true,
                attributeFilter: ['class']
            });

            // Listen to browser navigation
            window.addEventListener('popstate', updateActiveStates);
        },

        // Update navigation active states
        updateNavActiveStates() {
            const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');

            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (!href) return;

                const linkRoute = this.getRouteFromHref(href);
                const isActive = this.isRouteActive(linkRoute);

                // Update active state classes
                if (isActive) {
                    link.classList.add('nav-active');
                    link.classList.remove('nav-inactive');
                } else {
                    link.classList.remove('nav-active');
                    link.classList.add('nav-inactive');
                }
            });
        },

        getRouteFromHref(href) {
            // Extract route name from href
            if (href.includes('dashboard')) return 'dashboard';
            if (href.includes('post.create')) return 'post.create';
            if (href.includes('congress.view')) return 'congress.view';
            if (href.includes('category.show') || href.includes('post.category')) return 'post.category';
            if (href.includes('about')) return 'about';
            if (href.includes('contact')) return 'contact';
            if (href.includes('login')) return 'login';
            if (href.includes('register')) return 'register';
            if (href.includes('profile')) return 'profile.edit';
            if (href.includes('/p/') || href.includes('post.view')) return 'post.view';
            if (href === '/' || href === '') return 'home';

            return 'home';
        },

        isRouteActive(route) {
            return this.currentRoute === route;
        },

        simulateLoading() {
            if (this.loadingInterval) {
                clearInterval(this.loadingInterval);
            }

            this.loadingProgress = 0;

            this.loadingInterval = setInterval(() => {
                const increment = Math.random() * 25 + 5;
                this.loadingProgress = Math.min(this.loadingProgress + increment, 100);

                if (this.loadingProgress >= 100) {
                    clearInterval(this.loadingInterval);
                    setTimeout(() => {
                        this.loadingProgress = 0;
                    }, 600);
                }
            }, 180);
        },

        initSearch() {
            this.searchDebounce = this.debounce((query) => {
                this.performSearch(query);
            }, 300);
        },

        async performSearch(query) {
            if (!query.trim()) {
                this.searchResults = [];
                return;
            }

            try {
                this.searchLoading = true;
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 500));
                this.searchResults = [];
            } catch (error) {
                console.error('Search failed:', error);
                this.searchResults = [];
            } finally {
                this.searchLoading = false;
            }
        },

        async loadNotifications() {
            try {
                await new Promise(resolve => setTimeout(resolve, 500));
                this.unreadCount = Math.floor(Math.random() * 5);
            } catch (error) {
                console.error('Failed to load notifications:', error);
            }
        },

        // Cleanup method
        destroy() {
            if (this.debouncedCheckMobile) {
                window.removeEventListener('resize', this.debouncedCheckMobile);
            }
            if (this.routeObserver) {
                this.routeObserver.disconnect();
            }
            if (this.loadingInterval) {
                clearInterval(this.loadingInterval);
            }
        }
    }
}

// Global event handlers
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing navigation...');

    // Initialize navigation after a brief delay to ensure all elements are rendered
    setTimeout(() => {
        const navElement = document.querySelector('nav[x-data*="navigation"]');
        if (navElement && !navElement.__x) {
            console.log('Navigation element found');
        }
    }, 100);
});

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

// Add CSS for navigation
const navigationStyles = `
    .nav-active {
        background-color: rgb(239 246 255) !important;
        color: rgb(29 78 216) !important;
        border-color: rgb(191 219 254) !important;
    }

    .dark .nav-active {
        background-color: rgb(30 58 138 / 0.2) !important;
        color: rgb(147 197 253) !important;
        border-color: rgb(30 64 175) !important;
    }

    /* Ensure center navigation is always visible */
    .hidden.md\\:flex.flex-1.justify-evenly.items-center {
        display: flex !important;
    }

    /* Hide duplicates properly */
    .nav-duplicate-hidden {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
`;

// Inject styles
const styleSheet = document.createElement('style');
styleSheet.textContent = navigationStyles;
document.head.appendChild(styleSheet);

// Make navigation function available globally
window.navigation = navigation;

console.log('Fixed Navigation JS loaded - Duplicate issue resolved');
