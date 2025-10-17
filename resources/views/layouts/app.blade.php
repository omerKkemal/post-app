<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" x-data="appData()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>
        <meta name="description" content="@yield('description', 'Welcome to our application')">

        <!-- Preload critical resources -->
        <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* CSS Custom Properties for theming with dark mode support */
            :root {
                --primary-color: #0ea5e9;
                --primary-dark: #0369a1;
                --success-color: #10b981;
                --warning-color: #f59e0b;
                --error-color: #ef4444;
                --text-primary: #1f2937;
                --text-secondary: #6b7280;
                --bg-primary: #ffffff;
                --bg-secondary: #f8fafc;
                --border-color: #e5e7eb;
                --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                --radius-sm: 0.375rem;
                --radius-md: 0.5rem;
                --radius-lg: 0.75rem;
                --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }



            /* Performance optimizations */
            * {
                box-sizing: border-box;
            }

            html, body {
                min-height: 100vh;
                width: 100%;
                overflow-x: hidden;
                scroll-behavior: smooth;
            }

            body {
                position: relative;
                opacity: 1 !important;
                visibility: visible !important;
                display: block !important;
                background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
                background-attachment: fixed;
                transition: background-color 0.3s ease;
            }

            .layout-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .content-wrapper {
                flex: 1 0 auto;
                position: relative;
                z-index: 1;
            }

            /* Enhanced transitions */
            .page-transition-enter {
                opacity: 0;
                transform: translateY(10px);
            }

            .page-transition-enter-active {
                opacity: 1;
                transform: translateY(0);
                transition: opacity 0.4s ease, transform 0.4s ease;
            }

            /* Gradient utilities */
            .gradient-text {
                background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }


            /* Enhanced dropdown with animations */
            .dropdown-container {
                position: relative;
                display: inline-block;
            }

            .dropdown-menu {
                position: absolute;
                right: 0;
                top: 100%;
                margin-top: 0.5rem;
                background: var(--bg-primary);
                border: 1px solid var(--border-color);
                border-radius: var(--radius-md);
                box-shadow: var(--shadow-lg);
                min-width: 200px;
                z-index: 50;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px) scale(0.95);
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .dropdown-menu.open {
                opacity: 1;
                visibility: visible;
                transform: translateY(0) scale(1);
            }

            .dropdown-item {
                display: flex;
                align-items: center;
                width: 100%;
                padding: 0.75rem 1rem;
                text-align: left;
                color: var(--text-primary);
                transition: all 0.2s;
                border: none;
                background: none;
                cursor: pointer;
                font-size: 0.875rem;
            }

            .dropdown-item:hover {
                background-color: color-mix(in srgb, var(--primary-color) 5%, transparent);
            }

            .dropdown-item i {
                margin-right: 0.75rem;
                width: 16px;
                text-align: center;
                opacity: 0.7;
            }

            /* Enhanced user dropdown */
            .user-dropdown-trigger {
                display: flex;
                align-items: center;
                padding: 0.5rem;
                border-radius: var(--radius-sm);
                transition: all 0.2s;
                cursor: pointer;
                border: none;
                background: none;
            }

            .user-dropdown-trigger:hover {
                background-color: color-mix(in srgb, var(--primary-color) 10%, transparent);
            }

            .user-avatar {
                width: 2rem;
                height: 2rem;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: 600;
                font-size: 0.875rem;
                transition: transform 0.2s ease;
            }

            .user-dropdown-trigger:hover .user-avatar {
                transform: scale(1.05);
            }

            /* Focus styles for accessibility */
            .focus-visible {
                outline: 2px solid var(--primary-color);
                outline-offset: 2px;
            }

            /* Reduced motion support */
            @media (prefers-reduced-motion: reduce) {
                * {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }
        </style>

        @stack('styles')
    </head>
    <body class="font-sans antialiased layout-container">

        <!-- Enhanced Loading Spinner -->
        <div id="loading-spinner" class="fixed inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-500 dark:bg-gray-900/90">
            <div class="text-center">
                <div class="w-16 h-16 border-4 border-primary-500 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-gray-600 font-medium dark:text-gray-300">Loading {{ config('app.name', 'Laravel') }}...</p>
                <p class="text-gray-500 text-sm mt-2 dark:text-gray-400">Please wait while we prepare your experience</p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="content-wrapper">
            @include('layouts.navigation')

            <!-- Main Content -->
            <main class="main-content page-transition-enter" x-data="{
                init() {
                    // Add entrance animation
                    this.$nextTick(() => {
                        this.$el.classList.add('page-transition-enter-active');
                    });
                }
            }">
                <!-- Page Content -->
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <!-- Enhanced Flash Messages -->
                    <div class="space-y-4 mb-8" x-data="flashMessages()">
                        @if(session('success'))
                            <div class="flash-message success p-4 bg-green-50 border border-green-200 rounded-xl flex items-center shadow-sm dark:bg-green-900/20 dark:border-green-800">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4 dark:bg-green-900/30">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-green-800 font-semibold dark:text-green-300">Success!</h3>
                                    <p class="text-green-600 text-sm mt-1 dark:text-green-400">{{ session('success') }}</p>
                                </div>
                                <button class="text-green-500 hover:text-green-700 transition-colors ml-4 close-flash dark:text-green-400 dark:hover:text-green-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="flash-message error p-4 bg-red-50 border border-red-200 rounded-xl flex items-center shadow-sm dark:bg-red-900/20 dark:border-red-800">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4 dark:bg-red-900/30">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-red-800 font-semibold dark:text-red-300">Error!</h3>
                                    <p class="text-red-600 text-sm mt-1 dark:text-red-400">{{ session('error') }}</p>
                                </div>
                                <button class="text-red-500 hover:text-red-700 transition-colors ml-4 close-flash dark:text-red-400 dark:hover:text-red-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if(session('warning'))
                            <div class="flash-message warning p-4 bg-yellow-50 border border-yellow-200 rounded-xl flex items-center shadow-sm dark:bg-yellow-900/20 dark:border-yellow-800">
                                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-4 dark:bg-yellow-900/30">
                                    <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-yellow-800 font-semibold dark:text-yellow-300">Warning!</h3>
                                    <p class="text-yellow-600 text-sm mt-1 dark:text-yellow-400">{{ session('warning') }}</p>
                                </div>
                                <button class="text-yellow-500 hover:text-yellow-700 transition-colors ml-4 close-flash dark:text-yellow-400 dark:hover:text-yellow-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Main Slot Content -->
                    <div id="main-slot-content">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>

        <!-- Enhanced Footer -->
        <footer class="bg-white/80 backdrop-blur-md border-t border-gray-200/60 mt-auto dark:bg-gray-900/80 dark:border-gray-700/60">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-center md:text-left text-gray-600 text-sm dark:text-gray-400">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </div>
                    <div class="flex items-center space-x-6 text-sm">
                        <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors dark:text-gray-400 dark:hover:text-gray-300">
                            Privacy Policy
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors dark:text-gray-400 dark:hover:text-gray-300">
                            Terms of Service
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors dark:text-gray-400 dark:hover:text-gray-300">
                            Contact
                        </a>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            // Enhanced application functionality with Alpine.js
            function appData() {
                return {
                    // Global app state
                    init() {
                        console.log('App initialized');

                        // Initialize any global functionality
                        this.initFlashMessages();
                        this.initLoadingSpinner();
                    },

                    initFlashMessages() {
                        // Flash messages are now handled by the flashMessages component
                    },

                    initLoadingSpinner() {
                        // Spinner is handled by the safeRemoveSpinner function
                    },

                    // Global utility functions
                    formatDate(date) {
                        return new Date(date).toLocaleDateString();
                    },

                    formatCurrency(amount, currency = 'USD') {
                        return new Intl.NumberFormat('en-US', {
                            style: 'currency',
                            currency: currency
                        }).format(amount);
                    }
                }
            }

            function flashMessages() {
                return {
                    init() {
                        // Auto-remove flash messages after delay
                        setTimeout(() => {
                            this.removeAllFlashMessages();
                        }, 5000);
                    },

                    removeMessage(element) {
                        element.style.transition = 'all 0.3s ease';
                        element.style.opacity = '0';
                        element.style.maxHeight = '0';
                        element.style.margin = '0';
                        element.style.padding = '0';
                        element.style.overflow = 'hidden';

                        setTimeout(() => {
                            if (element.parentNode) {
                                element.parentNode.removeChild(element);
                            }
                        }, 300);
                    },

                    removeAllFlashMessages() {
                        document.querySelectorAll('.flash-message').forEach(message => {
                            this.removeMessage(message);
                        });
                    }
                }
            }

            // Enhanced layout stability script
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM loaded - initializing enhanced layout system');

                // Initialize dropdown functionality
                const initDropdown = () => {
                    const dropdownTrigger = document.getElementById('user-dropdown-trigger');
                    const dropdownMenu = document.getElementById('user-dropdown-menu');

                    if (!dropdownTrigger || !dropdownMenu) {
                        console.warn('Dropdown elements not found');
                        return;
                    }

                    const toggleDropdown = () => {
                        const isOpen = dropdownMenu.classList.contains('open');
                        dropdownMenu.classList.toggle('open', !isOpen);
                    };

                    const closeDropdown = (event) => {
                        if (!dropdownTrigger.contains(event.target) && !dropdownMenu.contains(event.target)) {
                            dropdownMenu.classList.remove('open');
                        }
                    };

                    dropdownTrigger.addEventListener('click', (e) => {
                        e.stopPropagation();
                        toggleDropdown();
                    });

                    document.addEventListener('click', closeDropdown);
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape' && dropdownMenu.classList.contains('open')) {
                            dropdownMenu.classList.remove('open');
                        }
                    });

                    // Handle dropdown item clicks
                    document.querySelectorAll('#user-dropdown-menu .dropdown-item').forEach(item => {
                        item.addEventListener('click', function() {
                            const href = this.getAttribute('data-href');
                            if (href) {
                                window.location.href = href;
                            }
                            dropdownMenu.classList.remove('open');
                        });
                    });

                    console.log('Dropdown functionality initialized');
                };

                // Enhanced body visibility assurance
                const ensureBodyVisibility = () => {
                    const body = document.body;
                    const html = document.documentElement;

                    // Force body visibility with enhanced checks
                    ['opacity', 'visibility', 'display', 'height', 'minHeight'].forEach(prop => {
                        body.style[prop] = prop === 'minHeight' ? '100vh' :
                                          prop === 'display' ? 'block' : '1';
                    });

                    html.style.opacity = '1';
                    html.style.visibility = 'visible';
                    html.style.height = 'auto';

                    console.log('Body visibility enforced');
                };

                // Safe loading spinner removal with enhanced animation
                const safeRemoveSpinner = () => {
                    const spinner = document.getElementById('loading-spinner');
                    if (spinner) {
                        requestAnimationFrame(() => {
                            spinner.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                            spinner.style.opacity = '0';
                            spinner.style.transform = 'scale(0.95)';

                            setTimeout(() => {
                                if (spinner.parentNode) {
                                    spinner.parentNode.removeChild(spinner);
                                }
                                console.log('Loading spinner safely removed');
                            }, 500);
                        });
                    }
                };

                // Enhanced layout monitoring
                const monitorLayout = () => {
                    const checkInterval = setInterval(() => {
                        const body = document.body;
                        const mainContent = document.querySelector('main');
                        const slotContent = document.getElementById('main-slot-content');

                        // Enhanced element checking
                        const criticalElements = { body, mainContent, slotContent };
                        let allElementsExist = true;

                        Object.entries(criticalElements).forEach(([name, element]) => {
                            if (!element) {
                                console.error(`Critical layout element missing: ${name}`);
                                allElementsExist = false;
                            }
                        });

                        if (!allElementsExist) {
                            console.error('Critical layout elements missing - attempting recovery');
                            location.reload();
                            return;
                        }

                        // Enhanced visibility checking
                        const bodyStyle = window.getComputedStyle(body);
                        const visibilityProps = {
                            display: bodyStyle.display,
                            visibility: bodyStyle.visibility,
                            opacity: bodyStyle.opacity
                        };

                        if (visibilityProps.display === 'none' ||
                            visibilityProps.visibility === 'hidden' ||
                            visibilityProps.opacity === '0') {
                            console.warn('Body visibility compromised - fixing');
                            ensureBodyVisibility();
                        }

                    }, 2000); // Check every 2 seconds

                    return checkInterval;
                };

                // Initialize everything with error handling
                const initializeLayout = () => {
                    try {
                        ensureBodyVisibility();
                        initDropdown();

                        // Enhanced spinner removal with network status check
                        if (document.readyState === 'complete') {
                            safeRemoveSpinner();
                        } else {
                            window.addEventListener('load', safeRemoveSpinner);
                            // Fallback timeout
                            setTimeout(safeRemoveSpinner, 3000);
                        }

                        const monitorInterval = monitorLayout();

                        // Enhanced flash message handling
                        document.querySelectorAll('.close-flash').forEach(button => {
                            button.addEventListener('click', function() {
                                const message = this.closest('.flash-message');
                                if (message) {
                                    const flashMessages = Alpine.$data(button.closest('[x-data]'));
                                    if (flashMessages && flashMessages.removeMessage) {
                                        flashMessages.removeMessage(message);
                                    }
                                }
                            });
                        });

                        // Enhanced focus management for accessibility
                        document.addEventListener('keydown', (e) => {
                            if (e.key === 'Tab') {
                                document.body.classList.add('keyboard-navigation');
                            }
                        });

                        document.addEventListener('mousedown', () => {
                            document.body.classList.remove('keyboard-navigation');
                        });

                        console.log('Enhanced layout stability system initialized');
                    } catch (error) {
                        console.error('Layout initialization error:', error);
                        // Ensure basic functionality even if enhancements fail
                        ensureBodyVisibility();
                        safeRemoveSpinner();
                    }
                };

                // Start initialization
                initializeLayout();

                // Enhanced window load handler
                window.addEventListener('load', function() {
                    console.log('Window fully loaded - performing final checks');
                    ensureBodyVisibility();
                    safeRemoveSpinner();

                    // Remove any existing spinners (safety measure)
                    document.querySelectorAll('#loading-spinner').forEach(spinner => {
                        spinner.remove();
                    });
                });

                // Enhanced visibility change handling
                document.addEventListener('visibilitychange', function() {
                    if (!document.hidden) {
                        ensureBodyVisibility();
                    }
                });

                // Performance monitoring
                if ('performance' in window) {
                    window.addEventListener('load', () => {
                        setTimeout(() => {
                            const perfData = performance.timing;
                            const loadTime = perfData.loadEventEnd - perfData.navigationStart;
                            console.log(`Page loaded in ${loadTime}ms`);
                        }, 0);
                    });
                }
            });

            // Enhanced global error handling
            window.addEventListener('error', function(e) {
                console.error('Global error caught:', e.error);
                // Prevent the error from breaking the layout but log it
                if (typeof Sentry !== 'undefined') {
                    Sentry.captureException(e.error);
                }
            });

            window.addEventListener('unhandledrejection', function(e) {
                console.error('Unhandled promise rejection:', e.reason);
                e.preventDefault();
            });

            // Service Worker registration (optional)
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js')
                        .then(function(registration) {
                            console.log('SW registered: ', registration);
                        })
                        .catch(function(registrationError) {
                            console.log('SW registration failed: ', registrationError);
                        });
                });
            }
        </script>

        @stack('scripts')
    </body>
</html>
