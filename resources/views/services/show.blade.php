<x-boilerplate>
    <x-navbar></x-navbar>

    <!-- Page Content -->
    <main class="pt-16">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="flex items-center mb-6">
                        @if($service->verification_status === 'verified')
                            <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full mr-4">
                                <i class="fas fa-check-circle mr-1"></i>Verified
                            </span>
                        @endif
                        <span class="px-3 py-1 text-sm font-medium bg-white text-green-600 rounded-full">
                            {{ $service->serviceCategory->name }}
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $service->company_name }}</h1>
                    <p class="text-xl text-green-100 mb-8">{{ Str::limit($service->description, 200) }}</p>
                    
                    <!-- Quick Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-2xl mr-3"></i>
                            <div>
                                <p class="text-sm text-green-200">Location</p>
                                <p class="font-semibold">{{ $service->location }}</p>
                            </div>
                        </div>
                        @if($service->coverage_area)
                            <div class="flex items-center">
                                <i class="fas fa-globe text-2xl mr-3"></i>
                                <div>
                                    <p class="text-sm text-green-200">Coverage Area</p>
                                    <p class="font-semibold">{{ $service->coverage_area }}</p>
                                </div>
                            </div>
                        @endif
                        @if($service->rating > 0)
                            <div class="flex items-center">
                                <i class="fas fa-star text-2xl mr-3"></i>
                                <div>
                                    <p class="text-sm text-green-200">Rating</p>
                                    <p class="font-semibold">{{ number_format($service->rating, 1) }} ({{ $service->reviews_count }} reviews)</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Service Details -->
                    <div class="lg:col-span-2">
                        <!-- Service Images -->
                        @if($service->images && count($service->images) > 0)
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Service Images</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($service->images as $image)
                                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/' . $image) }}" 
                                                 alt="{{ $service->company_name }}" 
                                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Description -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Service</h2>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 leading-relaxed">{{ $service->description }}</p>
                            </div>
                        </div>

                        <!-- Services Offered -->
                        @if($service->services_offered && count($service->services_offered) > 0)
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-4">Services Offered</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($service->services_offered as $serviceOffered)
                                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                            <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                            <span class="text-gray-700">{{ $serviceOffered }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column - Contact & Actions -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-lg p-6 sticky top-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Contact Information</h3>
                            
                            <!-- Contact Details -->
                            <div class="space-y-4 mb-6">
                                @if($service->contact_person)
                                    <div class="flex items-center">
                                        <i class="fas fa-user text-green-600 mr-3"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Contact Person</p>
                                            <p class="font-semibold text-gray-900">{{ $service->contact_person }}</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-green-600 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Email</p>
                                        <a href="mailto:{{ $service->email }}" class="font-semibold text-gray-900 hover:text-green-600">
                                            {{ $service->email }}
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-green-600 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Phone</p>
                                        <a href="tel:{{ $service->phone }}" class="font-semibold text-gray-900 hover:text-green-600">
                                            {{ $service->phone }}
                                        </a>
                                    </div>
                                </div>
                                
                                @if($service->website)
                                    <div class="flex items-center">
                                        <i class="fas fa-globe text-green-600 mr-3"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Website</p>
                                            <a href="{{ $service->website }}" target="_blank" class="font-semibold text-gray-900 hover:text-green-600">
                                                Visit Website
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($service->address)
                                    <div class="flex items-start">
                                        <i class="fas fa-map-marker-alt text-green-600 mr-3 mt-1"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Address</p>
                                            <p class="font-semibold text-gray-900">{{ $service->address }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <button onclick="contactService({{ $service->id }})" 
                                        class="w-full px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                    <i class="fas fa-envelope mr-2"></i>Send Inquiry
                                </button>
                                
                                <button onclick="shareService()" 
                                        class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-share mr-2"></i>Share Service
                                </button>
                            </div>

                            <!-- Service Provider Info -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h4 class="font-semibold text-gray-900 mb-2">Service Provider</h4>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-sm font-medium text-gray-600">
                                            {{ substr($service->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $service->user->name }}</p>
                                        <p class="text-sm text-gray-500">Member since {{ $service->user->created_at->format('M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer></x-footer>
</x-boilerplate>

<script>
function contactService(serviceId) {
    // Redirect to inquiry form with service provider pre-selected
    window.location.href = `{{ route('inquiries.create') }}?service_id=${serviceId}`;
}

function shareService() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $service->company_name }}',
            text: '{{ Str::limit($service->description, 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback: copy URL to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Service link copied to clipboard!');
        });
    }
}
</script>
