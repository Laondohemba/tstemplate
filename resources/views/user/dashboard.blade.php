<x-boilerplate>
    @if (auth()->user()->role === 'buyer')
        <x-buyersidebar></x-buyersidebar>
        <!-- Main Content -->
        <div class="lg:ml-64">
            <x-buyernavbar></x-buyernavbar>

            <!-- Page Content -->
            <main class="pt-20 p-4">
                <div class="mx-auto max-w-7xl">
                    <!-- Welcome Section -->
                    <h1 class="text-2xl font-[700] text-gray-900 mb-6">Hello, {{ ucwords(auth()->user()->name) }}</h1>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="rounded-lg shadow p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Active Inquiries</p>
                                    <p class="text-3xl font-bold text-gray-900">0</p>
                                </div>
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <i class="fas fa-envelope text-blue-600"></i>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-lg shadow p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Quotes Received</p>
                                    <p class="text-3xl font-bold text-gray-900">0</p>
                                </div>
                                <div class="p-3 bg-green-100 rounded-full">
                                    <i class="fas fa-file-alt text-green-600"></i>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-lg shadow p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Products</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
                                </div>
                                <div class="p-3 bg-purple-100 rounded-full">
                                    <i class="fas fa-box text-purple-600"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Inquiries -->
                    <div class="mb-8">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-[700] text-gray-900">Recent Inquiries</h2>
                        </div>
                        <div class="overflow-x-auto border border-gray-200 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="text-xs font-[#FAFCF7] text-[#0F1C0D] text-left">
                                        <th class="px-6 py-3 tracking-wider">
                                            Product</th>
                                        <th class="px-6 py-3 tracking-wider">
                                            Vendor</th>
                                        <th class="px-6 py-3 tracking-wider">
                                            Date</th>
                                        <th class="px-6 py-3 tracking-wider">
                                            Status</th>
                                        <th class="px-6 py-3 tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="text-sm text-[#0F1C0D]">
                                        <td class=" px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 bg-green-100 rounded-full overflow-hidden flex items-center justify-center">
                                                    <img class="w-full h-full object-cover" src="../assets/coffe.png"
                                                        alt="Product name">
                                                </div>


                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">GreenHarvest Farms
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-green-700">2025-07-20</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-4 py-1 font-semibold rounded-md bg-green-100">Pending</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('inquiries.show', 1) }}" class="text-green-600 hover:text-green-700">View
                                                Details</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Products -->
                    <div>
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-[700] text-gray-900">Recent Products</h2>
                        </div>
                        <div class="p-6 text-gray-900">
                            @if($recentProducts->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 font-[500] text-sm">
                                    @foreach($recentProducts as $product)
                                        @php
                                            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                                            $firstImage = is_array($images) && !empty($images) ? $images[0] : 'assets/placeholder.png';
                                        @endphp
                                        <a href="{{ route('products.single', $product->slug) }}" class="group cursor-pointer">
                                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200">
                                                <img src="{{ asset('storage/' . $firstImage) }}"
                                                    alt="{{ $product->product_name }}"
                                                    class="h-48 w-full object-cover group-hover:opacity-75">
                                            </div>
                                            <h3 class="mt-3">{{ Str::limit($product->product_name, 30) }}</h3>
                                            <p class="text-xs text-gray-600">{{ $product->category->category }}</p>
                                            <p class="text-sm text-green-600 font-semibold">{{ $product->currency }}{{ number_format($product->price, 2) }}</p>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <p class="text-gray-500">No products available at the moment.</p>
                                    <a href="{{ route('app.products') }}" 
                                       class="mt-4 inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                        Browse Products
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @elseif(auth()->user()->role === 'vendor')
        <x-vendorsidebar></x-vendorsidebar>
        <!-- Main Content -->
        <div class="lg:ml-64">
            <x-vendornavbar></x-vendornavbar>

            <!-- Page Content -->
            <main class="pt-16 p-4">
                <div class="mx-auto max-w-7xl">
                    <!-- Welcome Section -->
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Hello, {{ ucwords(auth()->user()->name) }}</h1>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Product</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
                                </div>
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Available Products</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $availableProducts }}</p>
                                </div>
                                <div class="p-3 bg-green-100 rounded-full">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Featured Products</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $featuredProducts }}</p>
                                </div>
                                <div class="p-3 bg-purple-100 rounded-full">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Inquiries -->
                    <div class="mb-8">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-bold text-gray-900">Recent Inquiries</h2>
                        </div>
                        <div class="overflow-x-auto border border-gray-200 rounded-lg bg-white">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="text-xs font-medium text-gray-700 text-left">
                                        <th class="px-6 py-3 tracking-wider">Buyer</th>
                                        <th class="px-6 py-3 tracking-wider">Product</th>
                                        <th class="px-6 py-3 tracking-wider">Date</th>
                                        <th class="px-6 py-3 tracking-wider">Status</th>
                                        <th class="px-6 py-3 tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="text-sm text-gray-900">
                                        <td class="px-6 py-4 whitespace-nowrap">Ethan Carter</td>
                                        <td class="px-6 py-4 text-green-700 whitespace-nowrap">Organic Wheat</td>
                                        <td class="px-6 py-4 whitespace-nowrap">2025-07-20</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-3 py-1 text-xs font-semibold rounded-md bg-green-100 text-green-800">New</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('inquiries.show', 1) }}"
                                                class="text-green-600 hover:text-green-700 font-medium">Reply</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Products -->
                    <div>
                        <div class="px-6 py-4 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-900">Your Recent Products</h2>
                            <a href="{{ route('products.index') }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                                View All
                            </a>
                        </div>
                        <div class="overflow-x-auto border border-gray-200 rounded-lg bg-white">
                            @if($recentProducts->count() > 0)
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr class="text-xs font-medium text-gray-700 text-left">
                                            <th class="px-6 py-3 tracking-wider">Product</th>
                                            <th class="px-6 py-3 tracking-wider">Category</th>
                                            <th class="px-6 py-3 tracking-wider">Price</th>
                                            <th class="px-6 py-3 tracking-wider">Status</th>
                                            <th class="px-6 py-3 tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($recentProducts as $product)
                                            <tr class="text-sm text-gray-900">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        @php
                                                            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                                                            $firstImage = is_array($images) && !empty($images) ? $images[0] : 'assets/placeholder.png';
                                                        @endphp
                                                        <img src="{{ asset('storage/' . $firstImage) }}" 
                                                             alt="{{ $product->product_name }}"
                                                             class="w-10 h-10 rounded object-cover mr-3">
                                                        <span>{{ Str::limit($product->product_name, 30) }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-green-700 whitespace-nowrap">
                                                    {{ $product->category->category }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $product->currency }}{{ number_format($product->price, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-md 
                                                        {{ $product->status === 'available' ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $product->status === 'featured' ? 'bg-purple-100 text-purple-800' : '' }}
                                                        {{ $product->status === 'unavailable' ? 'bg-gray-100 text-gray-800' : '' }}
                                                        {{ $product->status === 'disabled' ? 'bg-red-100 text-red-800' : '' }}">
                                                        {{ ucfirst($product->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ route('products.edit', $product->slug) }}"
                                                        class="text-green-600 hover:text-green-700 font-medium mr-3">Edit</a>
                                                    <a href="{{ route('products.single', $product->slug) }}"
                                                        class="text-blue-600 hover:text-blue-700 font-medium">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-12">
                                    <p class="text-gray-500 mb-4">You haven't added any products yet.</p>
                                    <a href="{{ route('products.create') }}" 
                                       class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                        Add Your First Product
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @else
        Hello {{ ucwords(auth()->user()->name) }}, welcome to your {{ ucwords(auth()->user()->role) }} dashboard
    @endif
</x-boilerplate>