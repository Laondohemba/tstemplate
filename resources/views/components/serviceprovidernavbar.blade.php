<!-- Top Navigation Bar -->
<nav class="bg-white shadow-sm border-b border-gray-200 fixed top-0 right-0 left-0 lg:left-64 z-40">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left side - Mobile menu button -->
            <div class="flex items-center lg:hidden">
                <button id="mobile-menu-button" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Center - Page Title -->
            <div class="flex-1 flex items-center justify-center lg:justify-start">
                <h1 class="text-xl font-semibold text-gray-900">
                    @yield('page-title', 'Service Provider Dashboard')
                </h1>
            </div>

            <!-- Right side - User menu -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <a href="{{ route('notifications.index') }}" type="button"
                    class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12 7M4.828 7H9a2 2 0 012 2v6a2 2 0 01-2 2H4.828M4.828 7L2 4.172M12 7l2.172 2.172M12 7v6a2 2 0 01-2 2H9" />
                    </svg>
                    @php
                        $unreadCount = \App\Services\NotificationService::getUnreadCount(auth()->user());
                    @endphp
                    @if($unreadCount > 0)
                        <!-- Notification badge -->
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                    @endif
                </a>

                <!-- Profile dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                        class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span class="sr-only">Open user menu</span>
                        <div class="h-8 w-8 rounded-full bg-green-600 flex items-center justify-center">
                            <span class="text-sm font-medium text-white">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                        </div>
                        <span class="ml-2 text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        <svg class="ml-1 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <a href="{{ route('profile.show') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Your Profile
                        </a>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Settings
                        </a>
                        <a href="{{ route('support') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Help & Support
                        </a>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (mobileMenuButton && sidebar && overlay) {
            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
    });
</script>
