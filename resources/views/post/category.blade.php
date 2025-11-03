<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Category Management') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    {{ __("Manage your post categories here.") }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Add Category Form -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Category</h3>
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                <input type="text" name="name" id="name" required
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Enter category name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3"
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Enter category description (optional)"></textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                                Add Category
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Categories List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Existing Categories</h3>

                        @if($categories->count() > 0)
                            <div class="space-y-3" id="categories-list">
                                @foreach($categories as $category)
                                    <div class="category-item flex items-center justify-between p-3 bg-gray-50 rounded-lg"
                                         data-category-id="{{ $category->id }}">
                                        <!-- Display Mode -->
                                        <div class="display-mode flex items-center justify-between w-full">
                                            <div>
                                                <span class="text-gray-800 font-medium">{{ $category->name }}</span>
                                                @if($category->description)
                                                    <p class="text-sm text-gray-600 mt-1">{{ $category->description }}</p>
                                                @endif
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="button" onclick="enableEditMode({{ $category->id }})"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-200">
                                                    Update
                                                </button>
                                                <form method="POST" action="{{ route('category.destroy', $category->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this category?')"
                                                            class="text-red-600 hover:text-red-800 text-sm font-medium transition duration-200">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Edit Mode -->
                                        <div class="edit-mode hidden w-full">
                                            <form method="POST" action="{{ route('category.update', $category->id) }}"
                                                  class="flex flex-col space-y-3">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="name" value="{{ $category->name }}" required
                                                       class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                       placeholder="Category name">
                                                <textarea name="description" rows="2"
                                                          class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                          placeholder="Category description (optional)">{{ $category->description }}</textarea>
                                                <div class="flex space-x-2">
                                                    <button type="submit"
                                                            class="bg-green-600 text-white py-2 px-3 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200 text-sm">
                                                        Save
                                                    </button>
                                                    <button type="button" onclick="disableEditMode({{ $category->id }})"
                                                            class="bg-gray-600 text-white py-2 px-3 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 text-sm">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No categories found. Add your first category!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<style>
    .category-item { transition: all 0.3s ease; }
    .edit-mode { transition: all 0.3s ease; }
    .hidden { display: none !important; }
</style>
@endpush

@push('scripts')
<script>
    function enableEditMode(categoryId) {
        const categoryItem = document.querySelector(`.category-item[data-category-id="${categoryId}"]`);
        const displayMode = categoryItem.querySelector('.display-mode');
        const editMode = categoryItem.querySelector('.edit-mode');

        displayMode.classList.add('hidden');
        editMode.classList.remove('hidden');
        editMode.querySelector('input[name="name"]').focus();
    }

    function disableEditMode(categoryId) {
        const categoryItem = document.querySelector(`.category-item[data-category-id="${categoryId}"]`);
        categoryItem.querySelector('.display-mode').classList.remove('hidden');
        categoryItem.querySelector('.edit-mode').classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const activeEdit = document.querySelector('.edit-mode:not(.hidden)');
            if (activeEdit) {
                const categoryId = activeEdit.closest('.category-item').getAttribute('data-category-id');
                disableEditMode(categoryId);
            }
        }
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.edit-mode') && !e.target.closest('.display-mode .text-blue-600')) {
            const activeEdit = document.querySelector('.edit-mode:not(.hidden)');
            if (activeEdit && !activeEdit.contains(e.target)) {
                const categoryId = activeEdit.closest('.category-item').getAttribute('data-category-id');
                disableEditMode(categoryId);
            }
        }
    });
</script>
@endpush
