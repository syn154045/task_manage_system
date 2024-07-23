<x-layouts.admin>
    @push('title')
        sign-up
    @endpush

    <div class="w-11/12 max-w-xl mx-auto pt-24 tablet:pt-40 pb-8 flex flex-col items-center justify-center">
        <h1 class="flex items-center text-4xl font-semibold mb-8 text-center">
            <i class="fas fa-sm fa-pen-to-square"></i>
            <p class="pl-5">Sign Up</p>
        </h1>

        <form action="{{ route('signup') }}" method="POST" class="relative w-full pt-2">
            @csrf
            <div class="absolute top-0 left-1/2 -translate-x-1/2 text-xs text-elem-alert opacity-80">
                @error('signup')
                    {{ $message }}
                @endif
            </div>

            <div class="relative mt-10">
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="name" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                <label for="name" class="block absolute -top-3 cursor-none text-sm transition-all duration-500 peer-focus:-top-3 peer-focus:text-sm peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-placeholder-shown:cursor-text">
                    Name
                </label>
                @error('name')
                    <div class="absolute top-12 text-xs text-elem-alert opacity-80">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="relative mt-10">
                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="email" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                <label for="email" class="block absolute -top-3 cursor-none text-sm transition-all duration-500 peer-focus:-top-3 peer-focus:text-sm peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-placeholder-shown:cursor-text">
                    Email
                </label>
                @error('email')
                    <div class="absolute top-12 text-xs text-elem-alert opacity-80">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="relative mt-10">
                <i id="passwordVisible" class="fas fa-eye-slash absolute top-3 right-4 cursor-pointer"></i>
                <input type="password" id="password" name="password" placeholder="pass" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                <label for="password" class="block absolute -top-3 cursor-none text-sm transition-all duration-500 peer-focus:-top-3 peer-focus:text-sm peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-placeholder-shown:cursor-text">
                    Password
                    <span class="text-sm">
                        (記号・英数字を含む6桁以上)
                    </span>
                </label>
                @error('password')
                    <div class="absolute top-12 text-xs text-elem-alert opacity-80">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex justify-center w-full mx-auto mt-12 items-center relative">
                <button type="submit" class="w-1/3 bg-admin-accent p-2 rounded-md hover:bg-admin-accent/60 focus:outline-none focus:bg-admin-accent/60 transition-colors duration-300">
                    Sign Up
                </button>
                <div class="absolute right-0">
                    <a href="{{ route('signin') }}" class="border-b px-2 border-admin-text-main pb-1 hover:opacity-60 transition-opacity duration-300">
                        Sign In
                    </a>
                </div>
            </div>
        </form>
    </div>

    @push('script')
        <script>
            /**
             * password visiblity
             */
            const passwordVisible = document.getElementById('passwordVisible');
            const passwordBox = passwordVisible.nextElementSibling;

            passwordVisible.addEventListener('click', function() {
                if (passwordVisible.classList.contains('fa-eye-slash')) {
                    passwordVisible.classList.remove('fa-eye-slash');
                    passwordVisible.classList.add('fa-eye');
                    passwordBox.type = 'text';
                } else {
                    passwordVisible.classList.remove('fa-eye');
                    passwordVisible.classList.add('fa-eye-slash');
                    passwordBox.type = 'password';
                }
            });
        </script>
    @endpush
</x-layouts.admin>
