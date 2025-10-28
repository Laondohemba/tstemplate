<x-boilerplate>
    <div class="lg:ml-64">
        @if (auth()->user()->role === 'buyer')
            <x-buyersidebar></x-buyersidebar>
            <x-buyernavbar></x-buyernavbar>
        @elseif(auth()->user()->role === 'vendor')
            <x-vendorsidebar></x-vendorsidebar>
            <x-vendornavbar></x-vendornavbar>
        @else
            {{ auth()->user()->role }}
        @endif

        <div class="min-h-screen bg-gray-50">
            <!-- Breadcrumb -->
            <div class="bg-white border-b">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-3 text-sm">
                            <li>
                                <a href="{{ route('app.products') }}"
                                    class="text-green-600 hover:text-green-700 font-medium">Products</a>
                            </li>
                            <li>
                                <span class="text-gray-400">/</span>
                            </li>
                            <li>
                                <span class="text-gray-600">{{ $product->category->category }}</span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

                <!-- Product Images and Info Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-8">
                    <!-- Left Column: Images -->
                    <div class="space-y-4">
                        @php
                            $images = is_string($product->images)
                                ? json_decode($product->images, true)
                                : $product->images;
                            $images = is_array($images) ? $images : [];
                        @endphp

                        <!-- Main Image -->
                        <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden aspect-square">
                            <img id="mainImage"
                                src="{{ !empty($images) ? asset('storage/' . $images[0]) : asset('assets/placeholder.png') }}"
                                alt="{{ $product->product_name }}" class="w-full h-full object-cover">

                            <!-- Badges Overlay -->
                            <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                @if ($product->sales_niche == 'organic')
                                    <span
                                        class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">Organic</span>
                                @endif
                                @if ($product->status == 'featured')
                                    <span
                                        class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">Featured</span>
                                @endif
                            </div>
                        </div>

                        <!-- Thumbnail Images -->
                        @if (count($images) > 1)
                            <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                                @foreach ($images as $index => $image)
                                    <button type="button"
                                        onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)"
                                        class="thumbnail-btn relative rounded-lg overflow-hidden aspect-square border-2 transition-all duration-200 {{ $index === 0 ? 'border-green-600 ring-2 ring-green-200' : 'border-gray-200 hover:border-green-400' }}">
                                        <img src="{{ asset('storage/' . $image) }}"
                                            alt="{{ $product->product_name }} {{ $index + 1 }}"
                                            class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Right Column: Product Info -->
                    <div class="space-y-6">
                        <!-- Product Title & Meta -->
                        <div>
                            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-3">{{ $product->product_name }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-600 mb-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    {{ $product->category->category }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $product->location }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    {{ ucwords($product->sales_type) }}
                                </span>
                            </div>

                            <!-- Price -->
                            <div
                                class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-5 border border-green-200">
                                <p class="text-sm text-gray-600 mb-1">Price per unit</p>
                                <p class="text-4xl font-bold text-green-700">
                                    {{ $product->currency }}{{ number_format($product->price, 2) }}</p>
                                <p class="text-sm text-gray-600 mt-2">Available: <span
                                        class="font-semibold text-gray-900">{{ number_format($product->quantity_available, 0) }}
                                        units</span></p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('inquiries.create', ['product_id' => $product->id, 'vendor_id' => $product->user->id]) }}"
                                class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-200">
                                Request Quote
                            </a>

                            <!-- Chat with Vendor Form -->
                            <form action="{{ route('chats.start', $product->user->slug) }}" method="POST"
                                class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full border-2 border-green-600 text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                                    Chat with Vendor
                                </button>
                            </form>
                        </div>


                        <!-- Description -->
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Product Description</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <!-- Quick Specs -->
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Specifications</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Sales Type</p>
                                    <p class="font-semibold text-gray-900">{{ ucwords($product->sales_type) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Type</p>
                                    <p class="font-semibold text-gray-900">{{ ucfirst($product->sales_niche) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Shipping</p>
                                    <p class="font-semibold text-gray-900">{{ ucwords($product->shipping) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Location</p>
                                    <p class="font-semibold text-gray-900">{{ $product->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vendor Information Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 lg:p-8 mb-8 border border-gray-100">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                        <!-- Vendor Logo -->
                        <div class="flex-shrink-0">
                            @if ($product->user->logo)
                                <img src="{{ asset('storage/' . $product->user->logo) }}" alt="Vendor Logo"
                                    class="w-24 h-24 rounded-full object-cover border-4 border-green-100">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center border-4 border-green-100">
                                    <span
                                        class="text-3xl font-bold text-green-700">{{ substr($product->user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Vendor Info -->
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-2xl font-bold text-gray-900">
                                    {{ $product->user->business_name ?? $product->user->name }}</h3>
                                @if ($product->user->verification_status == 'verified')
                                    <span
                                        class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-semibold flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Verified
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-1 text-sm text-gray-600 mb-4">
                                @if ($product->user->location)
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                        </svg>
                                        {{ $product->user->location }}
                                    </p>
                                @endif
                                @if ($product->user->email)
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $product->user->email }}
                                    </p>
                                @endif
                                @if ($product->user->phone)
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        {{ $product->user->phone }}
                                    </p>
                                @endif
                            </div>

                            <a href="{{ route('vendor.profile', $product->user->slug) }}"
                                class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors">
                                View Vendor Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Detailed Specifications Tabs -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 border border-gray-100">
                    <div class="border-b border-gray-200">
                        <nav class="flex overflow-x-auto">
                            <button onclick="showTab('specs')" id="specs-tab"
                                class="tab-button flex-shrink-0 px-6 py-4 text-sm font-semibold border-b-2 border-green-600 text-green-600 transition-colors">
                                Full Specifications
                            </button>
                            <button onclick="showTab('shipping')" id="shipping-tab"
                                class="tab-button flex-shrink-0 px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                Shipping & Details
                            </button>
                        </nav>
                    </div>

                    <div class="p-6 lg:p-8">
                        <!-- Specifications Tab Content -->
                        <div id="specs-content" class="tab-content">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Category</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ $product->category->category }}</span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Sales Type</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ ucwords($product->sales_type) }}</span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Sales Niche</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ ucfirst($product->sales_niche) }}</span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Price</span>
                                    <span
                                        class="font-semibold text-green-600">{{ $product->currency }}{{ number_format($product->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Quantity Available</span>
                                    <span
                                        class="font-semibold text-gray-900">{{ number_format($product->quantity_available, 2) }}</span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Location</span>
                                    <span class="font-semibold text-gray-900">{{ $product->location }}</span>
                                </div>
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 font-medium">Shipping</span>
                                    <span class="font-semibold text-gray-900">{{ ucwords($product->shipping) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Tab Content -->
                        <div id="shipping-content" class="tab-content hidden space-y-6">
                            <div>
                                <h4 class="font-bold text-gray-900 mb-3 text-lg">Shipping Information</h4>
                                <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                    <p class="text-gray-700">
                                        <span class="font-semibold">Shipping Type:</span>
                                        {{ ucwords($product->shipping) }}
                                    </p>
                                    <p class="text-gray-700">
                                        <span class="font-semibold">Origin Location:</span> {{ $product->location }}
                                    </p>
                                </div>
                            </div>

                            @if ($product->specifications)
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-3 text-lg">Additional Specifications</h4>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-gray-700 leading-relaxed">{{ $product->specifications }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($product->video_link)
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-3 text-lg">Product Video</h4>
                                    <a href="{{ $product->video_link }}" target="_blank"
                                        class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Watch Product Video
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Related Products -->
                @if ($relatedProducts->count() > 0)
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
                            @foreach ($relatedProducts as $related)
                                @php
                                    $relatedImages = is_string($related->images)
                                        ? json_decode($related->images, true)
                                        : $related->images;
                                    $relatedFirstImage =
                                        is_array($relatedImages) && !empty($relatedImages)
                                            ? $relatedImages[0]
                                            : 'assets/placeholder.png';
                                @endphp
                                <a href="{{ route('product.show', $related->slug) }}"
                                    class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                    <div class="aspect-square overflow-hidden">
                                        <img src="{{ asset('storage/' . $relatedFirstImage) }}"
                                            alt="{{ $related->product_name }}"
                                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                            {{ $related->product_name }}</h4>
                                        <p class="text-sm text-gray-500 mb-2 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                            </svg>
                                            {{ $related->location }}
                                        </p>
                                        <p class="text-lg font-bold text-green-600">
                                            {{ $related->currency }}{{ number_format($related->price, 2) }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function changeMainImage(src, element) {
            document.getElementById('mainImage').src = src;

            // Remove active state from all thumbnails
            document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                btn.classList.remove('border-green-600', 'ring-2', 'ring-green-200');
                btn.classList.add('border-gray-200');
            });

            // Add active state to clicked thumbnail
            element.classList.remove('border-gray-200');
            element.classList.add('border-green-600', 'ring-2', 'ring-green-200');
        }

        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-green-600', 'text-green-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(tabName + '-content').classList.remove('hidden');

            // Add active class to selected tab
            const activeTab = document.getElementById(tabName + '-tab');
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            activeTab.classList.add('border-green-600', 'text-green-600');
        }
    </script>
</x-boilerplate>
