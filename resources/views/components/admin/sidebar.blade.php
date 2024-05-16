<h1 class="p-5">
    <a href="" class="text-slate-800 text-2xl font-semibold hover:text-gray-500 transition duration-500">
        管理ページ
    </a>
</h1>
<nav class="pt-2 pl-5 pr-1 text-sm text-slate-600">
    <a href="" class="flex items-center hover:text-lime-600 pt-7 transition duration-500">
        <i class="fas fa-users w-1/6"></i>
        <p class="w-5/6">〇〇一覧</p>
    </a>
    <a href="" class="flex items-center hover:text-lime-600 pt-7 transition duration-500">
        <i class="fas fa-location-dot w-1/6"></i>
        <p class="w-5/6">△△一覧</p>
    </a>
    <a href="" class="flex items-center hover:text-lime-600 pt-7 transition duration-500">
        <i class="far fa-calendar-check w-1/6"></i>
        <p class="w-5/6">××一覧</p>
    </a>
    <a href="" class="relative flex items-center hover:text-lime-600 pt-7 transition duration-500">
        <i class="fas fa-paper-plane w-1/6"></i>
        <p class="w-5/6">お問い合わせ一覧</p>
        {{-- @if(!empty($variableCount)) --}}
        <div class="absolute top-3 right-1 w-4 h-4 flex justify-center items-center">
            <i class="fas fa-xl fa-comment text-red-700"></i>
            <p class="text-xs text-white absolute">
                {{-- {{ $variableCount }} --}}20
            </p>
        </div>
        {{-- @endif --}}
    </a>
</nav>
