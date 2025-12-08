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
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-green-600 to-green-800 text-white rounded-3xl mb-8 overflow-hidden shadow-2xl">
                <div class="px-6 py-16 text-center relative">
                    <div class="absolute inset-0 opacity-10" style="background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");"></div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">ቡእቲ</h1>
                    <p class="text-xl md:text-2xl opacity-90 font-light max-w-3xl mx-auto">
                        ሀረሪ መሐድ - ሀረሪ ኡመት ታሪኽ፣ ማንነት እና የወደፊት ራእይ
                    </p>
                </div>
            </div>

            <!-- Navigation Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border-l-4 border-green-500 sticky top-6 z-30">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-green-600">📚</span>
                    <h3 class="text-lg font-semibold text-green-700">የይዘት ክፍሎች</h3>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="#section-bueti" class="bg-green-50 text-green-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-green-600 hover:text-white transition-all duration-300 border border-green-200 hover:border-green-600 hover:shadow-md">
                        ቡእቲ
                    </a>
                    <a href="#section-riyot-telakot" class="bg-green-50 text-green-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-green-600 hover:text-white transition-all duration-300 border border-green-200 hover:border-green-600 hover:shadow-md">
                        ሪኦት፣ተላኾት ዋ ቀድራች
                    </a>
                    <a href="#section-hadef" class="bg-green-50 text-green-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-green-600 hover:text-white transition-all duration-300 border border-green-200 hover:border-green-600 hover:shadow-md">
                        ሐደፍ
                    </a>
                    <a href="#section-dumum-hadef" class="bg-green-50 text-green-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-green-600 hover:text-white transition-all duration-300 border border-green-200 hover:border-green-600 hover:shadow-md">
                        2.1. ዱሙም ሐደፋ
                    </a>
                    <a href="#section-zurzur-hadefach" class="bg-green-50 text-green-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-green-600 hover:text-white transition-all duration-300 border border-green-200 hover:border-green-600 hover:shadow-md">
                        ዙርዙር ሐደፋች
                    </a>
                </div>
            </div>

            <!-- Main Content Sections -->
            <div class="space-y-8">
                <!-- Section 1: Bueti -->
                <section id="section-bueti" class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-green-600 hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-3xl font-bold text-green-800 mb-6 pb-4 border-b-2 border-green-100">ቡእቲ</h2>
                    <div class="space-y-6 text-gray-700 leading-relaxed text-lg">
                        <p>
                            ሀረሪ ኡመት ሑሉፍ ዛዩ ደኻጥ ሑኩማች ሐርቆትዚዩ ሰበብቤ ሒልቂዞ ኡኑስ ዚኻና ሀረሪ መሐድ ማንነትዞቤ የቃኛኩት፣
                            ሲያሳ ዋ ኢቅቲሳዲያቤም ዩሩሕቂማ አላይዞ ኢጂው ቀር ቀረብ ዩቂሕሪኩት፣ ኢስበልበላት አዱኛ ባዳችቤ
                            ዩትፌጠኒኩት ሞሸቤ ዘጋሕ ደኽጢዋ ጀሪማ ዩቡርዲባ ዚናራ ኡመት ዚናራነት ዩታወቃል፡፡
                        </p>
                        <p>
                            ሀረሪ መሐድ መጅሊስ መጋቢት 06 አያም 1987 ዚኢዮጲያ ዚመትሚጃጅቲ ሑኩማ ተዌካያች ሒርጊ ጋርቤ 102ታኝ ኡርፊ
                            ዲብላንቤ ሀረሪ ሑስኒ ሉይ ሚልሐ ሔራ ጠብ ዩሊኩት ዌሰና ዩዞም ሀረሪ ሑስኒ መሐዲያ ሒርጊጋር መቃነኑ ዩነካል፡፡
                            ሀረሪ ሑስኒ አኽእ ዛል 2 ዊቃሮታችቤ ዩትዋቀሩኩት ሀረሪ መሐድ መጅሊስ ዋ ሀረሪ ሁስኒ ሒርጊ ጋር ቃኑን ያጪ ቃማቹ
                            መድበልቤ 1986 አመትቤ ዚኢፊድሪ መገስ ሐከማ ኢስሰበታ ቤሔርሌ ወቅተንዞ ኡርፊ ዩኹንኩት ኻናማ ሑስኒዞ ሑኩማቤ
                            ሀረሪ መሐድ ዩትዌከልባዛል ሒርጊ ጋር ኻና፡፡
                        </p>
                        <div class="bg-green-50 p-6 rounded-xl border border-green-200">
                            <h3 class="text-xl font-semibold text-green-700 mb-4">መጅሊስዞ ሀረሪ ኡመት</h3>
                            <p>
                                መጅሊስዞ ሀረሪ ኡመት ታሪኽዞው፣ አደዞው፣ ሉኃዞው ዋ ማንነትዞ ዩትቄረሕማ ጂልቤ ኪም ጂል ዘልቲሸራረፈቤ አሐድ
                                ሒዊሽቲም ቢላይ ሑሉፍ ዩልኩት፣ ቃኑን ለአይነት ዩነግሲማ፣ መሐድ መሐዲናች ዋ ኡመታች ኩሉ ፈንካችቤም መሰስ
                                መስሳነትዚዩው ኢቅቲሳዲ ፣ ዳይሓዋዝ ዋ ሲያሳ ተናፋኢነትዚዩው ዩትገደሪማ፣ ኦር ኺሾና ለአይቤ ዚቼኻላ፣ ሲር ሲሰዳዳ
                                አሐድነት፣ መትፊራረክ ፣ ዚደድ ፣ ዚሰላም ዋ ፌደራሊያ ዲሞክራጢ ኣዳብ የሲስኒማ መራኣ፣ሪኦትዞው ሲንቂ ሞሸቤ
                                መገስ ሐከማው ተርጀማ ሞሸቤ፣ ቁዷ መትታሻ ዋ መሰሳ መሰሳአነት ላአይቤ ዚትቼኻላ ኡመታች አሐድነት ሲር ዩሰዲማ
                                ዩነፍጊኩት ሞሻ ፣ ሑስኒዞቤ ሰላሚያ ዲሞክራሲ ተራኦት ዩነፍጊኩት፣ ቃኑን ዩጭለዩሌ ዩትኻሽዛሉ ወለባይ ቃኑን ሐጃጁ
                                ቢሳሎት ዋ መላያ፣ ዲባየቤም መደኒያች መገስ ሐከማው ቤጆትቤ ዩቁማ ፌደራሊያ ዲሞክራጢ ኢቲዮጵያው መቼኻልሌ
                                ቁጭነትቤ መድለግ ተላኾትዞው ለሐደማ መገስ ሐከመቤ ተላዩማ ዚትሰጦ ሰልጣ ዋ ኢሾታቹ መትዋጣእሌ ዋ ነቲጃም
                                መኽነሌ መትኒጫጨሕቤ ዩትረኻባል፡፡
                            </p>
                        </div>
                        <p>
                            ሀረሪ መሐድ ማንነቱው መትቄራሕ ገረብደሌ ዚሀረሪ መሐድ መጅሊስ መገስ ሐከማ ለአይነት መንገስ ገረብደሌ
                            ቃኑን ሞጫ ፣ አሜሀሮትዞው ተኽታተሎትዋ ተአወኖት ሞሻማ ኡምመት ተናፋኢነትዞው መዬቀን፡፡
                        </p>
                        <p>
                            አኻእ ወቅቲቤ ዲሞቅራጢያ ሒራቤ መትሶረቤ መትፊራረክ ዋ መትጊዳደርቤ ዚትቼኻላ ዚባድ አሐድነት ሲርዞ
                            የነፍጊኩት መጅሊስዞ የትሪኽባቤ ዛል ፊሪ ዋ ደውሪዞ ላቂንታ፡፡
                        </p>
                        <p>
                            ዩ ዛልባኩትቤ ዩኹኒማ መጅሊስዞ አዳለጎትዞ መጦኛ ገረብደሌ ባድ ሑቁፍ ዋ አለም ሑቁፍ ደረጀቤ ኹንቲያች
                            ኒዊጭቲ ገረብደሌ ቂብላናችዞው ባሕሲ ኪልአሻ ዚቅ ሒርፈታችዞው ኪም ዩጡኝ ደረጃ ኩፎኝ ኪል አጦኛ ዋ ዚጦኙ
                            ሒርፈታቹ ሑስኒዞ ኑቡር ኹንቲባሕ ኪልአትዋሐባ ዳይሐዋዞ ኩሉሑቁፍ ተናፋኢነቱ ዩጡኝ ኹንቲቤ የሰብቲዛልኩትቤ
                            ተኼታይ አዳለጎታቹ ሐጂስ ኒውጢ ሐማሰቤ መድለግሌ ቁጭነትቤ መድለግቤ ጢትረኸባል ፡፡
                            ኢሾትዋልነትዞሌም መጅሊስዞ ኣጦሮት ዩስጢዛል መክተባ ጋርዞ ው ኢላዋ አኽእ ዛጥ ዊቃሮታች ዊጣኖታች
                            ዋ ዚአዳለጎትዋ አሜሐሮት ኹንቲያቹ መቤሐስቤ ዚያዳ ዚቅ ዪሊኩት ሞሸቤ ዩትራኻባል፡፡
                            የኽኒማም መጅሊስዞ ዩ ሐደፋዞው መክተባ ጋርዙ ጢት መስኡላች ዋ ደላጊያችቤ ሙጢቤ አትታይ ዩቡርዱሜል፡፡
                            ዩሌ ባይቲም ሑስኒዞ ዳይሐዋዝ፣ ሑኩማ፣ ማሐድ መሐዲናች ዋ ኡመታች ዋ አላይ ዩጠርሐዩዛል ቃማች
                            ጀሚእኡም በግ ዚታ ተሳአዶት የትኺሽዛልነት ኡሙኒንታ፡፡
                        </p>
                    </div>
                </section>

                <!-- Section 2: Riyot, Telakot, Qedirach -->
                <section id="section-riyot-telakot" class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-green-600 hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-3xl font-bold text-green-800 mb-6 pb-4 border-b-2 border-green-100">ሪኦት፣ተላኾት ዋ ቀድራች</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Riyot -->
                        <div class="bg-green-50 p-6 rounded-xl border border-green-200">
                            <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center gap-2">
                                <span class="text-green-600">📊</span>
                                ሪኦት
                            </h3>
                            <div class="text-gray-700">
                                <p>ሀረር ዋ ሀረሪ ማንነት ሒዊሽቲ ቢላይ ዪዲጅ ጂልሌ ሑሉፍ ሞሻ</p>
                            </div>
                        </div>

                        <!-- Telakot -->
                        <div class="bg-green-50 p-6 rounded-xl border border-green-200">
                            <h3 class="text-xl font-semibold text-green-700 mb-4 flex items-center gap-2">
                                <span class="text-green-600">📈</span>
                                ተላኾት
                            </h3>
                            <div class="text-gray-700">
                                <p>
                                    ሀረሪ ታሪኽ፣ሉኃ ዋ ቁራስ ዚቅዚታ ፖሊሲ፣ ቃኑን ዋ ኢሾት ሔራ ዪትዜገድለዩማ
                                    ኡምመት ማንነት አኽኻእ ዛልባ ደረጃቤ ዩጡኝኩት ዩኹናል
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Qedirach -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-green-700 mb-6 pb-2 border-b border-green-100">ቀድራችዚና</h3>
                        <div class="text-gray-700 leading-relaxed space-y-3 pl-4">
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p class="text-lg">ማንነትዞው ዩዲዛል ኡምመት መንበርቲ ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p class="text-lg">አለም ሑቁፍቤ ዚትሴጀላ ቁራስ መንበርቲ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p class="text-lg">ዚመትፊራረክ፣ዚመትዋደድ ዋ ዚአሐድነት አቆት መንበርቲ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p class="text-lg">ጪንቂው መፍተሕሌ ጠብ ዚታ ኡምመት መንበርቲ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p class="text-lg">ታሪኺያ ሓላመሐል ተእሲሳችዚና መንበርቲ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p class="text-lg">ዚኡምመት ፊሪግቲ መንበርቲ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p class="text-lg">ሚን የቁምሲ ሑይ ታሪኽ መንበርቲ፣</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 3: Hadef -->
                <section id="section-hadef" class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-green-600 hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-3xl font-bold text-green-800 mb-6 pb-4 border-b-2 border-green-100">ሐደፍ</h2>

                    <!-- Subsection: Dumum Hadef -->
                    <div id="section-dumum-hadef" class="mb-8">
                        <h3 class="text-2xl font-bold text-green-700 mb-4">2.1. ዱሙም ሐደፋ</h3>
                        <div class="text-gray-700 leading-relaxed space-y-4 text-lg pl-4">
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>
                                    ሀረሪ ኡምመት ዚማነት መትገለጥቲ ዚተዩ ኣደ፣ቁራስ፣ታሪኽ ዋ ሉኃው መትቄረሕዞው መዬቀን
                                </p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>
                                    ሀረሪ ኡምመት ሑስኒዞቤ ዚሲያሳ፣ዚዳይሐዋዝ ዋ ዚዲነትጌይ ሓጃችቤ ኑቁሕነት ዋ ዩጡኝ ደረጃቤ ዪዋርኩት ሞኛ፤
                                    ኡምመትሌ ኡምመት ተቃጠሮቱ መጦኛቤ ሑስኒዞቤ መዋራዞ ደማነዞው መዬቀን
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Subsection: Zurzur Hadefach -->
                    <div id="section-zurzur-hadefach">
                        <h3 class="text-2xl font-bold text-green-700 mb-4">ዙርዙር ሐደፋች</h3>
                        <div class="text-gray-700 leading-relaxed space-y-4 text-lg pl-4">
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>አደዞው ቢሳሎትቤ ዚትሬገዛ ኹንቲቤ ዪኒርባ ሓለቱ መትሚቻቻ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>ቁራሱው መቄረሕሌ ዞጠኡ ቃኑናቹው መቤሐስማ መጦኛ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>ሉኃው መኔራሌ ዛሉ ቂብላናቹ መቤሐስቤ ዚትማለአ ሐለትቤ ሉኃው መኔራሌ ሔላ መዜገድ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>ሀረሪ ኡምመት ሓላ መሐል ሔራችዞ ቤቀድ ዚናሬው ዚቅቲፎኝ ዪርገብጊኩት መትፌረክ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>
                                    ዚሀረሪ ኔሮት ሙጋዱው ዚቅ አሳስቤ መቼኸል፡ ዪነከዩ ቃማችበሕ መቃጠርማ ዘገሕ ቢሳሎታች፣
                                    ፒሮግራማችዋ ፒሮጀክቲያች መሜሐር፣
                                </p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>
                                    ሚሻ ቶያችቤ፣ ቢሮቤ፣ ባድቤ ዛሉ ሀረሪያች ሙጋዳችቤ መትሐቀፍማ ዳይሐዋዚያ ዚኔሮት ዲላጋች
                                    ወለባይነትቤ መድለግማ አላይዞው መዳበል፣
                                </p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>
                                    ቢሳሎትቤ ዚትሬገዛ ኡጋቤ ሀረሪነቱ የትባዝሒዛል ቻላው መቃየስቤ ኢሾትዋል ሞኛ ፡፡
                                </p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>
                                    አዱኛ ቁራስ ዚቴ ሀረር ጁገሉው መቄረሕ የትፊርኪኩት ሉይ ቤጆት መስጠቤ ዚኩልሉ ቻላ ሐረካ ሞኛ
                                </p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>ባድ ዋ አለም ሑቁፍቤ ዛል ሀረሪ ዋ ሀረር ተቀጠሮቱው መጦኛ፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>ዚሀረሪ ዲያስፖራ ባድዞ ሀረርሌ አታጮት ያኝኩትሌ ዳንዲው የትሚቻቻል፣</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>ዚሀረሪ ዋ ዚአላይ ኡምመት ተቃጠሮት ዘጋሕቤ ዩነብሪኩት ዩኹናል</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="text-green-600 mt-2">•</span>
                                <p>
                                    ሀረሪያች ዩትረኸቦዛል ባድቤ ዚቴገላ ዊቃሮቱው ዚቅ ሞሻሌ የትፊርኪ ዲላጋ መሜሐር፣
                                </p>
                            </div>
                        </div>
                        <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
                            <p class="text-gray-700 text-lg">
                                መጅሊስሶ ዚመሜሐርቲ ታኽዋ መጅሊስ ሒርጊ ጋር አግቡራች ዛጥ ታኹው መቼኸል፣
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Back to Top Button -->
            <button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-green-600 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-green-700 transition-all duration-300 transform hover:scale-110 hidden z-50">
                ↑
            </button>
        </div>
    </div>

    <!-- JavaScript for Smooth Scrolling -->
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Back to Top button functionality
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

    <!-- Additional Styles -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #2e7d32;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1b5e20;
        }

        /* Highlight active section */
        section {
            scroll-margin-top: 120px;
        }
    </style>
</x-app-layout>
