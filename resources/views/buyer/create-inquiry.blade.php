<x-boilerplate>
    <x-buyersidebar></x-buyersidebar>

    <!-- Main Content -->
    <div class="lg:ml-60">
        <x-buyernavbar></x-buyernavbar>

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 max-w-4xl min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Send Inquiry</h1>
                    <p class="text-gray-600 mt-2">Contact suppliers about products or services</p>
                </div>

                <!-- Form Container -->
                <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                    <form method="POST" action="{{ route('inquiries.store') }}">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Vendor Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Vendor <span class="text-red-500">*</span></label>
                                <select name="vendor_id" required
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors">
                                    <option value="">Select a vendor</option>
                                    @if(isset($vendor))
                                        <option value="{{ $vendor->id }}" selected>{{ $vendor->name }}</option>
                                    @else
                                        @foreach(\App\Models\User::where('role', 'vendor')->get() as $vendorOption)
                                            <option value="{{ $vendorOption->id }}" {{ old('vendor_id') == $vendorOption->id ? 'selected' : '' }}>
                                                {{ $vendorOption->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('vendor_id')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Product Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product (Optional)</label>
                                <select name="product_id"
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors">
                                    <option value="">Select a product (optional)</option>
                                    @if(isset($product))
                                        <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                                    @else
                                        @foreach(\App\Models\Product::where('status', 'active')->get() as $productOption)
                                            <option value="{{ $productOption->id }}" {{ old('product_id') == $productOption->id ? 'selected' : '' }}>
                                                {{ $productOption->name }} - {{ $productOption->user->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('product_id')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Subject -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subject <span class="text-red-500">*</span></label>
                                <input type="text" name="subject" value="{{ old('subject') }}" required
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                    placeholder="Brief description of your inquiry">
                                @error('subject')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                                <select name="priority"
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors">
                                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                                @error('priority')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Message <span class="text-red-500">*</span></label>
                                <textarea name="message" required rows="6"
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                    placeholder="Describe your inquiry in detail. Include any specific requirements, quantities, or questions you have.">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
                            <div class="flex space-x-4">
                                <a href="{{ route('buyer.inquiries') }}" 
                                   class="px-6 py-3 bg-gray-500 text-white rounded-lg font-medium hover:bg-gray-600 transition-colors">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                    <i class="fas fa-paper-plane mr-2"></i>Send Inquiry
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>
