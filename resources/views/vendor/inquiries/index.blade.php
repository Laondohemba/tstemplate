<x-boilerplate>
    <x-vendorsidebar></x-vendorsidebar>

    <!-- Main Content -->
    <div class="lg:ml-60">
        <x-vendornavbar></x-vendornavbar>

        <!-- Page Content -->
        <main class="pt-16 p-4">
            <div class="container mx-auto bg-gray-50 py-4 min-h-screen">
                <!-- Header -->
                <div class="mb-6 px-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Vendor Inquiries</h1>
                            <p class="text-gray-600 mt-2">Manage inquiries from potential customers</p>
                        </div>
                    </div>
                </div>

                <!-- Inquiries List -->
                <div class="px-4">
                    @if($inquiries->count() > 0)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($inquiries as $inquiry)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                                            <span class="text-sm font-medium text-gray-600">
                                                                {{ substr($inquiry->user->name, 0, 1) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">{{ $inquiry->user->name }}</div>
                                                            <div class="text-sm text-gray-500">{{ $inquiry->user->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $inquiry->subject }}</div>
                                                    <div class="text-sm text-gray-500">{{ Str::limit($inquiry->message, 50) }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($inquiry->product)
                                                        <div class="text-sm text-gray-900">{{ $inquiry->product->product_name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $inquiry->product->category->category }}</div>
                                                    @else
                                                        <span class="text-sm text-gray-500">General Inquiry</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                                        @if($inquiry->status === 'responded') bg-green-100 text-green-800
                                                        @elseif($inquiry->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                        {{ ucfirst($inquiry->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $inquiry->created_at->format('M d, Y') }}
                                                    <div class="text-xs">{{ $inquiry->created_at->diffForHumans() }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('inquiries.show', $inquiry->id) }}" 
                                                           class="text-green-600 hover:text-green-900">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        @if($inquiry->status === 'pending')
                                                            <button onclick="respondToInquiry({{ $inquiry->id }})" 
                                                                    class="text-blue-600 hover:text-blue-900">
                                                                <i class="fas fa-reply"></i>
                                                            </button>
                                                        @endif
                                                        <button onclick="closeInquiry({{ $inquiry->id }})" 
                                                                class="text-gray-600 hover:text-gray-900">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $inquiries->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-envelope text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">No Inquiries Yet</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                You haven't received any inquiries yet. Once customers start asking about your products, they'll appear here.
                            </p>
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('products.create') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Add Products
                                </a>
                                <a href="{{ route('user.dashboard') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg font-medium hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-home mr-2"></i>Back to Dashboard
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</x-boilerplate>

<script>
function respondToInquiry(inquiryId) {
    // Redirect to inquiry show page where they can respond
    window.location.href = `/dashboard/inquiries/${inquiryId}`;
}

function closeInquiry(inquiryId) {
    if (confirm('Are you sure you want to close this inquiry?')) {
        fetch(`/dashboard/inquiries/${inquiryId}/close`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
</script>
