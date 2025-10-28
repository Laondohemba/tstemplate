<x-boilerplate>
    @if(Auth::user()->role === 'buyer')
        <x-buyersidebar></x-buyersidebar>
    @elseif(Auth::user()->role === 'vendor')
        <x-vendorsidebar></x-vendorsidebar>
    @elseif(Auth::user()->role === 'service_provider')
        <x-serviceprovidersidebar></x-serviceprovidersidebar>
    @endif

    <!-- Main Content -->
    <div class="lg:ml-60">
        @if(Auth::user()->role === 'buyer')
            <x-buyernavbar></x-buyernavbar>
        @elseif(Auth::user()->role === 'vendor')
            <x-vendornavbar></x-vendornavbar>
        @elseif(Auth::user()->role === 'service_provider')
            <x-serviceprovidernavbar></x-serviceprovidernavbar>
        @endif

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Inquiry Details</h1>
                            <p class="text-gray-600 mt-2">View and manage inquiry details</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if(Auth::user()->role === 'buyer')
                                <a href="{{ route('buyer.inquiries') }}" 
                                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to Inquiries
                                </a>
                            @elseif(Auth::user()->role === 'vendor')
                                <a href="{{ route('vendor.inquiries') }}" 
                                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to Inquiries
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Inquiry Details -->
                <div class="px-4">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <!-- Inquiry Header -->
                        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-xl font-bold text-white">{{ $inquiry->subject }}</h2>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="px-3 py-1 bg-white bg-opacity-20 text-white rounded-full text-sm">
                                            <i class="fas fa-tag mr-1"></i>{{ ucfirst($inquiry->priority) }} Priority
                                        </span>
                                        <span class="px-3 py-1 bg-white bg-opacity-20 text-white rounded-full text-sm
                                            @if($inquiry->status === 'responded') bg-green-500
                                            @elseif($inquiry->status === 'pending') bg-yellow-500
                                            @else bg-gray-500 @endif">
                                            <i class="fas fa-circle mr-1"></i>{{ ucfirst($inquiry->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right text-white">
                                    <p class="text-sm opacity-90">Created</p>
                                    <p class="font-medium">{{ $inquiry->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Response Form (Hidden by default) -->
                        <div id="responseForm" class="hidden bg-gray-50 px-6 py-4 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Send Response</h3>
                            <form id="inquiryResponseForm">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Your Response</label>
                                    <textarea name="response" rows="4" 
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                              placeholder="Type your response to the inquiry..."
                                              required></textarea>
                                </div>
                                <div class="flex justify-end space-x-3">
                                    <button type="button" onclick="hideResponseForm()" 
                                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                        Cancel
                                    </button>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        <i class="fas fa-paper-plane mr-2"></i>Send Response
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Inquiry Content -->
                        <div class="p-6">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Main Content -->
                                <div class="lg:col-span-2">
                                    <!-- Message -->
                                    <div class="mb-6">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Message</h3>
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <p class="text-gray-700 whitespace-pre-wrap">{{ $inquiry->message }}</p>
                                        </div>
                                    </div>

                                    <!-- Product Details (if applicable) -->
                                    @if($inquiry->product)
                                        <div class="mb-6">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Product Details</h3>
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                                                        @if($inquiry->product->images && count($inquiry->product->images) > 0)
                                                            <img src="{{ asset('storage/' . $inquiry->product->images[0]) }}" 
                                                                 alt="{{ $inquiry->product->product_name }}" 
                                                                 class="w-full h-full object-cover rounded-lg">
                                                        @else
                                                            <i class="fas fa-seedling text-green-600 text-2xl"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-gray-900">{{ $inquiry->product->product_name }}</h4>
                                                        <p class="text-sm text-gray-600">{{ Str::limit($inquiry->product->description, 100) }}</p>
                                                        <p class="text-sm font-medium text-green-600">₦{{ number_format($inquiry->product->price, 2) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Sidebar -->
                                <div class="space-y-6">
                                    <!-- Participants -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Participants</h3>
                                        <div class="space-y-3">
                                            <!-- Buyer -->
                                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">{{ $inquiry->buyer->name }}</p>
                                                    <p class="text-sm text-gray-600">Buyer</p>
                                                </div>
                                            </div>

                                            <!-- Vendor -->
                                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-store text-green-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">{{ $inquiry->vendor->name }}</p>
                                                    <p class="text-sm text-gray-600">Vendor</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    @if(Auth::user()->role === 'vendor' && $inquiry->status === 'pending')
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Actions</h3>
                                            <div class="space-y-2">
                                                <button onclick="showResponseForm({{ $inquiry->id }})" 
                                                        class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                                    <i class="fas fa-reply mr-2"></i>Respond to Inquiry
                                                </button>
                                                <button onclick="markAsResponded({{ $inquiry->id }})" 
                                                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                                    <i class="fas fa-check mr-2"></i>Mark as Responded
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Contact Actions -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Contact</h3>
                                        <div class="space-y-2">
                                            @if(Auth::user()->role === 'buyer')
                                                <a href="{{ route('chats.index') }}" 
                                                   class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-center">
                                                    <i class="fas fa-comments mr-2"></i>Start Chat
                                                </a>
                                            @else
                                                <a href="{{ route('chats.index') }}" 
                                                   class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-center">
                                                    <i class="fas fa-comments mr-2"></i>Chat with Buyer
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Inquiry Info -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Inquiry Info</h3>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">ID:</span>
                                                <span class="font-medium">#{{ $inquiry->id }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Created:</span>
                                                <span class="font-medium">{{ $inquiry->created_at->format('M d, Y') }}</span>
                                            </div>
                                            @if($inquiry->responded_at)
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Responded:</span>
                                                    <span class="font-medium">{{ $inquiry->responded_at->format('M d, Y') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>

<script>
function showResponseForm(inquiryId) {
    document.getElementById('responseForm').classList.remove('hidden');
    document.getElementById('responseForm').scrollIntoView({ behavior: 'smooth' });
}

function hideResponseForm() {
    document.getElementById('responseForm').classList.add('hidden');
    document.getElementById('inquiryResponseForm').reset();
}

function markAsResponded(inquiryId) {
    if (confirm('Are you sure you want to mark this inquiry as responded?')) {
        fetch(`/dashboard/inquiries/${inquiryId}/respond`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'mark_responded'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}

// Handle response form submission
document.addEventListener('DOMContentLoaded', function() {
    const responseForm = document.getElementById('inquiryResponseForm');
    if (responseForm) {
        responseForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const inquiryId = {{ $inquiry->id }};
            const response = formData.get('response');
            
            // Disable submit button to prevent double submission
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
            
            // First, mark inquiry as responded
            fetch(`/dashboard/inquiries/${inquiryId}/respond`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'mark_responded'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to chat with inquiry details
                    const chatUrl = `{{ route('chats.index') }}?inquiry_id=${inquiryId}&message=${encodeURIComponent(response)}&buyer_id={{ $inquiry->buyer_id }}`;
                    window.location.href = chatUrl;
                } else {
                    alert('Error: ' + data.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
});
</script>
