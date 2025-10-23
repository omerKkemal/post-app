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

        /* Load More Button Styles */
        .btn-loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .error-message {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 1rem;
            border-radius: 0.375rem;
            margin: 1rem 0;
            text-align: center;
        }

        .hidden {
            display: none;
        }

        .load-more-container {
            text-align: center;
            margin: 3rem 0;
            padding: 2rem 0;
        }

        #load-more-btn {
            background-color: rgb(var(--color-primary));
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        #load-more-btn:hover:not(.btn-loading) {
            background-color: rgba(var(--color-primary), 0.9);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        #load-more-btn:active {
            transform: translateY(0);
        }

        #load-more-btn.btn-loading {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .loading-spinner {
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .no-more-posts {
            color: #6b7280;
            font-style: italic;
            margin-top: 1rem;
            padding: 1rem;
            background-color: #f9fafb;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .skip-link:focus {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
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

            <!-- Desktop navigation - REMOVE THE "hidden" CLASS -->
            <div class="md:flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Home</a>
                <a href="{{ url('/about') }}" class="text-gray-600 hover:text-blue-600 transition-colors">About</a>
                <a href="{{ url('/contact') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Contact</a>
                <div class="relative group">
                    <button class="text-gray-600 hover:text-blue-600 transition-colors focus:outline-none flex items-center">
                        Posts
                        <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                        <a href="{{ url('/p/har') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Harari</a>
                        <a href="{{ url('/p/eng') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">English</a>
                    </div>
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

            <!-- Posts Container -->
            <div id="posts-container">
                <!-- Post content -->
                @foreach ($posts as $post)
                <article class="post-card bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <!-- Post header -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div>
                                    <p class="text-sm text-gray-500">
                                        Posted on <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('M d, Y') }}</time>
                                    </p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                <span class="inline-flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Public Post
                                </span>
                            </div>
                        </div>

                        <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                        <div class="flex flex-wrap gap-2">
                            <span class="tag bg-blue-100 text-blue-800">{{ $post->category ?? 'Uncategorized' }}</span>
                        </div>
                    </div>

                    <!-- Post body -->
                    <div class="p-6 prose">
                        @php
                            $lines = preg_split('/\r\n|\r|\n/', $post->description);
                        @endphp

                        <div class="p-6 prose">
                            @foreach ($lines as $line)
                                @php $trim = trim($line); @endphp

                                @if (str_starts_with($trim, '**') && str_ends_with($trim, '**'))
                                    <h3 class="font-semibold text-lg mb-2">{{ trim($trim, '*') }}</h3>

                                @elseif (str_starts_with($trim, '*'))
                                    <ul class="list-disc ml-6">
                                        <li>{{ ltrim($trim, '* ') }}</li>
                                    </ul>

                                @elseif (str_starts_with($trim, '-'))
                                    <p class="text-gray-700 mb-2">{{ ltrim($trim, '- ') }}</p>

                                @else
                                    <p class="text-gray-700 mb-2">{{ $trim }}</p>
                                @endif
                            @endforeach
                        </div>

                        @if ($post->media_url)
                            @php
                                $extension = pathinfo($post->media_url, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ Storage::url($post->media_url) }}" alt="Post Image" class="rounded-lg mb-4 max-w-full h-auto">
                            @elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                                <video controls class="rounded-lg mb-4 max-w-full h-auto">
                                    <source src="{{ Storage::url($post->media_url) }}" type="video/{{ $extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endif
                    </div>

                    <!-- Post footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    <span>243</span>
                                </button>
                                <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span>42</span>
                                </button>
                            </div>
                            <div>
                                <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span>Share</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Load More Section - UPDATED FOR YOUR BACKEND -->
            <div id="load-more-container" class="load-more-container">
                <!-- Error Message -->
                <div id="error-message" class="error-message hidden"></div>

                <!-- Load More Button -->
                <button id="load-more-btn" class="btn-primary">
                    <span>Load More Posts</span>
                    <div id="load-more-spinner" class="loading-spinner hidden"></div>
                </button>

                <!-- No More Posts Message -->
                <p id="no-more-posts" class="no-more-posts hidden">
                    You've reached the end! No more posts to load.
                </p>
            </div>

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

    <!-- Load More Functionality Script - UPDATED FOR YOUR BACKEND API -->
    <script>
        let clickCount = 1; // Start from 1 for first click (page 1 in backend)
        let isLoading = false;
        let hasMorePosts = true;

        console.log('Script loaded. Initializing Load More functionality...');

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeLoadMore();
            initializeBackToTop();
            testLoadMore();
        });

        function initializeLoadMore() {
            const loadMoreBtn = document.getElementById('load-more-btn');
            console.log('DOM loaded. Button found:', loadMoreBtn);

            if (loadMoreBtn) {
                // Remove any existing listeners to prevent duplicates
                loadMoreBtn.replaceWith(loadMoreBtn.cloneNode(true));

                // Get the new button reference
                const newLoadMoreBtn = document.getElementById('load-more-btn');
                newLoadMoreBtn.addEventListener('click', handleLoadMore);
                console.log('Event listener attached to button');
            } else {
                console.error('Load More button not found!');
            }
        }

        function initializeBackToTop() {
            const backToTopBtn = document.getElementById('back-to-top');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.style.opacity = '1';
                } else {
                    backToTopBtn.style.opacity = '0';
                }
            });

            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        async function handleLoadMore() {
            console.log('Load More button clicked!');
            console.log('Current state:', { clickCount, isLoading, hasMorePosts });

            if (isLoading) {
                console.log('Already loading, ignoring click');
                return;
            }

            if (!hasMorePosts) {
                console.log('No more posts to load');
                showNoMorePosts();
                return;
            }

            isLoading = true;
            const button = document.getElementById('load-more-btn');
            const spinner = document.getElementById('load-more-spinner');
            const errorMessage = document.getElementById('error-message');

            // Hide error message if visible
            if (errorMessage) {
                errorMessage.classList.add('hidden');
            }

            if (!button) {
                console.error('Button element not found!');
                isLoading = false;
                return;
            }

            // Show loading state
            button.classList.add('btn-loading');
            if (spinner) {
                spinner.classList.remove('hidden');
            }
            button.disabled = true;

            try {
                console.log(`Fetching with clickCount: ${clickCount}`);
                const lang = window.location.href.split('/');
                const language = lang[lang.length - 1];
                console.log('Detected language:', language);
                // Use your backend endpoint with clickCount as URL parameter
                const response = await fetch(`/load-more-posts/${clickCount}/${language}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                console.log('Response status:', response.status);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('API response data:', data);

                if (data.success && data.posts && data.posts.length > 0) {
                    console.log(`Received ${data.posts.length} posts`);

                    // Append new posts with animation
                    await appendPostsWithAnimation(data.posts);

                    // Update state based on backend response
                    hasMorePosts = data.hasMore !== false;

                    // Increment clickCount for next request
                    clickCount++;

                    console.log(`Updated state - clickCount: ${clickCount}, hasMorePosts: ${hasMorePosts}`);

                    // Check if we should hide the button
                    if (!hasMorePosts) {
                        console.log('No more posts available');
                        showNoMorePosts();
                    }

                } else {
                    console.log('No posts received from API or API returned error');
                    if (!data.success) {
                        throw new Error(data.message || 'API returned error');
                    }
                    hasMorePosts = false;
                    showNoMorePosts();
                }

            } catch (error) {
                console.error('Error loading more posts:', error);
                showError('Failed to load posts. Please try again.');

            } finally {
                // Reset loading state
                isLoading = false;
                if (button) {
                    button.classList.remove('btn-loading');
                    button.disabled = false;
                }
                if (spinner) {
                    spinner.classList.add('hidden');
                }
                console.log('Load operation completed. isLoading:', isLoading);
            }
        }

        function appendPostsWithAnimation(posts) {
            return new Promise((resolve) => {
                const container = document.getElementById('posts-container');

                posts.forEach((post, index) => {
                    const postElement = createPostElement(post);
                    postElement.style.opacity = '0';
                    postElement.style.transform = 'translateY(20px)';
                    container.appendChild(postElement);

                    // Animate in with delay
                    setTimeout(() => {
                        postElement.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        postElement.style.opacity = '1';
                        postElement.style.transform = 'translateY(0)';
                    }, index * 100);
                });

                setTimeout(resolve, posts.length * 100 + 500);
            });
        }

        function showNoMorePosts() {
            const button = document.getElementById('load-more-btn');
            const noMoreMessage = document.getElementById('no-more-posts');
            const container = document.getElementById('load-more-container');

            if (button) {
                button.style.display = 'none';
            }

            if (noMoreMessage) {
                noMoreMessage.classList.remove('hidden');
            } else if (container) {
                container.innerHTML = '<p class="no-more-posts">You have loaded all posts!</p>';
            }
        }

        function showError(message) {
            const errorDiv = document.getElementById('error-message');
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.classList.remove('hidden');

                // Auto-hide error after 5 seconds
                setTimeout(() => {
                    errorDiv.classList.add('hidden');
                }, 5000);
            }
        }

        // Retry function
        function retryLoadMore() {
            console.log('Retrying load more...');
            const errorDiv = document.getElementById('error-message');
            if (errorDiv) {
                errorDiv.classList.add('hidden');
            }
            handleLoadMore();
        }

        function createPostElement(post) {
            console.log('Creating post element for:', post.title);

            const article = document.createElement('article');
            article.className = 'post-card bg-white rounded-lg shadow-md overflow-hidden mb-6 fade-in';

            // Format the description
            const descriptionHtml = formatDescription(post.description);

            // Format media URL
            let mediaHtml = '';
            if (post.media_url) {
                const extension = post.media_url.split('.').pop().toLowerCase();
                if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                    mediaHtml = `<img src="/storage/${post.media_url}" alt="Post Image" class="rounded-lg mb-4 max-w-full h-auto">`;
                } else if (['mp4', 'webm', 'ogg'].includes(extension)) {
                    mediaHtml = `
                        <video controls class="rounded-lg mb-4 max-w-full h-auto">
                            <source src="/storage/${post.media_url}" type="video/${extension}">
                            Your browser does not support the video tag.
                        </video>
                    `;
                }
            }

            article.innerHTML = `
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Posted on <time datetime="${post.created_at}">${new Date(post.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</time>
                                </p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="inline-flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Public Post
                            </span>
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mb-4">${post.title}</h1>

                    <div class="flex flex-wrap gap-2">
                        <span class="tag bg-blue-100 text-blue-800">${post.category || 'Uncategorized'}</span>
                    </div>
                </div>

                <div class="p-6 prose">
                    ${descriptionHtml}
                    ${mediaHtml}
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                <span>243</span>
                            </button>
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span>42</span>
                            </button>
                        </div>
                        <div>
                            <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                <span>Share</span>
                            </button>
                        </div>
                    </div>
                </div>
            `;

            return article;
        }

        function formatDescription(description) {
            const lines = description.split('\n');
            let html = '';

            lines.forEach(line => {
                const trim = line.trim();

                if (trim.startsWith('**') && trim.endsWith('**')) {
                    html += `<h3 class="font-semibold text-lg mb-2">${trim.slice(2, -2)}</h3>`;
                } else if (trim.startsWith('*')) {
                    html += `<ul class="list-disc ml-6"><li>${trim.slice(1).trim()}</li></ul>`;
                } else if (trim.startsWith('-')) {
                    html += `<p class="text-gray-700 mb-2">${trim.slice(1).trim()}</p>`;
                } else if (trim) {
                    html += `<p class="text-gray-700 mb-2">${trim}</p>`;
                }
            });

            return html;
        }

        // Test function
        function testLoadMore() {
            console.log('=== Testing Load More Functionality ===');
            console.log('1. Button exists:', !!document.getElementById('load-more-btn'));
            console.log('2. Spinner exists:', !!document.getElementById('load-more-spinner'));
            console.log('3. Posts container exists:', !!document.getElementById('posts-container'));
            console.log('4. Load more container exists:', !!document.getElementById('load-more-container'));
            console.log('5. Current clickCount:', clickCount);
            console.log('6. isLoading:', isLoading);
            console.log('7. hasMorePosts:', hasMorePosts);
            console.log('=== Test Complete ===');
        }
    </script>

    @stack('scripts')
</body>
</html>
