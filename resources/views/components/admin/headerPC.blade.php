<div class="flex justify-end items-center h-12 pr-5">
    <div class="relative inline-block">
        <button id="dropdownButton" class="w-32 mr-3">
            <label for="dropdown" class="relative w-full h-10 cursor-pointer flex justify-center items-center duration-500 bg-admin-accent-type1 hover:bg-admin-accent-type1hover rounded-2xl text-sm">
                <input type="button" id="dropdownCheck" class="hidden peer" onclick="dropdownToggle()">
                <p class="w-[80%]">{{ Auth::guard('administrators')->user()->name }}</p>
                <i class="fas fa-sm fa-angle-down absolute -translate-y-1/2 top-1/2 right-1"></i>
            </label>
        </button>

        {{-- ドロップダウンメニュー --}}
        <div id="dropdownContainer" class="absolute right-0 bg-admin-base w-44 shadow-lg z-[99] mt-1 rounded-xl text-admin-text-sub text-sm hidden opacity-0 transition-opacity duration-500 ease-out">
            <a href="#" class="flex items-center px-4 py-2 border-b border-white hover:text-admin-text-subhover transition duration-500">
                <i class="fas fa-lg fa-person w-1/6"></i>
                <p class="w-5/6">アカウント管理</p>
            </a>
            <form method="POST" action="{{ route('admin.logout')}}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-left hover:text-admin-text-subhover transition duration-500">
                    <i class="fas fa-lg fa-person-running w-1/6"></i>
                    <p class="w-5/6">ログアウト</p>
                </button>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        const dropdownButton = document.getElementById('dropdownButton');
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
        dropdownButton.addEventListener('click', function (event) {
            event.stopPropagation();
            dropdownToggle();
        });
        dropdownContainer.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        // ボタン外をクリックして閉じる
        window.addEventListener('click', function (event) {
            if (!event.target.matches('#dropdownButton')) {
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
