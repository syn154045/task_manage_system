<x-layouts.admin>
    @push('title')
        login
    @endpush

    {{-- 実装時削除
        TODO :
            1. REMEMBER ME 機能 -> 不要な場合、Admin/AuthController/login の$rememberを削除してください
            2. FORGOT PASSWORD 機能有無 -> 必要な場合、メール機能・forgot password画面など実装が必要です
    --}}
    <div class="w-11/12 max-w-xl mx-auto pt-24 tablet:pt-40 pb-8 flex flex-col items-center justify-center">
        <h1 class="flex items-center text-4xl font-semibold mb-8 text-center">
            <i class="fas fa-sm fa-fingerprint"></i>
            <p class="pl-5">Log In</p>
        </h1>

        <form action="{{ route('admin.login') }}" method="POST" class="relative w-full pt-6">
            @csrf
            <div class="absolute top-0 left-1/2 -translate-x-1/2 text-xs text-admin-alert opacity-80">
                @error('login')
                    {{ $message }}
                @endif
            </div>

            <div class="relative mt-10">
                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="email" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                <div class="h-[0.125rem] bg-admin-text-sub peer-focus:bg-gradient-to-r from-admin-accent-type2 to-admin-accent-type2hover transition-colors duration-300"></div>
                <label for="email" class="block absolute -top-3 cursor-none text-sm transition-all duration-500 peer-focus:text-admin-text-subhover peer-focus:-top-3 peer-focus:text-sm peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-placeholder-shown:cursor-text">
                    Email
                </label>
                @error('email')
                    <div class="absolute top-12 text-xs text-admin-alert opacity-80">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="relative mt-10">
                <i id="passwordVisible" class="fas fa-eye-slash absolute top-3 right-4 cursor-pointer"></i>
                <input type="password" id="password" name="password" placeholder="pass" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                <div class="h-[0.125rem] bg-admin-text-sub peer-focus:bg-gradient-to-r from-admin-accent-type2 to-admin-accent-type2hover transition-colors duration-300"></div>
                <label for="password" class="block absolute -top-3 cursor-none text-sm transition-all duration-500 peer-focus:text-admin-text-subhover peer-focus:-top-3 peer-focus:text-sm peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-placeholder-shown:cursor-text">
                    Password
                </label>
                @error('password')
                    <div class="absolute top-12 text-xs text-admin-alert opacity-80">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex justify-between mt-6">
                <div class="relative cursor-pointer flex">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="appearance-none peer" onclick="rememberToggle()">
                    <svg viewBox="0 0 64 64" class="w-5 h-5">
                        <path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="fill-none stroke-admin-accent-type1 stroke-[6] transition-all duration-500" style="stroke-dasoffset: 0; stroke-dasharray: 241 9999999;"></path>
                    </svg>
                    <label for="remember" class="pl-2 text-sm text-admin-accent-type1 cursor-pointer peer-focus:underline peer-focus:text-admin-accent-type1hover">
                        Remember Me
                    </label>
                </div>
                {{-- <div class="text-right">
                    <a href="{{ route('admin.password-request') }}" class="text-sm text-admin-accent-type1 rounded-md hover:underline focus:outline-none focus:font-semibold focus:text-admin-accent-type1hover focus:underline">
                        <p>Forgot Password?</p>
                    </a>
                </div> --}}
            </div>

            <div class="w-1/2 mx-auto mt-12">
                <button type="submit" class="w-full bg-admin-accent-type1 p-2 rounded-md hover:bg-admin-accent-type1hover focus:outline-none focus:bg-admin-accent-type1hover hover:text-admin-text-mainhover focus:text-admin-text-mainhover transition-colors duration-300">
                    Sign In
                </button>
            </div>
        </form>
    </div>

    @push('script')
        <script>
            /**
             * SVG check stroke controll
             */
            const rememberCheck = document.getElementById('remember');
            const rememberCheckbox = rememberCheck.nextElementSibling;
            const rememberCheckboxSvg = (rememberCheck.nextElementSibling.querySelector('path'));

            rememberCheck.addEventListener('checked', rememberToggle);
            rememberCheckbox.addEventListener('click', function(event) {
                if (rememberCheck.checked) {
                    rememberCheck.checked = false;
                } else {
                    rememberCheck.checked = true;
                }
                rememberToggle();
            });
            document.addEventListener('DOMContentLoaded', function() {
                const rememberCheck = document.getElementById('remember');
                if (rememberCheck.checked) {
                    rememberToggle();
                }
            });

            // stroke move
            function rememberToggle() {
                if (rememberCheck.checked) {
                    rememberCheckboxSvg.style.strokeDasharray = '70.5096664428711 9999999';
                    rememberCheckboxSvg.style.strokeDashoffset = '-262.2723388671875';
                } else {
                    rememberCheckboxSvg.style.strokeDasharray = '241 9999999';
                    rememberCheckboxSvg.style.strokeDashoffset = '0';
                }
            };

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
