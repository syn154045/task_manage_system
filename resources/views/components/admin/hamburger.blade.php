<header class="flex items-center justify-between border-b border-slate-800 border-opacity-60">
    <h1 class="flex h-16 text-2xl text-slate-800 font-semibold items-center pl-5">
            管理ページ
    </h1>
    {{-- <button onclick="menuToggle()" class="w-10 mr-3"> --}}
    <button class="w-10 mr-3">
        <label for="checkbox" class="relative w-8 h-10 cursor-pointer flex flex-col justify-center items-center gap-2 duration-500 has-[:checked]:rotate-180 has-[:checked]:duration-500">
            <input type="checkbox" id="checkbox" class="hidden peer" onclick="menuToggle()">
            <div class="w-3/4 h-1 bg-lime-700 rounded-sm peer-checked:absolute peer-checked:w-full peer-checked:rotate-45 peer-checked:duration-500"></div>
            <div class="w-full h-1 bg-lime-700 rounded-sm duration-1000 peer-checked:absolute peer-checked:w-full peer-checked:scale-x-0 peer-checked:duration-500"></div>
            <div class="w-3/4 h-1 bg-lime-700 rounded-sm peer-checked:absolute peer-checked:w-full peer-checked:-rotate-45 peer-checked:duration-500"></div>
        </label>
    </button>
</header>
{{-- ハンバーガーメニュー --}}
<nav class="relative z-[99]">
    <ul id="menuContainer" class="absolute right-0 w-0 py-5 bg-gray-100 text-xs text-slate-600 transition-all duration-500 overflow-x-hidden whitespace-nowrap">
        <li class="w-full flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-5/6 border-b border-slate-400 p-2 hover:text-lime-700 transition duration-500">
                    <a href="">
                        トップページ
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-5/6 border-b border-slate-400 p-2 hover:text-lime-700 transition duration-500">
                    <a href="">
                        アカウント編集
                    </a>
                </div>
            </div>
        </li>
        <li class="w-full flex">
            <div class="w-1/2 flex justify-center">
                <div class="w-5/6 border-b border-slate-400 p-2 hover:text-lime-700 transition duration-500">
                    <a href="">
                        〇〇一覧
                    </a>
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="w-5/6 border-b border-slate-400 p-2 hover:text-lime-700 transition duration-500">
                    <a href="">
                        △△一覧
                    </a>
                </div>
            </div>
        </li>
    </ul>
</nav>

<script>
    const menuContainer = document.getElementById('menuContainer');

    function menuToggle() {
        menuContainer.classList.toggle('w-0');
        menuContainer.classList.toggle('w-full');
    }
</script>
