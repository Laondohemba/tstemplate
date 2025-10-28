<x-boilerplate>
    @if(auth()->user()->role === 'buyer')
        <x-buyersidebar></x-buyersidebar>
    @elseif(auth()->user()->role === 'vendor')
        <x-vendorsidebar></x-vendorsidebar>
    @elseif(auth()->user()->role === 'service_provider')
        <x-serviceprovidersidebar></x-serviceprovidersidebar>
    @endif

    <!-- Main Content -->
    <div class="lg:ml-60">
        @if(auth()->user()->role === 'buyer')
            <x-buyernavbar></x-buyernavbar>
        @elseif(auth()->user()->role === 'vendor')
            <x-vendornavbar></x-vendornavbar>
        @elseif(auth()->user()->role === 'service_provider')
            <x-serviceprovidernavbar></x-serviceprovidernavbar>
        @endif

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Edit Profile</h1>
                            <p class="text-gray-600 mt-2">Update your account information</p>
                        </div>
                        <a href="{{ route('profile.show') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg font-medium hover:bg-gray-700 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Profile
                        </a>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="px-4">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
                            @csrf
                            @method('PUT')

                            <!-- Profile Picture -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-4">Profile Picture</label>
                                <div class="flex items-center space-x-6">
                                    <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center">
                                        @if($user->logo)
                                            <img id="profilePreview" src="{{ Storage::url($user->logo) }}" alt="Profile" class="w-24 h-24 rounded-full object-cover">
                                        @else
                                            <span id="profileInitial" class="text-2xl font-bold text-gray-600">
                                                {{ substr($user->name, 0, 1) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div>
                                        <input type="file" id="logo" name="logo" accept="image/*" 
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                               onchange="previewImage(this)">
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF. Max size 2MB.</p>
                                        @error('logo')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600">
                                    @error('name')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600">
                                    @error('email')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone Number
                                    </label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600">
                                    @error('phone')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                        Location (State) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="location" name="location" value="{{ old('location', $user->location) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600">
                                    @error('location')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Business Information (for vendors and service providers) -->
                            @if(in_array($user->role, ['vendor', 'service_provider']))
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Business Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="business_name" class="block text-sm font-medium text-gray-700 mb-2">
                                            Business Name <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="business_name" name="business_name" value="{{ old('business_name', $user->business_name) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600">
                                        @error('business_name')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if($user->role === 'service_provider')
                                    <div>
                                        <label for="service_category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                            Service Category <span class="text-red-500">*</span>
                                        </label>
                                        <select id="service_category_id" name="service_category_id"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600">
                                            <option value="">Select Service Category</option>
                                            @foreach(\App\Models\ServiceCategory::where('is_active', true)->get() as $category)
                                                <option value="{{ $category->id }}" {{ old('service_category_id', $user->service_category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service_category_id')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('profile.show') }}" 
                                   class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                    <i class="fas fa-save mr-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('profilePreview');
            const initial = document.getElementById('profileInitial');
            
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            } else {
                // Create preview element if it doesn't exist
                const container = input.closest('.flex').querySelector('.w-24.h-24');
                container.innerHTML = `<img id="profilePreview" src="${e.target.result}" alt="Profile" class="w-24 h-24 rounded-full object-cover">`;
            }
            
            if (initial) {
                initial.style.display = 'none';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
