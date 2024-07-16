{{-- layouts.admin -> width = w-52(13rem) --}}
<h1 class="p-5">
    <a href="{{ route('home') }}" class="text-2xl font-semibold hover:text-admin-text-mainhover transition duration-500">
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
        <a href="{{ route('api-info.list') }}" class="relative flex items-center h-12 hover:opacity-60 transition duration-300 @if(Request::is('api-info/*')) font-bold @endif">
            <i class="fas fa-wifi w-1/6"></i>
            <p class="w-5/6">API情報管理</p>
            @if (Request::is('api-info/*'))
            <div class="absolute -left-5 w-52 h-full bg-admin-accent2/30"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 pb-1 border-t border-white">
        <a href="{{ route('item.list') }}" class="relative flex items-center h-12 hover:opacity-60 transition duration-300 @if(Request::is('items/*')) font-bold @endif">
            <i class="fas fa-box-open w-1/6"></i>
            <p class="w-5/6">商品情報一覧</p>
            @if (Request::is('items/*'))
            <div class="absolute -left-5 w-52 h-full bg-admin-accent2/30"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 pb-1 border-t border-white">
        <a href="{{ route('order.list') }}" class="relative flex items-center h-12 hover:opacity-60 transition duration-300 @if(Request::is('orders/*')) font-bold @endif">
            <i class="far fa-file-lines w-1/6"></i>
            <p class="w-5/6">受注情報一覧</p>
            @if (Request::is('orders/*'))
            <div class="absolute -left-5 w-52 h-full bg-admin-accent2/30"></div>
            @endif
        </a>
    </div>
    <div class="pt-2 pb-1 border-t border-white relative">
        <a href="{{ route('task.list') }}" class="relative flex items-center h-12 hover:opacity-60 transition duration-300 @if(Request::is('tasks/*')) font-bold @endif">
            <i class="fas fa-list-check w-1/6"></i>
            <p class="w-5/6">ラベル印刷タスク状況</p>
            @if (Request::is('tasks/*'))
            <div class="absolute -left-5 w-52 h-full bg-admin-accent2/30"></div>
            @endif
        </a>
        {{-- @if(!empty($variableCount)) --}}
        <div class="absolute z-10 top-0 right-3 w-4 h-4 flex justify-center items-center">
            <i class="fas fa-2xl fa-comment text-elem-alert"></i>
            <p class="text-xs text-white absolute -top-[0.05rem]">
                {{-- {{ $variableCount }} --}}20
            </p>
        </div>
        {{-- @endif --}}
    </div>
</nav>
