<h1 class="p-5">
    <a href="{{ route('admin.dashboard.index') }}" class="text-slate-800 text-2xl font-semibold hover:text-gray-500 transition duration-500">
        管理ページ
    </a>
</h1>
<nav class="pt-2 pl-5 pr-1 text-sm text-slate-600">
    <a href="{{ route('admin.sample.list') }}" class="relative flex items-center hover:text-lime-600 pt-7 transition duration-500">
        <i class="fas fa-earth-asia w-1/6"></i>
        <p class="w-5/6">〇〇一覧</p>
        @if (Request::is('admin/sample*'))
        <div class="absolute -left-1 w-[110%] h-full bg-gradient-to-r from-lime-400 via-80% via-lime-100 to-transparent opacity-50 rounded-l-2xl"></div>
        @endif
    </a>
    <a href="" class="relative flex items-center hover:text-lime-600 pt-7 transition duration-500">
        <i class="fas fa-location-dot w-1/6"></i>
        <p class="w-5/6">△△一覧</p>
        @if (Request::is('admin/hoge*'))
        <div class="absolute -left-1 w-[110%] h-full bg-gradient-to-r from-lime-400 via-80% via-lime-100 to-transparent opacity-50 rounded-l-2xl"></div>
        @endif
    </a>
    <a href="" class="relative flex items-center hover:text-lime-600 pt-7 transition duration-500">
        <i class="far fa-calendar-check w-1/6"></i>
        <p class="w-5/6">××一覧</p>
        @if (Request::is('admin/fuga*'))
        <div class="absolute -left-1 w-[110%] h-full bg-gradient-to-r from-lime-400 via-80% via-lime-100 to-transparent opacity-50 rounded-l-2xl"></div>
        @endif
    </a>
    <a href="" class="relative flex items-center hover:text-lime-600 hover:font-semibold pt-7 transition duration-500">
        <i class="fas fa-paper-plane w-1/6"></i>
        <p class="w-5/6">お問い合わせ一覧</p>
        {{-- @if(!empty($variableCount)) --}}
        <div class="absolute z-10 top-2 right-1 w-4 h-4 flex justify-center items-center">
            <i class="fas fa-2xl fa-comment text-rose-500"></i>
            <p class="text-xs text-white absolute -top-[0.05rem]">
                {{-- {{ $variableCount }} --}}20
            </p>
        </div>
        {{-- @endif --}}
        @if (Request::is('admin/inquiry*'))
        <div class="absolute -left-1 w-[110%] h-full bg-gradient-to-r from-lime-400 via-80% via-lime-100 to-transparent opacity-50 rounded-l-2xl"></div>
        @endif
    </a>
</nav>
