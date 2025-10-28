<x-boilerplate>
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-yellow-700 to-yellow-900 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Equipment Leasing & Machinery Supply</h1>
            <p class="text-xl">Access modern agricultural equipment and machinery for efficient operations.</p>
        </div>
    </section>

    <!-- Service Banner -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="h-64 md:h-96 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('assets/farmer.jpg') }}" alt="Equipment Services" 
                     class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Equipment Providers Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Equipment Providers</h2>

            @if($services->count() > 0)
                <!-- Dynamic Provider Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($services as $service)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            @if($service->images && count($service->images) > 0)
                                <img src="{{ asset('storage/' . $service->images[0]) }}" alt="{{ $service->company_name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                                    <i class="fas fa-tractor text-yellow-600 text-6xl"></i>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $service->company_name }}</h3>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        {{ ucfirst($service->verification_status) }}
                                    </span>
                                </div>
                                <div class="text-gray-600 text-sm mb-4">
                                    <p>{{ $service->serviceCategory->name }}</p>
                                    <p class="font-semibold text-yellow-600">{{ $service->location }}</p>
                                </div>
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-900 text-sm mb-2">Services Offered:</h4>
                                    <ul class="text-sm text-gray-600 space-y-1">
                                        @foreach($service->services_offered as $offeredService)
                                            @if(!empty($offeredService))
                                                <li>• {{ $offeredService }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="mb-4">
                                    <div class="flex items-center text-sm text-gray-600 mb-1">
                                        <i class="fas fa-map-marker-alt mr-2 text-yellow-600"></i>
                                        {{ $service->location }}
                                    </div>
                                    @if($service->phone)
                                        <div class="flex items-center text-sm text-gray-600 mb-1">
                                            <i class="fas fa-phone mr-2 text-yellow-600"></i>
                                            {{ $service->phone }}
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('inquiries.create', ['service_id' => $service->id, 'vendor_id' => $service->user_id]) }}" 
                                   class="inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg font-medium hover:bg-yellow-700 w-full text-center">
                                    Request a Quote
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Equipment Providers Available -->
                <div class="text-center py-16">
                    <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-tractor text-gray-400 text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Equipment Providers Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        We're working on bringing you the best equipment leasing partners. Check back soon!
                    </p>
                    <a href="{{ route('user.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white rounded-lg font-medium hover:bg-yellow-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Become a Service Provider
                    </a>
                </div>
            @endif

            <!-- Service Options -->
            <div class="bg-white rounded-lg shadow-md p-8 max-w-4xl mx-auto">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Flexible Service Options</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-alt text-yellow-600 text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Equipment Rental</h4>
                        <p class="text-gray-600 text-sm">Short-term and long-term rental options available</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shopping-cart text-yellow-600 text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Purchase Options</h4>
                        <p class="text-gray-600 text-sm">Buy new or refurbished equipment with warranty</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-tools text-yellow-600 text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Maintenance Support</h4>
                        <p class="text-gray-600 text-sm">Regular maintenance and repair services included</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-yellow-600 to-yellow-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Need Agricultural Equipment?</h2>
            <p class="text-xl text-yellow-100 mb-8 max-w-2xl mx-auto">Get access to modern machinery and equipment</p>
            <a href="{{ route('user.create') }}" class="inline-block px-8 py-4 bg-white text-yellow-600 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                Request Equipment
            </a>
        </div>
    </section>

    <x-footer></x-footer>
</x-boilerplate>
