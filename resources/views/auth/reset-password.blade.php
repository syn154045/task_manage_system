<x-layouts.global title="reset">
    <!-- component -->
    <div class="w-full bg-gray-100 flex items-center justify-center rounded-lg"">
        <div class="w-4/5 max-w-screen-sm p-6">
            <h1 class="text-3xl font-semibold mb-6 text-black text-center">Reset Password</h1>
            
            <div class="mt-4 text-sm text-gray-600">
                <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- tokenはhidden固定 -->
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input type="text" id="email" name="email" value="{{ old('email') }}" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                        @error('email')
                            <div class="text-xs relative block w-full rounded-lg border-red-500 text-red-700 opacity-90">
                                <div class="mr-12 tex-red-700">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" value="" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                        @error('password')
                            <div class="text-xs relative block w-full rounded-lg border-red-500 text-red-700 opacity-90">
                                <div class="mr-12 tex-red-700">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password confirmation</label>
                        <input type="password" id="password-confirm" name="password_confirmation" value="" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    
                    <button type="submit" class="w-full bg-green-900 text-white p-2 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-900 focus:ring-2 focus:ring-offset-2 focus:ring-green-900 transition-colors duration-300">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.global>
