<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Public Library') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Browse and download public documents
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Library Files Grid -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Available Documents ({{ $libraries->count() }})
                    </h3>

                    @if($libraries->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($libraries as $library)
                                <div class="library-item bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                                    <!-- File Preview -->
                                    <div class="flex items-center justify-center h-32 bg-white rounded-lg mb-3 border">
                                        @php
                                            $extension = pathinfo($library->location, PATHINFO_EXTENSION);
                                            $iconClass = match(strtolower($extension)) {
                                                'pdf' => 'fas fa-file-pdf text-red-500',
                                                'doc', 'docx' => 'fas fa-file-word text-blue-500',
                                                'txt' => 'fas fa-file-alt text-gray-500',
                                                'xls', 'xlsx' => 'fas fa-file-excel text-green-500',
                                                'ppt', 'pptx' => 'fas fa-file-powerpoint text-orange-500',
                                                default => 'fas fa-file text-gray-400'
                                            };
                                        @endphp
                                        <i class="{{ $iconClass }} text-4xl"></i>
                                    </div>

                                    <!-- File Info -->
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-900 truncate" title="{{ $library->name }}">
                                            {{ $library->name }}
                                        </h4>
                                        @if($library->description)
                                            <p class="text-xs text-gray-600 mt-1 line-clamp-2" title="{{ $library->description }}">
                                                {{ $library->description }}
                                            </p>
                                        @endif
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="text-xs text-gray-500">
                                                {{ $library->created_at->format('M d, Y') }}
                                            </span>
                                            <span class="text-xs text-gray-500 uppercase">
                                                {{ strtoupper($extension) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Download Action -->
                                    <div class="flex justify-center mt-3 pt-3 border-t border-gray-200">
                                        <a href="{{ route('library.download', $library->id) }}"
                                           class="inline-flex items-center px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200">
                                            <i class="fas fa-download mr-2"></i>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No documents available</h3>
                            <p class="text-gray-500">Check back later for new documents</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</x-app-layout>
