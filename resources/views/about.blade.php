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
           <!-- Language toggle -->
            <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                        Language Filter
                    </h3>
                    <button id="reset-language-filter" class="text-sm text-blue-600 hover:text-blue-800 transition-colors">
                        Reset Filter
                    </button>
                </div>
                <div class="flex flex-wrap gap-3" id="language-filters-container">
                    <button class="filter-btn language-filter-btn active" data-language="english">
                        <span class="language-badge">English</span>
                    </button>
                    <button class="filter-btn language-filter-btn" data-language="harari">
                        <span class="language-badge">Harari</span>
                    </button>
                </div>
            </div>

            <!-- Certificates section -->
            <div id="certificates" class="mb-12 scroll-mt-8">
                <h3 class="text-2xl font-semibold mb-6 text-gray-800">Certificates</h3>
                <div class="relative w-full max-w-4xl mx-auto bg-gray-100 rounded-lg shadow-lg p-4">
                    <div class="overflow-hidden relative h-80 rounded-lg">
                        <div class="absolute inset-0 transition-transform duration-500" id="slideshow">
                            <img src="/images/certificate1.jpg" alt="Certificate 1" class="w-full h-full object-contain">
                        </div>
                    </div>
                    <div class="flex justify-center mt-4 space-x-2">
                        <span id="slide-indicator" class="text-sm text-gray-600">1 / 3</span>
                    </div>
                </div>
            </div>

            <!-- Goals and Mission section -->
            <div id="goals" class="mb-12 scroll-mt-8">
                <h3 class="text-2xl font-semibold mb-6 text-gray-800">Goals & Mission</h3>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Harari language section -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <code class="harari block overflow-x-auto">
                                    <h1 style="text-align: center; text-decoration: underline; font-size: 30px; margin-bottom: 1rem;">ቡእቲ</h1>
                                    ሀረሪ ኡመት ሑሉፍ ዛዩ ደኻጥ ሑኩማች ሐርቆትዚዩ ሰበብቤ ሒልቂዞ ኡኑስ ዚኻና ሀረሪ መሐድ ማንነትዞቤ የቃኛኩት፣ ሲያሳ ዋ ኢቅቲሳዲያቤም  ዩሩሕቂማ አላይዞ ኢጂው ቀር ቀረብ ዩቂሕሪኩት፣ ኢስበልበላት አዱኛ ባዳችቤ ዩትፌጠኒኩት ሞሸቤ ዘጋሕ ደኽጢዋ ጀሪማ ዩቡርዲባ ዚናራ ኡመት ዚናራነት ዩታወቃል፡፡
                                    ሀረሪ መሐድ መጅሊስ መጋቢት 06 አያም 1987 ዚኢዮጲያ ዚመትሚጃጅቲ ሑኩማ ተዌካያች ሒርጊ ጋርቤ 102ታኝ ኡርፊ ዲብላንቤ ሀረሪ ሑስኒ ሉይ ሚልሐ ሔራ ጠብ ዩሊኩት ዌሰና ዩዞም ሀረሪ ሑስኒ መሐዲያ ሒርጊጋር መቃነኑ ዩነካል፡፡ ሀረሪ ሑስኒ አኽእ ዛል 2 ዊቃሮታችቤ ዩትዋቀሩኩት ሀረሪ መሐድ መጅሊስ ዋ ሀረሪ ሁስኒ ሒርጊ ጋር ቃኑን ያጪ ቃማቹ መድበልቤ 1986 አመትቤ ዚኢፊድሪ መገስ ሐከማ ኢስሰበታ ቤሔርሌ ወቅተንዞ ኡርፊ ዩኹንኩት ኻናማ ሑስኒዞ ሑኩማቤ ሀረሪ መሐድ ዩትዌከልባዛል ሒርጊ ጋር ኻና፡፡
                                    መጅሊስዞ ሀረሪ ኡመት ታሪኽዞው፣ አደዞው፣ ሉኃዞው ዋ ማንነትዞ ዩትቄረሕማ ጂልቤ ኪም ጂል ዘልቲሸራረፈቤ አሐድ ሒዊሽቲም ቢላይ ሑሉፍ ዩልኩት፣ ቃኑን ለአይነት ዩነግሲማ፣ መሐድ መሐዲናች ዋ ኡመታች ኩሉ ፈንካችቤም መሰስ መስሳነትዚዩው ኢቅቲሳዲ ፣ ዳይሓዋዝ ዋ ሲያሳ ተናፋኢነትዚዩው ዩትገደሪማ፣ ኦር ኺሾና ለአይቤ ዚቼኻላ፣ ሲር ሲሰዳዳ አሐድነት፣ መትፊራረክ ፣ ዚደድ ፣ ዚሰላም  ዋ ፌደራሊያ ዲሞክራጢ ኣዳብ የሲስኒማ መራኣ፣ሪኦትዞው ሲንቂ ሞሸቤ መገስ ሐከማው ተርጀማ ሞሸቤ፣  ቁዷ መትታሻ ዋ መሰሳ መሰሳአነት ላአይቤ ዚትቼኻላ ኡመታች አሐድነት ሲር ዩሰዲማ ዩነፍጊኩት ሞሻ ፣ ሑስኒዞቤ ሰላሚያ ዲሞክራሲ ተራኦት ዩነፍጊኩት፣ ቃኑን ዩጭለዩሌ ዩትኻሽዛሉ ወለባይ ቃኑን ሐጃጁ ቢሳሎት ዋ መላያ፣ ዲባየቤም መደኒያች መገስ ሐከማው ቤጆትቤ ዩቁማ ፌደራሊያ ዲሞክራጢ ኢቲዮጵያው መቼኻልሌ ቁጭነትቤ መድለግ ተላኾትዞው ለሐደማ መገስ ሐከመቤ ተላዩማ ዚትሰጦ ሰልጣ ዋ ኢሾታቹ መትዋጣእሌ ዋ ነቲጃም መኽነሌ መትኒጫጨሕቤ ዩትረኻባል፡፡
                                    ሀረሪ መሐድ ማንነቱው መትቄራሕ ገረብደሌ ዚሀረሪ መሐድ መጅሊስ መገስ ሐከማ ለአይነት መንገስ ገረብደሌ ቃኑን ሞጫ ፣ አሜሀሮትዞው ተኽታተሎትዋ ተአወኖት ሞሻማ ኡምመት ተናፋኢነትዞው መዬቀን፡፡
                                    አኻእ ወቅቲቤ ዲሞቅራጢያ ሒራቤ መትሶረቤ መትፊራረክ ዋ መትጊዳደርቤ ዚትቼኻላ ዚባድ አሐድነት ሲርዞ የነፍጊኩት መጅሊስዞ የትሪኽባቤ ዛል ፊሪ ዋ ደውሪዞ ላቂንታ፡፡
                                    ዩ ዛልባኩትቤ ዩኹኒማ መጅሊስዞ አዳለጎትዞ መጦኛ ገረብደሌ ባድ ሑቁፍ ዋ አለም ሑቁፍ ደረጀቤ ኹንቲያች ኒዊጭቲ ገረብደሌ ቂብላናችዞው ባሕሲ ኪልአሻ ዚቅ ሒርፈታችዞው ኪም ዩጡኝ ደረጃ ኩፎኝ ኪል አጦኛ ዋ ዚጦኙ ሒርፈታቹ ሑስኒዞ ኑቡር ኹንቲባሕ ኪልአትዋሐባ ዳይሐዋዞ ኩሉሑቁፍ ተናፋኢነቱ ዩጡኝ ኹንቲቤ የሰብቲዛልኩትቤ ተኼታይ አዳለጎታቹ ሐጂስ ኒውጢ ሐማሰቤ መድለግሌ ቁጭነትቤ መድለግቤ ጢትረኸባል ፡፡ ኢሾትዋልነትዞሌም መጅሊስዞ ኣጦሮት ዩስጢዛል መክተባ ጋርዞ ው ኢላዋ አኽእ ዛጥ ዊቃሮታች ዊጣኖታች ዋ ዚአዳለጎትዋ አሜሐሮት  ኹንቲያቹ መቤሐስቤ ዚያዳ ዚቅ ዪሊኩት ሞሸቤ ዩትራኻባል፡፡ የኽኒማም መጅሊስዞ ዩ ሐደፍዞው መክተባ ጋርዙ ጢት መስኡላች ዋ ደላጊያችቤ ሙጢቤ አትታይ ዩቡርዱሜል፡፡ ዩሌ ባይቲም ሑስኒዞ ዳይሐዋዝ፣ ሑኩማ፣ ማሐድ መሐዲናች ዋ ኡመታች ዋ አላይ ዩጠርሐዩዛል ቃማች ጀሚእኡም በግ ዚታ ተሳአዶት የትኺሽዛልነት ኡሙኒንታ፡፡

                                    <h2 style="text-decoration: underline; font-weight: bold; margin-top: 1.5rem; margin-bottom: 0.5rem;">ሪኦት፣ተላኾት ዋ ቀድራች</h2>
                                        <h3 style="text-decoration: underline; font-weight: bold; margin-top: 1rem;">- ሪኦት</h3>
                                        • ሀረር ዋ ሀረሪ ማንነት ሒዊሽቲ ቢላይ ዪዲጅ ጂልሌ ሑሉፍ ሞሻ
                                        <h3 style="text-decoration: underline; font-weight: bold; margin-top: 1rem;">-ተላኾት</h3>
                                        • ሀረሪ ታሪኽ፣ሉኃ ዋ ቁራስ ዚቅዚታ ፖሊሲ፣ ቃኑን ዋ ኢሾት ሔራ ዪትዜገድለዩማ ኡምመት ማንነት አኽኻእ ዛልባ ደረጃቤ ዩጡኝኩት ዩኹናል
                                        <h3 style="text-decoration: underline; font-weight: bold; margin-top: 1rem;">-ቀድራችዚና</h3>
                                        • ማንነትዞው ዩዲዛል ኡምመት መንበርቲ፣
                                        • አለም ሑቁፍቤ ዚትሴጀላ ቁራስ መንበርቲ፣
                                        • ዚመትፊራረክ፣ዚመትዋደድ ዋ ዚአሐድነት አቆት መንበርቲ፣
                                        • ጪንቂው መፍተሕሌ ጠብ ዚታ ኡምመት መንበርቲ፣
                                        • ታሪኺያ ሓላመሐል ተእሲሳችዚና መንበርቲ፣
                                        • ዚኡምመት ፊሪግቲ መንበርቲ፣
                                        • ሚን የቁምሲ ሑይ ታሪኽ መንበርቲ፣
                                        <h2 style="text-decoration: underline; font-weight: bold; margin-top: 1.5rem; margin-bottom: 0.5rem;">ሐደፍ፡</h2>
                                        <h3 style="text-decoration: underline; font-weight: bold; margin-top: 1rem;">-ዱሙም ሐደፍ</h3>
                                        • ሀረሪ ኡምመት ዚማነት መትገለጥቲ ዚተዩ ኣደ፣ቁራስ፣ታሪኽ ዋ ሉኃው መትቄረሕዞው መዬቀን
                                        • ሀረሪ ኡምመት ሑስኒዞቤ ዚሲያሳ፣ዚዳይሐዋዝ ዋ ዚዲነትጌይ ሓጃችቤ ኑቁሕነት ዋ ዩጡኝ ደረጃቤ ዪዋርኩት ሞኛ፤ ኡምመትሌ ኡምመት ተቃጠሮቱ መጦኛቤ ሑስኒዞቤ መዋራዞ ደማነዞው መዬቀን
                                        <h3 style="text-decoration: underline; font-weight: bold; margin-top: 1rem;">-ዙርዙር ሐደፋች</h3>
                                        • አደዞው ቢሳሎትቤ ዚትሬገዛ ኹንቲቤ ዪኒርባ ሓለቱ መትሚቻቻ፣
                                        • ቁራሱው መቄረሕሌ ዞጠኡ ቃኑናቹው መቤሐስማ መጦኛ፣
                                        • ሉኃው መኔራሌ ዛሉ ቂብላናቹ መቤሐስቤ ዚትማለአ ሐለትቤ ሉኃው መኔራሌ ሔላ መዜገድ፣
                                        • ሀረሪ ኡምመት ሓላ መሐል ሔራችዞ ቤቀድ ዚናሬው ዚቅቲፎኝ ዪርገብጊኩት መትፌረክ፣
                                        • ዚሀረሪ ኔሮት ሙጋዱው ዚቅ አሳስቤ መቼኸል፡ ዪነከዩ ቃማችበሕ መቃጠርማ ዘገሕ ቢሳሎታች፣ ፒሮግራማችዋ ፒሮጀክቲያች መሜሐር፣
                                        • ሚሻ ቶያችቤ፣ ቢሮቤ፣ ባድቤ ዛሉ ሀረሪያች ሙጋዳችቤ መትሐቀፍማ ዳይሐዋዚያ ዚኔሮት ዲላጋች ወለባይነትቤ መድለግማ አላይዞው መዳበል፣
                                        • ቢሳሎትቤ ዚትሬገዛ ኡጋቤ ሀረሪነቱ የትባዝሒዛል ቻላው መቃየስቤ ኢሾትዋል ሞኛ ፡፡
                                        • አዱኛ ቁራስ ዚቴ ሀረር ጁገሉው መቄረሕ የትፊርኪኩት ሉይ ቤጆት መስጠቤ ዚኩልሉ ቻላ ሐረካ ሞኛ
                                        • ባድ ዋ አለም ሑቁፍቤ ዛል ሀረሪ ዋ ሀረር ተቀጠሮቱው መጦኛ፣
                                        • ዚሀረሪ ዲያስፖራ ባድዞ ሀረርሌ አታጮት ያኝኩትሌ ዳንዲው የትሚቻቻል፣
                                        • ዚሀረሪ ዋ ዚአላይ ኡምመት ተቃጠሮት ዘጋሕቤ  ዩነብሪኩት ዩኹናል
                                        • ሀረሪያች ዩትረኸቦዛል ባድቤ ዚቴገላ ዊቃሮቱው ዚቅ ሞሻሌ የትፊርኪ ዲላጋ መሜሐር፣
                                    መጅሊስሶ ዚመሜሐርቲ ታኽዋ መጅሊስ ሒርጊ ጋር አግቡራች ዛጥ ታኹው መቼኸል፣
                                </code>
                            </div>
                        </div>

                        <!-- English section -->
                        <div class="space-y-4">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <code class='english block overflow-x-auto'>
                                    <h1 style="text-align: center; text-decoration: underline; margin-bottom: 1.5rem;">Goals</h1>
                                    Harari Ummat is committed to promoting the rights, culture, and development of the Harari people. Our primary goals include:
                                    1. Advocacy: Representing the interests of the Harari community at local, national, and international levels.
                                    2. Cultural Preservation: Promoting and preserving Harari language, traditions, and heritage through various programs and initiatives.
                                    3. Education: Enhancing educational opportunities for Harari youth by providing scholarships, resources, and support.
                                    4. Economic Development: Supporting economic initiatives that benefit the Harari community, including entrepreneurship and job creation.
                                    5. Social Welfare: Addressing social issues affecting the Harari people, including healthcare, housing, and community services.
                                    Through these goals, Harari Ummat aims to empower the Harari community and ensure its sustainable growth and development.
                                </code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Congress Members section -->
            <div id="members" class="mb-8 scroll-mt-8">
                <h3 class="text-2xl font-semibold mb-6 text-gray-800">Congress Members</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($members as $member)
                        @if ($member->position === 'President')
                            <div class="bg-yellow-100 border-2 border-yellow-400 shadow-lg rounded-lg p-4 text-center transform hover:scale-105 transition-transform duration-300">
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-32 h-32 mx-auto rounded-full mb-4 object-cover border-4 border-yellow-300">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $member->name }}</h4>
                                <p class="text-gray-800 font-bold">{{ $member->position }}</p>
                                <p class="text-sm text-gray-600 mt-2">{{ $member->bio }}</p>
                            </div>
                        @else
                            <div class="bg-white shadow-md rounded-lg p-4 text-center hover:shadow-lg transition-shadow duration-300">
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-32 h-32 mx-auto rounded-full mb-4 object-cover border-4 border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $member->name }}</h4>
                                <p class="text-gray-600">{{ $member->position }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
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
        const slideIndicator = document.getElementById('slide-indicator');

        function updateSlide() {
            slideshow.innerHTML = `<img src="${images[currentIndex]}" alt="Certificate ${currentIndex + 1}" class="w-full h-full object-contain">`;
            slideIndicator.textContent = `${currentIndex + 1} / ${images.length}`;
        }

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            updateSlide();
        }, 3000);

        // Initialize first slide
        updateSlide();

        document.addEventListener('DOMContentLoaded', function () {
        // Slideshow functionality
        const slides = document.querySelectorAll('.slideshow-image');
        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? '1' : '0';
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        // Initialize slideshow
        if (slides.length > 0) {
            showSlide(currentIndex);
            setInterval(nextSlide, 3000);
        }

        // Language filter functionality
        const languageButtons = document.querySelectorAll('.language-filter-btn');
        const resetButton = document.getElementById('reset-language-filter');

        function setLanguage(language) {
            // Remove active class from all buttons
            languageButtons.forEach(btn => {
                btn.classList.remove('active');
            });

            // Add active class to selected button
            const selectedBtn = document.querySelector(`[data-language="${language}"]`);
            if (selectedBtn) {
                selectedBtn.classList.add('active');
            }

            // Show/hide language-specific content
            const harariElements = document.querySelectorAll('.harari');
            const englishElements = document.querySelectorAll('.english');

            if (language === 'harari') {
                harariElements.forEach(el => {
                    el.classList.remove('hidden1');
                });
                englishElements.forEach(el => {
                    el.classList.add('hidden1');
                });
            } else {
                // Default to English
                englishElements.forEach(el => {
                    el.classList.remove('hidden1');
                });
                harariElements.forEach(el => {
                    el.classList.add('hidden1');
                });
            }
        }

        // Add click events to language buttons
        languageButtons.forEach(button => {
            button.addEventListener('click', function() {
                const language = this.getAttribute('data-language');
                setLanguage(language);
            });
        });

        // Reset button functionality
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                setLanguage('english');
            });
        }

        // Initialize with English
        setLanguage('english');
    });
    </script>

    <style>
        .slideshow-image {
            transition: opacity 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
        }

        html {
            scroll-behavior: smooth;
        }

        .hidden1 {
            display: none !important;
        }

        /* Active button styling */
        .language-filter-btn.active {
            background-color: #3b82f6; /* blue-500 */
            color: white;
        }

        .language-filter-btn.active .language-badge {
            color: white;
        }

        .language-filter-btn {
            transition: all 0.2s ease;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background-color: #f3f4f6; /* gray-100 */
            border: 1px solid #e5e7eb; /* gray-200 */
        }

        .language-filter-btn:hover {
            background-color: #e5e7eb; /* gray-200 */
        }
    </style>
</x-app-layout>
