<x-layouts.admin>
    <x-slot:title>
        sampleList Page
    </x-slot:title>

    <div class="w-11/12 tablet:w-full mx-auto mt-8">
        <h1 class="tablet:pl-2 text-2xl font-semibold text-slate-800">
            〇〇一覧
        </h1>
        <h2 class="pt-2 tablet:pl-10 text-sm">
            〇〇画面にて表示するコンテンツの管理
        </h2>

        <section class="mx-auto mt-8 tablet:px-4">
            {{-- tablet:header --}}
            <header class="hidden tablet:flex p-2 bg-admin-main font-bold">
                <div class="flex-none  text-center">更新日</div>
                <div class="grow text-center">名前</div>
                {{-- いらなければ消去してください --}}
                <div class="hidden pc:block grow text-center">列3</div>
                <div class="flex-none w-1/4"></div>
            </header>

            {{-- items --}}
            {{-- @forelse ( $contents as $key => $val ) --}}
            <section class="flex bg-white px-4 py-2">
                {{-- phone --}}
                <div class="flex tablet:hidden flex-col flex-grow font-bold">
                    {{-- main view => 1 --}}
                    <div class="text-xl line-clamp-1">
                        メイン項目 2行目は表示されません
                    </div>
                    {{-- sub view => as you like  ** separate with comma(, ) ** --}}
                    <div class="mt-5 pr-2 text-sm line-clamp-2">
                        サブ項目 / スラッシュで区切って / 表示させてください / ３行目以降は表示されません
                    </div>
                </div>
                {{-- タブレット(以上)用データ行 以下３つのブロックは 一つのブロック要素として記述すると上のテーブルヘッダーと合わなくなります--}}
                <div class="hidden tablt:flex">
                    <div class="flex-none justify-center items-center w-[80px] h-[50px]">
                        {{-- 画面サイズに応じてformat変更 --}}
                        <span class="block pc:hidden">
                            {{-- {{ isset($val->updated_at) ? $val->updated_at->format('y/m/d'): $val->created_at->format('y/m/d') }} --}}
                            24/12/12
                        </span>
                        <span class="hidden pc:block">
                            {{-- {{ isset($val->updated_at) ? $val->updated_at->format('Y/m/d'): $val->created_at->format('Y/m/d') }} --}}
                            2024/12/12
                        </span>
                    </div>
                    <div class="grow items-center justify-center px-2 ">
                        <span class="line-clamp-2">
                            {{-- {{ isset($val->title) ? $val->title : '未定' }} --}}
                            kodekodekodeko
                        </span>
                    </div>
                    {{-- いらなければ消去してください --}}
                    <div class="hidden pc:flex items-center justify-center grow ">
                        {{-- データ{{ $key + 1 }}-3 --}}
                        dadadadadadadada
                    </div>
                </div>
                {{-- edit & delete --}}
                <div class="w-[5rem] tablet:flex space-y-2 tablet:space-y-0 justify-around flex-none tablet:w-1/4 tablet:min-w-[80px] tablet:max-h-[50px]">
                    <div class="flex items-center">
                        {{-- routeヘルパーの第二引数にidを指定 --}}
                        <a href="" class="rounded border-2 border-lime-200 text-lime-500 hover:bg-lime-400 transition-all duration-300 tablet:text-[1.6vw] pc:text-[20px] px-1 py-2 pc:py-1 ">編集</a>
                    </div>
                    <div class="flex items-center">
                        {{-- <button class="border border-red-500 text-red-500 px-1 py-2 pc:py-1 rounded tablet:text-[1.6vw] pc:text-[20px]" onclick="my_modal_{{ $key }}.showModal()">削除</button> --}}
                        <button class="border border-red-500 text-red-500 px-1 py-2 pc:py-1 rounded tablet:text-[1.6vw] pc:text-[20px]" onclick="my_modal_1.showModal()">削除</button>
                        <!-- モーダル -->
                        {{-- <dialog id="my_modal_{{ $key }}" class="dui-modal"> --}}
                        <dialog id="my_modal_1" class="dui-modal">
                            <div class="dui-modal-box">
                                <form method="dialog">
                                    <button class="dui-btn dui-btn-sm dui-btn-circle dui-btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="font-bold text-lg">削除してもよろしいですか？</h3>
                                <div class="flex justify-center mt-3">
                                    <form method="dialog">
                                        @csrf
                                        <button class="dui-btn dui-btn-outline rounded dui-btn-success dui-btn-sm tablet:w-20">いいえ</button>
                                    </form>
                                    <div class="ml-2">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{-- 削除対象のidをポスト --}}
                                            <input type="hidden" name="" value="">
                                            <button class="dui-btn dui-btn-outline rounded dui-btn-error dui-btn-sm tablet:w-20 mr-2">はい</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </dialog>
                    </div>
                </div>
            </section>
            {{-- @empty
            @endforelse --}}
        </section>
    </div>

    @push('script')
    <script>
    </script>
    @endpush
</x-layouts.admin>
