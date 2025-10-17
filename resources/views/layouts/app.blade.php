<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>
        <meta name="description" content="@yield('description', 'Welcome to our application')">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* CSS Custom Properties for theming */
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

            /* Prevent layout shift and ensure body stays visible */
            html, body {
                min-height: 100vh;
                width: 100%;
                overflow-x: hidden;
            }

            body {
                position: relative;
                opacity: 1 !important;
                visibility: visible !important;
                display: block !important;
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

            .page-transition-enter {
                opacity: 0;
                transform: translateY(10px);
            }

            .page-transition-enter-active {
                opacity: 1;
                transform: translateY(0);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            .gradient-bg {
                background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
                background-attachment: fixed;
            }

            .gradient-text {
                background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Fix for potential z-index issues */
            .fixed-element {
                z-index: 1000;
            }

            /* Ensure content stays visible */
            .main-content {
                position: relative;
                min-height: 60vh;
            }

            /* Loading spinner fixes */
            #loading-spinner {
                z-index: 9999;
            }

            /* Dropdown Styles */
            .dropdown-container {
                position: relative;
                display: inline-block;
            }

            .dropdown-menu {
                position: absolute;
                right: 0;
                top: 100%;
                margin-top: 0.5rem;
                background: white;
                border: 1px solid #e5e7eb;
                border-radius: 0.5rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                min-width: 200px;
                z-index: 50;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: all 0.2s ease-in-out;
            }

            .dropdown-menu.open {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .dropdown-item {
                display: flex;
                align-items: center;
                width: 100%;
                padding: 0.75rem 1rem;
                text-align: left;
                color: #374151;
                transition: all 0.2s;
                border: none;
                background: none;
                cursor: pointer;
            }

            .dropdown-item:hover {
                background-color: #f3f4f6;
            }

            .dropdown-item i {
                margin-right: 0.75rem;
                width: 16px;
                text-align: center;
            }

            .dropdown-divider {
                height: 1px;
                background-color: #e5e7eb;
                margin: 0.25rem 0;
            }

            /* User dropdown trigger */
            .user-dropdown-trigger {
                display: flex;
                align-items: center;
                padding: 0.5rem;
                border-radius: 0.375rem;
                transition: all 0.2s;
                cursor: pointer;
                border: none;
                background: none;
            }

            .user-dropdown-trigger:hover {
                background-color: #f3f4f6;
            }

            .user-avatar {
                width: 2rem;
                height: 2rem;
                border-radius: 50%;
                background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: 600;
                font-size: 0.875rem;
            }

            .user-name {
                margin-left: 0.5rem;
                margin-right: 0.5rem;
                font-weight: 500;
                color: #374151;
            }

            /* NOTE: Removed aggressive visibility overrides that interfered with
               Alpine.js x-show and transition inline styles. If you need to
               protect only the loading spinner from being hidden, scope rules
               specifically to `#loading-spinner` instead of using global
               attribute selectors. */
        </style>

        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-blue-50 to-cyan-50 layout-container">

        <!-- Loading Spinner with Safe Removal -->
        <div id="loading-spinner" class="fixed inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="text-center">
                <div class="w-16 h-16 border-4 border-primary-500 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-gray-600 font-medium">Loading {{ config('app.name', 'Laravel') }}...</p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="content-wrapper">
        @include('layouts.navigation') <!-- 👈 this loads nav.blade.php -->

            <!-- Main Content -->
            <main class="main-content page-transition-enter">
                <!-- Page Content -->
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <!-- Flash Messages -->
                    <div class="space-y-4 mb-8">
                        @if(session('success'))
                            <div class="p-4 bg-green-50 border border-green-200 rounded-xl flex items-center shadow-sm">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-green-800 font-semibold">Success!</h3>
                                    <p class="text-green-600 text-sm mt-1">{{ session('success') }}</p>
                                </div>
                                <button class="text-green-500 hover:text-green-700 transition-colors ml-4 close-flash">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="p-4 bg-red-50 border border-red-200 rounded-xl flex items-center shadow-sm">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-red-800 font-semibold">Error!</h3>
                                    <p class="text-red-600 text-sm mt-1">{{ session('error') }}</p>
                                </div>
                                <button class="text-red-500 hover:text-red-700 transition-colors ml-4 close-flash">
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

        <!-- Footer -->
        <footer class="bg-white/80 backdrop-blur-md border-t border-gray-200/60 mt-auto">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-gray-600 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </div>
            </div>
        </footer>

        <script>
            // Enhanced layout stability script with dropdown functionality
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM loaded - initializing layout stability');

                // Dropdown functionality
                const initDropdown = () => {
                    const dropdownTrigger = document.getElementById('user-dropdown-trigger');
                    const dropdownMenu = document.getElementById('user-dropdown-menu');

                    if (!dropdownTrigger || !dropdownMenu) {
                        console.warn('Dropdown elements not found');
                        return;
                    }

                    // Toggle dropdown visibility
                    const toggleDropdown = () => {
                        const isOpen = dropdownMenu.classList.contains('open');

                        if (isOpen) {
                            dropdownMenu.classList.remove('open');
                        } else {
                            dropdownMenu.classList.add('open');
                        }
                    };

                    // Close dropdown when clicking outside
                    const closeDropdown = (event) => {
                        if (!dropdownTrigger.contains(event.target) && !dropdownMenu.contains(event.target)) {
                            dropdownMenu.classList.remove('open');
                        }
                    };

                    // Set up event listeners
                    dropdownTrigger.addEventListener('click', (e) => {
                        // e.stopPropagation();
                        toggleDropdown();
                    });

                    document.addEventListener('click', closeDropdown);

                    // Close dropdown on escape key
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape' && dropdownMenu.classList.contains('open')) {
                            dropdownMenu.classList.remove('open');
                        }
                    });

                    console.log('Dropdown functionality initialized');
                };


                document.addEventListener('DOMContentLoaded', () => {
                    document.querySelectorAll('#user-dropdown-menu .dropdown-item').forEach(item => {
                        item.addEventListener('click', function () {
                        const href = this.getAttribute('data-href');
                        if (href) window.location.href = href;
                        });
                    });
                });

                // Ensure body is always visible
                const ensureBodyVisibility = () => {
                    const body = document.body;
                    const html = document.documentElement;

                    // Force body visibility
                    body.style.opacity = '1';
                    body.style.visibility = 'visible';
                    body.style.display = 'block';
                    body.style.height = 'auto';
                    body.style.minHeight = '100vh';

                    // Force html visibility
                    html.style.opacity = '1';
                    html.style.visibility = 'visible';
                    html.style.height = 'auto';

                    console.log('Body visibility enforced');
                };

                // Safe loading spinner removal
                const safeRemoveSpinner = () => {
                    const spinner = document.getElementById('loading-spinner');
                    if (spinner) {
                        // Use requestAnimationFrame for smooth removal
                        requestAnimationFrame(() => {
                            spinner.style.transition = 'opacity 0.5s ease';
                            spinner.style.opacity = '0';

                            setTimeout(() => {
                                if (spinner.parentNode) {
                                    spinner.parentNode.removeChild(spinner);
                                }
                                console.log('Loading spinner safely removed');
                            }, 500);
                        });
                    }
                };

                // Layout stability monitor
                const monitorLayout = () => {
                    const monitor = document.getElementById('layout-monitor');
                    const checkInterval = setInterval(() => {
                        const body = document.body;
                        const mainContent = document.querySelector('main');
                        const slotContent = document.getElementById('main-slot-content');

                        // Check if critical elements exist and are visible
                        if (!body || !mainContent || !slotContent) {
                            console.error('Critical layout elements missing!');
                            location.reload();
                            return;
                        }

                        // Check visibility
                        const bodyStyle = window.getComputedStyle(body);
                        if (bodyStyle.display === 'none' || bodyStyle.visibility === 'hidden' || bodyStyle.opacity === '0') {
                            console.warn('Body visibility compromised - fixing');
                            ensureBodyVisibility();
                        }

                        // Monitor content
                        monitor.textContent = `Layout OK - ${new Date().toLocaleTimeString()}`;
                    }, 1000);

                    return checkInterval;
                };

                // Initialize everything
                const initializeLayout = () => {
                    // Ensure body visibility first
                    ensureBodyVisibility();

                    // Initialize dropdown
                    initDropdown();

                    // Remove spinner after a safe delay
                    setTimeout(safeRemoveSpinner, 1000);

                    // Start layout monitoring
                    const monitorInterval = monitorLayout();

                    // Add page transition
                    const main = document.querySelector('main');
                    if (main) {
                        setTimeout(() => {
                            main.classList.add('page-transition-enter-active');
                        }, 100);
                    }

                    // Close flash messages safely
                    document.querySelectorAll('.close-flash').forEach(button => {
                        button.addEventListener('click', function() {
                            const message = this.closest('[class*="bg-"]');
                            if (message) {
                                message.style.transition = 'all 0.3s ease';
                                message.style.opacity = '0';
                                message.style.maxHeight = '0';
                                message.style.margin = '0';
                                message.style.padding = '0';
                                message.style.overflow = 'hidden';

                                setTimeout(() => {
                                    if (message.parentNode) {
                                        message.parentNode.removeChild(message);
                                    }
                                }, 300);
                            }
                        });
                    });

                    // Auto-remove flash messages after delay
                    setTimeout(() => {
                        document.querySelectorAll('[class*="bg-"]').forEach(message => {
                            if (message.classList.contains('bg-green-50') ||
                                message.classList.contains('bg-red-50') ||
                                message.classList.contains('bg-blue-50')) {
                                message.style.transition = 'all 0.3s ease';
                                message.style.opacity = '0';
                                setTimeout(() => {
                                    if (message.parentNode) {
                                        message.parentNode.removeChild(message);
                                    }
                                }, 300);
                            }
                        });
                    }, 5000);

                    console.log('Layout stability system initialized');
                };

                // Start initialization
                initializeLayout();

                // Additional safety checks on window load
                window.addEventListener('load', function() {
                    console.log('Window fully loaded - performing final checks');
                    ensureBodyVisibility();
                    safeRemoveSpinner();
                });

                // Handle potential page hide/show events
                document.addEventListener('visibilitychange', function() {
                    if (!document.hidden) {
                        ensureBodyVisibility();
                    }
                });

                // Prevent any script from hiding the body
                const originalDisplay = Object.getOwnPropertyDescriptor(HTMLElement.prototype, 'style')?.get;
                if (originalDisplay) {
                    Object.defineProperty(HTMLElement.prototype, 'style', {
                        get: function() {
                            const style = originalDisplay.call(this);
                            if (this === document.body || this === document.documentElement) {
                                const originalSetProperty = style.setProperty;
                                style.setProperty = function(property, value, priority) {
                                    if (property === 'display' && value === 'none') {
                                        console.warn('Prevented body from being hidden');
                                        return;
                                    }
                                    if (property === 'visibility' && value === 'hidden') {
                                        console.warn('Prevented body visibility change');
                                        return;
                                    }
                                    if (property === 'opacity' && value === '0') {
                                        console.warn('Prevented body opacity change');
                                        return;
                                    }
                                    return originalSetProperty.call(this, property, value, priority);
                                };
                            }
                            return style;
                        }
                    });
                }
            });

            // Global error handler to prevent layout destruction
            window.addEventListener('error', function(e) {
                console.error('Global error caught:', e.error);
                // Prevent the error from breaking the layout
                e.preventDefault();
            });

            // Handle unhandled promise rejections
            window.addEventListener('unhandledrejection', function(e) {
                console.error('Unhandled promise rejection:', e.reason);
                e.preventDefault();
            });
        </script>

        @stack('scripts')
    </body>
</html>
