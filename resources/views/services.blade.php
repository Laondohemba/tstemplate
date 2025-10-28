<x-boilerplate>
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-green-700 to-green-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">TradeSource360 Services</h1>
                <p class="text-xl mb-6">Comprehensive agricultural trade solutions to power your business growth</p>
                <p class="text-lg opacity-90">From logistics to certification, we connect you with trusted service providers across Nigeria</p>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Services</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Partner with verified service providers to streamline your agricultural trade operations</p>
                <div class="mt-6">
                    <a href="{{ route('service-providers.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                        <i class="fas fa-users mr-2"></i>Browse Service Providers
                    </a>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <!-- Service 1: Logistics & Freight Forwarding -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('assets/tractor.png') }}" alt="Logistics & Freight Forwarding" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Logistics & Freight Forwarding</h3>
                        <p class="text-gray-600 mb-4">Domestic haulage, export shipping, clearing & forwarding solutions for seamless product delivery.</p>
                        <ul class="text-sm text-gray-500 space-y-2 mb-4">
                            <li>• Domestic Transportation</li>
                            <li>• International Shipping</li>
                            <li>• Customs Clearance</li>
                            <li>• Freight Forwarding</li>
                        </ul>
                        <a href="{{ route('services.logistics') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Service 2: Warehousing & Cold Storage -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('assets/harvester.jpg') }}" alt="Warehousing & Cold Storage" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Warehousing & Cold Storage</h3>
                        <p class="text-gray-600 mb-4">Secure storage facilities with temperature control for preserving product quality and freshness.</p>
                        <ul class="text-sm text-gray-500 space-y-2 mb-4">
                            <li>• Temperature-Controlled Storage</li>
                            <li>• Dry Warehousing</li>
                            <li>• Inventory Management</li>
                            <li>• Product Preservation</li>
                        </ul>
                        <a href="{{ route('services.warehousing') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Service 3: Quality Inspection & Certification -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('assets/tomatoes_man.jpg') }}" alt="Quality Inspection & Certification" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Quality Inspection & Certification</h3>
                        <p class="text-gray-600 mb-4">Product testing, quality assurance, and international certification services.</p>
                        <ul class="text-sm text-gray-500 space-y-2 mb-4">
                            <li>• Quality Testing</li>
                            <li>• International Certifications</li>
                            <li>• Standards Compliance</li>
                            <li>• Product Inspection</li>
                        </ul>
                        <a href="{{ route('services.quality') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Service 4: Export Advisory & Trade Consulting -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('assets/man_and_woman.jpg') }}" alt="Export Advisory & Trade Consulting" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Export Advisory & Trade Consulting</h3>
                        <p class="text-gray-600 mb-4">Expert guidance on compliance, documentation, and market entry strategies.</p>
                        <ul class="text-sm text-gray-500 space-y-2 mb-4">
                            <li>• Export Compliance</li>
                            <li>• Documentation Support</li>
                            <li>• Market Entry Strategies</li>
                            <li>• Trade Regulations</li>
                        </ul>
                        <a href="{{ route('services.export') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Service 5: Packaging & Branding Services -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('assets/market_seller.jpg') }}" alt="Packaging & Branding Services" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Packaging & Branding Services</h3>
                        <p class="text-gray-600 mb-4">Export-ready packaging, labeling, and branding solutions for agri-products.</p>
                        <ul class="text-sm text-gray-500 space-y-2 mb-4">
                            <li>• Product Packaging</li>
                            <li>• Labeling & Barcoding</li>
                            <li>• Brand Development</li>
                            <li>• Export-Ready Solutions</li>
                        </ul>
                        <a href="{{ route('services.packaging') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Service 6: Equipment Leasing & Machinery Supply -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('assets/farmer.jpg') }}" alt="Equipment Leasing & Machinery Supply" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Equipment Leasing & Machinery Supply</h3>
                        <p class="text-gray-600 mb-4">Access to modern agricultural equipment and machinery for efficient operations.</p>
                        <ul class="text-sm text-gray-500 space-y-2 mb-4">
                            <li>• Equipment Rental</li>
                            <li>• Machinery Purchase</li>
                            <li>• Maintenance Support</li>
                            <li>• Technology Solutions</li>
                        </ul>
                        <a href="{{ route('services.equipment') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Simple steps to access the services you need</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold text-green-600">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Browse Services</h3>
                    <p class="text-gray-600">Explore our range of verified service providers and find the solution that fits your needs</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold text-green-600">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Request a Quote</h3>
                    <p class="text-gray-600">Submit your requirements and receive competitive quotes from qualified providers</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold text-green-600">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Get Started</h3>
                    <p class="text-gray-600">Connect with your chosen provider and start leveraging professional services</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Provider CTA -->
    <section class="py-16 bg-gradient-to-r from-green-600 to-green-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Are You a Service Provider?</h2>
            <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">Partner with TradeSource360 and connect with thousands of agricultural businesses across Nigeria</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.create', ['role' => 'service_provider']) }}" class="inline-block px-8 py-4 bg-white text-green-600 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                    Register as a Service Provider
                </a>
                <a href="{{ route('app.contact') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-green-600 transition-colors">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose Our Services</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Verified Providers</h3>
                    <p class="text-gray-600 text-sm">All service providers are thoroughly vetted and verified</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-dollar-sign text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Competitive Pricing</h3>
                    <p class="text-gray-600 text-sm">Compare quotes and choose the best value for your business</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Quick Response</h3>
                    <p class="text-gray-600 text-sm">Fast turnaround times on quotes and service delivery</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-gray-600 text-sm">Our team is always here to help you</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <details class="bg-gray-50 rounded-lg p-6">
                    <summary class="font-bold text-gray-900 cursor-pointer">How do I request a service?</summary>
                    <p class="mt-3 text-gray-600">Simply browse our services, select the one you need, and click "Request a Quote". Fill in your requirements and our verified providers will respond with competitive quotes.</p>
                </details>

                <details class="bg-gray-50 rounded-lg p-6">
                    <summary class="font-bold text-gray-900 cursor-pointer">Are the service providers verified?</summary>
                    <p class="mt-3 text-gray-600">Yes, all service providers on TradeSource360 are thoroughly vetted and verified. We ensure they meet our quality standards and have the necessary certifications.</p>
                </details>

                <details class="bg-gray-50 rounded-lg p-6">
                    <summary class="font-bold text-gray-900 cursor-pointer">What payment methods are accepted?</summary>
                    <p class="mt-3 text-gray-600">Payment arrangements are made directly with the service provider. Most accept bank transfers, mobile payments, and other secure payment methods.</p>
                </details>

                <details class="bg-gray-50 rounded-lg p-6">
                    <summary class="font-bold text-gray-900 cursor-pointer">Can I track my service request?</summary>
                    <p class="mt-3 text-gray-600">Yes, once you're logged in, you can track all your service requests, quotes, and communications with providers through your dashboard.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Join thousands of agricultural businesses already benefiting from our professional services</p>
            <a href="{{ route('user.create') }}" class="inline-block px-8 py-4 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition-colors">
                Create Your Free Account
            </a>
        </div>
    </section>

    <x-footer></x-footer>
</x-boilerplate>
