<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Congress Leaders Management') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    {{ __("Manage congress leaders here.") }}
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
                <!-- Add Congress Leader Form -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Congress Leader</h3>
                        <form method="POST" action="{{ route('congress.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- File Upload Section -->
                            <div class="mb-8">
                                <x-input-label :value="__('Media Attachment')" class="text-lg font-semibold" />
                                <p class="text-sm text-gray-600 mb-3">
                                    Add an image to represent the leader (Max: 10MB)
                                </p>

                                <div id="mediaDropZone"
                                     class="group relative flex flex-col items-center justify-center gap-4 px-6 py-12 border-2 border-dashed border-gray-300 rounded-xl bg-white hover:border-blue-500 transition-all duration-300 cursor-pointer">

                                    <div class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 group-hover:text-blue-500 mb-3 transition-colors"></i>
                                        <h3 class="text-lg font-semibold text-gray-700 mb-2" id="fileLabel">
                                            Drop your file here
                                        </h3>
                                        <p class="text-sm text-gray-500 mb-4">
                                            or click to browse your files
                                        </p>

                                        <button type="button"
                                                id="mediaSelectButton"
                                                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200 transform hover:scale-105">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Choose File
                                        </button>

                                        <p class="text-xs text-gray-400 mt-3">
                                            Supports: JPG, PNG (Max 10MB)
                                        </p>
                                    </div>

                                    <input class="sr-only" type="file" name="media" id="media" accept="image/*">
                                </div>
                            </div>

                            <!-- Input Fields -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       required
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Enter congress leader name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="position" class="block text-sm font-medium text-gray-700">Position *</label>
                                <input type="text"
                                       name="position"
                                       id="position"
                                       required
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Enter position">
                                @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                                <textarea name="bio"
                                          id="bio"
                                          rows="3"
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Enter a brief bio or message (optional)"></textarea>
                                @error('bio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                                Add Congress Leader
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Congress Leaders List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            Existing Congress Leaders ({{ $congress_leaders->count() }})
                        </h3>

                        @if($congress_leaders->count() > 0)
                            <div class="space-y-3" id="congress-leaders-list">
                                @foreach($congress_leaders as $leader)
                                    <div class="congress-leader-item flex items-center justify-between p-3 bg-gray-50 rounded-lg transition-all duration-300 hover:shadow"
                                         data-leader-id="{{ $leader->id }}">
                                        <!-- Display Mode -->
                                        <div class="display-mode flex items-center justify-between w-full">
                                            <div class="flex items-center gap-3">
                                                @if($leader->photo_url)
                                                    <img src="{{ asset('storage/' . $leader->photo_url) }}"
                                                         class="w-10 h-10 rounded-full object-cover border"
                                                         alt="{{ $leader->name }}">
                                                @endif
                                                <div>
                                                    <span class="text-gray-800 font-medium">{{ $leader->name }}</span>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $leader->position }}</p>
                                                </div>
                                            </div>

                                            <div class="flex space-x-2">
                                                <button type="button"
                                                        onclick="enableEditMode({{ $leader->id }})"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-200">
                                                    Update
                                                </button>
                                                <form method="POST" action="{{ route('congress.destroy', $leader->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this congress leader?')"
                                                            class="text-red-600 hover:text-red-800 text-sm font-medium transition duration-200">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Edit Mode -->
                                        <div class="edit-mode hidden w-full flex flex-col space-y-3 mt-3">
                                            <form method="POST" action="{{ route('congress.update', $leader->id) }}" class="flex flex-col space-y-3">
                                                @csrf
                                                @method('PUT')

                                                <input type="text"
                                                       name="name"
                                                       value="{{ $leader->name }}"
                                                       required
                                                       class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                       placeholder="Congress leader name">

                                                <input type="text"
                                                       name="position"
                                                       value="{{ $leader->position }}"
                                                       required
                                                       class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                       placeholder="Position">

                                                <div class="flex space-x-2">
                                                    <button type="submit"
                                                            class="bg-green-600 text-white py-2 px-3 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200 text-sm">
                                                        Save
                                                    </button>
                                                    <button type="button"
                                                            onclick="disableEditMode({{ $leader->id }})"
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
                            <p class="text-gray-500 text-center py-4">No congress leaders found. Add your first congress leader!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // File upload interaction
        const mediaDropZone = document.getElementById('mediaDropZone');
        const mediaSelectButton = document.getElementById('mediaSelectButton');
        const mediaInput = document.getElementById('media');
        const fileLabel = document.getElementById('fileLabel');

        mediaSelectButton.addEventListener('click', () => mediaInput.click());
        mediaDropZone.addEventListener('click', () => mediaInput.click());

        mediaInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) fileLabel.textContent = `Selected: ${file.name}`;
        });

        mediaDropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            mediaDropZone.classList.add('border-blue-500', 'bg-blue-50');
        });
        mediaDropZone.addEventListener('dragleave', () => {
            mediaDropZone.classList.remove('border-blue-500', 'bg-blue-50');
        });
        mediaDropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            mediaDropZone.classList.remove('border-blue-500', 'bg-blue-50');
            const file = e.dataTransfer.files[0];
            mediaInput.files = e.dataTransfer.files;
            if (file) fileLabel.textContent = `Selected: ${file.name}`;
        });

        // Inline edit toggle
        function enableEditMode(leaderId) {
            const leaderItem = document.querySelector(`.congress-leader-item[data-leader-id="${leaderId}"]`);
            leaderItem.querySelector('.display-mode').classList.add('hidden');
            leaderItem.querySelector('.edit-mode').classList.remove('hidden');
            const inputField = leaderItem.querySelector('input[name="name"]');
            inputField.focus();
            inputField.select();
        }

        function disableEditMode(leaderId) {
            const leaderItem = document.querySelector(`.congress-leader-item[data-leader-id="${leaderId}"]`);
            leaderItem.querySelector('.display-mode').classList.remove('hidden');
            leaderItem.querySelector('.edit-mode').classList.add('hidden');
        }

        // Escape key closes edit mode
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const activeEdit = document.querySelector('.edit-mode:not(.hidden)');
                if (activeEdit) {
                    const leaderItem = activeEdit.closest('.congress-leader-item');
                    const leaderId = leaderItem.getAttribute('data-leader-id');
                    disableEditMode(leaderId);
                }
            }
        });

        // Click outside closes edit mode
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.edit-mode') && !e.target.closest('.text-blue-600')) {
                const activeEdit = document.querySelector('.edit-mode:not(.hidden)');
                if (activeEdit && !activeEdit.contains(e.target)) {
                    const leaderItem = activeEdit.closest('.congress-leader-item');
                    const leaderId = leaderItem.getAttribute('data-leader-id');
                    disableEditMode(leaderId);
                }
            }
        });
    </script>

    <style>
        /* Smooth inline edit transition */
        .edit-mode {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .edit-mode:not(.hidden) {
            opacity: 1;
            max-height: 400px;
        }

        .congress-leader-item {
            transition: all 0.3s ease;
        }
    </style>
</x-app-layout>
