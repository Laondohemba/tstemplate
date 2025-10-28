<div class="bg-gray-50 h-screen overflow-hidden">
    <!-- Mobile Menu Buttons -->
    <button id="toggleSidebarBtn" class="lg:hidden fixed top-4 left-20 z-50 text-black p-3 bg-white rounded-lg shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <button id="toggleChatListBtn" class="md:hidden fixed top-4 left-4 z-50 p-3 bg-white rounded-lg shadow-lg">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
            </path>
        </svg>
    </button>

    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

    <!-- Chat List Overlay -->
    <div id="chatOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden hidden"></div>

    <div class="flex h-screen">
        <!-- Sidebar Navigation -->
        <aside id="mainSidebar"
            class="fixed lg:sticky top-0 left-0 h-screen w-20 bg-gray-900 flex flex-col items-center py-6 space-y-8 z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <a href="{{ route('user.dashboard') }}"
                class="w-12 h-12 rounded-lg flex items-center justify-center text-gray-100 hover:bg-gray-800 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                    </path>
                </svg>
            </a>
            <a href="{{ route('products.index') }}"
                class="w-12 h-12 rounded-lg flex items-center justify-center text-white hover:bg-gray-800 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </a>
            <a href="{{ route('products.create') }}"
                class="w-12 h-12 rounded-lg flex items-center justify-center text-white hover:bg-gray-800 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </a>
            <a href="{{ route('chats.index') }}"
                class="w-12 h-12 rounded-lg flex items-center justify-center bg-gray-800 text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                    </path>
                </svg>
            </a>
            <a href="{{ route('profile.show') }}"
                class="w-12 h-12 rounded-lg flex items-center justify-center text-white hover:bg-gray-800 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </a>
            <div class="flex-1"></div>
            <a href="{{ route('support') }}"
                class="w-12 h-12 rounded-lg flex items-center justify-center text-white hover:bg-gray-800 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-12 h-12 rounded-lg flex items-center justify-center text-white hover:bg-gray-800 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                </button>
            </form>
        </aside>

        <!-- Chat List -->
        <div id="chatList"
            class="fixed md:relative w-80 bg-white flex flex-col z-30 h-screen transform -translate-x-full md:translate-x-0 transition-transform duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">Chat</h2>
                    <button id="closeChatListBtn" class="md:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Search..." id="chatSearch"
                        class="w-full pl-10 pr-4 py-3 bg-gray-100 border-0 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
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
                        $otherUser = $chat->users->first();
                        $latestMsg = $chat->latestMessage;
                        $unreadCount = $chat->messages()
                            ->where('sender_id', '!=', auth()->id())
                            ->where('is_read', false)
                            ->count();
                    @endphp
                    <a href="{{ route('chats.show', $chat->slug) }}"
                        class="block px-6 py-4 hover:bg-gray-50 cursor-pointer border-l-4 {{ request()->route('chat') && request()->route('chat')->id === $chat->id ? 'border-green-700 bg-gray-50' : 'border-transparent' }} transition-all">
                        <div class="flex items-start gap-3">
                            <div class="relative">
                                <img src="{{ $otherUser->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) }}"
                                    alt="{{ $otherUser->name }}"
                                    class="w-12 h-12 rounded-full object-cover">
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
        function toggleSidebar() {
            if (mainSidebar.classList.contains('-translate-x-full')) {
                mainSidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            } else {
                mainSidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
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
        if (toggleSidebarBtn) toggleSidebarBtn.addEventListener('click', toggleSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);

        if (toggleChatListBtn) toggleChatListBtn.addEventListener('click', toggleChatList);
        if (closeChatListBtn) closeChatListBtn.addEventListener('click', closeChatListFunc);
        if (chatOverlay) chatOverlay.addEventListener('click', closeChatListFunc);

        // Close sidebar when clicking menu items on mobile
        const sidebarLinks = document.querySelectorAll('#mainSidebar a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    mainSidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                }
            });
        });

        // Close chat list when clicking chat items on mobile
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