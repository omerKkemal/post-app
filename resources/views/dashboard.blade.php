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
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-18 0v1.5a2.5 2.5 0 005 0V12"></path>
                        </svg>
                        Subscriptions List
                    </h3>
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @foreach($subscriptions as $subscription)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <span class="font-medium text-gray-700">{{ $subscription->email }}</span>
                                <span class="text-sm text-gray-500">Subscribed on {{ \Carbon\Carbon::parse($subscription->created_at)->format('M d, Y') }}</span>
                            </div>
                        @endforeach
                    </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Chart 1: Category Distribution Doughnut Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');

            const generateColors = (count) => {
                const colors = [];
                const colorPalette = [
                    'rgba(59, 130, 246, 0.8)',   // Blue
                    'rgba(16, 185, 129, 0.8)',   // Green
                    'rgba(245, 158, 11, 0.8)',   // Yellow
                    'rgba(239, 68, 68, 0.8)',    // Red
                    'rgba(139, 92, 246, 0.8)',   // Purple
                    'rgba(14, 165, 233, 0.8)',   // Light Blue
                    'rgba(20, 184, 166, 0.8)',   // Teal
                    'rgba(249, 115, 22, 0.8)',   // Orange
                ];

                for (let i = 0; i < count; i++) {
                    colors.push(colorPalette[i % colorPalette.length]);
                }
                return colors;
            };

            const categoryColors = generateColors({!! $numberOfPostsByCategory->count() !!});

            const categoryChart = new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($numberOfPostsByCategory->keys()) !!},
                    datasets: [{
                        data: {!! json_encode($numberOfPostsByCategory->values()) !!},
                        backgroundColor: categoryColors,
                        borderColor: 'white',
                        borderWidth: 2,
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: '#6B7280',
                                font: {
                                    size: 11
                                },
                                padding: 15,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} posts (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });

            // Debug: Check if data exists
            console.log('Posts Over Time Data:', {!! json_encode($postsOverTime) !!});
            console.log('Subscriptions Over Time Data:', {!! json_encode($subscriptionsOverTime ?? []) !!});

            // Chart 2: Subscriptions Over Time Chart - with fallback data
            const subscriptionCtx = document.getElementById('subscriptionChart').getContext('2d');

            // Get subscription data or use empty fallback
            const subscriptionData = {!! json_encode($subscriptionsOverTime ?? []) !!};
            const subscriptionLabels = Object.keys(subscriptionData);
            const subscriptionValues = Object.values(subscriptionData);

            // If no data, show empty chart with message
            if (subscriptionLabels.length === 0) {
                subscriptionLabels.push('No data');
                subscriptionValues.push(0);
            }

            const subscriptionChart = new Chart(subscriptionCtx, {
                type: 'line',
                data: {
                    labels: subscriptionLabels,
                    datasets: [{
                        label: 'Subscriptions',
                        data: subscriptionValues,
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderColor: 'rgba(245, 158, 11, 1)',
                        borderWidth: 3,
                        tension: 0.1,
                        fill: true,
                        pointBackgroundColor: function(context) {
                            return context.parsed.y === 0 ? 'rgba(156, 163, 175, 0.6)' : 'rgba(245, 158, 11, 1)';
                        },
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: function(context) {
                            return context.parsed.y === 0 ? 3 : 6;
                        },
                        pointHoverRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: '#6B7280',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    const subscriptions = context.parsed.y;
                                    const date = context.label;
                                    if (subscriptions === 0) {
                                        return `No subscriptions on ${date}`;
                                    }
                                    return `${subscriptions} subscription${subscriptions !== 1 ? 's' : ''} on ${date}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                stepSize: 1,
                                color: '#6B7280'
                            },
                            title: {
                                display: true,
                                text: 'Number of Subscriptions',
                                color: '#6B7280'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                color: '#6B7280',
                                maxTicksLimit: 10,
                                callback: function(value, index, values) {
                                    if (values.length > 10 && index % Math.ceil(values.length / 10) !== 0) {
                                        return '';
                                    }
                                    return this.getLabelForValue(value);
                                }
                            },
                            title: {
                                display: true,
                                text: 'Date',
                                color: '#6B7280'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });

            // Chart 3: Posts Over Time Chart - with fallback data
            const timeCtx = document.getElementById('timeChart').getContext('2d');

            // Get posts data or use empty fallback
            const postsData = {!! json_encode($postsOverTime ?? []) !!};
            const postsLabels = Object.keys(postsData);
            const postsValues = Object.values(postsData);

            // If no data, show empty chart with message
            if (postsLabels.length === 0) {
                postsLabels.push('No data');
                postsValues.push(0);
            }

            const timeChart = new Chart(timeCtx, {
                type: 'line',
                data: {
                    labels: postsLabels,
                    datasets: [{
                        label: 'Posts Created',
                        data: postsValues,
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 3,
                        tension: 0.1,
                        fill: true,
                        pointBackgroundColor: function(context) {
                            return context.parsed.y === 0 ? 'rgba(156, 163, 175, 0.6)' : 'rgba(59, 130, 246, 1)';
                        },
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: function(context) {
                            return context.parsed.y === 0 ? 3 : 6;
                        },
                        pointHoverRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: '#6B7280',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    const posts = context.parsed.y;
                                    const date = context.label;
                                    if (posts === 0) {
                                        return `No posts on ${date}`;
                                    }
                                    return `${posts} post${posts !== 1 ? 's' : ''} on ${date}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                stepSize: 1,
                                color: '#6B7280'
                            },
                            title: {
                                display: true,
                                text: 'Number of Posts',
                                color: '#6B7280'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                color: '#6B7280',
                                maxTicksLimit: 10,
                                callback: function(value, index, values) {
                                    if (values.length > 10 && index % Math.ceil(values.length / 10) !== 0) {
                                        return '';
                                    }
                                    return this.getLabelForValue(value);
                                }
                            },
                            title: {
                                display: true,
                                text: 'Date',
                                color: '#6B7280'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
</x-app-layout>
