<x-app-layout>
    <x-slot name="title">
        Harari Congress - Preserving Culture, History, and Community
    </x-slot>

    <x-slot name="description">
        Official website of the Harari Congress - Promoting Harari culture, history, handmade crafts, news, laws, and community messaging.
    </x-slot>

    <!-- Main Content -->
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-amber-50">
        <!-- tagle to change language (using a switch)-->
        <div class="absolute top-4 right-4 z-20">
            <button id="language-toggle" class="bg-white text-green-700 hover:bg-green-50 font-semibold py-2 px-4 rounded-lg shadow-lg transition duration-300">
                <i class="fas fa-globe-americas mr-2"></i><span class="english">Switch to Harari</span><span class="harari hidden">ወደ ሀረሪ ቀይር</span>
            </button>
        </div>
        <!-- Slideshow with Fixed Text Section -->
        <section class="py-8 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="overflow-hidden rounded-xl shadow-lg fade-in relative">
                    <!-- Fixed Text Overlay -->
                    <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center px-4">
                        <h1 class="english text-4xl md:text-6xl font-bold mb-6 text-white drop-shadow-lg">
                            Harari Congress
                        </h1>
                        <h1 class="harari text-4xl md:text-6xl font-bold mb-6 text-white drop-shadow-lg">
                            ሀረሪ መጀሊስ
                        </h1>
                        <p class="english text-xl md:text-2xl mb-8 max-w-3xl mx-auto text-white drop-shadow-lg">
                            Preserving the rich heritage and culture of Harar while building a prosperous future for our community
                        </p>
                        <p class="harari text-lg md:text-xl mb-4 max-w-2xl mx-auto text-white drop-shadow-lg">
                            ዚሀረሪ ሳዮት ቁራስ ዋ አዳች መቄረሕቤ ዳይሐዋዝዚኛሌ ዚሳይቲ ሙስተቅበል መቼኻል ላአይቤ.
                        </p>
                        <div class="flex flex-wrap justify-center gap-4 mt-8">
                            <a href="#messaging"
                            class="english bg-white text-green-700 hover:bg-green-50 font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                <i class="fas fa-bullhorn mr-2"></i>Community Messages
                            </a>
                            <a href="#messaging"
                            class="harari bg-white text-green-700 hover:bg-green-50 font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                <i class="fas fa-bullhorn mr-2"></i>ዚዳይሐዋዞ ሉኽ
                            </a>
                            <a href="#news"
                            class="english bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                <i class="fas fa-newspaper mr-2"></i>Latest News
                            </a>
                            <a href="#news"
                            class="harari bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                <i class="fas fa-newspaper mr-2"></i>ቁራ ወቅቲ ኻበራች
                            </a>
                        </div>
                    </div>

                    <!-- Slideshow Images -->
                    <div class="relative h-96 md:h-screen max-h-[80vh]">
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar1.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-0">
                            <img src="{{ asset('images/harar2.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-0">
                            <img src="{{ asset('images/harar3.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-0">
                            <img src="{{ asset('images/harar4.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <!-- more -->
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar1.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar2.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar3.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar4.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar5.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar6.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar7.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar8.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar9.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar10.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar11.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar12.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 w-full h-full slideshow-image opacity-100">
                            <img src="{{ asset('images/harar13.jpg') }}" alt="Harar City" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <!-- more end -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Rest of the sections remain unchanged -->
        <!-- Culture Section -->
        <section id="culture" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="english text-3xl md:text-4xl font-bold text-gray-800 mb-4">Harari Culture</h2>
                    <h2 class="harari text-3xl md:text-4xl font-bold text-gray-800 mb-4">ዚሀረሪ አዳ</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-green-50 rounded-xl p-6 text-center fade-in">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-language text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="english text-xl font-semibold text-gray-800 mb-3">Harari Language</h3>
                        <h3 class="harari text-xl font-semibold text-gray-800 mb-3">ሀረሪ ሉኃ</h3>
                        <p class="english text-gray-600">Learn about the unique Harari language (Gey Sinan) and its preservation efforts</p>
                        <p calss="harari text-gray-600">ሀረሪ ሉኃ ኔሮት ዋ ቄረሖት ኩሽኩሽቲው ዩቁ.</p>
                    </div>

                    <div class="bg-amber-50 rounded-xl p-6 text-center fade-in" style="animation-delay: 0.1s">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-utensils text-amber-600 text-2xl"></i>
                        </div>
                        <h3 class="english text-xl font-semibold text-gray-800 mb-3">Traditional Cuisine</h3>
                        <h3 class="harari text-xl font-semibold text-gray-800 mb-3">አዳ ሐንጉራች</h3>
                        <p class="english text-gray-600">Explore the unique flavors and dishes of Harari culinary traditions</p>
                        <p class="harari text-gray-600">ሀረሪ አዳ ሐንጉራች ሲነታች ዋ ሉይ ጢማቹ የፌሕሱ</p>
                    </div>

                    <div class="bg-red-50 rounded-xl p-6 text-center fade-in" style="animation-delay: 0.2s">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-praying-hands text-red-600 text-2xl"></i>
                        </div>
                        <h3 class="english text-xl font-semibold text-gray-800 mb-3">Religious Traditions</h3>
                        <h3 class="harari text-xl font-semibold text-gray-800 mb-3">ሹዋል ኢድ ዋ መውሉድ</h3>
                        <p class="english text-gray-600">Understanding the Islamic traditions and religious practices in Harari culture</p>
                        <p class="harari text-gray-600">ዚሀረሪ መሐድ ሹዋል ኢድ ዋ መውሉድ መግደርቲ ሒራች ዋ ተቃሊዳች</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- History Section -->
        <section id="history" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="english text-3xl md:text-4xl font-bold text-gray-800 mb-4">History of Harar</h2>
                    <h2 class="harari text-3xl md:text-4xl font-bold text-gray-800 mb-4">ዚሀረሪ ታሪኽ</h2>
                    <p class="english text-gray-600 max-w-2xl mx-auto">Explore the ancient walled city and its significant historical legacy</p>
                    <p class="harari text-gray-600 max-w-2xl mx-auto">ቀዲም ጆጎል ሑጡርቤ ዚትቼኻልቲ አሲማ ዋ በግዚታ ታሪኽ ዋ ቁራሳች ዛሌ</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="fade-in">
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="english text-2xl font-bold text-gray-800 mb-4">The Walled City</h3>
                            <h3 class="harari text-2xl font-bold text-gray-800 mb-4">ዚትሔጠርቲ አሲማ</h3>
                            <p class="english text-gray-600 mb-4">
                                The ancient walled city of Harar, founded in the 7th century, is renowned for its unique architecture and rich cultural heritage. It was the capital of the Harari Kingdom from 1520 to 1568 and served as an important center for Islamic learning and trade.
                            <p class="harari text-gray-600 mb-4">
                                ታሪኺያ ዚቴማ ዚትሼመቅቲ ሀረር ጆጎል ዩኒስኮ አለም ሑቁፍ ታሪኽ ቁራስነትቤ ሲትሴጀልቲ ዚኻነሳአ 82 መስጂዳች 102 አዋቻች ዛሉ ዚኻነሳአ ዩም ቀር አፍሪካቤ ተትኺሽዛት ዚኻንቲ ዚኢስላሚያ ታሪኺያ አሲማነንቴ
                            </p>
                            <ul class="harari space-y-2 text-gray-600">
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
                        </div>
                    </div>
                    <div class="fade-in" style="animation-delay: 0.1s">
                        <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-xl p-8 text-white">
                            <h3 class="text-2xl font-bold mb-4">Historical Timeline</h3>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="bg-white text-green-700 w-20 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-4">
                                        7th C
                                    </div>
                                    <p>Foundation of Harar</p>
                                </div>
                                <div class="flex">
                                    <div class="bg-white text-green-700 w-20 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-4">
                                        1520
                                    </div>
                                    <p>Capital of Harari Kingdom</p>
                                </div>
                                <div class="flex">
                                    <div class="bg-white text-green-700 w-20 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-4">
                                        1887
                                    </div>
                                    <p>Incorporation into Ethiopia</p>
                                </div>
                                <div class="flex">
                                    <div class="bg-white text-green-700 w-20 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-4">
                                        2006
                                    </div>
                                    <p>UNESCO World Heritage Site</p>
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
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Traditional Handicrafts</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Exquisite handmade items showcasing Harari artistry and heritage</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-amber-50 rounded-xl overflow-hidden shadow-md fade-in">
                        <div class="h-48 bg-amber-200 flex items-center justify-center">
                            <i class="fas fa-basket-shopping text-amber-600 text-5xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Basketry</h3>
                            <p class="text-gray-600 text-sm">Intricately woven baskets with traditional patterns</p>
                        </div>
                    </div>

                    <div class="bg-green-50 rounded-xl overflow-hidden shadow-md fade-in" style="animation-delay: 0.1s">
                        <div class="h-48 bg-green-200 flex items-center justify-center">
                            <i class="fas fa-tshirt text-green-600 text-5xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Textiles</h3>
                            <p class="text-gray-600 text-sm">Traditional Harari clothing and fabric designs</p>
                        </div>
                    </div>

                    <div class="bg-red-50 rounded-xl overflow-hidden shadow-md fade-in" style="animation-delay: 0.2s">
                        <div class="h-48 bg-red-200 flex items-center justify-center">
                            <i class="fas fa-gem text-red-600 text-5xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Jewelry</h3>
                            <p class="text-gray-600 text-sm">Silver and beadwork with cultural significance</p>
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-xl overflow-hidden shadow-md fade-in" style="animation-delay: 0.3s">
                        <div class="h-48 bg-blue-200 flex items-center justify-center">
                            <i class="fas fa-paint-brush text-blue-600 text-5xl"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Pottery</h3>
                            <p class="text-gray-600 text-sm">Traditional clay works with unique Harari motifs</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Messaging Section -->
        <section id="messaging" class="py-16 bg-green-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Community Messaging</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Stay connected with important announcements and community updates</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Message Form -->
                    <div class="bg-white rounded-xl shadow-lg p-6 fade-in">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Send Community Message</h3>
                        <form class="space-y-4">
                            <div>
                                <label for="message-category" class="block text-sm font-medium text-gray-700 mb-1">
                                    Message Category
                                </label>
                                <select id="message-category"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Select category</option>
                                    <option value="announcement">Announcement</option>
                                    <option value="event">Event</option>
                                    <option value="urgent">Urgent Notice</option>
                                    <option value="cultural">Cultural Update</option>
                                </select>
                            </div>

                            <div>
                                <label for="message-title" class="block text-sm font-medium text-gray-700 mb-1">
                                    Message Title
                                </label>
                                <input type="text" id="message-title"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                       placeholder="Enter message title">
                            </div>

                            <div>
                                <label for="message-content" class="block text-sm font-medium text-gray-700 mb-1">
                                    Message Content
                                </label>
                                <textarea id="message-content" rows="4"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                          placeholder="Type your message here..."></textarea>
                            </div>

                            <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                                Send Message to Community
                            </button>
                        </form>
                    </div>

                    <!-- Recent Messages -->
                    <div class="fade-in" style="animation-delay: 0.1s">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Recent Community Messages</h3>
                        <div class="space-y-4">
                            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-semibold text-gray-800">Annual Cultural Festival</h4>
                                    <span class="text-xs text-gray-500 bg-green-100 px-2 py-1 rounded">Event</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">Join us for the annual Harari cultural festival next month. Traditional food, music, and crafts will be showcased.</p>
                                <div class="text-xs text-gray-500">Posted 2 days ago</div>
                            </div>

                            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-amber-500">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-semibold text-gray-800">Community Meeting</h4>
                                    <span class="text-xs text-gray-500 bg-amber-100 px-2 py-1 rounded">Announcement</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">Monthly community meeting scheduled for this Saturday at the cultural center.</p>
                                <div class="text-xs text-gray-500">Posted 5 days ago</div>
                            </div>

                            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-500">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-semibold text-gray-800">Important Update</h4>
                                    <span class="text-xs text-gray-500 bg-red-100 px-2 py-1 rounded">Urgent</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">Registration for heritage preservation workshop closes this Friday.</p>
                                <div class="text-xs text-gray-500">Posted 1 week ago</div>
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
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Harari Congress</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Governing body representing the Harari people and their interests</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="fade-in">
                        <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-xl p-8 text-white">
                            <h3 class="text-2xl font-bold mb-6">Congress Leadership</h3>
                            <div class="space-y-6">
                                <div class="flex items-center">
                                    <div class="w-16 h-16 bg-green-400 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-user text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Chairperson</h4>
                                        <p class="text-green-100">Abdulhakim Mohammed</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-16 h-16 bg-green-400 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-user text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Vice Chairperson</h4>
                                        <p class="text-green-100">Amina Jebel</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-16 h-16 bg-green-400 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-user text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Secretary General</h4>
                                        <p class="text-green-100">Yusuf Ahmed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fade-in" style="animation-delay: 0.1s">
                        <div class="bg-gray-50 rounded-xl p-8">
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
                    </div>
                </div>
            </div>
        </section>

        <!-- News Section -->
        <section id="news" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Latest News</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Stay updated with the latest developments in the Harari community</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden fade-in">
                        <div class="h-48 bg-green-200 flex items-center justify-center">
                            <i class="fas fa-monument text-green-600 text-5xl"></i>
                        </div>
                        <div class="p-6">
                            <span class="text-xs font-semibold bg-green-100 text-green-700 px-2 py-1 rounded">Heritage</span>
                            <h3 class="text-xl font-semibold text-gray-800 my-3">Restoration of Harar Gates</h3>
                            <p class="text-gray-600 mb-4">The historical gates of Harar Jugol are undergoing restoration to preserve their cultural significance.</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>March 15, 2023</span>
                                <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden fade-in" style="animation-delay: 0.1s">
                        <div class="h-48 bg-amber-200 flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-amber-600 text-5xl"></i>
                        </div>
                        <div class="p-6">
                            <span class="text-xs font-semibold bg-amber-100 text-amber-700 px-2 py-1 rounded">Education</span>
                            <h3 class="text-xl font-semibold text-gray-800 my-3">Harari Language Classes</h3>
                            <p class="text-gray-600 mb-4">New language preservation program launched to teach Harari to younger generations.</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>March 10, 2023</span>
                                <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden fade-in" style="animation-delay: 0.2s">
                        <div class="h-48 bg-blue-200 flex items-center justify-center">
                            <i class="fas fa-hands-helping text-blue-600 text-5xl"></i>
                        </div>
                        <div class="p-6">
                            <span class="text-xs font-semibold bg-blue-100 text-blue-700 px-2 py-1 rounded">Community</span>
                            <h3 class="text-xl font-semibold text-gray-800 my-3">New Community Center</h3>
                            <p class="text-gray-600 mb-4">Construction begins on a new community center to host cultural events and gatherings.</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>March 5, 2023</span>
                                <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Laws Section -->
        <section id="laws" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Laws & Regulations</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Governing laws and community regulations for the Harari people</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="fade-in">
                        <div class="bg-gray-50 rounded-xl p-6 h-full">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Cultural Preservation Laws</h3>
                            <div class="space-y-4">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="font-semibold text-gray-800 mb-2">Heritage Site Protection</h4>
                                    <p class="text-gray-600 text-sm">Regulations governing the preservation and maintenance of historical sites within Harar Jugol.</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="font-semibold text-gray-800 mb-2">Traditional Architecture</h4>
                                    <p class="text-gray-600 text-sm">Guidelines for maintaining traditional Harari architectural styles in the old city.</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="font-semibold text-gray-800 mb-2">Cultural Artifact Protection</h4>
                                    <p class="text-gray-600 text-sm">Laws preventing the unauthorized export of culturally significant artifacts.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fade-in" style="animation-delay: 0.1s">
                        <div class="bg-green-50 rounded-xl p-6 h-full">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Community Regulations</h3>
                            <div class="space-y-4">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="font-semibold text-gray-800 mb-2">Community Governance</h4>
                                    <p class="text-gray-600 text-sm">Procedures for community decision-making and leadership selection.</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="font-semibold text-gray-800 mb-2">Dispute Resolution</h4>
                                    <p class="text-gray-600 text-sm">Traditional methods for resolving conflicts within the community.</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="font-semibold text-gray-800 mb-2">Resource Management</h4>
                                    <p class="text-gray-600 text-sm">Regulations for the fair distribution and use of community resources.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Updated slideshow logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            // Initialize
            showSlide(currentIndex);
            setInterval(nextSlide, 3000); // Change slide every 3 seconds
        });
        // Language toggle functionality(bettwen english and harari using thhere class (harari and english))
        document.getElementById('toggle-language').addEventListener('click', function() {
            const harariElements = document.querySelectorAll('.harari');
            const englishElements = document.querySelectorAll('.english');

            harariElements.forEach(el => {
                el.classList.toggle('hidden');
            });
            englishElements.forEach(el => {
                el.classList.toggle('hidden');
            });
        });
    </script>
    <style>
        /* Slideshow styling */
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
        .english {
            display: none;
        }
        .harari {
            display: block;
        }
    </style>

</x-app-layout>
