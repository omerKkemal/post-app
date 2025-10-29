<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Add Congress Leader') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    {{ __("Use the form below to add a new Congress Leader to the system.") }}
                </p>
            </div>

        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @livewire('post.create-post-form')
                </div>
            </div>
        </div>
    </div>
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Page-specific JS/CSS moved to resources/js/create.js and resources/css/create.css -->
</x-app-layout>
