<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                background-size: 400% 400%;
                animation: gradientShift 15s ease infinite;
            }

            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .logo-container {
                transition: all 0.3s ease;
            }

            .logo-container:hover {
                transform: scale(1.05) rotate(2deg);
            }

            .pulse-animation {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }

            .floating-shapes {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 0;
            }

            .shape {
                position: absolute;
                opacity: 0.1;
                border-radius: 50%;
                background: white;
                animation: float 20s infinite linear;
            }

            .shape:nth-child(1) {
                width: 80px;
                height: 80px;
                top: 20%;
                left: 10%;
                animation-delay: 0s;
            }

            .shape:nth-child(2) {
                width: 120px;
                height: 120px;
                top: 60%;
                left: 80%;
                animation-delay: -5s;
            }

            .shape:nth-child(3) {
                width: 60px;
                height: 60px;
                top: 80%;
                left: 20%;
                animation-delay: -10s;
            }

            .shape:nth-child(4) {
                width: 100px;
                height: 100px;
                top: 30%;
                left: 70%;
                animation-delay: -15s;
            }

            @keyframes float {
                0% {
                    transform: translateY(0) rotate(0deg);
                }
                50% {
                    transform: translateY(-20px) rotate(180deg);
                }
                100% {
                    transform: translateY(0) rotate(360deg);
                }
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Floating Background Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <div class="min-h-screen gradient-bg flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <!-- Logo Section with Enhanced Design -->
            <div class="logo-container mb-8 text-center">
                <a href="/" class="inline-flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="absolute -inset-2 bg-white/20 rounded-full blur-md group-hover:bg-white/30 transition-all duration-300"></div>
                        <img
                            src="{{ asset('image/logo.jpg') }}"
                            alt="{{ config('app.name', 'Laravel') }}"
                            class="relative w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg pulse-animation group-hover:shadow-xl transition-all duration-300"
                        />
                    </div>
                    <div class="text-left">
                        <h1 class="text-3xl font-bold text-white drop-shadow-md">{{ config('app.name', 'Laravel') }}</h1>
                        <p class="text-white/80 text-sm mt-1 font-medium">Welcome back</p>
                    </div>
                </a>
            </div>

            <!-- Main Content Card -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 glass-effect shadow-2xl card-hover sm:rounded-2xl relative overflow-hidden">
                <!-- Decorative Accent -->
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-purple-500 to-blue-500"></div>

                <!-- Content Slot -->
                {{ $slot }}
            </div>

            <!-- Footer Links -->
            <div class="mt-8 text-center space-y-4">
                <!-- Quick Links -->
                <div class="flex justify-center space-x-6">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-white/80 hover:text-white text-sm font-medium transition-colors duration-200 flex items-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white/80 hover:text-white text-sm font-medium transition-colors duration-200 flex items-center">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register
                        </a>
                    @endif

                    <a href="#" class="text-white/80 hover:text-white text-sm font-medium transition-colors duration-200 flex items-center">
                        <i class="fas fa-question-circle mr-2"></i>
                        Help
                    </a>
                </div>

                <!-- Copyright -->
                <div class="text-white/60 text-xs">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </div>
            </div>
        </div>

        <script>
            // Add interactive effects
            document.addEventListener('DOMContentLoaded', function() {
                // Add loading animation to logo
                const logo = document.querySelector('.logo-container img');
                if (logo) {
                    logo.addEventListener('load', function() {
                        this.classList.add('loaded');
                    });
                }

                // Add parallax effect to shapes
                const shapes = document.querySelectorAll('.shape');
                window.addEventListener('mousemove', function(e) {
                    const mouseX = e.clientX / window.innerWidth;
                    const mouseY = e.clientY / window.innerHeight;

                    shapes.forEach((shape, index) => {
                        const speed = (index + 1) * 0.5;
                        const x = (mouseX - 0.5) * speed * 20;
                        const y = (mouseY - 0.5) * speed * 20;

                        shape.style.transform = `translate(${x}px, ${y}px)`;
                    });
                });

                // Add focus styles for accessibility
                const focusableElements = document.querySelectorAll('a, button, input, textarea, select');
                focusableElements.forEach(element => {
                    element.addEventListener('focus', function() {
                        this.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-50');
                    });

                    element.addEventListener('blur', function() {
                        this.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-50');
                    });
                });
            });
        </script>
    </body>
</html>
