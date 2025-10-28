<x-boilerplate>
    <x-navbar></x-navbar>
    <!-- Hero section -->
    <div class="py-[1%] mt-[5%]">
        <div style="background-image: url('{{ asset('assets/bgimg.png') }}');"
            class="min-h-screen bg-cover bg-center bg-no-repeat">
            <div class="w-full h-full px-[5%] py-[3%] flex items-center min-h-screen">
                <div class="text-white flex flex-col">
                    <h1 data-aos="zoom-in-up" class="md:text-[4.2rem] text-[3rem] leading-[1] font-semibold mb-2">
                        Connecting African products to the world hub
                    </h1>
                    <p class="text-[1rem] mb-8">
                        Trade fresh farm produce, natural resources, and services directly from verified vendors.
                    </p>
                    <!-- Buttons Container -->
                    <div class="flex md:flex-row flex-col gap-4">
                        <!-- Browse Product Button -->
                        <a href="{{ route('app.products') }}"
                            class="bg-green-700 hover:bg-green-600 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-center">
                            Browse Product
                        </a>
                        <!-- Become a Vendor Button -->
                        <a href="{{ route('user.create') }}"
                            class="bg-white hover:bg-gray-200 hover:text-gray-900 text-gray-800 font-medium py-3 px-8 rounded-lg border-2 border-white transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 text-center">
                            Become a Vendor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category -->
    <div class="px-[5%] py-[3%] flex flex-col justify-center" data-aos="zoom-in">
        <div>
            <h1 class="text-2xl font-bold mb-6 ml-6">Featured Product</h1>
        </div>
        <div class="text-[#121714] font-[500] text-[1rem] grid lg:grid-cols-4 md:grid-cols-2 gap-4">
            <div class="rounded p-4 transition-transform duration-300 hover:scale-105">
                <a href="{{ route('app.products') }}" class="decoration-none">
                    <img src="{{ asset('assets/tomatoes_man.jpg') }}" alt="Farm Product" class="rounded">
                    <p>Farm Products</p>
                </a>
            </div>

            <div class="rounded p-4 transition-transform duration-300 hover:scale-105">
                <a href="{{ route('buyer.natural-resources') }}" class="decoration-none">
                    <img src="{{ asset('assets/mineral.jpg') }}" alt="Natural Resources" class="rounded">
                    <p>Natural Resources</p>
                </a>
            </div>

            <div class="rounded p-4 transition-transform duration-300 hover:scale-105">
                <a href="{{ route('app.products') }}" class="decoration-none">
                    <img src="{{ asset('assets/harvester.jpg') }}" alt="Farm Machinery and tools" class="rounded">
                    <p>Farm Machinery and tools</p>
                </a>
            </div>

            <div class="rounded p-4 transition-transform duration-300 hover:scale-105">
                <a href="{{ route('app.services') }}" class="decoration-none">
                    <img src="{{ asset('assets/market_seller.jpg') }}" alt="Our Services" class="rounded">
                    <p>Services</p>
                </a>
            </div>
        </div>
    </div>


    <!-- Why choose us -->
    <div class="grid md:grid-cols-2 gap-8 px-[5%] py-[3%]">
        <div data-aos="fade-down-right">
            <img src="{{ asset('assets/man_and_woman.jpg') }}" alt="Why Choose Us">
        </div>

        <div class="px-[5%] py-[3%] text-[#121714]" data-aos="fade-rght">
            <h2 class="text-2xl font-bold mb-6">Why Choose Us</h2>

            <div class="space-y-8">
                <!-- Verified Vendors -->
                <div class="flex items-start space-x-3" data-aos="fade-up" data-aos-duration="2000">
                    <span class="text-green-500 text-xl">
                        <img src="{{ asset('assets/checkIcon.png') }}" alt="Verified Vendors" class="h-5 w-5 mt-2">
                    </span>
                    <div>
                        <h3 class="font-semibold">Verified Vendors</h3>
                        <p class="text-gray-600 text-sm">
                            All vendors are thoroughly vetted to ensure quality and reliability.
                        </p>
                    </div>
                </div>

                <!-- Direct Buyer-to-sell Chat -->
                <div class="flex items-start space-x-3" data-aos="fade-up" data-aos-duration="4000">
                    <span class="text-green-500 text-xl">
                        <img src="{{ asset('assets/mssIcon.png') }}" alt="Buyer-to-sell Chat" class="h-5 w-5 mt-2">
                    </span>
                    <div>
                        <h3 class="font-semibold">Direct Buyer-to-sell Chat</h3>
                        <p class="text-gray-600 text-sm">
                            Communicate directly with vendors for personalized service and negotiations.
                        </p>
                    </div>
                </div>

                <!-- Transparent Pricing / Request Quote -->
                <div class="flex items-start space-x-3" data-aos="fade-up" data-aos-duration="6000">
                    <span class="text-green-500 text-xl">
                        <img src="{{ asset('assets/dolaIcon.png') }}" alt="Transparent Pricing" class="h-5 w-5 mt-2">
                    </span>
                    <div>
                        <h3 class="font-semibold">Transparent Pricing / Request Quote</h3>
                        <p class="text-gray-600 text-sm">
                            Get clear pricing or request custom quotes for your specific needs.
                        </p>
                    </div>
                </div>

                <!-- Export-Ready Standards -->
                <div data-aos="fade-up" data-aos-duration="8000" class="flex items-start space-x-3">
                    <span class="text-green-500 text-xl">
                        <img src="{{ asset('assets/vaIcon.png') }}" alt="" class="h-5 w-5 mt-2">
                    </span>
                    <div>
                        <h3 class="font-semibold">Export-Ready Standards</h3>
                        <p class="text-gray-600 text-sm">
                            Products meet international export standards for seamless transactions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature product -->
    <div class="px-[5%] py-[3%] flex flex-col justify-center">
        <div>
            <h1 class="text-2xl font-bold mb-8 ml-4">Featured Product</h1>
        </div>
        <div
            class="text-[#121714] justify-center font-[500] text-[1rem] grid lg:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-8">
            <!-- product card -->
            <div class="max-w-xs rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300">
                <!-- product image -->
                <img src="{{ asset('assets/yam.jpg') }}" alt="Benue yam"
                    class="w-full h-40 object-cover">
                <div class="p-4 flex flex-col gap-2">
                    <!-- product name and description -->
                    <h3 class="font-semibold text-gray-800">Benue Yam</h3>
                    <p class="text-sm text-gray-500">Benue, Nigeria</p>
                </div>
            </div>

            <!-- product card -->
            <div class="max-w-xs rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300">
                <!-- product image -->
                <img src="{{ asset('assets/plantain.jpg') }}" alt="Enugu plantain"
                    class="w-full h-40 object-cover">
                <div class="p-4 flex flex-col gap-2">
                    <!-- product name and description -->
                    <h3 class="font-semibold text-gray-800">Plantain</h3>
                    <p class="text-sm text-gray-500">Enugu, Nigeria</p>
                </div>
            </div>

            <!-- product card -->
            <div class="max-w-xs rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300">
                <!-- product image -->
                <img src="{{ asset('assets/groundnuts.jpg') }}" alt="kogi groundnuts"
                    class="w-full h-40 object-cover">
                <div class="p-4 flex flex-col gap-2">
                    <!-- product name and description -->
                    <h3 class="font-semibold text-gray-800">Groundnuts</h3>
                    <p class="text-sm text-gray-500">Kogi, Nigeria</p>
                </div>
            </div>

            <!-- product card -->
            <div class="max-w-xs rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300">
                <!-- product image -->
                <img src="{{ asset('assets/garri2.jpg') }}" alt="garri"
                    class="w-full h-40 object-cover">
                <div class="p-4 flex flex-col gap-2">
                    <!-- product name and description -->
                    <h3 class="font-semibold text-gray-800">Garri</h3>
                    <p class="text-sm text-gray-500">Delta</p>
                </div>
            </div>

        </div>
    </div>


    <!-- Join Us Section -->
    <div class="px-[5%] py-[3%]">
        <div style="background-image: url('{{ asset('assets/bg.png') }}');"
            class="h-72 w-full bg-cover bg-no-repeat bg-center rounded-lg my-[3%]">
            <!-- Overlay with content -->
            <div class="h-full w-full flex items-center rounded-lg px-8"
                style="background-color: rgba(0, 0, 0, 0.3);">
                <div class="ml-auto max-w-lg text-right">
                    <h2 data-aos="flip-left"
                        class="text-white md:pl-8 text-2xl md:text-3xl font-[700] md:leading-[1.5] leading-[1.5]">
                        <span class="text-orange-500">Join</span> TradeSource360 today <br />
                        and connect with buyers and suppliers worldwide.
                    </h2>
                    <div class="flex justify-end">
                        <a href="{{ route('products.create') }}"
                            class="mt-4 px-6 py-2 font-[600] bg-green-700 text-white rounded-full hover:bg-green-800 transition-colors duration-300 flex items-center gap-2 w-fit">
                            List Your Product
                            <span>→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</x-boilerplate>
