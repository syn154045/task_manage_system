<x-layouts.admin>
    @push('title')
        dashboard
    @endpush

    {{-- 実装時削除
        TODO :
            1. Route -> href=""
            2. $variableCount -> 通知バッヂが必要な場合は、compactで渡してください
    --}}
    <h1 class="text-center mt-8 mx-2 tablet:mt-20 text-sm tablet:text-lg">
        @if (\Carbon\Carbon::now()->format('H') < 10 && \Carbon\Carbon::now()->format('H') > 5)
        <p>{{ Auth::guard('administrators')->user()->name }} さん　おはようございます。</p>
        @elseif (\Carbon\Carbon::now()->format('H') < 18)
        <p>{{ Auth::guard('administrators')->user()->name }} さん　こんにちは。</p>
        @else
        <p>{{ Auth::guard('administrators')->user()->name }} さん　こんばんは、<br/>遅くまでお疲れ様です。</p>
        @endif
    </h1>

    <h2 class="mt-10 tablet:mt-20 text-center text-xl tablet:text-2xl font-semibold">
        管理画面　メインメニュー
    </h2>

    <div class="w-full max-w-3xl mx-auto mt-10 mb-12 grid grid-cols-1 tablet:grid-cols-2 gap-6 tablet:gap-x-8 tablet:gap-y-10 tablet:justify-around tablet:text-lg">
        <a href="{{ route('admin.sample.list')}}" class="flex justify-center items-center w-[85%] h-16 tablet:h-20 mx-auto p-4 bg-admin-accent-type1 rounded-3xl hover:bg-admin-accent-type1hover transition-all duration-300">
            <i class="fas fa-earth-asia w-1/6"></i>
            <p class="w-5/6 pl-1">〇〇一覧</p>
        </a>
        <a href="" class="flex justify-center items-center w-[85%] h-16 tablet:h-20 mx-auto p-4 bg-admin-accent-type1 rounded-3xl hover:bg-admin-accent-type1hover transition-all duration-300">
            <i class="fas fa-location-dot w-1/6"></i>
            <p class="w-5/6 pl-1">△△一覧</p>
        </a>
        <a href="" class="flex justify-center items-center w-[85%] h-16 tablet:h-20 mx-auto p-4 bg-admin-accent-type1 rounded-3xl hover:bg-admin-accent-type1hover transition-all duration-300">
            <i class="fas fa-calendar-check w-1/6"></i>
            <p class="w-5/6 pl-1">××一覧</p>
        </a>
        <a href="" class="flex justify-center items-center w-[85%] h-16 tablet:h-20 mx-auto p-4 bg-admin-accent-type1 rounded-3xl hover:bg-admin-accent-type1hover transition-all duration-300 relative">
            <i class="fas fa-paper-plane w-1/6"></i>
            <p class="w-5/6 pl-1">お問合せ一覧</p>
            {{-- @if(!empty($variableCount)) --}}
            <div class="absolute top-0 -right-2 tablet:-right-1 w-4 h-5 flex justify-center items-center">
                <i class="fas fa-2xl fa-comment text-admin-alert"></i>
                <p class="text-xs text-white absolute -top-[0.05rem]">
                    {{-- {{ $variableCount }} --}}20
                </p>
            </div>
            {{-- @endif --}}
        </a>
    </div>
</x-layouts.admin>
