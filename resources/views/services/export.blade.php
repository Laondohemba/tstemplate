<x-boilerplate>
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-orange-700 to-orange-900 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Export Advisory & Trade Consulting</h1>
            <p class="text-xl">Expert guidance on compliance, documentation, and market entry strategies.</p>
        </div>
    </section>

    <!-- Service Banner -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="h-64 md:h-96 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('assets/man_and_woman.jpg') }}" alt="Export Advisory" 
                     class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Export Consulting Services</h2>
            <p class="text-gray-600 mb-8">Get professional guidance to navigate the complexities of international trade and expand your agricultural business globally.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Services Offered</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-orange-600 mr-3 mt-1"></i>
                            <span>Export Compliance & Regulations</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-orange-600 mr-3 mt-1"></i>
                            <span>Documentation Support</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-orange-600 mr-3 mt-1"></i>
                            <span>Market Entry Strategies</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-orange-600 mr-3 mt-1"></i>
                            <span>Trade Regulations Guidance</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-orange-600 mr-3 mt-1"></i>
                            <span>Buyer Identification</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Why You Need Export Advisory</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-lightbulb text-orange-600 mr-3 mt-1"></i>
                            <span>Navigate complex international regulations</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-lightbulb text-orange-600 mr-3 mt-1"></i>
                            <span>Avoid costly compliance mistakes</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-lightbulb text-orange-600 mr-3 mt-1"></i>
                            <span>Access new international markets</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-lightbulb text-orange-600 mr-3 mt-1"></i>
                            <span>Optimize your export processes</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-lightbulb text-orange-600 mr-3 mt-1"></i>
                            <span>Build sustainable trade relationships</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-orange-600 to-orange-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Start Exporting?</h2>
            <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">Connect with our export advisors today</p>
            <a href="{{ route('user.create') }}" class="inline-block px-8 py-4 bg-white text-orange-600 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                Get Consultation
            </a>
        </div>
    </section>

    <x-footer></x-footer>
</x-boilerplate>
