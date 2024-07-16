<x-layouts.admin>
    @push('title')
        sampleList Page
    @endpush

    {{-- 実装時削除してください
        TODO :
            1. 検索機能 -> 不要な場合、該当箇所削除してください / また、テキスト検索・ラジオボタン・チェックボックスを設置していますが、適宜必要なアイテムを使用してください
            2. contents -> 必要な項目数をウィンドウ幅に応じて設定してください (tablet = 600px- / md = 768px- / lg = 1024px- / pc = 1280px-)
            3. modal, detail -> idを変数に置換してください
    --}}
    <div class="w-[90%] tablet:w-full mx-auto mt-8">
        <div class="w-full flex justify-between items-center relative">
            <h1 class="tablet:pl-2 text-2xl font-semibold">
                〇〇一覧
            </h1>
            {{-- 1. 不要な場合削除　ここから --}}
            <div id="searchBtn" class="tablet:mr-4 pc:mr-10 bg-admin-main rounded-t-xl transition-all duration-500 hover:bg-opacity-40">
                <button class="p-2" onclick="searchDropdownToggle()">
                    <i class="fas fa-xl fa-magnifying-glass"></i>
                </button>
            </div>
            {{-- search --}}
            <section id="searchMenu" class="absolute z-10 top-10 right-0 tablet:right-4 pc:right-10 w-full tablet:w-[95%] h-56 bg-admin-main shadow-admin-main shadow-lg rounded-tl-xl rounded-b-xl hidden opacity-0 transition-opacity duration-500 ease-out">
                <form method="GET" action="" class="mx-4 mt-4 text-sm">
                    {{-- input text --}}
                    <div class="mt-2 relative">
                        <input type="text" id="searchText" name="searchText" value="" placeholder="searchText" class="peer px-3 pt-2 pb-1 w-full outline-none bg-transparent placeholder:text-transparent">
                        <div class="h-[0.05rem] bg-admin-text-sub peer-focus:bg-gradient-to-r from-admin-accent-type2 to-admin-accent-type2hover transition-colors duration-300"></div>
                        <label for="searchText" class="block absolute -top-3 cursor-none text-xs transition-all duration-500 peer-focus:text-admin-text-subhover peer-focus:-top-3 peer-focus:text-xs peer-focus:transition-all peer-focus:duration-300 peer-placeholder-shown:top-1 peer-placeholder-shown:text-sm peer-placeholder-shown:cursor-text">
                            検索テキスト
                        </label>
                    </div>
                    {{-- option button --}}
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="inline-block relative cursor-pointer">
                            <label for="radio1" class="flex items-center pl-6 relative cursor-pointer transition-all duration-300 ease-in-out has-[:checked]:text-admin-accent-type2 group">
                                <input type="radio" id="radio1" class="peer absolute opacity-0 w-0 h-0" name="type" value="radio1" checked>
                                <span class="absolute top-1 left-1 w-4 h-4 border border-admin-text-sub rounded-[50%] transition-all duration-300 ease-in-out peer-checked:bg-admin-accent-type2 peer-checked:border-transparent peer-checked:scale-75 peer-checked:shadow-lg peer-checked:shadow-admin-accent-type2 group-hover:scale-110 group-hover:border-admin-accent-type2 group-hover:shadow-lg group-hover:shadow-admin-accent-type2"></span>
                                radio 1
                            </label>
                        </div>
                        <div class="inline-block relative cursor-pointer">
                            <label for="radio2" class="flex items-center pl-6 relative cursor-pointer transition-all duration-300 ease-in-out has-[:checked]:text-admin-accent-type2 group">
                                <input type="radio" id="radio2" class="peer absolute opacity-0 w-0 h-0" name="type" value="radio2">
                                <span class="absolute top-1 left-1 w-4 h-4 border border-admin-text-sub rounded-[50%] transition-all duration-300 ease-in-out peer-checked:bg-admin-accent-type2 peer-checked:border-transparent peer-checked:scale-75 peer-checked:shadow-lg peer-checked:shadow-admin-accent-type2 group-hover:scale-110 group-hover:border-admin-accent-type2 group-hover:shadow-lg group-hover:shadow-admin-accent-type2"></span>
                                radio 2
                            </label>
                        </div>
                    </div>
                    {{-- check box --}}
                    <div class="mt-4 ml-1">
                        <div class="flex space-x-6">
                            <label for="checkbox1" class="text-admin-text-sub hover:text-admin-text-subhover cursor-pointer select-none flex items-center">
                                <input type="checkbox" id="checkbox1" name="checkbox1" class="appearance-none w-4 h-4 border border-admin-text-sub rounded-md bg-transparent inline-block relative mr-2 cursor-pointer before:content-[''] before:bg-admin-accent-type2 before:block before:absolute before:top-1/2 before:left-1/2 before:-translate-x-1/2 before:-translate-y-1/2 before:scale-0 before:w-2 before:h-2 before:rounded-sm before:transition-all before:duration-300 checked:before:scale-100 checked:border-admin-accent-type2 hover:scale-110 transition-all duration-300">
                                checkbox1
                            </label>
                            <label for="checkbox2" class="text-admin-text-sub hover:text-admin-text-subhover cursor-pointer select-none flex items-center">
                                <input type="checkbox" id="checkbox2" name="checkbox1" class="appearance-none w-4 h-4 border border-admin-text-sub rounded-md bg-transparent inline-block relative mr-2 cursor-pointer before:content-[''] before:bg-admin-accent-type2 before:block before:absolute before:top-1/2 before:left-1/2 before:-translate-x-1/2 before:-translate-y-1/2 before:scale-0 before:w-2 before:h-2 before:rounded-sm before:transition-all before:duration-300 checked:before:scale-100 checked:border-admin-accent-type2 hover:scale-110 transition-all duration-300">
                                checkbox2
                            </label>
                        </div>
                    </div>
                    {{-- toggle button --}}
                    <div class="mt-4 ml-1">
                        <div class="flex items-center h-4 space-x-4">
                            <p class="text-admin-alert">
                                OFF
                            </p>
                            <label class="relative w-10 h-4">
                                <input type="checkbox" name="toggle1" class="peer opacity-0">
                                <span class="absolute top-0 left-0 right-0 bottom-0 bg-white border border-admin-text-sub transition-colors duration-300 cursor-pointer rounded-3xl peer-checked:bg-admin-accent-type1 peer-checked:border-admin-accent-type1 before:absolute before:content-[''] before:h-3 before:w-3 before:rounded-2xl before:top-[0.1rem] before:left-1 before:bg-admin-text-sub before:transition before:duration-300 peer-checked:before:translate-x-5 peer-checked:before:bg-white"></span>
                            </label>
                            <p class="text-admin-accent-type1">
                                ON
                            </p>
                        </div>
                    </div>

                    {{-- submit button --}}
                    <div class="mt-4 mx-auto w-20 text-xs">
                        <button class="px-3 py-2 border-2 rounded-lg border-admin-accent-type1 text-admin-accent-type1 hover:bg-admin-accent-type1hover hover:bg-opacity-40 transition-all duration-500" onclick="">
                            検索
                        </button>
                    </div>
                </form>
            </section>
            {{-- 1. 不要な場合削除　ここまで --}}
        </div>
        <h2 class="pt-2 tablet:pl-10 text-sm">
            〇〇画面にて表示するコンテンツの管理
        </h2>


        {{-- table --}}
        <section class="w-full mx-auto mt-20 tablet:px-4">
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
                    {{-- sub view => as you like  ** separate with slash(/ ) ** --}}
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
                        <a href="{{ route('api-info.detail', 1)}}" class="px-2 pc:px-4 py-2 w-full rounded-xl border-2 border-admin-accent-type1 text-admin-accent-type1 hover:bg-admin-accent-type1hover hover:bg-opacity-20 transition-all duration-500 text-sm pc:text-base text-last-justify">
                            編集
                        </a>
                    </div>
                    <div class="flex items-center">
                        <button id="deleteBtn" onclick="showDeleteModal(1)" class="px-2 pc:px-4 py-2 w-full rounded-xl border-2 border-admin-alert text-admin-alert hover:bg-admin-alert hover:bg-opacity-20 transition-all duration-500 text-sm pc:text-base text-last-justify">
                            削除
                        </button>
                    </div>
                </div>
            </section>
            {{-- @empty --}}
            {{-- @endforelse --}}
        </section>

        {{-- modal --}}
        <section id="deleteModal" class="z-30 fixed inset-0 items-center justify-center bg-black hidden bg-opacity-30">
            <div class="py-4 px-3 tablet:px-6 bg-stone-50 rounded-xl shadow-2xl flex flex-col">
                <div class="flex justify-between items-center">
                    <h2 class="text-xs border-b border-admin-text-sub pr-10">
                        確認
                    </h2>
                    <button type="button" onclick="closeDeleteModal()" class="p-1">
                        ×
                    </button>
                </div>
                <h3 class="mt-4">
                    本当に削除しますか？
                </h3>
                <div class="mt-5 mx-4 tablet:mx-8 flex justify-center space-x-8 text-sm">
                    <button type="button" onclick="closeDeleteModal()" class="px-3 py-1 w-20 border border-admin-text-subhover rounded-lg text-admin-text-sub hover:text-white hover:bg-admin-text-subhover transition-colors duration-300">
                        いいえ
                    </button>
                    <button type="button" id="confirmDelete" class="px-3 py-1 w-20 border border-admin-alert rounded-lg text-admin-alert hover:text-white hover:bg-admin-alert transition-colors duration-300">
                        はい
                    </button>
                    {{-- deleteform --}}
                    <form id="deleteForm" action="" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </section>
    </div>

    @push('script')
        <script>
            /**
             * searchDropdown
             */
            const searchBtn = document.getElementById('searchBtn');
            const searchMenu = document.getElementById('searchMenu');

            function searchDropdownToggle() {
                if (searchMenu.classList.contains('animate-fade-in')) {
                    searchMenu.classList.add('animate-fade-out');
                    setTimeout(() => {
                        searchMenu.classList.remove('animate-fade-in');
                        searchMenu.classList.add('hidden');
                    }, 500);
                } else {
                    searchMenu.classList.remove('animate-fade-out');
                    searchMenu.classList.remove('hidden');
                    setTimeout(() => {
                        searchMenu.classList.add('animate-fade-in');
                    }, 10);
                }
            };

            // windowイベントリスナを起動させない
            searchBtn.addEventListener('click', function (event) {
                event.stopPropagation();
                searchDropdownToggle();
            });
            searchMenu.addEventListener('click', function (event) {
                event.stopPropagation();
            });


            /**
             * modal window
             */
            const deleteBtn = document.getElementById('deleteBtn');
            const deleteModal = document.getElementById('deleteModal');
            const confirmDelete = document.getElementById('confirmDelete');
            const deleteForm = document .getElementById('deleteForm');
            let deleteKeyItem = null;

            // show
            function showDeleteModal(key) {
                deleteKeyItem = key;
                console.log(deleteKeyItem);
                deleteModal.classList.remove('animate-fade-out');
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
                deleteModal.classList.add('animate-fade-in');
            }

            // hide
            function closeDeleteModal() {
                deleteModal.classList.add('animate-fade-out');
                setTimeout(() => {
                    deleteModal.classList.remove('flex');
                    deleteModal.classList.remove('animate-fade-in');
                    deleteModal.classList.add('hidden');
                }, 500);
            }

            // delete request
            confirmDelete.addEventListener('click', function () {
                if (deleteKeyItem !== null) {
                    // @ json(route(delete.name, deleteKeyItem))
                    deleteForm.action = '/delete/' + deleteKeyItem
                    deleteForm.submit();
                }
            });

            /**
             * ボタン外をクリックして閉じる (search / deleteModal)
             */
            window.addEventListener('click', function (event) {
                console.log(event);
                if (!event.target.matches('#searchBtn')) {
                    if (searchMenu.classList.contains('animate-fade-in')) {
                        searchMenu.classList.add('animate-fade-out');
                        setTimeout(() => {
                            searchMenu.classList.remove('animate-fade-in');
                            searchMenu.classList.add('hidden');
                        }, 500);
                    }
                }
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            });
        </script>
    @endpush
</x-layouts.admin>
