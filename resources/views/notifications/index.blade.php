<x-boilerplate>
    @if(Auth::user()->role === 'service_provider')
        <x-serviceprovidersidebar></x-serviceprovidersidebar>
    @elseif(Auth::user()->role === 'vendor')
        <x-vendorsidebar></x-vendorsidebar>
    @else
        <x-buyersidebar></x-buyersidebar>
    @endif

    <!-- Main Content -->
    <div class="lg:ml-60">
        @if(Auth::user()->role === 'service_provider')
            <x-serviceprovidernavbar></x-serviceprovidernavbar>
        @elseif(Auth::user()->role === 'vendor')
            <x-vendornavbar></x-vendornavbar>
        @else
            <x-buyernavbar></x-buyernavbar>
        @endif

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Notifications</h1>
                            <p class="text-gray-600 mt-2">Stay updated with your latest activities</p>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="markAllAsRead()" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                Mark All as Read
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="px-4 mb-6">
                    <div class="flex space-x-1 bg-gray-200 rounded-lg p-1">
                        <a href="{{ route('notifications.index', ['filter' => 'all']) }}" 
                           class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $filter === 'all' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            All
                        </a>
                        <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" 
                           class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $filter === 'unread' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Unread
                        </a>
                        <a href="{{ route('notifications.index', ['filter' => 'read']) }}" 
                           class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $filter === 'read' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Read
                        </a>
                        <a href="{{ route('notifications.index', ['filter' => 'recent']) }}" 
                           class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $filter === 'recent' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Recent
                        </a>
                    </div>
                </div>

                <!-- Notifications List -->
                <div class="px-4">
                    @if($notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 {{ !$notification->is_read ? 'border-l-4 border-l-blue-500' : '' }}">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3 mb-2">
                                                <div class="flex-shrink-0">
                                                    @switch($notification->type)
                                                        @case('inquiry_received')
                                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                                <i class="fas fa-envelope text-green-600 text-sm"></i>
                                                            </div>
                                                            @break
                                                        @case('inquiry_responded')
                                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                                <i class="fas fa-reply text-blue-600 text-sm"></i>
                                                            </div>
                                                            @break
                                                        @case('order_created')
                                                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                                <i class="fas fa-shopping-cart text-purple-600 text-sm"></i>
                                                            </div>
                                                            @break
                                                        @case('order_status_update')
                                                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                                                <i class="fas fa-truck text-orange-600 text-sm"></i>
                                                            </div>
                                                            @break
                                                        @case('new_message')
                                                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                                                <i class="fas fa-comment text-indigo-600 text-sm"></i>
                                                            </div>
                                                            @break
                                                        @case('service_verification')
                                                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                                <i class="fas fa-check-circle text-yellow-600 text-sm"></i>
                                                            </div>
                                                            @break
                                                        @default
                                                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                                                <i class="fas fa-bell text-gray-600 text-sm"></i>
                                                            </div>
                                                    @endswitch
                                                </div>
                                                <div class="flex-1">
                                                    <h3 class="text-lg font-semibold text-gray-900 {{ !$notification->is_read ? 'font-bold' : '' }}">
                                                        {{ $notification->title }}
                                                    </h3>
                                                    <p class="text-gray-600 text-sm">{{ $notification->message }}</p>
                                                </div>
                                            </div>
                                            
                                            @if($notification->data)
                                                <div class="mt-3 text-sm text-gray-500">
                                                    @if(isset($notification->data['inquiry_id']))
                                                        <a href="{{ route('inquiries.show', $notification->data['inquiry_id']) }}" 
                                                           class="text-blue-600 hover:text-blue-800">View Inquiry</a>
                                                    @endif
                                                    @if(isset($notification->data['order_id']))
                                                        <a href="{{ route('orders.show', $notification->data['order_id']) }}" 
                                                           class="text-blue-600 hover:text-blue-800">View Order</a>
                                                    @endif
                                                    @if(isset($notification->data['chat_id']))
                                                        <a href="{{ route('chats.show', $notification->data['chat_id']) }}" 
                                                           class="text-blue-600 hover:text-blue-800">View Chat</a>
                                                    @endif
                                                    @if(isset($notification->data['service_id']))
                                                        <a href="{{ route('services.show', $notification->data['service_id']) }}" 
                                                           class="text-blue-600 hover:text-blue-800">View Service</a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center space-x-2 ml-4">
                                            @if(!$notification->is_read)
                                                <button onclick="markAsRead({{ $notification->id }})" 
                                                        class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md text-sm font-medium hover:bg-blue-200 transition-colors">
                                                    Mark as Read
                                                </button>
                                            @endif
                                            <button onclick="deleteNotification({{ $notification->id }})" 
                                                    class="px-3 py-1 bg-red-100 text-red-700 rounded-md text-sm font-medium hover:bg-red-200 transition-colors">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                                        @if($notification->is_read)
                                            <span class="text-green-600">Read {{ $notification->read_at->diffForHumans() }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-bell text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">No Notifications</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                @if($filter === 'unread')
                                    You have no unread notifications.
                                @elseif($filter === 'read')
                                    You have no read notifications.
                                @elseif($filter === 'recent')
                                    You have no recent notifications.
                                @else
                                    You don't have any notifications yet.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>

<script>
function markAsRead(notificationId) {
    fetch(`/dashboard/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function markAllAsRead() {
    if (confirm('Are you sure you want to mark all notifications as read?')) {
        fetch('/dashboard/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

function deleteNotification(notificationId) {
    if (confirm('Are you sure you want to delete this notification?')) {
        fetch(`/dashboard/notifications/${notificationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
</script>
