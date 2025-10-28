<x-boilerplate>
    <x-navbar></x-navbar>
    <div class="px-[5%] py-[3%]">
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
                                <span class="text-gray-600">Vendor Profile</span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Vendor Header -->
                <div class="bg-white rounded-xl shadow-lg p-6 lg:p-8 mb-8 border border-gray-100">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                        <!-- Vendor Logo -->
                        <div class="flex-shrink-0">
                            @if ($vendor->logo)
                                <img src="{{ asset('storage/' . $vendor->logo) }}" alt="Vendor Logo"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-green-100">
                            @else
                                <div
                                    class="w-32 h-32 rounded-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center border-4 border-green-100">
                                    <span
                                        class="text-4xl font-bold text-green-700">{{ substr($vendor->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Vendor Info -->
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h1 class="text-3xl font-bold text-gray-900">
                                    {{ $vendor->business_name ?? $vendor->name }}</h1>
                                @if ($vendor->verification_status == 'verified')
                                    <span
                                        class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Verified Vendor
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-2 text-gray-600 mb-6">
                                @if ($vendor->location)
                                    <p class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                        </svg>
                                        {{ $vendor->location }}
                                    </p>
                                @endif
                                @if ($vendor->email)
                                    <p class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $vendor->email }}
                                    </p>
                                @endif
                                @if ($vendor->phone)
                                    <p class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        {{ $vendor->phone }}
                                    </p>
                                @endif
                            </div>

                            @if ($vendor->bio)
                                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                    <h3 class="font-semibold text-gray-900 mb-2">About</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $vendor->bio }}</p>
                                </div>
                            @endif

                            <div class="flex space-x-4">
                                @auth
                                    <a href="{{ route('inquiries.create', ['vendor_id' => $vendor->id]) }}"
                                        class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                        <i class="fas fa-envelope mr-2"></i>Send Inquiry
                                    </a>
                                    <form action="{{ route('chats.start', $vendor->slug) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="border-2 border-green-600 text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                                            <i class="fas fa-comments mr-2"></i>Start Chat
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Login to Contact
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Products by {{ $vendor->business_name ?? $vendor->name }}</h2>
                        <span class="text-gray-600">{{ $products->total() }} products</span>
                    </div>

                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($products as $product)
                                @php
                                    $images = is_string($product->images)
                                        ? json_decode($product->images, true)
                                        : $product->images;
                                    $images = is_array($images) ? $images : [];
                                    $firstImage = !empty($images) ? $images[0] : 'assets/placeholder.png';
                                @endphp
                                <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                    <div class="aspect-square overflow-hidden">
                                        <img src="{{ asset('storage/' . $firstImage) }}"
                                            alt="{{ $product->product_name }}"
                                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                            {{ $product->product_name }}</h3>
                                        <p class="text-sm text-gray-500 mb-2 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                            {{ $product->category->category }}
                                        </p>
                                        <p class="text-sm text-gray-500 mb-2 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                            </svg>
                                            {{ $product->location }}
                                        </p>
                                        <p class="text-lg font-bold text-green-600 mb-3">
                                            {{ $product->currency }}{{ number_format($product->price, 2) }}
                                        </p>
                                        <a href="{{ route('products.show', $product->slug) }}"
                                            class="block w-full bg-green-600 text-white text-center py-2 rounded-lg font-medium hover:bg-green-700 transition-colors">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-box text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">No Products Available</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                This vendor hasn't listed any products yet. Check back later or contact them directly.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</x-boilerplate>
