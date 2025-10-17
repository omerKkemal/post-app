<nav x-data="navigation()" class="bg-white/95 backdrop-blur-md border-b border-gray-200/60 shadow-sm sticky top-0 z-40 transition-all duration-300 dark:bg-gray-900/95 dark:border-gray-700/60"
     :class="{ 'shadow-lg': scrolled }"
     @scroll.window="scrolled = window.scrollY > 10">

    <!-- Enhanced Loading Bar -->
    <div class="loading-bar absolute top-0 left-0 h-1 bg-gradient-to-r from-blue-500 to-purple-500 transition-all duration-300"
         :style="`width: ${loadingProgress}%`"
         x-show="loadingProgress > 0 && loadingProgress < 100"></div>

    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Enhanced Logo/Brand Section -->
            <div class="flex items-center space-x-3">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center space-x-3 group transition-all duration-300 hover:scale-105"
                       x-data="{ hover: false }"
                       @mouseenter="hover = true"
                       @mouseleave="hover = false">
                        <div class="relative">
                            <!-- Enhanced Logo Container with Animation -->
                            <div class="absolute -inset-3 bg-blue-100 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 dark:bg-blue-900/30"></div>
                            <img
                                src="{{ asset('image/logo.jpg') }}"
                                alt="{{ config('app.name', 'Laravel') }}"
                                class="relative w-10 h-10 rounded-full object-cover border-2 border-white shadow-lg transition-all duration-300 group-hover:shadow-xl group-hover:border-blue-200 dark:border-gray-600"
                                loading="eager"
                                :class="{ 'scale-110': hover }"
                            />
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent dark:from-blue-400 dark:to-purple-400">
                                {{ config('app.name', 'Laravel') }}
                            </span>
                            <span class="text-xs text-gray-500 font-medium dark:text-gray-400" x-show="!isMobile">Dashboard</span>
                        </div>
                    </a>
                </div>

                <!-- Enhanced Quick Actions - Desktop -->
                <div class="hidden md:flex items-center space-x-1 ml-4" x-show="!isMobile">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group"
                       :class="currentRoute === 'dashboard' ?
                              'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' :
                              'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800'">
                        <i class="fas fa-home text-sm w-5"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="#"
                       class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800">
                        <i class="fas fa-chart-line text-sm w-5"></i>
                        <span>Analytics</span>
                    </a>

                    <a href="#"
                       class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800">
                        <i class="fas fa-users text-sm w-5"></i>
                        <span>Team</span>
                    </a>
                </div>
            </div>

            <!-- Enhanced Search & Controls -->
            <div class="flex items-center space-x-4">
                <!-- Enhanced Search Bar -->
                <div class="hidden lg:block relative" x-data="{ open: false, query: '' }">
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Search..."
                            class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg bg-white/50 backdrop-blur-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 dark:bg-gray-800/50 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                            @focus="open = true"
                            @blur="setTimeout(() => open = false, 200)"
                            x-model="query"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Enhanced Search Results Dropdown -->
                    <div class="absolute top-full left-0 right-0 mt-2 bg-white/95 backdrop-blur-md border border-gray-200 rounded-lg shadow-xl z-50 transition-all duration-200 dark:bg-gray-800/95 dark:border-gray-700"
                         x-show="open && query.length > 0"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100">
                        <div class="p-2 space-y-1">
                            <template x-for="result in searchResults" :key="result.id">
                                <a :href="result.url"
                                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-150 dark:hover:bg-gray-700/50">
                                    <i :class="result.icon" class="text-gray-500 w-5 text-center dark:text-gray-400"></i>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white" x-text="result.title"></div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400" x-text="result.description"></div>
                                    </div>
                                </a>
                            </template>
                            <div x-show="searchResults.length === 0" class="p-3 text-center text-gray-500 dark:text-gray-400">
                                No results found for "<span x-text="query"></span>"
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Action Buttons -->
                <div class="flex items-center space-x-2">
                    <!-- Theme Toggle -->
                    <button @click="toggleTheme()"
                            class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-800 group relative"
                            x-tooltip="currentTheme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                        <i class="fas fa-sun text-lg transition-transform duration-300 group-hover:scale-110 dark:hidden"></i>
                        <i class="fas fa-moon text-lg transition-transform duration-300 group-hover:scale-110 hidden dark:block"></i>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </button>

                    <!-- Notifications -->
                    <div class="relative dropdown-container" x-data="{ open: false, notifications: [] }">
                        <button @click="open = !open; open && loadNotifications()"
                                class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-800 group relative">
                            <i class="fas fa-bell text-lg transition-transform duration-300 group-hover:scale-110"></i>
                            <span x-show="unreadCount > 0"
                                  class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center transform scale-100 transition-transform duration-300 group-hover:scale-110"
                                  x-text="unreadCount"></span>
                        </button>

                        <!-- Enhanced Notifications Dropdown -->
                        <div class="dropdown-menu w-80" :class="{ 'open': open }">
                            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Notifications</h3>
                                    <span x-show="unreadCount > 0"
                                          class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full dark:bg-blue-900 dark:text-blue-200"
                                          x-text="unreadCount + ' unread'"></span>
                                </div>
                            </div>

                            <div class="max-h-96 overflow-y-auto">
                                <template x-for="notification in notifications" :key="notification.id">
                                    <div class="dropdown-item justify-start items-start p-4 border-b border-gray-100 last:border-b-0 dark:border-gray-700/50"
                                         :class="{ 'bg-blue-50 dark:bg-blue-900/20': !notification.read }">
                                        <div class="flex items-start space-x-3">
                                            <div :class="notification.type === 'success' ? 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400' :
                                                      notification.type === 'warning' ? 'bg-yellow-100 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400' :
                                                      notification.type === 'error' ? 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400' :
                                                      'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400'"
                                                 class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                                <i :class="notification.icon" class="text-sm"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="notification.title"></p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" x-text="notification.message"></p>
                                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-2" x-text="formatTime(notification.time)"></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <div x-show="notifications.length === 0" class="p-8 text-center">
                                    <i class="fas fa-bell-slash text-3xl text-gray-300 mb-3 dark:text-gray-600"></i>
                                    <p class="text-gray-500 dark:text-gray-400">No notifications</p>
                                </div>
                            </div>

                            <div class="p-3 border-t border-gray-200 dark:border-gray-700">
                                <a href="#" class="block text-center text-sm text-blue-600 hover:text-blue-700 font-medium dark:text-blue-400 dark:hover:text-blue-300">
                                    View all notifications
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Search Toggle -->
                    <button @click="toggleMobileSearch()"
                            class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-800">
                        <i class="fas fa-search text-lg"></i>
                    </button>

                    <!-- Mobile Menu Toggle -->
                    <button @click="toggleMobileMenu()"
                            class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-800">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>

                <!-- Enhanced User Profile Dropdown -->
                <div class="relative dropdown-container" x-data="{ open: false }">
                    <button id="user-dropdown-trigger"
                            @click="open = !open"
                            class="user-dropdown-trigger group"
                            :class="{ 'bg-gray-100 dark:bg-gray-800': open }">
                        <span class="sr-only">Open user menu</span>
                        <div class="flex items-center space-x-3">
                            <div class="user-avatar group-hover:shadow-lg transition-all duration-200">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200 group-hover:text-gray-600 dark:group-hover:text-gray-300"
                               :class="{ 'rotate-180': open }"></i>
                        </div>
                    </button>

                    <!-- Enhanced User Dropdown Menu -->
                    <div id="user-dropdown-menu"
                         class="dropdown-menu w-64"
                         :class="{ 'open': open }"
                         @click.outside="open = false">
                        <!-- User Info -->
                        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <div class="user-avatar w-12 h-12 text-base">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Navigation Links -->
                        <div class="py-2">
                            <a href="{{ route('profile.edit') }}"
                               class="dropdown-item group">
                                <i class="fas fa-user-circle"></i>
                                <span>Profile</span>
                                <span class="ml-auto text-xs text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300">⌘P</span>
                            </a>

                            <a href="#" class="dropdown-item group">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                                <span class="ml-auto text-xs text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300">⌘,</span>
                            </a>

                            <a href="#" class="dropdown-item group">
                                <i class="fas fa-credit-card"></i>
                                <span>Billing</span>
                                <span class="ml-auto bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full dark:bg-green-900 dark:text-green-200">Pro</span>
                            </a>

                            <a href="#" class="dropdown-item group">
                                <i class="fas fa-users"></i>
                                <span>Team</span>
                            </a>
                        </div>

                        <div class="py-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="#" class="dropdown-item group">
                                <i class="fas fa-question-circle"></i>
                                <span>Help & Support</span>
                            </a>

                            <a href="#" class="dropdown-item group">
                                <i class="fas fa-shield-alt"></i>
                                <span>Privacy & Security</span>
                            </a>
                        </div>

                        <!-- Logout -->
                        <div class="py-2 border-t border-gray-200 dark:border-gray-700">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                        class="dropdown-item group text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 w-full text-left">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Log Out</span>
                                    <span class="ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200">⌘Q</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Mobile Search -->
        <div x-show="showMobileSearch"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="lg:hidden pb-4 border-b border-gray-200 dark:border-gray-700"
             x-cloak>
            <div class="relative">
                <input
                    type="text"
                    placeholder="Search..."
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                    x-ref="mobileSearchInput"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Mobile Navigation Menu -->
    <div x-show="showMobileMenu"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="md:hidden border-t border-gray-200 bg-white/95 backdrop-blur-md dark:bg-gray-900/95 dark:border-gray-700"
         x-cloak>
        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Mobile Navigation Links -->
            <a href="{{ route('dashboard') }}"
               class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200"
               :class="currentRoute === 'dashboard' ?
                      'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' :
                      'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800'">
                <i class="fas fa-home w-6 mr-3 text-center"></i>
                Dashboard
            </a>

            <a href="#"
               class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800">
                <i class="fas fa-chart-line w-6 mr-3 text-center"></i>
                Analytics
            </a>

            <a href="#"
               class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800">
                <i class="fas fa-users w-6 mr-3 text-center"></i>
                Team
            </a>

            <a href="{{ route('profile.edit') }}"
               class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800">
                <i class="fas fa-user-circle w-6 mr-3 text-center"></i>
                Profile
            </a>

            <a href="#"
               class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800">
                <i class="fas fa-cog w-6 mr-3 text-center"></i>
                Settings
            </a>

            <!-- Mobile Logout -->
            <div class="border-t border-gray-200 pt-2 dark:border-gray-700">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                            class="mobile-nav-link block w-full text-left px-3 py-3 rounded-lg text-base font-medium text-red-600 hover:text-red-700 hover:bg-red-50 transition-all duration-200 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/20">
                        <i class="fas fa-sign-out-alt w-6 mr-3 text-center"></i>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
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
            },

            // Utility functions
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
            }
        }
    }

    // Enhanced tooltip directive for Alpine.js
    document.addEventListener('alpine:init', () => {
        Alpine.directive('tooltip', (el, { expression }, { evaluate }) => {
            const text = evaluate(expression);
            let tooltip = null;

            const showTooltip = (e) => {
                if (tooltip) return;

                tooltip = document.createElement('div');
                tooltip.className = 'fixed z-50 px-2 py-1 text-xs font-medium text-white bg-gray-900 rounded shadow-lg whitespace-nowrap dark:bg-gray-700';
                tooltip.textContent = text;
                document.body.appendChild(tooltip);

                const rect = el.getBoundingClientRect();
                const tooltipRect = tooltip.getBoundingClientRect();

                let top = rect.bottom + 8;
                let left = rect.left + (rect.width - tooltipRect.width) / 2;

                // Adjust if tooltip would go off screen
                if (left < 8) left = 8;
                if (left + tooltipRect.width > window.innerWidth - 8) {
                    left = window.innerWidth - tooltipRect.width - 8;
                }

                tooltip.style.top = `${top + window.scrollY}px`;
                tooltip.style.left = `${left}px`;
            };

            const hideTooltip = () => {
                if (tooltip) {
                    tooltip.remove();
                    tooltip = null;
                }
            };

            el.addEventListener('mouseenter', showTooltip);
            el.addEventListener('mouseleave', hideTooltip);
            el.addEventListener('focus', showTooltip);
            el.addEventListener('blur', hideTooltip);
        });
    });

    // Enhanced navigation event handlers
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Navigation DOM enhancements loaded');

        // Enhanced mobile menu accessibility
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close mobile menus on escape
                const navigation = Alpine.$data(document.querySelector('nav'));
                if (navigation) {
                    navigation.showMobileMenu = false;
                    navigation.showMobileSearch = false;
                }
            }
        });

        // Enhanced touch handling for mobile
        let touchStartX = 0;
        let touchStartY = 0;

        document.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
            touchStartY = e.changedTouches[0].screenY;
        });

        document.addEventListener('touchend', function(e) {
            const touchEndX = e.changedTouches[0].screenX;
            const touchEndY = e.changedTouches[0].screenY;
            const diffX = touchStartX - touchEndX;
            const diffY = touchStartY - touchEndY;

            // Simple swipe detection
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    // Swipe left - could be used for navigation
                    console.log('Swipe left detected');
                } else {
                    // Swipe right - could be used for navigation
                    console.log('Swipe right detected');
                }
            }
        });

        // Enhanced performance monitoring for navigation
        const navLoadTime = performance.now();
        console.log(`Navigation rendered in ${navLoadTime}ms`);

        // Enhanced error boundary for navigation
        window.addEventListener('error', function(e) {
            if (e.target.tagName === 'IMG' && e.target.closest('nav')) {
                console.error('Navigation image failed to load:', e.target.src);
                e.target.style.display = 'none';
            }
        });
    });
