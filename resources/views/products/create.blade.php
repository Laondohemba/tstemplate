<x-boilerplate>
    <x-vendorsidebar></x-vendorsidebar>

    <!-- Main Content -->
    <div class="lg:ml-60">
       
    <x-vendornavbar></x-vendornavbar>

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 max-w-4xl min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Add New Product</h1>
                    <p class="text-green-600 mt-2">Fill in the details to list your product on TradeSource360.</p>
                </div>

                <!-- Progress Bar -->
                <div class="px-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700" id="stepText">Step 1 of 3</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div id="progressBar" class="bg-gray-800 h-2.5 rounded-full transition-all duration-500"
                            style="width: 33.33%"></div>
                    </div>

                    <span class="text-xl mt-6 block mb-1 font-[600] text-gray-700" id="stepTitle">Basic
                        Information</span>
                </div>

                <!-- Form Container -->
                <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                    <form id="productForm" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" x-data="formSubmit" @submit.prevent="submit">
                        @csrf
                        
                        <!-- Step 1: Basic Information -->
                        <div id="step1" class="step-content">
                            <div class="space-y-6">
                                <!-- Product Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="product_name" value="{{ old('product_name') }}"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="Enter product name">
                                    @error('product_name')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Product Category -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Category <span class="text-red-500">*</span></label>
                                    <select name="category_id"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors">
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Sales Type -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Sales Type <span class="text-red-500">*</span></label>
                                    <select name="sales_type"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors">
                                        <option value="">Select</option>
                                        <option value="wholesale" {{ old('sales_type') == 'wholesale' ? 'selected' : '' }}>Wholesale</option>
                                        <option value="retail" {{ old('sales_type') == 'retail' ? 'selected' : '' }}>Retail</option>
                                        <option value="both retail and wholesale" {{ old('sales_type') == 'both retail and wholesale' ? 'selected' : '' }}>Both wholesale and retail</option>
                                    </select>
                                    @error('sales_type')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Organic / Non-Organic -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Sales Niche <span class="text-red-500">*</span></label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="sales_niche" value="organic" {{ old('sales_niche') == 'organic' ? 'checked' : '' }}
                                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                            <span class="ml-2 text-gray-700">Organic</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="sales_niche" value="inorganic" {{ old('sales_niche') == 'inorganic' ? 'checked' : '' }}
                                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                            <span class="ml-2 text-gray-700">Inorganic</span>
                                        </label>
                                    </div>
                                    @error('sales_niche')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Pricing & Quantity -->
                        <div id="step2" class="step-content hidden">
                            <div class="space-y-6">
                                <!-- Price per unit -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Price per unit (kg/ton) <span class="text-red-500">*</span></label>
                                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="Enter price per unit">
                                    @error('price')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- CURRENCY -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Currency <span class="text-red-500">*</span></label>
                                    <select name="currency"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors">
                                        <option value="">Select</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency['sign'] }}" {{ old('currency') == $currency['sign'] ? 'selected' : '' }}>
                                                {{ $currency['name'] }} {{ $currency['sign'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('currency')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Quantity available -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity available <span class="text-red-500">*</span></label>
                                    <input type="number" name="quantity_available" value="{{ old('quantity_available') }}" min="0"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="Enter quantity">
                                    @error('quantity_available')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Location-->
                                <div class="pt-4 border-t border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Location</h3>

                                    <!-- Origin Location -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Location <span class="text-red-500">*</span></label>
                                        <input type="text" name="location" value="{{ old('location') }}"
                                            class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Enter location">
                                        @error('location')
                                            <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Shipping-->
                                <div class="pt-4 border-t border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping <span class="text-red-500">*</span></h3>

                                    <!-- Shipping Options -->
                                    <div class="space-y-3">
                                        <label class="flex items-center">
                                            <input type="radio" name="shipping" value="local" {{ old('shipping') == 'local' ? 'checked' : '' }}
                                                class="h-4 w-4 text-green-600 focus:ring-green-200 border-gray-300 rounded">
                                            <span class="ml-2 text-gray-700">Local Delivery</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="shipping" value="international" {{ old('shipping') == 'international' ? 'checked' : '' }}
                                                class="h-4 w-4 text-green-600 focus:ring-green-200 border-gray-300 rounded">
                                            <span class="ml-2 text-gray-700">International Shipping</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="shipping" value="both local and international" {{ old('shipping') == 'both local and international' ? 'checked' : '' }}
                                                class="h-4 w-4 text-green-600 focus:ring-green-200 border-gray-300 rounded">
                                            <span class="ml-2 text-gray-700">Both Local & International</span>
                                        </label>
                                    </div>
                                    @error('shipping')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Product Media & Description -->
                        <div id="step3" class="step-content hidden">
                            <div class="space-y-6">
                                <!-- Upload Photos -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Upload 3-5 photos <span class="text-red-500">*</span> <span class="text-gray-500 text-xs">(Max 5MB per image)</span></label>
                                    <div id="dragDropArea"
                                        class="drag-drop-area border-2 border-dashed border-green-100 rounded-lg p-8 text-center cursor-pointer transition-colors hover:border-green-300">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-gray-600 mb-2">Drag and drop or browse to upload</p>
                                            <button type="button"
                                                class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                                Upload Photos
                                            </button>
                                        </div>
                                        <input type="file" id="fileInput" name="images[]" class="hidden" multiple accept="image/*">
                                    </div>
                                    <div id="uploadedFiles" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4 hidden">
                                        <!-- Uploaded files preview will appear here -->
                                    </div>
                                    @error('images')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                    @error('images.*')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Product Video -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Product video upload link (YouTube/Vimeo URL)</label>
                                    <input type="url" name="video_url" value="{{ old('video_url') }}"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="Enter video link">
                                    @error('video_url')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Description & Specs -->
                                <div class="pt-4 border-t border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Description & Specs</h3>

                                    <!-- Short Description -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Short product description <span class="text-red-500">*</span></label>
                                        <textarea name="description"
                                            class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            rows="3" placeholder="Enter a brief description of your product">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Specifications -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Specifications (weight, grade, packaging type, harvest date) <span class="text-red-500">*</span></label>
                                        <textarea name="specifications"
                                            class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            rows="4" placeholder="Enter specifications">{{ old('specifications') }}</textarea>
                                        @error('specifications')
                                            <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                            <button type="button" id="prevBtn"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors hidden">
                                Previous
                            </button>
                            <button type="button" id="nextBtn"
                                class="ml-auto px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                Next
                            </button>
                            <button type="submit" id="submitBtn" x-ref="btn"
                                class="ml-auto px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors hidden">
                                Publish Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>