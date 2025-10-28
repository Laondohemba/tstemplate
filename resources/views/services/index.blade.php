<x-boilerplate>
    @if(Auth::user()->role === 'service_provider')
        <x-serviceprovidersidebar></x-serviceprovidersidebar>
    @else
        <x-vendorsidebar></x-vendorsidebar>
    @endif

    <!-- Main Content -->
    <div class="lg:ml-60">
        @if(Auth::user()->role === 'service_provider')
            <x-serviceprovidernavbar></x-serviceprovidernavbar>
        @else
            <x-vendornavbar></x-vendornavbar>
        @endif

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">My Service Providers</h1>
                            <p class="text-gray-600 mt-2">Manage your service provider profiles</p>
                        </div>
                        <a href="{{ route('services.create') }}" 
                           class="px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>Add Service Provider
                        </a>
                    </div>
                </div>

                <!-- Services Grid -->
                <div class="px-4">
                    @if($services->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($services as $service)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                    <!-- Service Image -->
                                    <div class="h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                        @if($service->images && count($service->images) > 0)
                                            <img src="{{ asset('storage/' . $service->images[0]) }}" 
                                                 alt="{{ $service->company_name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-building text-green-600 text-6xl"></i>
                                        @endif
                                    </div>

                                    <!-- Service Info -->
                                    <div class="p-6">
                                        <div class="flex items-start justify-between mb-3">
                                            <h3 class="text-lg font-bold text-gray-900">{{ $service->company_name }}</h3>
                                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                                @if($service->verification_status === 'verified') bg-green-100 text-green-800
                                                @elseif($service->verification_status === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($service->verification_status) }}
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-600 mb-2">{{ $service->serviceCategory->name }}</p>
                                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ Str::limit($service->description, 100) }}</p>

                                        <!-- Service Details -->
                                        <div class="space-y-2 mb-4">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                                                {{ $service->location }}
                                            </div>
                                            @if($service->coverage_area)
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class="fas fa-globe mr-2 text-green-600"></i>
                                                    {{ $service->coverage_area }}
                                                </div>
                                            @endif
                                            @if($service->rating > 0)
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class="fas fa-star mr-2 text-yellow-500"></i>
                                                    {{ number_format($service->rating, 1) }} ({{ $service->reviews_count }} reviews)
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex space-x-2">
                                            <a href="{{ route('service-providers.show', $service->slug) }}" 
                                               class="flex-1 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors text-center">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </a>
                                            <a href="{{ route('services.edit', $service->slug) }}" 
                                               class="flex-1 px-3 py-2 bg-green-100 text-green-700 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors text-center">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </a>
                                            <form method="POST" action="{{ route('services.destroy', $service->slug) }}" 
                                                  class="flex-1" 
                                                  onsubmit="return confirm('Are you sure you want to delete this service provider profile?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full px-3 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors">
                                                    <i class="fas fa-trash mr-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $services->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-building text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Service Providers Yet</h3>
                            <p class="text-gray-600 mb-6">Start by creating your first service provider profile to connect with potential clients.</p>
                            <a href="{{ route('services.create') }}" 
                               class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add Service Provider
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>
