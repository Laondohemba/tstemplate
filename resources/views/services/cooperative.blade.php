<x-boilerplate>
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-purple-700 to-purple-900 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Cooperative Association</h1>
            <p class="text-xl">Join agricultural cooperatives for collective bargaining and resource sharing.</p>
        </div>
    </section>

    <!-- Service Providers Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Cooperative Partners</h2>

            @if($services->count() > 0)
                <div class="space-y-6 max-w-5xl mx-auto">
                    @foreach($services as $service)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <div class="flex-1 p-6">
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full mb-2">
                                        {{ ucfirst($service->verification_status) }}
                                    </span>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $service->company_name }}</h3>
                                    <p class="text-purple-600 text-sm mb-4">{{ $service->serviceCategory->name }}</p>
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
                                            <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                                            {{ $service->location }}
                                        </div>
                                        @if($service->phone)
                                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                                <i class="fas fa-phone mr-2 text-purple-600"></i>
                                                {{ $service->phone }}
                                            </div>
                                        @endif
                                        @if($service->email)
                                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                                <i class="fas fa-envelope mr-2 text-purple-600"></i>
                                                {{ $service->email }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex space-x-3 mt-4">
                                        <a href="{{ route('service-providers.show', $service->slug) }}" 
                                           class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                            View Details
                                        </a>
                                        <a href="{{ route('inquiries.create') }}?service_id={{ $service->id }}" 
                                           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                            Contact
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-gray-400 text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Cooperative Partners Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        We're working on adding cooperative partners to help you with collective bargaining and resource sharing.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-purple-600 to-purple-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Interested in Joining a Cooperative?</h2>
            <p class="text-xl text-purple-100 mb-8 max-w-2xl mx-auto">Connect with agricultural cooperatives for collective benefits</p>
            <a href="{{ route('user.create') }}" class="inline-block px-8 py-4 bg-white text-purple-600 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                Join a Cooperative
            </a>
        </div>
    </section>

    <x-footer></x-footer>
</x-boilerplate>
