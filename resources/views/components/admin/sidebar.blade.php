{{-- layouts.admin -> width = w-52(13rem) --}}
<h1 class="p-5">
    <a href="{{ route('admin.dashboard.index') }}" class="text-2xl font-semibold hover:text-admin-text-mainhover transition duration-500">
        管理ページ
    </a>
</h1>

{{-- 実装時削除
    TODO :
        1. Route -> href="" / Request::is('') ※list,detailがあると思われるのでアスタリスクを付けてください
        2. width -> layouts.adminの幅を変更する場合は、"w-52"の箇所も併せて変更してください
        3. $variableCount -> 通知バッヂが必要な場合は、app/View/Components/layouts/admin/render に処理を記述し、resources/views/components/layouts/admin より変数を受渡してください
--}}
<nav class="pt-2 pl-5 pr-1 text-sm text-admin-text-sub">
    <div class="pt-2 pb-1">
        <a href="{{ route('admin.sample.list') }}" class="relative flex items-center h-12 hover:text-admin-text-subhover transition duration-300 @if(Request::is('admin/sample*')) font-bold @endif">
            <i class="fas fa-earth-asia w-1/6"></i>
            <p class="w-5/6">〇〇一覧</p>
            @if (Request::is('admin/sample*'))
            <div class="absolute -left-5 w-52 h-full bg-admin-accent-type2 opacity-50"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 pb-1 border-t border-white">
        <a href="" class="relative flex items-center h-12 hover:text-admin-text-subhover transition duration-300">
            <i class="fas fa-location-dot w-1/6"></i>
            <p class="w-5/6">△△一覧</p>
            @if (Request::is('admin/hoge*'))
            <div class="absolute -left-5 w-52 h-full bg-admin-accent-type2 opacity-50"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 pb-1 border-t border-white">
        <a href="" class="relative flex items-center h-12 hover:text-admin-text-subhover transition duration-300">
            <i class="far fa-calendar-check w-1/6"></i>
            <p class="w-5/6">××一覧</p>
            @if (Request::is('admin/fuga*'))
            <div class="absolute -left-5 w-52 h-full bg-admin-accent-type2 opacity-50"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 pb-1 border-t border-white relative">
        <a href="" class="relative flex items-center h-12 hover:text-admin-text-subhover transition duration-300">
            <i class="fas fa-paper-plane w-1/6"></i>
            <p class="w-5/6">お問い合わせ一覧</p>
            @if (Request::is('admin/inquiry*'))
            <div class="absolute -left-5 w-52 h-full bg-admin-accent-type2 opacity-50"></div>
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
