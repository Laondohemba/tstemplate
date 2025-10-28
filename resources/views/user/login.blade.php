<x-boilerplate>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-8">
        <div class="max-w-md w-full bg-white p-6 rounded-xl shadow-md">
            <h1 class="text-center text-2xl font-semibold mb-2">Log In</h1>
            <p class="text-center text-gray-500 mb-6">
                Welcome back! Please log in to continue.
            </p>

            <form id="loginForm" method="POST" action="{{ route('user.login') }}" x-data="formSubmit" @submit.prevent="submit">
                @csrf
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Email"
                        class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                    @error('email')
                        <span id="emailError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="w-full px-3 py-2 border border-green-600 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 transition-colors" />
                    @error('password')
                        <span id="passwordError" class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" x-ref="btn"
                    class="w-full bg-green-700 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 mt-4">
                    <span id="btnText">Log In</span>
                </button>

                <!-- Sign Up Link -->
                <p class="text-center text-gray-500 mt-4 text-sm">
                    Don't have an account?
                    <a href="{{ route('user.create') }}" class="text-green-700 hover:underline ml-1">Sign Up</a>
                </p>
            </form>

            <!-- Error Message -->
            @error('loginfailed')
                <div id="errorMessage" class="mt-4 p-3 bg-red-50 border border-red-200 rounded-md">
                    <p class="text-red-600 text-sm" id="errorText">{{ $message }}</p>
                </div>
            @enderror

        </div>
    </div>
</x-boilerplate>