</script>

<style>
    /* Enhanced navigation-specific styles */
    .nav-link {
        position: relative;
        overflow: hidden;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #0ea5e9, #0369a1);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after,
    .nav-link[class*="bg-blue-50"]::after {
        width: 80%;
    }

    .mobile-nav-link {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .mobile-nav-link:active {
        transform: scale(0.98);
    }

    /* Enhanced focus styles for accessibility */
    .keyboard-navigation .nav-link:focus,
    .keyboard-navigation .mobile-nav-link:focus {
        outline: 2px solid #0ea5e9;
        outline-offset: 2px;
    }

    /* Enhanced dark mode transitions */
    .dark .nav-link,
    .dark .mobile-nav-link,
    .dark .user-dropdown-trigger {
        transition: all 0.3s ease;
    }

    /* Enhanced scrollbar for dropdowns */
    .dropdown-menu::-webkit-scrollbar {
        width: 6px;
    }

    .dropdown-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    .dropdown-menu::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .dark .dropdown-menu::-webkit-scrollbar-thumb {
        background: #475569;
    }

    /* Enhanced backdrop blur support */
    @supports (backdrop-filter: blur(20px)) {
        .backdrop-blur-md {
            backdrop-filter: blur(20px);
        }
    }

    /* Print styles */
    @media print {
        nav {
            display: none !important;
        }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .nav-link,
        .mobile-nav-link,
        .user-dropdown-trigger,
        .dropdown-menu {
            transition: none !important;
        }

        .nav-link::after {
            transition: none !important;
        }
    }

    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .nav-link:hover,
        .mobile-nav-link:hover {
            outline: 2px solid currentColor;
        }
    }
</style>
