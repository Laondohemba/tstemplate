<!-- Mobile overlay -->
<div id="overlay"
    class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden transition-opacity duration-300 ease-in-out">
</div>

<!-- Sidebar -->
<aside id="sidebar"
    class="fixed top-0 left-0 z-50 w-64 h-screen bg-black text-white transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0">
    <div class="h-full px-3 py-4 overflow-y-auto">
        <!-- Logo -->
        <div class="flex items-center mb-8 px-3">
            <div class="flex w-full h-10 items-center space-x-2">
                <a href="{{ route('user.dashboard') }}">
                    <img src="{{ asset('assets/footerLogo.png') }}" alt="TradeSource360 Logo">
                </a>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="flex flex-col justify-between h-[88%] md:h-[85%] gap-6">
            <ul class="space-y-2 font-medium">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('user.dashboard') }}"
                        class="flex items-center p-3 rounded-lg {{ request()->routeIs('user.dashboard') ? 'active-menu-item' : '' }} group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                @if(auth()->user()->role === 'vendor')
                    <!-- Vendor-specific menu items -->
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ in_array(request()->route()->getName(), ['products.index', 'products.edit', 'products.single']) ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span class="ml-3">My Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.create') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('products.create') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            <span class="ml-3">Add New Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services.index') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ in_array(request()->route()->getName(), ['services.index', 'services.edit', 'services.create']) ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="ml-3">Service Providers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services.create') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('services.create') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="ml-3">Add Service Provider</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor.orders') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('vendor.orders') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="ml-3">Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor.inquiries') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('vendor.inquiries') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                            <span class="ml-3">Inquiries</span>
                        </a>
                    </li>
                @else
                    <!-- Buyer-specific menu items -->
                    <li>
                        <a href="{{ route('buyer.explore-products') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('buyer.explore-products') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span class="ml-3">Explore Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('buyer.natural-resources') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('buyer.natural-resources') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="ml-3">Natural Resources</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('buyer.inquiries') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('buyer.inquiries') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="ml-3">My Inquiries</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('buyer.orders') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('buyer.orders') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="ml-3">My Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('buyer.saved-products') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('buyer.saved-products') ? 'active-menu-item' : '' }} group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            <span class="ml-3">Saved Products</span>
                        </a>
                    </li>
                @endif

                <!-- Common menu items for all users -->
                <li>
                    <a href="{{ route('chats.index') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('chats.*') ? 'active-menu-item' : '' }} group">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                            </path>
                        </svg>
                        <span class="ml-3">Messages / Chat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.show') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('profile.*') ? 'active-menu-item' : '' }} group">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="ml-3">Profile & Settings</span>
                    </a>
                </li>
            </ul>

            <ul class="mt-auto">
                <li>
                    <a href="{{ route('support') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="ml-3">Support / Help Center</span>
                    </a>
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data="formSubmit"
                        @submit.prevent="submit">
                        @csrf
                        <button type="submit" x-ref="btn"
                            class="flex items-center w-full text-left p-3 rounded-lg hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-900" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span class="ml-3">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
