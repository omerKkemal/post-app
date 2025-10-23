<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3b82f6">
    <meta name="description" content="{{ config('app.description', 'A modern Laravel application') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Preload critical assets -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="preload" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700"></noscript>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif

    <!-- Additional styles for components -->
    <style>
        :root {
            --color-primary: 59, 130, 246;
            --color-secondary: 107, 114, 128;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: rgb(var(--color-primary));
            color: white;
        }

        .btn-primary:hover {
            background-color: rgba(var(--color-primary), 0.9);
            transform: translateY(-1px);
        }
    </style>

    @stack('head')
</head>
<body class="font-sans antialiased bg-white text-gray-900 min-h-screen flex flex-col">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="skip-link sr-only focus:not-sr-only focus:absolute focus:px-4 focus:py-2 focus:bg-blue-600 focus:text-white focus:z-50">
        Skip to main content
    </a>

    <!-- Header with navigation -->
    <header class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">
        <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600 flex items-center gap-2">
                <!-- Optional logo here -->
                {{ config('app.name', 'Laravel') }}
            </a>

            <!-- Mobile menu button -->
            <button class="md:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-label="Toggle menu"
                    onclick="toggleMobileMenu()">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Desktop navigation -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Home</a>
                <a href="{{ url('/about') }}" class="text-gray-600 hover:text-blue-600 transition-colors">About</a>
                <a href="{{ url('/contact') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Contact</a>
                <!-- convert this to dropdown -->
                <div class="relative group">
                    <button class="text-gray-600 hover:text-blue-600 transition-colors focus:outline-none">
                        Posts
                    </button>
                    <div class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                        <a href="{{ url('/p/har') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Harari</a>
                        <a href="{{ url('/p/eng') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">English</a>
                    </div>

            </div>
        </nav>

        <!-- Mobile menu (hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 py-2 px-4">
            <a href="{{ url('/') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">Home</a>
            <a href="{{ url('/about') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">About</a>
            <a href="{{ url('/contact') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">Contact</a>
            <div class="relative group">
                <button class="text-gray-600 hover:text-blue-600 transition-colors focus:outline-none">
                    Posts
                </button>
                <div class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                    <a href="{{ url('/p/har') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Harari</a>
                    <a href="{{ url('/p/eng') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">English</a>
                </div>

            </div>

        </div>
    </header>

    <!-- Main content -->
    <main id="main-content" class="flex-grow container mx-auto px-4 py-8 fade-in">
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t border-gray-200 mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ config('app.name', 'Laravel') }}</h3>
                    <p class="text-gray-600">A modern web application built with Laravel and Tailwind CSS.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Dashboard</a></li>
                        <li><a href="{{ url('/about') }}" class="text-gray-600 hover:text-blue-600 transition-colors">About</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Contact</a></li>
                        <li><a href="{{ url('/privacy') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ url('/terms') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Terms of Service</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors" aria-label="Twitter">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors" aria-label="GitHub">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-200 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button id="back-to-top" class="fixed bottom-4 right-4 p-3 bg-blue-600 text-white rounded-full shadow-md opacity-0 transition-opacity duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" aria-label="Back to top">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <!-- Optional Scripts -->
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Back to top button
        window.addEventListener('scroll', function() {
            const backToTopButton = document.getElementById('back-to-top');
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0');
                backToTopButton.classList.add('opacity-100');
            } else {
                backToTopButton.classList.remove('opacity-100');
                backToTopButton.classList.add('opacity-0');
            }
        });

        document.getElementById('back-to-top').addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Close flash messages after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
