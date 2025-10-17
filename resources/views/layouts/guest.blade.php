<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="guestData()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>
        <meta name="description" content="@yield('description', 'Welcome to our application')">

        <!-- Preload critical resources -->
        <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style">
        <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Enhanced gradient background with performance optimizations */
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #4c51bf 100%);
                background-size: 400% 400%;
                background-attachment: fixed;
                animation: gradientShift 20s ease infinite;
                position: relative;
                overflow: hidden;
            }

            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            /* Enhanced card animations */
            .card-hover {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                transform-style: preserve-3d;
            }

            .card-hover:hover {
                transform: translateY(-8px) scale(1.02) rotateX(2deg);
                box-shadow:
                    0 25px 50px -12px rgba(0, 0, 0, 0.25),
                    0 0 0 1px rgba(255, 255, 255, 0.1);
            }

            /* Enhanced logo animations */
            .logo-container {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                perspective: 1000px;
            }

            .logo-container:hover {
                transform: scale(1.08) rotateY(5deg);
            }

            /* Enhanced pulse animation */
            .pulse-animation {
                animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse {
                0%, 100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
                }
                50% {
                    transform: scale(1.05);
                    box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
                }
            }

            /* Enhanced floating shapes */
            .floating-shapes {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 1;
            }

            .shape {
                position: absolute;
                opacity: 0.1;
                border-radius: 50%;
                background: linear-gradient(135deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.2) 100%);
                animation: float 25s infinite linear;
                filter: blur(1px);
            }

            .shape:nth-child(1) {
                width: 80px;
                height: 80px;
                top: 20%;
                left: 10%;
                animation-delay: 0s;
                animation-duration: 25s;
            }

            .shape:nth-child(2) {
                width: 120px;
                height: 120px;
                top: 60%;
                left: 80%;
                animation-delay: -5s;
                animation-duration: 30s;
            }

            .shape:nth-child(3) {
                width: 60px;
                height: 60px;
                top: 80%;
                left: 20%;
                animation-delay: -10s;
                animation-duration: 20s;
            }

            .shape:nth-child(4) {
                width: 100px;
                height: 100px;
                top: 30%;
                left: 70%;
                animation-delay: -15s;
                animation-duration: 35s;
            }

            .shape:nth-child(5) {
                width: 70px;
                height: 70px;
                top: 40%;
                left: 40%;
                animation-delay: -7s;
                animation-duration: 28s;
            }

            @keyframes float {
                0% {
                    transform: translateY(0) rotate(0deg) translateX(0);
                }
                33% {
                    transform: translateY(-30px) rotate(120deg) translateX(20px);
                }
                66% {
                    transform: translateY(15px) rotate(240deg) translateX(-15px);
                }
                100% {
                    transform: translateY(0) rotate(360deg) translateX(0);
                }
            }

            /* Enhanced glass effect */
            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow:
                    0 8px 32px 0 rgba(31, 38, 135, 0.37),
                    inset 0 1px 0 0 rgba(255, 255, 255, 0.2);
            }

            /* Loading bar */
            .loading-bar {
                position: absolute;
                top: 0;
                left: 0;
                height: 3px;
                background: linear-gradient(90deg, #667eea, #764ba2, #4c51bf);
                width: 0%;
                transition: width 0.3s ease;
                z-index: 100;
            }

            /* Enhanced focus styles */
            .focus-ring:focus {
                outline: 2px solid transparent;
                box-shadow:
                    0 0 0 3px rgba(102, 126, 234, 0.5),
                    0 0 0 1px rgba(255, 255, 255, 0.9);
            }

            /* Reduced motion support */
            @media (prefers-reduced-motion: reduce) {
                .gradient-bg {
                    animation: none;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                }

                .card-hover:hover {
                    transform: none;
                }

                .shape {
                    animation: none;
                }
            }

            /* Mobile optimizations */
            @media (max-width: 640px) {
                .gradient-bg {
                    background-size: 200% 200%;
                    animation-duration: 15s;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Loading Bar -->
        <div class="loading-bar" id="loadingBar"></div>

        <!-- Enhanced Floating Background Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <div class="min-h-screen gradient-bg flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <!-- Enhanced Logo Section -->
            <div class="logo-container mb-8 text-center" x-data="{
                hover: false,
                rotate: 0
            }" @mouseenter="hover = true; rotate = 5" @mouseleave="hover = false; rotate = 0">
                <a href="/" class="inline-flex items-center space-x-3 group" :style="`transform: rotate(${rotate}deg)`">
                    <div class="relative">
                        <div class="absolute -inset-3 bg-white/30 rounded-full blur-xl group-hover:bg-white/40 transition-all duration-500"></div>
                        <div class="relative">
                            <img
                                src="{{ asset('image/logo.jpg') }}"
                                alt="{{ config('app.name', 'Laravel') }}"
                                class="w-20 h-20 rounded-full object-cover border-4 border-white/80 shadow-2xl transition-all duration-500 hover:shadow-3xl"
                                loading="eager"
                                onload="console.log('Logo loaded successfully')"
                                onerror="console.error('Logo failed to load')"
                            />

                        </div>
                    </div>
                    <div class="text-left">
                        <h1 class="text-4xl font-bold text-white drop-shadow-2xl bg-gradient-to-r from-white to-white/80 bg-clip-text text-transparent">
                            {{ config('app.name', 'Laravel') }}
                        </h1>
                        <p class="text-white/90 text-lg mt-2 font-medium tracking-wide">Welcome back</p>
                    </div>
                </a>
            </div>

            <!-- Enhanced Main Content Card -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 glass-effect shadow-2xl card-hover sm:rounded-2xl relative overflow-hidden"
                 x-data="{ loaded: false }"
                 x-init="setTimeout(() => loaded = true, 100)">
                <div x-show="loaded"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100">

                    <!-- Decorative Accent -->
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-purple-500 via-blue-500 to-cyan-500"></div>

                    <!-- Animated Background Pattern -->
                    <div class="absolute inset-0 opacity-5">
                        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><circle fill=\"%23667eea\" cx=\"30\" cy=\"30\" r=\"2\"/></g></svg>')"></div>
                    </div>

                    <!-- Content Slot -->
                    <div class="relative z-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Enhanced Footer Links -->
            <div class="mt-8 text-center space-y-4" x-data="{ currentYear: new Date().getFullYear() }">
                <!-- Quick Links -->
                <div class="flex flex-wrap justify-center gap-6">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="text-white/90 hover:text-white text-sm font-medium transition-all duration-300 flex items-center group hover:scale-110">
                            <i class="fas fa-sign-in-alt mr-2 group-hover:scale-110 transition-transform"></i>
                            <span class="border-b border-transparent group-hover:border-white/50 transition-all">Login</span>
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="text-white/90 hover:text-white text-sm font-medium transition-all duration-300 flex items-center group hover:scale-110">
                            <i class="fas fa-user-plus mr-2 group-hover:scale-110 transition-transform"></i>
                            <span class="border-b border-transparent group-hover:border-white/50 transition-all">Register</span>
                        </a>
                    @endif

                    <a href="#"
                       class="text-white/90 hover:text-white text-sm font-medium transition-all duration-300 flex items-center group hover:scale-110">
                        <i class="fas fa-question-circle mr-2 group-hover:scale-110 transition-transform"></i>
                        <span class="border-b border-transparent group-hover:border-white/50 transition-all">Help</span>
                    </a>

                    <a href="#"
                       class="text-white/90 hover:text-white text-sm font-medium transition-all duration-300 flex items-center group hover:scale-110">
                        <i class="fas fa-shield-alt mr-2 group-hover:scale-110 transition-transform"></i>
                        <span class="border-b border-transparent group-hover:border-white/50 transition-all">Privacy</span>
                    </a>
                </div>

                <!-- Copyright -->
                <div class="text-white/70 text-xs">
                    &copy; <span x-text="currentYear"></span> {{ config('app.name', 'Laravel') }}. All rights reserved.
                </div>
            </div>
        </div>

        <script>
            // Enhanced guest layout functionality
            function guestData() {
                return {
                    // Guest-specific functionality
                    init() {
                        console.log('Guest layout initialized');
                        this.initLoadingBar();
                        this.initAnimations();
                        this.initPerformanceMonitoring();
                    },

                    initLoadingBar() {
                        const loadingBar = document.getElementById('loadingBar');
                        if (loadingBar) {
                            // Simulate loading progress
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

                    initAnimations() {
                        // Initialize any guest-specific animations
                        console.log('Guest animations initialized');
                    },

                    initPerformanceMonitoring() {
                        // Performance monitoring for guest pages
                        if ('performance' in window) {
                            window.addEventListener('load', () => {
                                const perfData = performance.timing;
                                const loadTime = perfData.loadEventEnd - perfData.navigationStart;
                                console.log(`Guest page loaded in ${loadTime}ms`);

                                // Log Core Web Vitals if available
                                if ('webVitals' in window) {
                                    window.webVitals.getCLS(console.log);
                                    window.webVitals.getFID(console.log);
                                    window.webVitals.getFCP(console.log);
                                    window.webVitals.getLCP(console.log);
                                    window.webVitals.getTTFB(console.log);
                                }
                            });
                        }
                    },

                    // Utility functions for guest pages
                    scrollToTop() {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    },

                    showNotification(message, type = 'info') {
                        // Simple notification system for guest pages
                        const notification = document.createElement('div');
                        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white ${
                            type === 'info' ? 'bg-blue-500' :
                            type === 'success' ? 'bg-green-500' :
                            type === 'error' ? 'bg-red-500' : 'bg-yellow-500'
                        } z-50 transform transition-transform duration-300 translate-x-full`;
                        notification.textContent = message;

                        document.body.appendChild(notification);

                        requestAnimationFrame(() => {
                            notification.classList.remove('translate-x-full');
                        });

                        setTimeout(() => {
                            notification.classList.add('translate-x-full');
                            setTimeout(() => {
                                if (notification.parentNode) {
                                    notification.parentNode.removeChild(notification);
                                }
                            }, 300);
                        }, 3000);
                    }
                }
            }

            // Enhanced DOM ready handler for guest layout
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Guest layout DOM loaded');

                // Enhanced error handling for images
                document.querySelectorAll('img').forEach(img => {
                    img.addEventListener('error', function() {
                        console.warn('Image failed to load:', this.src);
                        this.style.opacity = '0.5';
                    });
                });

                // Enhanced form handling
                document.querySelectorAll('form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const submitBtn = this.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';

                            // Re-enable button if form submission fails
                            setTimeout(() => {
                                if (!this.checkValidity()) {
                                    submitBtn.disabled = false;
                                    submitBtn.innerHTML = submitBtn.getAttribute('data-original-text') || 'Submit';
                                }
                            }, 5000);
                        }
                    });
                });

                // Enhanced focus management for accessibility
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Tab') {
                        document.body.classList.add('keyboard-navigation');
                    }
                });

                document.addEventListener('mousedown', function() {
                    document.body.classList.remove('keyboard-navigation');
                });

                // Enhanced viewport checking
                const checkViewport = () => {
                    const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
                    const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);

                    if (vw < 640 || vh < 480) {
                        console.warn('Viewport size may affect user experience');
                    }
                };

                checkViewport();
                window.addEventListener('resize', checkViewport);

                // Enhanced network status monitoring
                window.addEventListener('online', function() {
                    console.log('Connection restored');
                    // You could show a notification here
                });

                window.addEventListener('offline', function() {
                    console.warn('Connection lost');
                    // You could show a notification here
                });
            });

            // Enhanced error boundary for guest layout
            window.addEventListener('error', function(e) {
                console.error('Guest layout error:', e.error);
                // Prevent layout breaking but log the error
                e.preventDefault();
            });
        </script>

        @stack('scripts')
        @endfiles
    </body>
</html>
