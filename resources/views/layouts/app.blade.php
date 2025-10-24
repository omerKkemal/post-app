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
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* CSS Variables for consistent theming */
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
            background-color: #ffffff;
            font-family: 'Figtree', sans-serif;
        }

        .layout-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1 0 auto;
        }

        /* Loading Spinner */
        .loading-spinner {
            width: 3rem;
            height: 3rem;
            border: 3px solid #e5e7eb;
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Flash Messages */
        .flash-message {
            transition: all 0.3s ease;
        }

        .flash-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .flash-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .flash-warning {
            background-color: #fffbeb;
            border: 1px solid #fed7aa;
            color: #92400e;
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Page Transitions */
        .page-enter {
            opacity: 0;
            transform: translateY(10px);
        }

        .page-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        /* Focus styles for accessibility */
        .focus-visible:focus {
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

            .page-enter-active {
                transition: none;
            }
        }

        /* Footer Styles */
        .footer {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            border-top: 1px solid rgba(229, 231, 235, 0.6);
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased layout-container">

    <!-- Loading Spinner -->
    <div id="loading-spinner" class="fixed inset-0 bg-white/90 flex items-center justify-center z-50">
        <div class="text-center">
            <div class="loading-spinner mx-auto mb-4"></div>
            <p class="text-gray-600 font-medium">Loading {{ config('app.name', 'Laravel') }}...</p>
        </div>
    </div>

    <!-- Navigation -->
    <div class="content-wrapper">
        @include('layouts.navigation')

        <!-- Main Content -->
        <main class="page-enter">
            <!-- Page Content -->
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <!-- Flash Messages -->
                <div class="space-y-4 mb-8">
                    @if(session('success'))
                        <div class="flash-message flash-success p-4 rounded-lg flex items-center justify-between shadow-sm">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Success!</p>
                                    <p class="text-sm opacity-90">{{ session('success') }}</p>
                                </div>
                            </div>
                            <button class="text-green-600 hover:text-green-800 transition-colors close-flash">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="flash-message flash-error p-4 rounded-lg flex items-center justify-between shadow-sm">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-exclamation-circle text-red-500 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Error!</p>
                                    <p class="text-sm opacity-90">{{ session('error') }}</p>
                                </div>
                            </div>
                            <button class="text-red-600 hover:text-red-800 transition-colors close-flash">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="flash-message flash-warning p-4 rounded-lg flex items-center justify-between shadow-sm">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-exclamation-triangle text-yellow-500 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Warning!</p>
                                    <p class="text-sm opacity-90">{{ session('warning') }}</p>
                                </div>
                            </div>
                            <button class="text-yellow-600 hover:text-yellow-800 transition-colors close-flash">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Main Slot Content -->
                <div id="main-content">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                <!-- Brand Section -->
                <div class="text-center md:text-left">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">{{ config('app.name', 'Laravel') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Building amazing experiences with modern web technologies.
                        Join our community and stay connected.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="text-center md:text-left">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Quick Links</h3>
                    <div class="flex flex-col space-y-2">
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">
                            Privacy Policy
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">
                            Terms of Service
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">
                            Contact Us
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">
                            About
                        </a>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="text-center md:text-left">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Connect With Us</h3>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <!-- Facebook -->
                        <a href="#" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors shadow-sm" aria-label="Facebook">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>

                        <!-- Twitter -->
                        <a href="#" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors shadow-sm" aria-label="Twitter">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>

                        <!-- Instagram -->
                        <a href="#" class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors shadow-sm" aria-label="Instagram">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>

                        <!-- LinkedIn -->
                        <a href="#" class="w-10 h-10 bg-blue-800 text-white rounded-full flex items-center justify-center hover:bg-blue-900 transition-colors shadow-sm" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in text-sm"></i>
                        </a>

                        <!-- GitHub -->
                        <a href="#" class="w-10 h-10 bg-gray-800 text-white rounded-full flex items-center justify-center hover:bg-gray-900 transition-colors shadow-sm" aria-label="GitHub">
                            <i class="fab fa-github text-sm"></i>
                        </a>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Subscribe to our newsletter</p>
                        <div class="flex space-x-2">
                            <input type="email" placeholder="Your email" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-6 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-center md:text-left text-gray-600 text-sm">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </div>
                    <div class="flex items-center space-x-6 text-sm">
                        <span class="text-gray-500">Follow us:</span>
                        <div class="flex space-x-3">
                            <a href="#" class="text-gray-500 hover:text-blue-600 transition-colors" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-blue-400 transition-colors" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-pink-600 transition-colors" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Remove loading spinner
            function removeLoadingSpinner() {
                const spinner = document.getElementById('loading-spinner');
                if (spinner) {
                    spinner.style.transition = 'opacity 0.3s ease';
                    spinner.style.opacity = '0';
                    setTimeout(() => {
                        if (spinner.parentNode) {
                            spinner.parentNode.removeChild(spinner);
                        }
                    }, 300);
                }
            }

            // Initialize page transition
            function initPageTransition() {
                const mainElement = document.querySelector('main');
                if (mainElement) {
                    mainElement.classList.add('page-enter-active');
                }
            }

            // Handle flash messages
            function initFlashMessages() {
                // Auto-remove flash messages after 5 seconds
                setTimeout(() => {
                    document.querySelectorAll('.flash-message').forEach(message => {
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
                    });
                }, 5000);

                // Close flash messages on button click
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

                            setTimeout(() => {
                                if (message.parentNode) {
                                    message.parentNode.removeChild(message);
                                }
                            }, 300);
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

            // Start initialization
            initializeApp();

            // Fallback: remove spinner if page takes too long
            setTimeout(removeLoadingSpinner, 3000);

            // Handle page load
            window.addEventListener('load', function() {
                removeLoadingSpinner();
            });
        });

        // Global error handling
        window.addEventListener('error', function(e) {
            console.error('Error:', e.error);
        });

        window.addEventListener('unhandledrejection', function(e) {
            console.error('Unhandled promise rejection:', e.reason);
        });
    </script>

    @stack('scripts')
</body>
</html>
