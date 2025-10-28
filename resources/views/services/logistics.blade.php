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
                            <span class="text-gray-500">Logistics & Freight Forwarding</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-green-700 to-green-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Logistics & Freight Forwarding</h1>
                <p class="text-xl mb-4">Domestic haulage, export shipping, clearing & forwarding solutions.</p>
                <p class="text-lg opacity-90">Reliable logistics partners to move your agricultural products across Nigeria and beyond.</p>
            </div>
        </div>
    </section>

    <!-- Service Banner -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="h-64 md:h-96 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('assets/tractor.png') }}" alt="Logistics & Freight Forwarding" 
                     class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Service Providers Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Logistics Partners</h2>

            @if($services->count() > 0)
                <!-- Dynamic Provider Cards -->
                <div class="space-y-6 max-w-5xl">
                    @foreach($services as $service)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <div class="flex-1 p-6">
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full mb-2">
                                        {{ ucfirst($service->verification_status) }}
                                    </span>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $service->company_name }}</h3>
                                    <p class="text-green-600 text-sm mb-4">{{ $service->serviceCategory->name }}</p>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 200) }}</p>
                                    
                                    @if($service->services_offered && count($service->services_offered) > 0)
                                        <div class="mb-4">
                                            <h4 class="font-semibold text-gray-900 mb-2">Services Offered:</h4>
                                            <ul class="text-sm text-gray-600 space-y-1">
                                                @foreach($service->services_offered as $offeredService)
                                                    @if(!empty($offeredService))
                                                        <li>• {{ $offeredService }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="mb-4">
                                        <div class="flex items-center text-sm text-gray-600 mb-2">
                                            <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                                            {{ $service->location }}
                                        </div>
                                        @if($service->coverage_area)
                                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                                <i class="fas fa-globe mr-2 text-green-600"></i>
                                                {{ $service->coverage_area }}
                                            </div>
                                        @endif
                                        @if($service->phone)
                                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                                <i class="fas fa-phone mr-2 text-green-600"></i>
                                                {{ $service->phone }}
                                            </div>
                                        @endif
                                    </div>

                                    <a href="{{ route('inquiries.create', ['service_id' => $service->id, 'vendor_id' => $service->user_id]) }}" 
                                       class="inline-block px-6 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700">
                                        Request a Quote
                                    </a>
                                </div>
                                <div class="md:w-64 h-48 md:h-auto">
                                    @if($service->images && count($service->images) > 0)
                                        <img src="{{ asset('storage/' . $service->images[0]) }}" 
                                             alt="{{ $service->company_name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                            <i class="fas fa-truck text-green-600 text-6xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Services Available -->
                <div class="text-center py-16">
                    <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-truck text-gray-400 text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Logistics Providers Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        We're working on bringing you the best logistics partners. Check back soon!
                    </p>
                    <a href="{{ route('user.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Become a Service Provider
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-green-600 to-green-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Ship Your Products?</h2>
            <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">Get competitive quotes from verified logistics providers</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.create') }}" class="inline-block px-8 py-4 bg-white text-green-600 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                    Get Started
                </a>
                <a href="{{ route('app.services') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-green-600 transition-colors">
                    View All Services
                </a>
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</x-boilerplate>
