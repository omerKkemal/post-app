<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('About') }}
            </h2>
            <p class="text-sm text-gray-600">{{ __('መረጃ ስለ ሀረሪ መሐድ') }}</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!--
            About Content:
            1. Display all 13 congress members with their photos, names, and titles.
            2. slide show sertificates
            3. goals and mission statement
         -->
         <div>
            <!-- slide show sertificates -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-4">Certificates</h3>
                <div class="relative w-full max-w-4xl mx-auto">
                    <div class="overflow-hidden relative h-64">
                        <div class="absolute inset-0 transition-transform duration-500" id="slideshow">
                            <img src="/images/certificate1.jpg" alt="Certificate 1" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <!-- Goals and Mission Statement -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-4">Goals and Mission Statement</h3>
                <p class="text-gray-700 mb-4">
                    Our mission is to empower communities through education, innovation, and sustainable development. We strive to create opportunities for growth and foster a culture of collaboration and inclusivity.
                </p>
                <p class="text-gray-700">
                    Our goals include enhancing educational access, promoting technological advancements, and supporting environmental conservation efforts. We are committed to making a positive impact on society and improving the quality of life for all individuals.
                </p>
            </div>
        </div>
        <div class="mb-8">
            <!-- Congress Members -->
            <h3 class="text-2xl font-semibold mb-4">Congress Members</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($members as $member)
                    @if ($member->position === 'President')
                        <div class="bg-yellow-100 border-2 border-yellow-400 shadow-md rounded-lg p-4 text-center">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-32 h-32 mx-auto rounded-full mb-4 object-cover">
                            <h4 class="text-lg font-semibold">{{ $member->name }}</h4>
                            <p class="text-gray-800 font-bold">{{ $member->position }}</p>
                            <p class="text-sm text-gray-600 mt-2">{{ $member->bio }}</p>
                        </div>
                    @else
                        <div class="bg-white shadow-md rounded-lg p-4 text-center">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-32 h-32 mx-auto rounded-full mb-4 object-cover">
                            <h4 class="text-lg font-semibold">{{ $member->name }}</h4>
                            <p class="text-gray-600">{{ $member->position }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    <script>
        let currentIndex = 0;
        const images = [
            '/images/certificate1.jpg',
            '/images/certificate2.jpg',
            '/images/certificate3.jpg'
        ];
        const slideshow = document.getElementById('slideshow');

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            slideshow.innerHTML = `<img src="${images[currentIndex]}" alt="Certificate ${currentIndex + 1}" class="w-full h-full object-cover">`;
        }, 3000);
    </script>
</x-app-layout>
