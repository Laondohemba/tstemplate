<x-boilerplate>
    <x-navbar></x-navbar>
    
    <!-- background-image -->
    <div class="py-[1%]">
        <div style="background-image: url('{{asset('assets/Breadcrumbs.png')}}');"
            class="h-40 flex bg-cover md:bg-contain bg-no-repeat bg-center my-[3%]">
            <div class="flex gap-3 px-[20%] items-center justify-center">
                <img src="{{asset('assets/home.png')}}" alt="products icon" class="w-5 h-5">
                <span class="text-gray-400">></span>
                <h3 class="text-green-700 text-[l.5rem] font-[400] text-center ">Products</h3>
            </div>
        </div>
    </div>

    <!-- Product Listening -->
    <div class="pb-[3%] flex flex-col justify-center">
        <div class="max-w-6xl mx-auto">
            <!-- Main Filter Container -->
            <div class="bg-white px-[5%] w-full p-4 rounded">
                <!-- Top Row - Dropdowns and Filter Chips -->
                <div class="flex flex-wrap flex-col md:flex-row gap-4 mb-6">
                    <!-- Category Dropdown -->
                    <div class="flex gap-4">
                        <div class="relative">
                            <button id="categoryBtn"
                                class="flex items-center justify-between w-40 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <span id="categoryText">
                                    @if(request('category'))
                                        {{ $categories->firstWhere('slug', request('category'))->category ?? 'Category' }}
                                    @else
                                        Category
                                    @endif
                                </span>
                                <svg class="w-4 h-4 ml-2 transition-transform duration-200" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="categoryDropdown"
                                class="absolute top-full left-0 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
                                <div class="py-1 flex flex-col gap-1 text-gray-700 text-left">
                                    <a href="{{ route('app.products') }}" 
                                       class="w-full px-4 py-2 hover:bg-gray-50 cursor-pointer decoration-none">
                                        All Categories
                                    </a>
                                    @foreach($categories as $category)
                                        <a href="{{ route('app.products', array_merge(request()->except('category'), ['category' => $category->slug])) }}" 
                                           class="w-full px-4 py-2 hover:bg-gray-50 cursor-pointer decoration-none">
                                            {{ $category->category }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Sales Type Dropdown -->
                        <div class="relative">
                            <button id="salesTypeBtn"
                                class="flex items-center justify-between w-40 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <span id="salesTypeText">
                                    @if(request('sales_type'))
                                        {{ ucfirst(request('sales_type')) }}
                                    @else
                                        Sales Type
                                    @endif
                                </span>
                                <svg class="w-4 h-4 ml-2 transition-transform duration-200" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="salesTypeDropdown"
                                class="absolute top-full left-0 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
                                <div class="py-1 flex flex-col gap-1 text-gray-700 text-left">
                                    <a href="{{ route('app.products', request()->except('sales_type')) }}" 
                                       class="w-full cursor-pointer px-4 py-2 hover:bg-gray-50">
                                        All Types
                                    </a>
                                    <a href="{{ route('app.products', array_merge(request()->except('sales_type'), ['sales_type' => 'retail'])) }}" 
                                       class="w-full cursor-pointer px-4 py-2 hover:bg-gray-50">
                                        Retail
                                    </a>
                                    <a href="{{ route('app.products', array_merge(request()->except('sales_type'), ['sales_type' => 'wholesale'])) }}" 
                                       class="w-full cursor-pointer px-4 py-2 hover:bg-gray-50">
                                        Wholesale
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Dropdown -->
                    <div class="relative">
                        <button id="locationBtn"
                            class="flex items-center justify-between w-40 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <span id="locationText">
                                @if(request('location'))
                                    {{ request('location') }}
                                @else
                                    Location
                                @endif
                            </span>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div id="locationDropdown"
                            class="absolute top-full left-0 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
                            <div class="py-1 flex flex-col gap-1 text-left text-gray-700">
                                <a href="{{ route('app.products', request()->except('location')) }}" 
                                   class="w-full cursor-pointer decoration-none px-4 py-2 hover:bg-gray-50">
                                    All Locations
                                </a>
                                @foreach($locations as $location)
                                    <a href="{{ route('app.products', array_merge(request()->except('location'), ['location' => $location])) }}" 
                                       class="w-full cursor-pointer decoration-none px-4 py-2 hover:bg-gray-50">
                                        {{ $location }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Filter Chips -->
                    <div class="flex gap-2 md:ml-auto">
                        <a href="{{ route('app.products', request()->except('sales_niche')) }}" 
                           class="px-4 py-2 {{ !request('sales_niche') ? 'bg-green-100 border-green-300 text-green-700' : 'bg-white border-gray-300 text-gray-700' }} border shadow-lg rounded-full text-sm hover:bg-green-200 transition-colors duration-200">
                            All Products
                        </a>
                        <a href="{{ route('app.products', array_merge(request()->except('sales_niche'), ['sales_niche' => 'organic'])) }}" 
                           class="px-4 py-2 {{ request('sales_niche') == 'organic' ? 'bg-green-100 border-green-300 text-green-700' : 'bg-white border-gray-300 text-gray-700' }} border shadow-lg rounded-full text-sm hover:bg-green-200 transition-colors duration-200">
                            Organic
                        </a>
                        <a href="{{ route('app.products', array_merge(request()->except('sales_niche'), ['sales_niche' => 'inorganic'])) }}" 
                           class="px-4 py-2 {{ request('sales_niche') == 'inorganic' ? 'bg-green-100 border-green-300 text-green-700' : 'bg-white border-gray-300 text-gray-700' }} border shadow-lg rounded-full text-sm hover:bg-green-200 transition-colors duration-200">
                            Non-Organic
                        </a>
                    </div>
                </div>

                <!-- Bottom Row - Sorting Options -->
                <div class="border-b border-gray-200 overflow-x-auto overflow-y-hidden">
                    <nav class="-mb-px flex min-w-max">
                        <a href="{{ route('app.products', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}"
                            class="px-4 hover:border-b-[3px] {{ request('sort', 'newest') == 'newest' ? 'border-b-[3px] text-green-700' : '' }} border-gray-300 py-2 text-sm font-medium text-gray-900 transition-colors duration-200">
                            Newest
                        </a>
                        <a href="{{ route('app.products', array_merge(request()->except('sort'), ['sort' => 'price_low_high'])) }}"
                            class="px-4 hover:border-b-[3px] {{ request('sort') == 'price_low_high' ? 'border-b-[3px] text-green-700' : '' }} border-gray-300 py-2 text-sm font-medium text-gray-900 transition-colors duration-200">
                            Price: Low to High
                        </a>
                        <a href="{{ route('app.products', array_merge(request()->except('sort'), ['sort' => 'price_high_low'])) }}"
                            class="px-4 hover:border-b-[3px] {{ request('sort') == 'price_high_low' ? 'border-b-[3px] text-green-700' : '' }} border-gray-300 py-2 text-sm font-medium text-gray-900 transition-colors duration-200">
                            Price: High to Low
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Product Catalog Area -->
            <div class="mt-8">
                <div id="activeFilters" class="px-[5%] py-[3%] flex flex-col justify-center">
                    @if($products->count() > 0)
                        <div class="text-[#121714] justify-center font-[500] text-[1rem] grid lg:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-10">
                            @foreach($products as $product)
                                <a href="{{ route('products.show', $product->slug) }}" class="cursor-pointer">
                                    <div class="max-w-xs rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                        @php
                                            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                                            $firstImage = is_array($images) && !empty($images) ? $images[0] : 'assets/placeholder.png';
                                        @endphp
                                        <img src="{{ asset('storage/' . $firstImage) }}" 
                                             alt="{{ $product->product_name }}" 
                                             class="w-full h-40 object-cover">
                                        <div class="p-4 flex flex-col gap-2">
                                            <h4 class="font-semibold text-gray-800">{{ Str::limit($product->product_name, 30) }}</h4>
                                            <p class="text-sm font-[400] text-[#59964F]">{{ $product->location }}</p>
                                            <div class="flex justify-between items-center mt-2">
                                                <span class="text-lg font-[500] text-gray-900">
                                                    {{ $product->currency }}{{ number_format($product->price, 2) }}
                                                </span>
                                                @if($product->sales_niche == 'organic')
                                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                                        Organic
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">No products found matching your filters.</p>
                            <a href="{{ route('app.products') }}" class="mt-4 inline-block text-green-600 hover:text-green-700">
                                Clear all filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>

    <script>
        // Dropdown toggles
        document.getElementById('categoryBtn').addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('categoryDropdown').classList.toggle('hidden');
            document.getElementById('salesTypeDropdown').classList.add('hidden');
            document.getElementById('locationDropdown').classList.add('hidden');
        });

        document.getElementById('salesTypeBtn').addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('salesTypeDropdown').classList.toggle('hidden');
            document.getElementById('categoryDropdown').classList.add('hidden');
            document.getElementById('locationDropdown').classList.add('hidden');
        });

        document.getElementById('locationBtn').addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('locationDropdown').classList.toggle('hidden');
            document.getElementById('categoryDropdown').classList.add('hidden');
            document.getElementById('salesTypeDropdown').classList.add('hidden');
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            document.getElementById('categoryDropdown').classList.add('hidden');
            document.getElementById('salesTypeDropdown').classList.add('hidden');
            document.getElementById('locationDropdown').classList.add('hidden');
        });
    </script>
</x-boilerplate>