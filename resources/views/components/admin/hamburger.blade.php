<header class="flex justify-between h-16 border-b border-slate-800 border-opacity-60">
    <a href="{{ route('admin.dashboard.index')}}" class="flex items-center">
        <h1 class="flex items-center pl-4 text-xl text-slate-800 font-semibold">
            管理ページ
        </h1>
    </a>
    <h2 class="mx-1 flex items-center">
        <p class="mr-3 max-w-24 text-xs text-slate-800">
            {{ Auth::guard('administrators')->user()->name }}
        </p>
        <button class="w-10">
            <label for="checkbox" class="relative w-8 h-10 cursor-pointer flex flex-col justify-center items-center gap-2 duration-500 has-[:checked]:rotate-180 has-[:checked]:duration-500">
                <input type="checkbox" id="checkbox" class="hidden peer" onclick="menuToggle()">
                <div class="w-3/4 h-1 bg-lime-700 rounded-sm peer-checked:absolute peer-checked:w-full peer-checked:rotate-45 peer-checked:duration-500"></div>
                <div class="w-full h-1 bg-lime-700 rounded-sm duration-1000 peer-checked:absolute peer-checked:w-full peer-checked:scale-x-0 peer-checked:duration-500"></div>
                <div class="w-3/4 h-1 bg-lime-700 rounded-sm peer-checked:absolute peer-checked:w-full peer-checked:-rotate-45 peer-checked:duration-500"></div>
            </label>
        </button>
    </h2>
</header>
{{-- ハンバーガーメニュー（文字数上限：14文字） --}}
<nav class="relative z-[99]">
    <ul id="menuContainer" class="absolute right-0 w-0 pt-2 pb-5 bg-gray-100 text-xs text-slate-600 transition-all duration-500 overflow-x-hidden whitespace-nowrap">
        <li>

        </li>
        <li class="w-full h-12 flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-slate-400 hover:text-lime-700 transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-person w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">アカウント管理</p>
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-slate-400 hover:text-lime-700 transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-person-running w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">ログアウト</p>
                    </a>
                </div>
            </div>
        </li>
        <li class="w-full h-12 flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-slate-400 hover:text-lime-700 transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-earth-asia w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">〇〇一覧</p>
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-slate-400 hover:text-lime-700 transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-location-dot w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">△△一覧</p>
                    </a>
                </div>
            </div>
        </li>
        <li class="w-full h-12 flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-slate-400 hover:text-lime-700 transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-calendar-check w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">××一覧</p>
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-[85%] flex items-center p-2 border-b border-slate-400 hover:text-lime-700 transition duration-500">
                    <a href="" class="jsMenuItems w-full hidden items-center relative">
                        <i class="fas fa-paper-plane w-1/6"></i>
                        <p class="w-5/6 pl-1 text-wrap">お問い合わせ一覧</p>
                        {{-- @if(!empty($variableCount)) --}}
                        <div class="absolute -top-1 -right-4 w-4 h-4 flex justify-center items-center">
                            <i class="fas fa-2xl fa-comment text-rose-500"></i>
                            <p class="text-xs text-white absolute -top-[0.075rem]">
                                {{-- {{ $variableCount }} --}}20
                            </p>
                        </div>
                        {{-- @endif --}}
                    </a>
                </div>
            </div>
        </li>
    </ul>
</nav>

<script>
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
