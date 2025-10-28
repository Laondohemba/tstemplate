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
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Add Service Provider Profile</h1>
                    <p class="text-green-600 mt-2">Create your service provider profile to connect with potential clients.</p>
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

                    <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Service Category -->
                            <div>
                                @if(isset($lockedCategory) && $lockedCategory)
                                    <input type="hidden" name="service_category_id" value="{{ $lockedCategory }}">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Service Category <span class="text-red-500">*</span></label>
                                    <input type="text" value="{{ $categories->first()->name }}" readonly
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                    <p class="mt-1 text-sm text-gray-600">Your service category is locked to your registration category.</p>
                                @else
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Service Category <span class="text-red-500">*</span></label>
                                    <select name="service_category_id" required
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors">
                                        <option value="">Select service category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('service_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_category_id')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                @endif
                            </div>

                            <!-- Company Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Name <span class="text-red-500">*</span></label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}" required
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
                                    placeholder="Describe your services in detail (minimum 10 characters)">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Contact Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Person</label>
                                    <input type="text" name="contact_person" value="{{ old('contact_person') }}"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="Contact person name">
                                    @error('contact_person')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="company@example.com">
                                    @error('email')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone <span class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="+234 800 000 0000">
                                    @error('phone')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                                    <input type="url" name="website" value="{{ old('website') }}"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="https://www.example.com">
                                    @error('website')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Location <span class="text-red-500">*</span></label>
                                    <input type="text" name="location" value="{{ old('location') }}" required
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="City, State (e.g., Lagos, Lagos State)">
                                    @error('location')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Coverage Area</label>
                                    <input type="text" name="coverage_area" value="{{ old('coverage_area') }}"
                                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                        placeholder="e.g., Nationwide, Lagos & Abuja">
                                    @error('coverage_area')
                                        <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <textarea name="address" rows="2"
                                    class="w-full px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                    placeholder="Full business address">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Services Offered -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Services Offered <span class="text-red-500">*</span></label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.0') }}" required
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 1 (e.g., Domestic Transportation)">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.1') }}"
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 2 (e.g., International Shipping)">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.2') }}"
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 3 (e.g., Customs Clearance)">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.3') }}"
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 4 (optional)">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="text" name="services_offered[]" value="{{ old('services_offered.4') }}"
                                            class="flex-1 px-4 py-3 border border-green-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-300 transition-colors"
                                            placeholder="Service 5 (optional)">
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Add at least one service. Leave empty fields blank.</p>
                                @error('services_offered')
                                    <span class="error-message text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Images -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Company Images <span class="text-gray-500 text-xs">(Optional, Max 5 images, 5MB each)</span></label>
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
                                            Upload Images
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
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="px-8 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                Create Service Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>

<script>
// Image upload functionality (reusing from product creation)
let uploadedFilesList = [];
const dragDropArea = document.getElementById("dragDropArea");
const fileInput = document.getElementById("fileInput");
const uploadedFiles = document.getElementById("uploadedFiles");

// Click to upload
dragDropArea.addEventListener("click", () => {
    fileInput.click();
});

// Handle file selection
fileInput.addEventListener("change", handleFileSelect);

// Drag and drop events
["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
    dragDropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

["dragenter", "dragover"].forEach((eventName) => {
    dragDropArea.addEventListener(eventName, highlight, false);
});

["dragleave", "drop"].forEach((eventName) => {
    dragDropArea.addEventListener(eventName, unhighlight, false);
});

function highlight() {
    dragDropArea.classList.add("border-green-500", "bg-green-50");
}

function unhighlight() {
    dragDropArea.classList.remove("border-green-500", "bg-green-50");
}

// Handle dropped files
dragDropArea.addEventListener("drop", handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    handleFiles(files);
}

// Handle file selection from input
function handleFileSelect(e) {
    const files = e.target.files;
    handleFiles(files);
}

// Validate file
function validateFile(file) {
    const maxSize = 5 * 1024 * 1024; // 5MB
    const allowedTypes = [
        "image/jpeg",
        "image/jpg",
        "image/png",
        "image/gif",
        "image/webp",
    ];

    if (!allowedTypes.includes(file.type)) {
        alert(`${file.name} is not a valid image format. Please upload JPEG, PNG, GIF, or WebP images.`);
        return false;
    }

    if (file.size > maxSize) {
        alert(`${file.name} is too large. Maximum file size is 5MB.`);
        return false;
    }

    return true;
}

// Process selected files
function handleFiles(files) {
    // Check if adding these files would exceed the limit
    const remainingSlots = 5 - uploadedFilesList.length;

    if (files.length > remainingSlots) {
        alert(`You can only upload ${remainingSlots} more image(s). Maximum is 5 images.`);
        return;
    }

    if (files.length > 0) {
        uploadedFiles.classList.remove("hidden");

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            // Validate file
            if (!validateFile(file)) {
                continue;
            }

            // Add to uploaded files list
            uploadedFilesList.push(file);

            // Create preview for images
            if (file.type.match("image.*")) {
                const reader = new FileReader();

                reader.onload = (function (theFile, fileIndex) {
                    return function (e) {
                        const preview = document.createElement("div");
                        preview.className = "relative group";
                        preview.dataset.fileIndex = uploadedFilesList.length - files.length + fileIndex;
                        preview.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg" alt="${theFile.name}">
                            <div class="absolute top-1 right-1 bg-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" class="remove-image bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="absolute bottom-1 left-1 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                ${(theFile.size / 1024 / 1024).toFixed(2)} MB
                            </div>
                        `;

                        // Add remove functionality
                        const removeBtn = preview.querySelector(".remove-image");
                        removeBtn.addEventListener("click", function (e) {
                            e.stopPropagation();
                            const fileIndex = parseInt(preview.dataset.fileIndex);
                            uploadedFilesList.splice(fileIndex, 1);
                            preview.remove();

                            // Update remaining preview indices
                            document.querySelectorAll("#uploadedFiles > div").forEach((div, idx) => {
                                div.dataset.fileIndex = idx;
                            });

                            if (uploadedFilesList.length === 0) {
                                uploadedFiles.classList.add("hidden");
                            }

                            // Update the file input with remaining files
                            updateFileInput();
                        });

                        uploadedFiles.appendChild(preview);
                    };
                })(file, i);

                reader.readAsDataURL(file);
            }
        }
        
        // Update the file input with all accumulated files
        updateFileInput();
    }
}

// Update file input with accumulated files
function updateFileInput() {
    // Create a new DataTransfer object to hold our files
    const dataTransfer = new DataTransfer();
    
    // Add all files from our array to the DataTransfer object
    uploadedFilesList.forEach(file => {
        dataTransfer.items.add(file);
    });
    
    // Update the file input with our accumulated files
    fileInput.files = dataTransfer.files;
}
</script>
