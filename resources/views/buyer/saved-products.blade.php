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
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Saved Products</h1>
                            <p class="text-gray-600 mt-2">Your bookmarked products for easy access</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('buyer.explore-products') }}" 
                               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Explore More Products
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Saved Products Grid -->
                <div class="px-4">
                    @if($savedProducts->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($savedProducts as $savedProduct)
                                @php $product = $savedProduct->product; @endphp
                                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                    <!-- Product Image -->
                                    <div class="h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                        @if($product->images && count($product->images) > 0)
                                            <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                                 alt="{{ $product->product_name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-seedling text-green-600 text-6xl"></i>
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

                                        <div class="text-xs text-gray-500 mb-3">
                                            Saved on {{ $savedProduct->created_at->format('M d, Y') }}
                                        </div>

                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.show', $product->slug) }}" 
                                               class="flex-1 px-3 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors text-center">
                                                <i class="fas fa-eye mr-1"></i>View Details
                                            </a>
                                            <button onclick="unsaveProduct({{ $product->id }})" 
                                                    class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
                                                <i class="fas fa-trash"></i>
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
                            {{ $savedProducts->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-bookmark text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">No Saved Products</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                You haven't saved any products yet. Start exploring and bookmark products you're interested in.
                            </p>
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('buyer.explore-products') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                    <i class="fas fa-search mr-2"></i>Explore Products
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
function unsaveProduct(productId) {
    if (confirm('Are you sure you want to remove this product from your saved list?')) {
        fetch(`/dashboard/buyer/unsave-product/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the product card from the page
                const productCard = event.target.closest('.bg-white');
                productCard.style.transition = 'opacity 0.3s ease';
                productCard.style.opacity = '0';
                setTimeout(() => {
                    productCard.remove();
                }, 300);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

function contactSupplier(vendorId, productId) {
    window.location.href = `{{ route('inquiries.create') }}?vendor_id=${vendorId}&product_id=${productId}`;
}
</script>
