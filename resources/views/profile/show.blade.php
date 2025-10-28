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
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Profile & Settings</h1>
                            <p class="text-gray-600 mt-2">Manage your account information and preferences</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                            <i class="fas fa-edit mr-2"></i>Edit Profile
                        </a>
                    </div>
                </div>

                <!-- Profile Information -->
                <div class="px-4">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6">
                            <!-- Profile Header -->
                            <div class="flex items-start space-x-6 mb-8">
                                <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center">
                                    @if($user->logo)
                                        <img src="{{ Storage::url($user->logo) }}" alt="Profile" class="w-24 h-24 rounded-full object-cover">
                                    @else
                                        <span class="text-2xl font-bold text-gray-600">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                                    <p class="text-gray-600">{{ $user->email }}</p>
                                    <div class="flex items-center mt-2">
                                        <span class="px-3 py-1 text-sm font-medium rounded-full
                                            @if($user->role === 'buyer') bg-blue-100 text-blue-800
                                            @elseif($user->role === 'vendor') bg-green-100 text-green-800
                                            @elseif($user->role === 'service_provider') bg-purple-100 text-purple-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                        @if($user->verification_status === 'verified')
                                            <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>Verified
                                            </span>
                                        @elseif($user->verification_status === 'pending')
                                            <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>Pending Verification
                                            </span>
                                        @else
                                            <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                <i class="fas fa-times-circle mr-1"></i>Not Verified
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Personal Information -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Full Name</label>
                                            <p class="text-gray-900">{{ $user->name }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Email Address</label>
                                            <p class="text-gray-900">{{ $user->email }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Phone Number</label>
                                            <p class="text-gray-900">{{ $user->phone ?? 'Not provided' }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Location</label>
                                            <p class="text-gray-900">{{ $user->location ?? 'Not provided' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Information (for vendors and service providers) -->
                                @if(in_array($user->role, ['vendor', 'service_provider']))
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Business Information</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Business Name</label>
                                            <p class="text-gray-900">{{ $user->business_name ?? 'Not provided' }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Business Type</label>
                                            <p class="text-gray-900">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</p>
                                        </div>
                                        @if($user->role === 'service_provider')
                                            <div>
                                                <label class="text-sm font-medium text-gray-500">Service Category</label>
                                                <p class="text-gray-900">{{ $user->serviceCategory->name ?? 'Not specified' }}</p>
                                            </div>
                                        @endif
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Member Since</label>
                                            <p class="text-gray-900">{{ $user->created_at->format('F j, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Account Information -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">User ID</label>
                                            <p class="text-gray-900 font-mono text-sm">{{ $user->id }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Account Created</label>
                                            <p class="text-gray-900">{{ $user->created_at->format('F j, Y \a\t g:i A') }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Last Updated</label>
                                            <p class="text-gray-900">{{ $user->updated_at->format('F j, Y \a\t g:i A') }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Email Verified</label>
                                            <p class="text-gray-900">
                                                @if($user->email_verified_at)
                                                    <span class="text-green-600">
                                                        <i class="fas fa-check-circle mr-1"></i>Verified on {{ $user->email_verified_at->format('F j, Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-red-600">
                                                        <i class="fas fa-times-circle mr-1"></i>Not verified
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Statistics (for vendors and service providers) -->
                                @if(in_array($user->role, ['vendor', 'service_provider']))
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Statistics</h3>
                                    <div class="space-y-3">
                                        @if($user->role === 'vendor')
                                            <div>
                                                <label class="text-sm font-medium text-gray-500">Total Products</label>
                                                <p class="text-gray-900">{{ $user->products()->count() }}</p>
                                            </div>
                                            <div>
                                                <label class="text-sm font-medium text-gray-500">Active Products</label>
                                                <p class="text-gray-900">{{ $user->products()->where('status', 'available')->count() }}</p>
                                            </div>
                                        @elseif($user->role === 'service_provider')
                                            <div>
                                                <label class="text-sm font-medium text-gray-500">Total Services</label>
                                                <p class="text-gray-900">{{ $user->services()->count() }}</p>
                                            </div>
                                            <div>
                                                <label class="text-sm font-medium text-gray-500">Active Services</label>
                                                <p class="text-gray-900">{{ $user->services()->where('status', 'active')->count() }}</p>
                                            </div>
                                        @endif
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Total Orders</label>
                                            <p class="text-gray-900">{{ \App\Models\Order::where('vendor_id', $user->id)->count() }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Total Inquiries</label>
                                            <p class="text-gray-900">{{ \App\Models\Inquiry::where('recipient_id', $user->id)->count() }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <div class="flex flex-wrap gap-4">
                                    <a href="{{ route('profile.edit') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                        <i class="fas fa-edit mr-2"></i>Edit Profile
                                    </a>
                                    <a href="{{ route('profile.password') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-key mr-2"></i>Change Password
                                    </a>
                                    @if($user->verification_status !== 'verified')
                                        <a href="{{ route('profile.verification') }}" 
                                           class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 transition-colors">
                                            <i class="fas fa-certificate mr-2"></i>Verify Account
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>
