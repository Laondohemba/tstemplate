<x-boilerplate>
    @if(Auth::user()->role === 'service_provider')
        <x-serviceprovidersidebar></x-serviceprovidersidebar>
    @else
        <x-vendorsidebar></x-vendorsidebar>
    @endif

    <!-- Main Content -->
    <div class="lg:ml-60">
        @if(Auth::user()->role === 'service_provider')
            <x-serviceprovidernavbar></x-serviceprovidernavbar>
        @else
            <x-vendornavbar></x-vendornavbar>
        @endif

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 max-w-4xl min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Edit Service Provider Profile</h1>
                    <p class="text-green-600 mt-2">Update your service provider profile information.</p>
                </div>

                <!-- Form Container -->
                <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-800">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('services.update', $service->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Service Category -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Service Category <span class="text-red-500">*</span></label>
                                <select name="service_category_id" required
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors">
                                    <option value="">Select service category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('service_category_id', $service->service_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_category_id')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Company Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Name <span class="text-red-500">*</span></label>
                                <input type="text" name="company_name" value="{{ old('company_name', $service->company_name) }}" required
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                    placeholder="Enter your company name">
                                @error('company_name')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Service Description <span class="text-red-500">*</span></label>
                                <textarea name="description" required rows="4"
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                    placeholder="Describe your services in detail (minimum 10 characters)">{{ old('description', $service->description) }}</textarea>
                                @error('description')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Contact Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Person</label>
                                    <input type="text" name="contact_person" value="{{ old('contact_person', $service->contact_person) }}"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="Contact person name">
                                    @error('contact_person')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', $service->email) }}" required
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="company@example.com">
                                    @error('email')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone <span class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" value="{{ old('phone', $service->phone) }}" required
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="+234 800 000 0000">
                                    @error('phone')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                                    <input type="url" name="website" value="{{ old('website', $service->website) }}"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="https://www.example.com">
                                    @error('website')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Location Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Location <span class="text-red-500">*</span></label>
                                    <input type="text" name="location" value="{{ old('location', $service->location) }}" required
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="City, State, Country">
                                    @error('location')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Coverage Area</label>
                                    <input type="text" name="coverage_area" value="{{ old('coverage_area', $service->coverage_area) }}"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="Areas you serve">
                                    @error('coverage_area')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <textarea name="address" rows="3"
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                    placeholder="Full business address">{{ old('address', $service->address) }}</textarea>
                                @error('address')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Services Offered -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Services Offered <span class="text-red-500">*</span></label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.0', $service->services_offered[0] ?? '') }}" required
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 1 (e.g., Domestic Transportation)">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.1', $service->services_offered[1] ?? '') }}"
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 2 (e.g., International Shipping)">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.2', $service->services_offered[2] ?? '') }}"
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 3 (e.g., Customs Clearance)">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.3', $service->services_offered[3] ?? '') }}"
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 4 (optional)">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.4', $service->services_offered[4] ?? '') }}"
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 5 (optional)">
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Add at least one service. Leave empty fields blank.</p>
                                @error('services_offered')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Current Images -->
                            @if($service->images && count($service->images) > 0)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                        @foreach($service->images as $image)
                                            <div class="relative">
                                                <img src="{{ asset('storage/' . $image) }}" 
                                                     alt="Service image" 
                                                     class="w-full h-32 object-cover rounded-lg">
                                                <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                                    <span class="text-white text-sm">Current Image</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="text-sm text-gray-500 mt-2">Upload new images below to replace current ones.</p>
                                </div>
                            @endif

                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Service Images</label>
                                <div class="border-2 border-dashed border-green-300 rounded-lg p-6 text-center">
                                    <input type="file" name="images[]" multiple accept="image/*"
                                        class="hidden" id="image-upload">
                                    <label for="image-upload" class="cursor-pointer">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-green-600 mb-4"></i>
                                        <p class="text-lg font-medium text-gray-700 mb-2">Click to upload images</p>
                                        <p class="text-sm text-gray-500">PNG, JPG, GIF up to 5MB each (max 5 images)</p>
                                    </label>
                                </div>
                                @error('images')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="px-8 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                Update Service Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>

<script>
// Image upload preview
document.getElementById('image-upload').addEventListener('change', function(e) {
    const files = e.target.files;
    const container = e.target.parentElement;
    
    // Remove existing preview
    const existingPreview = container.querySelector('.image-preview');
    if (existingPreview) {
        existingPreview.remove();
    }
    
    if (files.length > 0) {
        const preview = document.createElement('div');
        preview.className = 'image-preview mt-4 grid grid-cols-2 md:grid-cols-3 gap-4';
        
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-32 object-cover rounded-lg';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
        
        container.appendChild(preview);
    }
});
</script>
