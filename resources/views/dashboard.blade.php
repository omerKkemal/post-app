<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div>
                        <h3>Total Number of Posts: {{ $numberOfPosts }}</h3>
                        <h3>Number of Posts by Category:</h3>
                        <ul>
                            @foreach($numberOfPostsByCategory as $category => $count)
                                <li>{{ $category }}: {{ $count }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- chart js(number of post_total , number of post by tage vs time) -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
