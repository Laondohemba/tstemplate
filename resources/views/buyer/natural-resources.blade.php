<x-boilerplate>
    <x-buyersidebar></x-buyersidebar>

    <!-- Main Content -->
    <div class="lg:ml-60">
        <x-buyernavbar></x-buyernavbar>

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Natural Resources</h1>
                            <p class="text-gray-600 mt-2">Discover mineral resources and natural products from verified suppliers</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('buyer.explore-products') }}" 
                               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>All Products
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search resources..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" value="{{ request('location') }}" 
                                   placeholder="Enter location..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" 
                                    class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-search mr-2"></i>Filter
                            </button>
                        </div>
                        <div class="flex items-end">
                            <a href="{{ route('buyer.natural-resources') }}" 
                               class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors text-center">
                                <i class="fas fa-times mr-2"></i>Clear
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Products Grid -->
                <div class="px-4">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                    <!-- Product Image -->
                                    <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                        @if($product->images && count($product->images) > 0)
                                            <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                                 alt="{{ $product->product_name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-gem text-blue-600 text-6xl"></i>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="p-4">
                                        <h4 class="font-semibold text-gray-900 mb-2">{{ $product->product_name }}</h4>
                                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($product->description, 80) }}</p>
                                        
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-lg font-bold text-green-600">₦{{ number_format($product->price, 2) }}/{{ $product->unit }}</span>
                                            <span class="text-sm text-gray-500">{{ $product->location }}</span>
                                        </div>

                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center">
                                                <img src="{{ asset('assets/silver.png') }}" alt="Supplier" class="w-6 h-6 rounded-full mr-2">
                                                <span class="text-sm text-gray-600">{{ $product->user->name }}</span>
                                            </div>
                                            @if($product->user->verification_status === 'verified')
                                                <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">
                                                    <i class="fas fa-check-circle mr-1"></i>Verified
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.show', $product->slug) }}" 
                                               class="flex-1 px-3 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors text-center">
                                                <i class="fas fa-eye mr-1"></i>View Details
                                            </a>
                                            <button onclick="saveProduct({{ $product->id }})" 
                                                    class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                                <i class="fas fa-bookmark"></i>
                                            </button>
                                            <button onclick="contactSupplier({{ $product->user->id }}, {{ $product->id }})" 
                                                    class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        </div>
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
                                <i class="fas fa-gem text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">No Natural Resources Found</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                We're working on adding more mineral resources and natural products. 
                                Check back soon or explore our other product categories.
                            </p>
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('buyer.explore-products') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                    <i class="fas fa-search mr-2"></i>Explore All Products
                                </a>
                                <a href="{{ route('buyer.dashboard') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg font-medium hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-home mr-2"></i>Back to Dashboard
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>

<script>
function saveProduct(productId) {
    fetch(`/dashboard/buyer/save-product/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const button = event.target.closest('button');
            button.innerHTML = '<i class="fas fa-check text-green-600"></i>';
            button.classList.add('bg-green-100');
            
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-bookmark"></i>';
                button.classList.remove('bg-green-100');
            }, 2000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function contactSupplier(vendorId, productId) {
    window.location.href = `{{ route('inquiries.create') }}?vendor_id=${vendorId}&product_id=${productId}`;
}
</script>
