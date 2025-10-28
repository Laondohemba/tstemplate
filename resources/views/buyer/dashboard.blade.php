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
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Buyer Dashboard</h1>
                    <p class="text-gray-600 mt-2">Welcome back! Explore products and manage your inquiries.</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 px-4">
                    <!-- Total Products -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100">
                                <i class="fas fa-box text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Available Products</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalProducts ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- My Inquiries -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100">
                                <i class="fas fa-envelope text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">My Inquiries</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $myInquiries ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quotes Received -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100">
                                <i class="fas fa-file-alt text-yellow-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Quotes Received</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $quotesReceived ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Saved Products -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100">
                                <i class="fas fa-bookmark text-purple-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Saved Products</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $savedProducts ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8 px-4">
                    <!-- Explore Products -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Explore Products</h3>
                        <p class="text-gray-600 mb-4">Discover agricultural products and natural resources from verified vendors.</p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('app.products') }}" 
                               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-search mr-2"></i>Browse All Products
                            </a>
                            <a href="{{ route('buyer.natural-resources') }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-gem mr-2"></i>Natural Resources
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                        <div class="space-y-3">
                            @if(isset($recentInquiries) && $recentInquiries->count() > 0)
                                @foreach($recentInquiries->take(3) as $inquiry)
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="p-2 rounded-full bg-blue-100">
                                            <i class="fas fa-envelope text-blue-600 text-sm"></i>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <p class="text-sm font-medium text-gray-900">{{ Str::limit($inquiry->subject, 30) }}</p>
                                            <p class="text-xs text-gray-500">{{ $inquiry->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            @if($inquiry->status === 'responded') bg-green-100 text-green-800
                                            @elseif($inquiry->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($inquiry->status) }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-inbox text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-gray-500 text-sm">No recent activity</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Featured Products -->
                <div class="px-4">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Featured Products</h3>
                        <a href="{{ route('app.products') }}" 
                           class="text-green-600 hover:text-green-700 font-medium">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($featuredProducts->take(6) as $product)
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

                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.show', $product->slug) }}" 
                                               class="flex-1 px-3 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors text-center">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </a>
                                            <button onclick="saveProduct({{ $product->id }})" 
                                                    class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                                <i class="fas fa-bookmark"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-seedling text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Featured Products</h3>
                            <p class="text-gray-600 mb-6">Check back later for featured agricultural products.</p>
                            <a href="{{ route('app.products') }}" 
                               class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                <i class="fas fa-search mr-2"></i>Explore Products
                            </a>
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
            // Show success message
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
</script>
