<x-layouts.admin>
    @push('title')
        ユーザー情報変更
    @endpush

    <div class="text-center text-base h-4">
        @error('err')
        <p class="text-elem-alert">
            *! {{ $message }}
        </p>
        @enderror
        @if(session('message'))
        <p class="text-elem-success">
            {{ session('message') }}
        </p>
        @endif
    </div>

    <div class="w-[90%] mx-auto border rounded-2xl border-admin-accent2 p-6 bg-admin-accent2/10 relative mt-8">
        <h2 class="absolute -top-3 bg-admin-accent2 text-white px-4 py-1 text-sm rounded-xl">
            ユーザー情報変更
        </h2>
        <form action="{{ route('profile.update') }}" method="POST" class="w-[80%] mx-auto flex flex-col justify-center items-center">
            @csrf
            <div class="relative mt-10 w-full">
                <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" placeholder="name" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
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

            <div class="relative mt-10 w-full">
                <input type="text" id="email" name="email" value="{{ old('email', $admin->email) }}" placeholder="email" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
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
            <div class="mt-12 w-full flex justify-center">
                <button type="submit" class="w-1/3 min-w-48 bg-admin-accent p-2 rounded-md hover:bg-admin-accent/60 focus:outline-none focus:bg-admin-accent/60 transition-colors duration-300">
                    ユーザー情報更新
                </button>
            </div>
        </form>
    </div>

    <div class="w-[90%] mx-auto border rounded-2xl border-admin-accent2 p-6 bg-admin-accent2/10 relative mt-20">
        <h2 class="absolute -top-3 bg-admin-accent2 text-white px-4 py-1 text-sm rounded-xl">
            パスワード変更
        </h2>
        <form action="{{ route('profile.password-update') }}" method="POST" class="w-[80%] mx-auto flex flex-col justify-center items-center">
            @csrf
            <div class="relative mt-10 w-full">
                <i class="js-password-toggle fas fa-eye-slash absolute top-3 right-4 cursor-pointer"></i>
                <input type="password" id="password_current" name="password_current" placeholder="pass" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                <label for="password_current" class="block absolute -top-3 cursor-none text-sm transition-all duration-500 peer-focus:-top-3 peer-focus:text-sm peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-placeholder-shown:cursor-text">
                    current password
                </label>
                @error('password_current')
                    <div class="absolute top-12 text-xs text-elem-alert opacity-80">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="relative mt-10 w-full">
                <i class="js-password-toggle fas fa-eye-slash absolute top-3 right-4 cursor-pointer"></i>
                <input type="password" id="password" name="password" placeholder="pass" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                <label for="password" class="block absolute -top-3 cursor-none text-sm transition-all duration-500 peer-focus:-top-3 peer-focus:text-sm peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-placeholder-shown:cursor-text">
                    new password
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
            <div class="relative mt-10 w-full">
                <i class="js-password-toggle fas fa-eye-slash absolute top-3 right-4 cursor-pointer"></i>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="pass" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                <label for="password_confirmation" class="block absolute -top-3 cursor-none text-sm transition-all duration-500 peer-focus:-top-3 peer-focus:text-sm peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg peer-placeholder-shown:cursor-text">
                    Password Confirm
                </label>
                @error('password_confirmation')
                    <div class="absolute top-12 text-xs text-elem-alert opacity-80">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-12 w-full flex justify-center">
                <button type="submit" class="w-1/3 min-w-48 bg-admin-accent p-2 rounded-md hover:bg-admin-accent/60 focus:outline-none focus:bg-admin-accent/60 transition-colors duration-300">
                    パスワード更新
                </button>
            </div>
        </form>
    </div>

    <div class="w-[90%] mx-auto border rounded-2xl border-admin-accent2 p-6 bg-admin-accent2/10 relative mt-20">
        <h2 class="absolute -top-3 bg-admin-accent2 text-white px-4 py-1 text-sm rounded-xl">
            ユーザー削除
        </h2>
        <form action="{{ route('profile.delete') }}" method="POST" class="w-[80%] mx-auto flex flex-col justify-center items-center">
            @csrf
            <div class="relative mt-10 w-full text-lg font-semibold">
                <div>
                    本当に削除しますか？
                </div>
                <div>
                    この処理は元に戻せません。
                </div>
            </div>
            <div class="mt-10 text-center">
                <button type="submit" class="px-10 py-2 rounded-xl border-2 border-elem-alert text-elem-alert hover:bg-elem-alert/20 transition-all duration-300">
                    はい
                </button>
            </div>
        </form>
    </div>

    @push('script')
        <script>
            /**
             * password visiblity
             */
            const passwordToggle = document.querySelectorAll('.js-password-toggle');

            passwordToggle.forEach(element => {
                element.addEventListener('click', function () {
                    const passwordField = this.nextElementSibling;

                    if (this.classList.contains('fa-eye-slash')) {
                        // password表示
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                        passwordField.type = 'text';
                    } else {
                        // password非表示
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                        passwordField.type = 'password';
                    }
                });
            });
        </script>
    @endpush
</x-layouts.admin>
