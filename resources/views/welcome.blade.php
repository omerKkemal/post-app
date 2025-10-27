<x-app-layout>
    <x-slot name="title">
        {{ config('app.name', 'Laravel') }} - Welcome
    </x-slot>

    <x-slot name="description">
        {{ config('app.description', 'A modern Laravel application') }}
    </x-slot>

    <!-- Main content -->
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="text-center fade-in">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                    Welcome to
                    <span class="text-blue-600">{{ config('app.name', 'Laravel') }}</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                    {{ config('app.description', 'A modern web application built with Laravel and Tailwind CSS.') }}
            </p>
            </div>

            <!-- Features Section -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md fade-in">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Fast & Reliable</h3>
                    <p class="text-gray-600">Built with modern technologies for optimal performance and reliability.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md fade-in" style="animation-delay: 0.1s">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Secure</h3>
                    <p class="text-gray-600">Enterprise-grade security to keep your data safe and protected.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md fade-in" style="animation-delay: 0.2s">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">User Friendly</h3>
                    <p class="text-gray-600">Intuitive interface designed with user experience in mind.</p>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-20 text-center fade-in" style="animation-delay: 0.3s">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to get started?</h2>
                <p class="text-lg text-gray-600 mb-8">Join thousands of satisfied users today.</p>
                <a href="{{ route('register') }}"
                   class="btn btn-primary px-8 py-3 text-lg font-semibold">
                    Create Your Account
                </a>
            </div>
        </div>
    </div>

    <!-- Welcome page scripts moved to resources/js/welcome.js -->
</x-app-layout>
