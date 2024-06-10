<header class="flex justify-between h-16">
    <h1 class="flex items-center pl-4">
        <a href="{{ route('admin.dashboard.index')}}" class="text-xl font-semibold hover:text-admin-text-mainhover transition duration-500">
            管理ページ
        </a>
    </h1>
    {{-- 実装時削除
        TODO :
            1. Route -> href="" / Request::is('') ※list,detailがあると思われるのでアスタリスクを付けてください
            2. $variableCount -> 通知バッヂが必要な場合は、app/View/Components/layouts/admin/render に処理を記述し、resources/views/components/layouts/admin より変数を受渡してください
            3. アカウント管理 -> 必要な場合は、route + controller + view一式実装してください
    --}}
    <h2 class="mx-1 flex items-center">
        <p class="mr-3 max-w-24 text-xs">
            {{ Auth::guard('administrators')->user()->name }}
        </p>
        <button class="w-10">
            <label for="checkbox" class="relative w-8 h-10 cursor-pointer flex flex-col justify-center items-center gap-2 duration-500 has-[:checked]:rotate-180 has-[:checked]:duration-500">
                <input type="checkbox" id="checkbox" class="hidden peer" onclick="menuToggle()">
                <div class="w-3/4 h-1 bg-admin-accent-type1 rounded-sm peer-checked:absolute peer-checked:w-full peer-checked:rotate-45 peer-checked:duration-500"></div>
                <div class="w-full h-1 bg-admin-accent-type1 rounded-sm duration-1000 peer-checked:absolute peer-checked:w-full peer-checked:scale-x-0 peer-checked:duration-500"></div>
                <div class="w-3/4 h-1 bg-admin-accent-type1 rounded-sm peer-checked:absolute peer-checked:w-full peer-checked:-rotate-45 peer-checked:duration-500"></div>
            </label>
        </button>
    </h2>
</header>
{{-- ハンバーガーメニュー（文字数上限：14文字） --}}
<nav class="relative z-[90]">
    <ul id="menuContainer" class="absolute right-0 w-0 pt-2 pb-5 bg-admin-base text-xs text-admin-text-sub transition-all duration-500 overflow-x-hidden whitespace-nowrap shadow-admin-main shadow-2xl">
        <li class="w-full h-12 flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:text-admin-text-subhover transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-person w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">アカウント管理</p>
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:text-admin-text-subhover transition duration-500">
                    <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
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
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:text-admin-text-subhover transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-earth-asia w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">〇〇〇〇〇〇〇〇一覧</p>
                        @if (Request::is('admin/sample*'))
                        <div class="absolute -left-2 w-[42vw] h-10 bg-admin-accent-type2 opacity-50"></div>
                        @endif
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:text-admin-text-subhover transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-location-dot w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">△△一覧</p>
                        @if (Request::is('admin/hoge*'))
                        <div class="absolute -left-2 w-[42vw] h-10 bg-admin-accent-type2 opacity-50"></div>
                        @endif
                    </a>
                </div>
            </div>
        </li>
        <li class="w-full h-12 flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:text-admin-text-subhover transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-calendar-check w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">××一覧</p>
                        @if (Request::is('admin/fuga*'))
                        <div class="absolute -left-2 w-[42vw] h-10 bg-admin-accent-type2 opacity-50"></div>
                        @endif
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-admin-text-sub hover:text-admin-text-subhover transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-paper-plane w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">お問い合わせ一覧</p>
                        {{-- @if(!empty($variableCount)) --}}
                        <div class="absolute z-10 -top-1 -right-4 w-4 h-4 flex justify-center items-center">
                            <i class="fas fa-2xl fa-comment text-admin-alert"></i>
                            <p class="text-xs text-white absolute -top-[0.075rem]">
                                {{-- {{ $variableCount }} --}}20
                            </p>
                        </div>
                        {{-- @endif --}}
                        @if (Request::is('admin/inquiry*'))
                        <div class="absolute -left-2 w-[42vw] h-10 bg-admin-accent-type2 opacity-50"></div>
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
