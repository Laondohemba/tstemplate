    <!-- Fixed Navbar -->
    <nav class="fixed top-0 right-0 left-0 bg-white border-b border-gray-200 z-30">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <!-- Mobile menu button -->
                    <button id="toggleSidebar"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Search and Profile -->
                <div class="flex items-center space-x-4">

                    <!-- Search -->
                    <div class="relative hidden md:block">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text"
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                            placeholder="Search">
                    </div>

                    <!-- add product -->
                    <div class="flex flex-row gap-2 text-sm font-500">
                        <a href="{{ route('products.create') }}"
                            class="bg-green-700 text-gray-200 py-1 px-4 rounded ">Add Product</a>
                        <a href="{{ route('vendor.profile', auth()->user()->slug) }}" class="bg-green-100 text-gray-800 py-1 px-4 rounded ">View store</a>
                    </div>

                    <!-- Notifications -->
                    <a href="{{ route('notifications.index') }}"
                        class="relative p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-300">
                        <i class="fas fa-bell"></i>
                        @php
                            $unreadCount = \App\Services\NotificationService::getUnreadCount(auth()->user());
                        @endphp
                        @if($unreadCount > 0)
                            <span
                                class="absolute top-3 right-2 inline-flex items-center justify-center px-1 text-xs font-[400] leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $unreadCount }}</span>
                        @endif
                    </a>

                    <!-- Profile -->
                    <div class="relative">
                        <button id="profileDropdown"
                            class="flex items-center justify-center w-8 h-8 rounded-full focus:outline-none focus:ring-4 focus:ring-gray-300 overflow-hidden"
                            aria-label="Open profile menu" title="Profile">
                            <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                        </button>

                        <!-- Dropdown menu -->
                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow z-50">
                            <div class="px-4 py-3">
                                <p class="text-sm text-gray-900">{{ ucwords(auth()->user()->name) }}</p>
                                <p class="text-sm font-medium text-gray-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <ul class="py-1">
                                <li><a href="{{ route('profile.show') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Sign out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
