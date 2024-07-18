<x-layouts.admin>
    @push('title')
        商品情報一覧
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
                受注情報一覧
            </h1>
        </div>
        <div class="w-full flex justify-end items-center relative mt-2 tablet:pl-4">
            <div class="text-sm mr-4 grow-[1] font-bold">
                @error('err')
                <p class="text-elem-alert">
                    *! {{ $message }}
                </p>
                @enderror
                @if(session('message'))
                <p class="text-elem-success">
                    {{ session('message') }}
                </p>
                @endif
            </div>
            <form action="{{ route('order.csv-upload') }}" method="POST" enctype="multipart/form-data" class="flex items-center justify-end space-x-2 tablet:space-x-4 tablet:mr-4 grow-0">
                @csrf
                <input type="file" name="csvFile" id="csvFile" class="text-sm" accept=".csv,.xlsx">
                <button type="submit" class="bg-admin-accent tablet:mr-4 px-2 tablet:px-4 py-2 rounded-xl min-w-24 hover:bg-admin-accent/80 transition-all duration-300">
                    CSV取込
                </button>
            </form>
        </div>
        <div class="mt-2 pl-4">
            <form action="{{ route('order.task-output') }}" method="POST">
                @csrf
                <button type="submit" class="bg-admin-accent tablet:mr-4 px-2 tablet:px-4 py-2 rounded-xl min-w-24 hover:bg-admin-accent/80 transition-all duration-300">
                    タスク出力
                </button>
            </form>
        </div>

        {{-- table --}}
        <section class="w-full mx-auto mt-12 mb-10 tablet:px-4">
            {{-- tablet:header --}}
            <header class="hidden tablet:flex px-4 py-2 bg-admin-base font-bold border-t border-b-2 border-admin-accent-type2">
                <div class="w-20 pc:w-24 text-center">受信日</div>
                <div class="flex-1 grow-[3] px-2 text-center">受注詳細</div>
                <div class="hidden md:block flex-1 grow-[1] px-2 text-center">ショップ</div>
                {{-- <div class="w-28 pc:w-40"></div> --}}
            </header>

            {{-- items --}}
            @forelse ( $res as $key => $val )
            <section class="relative flex w-full bg-white px-4 py-2 h-28 tablet:h-16 border-b-2 border-admin-accent-type2">
                {{-- phone --}}
                <div class="z-1 flex pr-2 min-w-0 tablet:hidden flex-col grow">
                    {{-- main view => 1 --}}
                    <div class="text-xl line-clamp-1 font-semibold break-words">
                        {{ $val->created_at->format('y/m/d') }}
                    </div>
                    {{-- sub view => as you like  ** separate with slash(/ ) ** --}}
                    <div class="mt-5 text-xs line-clamp-2 break-words">
                        <span>
                            受注詳細 : {{ isset($val->order_detail) ? $val->order_detail : '未設定' }}
                        </span>
                    </div>
                </div>

                {{-- tablet~ --}}
                <div class="hidden tablet:flex items-center w-20 pc:w-24">
                    {{-- 画面サイズに応じてformat変更 --}}
                    <p class="block pc:hidden">
                        {{ $val->created_at->format('y/m/d') }}
                    </p>
                    <p class="hidden pc:block">
                        {{ $val->created_at->format('Y/m/d') }}
                    </p>
                </div>
                <div class="hidden tablet:flex flex-start flex-1 grow-[3] items-center px-2 w-0">
                    <div class="line-clamp-2 break-words">
                        {{ isset($val->order_detail) ? $val->order_detail : '未設定' }}
                    </div>
                </div>
                <div class="hidden md:flex flex-start flex-1 grow-[1] items-center px-2 w-0">
                    <p class="line-clamp-2 break-words">
                        {{ isset($val->shop_name) ? $val->shop_name : '未設定' }}
                    </p>
                </div>

                {{-- edit & delete --}}
                {{-- <div class="flex-none tablet:flex pl-2 w-20 tablet:w-28 pc:w-40 space-y-2 tablet:space-y-0 pc:space-x-1 justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('order.edit', $val->id)}}" class="px-2 pc:px-4 py-2 w-full rounded-xl border-2 border-admin-accent text-admin-accent hover:bg-admin-accent/30 transition-all duration-500 text-sm pc:text-base text-last-justify">
                            編集
                        </a>
                    </div>
                    <div class="flex items-center">
                        <button id="deleteBtn" onclick="showDeleteModal('{{$val->id}}')" class="px-2 pc:px-4 py-2 w-full rounded-xl border-2 border-elem-alert text-elem-alert hover:bg-elem-alert/30 transition-all duration-500 text-sm pc:text-base text-last-justify">
                            削除
                        </button>
                    </div>
                </div> --}}
            </section>
            @empty
            @endforelse
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
                    <button type="button" onclick="closeDeleteModal()" class="px-3 py-1 w-20 border border-elem-info rounded-lg text-elem-info hover:text-white hover:bg-elem-info/80 transition-colors duration-300">
                        いいえ
                    </button>
                    <button type="button" id="confirmDelete" class="px-3 py-1 w-20 border border-elem-alert rounded-lg text-elem-alert hover:text-white hover:bg-elem-alert/80 transition-colors duration-300">
                        はい
                    </button>
                    {{-- deleteform --}}
                    <form id="deleteForm" action="" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </section>
    </div>

    @push('script')
        <script>
            /**
             * modal window
             */
            // const deleteModal = document.getElementById('deleteModal');
            const confirmDelete = document.getElementById('confirmDelete');
            const deleteForm = document.getElementById('deleteForm');
            let deleteKeyItem = null;

            // show
            function showDeleteModal(key) {
                deleteKeyItem = key;
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
                    deleteForm.action = `/orders/delete/${deleteKeyItem}`;
                    deleteForm.submit();
                }
            });

            window.addEventListener('click', function (event) {
                if(event.target === deleteModal) {
                    closeDeleteModal();
                }
            });
        </script>
    @endpush
</x-layouts.admin>
