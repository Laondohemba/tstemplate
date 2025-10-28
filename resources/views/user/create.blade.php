<x-boilerplate>
    <div class="min-h-screen bg-gray-50 py-[3%] px-[8%]">
        <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md">
            <div class="text-center flex flex-col items-center mb-4">
                <h1 class="md:text-[1.8rem] text-[1.6rem] font-[600] text-[#000000]">
                    Create Your Account
                </h1>
                <p class="text-[#404040] md:text-[.9rem] text-[.8rem] font-[400]">
                    Join TradeSource360 to buy, sell, or export quality goods.
                </p>
            </div>

            <form id="signupForm" method="POST" action="{{ route('user.store') }}" x-data="formSubmit" @submit.prevent="submit">
                @csrf
                <input type="hidden" name="role" id="userRole" value="{{ old('role', $preSelectedRole ?? 'buyer') }}">

                <!-- Role Switch -->
                <div class="mb-6">
                    <div class="flex md:mx-10 space-x-2 py-1 px-2 rounded-lg bg-[#E8F2E8]">
                        <button type="button" id="buyerBtn" class="flex-1 py-1 rounded-md bg-[#FAFCF7]">
                            Buyer
                        </button>
                        <button type="button" id="vendorBtn" class="flex-1 py-1 rounded-md">
                            Vendor
                        </button>
                        <button type="button" id="serviceProviderBtn" class="flex-1 py-1 rounded-md">
                            Service Provider
                        </button>
                    </div>
                </div>

                <!-- Buyer Form -->
                <div id="buyerForm" class="">
                    <!-- Full Name -->
                    <div class="mb-4">
                        <label for="buyerFullName" class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="buyerFullName" name="buyer_name" placeholder="Full Name"
                            value="{{ old('buyer_name') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('buyer_name')
                            <span id="buyerFullNameError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="buyerEmail" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="buyerEmail" name="buyer_email" placeholder="Email"
                            value="{{ old('buyer_email') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('buyer_email')
                            <span id="buyerEmailError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="buyerPhone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="buyerPhone" name="buyer_phone" placeholder="Phone Number"
                            value="{{ old('buyer_phone') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('buyer_phone')
                            <span id="buyerPhoneError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-4">
                        <label for="buyerLocation" class="block text-sm font-medium text-gray-700 mb-2">
                            Location <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="buyerLocation" name="buyer_location" placeholder="Location"
                            value="{{ old('buyer_location') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('buyer_location')
                            <span id="buyerLocationError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="buyerPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="buyerPassword" name="buyer_password" placeholder="Password"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('buyer_password')
                            <span id="buyerPasswordError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="buyerConfirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="buyerConfirmPassword" name="buyer_password_confirmation"
                            placeholder="Confirm Password"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('buyer_password_confirmation')
                            <span id="buyerConfirmPasswordError"
                                class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vendor Form -->
                <div id="vendorForm" class="hidden">
                    <!-- Business Name -->
                    <div class="mb-4">
                        <label for="vendorBusinessName" class="block text-sm font-medium text-gray-700 mb-2">
                            Business Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="vendorBusinessName" name="business_name" placeholder="Business Name"
                            value="{{ old('business_name') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('business_name')
                            <span id="vendorBusinessNameError"
                                class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Contact Person Name -->
                    <div class="mb-4">
                        <label for="vendorContactPersonName" class="block text-sm font-medium text-gray-700 mb-2">
                            Contact Person Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="vendorContactPersonName" name="contactPersonName"
                            placeholder="Vendor Name" value="{{ old('contactPersonName') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('contactPersonName')
                            <span id="vendorContactPersonNameError"
                                class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="vendorEmail" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="vendorEmail" name="vendor_email" placeholder="Email"
                            value="{{ old('vendor_email') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('vendor_email')
                            <span id="vendorEmailError"
                                class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="vendorPhone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="vendorPhone" name="vendor_phone" placeholder="Phone Number"
                            value="{{ old('vendor_phone') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('vendor_phone')
                            <span id="vendorPhoneError"
                                class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-4">
                        <label for="vendorLocation" class="block text-sm font-medium text-gray-700 mb-2">
                            Location (State) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="vendorLocation" name="vendor_location" placeholder="Location"
                            value="{{ old('vendor_location') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('vendor_location')
                            <span id="vendorLocationError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="vendorPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="vendorPassword" name="vendor_password" placeholder="Password"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('vendor_password')
                            <span id="vendorPasswordError"
                                class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="vendorConfirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="vendorConfirmPassword" name="vendor_password_confirmation"
                            placeholder="Confirm Password"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('vendor_password_confirmation')
                            <span id="vendorConfirmPasswordError"
                                class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Service Provider Form -->
                <div id="serviceProviderForm" class="hidden">
                    <!-- Company Name -->
                    <div class="mb-4">
                        <label for="spCompanyName" class="block text-sm font-medium text-gray-700 mb-2">
                            Company Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="spCompanyName" name="sp_company_name" placeholder="Company Name"
                            value="{{ old('sp_company_name') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('sp_company_name')
                            <span id="spCompanyNameError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Contact Person Name -->
                    <div class="mb-4">
                        <label for="spContactPersonName" class="block text-sm font-medium text-gray-700 mb-2">
                            Contact Person Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="spContactPersonName" name="sp_contact_person_name"
                            placeholder="Contact Person Name" value="{{ old('sp_contact_person_name') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('sp_contact_person_name')
                            <span id="spContactPersonNameError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="spEmail" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="spEmail" name="sp_email" placeholder="Email"
                            value="{{ old('sp_email') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('sp_email')
                            <span id="spEmailError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="spPhone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="spPhone" name="sp_phone" placeholder="Phone Number"
                            value="{{ old('sp_phone') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('sp_phone')
                            <span id="spPhoneError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-4">
                        <label for="spLocation" class="block text-sm font-medium text-gray-700 mb-2">
                            Location (State) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="spLocation" name="sp_location" placeholder="Location"
                            value="{{ old('sp_location') }}"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('sp_location')
                            <span id="spLocationError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Service Category -->
                    <div class="mb-4">
                        <label for="spServiceCategory" class="block text-sm font-medium text-gray-700 mb-2">
                            Service Category <span class="text-red-500">*</span>
                        </label>
                        <select id="spServiceCategory" name="sp_service_category"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors">
                            <option value="">Select Service Category</option>
                            @foreach(\App\Models\ServiceCategory::where('is_active', true)->get() as $category)
                                <option value="{{ $category->id }}" {{ old('sp_service_category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('sp_service_category')
                            <span id="spServiceCategoryError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="spPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="spPassword" name="sp_password" placeholder="Password"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('sp_password')
                            <span id="spPasswordError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="spConfirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="spConfirmPassword" name="sp_password_confirmation"
                            placeholder="Confirm Password"
                            class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                        @error('sp_password_confirmation')
                            <span id="spConfirmPasswordError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit" id="signupBtn" x-ref="btn"
                        class="w-full bg-green-700 hover:bg-green-600 text-white font-[600] py-2 px-4 rounded-md transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        <span id="btnText">Create Account</span>
                    </button>
                </div>

                <!-- Login Link -->
                <p class="text-center text-[.9rem] text-[#808080] mt-4">
                    Already have an account? <a href="{{route('login')}}" class="text-green-700 hover:underline">Log in</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        // Form state
        let currentRole = 'buyer';
        let loading = false;

        // Form data objects
        let buyerFormData = {
            fullName: '',
            email: '',
            phone: '',
            password: '',
            location: ''
        };

        let vendorFormData = {
            businessName: '',
            contactPersonName: '',
            email: '',
            phone: '',
            password: '',
            confirmPassword: '',
            location: ''
        };

        // DOM elements
        const buyerBtn = document.getElementById('buyerBtn');
        const vendorBtn = document.getElementById('vendorBtn');
        const serviceProviderBtn = document.getElementById('serviceProviderBtn');
        const buyerForm = document.getElementById('buyerForm');
        const vendorForm = document.getElementById('vendorForm');
        const serviceProviderForm = document.getElementById('serviceProviderForm');
        const form = document.getElementById('signupForm');
        const signupBtn = document.getElementById('signupBtn');
        const btnText = document.getElementById('btnText');
        const errorMessage = document.getElementById('errorMessage');
        const successMessage = document.getElementById('successMessage');
        const errorText = document.getElementById('errorText');
        const successText = document.getElementById('successText');

        function showMessage(type, message) {
            const messageElement = type === 'error' ? errorMessage : successMessage;
            const textElement = type === 'error' ? errorText : successText;

            textElement.textContent = message;
            messageElement.classList.remove('hidden');
            // Hide the other message type
            const otherMessage = type === 'error' ? successMessage : errorMessage;
            otherMessage.classList.add('hidden');
        }

        function hideMessages() {
            errorMessage.classList.add('hidden');
            successMessage.classList.add('hidden');
        }

        // Loading state functions
        function setLoading(isLoading) {
            loading = isLoading;
            if (isLoading) {
                btnText.textContent = 'Processing...';
                signupBtn.disabled = true;
                signupBtn.classList.add('opacity-75', 'cursor-not-allowed');
            } else {
                btnText.textContent = currentRole === 'buyer' ? 'Create Account' : 'Sign Up as Vendor';
                signupBtn.disabled = false;
                signupBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        }

        function switchRole(role) {
            currentRole = role;

            // 🔑 Update the hidden input so the backend gets the correct value
            document.getElementById('userRole').value = role;

            // Reset all button states
            buyerBtn.classList.remove('bg-[#FAFCF7]');
            vendorBtn.classList.remove('bg-[#FAFCF7]');
            serviceProviderBtn.classList.remove('bg-[#FAFCF7]');
            
            // Hide all forms
            buyerForm.classList.add('hidden');
            vendorForm.classList.add('hidden');
            serviceProviderForm.classList.add('hidden');

            // Update button states and show appropriate form
            if (role === 'buyer') {
                buyerBtn.classList.add('bg-[#FAFCF7]');
                buyerForm.classList.remove('hidden');
                btnText.textContent = 'Create Account';
            } else if (role === 'vendor') {
                vendorBtn.classList.add('bg-[#FAFCF7]');
                vendorForm.classList.remove('hidden');
                btnText.textContent = 'Sign Up as Vendor';
            } else if (role === 'service_provider') {
                serviceProviderBtn.classList.add('bg-[#FAFCF7]');
                serviceProviderForm.classList.remove('hidden');
                btnText.textContent = 'Sign Up as Service Provider';
            }

            hideMessages();
        }

document.addEventListener('DOMContentLoaded', function () {
    const oldRole = document.getElementById('userRole').value || 'buyer';
    switchRole(oldRole);
    if (oldRole === 'buyer') {
        document.getElementById('buyerFullName').focus();
    } else if (oldRole === 'vendor') {
        document.getElementById('vendorBusinessName').focus();
    } else if (oldRole === 'service_provider') {
        document.getElementById('spCompanyName').focus();
    }
});


        // Event listeners
        buyerBtn.addEventListener('click', () => switchRole('buyer'));
        vendorBtn.addEventListener('click', () => switchRole('vendor'));
        serviceProviderBtn.addEventListener('click', () => switchRole('service_provider'));


    </script>
</x-boilerplate>
