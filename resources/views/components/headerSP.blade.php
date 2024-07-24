<header class="flex justify-between h-16">
    <h1 class="flex items-center pl-4">
        <a href="{{ route('home')}}" class="text-xl font-semibold hover:opacity-60 transition-opacity duration-500">
            管理ページ
        </a>
    </h1>

    <h2 class="mx-1 flex items-center">
        <p class="mr-3 max-w-24 text-xs">
            {{ Auth::guard('administrators')->user()->name }}
        </p>
        <button class="w-10">
            <label for="checkbox" class="relative w-8 h-10 cursor-pointer flex flex-col justify-center items-center gap-2 duration-500 has-[:checked]:rotate-180 has-[:checked]:duration-500">
                <input type="checkbox" id="checkbox" class="hidden peer" onclick="menuToggle()">
                <div class="w-3/4 h-1 bg-admin-accent rounded-sm peer-checked:absolute peer-checked:w-full peer-checked:rotate-45 peer-checked:duration-500"></div>
                <div class="w-full h-1 bg-admin-accent rounded-sm duration-1000 peer-checked:absolute peer-checked:w-full peer-checked:scale-x-0 peer-checked:duration-500"></div>
                <div class="w-3/4 h-1 bg-admin-accent rounded-sm peer-checked:absolute peer-checked:w-full peer-checked:-rotate-45 peer-checked:duration-500"></div>
            </label>
        </button>
    </h2>
</header>
{{-- ハンバーガーメニュー（文字数上限：14文字） --}}
<nav class="relative z-[90]">
    <ul id="menuContainer" class="absolute right-0 w-0 pt-2 pb-5 bg-admin-main text-xs transition-all duration-500 overflow-x-hidden whitespace-nowrap shadow-admin-main shadow-2xl">
        <li class="w-full h-12 flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-main hover:opacity-60 transition duration-500">
                    <a href="{{ route('profile.edit.view') }}" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-person w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">ユーザー管理</p>
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-main hover:opacity-60 transition duration-500">
                    <form method="POST" action="{{ route('signout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="jsMenuItems w-full hidden items-center text-left relative">
                            <i class="fas fa-person-running w-1/6"></i>
                            <p class="w-5/6 pl-1 text-wrap">ログアウト</p>
                        </button>
                    </form>
                </div>
            </div>
        </li>
        <li class="w-full h-12 flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:opacity-60 transition duration-500">
                    <a href="{{ route('api-info.list') }}" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-earth-asia w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">API情報管理</p>
                        @if (Request::is('api-info/*'))
                        <div class="absolute -left-2 w-[42vw] h-10 bg-admin-accent2/30"></div>
                        @endif
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:opacity-60 transition duration-500">
                    <a href="{{ route('item.list') }}" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-location-dot w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">商品情報一覧</p>
                        @if (Request::is('items/*'))
                        <div class="absolute -left-2 w-[42vw] h-10 bg-admin-accent2/30"></div>
                        @endif
                    </a>
                </div>
            </div>
        </li>
        <li class="w-full h-12 flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:opacity-60 transition duration-500">
                    <a href="{{ route('order.list') }}" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-file-lines w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">受注情報一覧</p>
                        @if (Request::is('orders/*'))
                        <div class="absolute -left-2 w-[42vw] h-10 bg-admin-accent2/30"></div>
                        @endif
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:opacity-60 transition-opacity duration-300">
                    <a href="{{ route('task.list') }}" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-list-check w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">ラベル印刷タスク状況</p>
                        @if(!empty($taskCount))
                        <div class="absolute z-10 -top-1 -right-4 w-4 h-4 flex justify-center items-center">
                            <i class="fas fa-2xl fa-comment text-elem-alert"></i>
                            <p class="text-xs text-white absolute -top-[0.075rem]">
                                {{ $taskCount }}
                            </p>
                        </div>
                        @endif
                        @if (Request::is('tasks/*'))
                        <div class="absolute -left-2 w-[42vw] h-10 bg-admin-accent2/30"></div>
                        @endif
                    </a>
                </div>
            </div>
        </li>
    </ul>
</nav>

@push('script')
    <script>
        /**
         * hamburger toggle
         */
        const checkbox = document.getElementById('checkbox');
        const menuContainer = document.getElementById('menuContainer');
        const menuItems = document.querySelectorAll('.jsMenuItems');

        function menuToggle() {
            menuContainer.classList.toggle('w-0');
            menuContainer.classList.toggle('w-full');

            menuItems.forEach(menuItem => {
                if (checkbox.checked) {
                    setTimeout(() => {
                        menuItem.classList.toggle('animate-fade-in');
                        menuItem.classList.toggle('hidden');
                        menuItem.classList.toggle('flex');
                    }, 550);
                } else {
                    menuItem.classList.toggle('animate-fade-in');
                    menuItem.classList.toggle('hidden');
                    menuItem.classList.toggle('flex');
                }
            });
        }
    </script>
@endpush
