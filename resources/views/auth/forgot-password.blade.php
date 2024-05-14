<x-layouts.global title="forgot">
    <!-- component -->
    <div class="w-11/12 mx-auto bg-gray-100 flex items-center justify-center rounded-lg"">
        <div class="w-4/5 max-w-screen-sm p-6">
            <h1 class="text-3xl font-semibold mb-6 text-black text-center">Reset Password</h1>
            
            <div class="mt-4 text-sm text-gray-600">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                    @csrf
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
                    
                    <button type="submit" class="w-full bg-green-900 text-white p-2 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-900 focus:ring-2 focus:ring-offset-2 focus:ring-green-900 transition-colors duration-300">
                        Send Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.global>
