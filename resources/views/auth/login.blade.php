<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-700" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-2" />
            <x-text-input
                id="email"
                class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="Enter your email address"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700 mb-2" />

            <x-text-input
                id="password"
                class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-2 transition-all duration-200"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600 hover:text-gray-800 cursor-pointer transition-colors duration-200">
                    {{ __('Remember me') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 font-medium"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end">
            <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Or continue with</span>
            </div>
        </div>

        <!-- Social Login (Optional) -->
        <div class="grid grid-cols-2 gap-3">
            <button type="button" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all duration-200">
                <i class="fab fa-google text-red-500 mr-2"></i>
                Google
            </button>
            <button type="button" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all duration-200">
                <i class="fab fa-github text-gray-800 mr-2"></i>
                GitHub
            </button>
        </div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200 ml-1">
                        Sign up here
                    </a>
                </p>
            </div>
        @endif
    </form>

    <style>
        /* Enhanced form styles */
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom focus styles */
        input:focus, button:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
        }

        /* Smooth transitions for all interactive elements */
        a, button, input, label {
            transition: all 0.2s ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add interactive effects to form elements
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');

            inputs.forEach(input => {
                // Add focus styles
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-20');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-20');
                });

                // Add input validation styling
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.classList.add('border-green-300');
                    } else {
                        this.classList.remove('border-green-300');
                    }
                });
            });

            // Add loading state to submit button
            const form = document.querySelector('form');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function() {
                if (submitButton) {
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Logging in...';
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-75', 'cursor-not-allowed');
                }
            });

            // Add hover effects to social buttons
            const socialButtons = document.querySelectorAll('button[type="button"]');
            socialButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.classList.add('transform', 'scale-105');
                });

                button.addEventListener('mouseleave', function() {
                    this.classList.remove('transform', 'scale-105');
                });
            });
        });
    </script>
</x-guest-layout>
