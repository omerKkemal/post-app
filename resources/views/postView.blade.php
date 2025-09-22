<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3b82f6">
    <meta name="description" content="View public post - {{ config('app.name', 'Laravel') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Public Post - {{ config('app.name', 'Laravel') }}</title>

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

        .post-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .prose {
            max-width: none;
            line-height: 1.75;
        }

        .prose h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .prose p {
            margin-bottom: 1.25rem;
        }

        .prose ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .prose blockquote {
            border-left: 4px solid rgb(var(--color-primary));
            padding-left: 1rem;
            font-style: italic;
            margin: 1.5rem 0;
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
                <a href="{{ url('/p') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Post View</a>

            </div>
        </nav>

        <!-- Mobile menu (hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 py-2 px-4">
            <a href="{{ url('/') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">Home</a>
            <a href="{{ url('/about') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">About</a>
            <a href="{{ url('/contact') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">Contact</a>
            <a href="{{ url('/p') }}" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">Post View</a>

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

        <!-- Public Post Content -->
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6 text-sm text-gray-600" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="{{ url('/') }}" class="hover:text-blue-600 transition-colors">Home</a>
                        <svg class="h-4 w-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a href="#" class="hover:text-blue-600 transition-colors">Posts</a>
                        <svg class="h-4 w-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li class="text-gray-800" aria-current="page">Public Post</li>
                </ol>
            </nav>

            <!-- Post content -->
            <article class="post-card bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Post header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-600 font-medium">AU</span>
                            </div>
                            <div>
                                <p class="font-medium">Author Username</p>
                                <p class="text-sm text-gray-500">Posted on <time datetime="2023-05-15">May 15, 2023</time></p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="inline-flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Public Post
                            </span>
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Understanding the Fundamentals of Modern Web Development</h1>

                    <div class="flex flex-wrap gap-2">
                        <span class="tag bg-blue-100 text-blue-800">Web Development</span>
                        <span class="tag bg-green-100 text-green-800">Laravel</span>
                        <span class="tag bg-purple-100 text-purple-800">Tailwind CSS</span>
                    </div>
                </div>

                <!-- Post body -->
                <div class="p-6 prose">
                    <p class="lead text-lg text-gray-700 font-medium">In today's digital landscape, understanding the core principles of web development is more important than ever. This post explores the fundamental concepts that every developer should know.</p>

                    <p>Web development has evolved significantly over the past decade. With the advent of modern frameworks and tools, developers can now create more sophisticated and performant applications than ever before.</p>

                    <h2>Key Technologies</h2>

                    <p>The modern web development stack typically includes:</p>

                    <ul>
                        <li>Frontend frameworks like React, Vue, or Angular</li>
                        <li>Backend technologies such as Laravel, Node.js, or Django</li>
                        <li>Database systems like MySQL, PostgreSQL, or MongoDB</li>
                        <li>Deployment platforms including AWS, Docker, and Vercel</li>
                    </ul>

                    <p>Each of these technologies plays a crucial role in the development process and contributes to the overall success of a project.</p>

                    <h2>Best Practices</h2>

                    <p>Adhering to best practices is essential for creating maintainable and scalable applications. Some key practices include:</p>

                    <ul>
                        <li>Writing clean, readable code</li>
                        <li>Implementing proper testing strategies</li>
                        <li>Using version control effectively</li>
                        <li>Following security guidelines</li>
                    </ul>

                    <p>By following these practices, developers can ensure that their applications are robust, secure, and easy to maintain over time.</p>

                    <blockquote>
                        <p>"The web is becoming the platform for all applications, and understanding how to build for it is a critical skill for developers."</p>
                    </blockquote>

                    <p>As the web continues to evolve, developers must stay up-to-date with the latest trends and technologies to remain competitive in the field.</p>
                </div>

                <!-- Post footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                <span>243</span>
                            </button>
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span>42</span>
                            </button>
                        </div>
                        <div>
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                <span>Share</span>
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related posts -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Posts</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="post-card bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <span class="text-xs font-semibold text-blue-600 uppercase">Tutorial</span>
                            <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Getting Started with Laravel</h3>
                            <p class="text-gray-600 mb-4">A comprehensive guide for beginners to start with the Laravel PHP framework.</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span>May 10, 2023</span>
                                <span class="mx-2">•</span>
                                <span>8 min read</span>
                            </div>
                        </div>
                    </div>

                    <div class="post-card bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <span class="text-xs font-semibold text-green-600 uppercase">Guide</span>
                            <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Mastering Tailwind CSS</h3>
                            <p class="text-gray-600 mb-4">Learn how to efficiently use Tailwind CSS to build modern user interfaces.</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span>April 28, 2023</span>
                                <span class="mx-2">•</span>
                                <span>12 min read</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <li><a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Home</a></li>
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

        // Add hover effects to post cards
        document.querySelectorAll('.post-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
