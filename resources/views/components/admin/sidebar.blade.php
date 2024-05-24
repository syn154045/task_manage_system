<h1 class="p-5">
    <a href="{{ route('admin.dashboard.index') }}" class="text-2xl font-semibold hover:text-admin-text-mainhover transition duration-500">
        管理ページ
    </a>
</h1>
<nav class="pt-2 pl-5 pr-1 text-sm text-admin-text-sub">
    <div class="pt-2 border-t border-white">
        <a href="{{ route('admin.sample.list') }}" class="relative flex items-center h-12 hover:text-admin-text-subhover hover:font-semibold transition duration-500">
            <i class="fas fa-earth-asia w-1/6"></i>
            <p class="w-5/6">〇〇一覧</p>
            @if (Request::is('admin/sample*'))
            <div class="absolute -left-3 w-full h-full bg-gradient-to-r from-admin-accent-type2 to-transparent opacity-50 rounded-l-2xl"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 border-t border-white">
        <a href="" class="relative flex items-center h-12 hover:text-admin-text-subhover hover:font-semibold transition duration-500">
            <i class="fas fa-location-dot w-1/6"></i>
            <p class="w-5/6">△△一覧</p>
            @if (Request::is('admin/hoge*'))
            <div class="absolute -left-1 w-full h-full bg-gradient-to-r from-admin-accent-type2 to-transparent opacity-50 rounded-l-2xl"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 border-t border-white">
        <a href="" class="relative flex items-center h-12 hover:text-admin-text-subhover hover:font-semibold transition duration-500">
            <i class="far fa-calendar-check w-1/6"></i>
            <p class="w-5/6">××一覧</p>
            @if (Request::is('admin/fuga*'))
            <div class="absolute -left-1 w-full h-full bg-gradient-to-r from-admin-accent-type2 to-transparent opacity-50 rounded-l-2xl"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 border-t border-white relative">
        <a href="" class="relative flex items-center h-12 hover:text-admin-text-subhover hover:font-semibold transition duration-500">
            <i class="fas fa-paper-plane w-1/6"></i>
            <p class="w-5/6">お問い合わせ一覧</p>
            @if (Request::is('admin/inquiry*'))
            <div class="absolute -left-1 w-full h-full bg-gradient-to-r from-admin-accent-type2 to-transparent opacity-50 rounded-l-2xl"></div>
            @endif
        </a>
        {{-- @if(!empty($variableCount)) --}}
        <div class="absolute z-10 top-0 right-3 w-4 h-4 flex justify-center items-center">
            <i class="fas fa-2xl fa-comment text-admin-alert"></i>
            <p class="text-xs text-white absolute -top-[0.05rem]">
                {{-- {{ $variableCount }} --}}20
            </p>
        </div>
        {{-- @endif --}}
    </div>
</nav>
