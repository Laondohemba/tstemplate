  <!-- footer -->
  <footer class="bg-gray-900 text-white px-[5%] py-[3%]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- Logo and Description -->
        <div class="lg:col-span-1">
          <div class="flex items-center mb-4">
            <div class="h-20 w-auto">
              <img src="{{asset('assets//footerLogo.png')}}" alt="TradeSource360 Logo" class="h-40 w-auto object-contain pb-4" />
            </div>
          </div>
          <p class="text-gray-400 text-sm leading-relaxed">
            Trade Source 360 is a wholly owned indigenous Nigerian Company focusing on improving the buying and selling of African products and mineral resources
          </p>
        </div>

        <!-- My Account Links -->
        <div>
          <h3 class="text-white text-lg font-semibold mb-4">My Account</h3>
          <ul class="space-y-3">
            <li><a href="{{route('user.dashboard')}}" class="text-gray-400 text-sm hover:text-white transition-colors duration-200">My
                Account</a></li>
            <li><a href="{{ route('buyer.orders') }}"
                class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Order History</a></li>
            <li><a href="{{ route('buyer.saved-products') }}" class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Saved
                Products</a></li>
            <li><a href="{{ route('buyer.inquiries') }}"
                class="text-gray-400 text-sm hover:text-white transition-colors duration-200">My Inquiries</a></li>
          </ul>
        </div>

        <!-- Help Links -->
        <div>
          <h3 class="text-white text-lg font-semibold mb-4">Helps</h3>
          <ul class="space-y-3">
            <li><a href="{{ route('app.contact') }}"
                class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Contact</a></li>
            <li><a href="{{ route('support') }}" class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Support</a>
            </li>
            <li><a href="{{ route('app.terms') }}" class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Terms
                &amp; Condition</a></li>
            <li><a href="{{ route('app.privacy') }}" class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Privacy
                Policy</a></li>
          </ul>
        </div>

        <!-- Categories Links -->
        <div>
          <h3 class="text-white text-lg font-semibold mb-4">Categories</h3>
          <ul class="space-y-3">
            <li><a href="{{ route('app.products') }}"
                class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Farm Produce</a></li>
            <li><a href="{{ route('buyer.natural-resources') }}"
                class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Natural Resources</a></li>
            <li><a href="{{ route('app.products') }}"
                class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Farm Machinery &amp;
                Tools</a></li>
            <li><a href="{{ route('app.services') }}"
                class="text-gray-400 text-sm hover:text-white transition-colors duration-200">Services</a></li>
          </ul>
        </div>
      </div>

      <!-- Copyright Section -->
      <div class="border-t border-gray-800 mt-8 pt-6">
        <p class="text-gray-500 text-sm text-center">
           2025 &copy; Trade Source 360. All rights reserved.
        </p>
      </div>
    </div>
  </footer>