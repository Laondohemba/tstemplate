<x-boilerplate>
    <x-serviceprovidersidebar></x-serviceprovidersidebar>

    <!-- Main Content -->
    <div class="lg:ml-60">
        <x-serviceprovidernavbar></x-serviceprovidernavbar>

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 min-h-screen">
                <!-- Welcome Header -->
                <div class="mb-6 px-4">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-lg p-6 text-white">
                        <h1 class="text-2xl md:text-3xl font-bold mb-2">Welcome, {{ auth()->user()->name }}!</h1>
                        <p class="text-green-100">Manage your service offerings and connect with clients</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 px-4">
                    <!-- Total Services -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Services</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalServices }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Active Services -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Active Services</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $activeServices }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Service Requests -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Service Requests</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $serviceRequests }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Orders -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Orders</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalOrders }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8 px-4">
                    <!-- Add New Service -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('services.create') }}"
                                class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                                <div class="p-2 bg-green-600 rounded-lg text-white mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Add New Service</p>
                                    <p class="text-sm text-gray-600">Create a new service offering</p>
                                </div>
                            </a>
                            <a href="{{ route('service-provider.requests') }}"
                                class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <div class="p-2 bg-blue-600 rounded-lg text-white mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">View Service Requests</p>
                                    <p class="text-sm text-gray-600">Check incoming requests</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                        <div class="space-y-3">
                            @if($recentServices->count() > 0)
                                @foreach($recentServices->take(3) as $service)
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="p-2 bg-gray-600 rounded-lg text-white mr-3">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">{{ $service->company_name }}</p>
                                            <p class="text-sm text-gray-600">{{ $service->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($service->status === 'active') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-8">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <p class="text-gray-500">No services yet</p>
                                    <a href="{{ route('services.create') }}" class="text-green-600 hover:text-green-700 font-medium">
                                        Create your first service
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Recent Services -->
                @if($recentServices->count() > 0)
                    <div class="px-4">
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-900">Recent Services</h3>
                                    <a href="{{ route('services.index') }}" class="text-green-600 hover:text-green-700 font-medium">
                                        View All
                                    </a>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($recentServices->take(6) as $service)
                                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                            <div class="flex items-start justify-between mb-3">
                                                <h4 class="font-semibold text-gray-900">{{ $service->company_name }}</h4>
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    @if($service->status === 'active') bg-green-100 text-green-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($service->status) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($service->description, 80) }}</p>
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-500">{{ $service->location }}</span>
                                                <a href="{{ route('services.edit', $service->slug) }}" 
                                                   class="text-green-600 hover:text-green-700 text-sm font-medium">
                                                    Edit
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
</x-boilerplate>
