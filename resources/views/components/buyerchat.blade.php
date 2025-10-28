<div class="bg-gray-50 h-screen overflow-hidden">
    <!-- Mobile overlay for sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden overlay-transition"></div>

    <!-- Chat List Overlay -->
    <div id="chatOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden hidden"></div>

    <!-- Mobile Menu Buttons -->
    <button id="toggleSidebarBtn" class="lg:hidden fixed top-4 right-[70px] z-50 bg-white p-3 rounded-lg shadow-lg">
        <i class="fas fa-bars text-gray-700 text-xl"></i>
    </button>

    <button id="toggleChatListBtn" class="md:hidden fixed top-4 right-4 z-50 bg-white p-3 rounded-lg shadow-lg">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
            </path>
        </svg>
    </button>

    <div class="flex h-screen">
        <!-- Sidebar Navigation -->
        <aside id="mainSidebar"
            class="fixed top-0 left-0 z-50 w-64 h-screen bg-white sidebar-transition transform -translate-x-full lg:translate-x-0">
            <div class="h-full px-3 py-4 overflow-y-auto">
                <!-- Logo -->
                <div class="flex items-center mb-8 px-3">
                    <div class="flex w-full h-10 items-center space-x-2">
                        <img src="{{asset('assets/logo.png')}}" alt="TradeSource360 Logo">
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="flex flex-col justify-between h-[88%] md:h-[85%]">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <a href="{{ route('user.dashboard') }}"
                                class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <i class="fas fa-home text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ml-3">Dashboard (Overview)</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}"
                                class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <i class="fas fa-box text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ml-3">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('buyer.inquiries') }}"
                                class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <i class="fas fa-envelope text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ml-3">My Inquiries</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('buyer.orders') }}"
                                class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <i class="fas fa-file-alt text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ml-3">Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('buyer.saved-products') }}"
                                class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <i class="fas fa-bookmark text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ml-3">Saved Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('chats.index') }}"
                                class="flex items-center p-3 text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-100 group">
                                <i class="fas fa-comments text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ml-3">Chat</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.show') }}"
                                class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <i class="fas fa-user-cog text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ml-3">Profile & Settings</span>
                            </a>
                        </li>
                    </ul>

                    <li class="mt-auto flex flex-end">
                        <a href="{{ route('support') }}"
                            class="flex items-center p-3 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <i class="fas fa-question-circle text-gray-500 group-hover:text-gray-900"></i>
                            <span class="ml-3">Support / Help Center</span>
                        </a>
                    </li>
                </div>
            </div>
        </aside>

        <!-- Chat List -->
        <div id="chatList"
            class="fixed md:relative w-80 bg-white flex flex-col z-30 h-screen transform -translate-x-full md:translate-x-0 transition-transform duration-300 lg:ml-64">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">Chat</h2>
                    <button id="closeChatListBtn" class="md:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Search" id="chatSearch"
                        class="w-full pl-10 pr-4 py-3 bg-green-50 border-0 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Chat List Items -->
            <div class="flex-1 overflow-y-auto">
                @forelse($chats as $chat)
                    @php
                        $otherUser = $chat->users->where('id', '!=', auth()->id())->first();
                        $latestMsg = $chat->latestMessage;

                        // Get current user's last read message ID safely
                        $currentUserPivot = $chat->users()->where('user_id', auth()->id())->first();
                        $lastReadMessageId = $currentUserPivot ? $currentUserPivot->pivot->last_message_id : null;

                        // Count unread messages (sent by others and after last read)
                        $unreadCount = $chat->messages()
                            ->where('sender_id', '!=', auth()->id())
                            ->when($lastReadMessageId, function ($query, $lastReadMessageId) {
                                $query->where('id', '>', $lastReadMessageId);
                            })
                            ->count();
                    @endphp

                    <a href="{{ route('chats.show', $chat->slug) }}"
                        class="block px-6 py-4 hover:bg-gray-50 cursor-pointer border-l-4 {{ request()->route('chat') && request()->route('chat')->id === $chat->id ? 'border-green-700 bg-gray-50' : 'border-transparent' }} transition-all">
                        <div class="flex items-start gap-3">
                            <div class="relative">
                                <img src="{{ $otherUser->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) }}"
                                    alt="{{ $otherUser->name }}"
                                    class="w-12 h-12 rounded-full object-cover">
                                {{-- You can add online status indicator here --}}
                                {{-- <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span> --}}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="font-semibold text-gray-900 text-sm truncate">
                                        {{ $otherUser->name }}
                                    </h3>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-gray-400">
                                            {{ $latestMsg ? $latestMsg->created_at->format('H:i') : '' }}
                                        </span>
                                        @if($unreadCount > 0)
                                            <span class="w-5 h-5 bg-green-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">
                                                {{ $unreadCount > 99 ? '99' : $unreadCount }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 truncate">
                                    @if($latestMsg)
                                        {{ $latestMsg->message ?? 'Sent an attachment' }}
                                    @else
                                        Start a conversation...
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <p class="text-sm">No conversations yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Chat Window -->
        {{ $slot }}
    </div>

    <script>
        // Get all DOM elements
        const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');
        const mainSidebar = document.getElementById('mainSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        const toggleChatListBtn = document.getElementById('toggleChatListBtn');
        const closeChatListBtn = document.getElementById('closeChatListBtn');
        const chatList = document.getElementById('chatList');
        const chatOverlay = document.getElementById('chatOverlay');

        // Sidebar toggle functions
        function openSidebar() {
            mainSidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        }

        function closeSidebar() {
            mainSidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }

        function toggleSidebar() {
            if (mainSidebar.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        }

        // Chat list toggle functions
        function toggleChatList() {
            chatList.classList.toggle('-translate-x-full');
            chatOverlay.classList.toggle('hidden');
        }

        function closeChatListFunc() {
            chatList.classList.add('-translate-x-full');
            chatOverlay.classList.add('hidden');
        }

        // Event Listeners
        // Sidebar events
        if (toggleSidebarBtn) toggleSidebarBtn.addEventListener('click', toggleSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

        // Chat list events
        if (toggleChatListBtn) toggleChatListBtn.addEventListener('click', toggleChatList);
        if (closeChatListBtn) closeChatListBtn.addEventListener('click', closeChatListFunc);
        if (chatOverlay) chatOverlay.addEventListener('click', closeChatListFunc);

        // Close sidebar when clicking on sidebar menu items on mobile
        const sidebarLinks = document.querySelectorAll('#mainSidebar a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    closeSidebar();
                }
            });
        });

        // Close chat list when clicking on chat items on mobile
        const chatItems = document.querySelectorAll('#chatList a');
        chatItems.forEach(item => {
            item.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    closeChatListFunc();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                mainSidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            } else {
                closeSidebar();
            }

            if (window.innerWidth >= 768) {
                chatList.classList.remove('-translate-x-full');
                chatOverlay.classList.add('hidden');
            }
        });

        // Chat search functionality
        const chatSearch = document.getElementById('chatSearch');
        if (chatSearch) {
            chatSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const chatItems = document.querySelectorAll('#chatList a');
                
                chatItems.forEach(item => {
                    const userName = item.querySelector('h3').textContent.toLowerCase();
                    const lastMessage = item.querySelector('p').textContent.toLowerCase();
                    
                    if (userName.includes(searchTerm) || lastMessage.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
    </script>
</div>