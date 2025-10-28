<x-boilerplate>
    <x-navbar></x-navbar>

    <!-- Page Content -->
    <main class="pt-16">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Service Providers</h1>
                    <p class="text-xl mb-8 text-green-100">Connect with verified agricultural service providers across Africa</p>
                    
                    <!-- Search Bar -->
                    <div class="max-w-2xl mx-auto">
                        <div class="relative">
                            <input type="text" placeholder="Search service providers..." 
                                   class="w-full px-6 py-4 pr-12 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-300">
                            <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-search text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Filter -->
        <div class="bg-white border-b border-gray-200 py-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap gap-3 justify-center">
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium">
                        All Services
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Logistics & Freight
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Warehousing
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Quality Inspection
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Packaging
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Export Advisory
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Equipment Leasing
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Cooperatives
                    </button>
                </div>
            </div>
        </div>

        <!-- Service Providers Grid -->
        <div class="container mx-auto px-4 py-12">
            @if(isset($services) && $services->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
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
                                    <h3 class="text-xl font-bold text-gray-900">{{ $service->company_name }}</h3>
                                    @if($service->verification_status === 'verified')
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                            <i class="fas fa-check-circle mr-1"></i>Verified
                                        </span>
                                    @endif
                                </div>

                                <p class="text-sm text-green-600 font-medium mb-2">{{ $service->serviceCategory->name }}</p>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($service->description, 120) }}</p>

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

                                <!-- Services Offered -->
                                @if($service->services_offered && count($service->services_offered) > 0)
                                    <div class="mb-4">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Services Offered:</p>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(array_slice($service->services_offered, 0, 3) as $serviceOffered)
                                                <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">
                                                    {{ $serviceOffered }}
                                                </span>
                                            @endforeach
                                            @if(count($service->services_offered) > 3)
                                                <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">
                                                    +{{ count($service->services_offered) - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('service-providers.show', $service->slug) }}" 
                                       class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors text-center">
                                        <i class="fas fa-eye mr-1"></i>View Details
                                    </a>
                                    <button onclick="contactService({{ $service->id }})" 
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $services->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-building text-gray-400 text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Service Providers Found</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        We're working on adding more verified service providers. Check back soon or 
                        <a href="{{ route('services.create') }}" class="text-green-600 hover:text-green-700 font-medium">
                            become a service provider
                        </a>.
                    </p>
                    <a href="{{ route('app.services') }}" 
                       class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Services
                    </a>
                </div>
            @endif
        </div>
    </main>

    <x-footer></x-footer>
</x-boilerplate>

<script>
function contactService(serviceId) {
    // Redirect to inquiry form with service provider pre-selected
    window.location.href = `{{ route('inquiries.create') }}?service_id=${serviceId}`;
}
</script>
