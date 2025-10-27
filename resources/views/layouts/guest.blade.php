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
        @stack('styles')
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

        <!-- Guest page scripts are bundled in resources/js/guest.js and imported through Vite -->

        @stack('scripts')
    </body>
</html>
