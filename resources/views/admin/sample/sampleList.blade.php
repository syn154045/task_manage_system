<x-layouts.admin>
    <x-slot:title>
        sampleList Page
    </x-slot:title>

    <div class="w-11/12 tablet:w-full mx-auto mt-8">
        <div class="w-full flex justify-between items-center">
            <h1 class="tablet:pl-2 text-2xl font-semibold">
                {{-- 検索不要な場合は、h1タグのみ残してください --}}
                〇〇一覧
            </h1>
            <div class="tablet:mr-4 pc:mr-10">
                <button class="" onclick="">
                    検索
                    <i class="fas fa-xl fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        <h2 class="pt-2 tablet:pl-10 text-sm">
            〇〇画面にて表示するコンテンツの管理
        </h2>

        {{-- search --}}
        <dialog class="">

        </dialog>

        {{-- table --}}
        <section class="mx-auto mt-8 tablet:px-4">
            {{-- tablet:header --}}
            <header class="hidden tablet:flex px-4 py-2 bg-admin-base font-bold border-t border-b-2 border-admin-accent-type2">
                <div class="w-16 pc:w-20 text-center">更新日</div>
                <div class="flex-1 grow-[1] px-2 text-center">名前</div>
                <div class="hidden md:block flex-1 grow-[2] px-2 text-center">オプション項目</div>
                <div class="hidden pc:block flex-1 grow-[2] px-2 text-center">オプション項目2</div>
                <div class="w-28 pc:w-40"></div>
            </header>

            {{-- items --}}
            {{-- @forelse ( $contents as $key => $val ) --}}
            <section class="relative flex w-full bg-white px-4 py-2 h-28 tablet:h-16 border-b-2 border-admin-accent-type2">
                {{-- phone --}}
                <div class="z-1 flex pr-2 min-w-0 tablet:hidden flex-col grow">
                    {{-- main view => 1 --}}
                    <div class="text-xl line-clamp-1 font-semibold break-words">
                        メイン項目 2行目は表示されません
                    </div>
                    {{-- sub view => as you like  ** separate with comma(, ) ** --}}
                    <div class="mt-5 text-xs line-clamp-2 break-words">
                        サブ項目 / スラッシュで区切って / 表示させてください / ３行目以降は表示されません
                    </div>
                </div>

                {{-- tablet~ --}}
                <div class="hidden tablet:flex justify-center items-center w-16 pc:w-20">
                    {{-- 画面サイズに応じてformat変更 --}}
                    <p class="block pc:hidden">
                        {{-- {{ isset($val->updated_at) ? $val->updated_at->format('y/m/d'): $val->created_at->format('y/m/d') }} --}}
                        24/01/01
                    </p>
                    <p class="hidden pc:block">
                        {{-- {{ isset($val->updated_at) ? $val->updated_at->format('Y/m/d'): $val->created_at->format('Y/m/d') }} --}}
                        2024/01/01
                    </p>
                </div>
                <div class="hidden tablet:flex flex-start flex-1 grow-[1] items-center px-2 w-0">
                    <div class="line-clamp-2 break-words">
                        {{-- {{ isset($val->title) ? $val->title : '未定' }} --}}
                        Jane Doe (~600px)
                    </div>
                </div>
                <div class="hidden md:flex flex-start flex-1 grow-[2] items-center px-2 w-0">
                    <p class="line-clamp-2 break-words">
                        これはmd(768px~)で表示されるコンテンツ例です。
                    </p>
                </div>
                <div class="hidden pc:flex flex-start flex-1 grow-[2] items-center px-2 w-0">
                    <p class="line-clamp-2 break-words">
                        これはpc(1280px~)で表示されるコンテンツ例です。growで表示させるコンテンツ幅を指定してください
                    </p>
                </div>

                {{-- edit & delete --}}
                <div class="flex-none tablet:flex pl-2 w-20 tablet:w-28 pc:w-40 space-y-2 tablet:space-y-0 pc:space-x-1 justify-between">
                    <div class="flex items-center">
                        {{-- routeヘルパーの第二引数にidを指定 --}}
                        <a href="" class="px-2 pc:px-4 py-2 w-full rounded-xl border-2 border-admin-accent-type1 text-admin-accent-type1 hover:bg-admin-accent-type1hover hover:bg-opacity-20 transition-all duration-500 text-sm pc:text-base text-last-justify">
                            編集
                        </a>
                    </div>
                    <div class="flex items-center">
                        {{-- onclick="my_modal_{{ $key }}.showModal()" --}}
                        <button class="px-2 pc:px-4 py-2 w-full rounded-xl border-2 border-admin-alert text-admin-alert hover:bg-admin-alert hover:bg-opacity-20 transition-all duration-500 text-sm pc:text-base text-last-justify" onclick="my_modal_1.showModal()">
                            削除
                        </button>
                    </div>
                </div>
            </section>

            {{-- modal --}}
            <dialog id="my_modal_1" class="dui-modal">
                <div class="dui-modal-box">
                    <form method="dialog">
                        <button class="dui-btn dui-btn-sm dui-btn-circle dui-btn-ghost absolute right-2 top-2">
                            ✕
                        </button>
                    </form>
                    <h3 class="font-bold text-lg">
                        削除してもよろしいですか？
                    </h3>
                    <div class="flex justify-center mt-5 space-x-10 tablet:space-x-14">
                        <form method="dialog">
                            @csrf
                            <button class="w-24 px-4 py-2 border-2 border-admin-text-main text-admin-text-main hover:bg-admin-text-mainhover hover:bg-opacity-20 rounded-xl transition-all duration-500 ">
                                いいえ
                            </button>
                        </form>
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- 削除対象のidをポスト --}}
                            <input type="hidden" name="" value="">
                            <button class="w-24 px-4 py-2 border-2 border-admin-alert text-admin-alert hover:bg-admin-alert hover:bg-opacity-20 rounded-xl transition-all duration-500 items-center">
                                はい
                            </button>
                        </form>
                    </div>
                </div>
            </dialog>
            {{-- @empty
            @endforelse --}}
        </section>
    </div>

    @push('script')
        <script>
        </script>
    @endpush
</x-layouts.admin>
