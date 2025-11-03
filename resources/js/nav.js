// Enhanced Navigation Functionality — FINAL FIXED VERSION
function navigation(initialRoute = '') {
    return {
        // --- State ---
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

        // --- Initialization ---
        init() {
            console.log('✅ Navigation initialized');

            // Detect mobile viewport
            this.checkMobile();
            this.debouncedCheckMobile = this.debounce(this.checkMobile.bind(this), 250);
            window.addEventListener('resize', this.debouncedCheckMobile);

            // Apply theme from storage
            this.applyTheme(this.currentTheme);

            // Set route
            this.currentRoute = initialRoute || this.getCurrentRouteFromPath();

            // Start background features
            this.trackRouteChanges();
            this.simulateLoading();
            this.initSearch();

            // Fix duplicates for public users
            setTimeout(() => this.fixNavigationDuplicates(), 200);

            // Watch for mobile menu toggle to lock scroll
            this.$watch('showMobileMenu', (v) => {
                document.body.style.overflow = v ? 'hidden' : '';
            });

            // Ensure proper visibility on resize
            window.addEventListener('resize', () => this.ensureCenterNavigationVisible());

            this.ensureCenterNavigationVisible();

            console.log('✅ Navigation ready, route:', this.currentRoute);
        },

        // --- Responsiveness ---
        checkMobile() {
            this.isMobile = window.innerWidth < 768;
            if (!this.isMobile) {
                this.showMobileMenu = false;
                this.showMobileSearch = false;
                document.body.style.overflow = '';
            }
            this.ensureCenterNavigationVisible();
        },

        // --- Duplicate handling (public) ---
        fixNavigationDuplicates() {
            const isPublic = !document.querySelector('.dropdown-container');
            if (isPublic) this.fixPublicUserDuplicates();
            this.ensureCenterNavigationVisible();
        },

        fixPublicUserDuplicates() {
            const containers = document.querySelectorAll('.flex.items-center.space-x-4 .flex.items-center.space-x-3');
            containers.forEach(container => {
                const hasMain = container.querySelector('a[href*="/"], a[href*="about"], a[href*="contact"], .fa-newspaper');
                const hasAuth = container.querySelector('a[href*="login"], a[href*="register"]');
                if (hasMain && !hasAuth) container.classList.add('nav-duplicate-hidden');
            });
            this.fixDuplicateDropdowns();
        },

        fixDuplicateDropdowns() {
            const dropdowns = document.querySelectorAll('.relative[x-data*="open"]');
            let foundCenter = false;
            dropdowns.forEach(d => {
                const inCenter = d.closest('.hidden.md\\:flex.flex-1.justify-evenly.items-center');
                const inRight = d.closest('.flex.items-center.space-x-4');
                if (inCenter) foundCenter = true;
                else if (inRight && foundCenter) d.classList.add('nav-duplicate-hidden');
            });
        },

        ensureCenterNavigationVisible() {
            const center = document.querySelector('.hidden.md\\:flex.flex-1.justify-evenly.items-center');
            if (!center) return;

            // Only force visible on desktop
            if (window.innerWidth >= 768) {
                center.style.display = 'flex';
                center.querySelectorAll('.nav-link').forEach(l => (l.style.display = 'flex'));
            } else {
                // Respect Tailwind’s responsive rule on mobile
                center.style.display = '';
                center.querySelectorAll('.nav-link').forEach(l => (l.style.display = ''));
            }
        },

        // --- Routing & Active Links ---
        getCurrentRouteFromPath() {
            const path = window.location.pathname;
            const qs = new URLSearchParams(window.location.search);
            const routes = {
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
            if (routes[path]) return routes[path];
            if (path.includes('/posts/') || path.includes('/p/')) return 'post.view';
            if (path === '/p' && qs.get('language')) return 'postView';
            if (path.includes('/congress')) return 'congress.view';
            if (path.includes('/category')) return 'post.category';
            return path.replace(/^\//, '').split('/')[0] || 'home';
        },

        trackRouteChanges() {
            const update = () => {
                const newRoute = this.getCurrentRouteFromPath();
                if (newRoute !== this.currentRoute) {
                    this.currentRoute = newRoute;
                    this.updateNavActiveStates();
                }
            };
            window.addEventListener('popstate', update);
        },

        updateNavActiveStates() {
            document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
                const href = link.getAttribute('href');
                const route = this.getRouteFromHref(href);
                const active = this.isRouteActive(route);
                link.classList.toggle('nav-active', active);
                link.classList.toggle('nav-inactive', !active);
            });
        },

        getRouteFromHref(href) {
            if (!href) return 'home';
            if (href.includes('dashboard')) return 'dashboard';
            if (href.includes('post.create')) return 'post.create';
            if (href.includes('congress.view')) return 'congress.view';
            if (href.includes('category.show') || href.includes('post.category')) return 'post.category';
            if (href.includes('about')) return 'about';
            if (href.includes('contact')) return 'contact';
            if (href.includes('login')) return 'login';
            if (href.includes('register')) return 'register';
            if (href.includes('profile')) return 'profile.edit';
            if (href.includes('/p/')) return 'post.view';
            return href === '/' ? 'home' : 'home';
        },

        isRouteActive(r) { return this.currentRoute === r; },

        // --- Mobile Menu ---
        toggleMobileMenu() {
            this.showMobileMenu = !this.showMobileMenu;
            this.showMobileSearch = false;
        },
        closeMobileMenu() {
            this.showMobileMenu = false;
        },

        // --- Theme ---
        toggleTheme() {
            this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
            localStorage.setItem('theme', this.currentTheme);
            this.applyTheme(this.currentTheme);
        },
        applyTheme(theme) {
            document.documentElement.classList.toggle('dark', theme === 'dark');
        },

        // --- Search & Notifications ---
        debounce(fn, wait) {
            let t;
            return (...a) => { clearTimeout(t); t = setTimeout(() => fn(...a), wait); };
        },
        initSearch() {
            this.searchDebounce = this.debounce(q => this.performSearch(q), 300);
        },
        async performSearch(query) {
            if (!query.trim()) return (this.searchResults = []);
            this.searchLoading = true;
            await new Promise(r => setTimeout(r, 500));
            this.searchResults = [];
            this.searchLoading = false;
        },
        async loadNotifications() {
            await new Promise(r => setTimeout(r, 500));
            this.unreadCount = Math.floor(Math.random() * 5);
        },

        // --- Simulated Loading Bar ---
        simulateLoading() {
            clearInterval(this.loadingInterval);
            this.loadingProgress = 0;
            this.loadingInterval = setInterval(() => {
                this.loadingProgress = Math.min(this.loadingProgress + Math.random() * 25 + 5, 100);
                if (this.loadingProgress >= 100) clearInterval(this.loadingInterval);
            }, 180);
        },

        // --- Cleanup ---
        destroy() {
            window.removeEventListener('resize', this.debouncedCheckMobile);
            clearInterval(this.loadingInterval);
        }
    };
}

// --- Global Event Handlers ---
document.addEventListener('click', e => {
    const dropdown = document.querySelector('.dropdown-container');
    const trigger = document.getElementById('user-dropdown-trigger');
    if (dropdown && trigger && !dropdown.contains(e.target)) {
        const x = dropdown.__x;
        if (x?.$data.open !== undefined) x.$data.open = false;
    }
});

document.addEventListener('keydown', e => {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('[x-data]').forEach(el => {
        const x = el.__x;
        if (!x) return;
        if (x.$data.open !== undefined) x.$data.open = false;
        if (x.$data.showMobileMenu !== undefined) {
            x.$data.showMobileMenu = false;
            document.body.style.overflow = '';
        }
    });
});

// --- Inject helper CSS ---
const css = `
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
.nav-duplicate-hidden {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
}
[x-cloak] { display: none !important; }
`;
document.head.appendChild(Object.assign(document.createElement('style'), { textContent: css }));

// --- Export globally ---
window.navigation = navigation;
console.log('✅ Navigation JS loaded — Alpine reactivity restored, responsive visibility fixed');
