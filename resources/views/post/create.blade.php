<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="/posts/store" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('description')" />
                            <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="description" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Add a media file (photo or video)</label>

                            <div id="mediaDropZone" class="group relative flex flex-col items-center justify-center gap-3 px-4 py-8 border-2 border-dashed border-gray-300 rounded-lg bg-white hover:border-primary-500 transition-colors cursor-pointer">
                                <button type="button" id="mediaSelectButton" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <svg class="h-8 w-8 text-gray-400 group-hover:text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3v4M8 3v4M3 11h18" />
                                </svg>
                                <div class="text-sm text-gray-600">Drag & drop a file here, or</div>

                                </button>

                                <input class="sr-only" type="file" name="media" id="media" accept="image/*,video/*">
                            </div>

                            <x-input-error :messages="$errors->get('media')" class="mt-2" />

                            <div id="previewContainer" class="mt-4 flex flex-col gap-3"></div>
                        </div>
                        <div>
                            <x-input-label class="pt-3 pb-3" for="category" :value="__('Category')" />
                            <select name="category" id="category" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="1">Category 1</option>
                                <option value="2">Category 2</option>
                                <option value="3">Category 3</option>
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Post') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('media');
    const container = document.getElementById('previewContainer');
    if (!input || !container) return;

    // Keep track of the last created object URL so we can revoke it when replaced
    let lastObjectUrl = null;

    const dropZone = document.getElementById('mediaDropZone');
    const chooseBtn = document.getElementById('mediaSelectButton');

    // Wire choose button to the hidden file input
    if (chooseBtn) {
        chooseBtn.addEventListener('click', () => input.click());
    }

    // Drag / Drop support
    if (dropZone) {
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-primary-500', 'bg-gray-50');
        });
        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-primary-500', 'bg-gray-50');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-primary-500', 'bg-gray-50');
            const file = e.dataTransfer.files && e.dataTransfer.files[0];
            if (file) {
                // assign to input.files via DataTransfer
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                input.dispatchEvent(new Event('change'));
            }
        });
    }

    input.addEventListener('change', function (event) {
        const file = event.target.files && event.target.files[0];
        // cleanup if no file
        if (!file) {
            if (lastObjectUrl) {
                URL.revokeObjectURL(lastObjectUrl);
                lastObjectUrl = null;
            }
            container.innerHTML = '';
            return;
        }

        // Clear previous preview and revoke previous object URL
        container.innerHTML = '';
        if (lastObjectUrl) {
            URL.revokeObjectURL(lastObjectUrl);
            lastObjectUrl = null;
        }

        const url = URL.createObjectURL(file);
        lastObjectUrl = url;

        // create a preview card with remove button and file name
        const card = document.createElement('div');
        card.className = 'flex items-start gap-4 p-3 border rounded-md bg-gray-50';

        const mediaWrap = document.createElement('div');

        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = url;
            img.style.maxWidth = '400px';
            img.style.maxHeight = '300px';
            img.alt = file.name || 'preview';
            img.className = 'rounded-md';
            img.onload = () => {
                // revoke only if it's still the last URL
                if (lastObjectUrl === url) {
                    URL.revokeObjectURL(url);
                    lastObjectUrl = null;
                }
            };
            mediaWrap.appendChild(img);
        } else if (file.type.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = url;
            video.controls = true;
            video.style.maxWidth = '400px';
            video.style.maxHeight = '300px';
            video.className = 'rounded-md';
            video.onloadedmetadata = () => {
                if (lastObjectUrl === url) {
                    URL.revokeObjectURL(url);
                    lastObjectUrl = null;
                }
            };
            mediaWrap.appendChild(video);
        } else {
            mediaWrap.innerText = 'Unsupported file type';
        }

        const info = document.createElement('div');
        info.className = 'flex-1';
        const name = document.createElement('div');
        name.className = 'text-sm font-medium text-gray-800';
        name.innerText = file.name || 'Selected file';
        const size = document.createElement('div');
        size.className = 'text-xs text-gray-500';
        size.innerText = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
        info.appendChild(name);
        info.appendChild(size);

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'text-sm text-red-600 hover:underline';
        removeBtn.innerText = 'Remove';
        removeBtn.addEventListener('click', () => {
            // clear input and preview
            input.value = '';
            if (lastObjectUrl) {
                URL.revokeObjectURL(lastObjectUrl);
                lastObjectUrl = null;
            }
            container.innerHTML = '';
        });

        card.appendChild(mediaWrap);
        card.appendChild(info);
        card.appendChild(removeBtn);

        container.appendChild(card);
    });
});
</script>
