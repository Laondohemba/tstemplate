<x-boilerplate>

    @if (auth()->user()->role === 'buyer')
        <x-buyerchat :chats="$chats">
            <!-- Empty Chat Window -->
            <div class="flex-1 flex flex-col items-center justify-center bg-gray-50 w-full">
                <div class="text-center px-4">
                    <svg class="w-32 h-32 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome to Chat</h2>
                    <p class="text-gray-500 mb-6">Select a conversation from the left to start messaging</p>

                    @if ($chats->isEmpty())
                        <div class="bg-white rounded-lg p-6 shadow-sm max-w-md mx-auto">
                            <p class="text-gray-600 mb-4">You don't have any conversations yet. Start chatting with
                                vendors to inquire about products.</p>
                            <a href="{{ route('products.index') }}"
                                class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                Browse Products
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </x-buyerchat>
    @elseif (auth()->user()->role === 'vendor')
        <x-vendorchat :chats="$chats">
            <!-- Empty Chat Window -->
            <div class="flex-1 flex flex-col items-center justify-center bg-gray-50 w-full">
                <div class="text-center px-4">
                    <svg class="w-32 h-32 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome to Chat</h2>
                    <p class="text-gray-500 mb-6">Select a conversation from the left to start messaging</p>

                    @if ($chats->isEmpty())
                        <div class="bg-white rounded-lg p-6 shadow-sm max-w-md mx-auto">
                            <p class="text-gray-600 mb-4">You don't have any conversations yet. Buyers will reach out to you about your products.</p>
                        </div>
                    @endif
                </div>
            </div>
        </x-vendorchat>
    @elseif (auth()->user()->role === 'service_provider')
        <x-vendorchat :chats="$chats">
            <!-- Empty Chat Window -->
            <div class="flex-1 flex flex-col items-center justify-center bg-gray-50 w-full">
                <div class="text-center px-4">
                    <svg class="w-32 h-32 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome to Chat</h2>
                    <p class="text-gray-500 mb-6">Select a conversation from the left to start messaging</p>

                    @if ($chats->isEmpty())
                        <div class="bg-white rounded-lg p-6 shadow-sm max-w-md mx-auto">
                            <p class="text-gray-600 mb-4">You don't have any conversations yet. Customers will reach out to you about your services.</p>
                        </div>
                    @endif
                </div>
            </div>
        </x-vendorchat>
    @elseif (auth()->user()->role === 'admin')
    @endif
</x-boilerplate>