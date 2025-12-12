<x-app-layout>
    <!-- Main Content -->
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-amber-50">
        <!-- Language toggle -->
        <div class="absolute top-4 right-4 z-50">
            <button id="toggle-language" class="bg-white text-green-700 hover:bg-green-50 font-semibold py-2 px-4 rounded-lg shadow-lg transition duration-300">
                <i class="fas fa-globe-americas mr-2"></i><span class="english">Switch to Harari</span><span class="harari hidden1">ወደ ሀረሪ ቀይር</span>
            </button>
        </div>

        <!-- Slideshow Section -->
        <section class="py-8 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="overflow-hidden1 rounded-xl shadow-lg fade-in relative">
                    <!-- Fixed Text Overlay -->
                    <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center px-4">
                        <h1 class="english text-4xl md:text-6xl font-bold mb-6 text-white drop-shadow-lg">
                            Harari Congress
                        </h1>
                        <h1 class="harari hidden1 text-4xl md:text-6xl font-bold mb-6 text-white drop-shadow-lg">
                            ሀረሪ መጀሊስ
                        </h1>
                        <p class="english text-xl md:text-2xl mb-8 max-w-3xl mx-auto text-white drop-shadow-lg">
                            Preserving the rich heritage and culture of Harar while building a prosperous future for our community
                        </p>
                        <p class="harari hidden1 text-lg md:text-xl mb-4 max-w-2xl mx-auto text-white drop-shadow-lg">
                            ዚሀረሪ ሳዮት ቁራስ ዋ አዳች መቄረሕቤ ዳይሐዋዝዚኛሌ ዚሳይቲ ሙስተቅበል መቼኻል ላአይቤ.
                        </p>
                        <div class="flex flex-wrap justify-center gap-4 mt-8">
                            <a href="#messaging"
                            class="english bg-white text-green-700 hover:bg-green-50 font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                <i class="fas fa-bullhorn mr-2"></i>Community Messages
                            </a>
                            <a href="#messaging"
                            class="harari hidden1 bg-white text-green-700 hover:bg-green-50 font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                <i class="fas fa-bullhorn mr-2"></i>ዚዳይሐዋዞ ሉኽ
                            </a>
                            <a href="#news"
                            class="english bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                <i class="fas fa-newspaper mr-2"></i>Latest News
                            </a>
                            <a href="#news"
                            class="harari hidden1 bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                <i class="fas fa-newspaper mr-2"></i>ቁራ ወቅቲ ኻበራች
                            </a>
                        </div>
                    </div>

                    <!-- Slideshow Images -->
                    <div class="relative h-96 md:h-screen max-h-[80vh]">
                        @foreach([1,2,3,4,5,6,7,8,9,10,11,12,13] as $index)
                        <div class="absolute inset-0 w-full h-full slideshow-image {{ $index === 1 ? 'opacity-100' : 'opacity-0' }}">
                            <img width="100%" src="{{ asset('images/harar' . $index . '.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Culture Section -->
        <section id="culture" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="english text-3xl md:text-4xl font-bold text-gray-800 mb-4">Harari Culture</h2>
                    <h2 class="harari hidden1 text-3xl md:text-4xl font-bold text-gray-800 mb-4">ዚሀረሪ አዳ</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-green-50 rounded-xl p-6 text-center fade-in">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-language text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="english text-xl font-semibold text-gray-800 mb-3">Harari Language</h3>
                        <h3 class="harari hidden1 text-xl font-semibold text-gray-800 mb-3">ሀረሪ ሉኃ</h3>
                        <p class="english text-gray-600">Learn about the unique Harari language (Gey Sinan) and its preservation efforts</p>
                        <p class="harari hidden1 text-gray-600">ሀረሪ ሉኃ ኔሮት ዋ ቄረሖት ኩሽኩሽቲው ዩቁ.</p>
                    </div>

                    <div class="bg-amber-50 rounded-xl p-6 text-center fade-in" style="animation-delay: 0.1s">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-utensils text-amber-600 text-2xl"></i>
                        </div>
                        <h3 class="english text-xl font-semibold text-gray-800 mb-3">Traditional Cuisine</h3>
                        <h3 class="harari hidden1 text-xl font-semibold text-gray-800 mb-3">አዳ ሐንጉራች</h3>
                        <p class="english text-gray-600">Explore the unique flavors and dishes of Harari culinary traditions</p>
                        <p class="harari hidden1 text-gray-600">ሀረሪ አዳ ሐንጉራች ሲነታች ዋ ሉይ ጢማቹ የፌሕሱ</p>
                    </div>

                    <div class="bg-red-50 rounded-xl p-6 text-center fade-in" style="animation-delay: 0.2s">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-praying-hands text-red-600 text-2xl"></i>
                        </div>
                        <h3 class="english text-xl font-semibold text-gray-800 mb-3">Religious Traditions</h3>
                        <h3 class="harari hidden1 text-xl font-semibold text-gray-800 mb-3">ሹዋል ኢድ ዋ መውሉድ</h3>
                        <p class="english text-gray-600">Understanding the Islamic traditions and religious practices in Harari culture</p>
                        <p class="harari hidden1 text-gray-600">ዚሀረሪ መሐድ ሹዋል ኢድ ዋ መውሉድ መግደርቲ ሒራች ዋ ተቃሊዳች</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- History Section -->
        <section id="history" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="english text-3xl md:text-4xl font-bold text-gray-800 mb-4">History of Harar</h2>
                    <h2 class="harari hidden1 text-3xl md:text-4xl font-bold text-gray-800 mb-4">ዚሀረሪ ታሪኽ</h2>
                    <p class="english text-gray-600 max-w-2xl mx-auto">Explore the ancient walled city and its significant historical legacy</p>
                    <p class="harari hidden1 text-gray-600 max-w-2xl mx-auto">ቀዲም ጆጎል ሑጡርቤ ዚትቼኻልቲ አሲማ ዋ በግዚታ ታሪኽ ዋ ቁራሳች ዛሌ</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="fade-in">
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="english text-2xl font-bold text-gray-800 mb-4">The Walled City</h3>
                            <h3 class="harari hidden1 text-2xl font-bold text-gray-800 mb-4">ዚትሔጠርቲ አሲማ</h3>
                            <p class="english text-gray-600 mb-4">
                                Harar Jugol, the historic fortified city, is a UNESCO World Heritage Site with 82 mosques
                                and 102 shrines, representing the most important Islamic historical city in the Horn of Africa.
                            </p>
                            <p class="harari hidden1 text-gray-600 mb-4">
                                ታሪኺያ ዚቴማ ዚትሼመቅቲ ሀረር ጆጎል ዩኒስኮ አለም ሑቁፍ ታሪኽ ቁራስነትቤ ሲትሴጀልቲ ዚኻነሳአ 82 መስጂዳች 102 አዋቻች ዛሉ ዚኻነሳአ ዩም ቀር አፍሪካቤ ተትኺሽዛት ዚኻንቲ ዚኢስላሚያ ታሪኺያ አሲማነንቴ
                            </p>
                            <ul class="english space-y-2 text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>Founded in the 7th century</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>Capital of the Harari Kingdom from 1520 to 1568</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>Important center for Islamic learning and trade</span>
                                </li>
                            </ul>
                            <ul class="harari hidden1 space-y-2 text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>7ታኝ ቀርኒ ዘማንቤ ዚትኤሰስቲ</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>ዚሀረሪ አሲማ 1520 ኢላዋ 1568 አመት</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>ዚኢስላም ዲን ደርሲ ዋ ቲጃራ ቲነፊዛት ኡድ</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="fade-in" style="animation-delay: 0.1s">
                        <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-xl p-8 text-white">
                            <h3 class="english text-2xl font-bold mb-4">Historical Timeline</h3>
                            <h3 class="harari hidden1 text-2xl font-bold mb-4">ታሪኺያ ዚወቅቲ መስጣራ</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="bg-white text-green-700 w-20 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-4">
                                        <span class="english">7th C</span>
                                        <span class="harari hidden1">7ኛ ቀርኒ</span>
                                    </div>
                                    <div>
                                        <p class="english">Foundation of Harar</p>
                                        <p class="harari hidden1">ሀረሪ አስሊ</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="bg-white text-green-700 w-20 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-4">
                                        1520
                                    </div>
                                    <div>
                                        <p class="english">Capital of Harari Kingdom</p>
                                        <p class="harari hidden1">ሀረሪ ሑኩማ ዋና አሲማ</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="bg-white text-green-700 w-20 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-4">
                                        1887
                                    </div>
                                    <div>
                                        <p class="english">Incorporation into Ethiopia</p>
                                        <p class="harari hidden1">ኪም ኢቶጲያ ሑኩማ</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="bg-white text-green-700 w-20 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-4">
                                        2006
                                    </div>
                                    <div>
                                        <p class="english">UNESCO World Heritage</p>
                                        <p class="harari hidden1">ዩኒስኮ አለም ሑቁፍ ቁራስ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Handicrafts Section -->
        <section id="handicrafts" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="english text-3xl md:text-4xl font-bold text-gray-800 mb-4">Traditional Handicrafts</h2>
                    <h2 class="harari hidden1 text-3xl md:text-4xl font-bold text-gray-800 mb-4">ዚአዳ ኢጂ ሲነታች</h2>
                    <p class="english text-gray-600 max-w-2xl mx-auto">Exquisite handmade items showcasing Harari artistry and heritage</p>
                    <p class="harari hidden1 text-gray-600 max-w-2xl mx-auto">ዚሀረሪ ሲነት ዋ ቁራሱ ያርዛሉ አጃኢብ ዚተዩ ኢጂቤ ዚትደለጉ መሐዋች</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-amber-50 rounded-xl overflow-hidden1 shadow-md fade-in">
                        <div class="h-48 bg-amber-200 flex items-center justify-center">
                            <i class="fas fa-basket-shopping text-amber-600 text-5xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="english text-xl font-semibold text-gray-800 mb-2">Basketry</h3>
                            <h3 class="harari hidden1 text-xl font-semibold text-gray-800 mb-2">ሞታች</h3>
                            <p class="english text-gray-600 text-sm">Intricately woven baskets with traditional patterns</p>
                            <p class="harari hidden1 text-gray-600 text-sm">አዳ ሲነታችቤ ዚትደለጉ አጃኢብ ዚተዩ ኢጂቤ ዚትሰፉ ሞታች</p>
                        </div>
                    </div>

                    <div class="bg-green-50 rounded-xl overflow-hidden1 shadow-md fade-in" style="animation-delay: 0.1s">
                        <div class="h-48 bg-green-200 flex items-center justify-center">
                            <i class="fas fa-tshirt text-green-600 text-5xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="english text-xl font-semibold text-gray-800 mb-2">Textiles</h3>
                            <h3 class="harari hidden1 text-xl font-semibold text-gray-800 mb-2">ጨርቂቤ</h3>
                            <p class="english text-gray-600 text-sm">Traditional Harari clothing and fabric designs</p>
                            <p class="harari hidden1 text-gray-600 text-sm">ሀረሪ አዳ ሊባሻች ዋ ጨርቂቤ ዚደለጉ ሲነታች</p>
                        </div>
                    </div>

                    <div class="bg-red-50 rounded-xl overflow-hidden1 shadow-md fade-in" style="animation-delay: 0.2s">
                        <div class="h-48 bg-red-200 flex items-center justify-center">
                            <i class="fas fa-gem text-red-600 text-5xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="english text-xl font-semibold text-gray-800 mb-2">Jewelry</h3>
                            <h3 class="harari hidden1 text-xl font-semibold text-gray-800 mb-2">ሰያቅ</h3>
                            <p class="english text-gray-600 text-sm">Silver and beadwork with cultural significance</p>
                            <p class="harari hidden1 text-gray-600 text-sm">ሀረሪ አዳ ሊባሻች ማቤይነቤ ዚደለጉ ዚትሊያያ ዲዛይቤ ዚትደለጉ ሰያቅ ዲላጋች</p>
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-xl overflow-hidden1 shadow-md fade-in" style="animation-delay: 0.3s">
                        <div class="h-48 bg-blue-200 flex items-center justify-center">
                            <i class="fas fa-paint-brush text-blue-600 text-5xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="english text-xl font-semibold text-gray-800 mb-2">Pottery</h3>
                            <h3 class="harari hidden1 text-xl font-semibold text-gray-800 mb-2">አፈር ጌብ</h3>
                            <p class="english text-gray-600 text-sm">Traditional clay works with unique Harari motifs</p>
                            <p class="harari hidden1 text-gray-600 text-sm">ዚአዳ አፈር ጌብ ሉይ ዚኻና ኡጋቤ ሀረሪ ተቃሊድ ቤ ዚትደለጉ ኢጂ ሲነታች</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Messaging Section -->
        <section id="messaging" class="py-16 bg-green-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="english text-3xl md:text-4xl font-bold text-gray-800 mb-4">Community Messaging</h2>
                    <h2 class="harari hidden1 text-3xl md:text-4xl font-bold text-gray-800 mb-4">ዳይሐዋዞ ሉኽ</h2>
                    <p class="english text-gray-600 max-w-2xl mx-auto">Stay connected with important announcements and community updates</p>
                    <p class="harari hidden1 text-gray-600 max-w-2xl mx-auto">አትኼሽ ዚኻኑ አቴወቆታች ዋ ዳይሐዋዝ ዘማኒያችባሕ ዚትራአ ኩትቤ ዩነብራል ዚቁራ ዳይሐዋዝ ሉኻች</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Recent Messages -->
                    <div class="fade-in" style="animation-delay: 0.1s">
                        <h3 class="english text-2xl font-bold text-gray-800 mb-6">Recent Community Messages</h3>
                        <h3 class="harari hidden1 text-2xl font-bold text-gray-800 mb-6">ቁራ ወቅቲ ዚዳይሐዋዞ ሉኽ</h3>
                        <div class="space-y-4">
                            @if(isset($messages) && count($messages) > 0)
                                @foreach($messages as $message)
                                    @if ($message->language == 'eng')
                                        <div class="english bg-white rounded-lg shadow p-4">
                                            <h4 class="font-semibold text-green-700 mb-2">{{ $message->title ?? 'No Title' }}</h4>
                                            <p class="text-gray-600 text-sm mb-2">{{ $message->description ?? 'No description' }}</p>
                                            <span class="text-xs text-gray-500">Posted on {{ $message->created_at->format('M d, Y') ?? 'Unknown date' }}</span>
                                        </div>
                                    @elseif ($message->language == 'har')
                                        <div class="harari hidden1 bg-white rounded-lg shadow p-4">
                                            <h4 class="font-semibold text-green-700 mb-2">{{ $message->title ?? 'No Title' }}</h4>
                                            <p class="text-gray-600 text-sm mb-2">{{ $message->description ?? 'No description' }}</p>
                                            <span class="text-xs text-gray-500">Posted on {{ $message->created_at->format('M d, Y') ?? 'Unknown date' }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="bg-white rounded-lg shadow p-4 text-center">
                                    <p class="text-gray-600">No messages available</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Additional Content Placeholder -->
                    <div class="fade-in" style="animation-delay: 0.2s">
                        <div class="bg-white rounded-xl p-6 h-full">
                            <h3 class="english text-2xl font-bold text-gray-800 mb-6">Get Involved</h3>
                            <h3 class="harari hidden1 text-2xl font-bold text-gray-800 mb-6">ዳይሐዋዞ ተሳተፍ</h3>
                            <p class="english text-gray-600 mb-4">Join our community discussions and stay updated with the latest announcements.</p>
                            <p class="harari hidden1 text-gray-600 mb-4">ኪም ዳይሐዋዞ ሙዳወናች ተሳተፍ ዋ ቁራ ወቅቲ አቴወቆታችባሕ ዩነብራል ቁራ.</p>
                            <div class="english space-y-3">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-check text-green-500 mr-3"></i>
                                    <span>Community meetings every Saturday</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-bullhorn text-amber-500 mr-3"></i>
                                    <span>Emergency alerts and announcements</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-handshake text-blue-500 mr-3"></i>
                                    <span>Volunteer opportunities</span>
                                </div>
                            </div>
                            <div class="harari hidden1 space-y-3">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-check text-green-500 mr-3"></i>
                                    <span>ዳይሐዋዝ ሙጃላሳች ኩል ሰንበት</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-bullhorn text-amber-500 mr-3"></i>
                                    <span>አጅል ማሳወቂያች ዋ አቴወቆታች</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-handshake text-blue-500 mr-3"></i>
                                    <span>ዚተግባር አፍታች</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Congress Section -->
        <section id="congress" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="english text-3xl md:text-4xl font-bold text-gray-800 mb-4">Harari Congress</h2>
                    <h2 class="harari hidden1 text-3xl md:text-4xl font-bold text-gray-800 mb-4">ሀረሪ መጀሊስ</h2>
                    <p class="english text-gray-600 max-w-2xl mx-auto">Governing body representing the Harari people and their interests</p>
                    <p class="harari hidden1 text-gray-600 max-w-2xl mx-auto">ሀረሪ መሐድ መጅሊስ ተዋቀሮት</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="fade-in">
                        <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-xl p-8 text-white">
                            <h3 class="text-2xl font-bold mb-6">Congress Leadership</h3>
                            <div class="space-y-6">
                                @if(isset($congress_members) && count($congress_members) > 0)
                                    @foreach ($congress_members as $member)
                                        <div class="flex items-center">
                                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mr-4">
                                                @if(isset($member->photo_url) && !empty($member->photo_url))
                                                    <img src="{{ Storage::url($member->photo_url) }}"
                                                         alt="{{ $member->name ?? 'Member' }}"
                                                         class="w-14 h-14 rounded-full object-cover">
                                                @else
                                                    <i class="fas fa-user text-green-600 text-2xl"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-lg">{{ $member->name ?? 'Unknown Name' }}</h4>
                                                <p class="text-sm">{{ $member->position ?? 'No position specified' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center">No congress members data available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="fade-in" style="animation-delay: 0.1s">
                        <div class="english bg-gray-50 rounded-xl p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Congress Activities</h3>
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">Cultural preservation initiatives</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">Community development projects</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">Educational programs</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">Representation in regional government</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">Heritage site preservation</span>
                                </li>
                            </ul>
                        </div>

                        <div class="harari hidden1 bg-gray-50 rounded-xl p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">ሀረሪ መጅሊስ ኩሽኩሽቲያች</h3>
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">አዳ ቄረሖት ሐፈ ሐፍቲ</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">ማሐዲያ ኔሮት ፕሮጀክቲ</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">ደርሲ በርናሚጃች</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">ሑስኒዞ ሑኩማ ኡስጡቤ ተዌከሎት</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-700">ቁራስ አታይ ቄረሖት</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- News Section -->
        <section id="news" class="py-16 bg-gray-50">
            <div class="text-center mb-12">
                <h2 class="english text-3xl md:text-4xl font-bold text-gray-800 mb-4">Latest News</h2>
                <h2 class="harari hidden1 text-3xl md:text-4xl font-bold text-gray-800 mb-4">ቁራ ወቅቲ ኻበራች</h2>
                <p class="english text-gray-600 max-w-2xl mx-auto">Stay updated with the latest developments in the Harari community</p>
                <p class="harari hidden1 text-gray-600 max-w-2xl mx-auto">ሀረሪ ሑስኒቤ ዛሉ ሐጂስ ሐጂስ ሩኹብቲያቹ ዋ ወቅቲያ ማእሉማታች የርኸቡ</p>
            </div>

            <!-- English News -->
            <div class="english max-w-7xl mx-auto px-4">
                @if(isset($recent_english_posts) && count($recent_english_posts) > 0)
                    @foreach($recent_english_posts as $post)
                        @if ($post->category != 'message')
                            <div class="bg-white rounded-xl shadow-md mb-6 p-6 fade-in">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $post->title ?? 'No Title' }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->description ?? 'No description available', 150) }}</p>

                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="bg-white rounded-xl shadow-md p-6 text-center">
                        <p class="text-gray-600">No English news available</p>
                    </div>
                @endif
            </div>

            <!-- Harari News -->
            <div class="harari hidden1 max-w-7xl mx-auto px-4">
                @if(isset($recent_harari_posts) && count($recent_harari_posts) > 0)
                    @foreach($recent_harari_posts as $post)
                        @if ($post->category != 'message')
                            <div class="bg-white rounded-xl shadow-md mb-6 p-6 fade-in">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $post->title ?? 'No Title' }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->description ?? 'No description available', 150) }}</p>

                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="bg-white rounded-xl shadow-md p-6 text-center">
                        <p class="text-gray-600">ሀረሪ ኻበራች አይተኻነስአ</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- Laws Section -->
        <section id="laws" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="english  text-3xl md:text-4xl font-bold text-gray-800 mb-4">Laws & Regulations</h2>
                    <h2 class="harari hidden1 text-3xl md:text-4xl font-bold text-gray-800 mb-4">ናች ዋ መኤቀድቲ</h2>
                    <p class="english text-gray-600 max-w-2xl mx-auto">Governing laws and community regulations for the Harari people</p>
                    <p class="harari hidden1 text-gray-600 max-w-2xl mx-auto">ዚሀረሪ መሐድ መጅሊስ መትሒዳደርቲ ቃኑናች ዋ ዳይሐዋዝ መኤቀድቲያች</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach ($law_posts as $law)
                        @if ($law->language == 'eng')
                            <div class="english bg-gray-50 rounded-xl p-6 fade-in">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $law->title ?? 'No Title' }}</h3>
                                <p class="text-gray-600 text-sm">{{ Str::limit($law->description ?? 'No description available', 200) }}</p>
                            </div>
                        @elseif ($law->language == 'har')
                            <div class="harari hidden1 bg-gray-50 rounded-xl p-6 fade-in">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $law->title ?? 'No Title' }}</h3>
                                <p class="text-gray-600 text-sm">{{ Str::limit($law->description ?? 'No description available', 200) }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <!-- JavaScript -->
    <script>
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

            // Language toggle functionality
            const toggleButton = document.getElementById('toggle-language');
            if (toggleButton) {
                toggleButton.addEventListener('click', function() {
                    const harariElements = document.querySelectorAll('.harari');
                    const englishElements = document.querySelectorAll('.english');

                    harariElements.forEach(el => {
                        el.classList.toggle('hidden1');
                    });
                    englishElements.forEach(el => {
                        el.classList.toggle('hidden1');
                    });

                    // Update button text
                    const buttonText = this.querySelector('.english').classList.contains('hidden1') ?
                        'Switch to English' : 'Switch to Harari';
                    this.querySelector('.english:not(.hidden1), .harari:not(.hidden1)').textContent = buttonText;
                });
            }
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
    </style>
</x-app-layout>
