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
                            <span class="text-gray-500">Quality Inspection & Certification</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-purple-700 to-purple-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Quality Inspection & Certification</h1>
                <p class="text-xl mb-4">Trusted inspection partners for export compliance and product quality assurance.</p>
                <p class="text-lg opacity-90">Get your products certified for international trade with our verified inspection partners.</p>
            </div>
        </div>
    </section>

    <!-- Service Banner -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="h-64 md:h-96 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('assets/tomatoes_man.jpg') }}" alt="Quality Inspection" 
                     class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Inspection Partners Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Inspection & Certification Partners</h2>

            <!-- Partners Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <!-- Partner 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                    <div class="h-48 bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-certificate text-purple-600 text-6xl mb-3"></i>
                            <h3 class="text-xl font-bold text-gray-900">SGS Nigeria</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-gray-600 text-sm mb-4">
                            <p class="font-semibold">Lab Testing, Certification, Compliance</p>
                            <p>Nationwide Coverage</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Services:</h4>
                            <ul class="text-sm text-gray-600 space-y-1 text-left">
                                <li>• Product Quality Testing</li>
                                <li>• Export Certification</li>
                                <li>• Standards Compliance</li>
                                <li>• Laboratory Analysis</li>
                            </ul>
                        </div>
                        <a href="{{ route('inquiries.create') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 w-full">
                            Request Certification
                        </a>
                    </div>
                </div>

                <!-- Partner 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                    <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-check-circle text-blue-600 text-6xl mb-3"></i>
                            <h3 class="text-xl font-bold text-gray-900">Bureau Veritas</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-gray-600 text-sm mb-4">
                            <p class="font-semibold">International Certification Agency</p>
                            <p>Nationwide Coverage</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Services:</h4>
                            <ul class="text-sm text-gray-600 space-y-1 text-left">
                                <li>• ISO Certification</li>
                                <li>• HACCP Certification</li>
                                <li>• Phytosanitary Certificates</li>
                                <li>• Quality Audits</li>
                            </ul>
                        </div>
                        <a href="{{ route('inquiries.create') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 w-full">
                            Request Certification
                        </a>
                    </div>
                </div>

                <!-- Partner 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                    <div class="h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-award text-green-600 text-6xl mb-3"></i>
                            <h3 class="text-xl font-bold text-gray-900">SON (Standards Organisation)</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-gray-600 text-sm mb-4">
                            <p class="font-semibold">Nigerian Standards Compliance</p>
                            <p>Government Agency</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Services:</h4>
                            <ul class="text-sm text-gray-600 space-y-1 text-left">
                                <li>• MANCAP Certification</li>
                                <li>• Product Registration</li>
                                <li>• Standards Certification</li>
                                <li>• Quality Control</li>
                            </ul>
                        </div>
                        <a href="{{ route('inquiries.create') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 w-full">
                            Request Certification
                        </a>
                    </div>
                </div>
            </div>

            <!-- Certification Types -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Common Certifications for Export</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check text-purple-600 mr-2"></i>
                            Phytosanitary Certificate
                        </h4>
                        <p class="text-gray-600 text-sm">Required for exporting agricultural products to ensure they're free from pests and diseases.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check text-purple-600 mr-2"></i>
                            HACCP Certification
                        </h4>
                        <p class="text-gray-600 text-sm">Food safety management system certification for processed agricultural products.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check text-purple-600 mr-2"></i>
                            Organic Certification
                        </h4>
                        <p class="text-gray-600 text-sm">Verifies products meet organic standards for international markets.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check text-purple-600 mr-2"></i>
                            ISO Certification
                        </h4>
                        <p class="text-gray-600 text-sm">International quality management standards for your business operations.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check text-purple-600 mr-2"></i>
                            Certificate of Origin
                        </h4>
                        <p class="text-gray-600 text-sm">Documents the country where your products were manufactured or grown.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-clipboard-check text-purple-600 mr-2"></i>
                            Quality Analysis Report
                        </h4>
                        <p class="text-gray-600 text-sm">Laboratory test results confirming product quality specifications.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-purple-600 to-purple-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Certify Your Products?</h2>
            <p class="text-xl text-purple-100 mb-8 max-w-2xl mx-auto">Connect with trusted certification partners and get export-ready</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.create') }}" class="inline-block px-8 py-4 bg-white text-purple-600 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                    Request Certification
                </a>
                <a href="{{ route('app.services') }}" class="inline-block px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-purple-600 transition-colors">
                    View All Services
                </a>
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</x-boilerplate>
