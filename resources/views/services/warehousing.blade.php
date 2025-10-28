<x-boilerplate>
    <x-navbar></x-navbar>

    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('app.services') }}" class="text-gray-700 hover:text-green-600">Services</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-gray-500">Warehousing & Cold Storage</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-700 to-blue-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Warehousing & Cold Storage</h1>
                <p class="text-xl mb-4">Secure storage facilities for dry goods, bulk produce, and perishables.</p>
                <p class="text-lg opacity-90">Find reliable storage facilities across Nigeria with temperature control and inventory management.</p>
            </div>
        </div>
    </section>

    <!-- Service Banner -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="h-64 md:h-96 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('assets/harvester.jpg') }}" alt="Warehousing & Cold Storage" 
                     class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Storage Facilities Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Available Storage Facilities</h2>

            @if($services->count() > 0)
                <!-- Dynamic Storage Facility Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($services as $service)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            @if($service->images && count($service->images) > 0)
                                <img src="{{ asset('storage/' . $service->images[0]) }}" alt="{{ $service->company_name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                    <i class="fas fa-warehouse text-blue-600 text-6xl"></i>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $service->company_name }}</h3>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ ucfirst($service->verification_status) }}
                                    </span>
                                </div>
                                <div class="text-gray-600 text-sm mb-4">
                                    <p>{{ $service->serviceCategory->name }}</p>
                                    <p class="font-semibold text-blue-600">{{ $service->location }}</p>
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
                                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>
                                        {{ $service->location }}
                                    </div>
                                    @if($service->phone)
                                        <div class="flex items-center text-sm text-gray-600 mb-1">
                                            <i class="fas fa-phone mr-2 text-blue-600"></i>
                                            {{ $service->phone }}
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('inquiries.create', ['service_id' => $service->id, 'vendor_id' => $service->user_id]) }}" 
                                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 w-full text-center">
                                    Book Storage
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Services Available -->
                <div class="text-center py-16">
                    <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-warehouse text-gray-400 text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Storage Facilities Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        We're working on bringing you the best storage facilities. Check back soon!
                    </p>
                    <a href="{{ route('user.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Become a Service Provider
                    </a>
                </div>
            @endif

            <!-- Why Choose Our Storage Partners -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Why Choose Our Storage Partners</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Quality Assurance</h4>
                            <p class="text-gray-600 text-sm">Certified facilities with proper temperature and humidity control to preserve product quality.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-lock text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Security & Safety</h4>
                            <p class="text-gray-600 text-sm">24/7 security surveillance, fire safety systems, and comprehensive insurance coverage.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-chart-line text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Inventory Management</h4>
                            <p class="text-gray-600 text-sm">Real-time tracking and reporting of your stored products with digital inventory systems.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Strategic Locations</h4>
                            <p class="text-gray-600 text-sm">Facilities located near major highways and ports for easy distribution.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Need Storage for Your Products?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Book storage space or request a custom quote from our verified partners</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.create') }}" class="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                    Book Storage Now
                </a>
                <a href="{{ route('app.services') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-blue-600 transition-colors">
                    View All Services
                </a>
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</x-boilerplate>
