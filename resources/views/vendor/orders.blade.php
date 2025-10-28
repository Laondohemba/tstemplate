<x-boilerplate>
    <x-vendorsidebar></x-vendorsidebar>

    <!-- Main Content -->
    <div class="lg:ml-60">
        <x-vendornavbar></x-vendornavbar>

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Vendor Orders</h1>
                            <p class="text-gray-600 mt-2">Manage orders from your customers</p>
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
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $order->order_number ?? 'Order #' . $order->id }}</h3>
                                                <p class="text-sm text-gray-600">{{ $order->product->product_name ?? 'Service Order' }}</p>
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
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Customer</h4>
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                                                        <span class="text-sm font-medium text-gray-600">
                                                            {{ substr($order->buyer->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $order->buyer->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $order->buyer->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Order Details</h4>
                                                <div class="text-sm text-gray-600">
                                                    @if($order->product)
                                                        <p>Product: {{ $order->product->product_name }}</p>
                                                        <p>Quantity: {{ $order->quantity ?? 'N/A' }}</p>
                                                    @else
                                                        <p>Service Order</p>
                                                    @endif
                                                    <p class="font-semibold">Total: ₦{{ number_format($order->total_amount, 2) }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Payment Status</h4>
                                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                                    @if($order->payment_status === 'paid') bg-green-100 text-green-800
                                                    @elseif($order->payment_status === 'failed') bg-red-100 text-red-800
                                                    @else bg-yellow-100 text-yellow-800 @endif">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
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
                                                    <button onclick="updateOrderStatus({{ $order->id }}, 'confirmed')" 
                                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                                        <i class="fas fa-check mr-1"></i>Confirm Order
                                                    </button>
                                                @elseif($order->status === 'confirmed')
                                                    <button onclick="updateOrderStatus({{ $order->id }}, 'processing')" 
                                                            class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                                                        <i class="fas fa-cog mr-1"></i>Start Processing
                                                    </button>
                                                @elseif($order->status === 'processing')
                                                    <button onclick="updateOrderStatus({{ $order->id }}, 'shipped')" 
                                                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                                        <i class="fas fa-truck mr-1"></i>Mark as Shipped
                                                    </button>
                                                @elseif($order->status === 'shipped')
                                                    <button onclick="updateOrderStatus({{ $order->id }}, 'delivered')" 
                                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                                        <i class="fas fa-check-circle mr-1"></i>Mark as Delivered
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Order ID: {{ $order->id }}
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
                                You haven't received any orders yet. Once customers start ordering your products, they'll appear here.
                            </p>
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('products.create') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Add Products
                                </a>
                                <a href="{{ route('user.dashboard') }}" 
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
function updateOrderStatus(orderId, status) {
    if (confirm(`Are you sure you want to update this order status to ${status}?`)) {
        fetch(`/dashboard/vendor/orders/${orderId}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Failed to update order status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the order status');
        });
    }
}
</script>
