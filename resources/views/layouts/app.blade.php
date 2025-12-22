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
    {{-- Fallback: emit CSS links from Vite manifest if available (helps when @vite doesn't output tags on some hosts) --}}
    @php
        $manifestPath = public_path('build/manifest.json');
        if (file_exists($manifestPath)) {
            try {
                $manifest = json_decode(file_get_contents($manifestPath), true);
                if (isset($manifest['resources/js/app.js']['css']) && is_array($manifest['resources/js/app.js']['css'])) {
                    foreach ($manifest['resources/js/app.js']['css'] as $cssFile) {
                        echo '<link rel="stylesheet" href="' . asset('build/' . $cssFile) . '">';
                    }
                }
            } catch (\Throwable $e) {
                // ignore manifest parse errors — @vite will still be called below
            }
        }
    @endphp
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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


                <div id="main-content">
                    {{-- First try to use @yield for blade templates extending this layout --}}
                    @hasSection('content')
                        @yield('content')
                    @else
                        {{-- Fallback to $slot for blade components --}}
                        {{ $slot ?? '' }}
                    @endif
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
                        <form method="POST" action="{{ route('subscribe') }}" class="flex space-x-2">
                            @csrf
                            <input type="email" name="email" placeholder="Your email" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                Subscribe
                            </button>
                        </form>
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
        (function() {
            try {
                const spinner = document.getElementById('loading-spinner');
                if (!spinner) return;
                setTimeout(() => {
                    spinner.style.transition = 'opacity 0.3s ease';
                    spinner.style.opacity = '0';
                    setTimeout(() => { if (spinner.parentNode) spinner.parentNode.removeChild(spinner); }, 300);
                }, 4000);
            } catch (e) {
                // fail silently
                console && console.error && console.error('Spinner fallback error', e);
            }
        })();
    </script>

    @stack('scripts')
</body>
</html>
