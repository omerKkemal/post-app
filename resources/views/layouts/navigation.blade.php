<nav x-data="navigation('{{ Route::currentRouteName() }}')"
     x-init="init()"
     data-current-route="{{ Route::currentRouteName() }}"
     class="bg-white/95 backdrop-blur-md border-b border-gray-200/60 shadow-sm sticky top-0 z-40 transition-all duration-300 dark:bg-gray-900/95 dark:border-gray-700/60"
     :class="{ 'shadow-lg': scrolled }"
     @scroll.window="scrolled = window.scrollY > 10">

    <!-- Enhanced Loading Bar -->
    <div class="loading-bar absolute top-0 left-0 h-1 bg-gradient-to-r from-blue-500 to-purple-500 transition-all duration-300"
         :style="`width: ${loadingProgress}%`"
         x-show="loadingProgress > 0 && loadingProgress < 100"></div>

    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Enhanced Logo/Brand Section -->
            <div class="flex items-center space-x-3">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center -ml-2">
                    <a href="{{ url('/') }}"
                       class="flex items-center space-x-3 group transition-all duration-300 hover:scale-105">
                        <div class="relative">
                            <div class="absolute -inset-3 bg-blue-100 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 dark:bg-blue-900/30"></div>
                            <img
                                src="{{ asset('image/logo.jpg') }}"
                                alt="{{ config('app.name', 'Laravel') }}"
                                class="relative w-10 h-10 rounded-full object-cover border-2 border-white shadow-lg transition-all duration-300 group-hover:shadow-xl group-hover:border-blue-200 dark:border-gray-600"
                                loading="eager"
                            />
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent dark:from-blue-400 dark:to-purple-400">
                                {{ config('app.name', 'Laravel') }}
                            </span>
                            <span class="text-xs text-gray-500 font-medium dark:text-white hidden md:block">
                                @auth Dashboard @else Welcome @endauth
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Center: navigation links (evenly spaced) -->
            <div class="hidden md:flex flex-1 justify-evenly items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group"
                       :class="currentRoute === 'dashboard' ? 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                        <i class="fas fa-home text-sm w-5"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('post.create') }}" class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group"
                       :class="currentRoute === 'post.create' ? 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                        <i class="fas fa-share-square text-sm w-5"></i>
                        <span>Create a Post</span>
                    </a>

                    <a href="{{ route('congress.view') }}" class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group"
                       :class="currentRoute === 'congress.view' ? 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                        <i class="fas fa-user-tie text-sm w-5"></i>
                        <span>Add Congress Leader</span>
                    </a>

                    <a href="{{ route('post.category') }}" class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group"
                       :class="currentRoute === 'category.show' ? 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                        <i class="fas fa-tags text-sm w-5"></i>
                        <span>Category Management</span>
                    </a>

                    <!-- View Post Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                            <i class="fas fa-eye text-sm w-5"></i>
                            <span>View Post</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open" @click.outside="open = false" class="absolute top-full left-0 mt-2 w-48 bg-white/95 backdrop-blur-md border border-gray-200 rounded-lg shadow-xl z-50 transition-all duration-200 dark:bg-gray-800/95 dark:border-gray-700"
                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                            <div class="py-1">
                                <a href="{{ route('post.view', ['language' => 'har']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700 transition-colors duration-200 {{ request('language') == 'har' ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-300' : '' }}">View Post (Harari)</a>
                                <a href="{{ route('post.view', ['language' => 'eng']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700 transition-colors duration-200 {{ request('language') == 'eng' ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-300' : '' }}">View Post (English)</a>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Public User Navigation - ONLY Main Links (No Login/Register/Theme here) -->
                    <a href="{{ url('/') }}" class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group"
                       :class="currentRoute === 'home' ? 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                        <i class="fas fa-home text-sm w-5"></i>
                        <span>Home</span>
                    </a>

                    <a href="{{ url('/about') }}" class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group"
                       :class="currentRoute === 'about' ? 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                        <i class="fas fa-info-circle text-sm w-5"></i>
                        <span>About</span>
                    </a>

                    <a href="{{ url('/contact') }}" class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group"
                       :class="currentRoute === 'contact' ? 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                        <i class="fas fa-envelope text-sm w-5"></i>
                        <span>Contact</span>
                    </a>

                    <!-- What's New Dropdown for Public Users -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="nav-link px-3 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 group text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                            <i class="fas fa-newspaper text-sm w-5"></i>
                            <span>What's New</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open"
                             @click.outside="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             class="absolute top-full left-0 mt-2 w-48 bg-white/95 backdrop-blur-md border border-gray-200 rounded-lg shadow-xl z-50 transition-all duration-200 dark:bg-gray-800/95 dark:border-gray-700">
                            <a href="{{ route('postView', ['language' => 'har']) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700 transition-colors duration-200 {{ request('language') == 'har' ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-300' : '' }}">
                                Harari
                            </a>
                            <a href="{{ route('postView', ['language' => 'eng']) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700 transition-colors duration-200 {{ request('language') == 'eng' ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-300' : '' }}">
                                English
                            </a>
                        </div>
                    </div>

                    <!-- REMOVED: Login, Register, and Theme Toggle from center section -->
                    <!-- These now only appear in the right section -->
                @endauth
            </div>

            <!-- Enhanced Search & Controls -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Enhanced User Profile Dropdown (Logged In) -->
                    <div class="relative dropdown-container" x-data="{ open: false }">
                        <button id="user-dropdown-trigger"
                                @click="open = !open"
                                class="user-dropdown-trigger group"
                                :class="{ 'bg-gray-100 dark:bg-gray-800': open }">
                            <span class="sr-only">Open user menu</span>
                            <div class="flex items-center space-x-3">
                                <div class="user-avatar group-hover:shadow-lg transition-all duration-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-white">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200 group-hover:text-gray-600 dark:text-white dark:group-hover:text-white"
                                   :class="{ 'rotate-180': open }"></i>
                            </div>
                        </button>

                        <!-- Enhanced User Dropdown Menu -->
                        <div id="user-dropdown-menu"
                             class="dropdown-menu w-64"
                             x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             @click.outside="open = false">
                            <!-- User Info -->
                            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center space-x-3">
                                    <div class="user-avatar w-12 h-12 text-base">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                                            {{ Auth::user()->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-white">
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Navigation Links -->
                            <div class="py-2">
                                <a href="{{ route('profile.edit') }}"
                                   class="dropdown-item group">
                                    <i class="fas fa-user-circle"></i>
                                    <span>Profile</span>
                                    <span class="ml-auto text-xs text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300">⌘P</span>
                                </a>

                                <a href="#" class="dropdown-item group">
                                    <i class="fas fa-cog"></i>
                                    <span>Settings</span>
                                    <span class="ml-auto text-xs text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300">⌘,</span>
                                </a>

                                <!-- Logout -->
                                <div class="py-2 border-t border-gray-200 dark:border-gray-700">
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit"
                                                class="dropdown-item group text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 w-full text-left">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Log Out</span>
                                            <span class="ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200">⌘Q</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                @endauth

                <!-- Mobile menu button -->
                <button class="md:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white dark:hover:text-white dark:hover:bg-gray-800"
                        aria-label="Toggle menu"
                        @click="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced Mobile Navigation Menu -->
    <div x-show="showMobileMenu"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="md:hidden border-t border-gray-200 bg-white/95 backdrop-blur-md dark:bg-gray-900/95 dark:border-gray-700"
         x-cloak>
        <div class="px-2 pt-2 pb-3 space-y-1">
            @auth
                <!-- Mobile Navigation Links (Logged In) -->
                <a href="{{ route('dashboard') }}"
                   class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200"
                   :class="currentRoute === 'dashboard' ?
                          'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' :
                          'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                    <i class="fas fa-home w-6 mr-3 text-center"></i>
                    Dashboard
                </a>

                <a href="{{ route('post.create') }}"
                   class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200"
                   :class="currentRoute === 'post.create' ?
                          'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' :
                          'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                    <i class="fas fa-share-square w-6 mr-3 text-center"></i>
                    Create a Post
                </a>

                <!-- add a congress leader link -->
                <a href="{{ route('congress.view') }}"
                   class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200"
                   :class="currentRoute === 'congress.view' ?
                          'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' :
                          'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                    <i class="fas fa-user-tie w-6 mr-3 text-center"></i>
                    Add Congress Leader
                </a>

                <!-- category management link -->
                <a href="{{ route('post.category')}}"
                class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200"
                :class="currentRoute === 'category.show' ?
                       'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' :
                       'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                 <i class="fas fa-tags w-6 mr-3 text-center"></i>
                 Category Management
             </a>

                <!-- Mobile View Post Links -->
                <div class="border-t border-gray-200 pt-2 dark:border-gray-700">
                    <a href="{{ route('post.view', ['language' => 'har']) }}"
                       class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                        <i class="fas fa-eye w-6 mr-3 text-center"></i>
                        View Post (Harari)
                    </a>
                    <a href="{{ route('post.view', ['language' => 'eng']) }}"
                       class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                        <i class="fas fa-eye w-6 mr-3 text-center"></i>
                        View Post (English)
                    </a>
                </div>

                <a href="{{ route('profile.edit') }}"
                   class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                    <i class="fas fa-user-circle w-6 mr-3 text-center"></i>
                    Profile
                </a>

                <!-- Mobile Logout -->
                <div class="border-t border-gray-200 pt-2 dark:border-gray-700">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                                class="mobile-nav-link block w-full text-left px-3 py-3 rounded-lg text-base font-medium text-red-600 hover:text-red-700 hover:bg-red-50 transition-all duration-200 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/20">
                            <i class="fas fa-sign-out-alt w-6 mr-3 text-center"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <!-- Mobile Navigation Links (Not Logged In) -->
                <a href="{{ url('/') }}"
                   class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200"
                   :class="currentRoute === 'home' ?
                          'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' :
                          'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:text-white dark:hover:bg-gray-800'">
                    <i class="fas fa-home w-6 mr-3 text-center"></i>
                    Home
                </a>

                <a href="{{ url('/about') }}"
                   class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                    <i class="fas fa-info-circle w-6 mr-3 text-center"></i>
                    About
                </a>

                <a href="{{ url('/contact') }}"
                   class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                    <i class="fas fa-envelope w-6 mr-3 text-center"></i>
                    Contact
                </a>

                <!-- Mobile What's New Links -->
                <div class="border-t border-gray-200 pt-2 dark:border-gray-700">
                    <a href="{{ route('postView', ['language' => 'har']) }}"
                       class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                        <i class="fas fa-newspaper w-6 mr-3 text-center"></i>
                        What's New (Harari)
                    </a>
                    <a href="{{ route('postView', ['language' => 'eng']) }}"
                       class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 dark:text-white dark:hover:text-white dark:hover:bg-gray-800">
                        <i class="fas fa-newspaper w-6 mr-3 text-center"></i>
                        What's New (English)
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
