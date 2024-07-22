<x-layouts.admin>
    @push('title')
        タスク状況
    @endpush

    <div class="w-[90%] tablet:w-full mx-auto mt-8 tablet:px-4">
        {{-- Header --}}
        <div class="w-full flex flex-col justify-between items-start">
            {{-- title & messages --}}
            <div class="w-full flex h-10 jusitfy-start items-baseline">
                <h1 class="text-2xl font-semibold text-nowrap">
                    ラベル印刷タスク状況 {{ $isCompleted ? '（完了済）' : '' }}
                </h1>
                <div class="text-xs tablet:text-sm ml-4 tablet:ml-8 grow-[1] font-semibold">
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
            </div>
            {{-- option 1 --}}
            <div class="mt-6 h-10">
                <select id="typeSelect" name="type" class="w-full h-10 px-4 rounded-xl bg-admin-accent font-semibold cursor-pointer">
                    <option value="" class="text-sm font-semibold">全件</option>
                    @forelse ($itemTypes as $type)
                    <option value="{{ $type }}" class="text-sm {{ isset($typeCounts[$type]) ? 'font-semibold' : '' }}" {{ isset($typeCounts[$type]) ? '' : 'disabled' }} >
                        {{ $type }} ( {{ isset($typeCounts[$type]) ? $typeCounts[$type]->count() : 0 }} )
                    </option>
                    @empty
                    @endforelse
                </select>
            </div>
            {{-- option 2 --}}
            <div class="mt-6 h-10 w-full flex justify-between items-center">
                <button id="toggleCheckBtn" type="button" class="rounded-xl mx-1 text-xs px-2 py-2 bg-admin-accent2 hover:bg-admin-accent2/80 text-white transition-all duration-300 {{ $isCompleted ? 'hidden' : ''}}">
                    タスク全選択
                </button>
                <button id="completeTasksBtn" type="button" form="completionForm" class="rounded-xl mx-1 text-xs px-2 py-2 bg-admin-accent2 hover:bg-admin-accent2/80 text-white transition-all duration-300 {{ $isCompleted ? 'hidden' : ''}}">
                    タスク完了報告する
                </button>
                <button id="completedListBtn" type="button" class="rounded-xl mx-1 text-xs px-2 py-2 bg-admin-accent2 hover:bg-admin-accent2/80 text-white transition-all duration-300 {{ $isCompleted ? 'ml-auto' : ''}}">
                    {{ $isCompleted ? 'タスク未完了リスト' : 'タスク完了済リスト'}}
                </button>
            </div>
        </div>


        {{-- List --}}
        <form id="completionForm" action="{{ route('task.completion-report') }}" method="POST" class="w-full mx-auto mt-8 tablet:mt-12">
            @csrf
            <section id="taskContainer" class="w-full">
                {{-- tablet:header --}}
                <header class="hidden tablet:flex px-4 py-2 bg-admin-base font-bold border-t border-b-2 border-admin-accent-type2">
                    <div class="w-16 pc:w-20 text-center">更新日</div>
                    <div class="w-16 text-center">タスク</div>
                    <div class="flex-1 grow-[2] px-2 text-center">商品</div>
                    <div class="hidden md:flex flex-1 grow-[1] px-2 text-center">商品タイプ</div>
                    <div class="flex-1 grow-[2] px-2 text-center">刻印内容</div>
                    {{-- <div class="w-28 pc:w-40"></div> --}}
                </header>

                {{-- items --}}
                @forelse ( $res as $key => $val )
                <section class="relative flex w-full bg-white px-4 py-2 h-28 tablet:h-16 border-b-2 border-admin-accent-type2 {{ $key % 10 === 9 ? 'border-black' : '' }}">
                    {{-- phone --}}
                    <div class="z-1 flex pr-2 min-w-0 tablet:hidden flex-col grow">
                        {{-- main view => 1 --}}
                        <div class="text-xl line-clamp-1 font-semibold break-words">
                            {{ isset($val->updated_at) ? $val->updated_at->format('y/m/d'): $val->created_at->format('y/m/d') }}
                        </div>
                        {{-- sub view => as you like  ** separate with slash(/ ) ** --}}
                        <div class="mt-5 text-xs line-clamp-2 break-words">
                            <span>
                                商品名：{{ $val->item->name }}
                            </span>
                            <span>/</span>
                            <span>
                                ラベル刻印内容： {{ isset($val->print_data) ? $val->print_data : '未' }}
                            </span>
                        </div>
                    </div>

                    {{-- tablet~ --}}
                    <div class="hidden tablet:flex justify-center items-center w-16 pc:w-20">
                        {{-- 画面サイズに応じてformat変更 --}}
                        <p class="block pc:hidden">
                            {{ isset($val->updated_at) ? $val->updated_at->format('y/m/d'): $val->created_at->format('y/m/d') }}
                        </p>
                        <p class="hidden pc:block">
                            {{ isset($val->updated_at) ? $val->updated_at->format('Y/m/d'): $val->created_at->format('Y/m/d') }}
                        </p>
                    </div>
                    <div class="flex justify-center w-16 items-center px-2">
                        <div class="line-clamp-2 break-words">
                            <label for="checkbox{{$val->id}}" class="text-admin-text-sub hover:text-admin-text-subhover cursor-pointer select-none flex items-center">
                                <input type="checkbox" id="checkbox{{$val->id}}" name="task_ids[]" value="{{$val->id}}" {{ $val->completion_status ? 'checked disabled' : '' }}
                                    class="js-chkbox appearance-none w-6 h-6 border border-admin-text-sub rounded-md bg-transparent inline-block relative cursor-pointer checked:border-admin-text-sub hover:scale-90 transition-all duration-300
                                    before:content-[''] before:bg-admin-text-sub before:block before:absolute before:top-1/2 before:left-1/2 before:-translate-x-1/2 before:-translate-y-1/2 before:scale-0 before:w-3 before:h-3 before:rounded-sm before:transition-all before:duration-300 checked:before:scale-100"
                                >
                            </label>
                        </div>
                    </div>
                    <div class="hidden tablet:flex flex-start flex-1 grow-[2] items-center px-2 w-0">
                        <p class="line-clamp-2 break-words">
                            {{ isset($val->item->name) ? $val->item->name : 'NULL' }}
                        </p>
                    </div>
                    <div class="hidden md:flex flex-start flex-1 grow-[1] items-center px-2 w-0">
                        <p class="js-type line-clamp-2 break-words">
                            {{ isset($val->item->type) ? $val->item->type : 'NULL' }}
                        </p>
                    </div>
                    <div class="hidden tablet:flex flex-start flex-1 grow-[2] items-center px-2 w-0">
                        <p class="line-clamp-2 break-words">
                            {{ isset($val->print_data) ? $val->print_data : '未' }}
                        </p>
                    </div>

                    {{-- edit & delete --}}
                    {{-- <div class="flex-none tablet:flex pl-2 w-20 tablet:w-28 pc:w-40 space-y-2 tablet:space-y-0 pc:space-x-1 justify-between">
                        <div class="flex items-center">
                            <a href="{{ route('item.edit', $val->id) }}" class="px-2 pc:px-4 py-2 w-full rounded-xl border-2 border-admin-accent text-admin-accent hover:bg-admin-accent/30 transition-all duration-500 text-sm pc:text-base text-last-justify">
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
        </form>

        {{-- modal --}}
        {{-- <section id="deleteModal" class="z-30 fixed inset-0 items-center justify-center bg-black hidden bg-opacity-30">
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
                    <form id="deleteForm" action="" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </section> --}}
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                /**
                 * チェックボックスのトグルイベント（全選択／全解除）
                 */
                const toggleCheckBtn = document.getElementById('toggleCheckBtn');
                const chkBoxes = document.querySelectorAll('.js-chkbox');

                // ボタンの表示名切替
                function updateToggleButtonText() {
                    const visibleChkBoxes = Array.from(chkBoxes).filter(checkbox =>
                        checkbox.closest('section').style.display !== 'none'
                    );
                    const allChecked = visibleChkBoxes.every(checkbox => checkbox.checked);
                    toggleCheckBtn.textContent = allChecked ? 'タスク全解除' : 'タスク全選択';
                }

                // 全選択・全解除切替
                function toggleAll() {
                    const newState = toggleCheckBtn.textContent === 'タスク全選択';
                    const visibleCheckboxes = Array.from(chkBoxes).filter(checkbox =>
                        checkbox.closest('section').style.display !== 'none'
                    );
                    visibleCheckboxes.forEach(row => {
                        if (row) row.checked = newState;
                    });
                    updateToggleButtonText();
                }

                toggleCheckBtn.addEventListener('click', toggleAll);
                chkBoxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateToggleButtonText);
                });


                /**
                 * 商品タイプの表示切替
                 */
                const typeSelect = document.getElementById('typeSelect');
                const taskContainer = document.getElementById('taskContainer');
                const pagination = document.getElementById('pagination');

                typeSelect.addEventListener('change', function() {
                    const selectedType = this.value;
                    const rows = taskContainer.querySelectorAll('section');
                    let count = 0;

                    rows.forEach(row => {
                        const typeCell = row.querySelector('.js-type');
                        const itemTypeText = typeCell ? typeCell.textContent.trim() : '';
                        const chkBox = row.querySelector('.js-chkbox');
                        if (selectedType === '' || itemTypeText === selectedType) {
                            count++;
                            // visibility
                            row.style.display = '';
                            // border-bottom
                            row.classList.remove('border-black');
                            if (count % 10 === 0) row.classList.add('border-black');
                        } else {
                            row.style.display = 'none';
                            const isCompleted = {{ $isCompleted ? 'true' : 'false' }};
                            if (!isCompleted) {
                                chkBox.checked = false;
                            }
                        }
                    });
                    updateToggleButtonText();
                });


                /**
                 * タスク完了報告確認モーダル
                 */
                const completeTasksBtn = document.getElementById('completeTasksBtn');
                const completionForm = document.getElementById('completionForm');

                completeTasksBtn.addEventListener('click', function() {
                    const checkedBoxes = document.querySelectorAll('.js-chkbox:checked');
                    // if (checkedBoxes.length > 0) {
                        // if (confirm('完了報告しますか？')) {
                            completionForm.submit();
                        // }
                    // } else {
                        // alert('タスクが選択されていません');
                    // }
                });

                /**
                 * タスク完了済リスト取得
                 */
                const completedListBtn = document.getElementById('completedListBtn');
                completedListBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isCompleted = {{ $isCompleted ? 'true' : 'false' }};
                    const url = isCompleted
                        ? "{{ route('task.list') }}"
                        : "{{ route('task.list-completed')}}";
                    window.location.href = url;
                })

                updateToggleButtonText();
            });


            /**
             * modal window (unavailabled)
             */
            const deleteBtn = document.getElementById('deleteBtn');
            const deleteModal = document.getElementById('deleteModal');
            const confirmDelete = document.getElementById('confirmDelete');
            const deleteForm = document .getElementById('deleteForm');
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
                    deleteForm.action = '/delete/' + deleteKeyItem
                    deleteForm.submit();
                }
            });

            /**
             * ボタン外をクリックして閉じる (deleteModal)
             */
            window.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            });
        </script>
    @endpush
</x-layouts.admin>
