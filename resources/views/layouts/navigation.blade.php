<nav x-data="{ open: false, dropdownOpen: false }" @click.outside="open = false" class="bg-white/80 backdrop-blur-md border-b border-gray-200/60 shadow-sm sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <img src="{{ asset('image/logo.jpg') }}" class="block h-9 w-auto rounded-lg shadow-sm group-hover:shadow-md transition-all duration-300" alt="{{ config('app.name', 'Laravel') }}" />
                        <span class="hidden lg:block text-xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent">
                            {{ config('app.name', 'Laravel') }}
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="relative group">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tachometer-alt text-sm opacity-75"></i>
                            <span>{{ __('Dashboard') }}</span>
                        </div>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-500 group-hover:w-full transition-all duration-300"></div>
                    </x-nav-link>

                    <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')" class="relative group">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-plus-circle text-sm opacity-75"></i>
                            <span>{{ __('Create Post') }}</span>
                        </div>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-500 group-hover:w-full transition-all duration-300"></div>
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Navigation -->
            <div class="flex items-center space-x-4">
                <!-- Quick Actions -->
                <div class="hidden md:flex items-center space-x-2">
                    <!-- Search Button -->
                    <button class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200"
                            title="Search">
                        <i class="fas fa-search"></i>
                    </button>

                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200 relative"
                                title="Notifications">
                            <i class="fas fa-bell"></i>
                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                        </button>
                    </div>

                    <!-- Theme Toggle -->
                    <button class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200"
                            title="Toggle theme">
                        <i class="fas fa-moon"></i>
                    </button>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                                <div class="flex items-center space-x-2">
                                    <!-- User Avatar -->
                                    <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white text-sm font-semibold shadow-sm">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="hidden md:block font-medium">{{ Auth::user()->name }}</span>
                                </div>

                                <div class="ms-2 transition-transform duration-200" :class="{ 'rotate-180': dropdownOpen }">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="font-medium text-gray-900 truncate">{{ Auth::user()->name }}</div>
                                <div class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</div>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 group block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                                <i class="fas fa-user text-gray-400 group-hover:text-primary-500 transition-colors w-4"></i>
                                <span>{{ __('Profile') }}</span>
                            </a>

                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 group block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                                <i class="fas fa-cog text-gray-400 group-hover:text-primary-500 transition-colors w-4"></i>
                                <span>{{ __('Settings') }}</span>
                            </a>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center space-x-2 group text-red-600 hover:bg-red-50 block w-full px-4 py-2 text-start text-sm leading-5 text-red-600">
                                    <i class="fas fa-sign-out-alt text-red-400 group-hover:text-red-600 transition-colors w-4"></i>
                                    <span>{{ __('Log Out') }}</span>
                                </a>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button @@click="open = ! open" class="mobile-menu-toggle inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200"
                            :aria-label="open ? 'Close menu' : 'Open menu'">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="sm:hidden bg-white/95 backdrop-blur-md border-t border-gray-200/60 shadow-lg"
         style="display: none;">

        <!-- Mobile Search -->
        <div class="px-4 pt-3 pb-2">
            <div class="relative">
                <input type="text"
                       placeholder="Search..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- Mobile Navigation Links -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center space-x-3 group">
                <i class="fas fa-tachometer-alt text-gray-400 group-hover:text-primary-500 w-5"></i>
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')" class="flex items-center space-x-3 group">
                <i class="fas fa-plus-circle text-gray-400 group-hover:text-primary-500 w-5"></i>
                <span>{{ __('Create Post') }}</span>
            </x-responsive-nav-link>
        </div>

        <!-- Mobile User Info & Actions -->
        <div class="pt-4 pb-3 border-t border-gray-200/60">
            <div class="px-4 space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-semibold shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 group px-4 py-2 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-user text-gray-400 group-hover:text-primary-500 w-5"></i>
                    <span>{{ __('Profile') }}</span>
                </a>

                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group px-4 py-2 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-cog text-gray-400 group-hover:text-primary-500 w-5"></i>
                    <span>{{ __('Settings') }}</span>
                </a>


                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center space-x-3 group text-red-600 hover:bg-red-50">
                        <i class="fas fa-sign-out-alt text-red-400 group-hover:text-red-600 w-5"></i>
                        <span>{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading Bar -->
    <div class="h-0.5 bg-gradient-to-r from-primary-500 to-primary-600 w-0 transition-all duration-300"
         id="navigation-progress"></div>
</nav>

<style>
    /* Smooth transitions for navigation elements */
    .nav-link-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Enhanced focus states */
    .focus-ring:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
        box-shadow: 0 0 0 2px theme('colors.white'), 0 0 0 4px theme('colors.primary.500');
    }

    /* Glass morphism effect */
    .glass {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Custom scrollbar for dropdowns */
    .dropdown-scroll {
        scrollbar-width: thin;
        scrollbar-color: theme('colors.gray.300') transparent;
    }

    .dropdown-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .dropdown-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .dropdown-scroll::-webkit-scrollbar-thumb {
        background-color: theme('colors.gray.300');
        border-radius: 3px;
    }
</style>

<script>
    // Enhanced navigation functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Progress bar animation
        const progressBar = document.getElementById('navigation-progress');
        if (progressBar) {
            setTimeout(() => {
                progressBar.style.width = '100%';
            }, 100);
        }

        // Note: rely on Alpine's @click.outside to close the mobile menu and
        // individual component @click.outside handlers for dropdowns. Avoid
        // manipulating Alpine state from external JS here.

        // Add scroll effect to navigation
        let lastScrollTop = 0;
        const navbar = document.querySelector('nav');

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scrolling down
                navbar.style.transform = 'translateY(-100%)';
            } else {
                // Scrolling up
                navbar.style.transform = 'translateY(0)';
            }

            lastScrollTop = scrollTop;
        });

        // Theme toggle functionality
        const themeToggle = document.querySelector('[title="Toggle theme"]');
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                const isDark = document.documentElement.classList.contains('dark');
                if (isDark) {
                    document.documentElement.classList.remove('dark');
                    this.innerHTML = '<i class="fas fa-moon"></i>';
                } else {
                    document.documentElement.classList.add('dark');
                    this.innerHTML = '<i class="fas fa-sun"></i>';
                }
            });
        }

        // Notification bell animation
        const notificationBell = document.querySelector('[title="Notifications"]');
        if (notificationBell) {
            notificationBell.addEventListener('click', function() {
                this.classList.add('animate-ping');
                setTimeout(() => {
                    this.classList.remove('animate-ping');
                }, 600);
            });
        }

        console.log('Enhanced navigation initialized');
    });

    // Alpine.js enhancements
    document.addEventListener('alpine:init', () => {
        Alpine.data('navigation', () => ({
            init() {
                // Initialize any navigation-specific Alpine functionality
                console.log('Navigation Alpine component initialized');
            }
        }));
    });
</script>
