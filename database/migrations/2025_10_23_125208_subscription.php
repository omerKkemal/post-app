<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Dashboard') }}
                    </h2>
                    <p class="text-gray-600 mt-1">Welcome back! Here's your activity overview.</p>
                </div>
                <a href="{{ route('post.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('Create Post') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-6 text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">{{ __("You're logged in!") }}</h3>
                            <p class="text-blue-100">Great to see you back. Here's your content overview.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Posts Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Total Posts</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $numberOfPosts }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Categories</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $numberOfPostsByCategory->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subscriptions Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-18 0v1.5a2.5 2.5 0 005 0V12"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Subscriptions</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $numberOfSubscriptions }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Activity Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Active</h3>
                                <p class="text-2xl font-bold text-gray-900">Now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Category Distribution Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            Category Distribution
                        </h3>
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- subscribtion over time chart  -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-18 0v1.5a2.5 2.5 0 005 0V12"></path>
                            </svg>
                            Subscriptions Over Time
                        </h3>
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="subscriptionChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Posts Over Time Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Posts Over Time
                        </h3>
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="timeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- subscription list -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 mb-8">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-18 0v1.5a2.5 2.5 0 005 0V12"></path>
                            </svg>
                            Subscriptions List
                            <span class="ml-2 text-sm font-normal text-gray-500">
                                ({{ $subscriptions->count() }} total)
                            </span>
                        </h3>

                        <!-- Search Filter Bar -->
                        <div class="flex items-center space-x-2">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="subscriptionSearch"
                                    placeholder="Search by email..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 w-full sm:w-64"
                                >
                            </div>

                            <button
                                id="clearSearch"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200"
                                style="display: none;"
                            >
                                Clear
                            </button>
                        </div>
                    </div>

                    <!-- Search Results Message (initially hidden) -->
                    <div id="searchResultsMessage" class="mb-4 text-sm text-gray-600" style="display: none;"></div>

                    <!-- No Results Message (initially hidden) -->
                    <div id="noResultsMessage" class="mb-4 text-center py-8 text-gray-500" style="display: none;">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>No subscriptions found matching your search.</p>
                    </div>

                    <div id="subscriptionsContainer" class="space-y-3 max-h-64 overflow-y-auto">
                        @foreach($subscriptions as $subscription)
                            <div class="subscription-item flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex items-center">
                                    <span class="font-medium text-gray-700 subscription-email">{{ $subscription->email }}</span>
                                </div>
                                <span class="text-sm text-gray-500">Subscribed on {{ \Carbon\Carbon::parse($subscription->created_at)->format('M d, Y') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Initially hidden message when no subscriptions -->
                    @if($subscriptions->isEmpty())
                        <div id="noSubscriptionsMessage" class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-18 0v1.5a2.5 2.5 0 005 0V12"></path>
                            </svg>
                            <p>No subscriptions yet.</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Categories List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Posts by Category
                    </h3>
                    <div class="space-y-3">
                        @foreach($numberOfPostsByCategory as $category => $count)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <span class="font-medium text-gray-700">{{ $category }}</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $count }} posts
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Expose server-side dashboard data to bundled JS
        window.__DASHBOARD_DATA__ = {
            numberOfPosts: {!! json_encode($numberOfPosts ?? 0) !!},
            numberOfPostsByCategory: {
                labels: {!! json_encode($numberOfPostsByCategory->keys()) !!},
                values: {!! json_encode($numberOfPostsByCategory->values()) !!}
            },
            postsOverTime: {!! json_encode($postsOverTime ?? []) !!},
            subscriptionsOverTime: {!! json_encode($subscriptionsOverTime ?? []) !!}
        };
    </script>

    <!-- Add JavaScript for search functionality -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('subscriptionSearch');
        const clearButton = document.getElementById('clearSearch');
        const subscriptionsContainer = document.getElementById('subscriptionsContainer');
        const subscriptionItems = document.querySelectorAll('.subscription-item');
        const searchResultsMessage = document.getElementById('searchResultsMessage');
        const noResultsMessage = document.getElementById('noResultsMessage');
        const noSubscriptionsMessage = document.getElementById('noSubscriptionsMessage');

        // Initialize counters
        let totalItems = subscriptionItems.length;

        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            // Show/hide clear button based on search input
            if (searchTerm.length > 0) {
                clearButton.style.display = 'block';
            } else {
                clearButton.style.display = 'none';
                searchResultsMessage.style.display = 'none';
                noResultsMessage.style.display = 'none';
            }

            // If there are no subscription items (empty list), handle accordingly
            if (totalItems === 0) {
                if (noSubscriptionsMessage) {
                    noSubscriptionsMessage.style.display = 'block';
                }
                subscriptionsContainer.style.display = 'none';
                return;
            }

            // If search is empty, show all items
            if (searchTerm === '') {
                subscriptionItems.forEach(item => {
                    item.style.display = 'flex';
                });
                subscriptionsContainer.style.display = 'block';
                if (noSubscriptionsMessage) {
                    noSubscriptionsMessage.style.display = 'none';
                }
                return;
            }

            // Filter items based on search term
            subscriptionItems.forEach(item => {
                const emailElement = item.querySelector('.subscription-email');
                const email = emailElement ? emailElement.textContent.toLowerCase() : '';

                if (email.includes(searchTerm)) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Update search results message
            if (searchTerm.length > 0) {
                if (visibleCount === 0) {
                    searchResultsMessage.style.display = 'none';
                    noResultsMessage.style.display = 'block';
                    subscriptionsContainer.style.display = 'none';
                    if (noSubscriptionsMessage) {
                        noSubscriptionsMessage.style.display = 'none';
                    }
                } else {
                    searchResultsMessage.textContent = `Found ${visibleCount} subscription${visibleCount !== 1 ? 's' : ''} matching "${searchTerm}"`;
                    searchResultsMessage.style.display = 'block';
                    noResultsMessage.style.display = 'none';
                    subscriptionsContainer.style.display = 'block';
                    if (noSubscriptionsMessage) {
                        noSubscriptionsMessage.style.display = 'none';
                    }
                }
            } else {
                searchResultsMessage.style.display = 'none';
                noResultsMessage.style.display = 'none';
                subscriptionsContainer.style.display = 'block';
                if (noSubscriptionsMessage) {
                    noSubscriptionsMessage.style.display = 'none';
                }
            }
        }

        // Event listeners
        searchInput.addEventListener('input', performSearch);

        clearButton.addEventListener('click', function() {
            searchInput.value = '';
            performSearch();
            searchInput.focus();
        });

        // Add keyboard shortcuts
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                searchInput.value = '';
                performSearch();
            }
            if (e.key === 'Enter' && searchInput.value.trim()) {
                // Perform search on Enter as well (though input event handles it)
                performSearch();
            }
        });

        // Initialize search state
        performSearch();

        // Dashboard chart initialization moved to resources/js/dashboard.js (bundled)
        // Initialize charts if data is available
        if (window.__DASHBOARD_DATA__) {
            // Category Distribution Chart
            if (document.getElementById('categoryChart')) {
                const categoryCtx = document.getElementById('categoryChart').getContext('2d');
                new Chart(categoryCtx, {
                    type: 'doughnut',
                    data: {
                        labels: window.__DASHBOARD_DATA__.numberOfPostsByCategory.labels,
                        datasets: [{
                            data: window.__DASHBOARD_DATA__.numberOfPostsByCategory.values,
                            backgroundColor: [
                                '#3B82F6', // blue-500
                                '#10B981', // green-500
                                '#F59E0B', // yellow-500
                                '#8B5CF6', // purple-500
                                '#EF4444', // red-500
                                '#EC4899', // pink-500
                                '#06B6D4', // cyan-500
                                '#F97316', // orange-500
                            ],
                            borderWidth: 1,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                            }
                        }
                    }
                });
            }

            // Subscriptions Over Time Chart
            if (document.getElementById('subscriptionChart') && window.__DASHBOARD_DATA__.subscriptionsOverTime) {
                const subscriptionCtx = document.getElementById('subscriptionChart').getContext('2d');
                const subscriptionData = window.__DASHBOARD_DATA__.subscriptionsOverTime;
                new Chart(subscriptionCtx, {
                    type: 'line',
                    data: {
                        labels: subscriptionData.map(item => item.date),
                        datasets: [{
                            label: 'Subscriptions',
                            data: subscriptionData.map(item => item.count),
                            borderColor: '#F59E0B', // yellow-500
                            backgroundColor: 'rgba(245, 158, 11, 0.1)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            // Posts Over Time Chart
            if (document.getElementById('timeChart') && window.__DASHBOARD_DATA__.postsOverTime) {
                const timeCtx = document.getElementById('timeChart').getContext('2d');
                const postsData = window.__DASHBOARD_DATA__.postsOverTime;
                new Chart(timeCtx, {
                    type: 'line',
                    data: {
                        labels: postsData.map(item => item.date),
                        datasets: [{
                            label: 'Posts',
                            data: postsData.map(item => item.count),
                            borderColor: '#3B82F6', // blue-500
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }
        }
    });
    </script>
</x-app-layout>
