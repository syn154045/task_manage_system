<div class="flex justify-between items-center h-12 px-5">
    {{-- header logo --}}
    @if(Request::is('profile/*'))
    <div class="px-5">
        <a href="{{ route('home') }}" class="text-xl font-semibold hover:text-admin-text-mainhover transition duration-500">
            <i class="fas fa-square-caret-left fa-xs"></i>
            <span class="pl-4">メインメニューへ</span>
        </a>
    </div>
    @endif

    {{-- user tab --}}
    <div class="relative inline-block ml-auto">
        <button id="dropdownBtn" class="w-32 mr-3">
            <label for="dropdown" class="relative w-full h-10 cursor-pointer flex justify-center items-center duration-500 bg-admin-accent hover:bg-admin-accent/60 rounded-xl text-sm">
                <input type="button" id="dropdownCheck" class="hidden peer" onclick="dropdownToggle()">
                <p class="w-[80%]">{{ Auth::guard('administrators')->user()->name }}</p>
                <i class="fas fa-sm fa-angle-down absolute -translate-y-1/2 top-1/2 right-1"></i>
            </label>
        </button>

        {{-- ドロップダウンメニュー --}}
        <div id="dropdownContainer" class="absolute right-0 bg-admin-accent w-44 shadow-lg z-[99] mt-1 rounded-xl text-admin-text-sub text-sm hidden opacity-0 transition-opacity duration-500 ease-out">
            <a href="{{ route('profile.edit.view') }}" class="flex items-center px-4 py-3 border-b border-white hover:opacity-60 transition-opacity duration-500">
                <i class="fas fa-lg fa-person w-1/6"></i>
                <p class="w-5/6">ユーザー管理</p>
            </a>
            <form method="POST" action="{{ route('signout')}}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-3 text-left hover:opacity-60 transition-opacity duration-500">
                    <i class="fas fa-lg fa-person-running w-1/6"></i>
                    <p class="w-5/6">ログアウト</p>
                </button>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        /**
         * dropdown
         */
        const dropdownBtn = document.getElementById('dropdownBtn');
        const dropdownContainer = document.getElementById('dropdownContainer');

        function dropdownToggle() {
            if (dropdownContainer.classList.contains('animate-fade-in')) {
                dropdownContainer.classList.add('animate-fade-out');
                setTimeout(() => {
                    dropdownContainer.classList.remove('animate-fade-in');
                    dropdownContainer.classList.add('hidden');
                }, 500);
            } else {
                dropdownContainer.classList.remove('animate-fade-out');
                dropdownContainer.classList.remove('hidden');
                setTimeout(() => {
                    dropdownContainer.classList.add('animate-fade-in');
                }, 10);
            }
        };
        // windowイベントリスナを起動させない
        dropdownBtn.addEventListener('click', function (event) {
            event.stopPropagation();
            dropdownToggle();
        });
        dropdownContainer.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        // ボタン外をクリックして閉じる
        window.addEventListener('click', function (event) {
            if (!event.target.matches('#dropdownBtn')) {
                if (dropdownContainer.classList.contains('animate-fade-in')) {
                    dropdownContainer.classList.add('animate-fade-out');
                    setTimeout(() => {
                        dropdownContainer.classList.remove('animate-fade-in');
                        dropdownContainer.classList.add('hidden');
                    }, 500);
                }
            }
        });
    </script>
@endpush
