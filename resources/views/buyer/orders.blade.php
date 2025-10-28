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
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">My Orders</h1>
                            <p class="text-gray-600 mt-2">Track your orders and their current status</p>
                        </div>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="px-4">
                    @if($orders->count() > 0)
                        <div class="space-y-6">
                            @foreach($orders as $order)
                                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                    <div class="p-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $order->order_number }}</h3>
                                                <p class="text-sm text-gray-600">{{ $order->product->name }}</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="px-3 py-1 text-sm font-medium rounded-full
                                                    @if($order->status === 'delivered') bg-green-100 text-green-800
                                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-800
                                                    @elseif($order->status === 'processing') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'confirmed') bg-purple-100 text-purple-800
                                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                                <div class="text-sm text-gray-500 mt-1">{{ $order->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Order Details</h4>
                                                <div class="text-sm text-gray-600">
                                                    <p>Quantity: {{ $order->quantity }} {{ $order->unit }}</p>
                                                    <p>Unit Price: ₦{{ number_format($order->unit_price, 2) }}</p>
                                                    <p class="font-semibold">Total: ₦{{ number_format($order->total_amount, 2) }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Vendor</h4>
                                                <div class="flex items-center">
                                                    <img src="{{ asset('assets/silver.png') }}" alt="Vendor" class="w-6 h-6 rounded-full mr-2">
                                                    <span class="text-sm text-gray-600">{{ $order->vendor->name }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Shipping Address</h4>
                                                <p class="text-sm text-gray-600">{{ Str::limit($order->shipping_address, 50) }}</p>
                                            </div>
                                        </div>

                                        @if($order->tracking_number)
                                            <div class="mb-4">
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Tracking Information</h4>
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-600 mr-4">Tracking #: {{ $order->tracking_number }}</span>
                                                    @if($order->expected_delivery_date)
                                                        <span class="text-sm text-gray-500">Expected: {{ $order->expected_delivery_date }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        <div class="flex justify-between items-center">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('orders.show', $order->id) }}" 
                                                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                                    <i class="fas fa-eye mr-1"></i>View Details
                                                </a>
                                                @if($order->status === 'pending')
                                                    <button onclick="cancelOrder({{ $order->id }})" 
                                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                                        <i class="fas fa-times mr-1"></i>Cancel Order
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Payment: 
                                                <span class="font-medium
                                                    @if($order->payment_status === 'paid') text-green-600
                                                    @elseif($order->payment_status === 'failed') text-red-600
                                                    @else text-yellow-600 @endif">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-shopping-cart text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">No Orders Yet</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                You haven't placed any orders yet. Start by exploring products and creating orders from quotes.
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
function cancelOrder(orderId) {
    if (confirm('Are you sure you want to cancel this order? This action cannot be undone.')) {
        fetch(`/dashboard/orders/${orderId}/cancel`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
</script>
