<x-boilerplate>
    @if (auth()->user()->role === 'buyer')
        <x-buyersidebar></x-buyersidebar>
        <x-buyernavbar></x-buyernavbar>
    @elseif(auth()->user()->role === 'vendor')
        <x-vendorsidebar></x-vendorsidebar>
        <x-vendornavbar></x-vendornavbar>
    @else
        {{ auth()->user()->role }}
    @endif
    <!-- Page Content -->
    <main class="pt-16 p-4">
        <div class="lg:ml-64">
            <div class="bg-gray-50 text-gray-800">
                <div class="container mx-aut px-8 py-8">
                    <!-- Header -->
                    <div class="">
                        <h1 class="text-xl md:text-2xl font-[700] text-gray-900">Products</h1>
                        <p class="text-gray-600 mt-2">Manage your active and inactive product listings.</p>
                    </div>

                    <!-- Search and Filters -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                        <div class="flex flex-col">
                            <!-- Search -->
                            <div class="bg-green-50 w-full border border-green-200 rounded-lg p-3 md:p-4 mb-4 md:mb-6">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600 mr-2 md:mr-3 flex-shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input type="text" placeholder="Search inquiries"
                                        class="bg-transparent border-none outline-none flex-1 text-green-700 placeholder-green-600 text-sm md:text-base">
                                </div>
                            </div>

                            <!-- Filters -->
                            <div class="flex flex-row gap-4">
                                <!-- Category Filter -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Product
                                        Category</label>
                                    {{-- <select
                                        class="block w-full py-2 px-3 border border-gray-300 bg-white rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option>All Categories</option>
                                        <option>Farm Produce</option>
                                        <option>Natural Resources</option>
                                        <option>Farm Tools</option>
                                        <option>Services</option>
                                    </select> --}}
                                </div>

                                <!-- Status Filter -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    {{-- <select
                                        class="block w-full py-2 px-3 border border-gray-300 bg-white rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option>All Statuses</option>
                                        <option>Active</option>
                                        <option>Inactive</option>
                                        <option>Pending Approval</option>
                                        <option>Disapproved</option>
                                    </select> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <!-- Table for larger screens -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Product Image</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Product Name</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Category</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($products as $product)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="company-logo">
                                                    <div
                                                        class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                                        @if (!empty($product->images) && isset($product->images[0]))
                                                            <img class="w-full h-full object-cover"
                                                                src="{{ asset('storage/' . $product->images[0]) }}"
                                                                alt="{{ $product->product_name }}">
                                                        @else
                                                            <svg class="w-8 h-8 text-gray-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $product->product_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $product->category->category }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($product->status === 'available')
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-green-100 text-green-800">Available</span>
                                                @elseif($product->status === 'unavailable')
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-red-100 text-red-800">Unavailable</span>
                                                @elseif($product->status === 'featured')
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-blue-100 text-blue-800">Featured</span>
                                                @else
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-gray-100 text-gray-800">Disabled</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $product->currency }}{{ number_format($product->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ number_format($product->quantity_available, 0) }}
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex flex-wrap gap-1 text-xs text-gray-700">
                                                    <!-- View Product -->
                                                    <a href="{{ route('products.single', $product->slug) }}"
                                                        class="px-2 py-1 cursor-pointer bg-gray-500 text-gray-200 decoration-none rounded hover:bg-gray-600">
                                                        View
                                                    </a>
                                                    @if (auth()->user()->id === $product->user_id || auth()->user()->role === 'admin')
                                                        <!-- Edit Product -->
                                                        <a href="{{ route('products.edit', $product->slug) }}"
                                                            class="px-2 py-1 cursor-pointer bg-green-600 text-gray-200 decoration-none rounded hover:bg-green-700">
                                                            Edit
                                                        </a>

                                                        <!-- Activate / Deactivate Buttons -->
                                                        @if ($product->status === 'available')
                                                            <form
                                                                action="{{ route('products.deactivate', $product->id) }}"
                                                                method="POST" class="inline" x-data="formSubmit"
                                                                @submit.prevent="submit">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" x-ref="btn"
                                                                    class="px-2 py-1 cursor-pointer bg-yellow-500 text-gray-200 decoration-none rounded hover:bg-yellow-600">
                                                                    Deactivate
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('products.activate', $product->id) }}"
                                                                method="POST" class="inline" x-data="formSubmit"
                                                                @submit.prevent="submit">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" x-ref="btn"
                                                                    class="px-2 py-1 cursor-pointer bg-blue-500 text-gray-200 decoration-none rounded hover:bg-blue-600">
                                                                    Activate
                                                                </button>
                                                            </form>
                                                        @endif

                                                        <!-- Mark Unavailable Button -->
                                                        @if ($product->status === 'available')
                                                            <form
                                                                action="{{ route('products.unavailable', $product->id) }}"
                                                                method="POST" class="inline" x-data="formSubmit"
                                                                @submit.prevent="submit">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" x-ref="btn"
                                                                    class="px-2 py-1 cursor-pointer bg-red-600 text-gray-200 border-gray-300 decoration-none rounded hover:bg-red-700">
                                                                    Mark Unavailable
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                        </path>
                                                    </svg>
                                                    <p class="text-gray-500 text-lg font-medium">No products found</p>
                                                    <p class="text-gray-400 text-sm mt-1">Start by adding your first
                                                        product</p>
                                                    <a href="{{ route('products.create') }}"
                                                        class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                                        Add Product
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Cards for mobile view -->
                        <div class="md:hidden">
                            @forelse($products as $product)
                                <div class="border-b border-gray-200 p-4">
                                    <div class="flex items-start">
                                        <div
                                            class="w-16 h-16 mr-3 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center flex-shrink-0">
                                            @if (!empty($product->images) && isset($product->images[0]))
                                                <img class="w-full h-full object-cover"
                                                    src="{{ asset('storage/' . $product->images[0]) }}"
                                                    alt="{{ $product->product_name }}">
                                            @else
                                                <svg class="w-8 h-8 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-sm font-medium text-gray-900">
                                                    {{ $product->product_name }}</h3>
                                                @if ($product->status === 'available')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                                                @elseif($product->status === 'unavailable')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Unavailable</span>
                                                @elseif($product->status === 'featured')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Featured</span>
                                                @else
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Disabled</span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-500 mt-1">{{ $product->category->category }}
                                            </p>
                                            <div class="flex mt-2 text-sm text-gray-500">
                                                <div class="mr-4">
                                                    <span class="font-medium">Price:</span>
                                                    {{ $product->currency }}{{ number_format($product->price, 2) }}
                                                </div>
                                                <div>
                                                    <span class="font-medium">Qty:</span>
                                                    {{ number_format($product->quantity_available, 0) }}
                                                </div>
                                            </div>
                                            <div class="mt-3 flex flex-wrap gap-2 text-sm">
                                                <!-- View Product -->
                                                    <a href="{{ route('products.single', $product->slug) }}"
                                                        class="px-2 py-1 cursor-pointer bg-gray-500 text-gray-200 decoration-none rounded hover:bg-gray-600">
                                                        View
                                                    </a>
                                                    @if (auth()->user()->id === $product->user_id || auth()->user()->role === 'admin')
                                                        <!-- Edit Product -->
                                                        <a href="{{ route('products.edit', $product->slug) }}"
                                                            class="px-2 py-1 cursor-pointer bg-green-600 text-gray-200 decoration-none rounded hover:bg-green-700">
                                                            Edit
                                                        </a>

                                                        <!-- Activate / Deactivate Buttons -->
                                                        @if ($product->status === 'available')
                                                            <form
                                                                action="{{ route('products.deactivate', $product->id) }}"
                                                                method="POST" class="inline" x-data="formSubmit"
                                                                @submit.prevent="submit">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" x-ref="btn"
                                                                    class="px-2 py-1 cursor-pointer bg-yellow-500 text-gray-200 decoration-none rounded hover:bg-yellow-600">
                                                                    Deactivate
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('products.activate', $product->id) }}"
                                                                method="POST" class="inline" x-data="formSubmit"
                                                                @submit.prevent="submit">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" x-ref="btn"
                                                                    class="px-2 py-1 cursor-pointer bg-blue-500 text-gray-200 decoration-none rounded hover:bg-blue-600">
                                                                    Activate
                                                                </button>
                                                            </form>
                                                        @endif

                                                        <!-- Mark Unavailable Button -->
                                                        @if ($product->status === 'available')
                                                            <form
                                                                action="{{ route('products.unavailable', $product->id) }}"
                                                                method="POST" class="inline" x-data="formSubmit"
                                                                @submit.prevent="submit">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" x-ref="btn"
                                                                    class="px-2 py-1 cursor-pointer bg-red-600 text-gray-200 border-gray-300 decoration-none rounded hover:bg-red-700">
                                                                    Mark Unavailable
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4 mx-auto" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">No products found</p>
                                    <p class="text-gray-400 text-sm mt-1">Start by adding your first product</p>
                                    <a href="{{ route('products.create') }}"
                                        class="mt-4 inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                        Add Product
                                    </a>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if ($products->hasPages())
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </main>
</x-boilerplate>
