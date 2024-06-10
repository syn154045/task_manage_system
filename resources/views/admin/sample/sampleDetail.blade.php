<x-layouts.admin>
    @push('title')
        sampleDetail Page
    @endpush

    @push('script')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-ja-JP.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"
            integrity="sha512-Z8CqofpIcnJN80feS2uccz+pXWgZzeKxDsDNMD/dJ6997/LSRY+W4NmEt9acwR+Gt9OHN0kkI1CTianCwoqcjQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @vite('resources/js/handleFileinputArray.js')
    @endpush

    <style>
        .note-editable {
            background-color: rgba(255, 255, 255) !important;
            /* フルスクリーンモードの背景を白に設定 */
        }
    </style>

    {{-- 実装時削除
        TODO :
            1. file-manager -> 画像・PDF・動画全てfiile-managerで管理可能（入れていません）
            2. chip-js -> 総入替にて実装されているみたいです
            3. コンテンツに応じて使用してください
    --}}
    <div class="w-11/12 tablet:w-full  mx-auto pl-2 mt-8">
        <h1 class="text-2xl font-semibold text-slate-800 h-[10vh]">
            サンプル{{ isset($artist)? '更新' : '登録' }}
        </h1>

        {{-- メインコンテンツ --}}
        <div class="flex justify-center w-full">
            <div class="w-11/12 h-full bg-white border border-solid flex justify-center items-center py-10">
                <div class="w-11/12 h-[90%]">
                    <form id="form"
                        {{-- action="{{ isset($artist) ? route('admin.artist.update', $artist->uuid) : route('admin.artist.store') }}" --}}
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($artist))
                            @method('PUT')
                        @endif
                        <div class="grid gap-y-4">
                            <div class="grid grid-cols-1 tablet:grid-cols-3 gap-3">
                                {{-- toggle switch --}}
                                <div class="flex justify-center tablet:justify-end items-center w-full">
                                    <div class="min-w-[10rem] w-1/5">
                                        <div class="py-2 text-start w-full flex justify-between">
                                            <p class="font-bold text-red-500">非表示</p>
                                            <input type="checkbox" name="view_flg" class="dui-toggle"
                                                {{ old('view_flg',!empty($slider['view_flg']) ? 'checked' : '') ?? '' }} />
                                            <p class="font-bold text-green-500">表示</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="flex items-center gap-2">
                                        <span class="text-red-500" >※</span>タイプ
                                    </label>
                                    <div class="grid grid-cols-2 gap-3 w-full">
                                        <label class="flex items-center">
                                            <input id="js-img-radio" type="radio" name="type" value="0"
                                                class="dui-radio dui-radio-success mr-1"
                                                {{ !empty($slider) && $slider->type === 0 ? 'checked' : '' }}
                                                {{ !empty(old('type')) && old('type' ) === '0' ? 'checked' : '' }}
                                                {{ empty($slider) && empty(old('type')) ? 'checked' : '' }} />
                                            画像
                                        </label>
                                        <label class="flex items-center">
                                            <input id="js-vid-radio" type="radio" name="type" value="1"
                                                class="dui-radio dui-radio-success mr-1"
                                                {{ !empty($slider) && $slider->type === 1 ? 'checked' : '' }}
                                                {{ !empty(old('type')) && old('type') === '1' ? 'checked' : '' }} />
                                            動画
                                        </label>
                                    </div>
                                    @error('type')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- input text --}}
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        <span class="text-red-500" >※</span>名前
                                    </label>
                                    <input type="text" name="name"
                                        value="{{ old('name', isset($artist->name) ? $artist->name : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="東京太郎" />
                                    @error('name')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        名前サブ
                                    </label>

                                    <input type="text" name="name_sub"
                                        value="{{ old('name_sub', isset($artist->name_sub) ? $artist->name_sub : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="Taro Tokyo" />
                                    @error('name_sub')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        生年月日
                                    </label>
                                    <input type="date" name="birthday"
                                        value="{{ old('birthday', isset($artist->birthday) ? $artist->birthday->format('Y-m-d') : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" />
                                    @error('birthday')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 tablet:grid-cols-2 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        国籍
                                    </label>

                                    <input type="text" name="nationality"
                                        value="{{ old('nationality', isset($artist->nationality) ? $artist->nationality : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="日本" />
                                    @error('nationality')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        出身地
                                    </label>

                                    <input type="text" name="birth_place"
                                        value="{{ old('birth_place', isset($artist->birth_place) ? $artist->birth_place : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="東京都" />
                                    @error('birth_place')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        身長
                                    </label>

                                    <input type="number" name="height" step="0.1"
                                        value="{{ old('height', isset($artist->height) ? $artist->height : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="180.0" />
                                    @error('height')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        体重
                                    </label>

                                    <input type="number" name="weight" step="0.1"
                                        value="{{ old('weight', isset($artist->weight) ? $artist->weight : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="66.8" />
                                    @error('weight')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        バスト
                                    </label>

                                    <input type="number" name="bust" step="0.1"
                                        value="{{ old('bust', isset($artist->bust) ? $artist->bust : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="97.5" />
                                    @error('bust')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        ウェスト
                                    </label>

                                    <input type="number" name="waist" step="0.1"
                                        value="{{ old('waist', isset($artist->waist) ? $artist->waist : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="75.8" />
                                    @error('waist')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        ヒップ
                                    </label>

                                    <input type="number" name="hip" step="0.1"
                                        value="{{ old('hip', isset($artist->hip) ? $artist->hip : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="84.6" />
                                    @error('hip')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        靴サイズ
                                    </label>

                                    <input type="number" name="shoes_size" step="0.1"
                                        value="{{ old('shoes_size', isset($artist->shoes_size) ? $artist->shoes_size : '') ?? '' }}"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="27.5" />
                                    @error('shoes_size')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 tablet:grid-cols-3 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        趣味
                                    </label>

                                    <textarea name="hobby" class="dui-textarea dui-textarea-bordered w-full" placeholder="読書">{{ old('hobby', isset($artist->hobby) ? $artist->hobby : '') ?? '' }}</textarea>
                                    @error('hobby')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        特技
                                    </label>

                                    <textarea name="skill" class="dui-textarea dui-textarea-bordered w-full" placeholder="空手黒帯">{{ old('skill', isset($artist->skill) ? $artist->skill : '') ?? '' }}</textarea>
                                    @error('skill')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        プロフィール
                                    </label>

                                    <textarea name="profile" class="dui-textarea dui-textarea-bordered w-full" placeholder="モデルとして活動">{{ old('profile', isset($artist->profile) ? $artist->profile : '') ?? '' }}</textarea>
                                    @error('profile')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        経歴
                                    </label>
                                    <p class="text-xs">※動画を中央寄せしたい場合は中央揃えを選択してから動画を挿入してください。</p>
                                    <div class="summernote-container">
                                        <textarea id="summernote-editor" name="career">{{ old('career', isset($artist->career) ? $artist->career : '') ?? '' }}</textarea>
                                    </div>
                                    @error('career')
                                        <p class="text-error text-sm">※{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-3">
                                <div class="w-full">
                                    <div>カテゴリー</div>
                                    <div id="chips-container"
                                        class="chips-input flex flex-wrap items-center border-b border-solid border-[#ccc] p-[5px]">
                                        <div class="w-fit h-fit relative m-5">
                                            <input type="text" id="chips-input" placeholder="Add a chip"
                                                class="dui-input dui-input-bordered" autocomplete="off">
                                            <div id="autocomplete-container" class="autocomplete-suggestions"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tags" id="chips-hidden-input">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="col-span-1">
                                    <div class="flex">
                                        <div><span class="text-red-500" >※</span>TOP画像</div>
                                        @error('top_path')
                                            <p class="text-error text-sm">※{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button id="top-button" class="dui-btn " onclick="setImg(this)"
                                        type="button">ファイルを選択</button>
                                    @if (!empty($artist))
                                        @foreach ($artist->images as $image)
                                            @if ($image->is_top)
                                                <input id="top-input" type="hidden" name="top_path"
                                                    value="{{ old('top_path', isset($image->file_path) ? $image->file_path : '') ?? '' }}">
                                            @endif
                                        @endforeach
                                    @else
                                        <input id="top-input" type="hidden" name="top_path"
                                            value="{{ old('top_path', isset($image->file_path) ? $image->file_path : '') ?? '' }}">
                                    @endif
                                </div>
                                <div>
                                    @if (!empty($artist))
                                        @foreach ($artist->images as $image)
                                            @if ($image->is_top)
                                                <img id="top-img"
                                                    src="{{ old('top_path', isset($image->file_path) ? $image->file_path : '') ?? '' }}"
                                                    alt="">
                                            @endif
                                        @endforeach
                                    @else
                                        <img id="top-img"
                                            src="{{ old('top_path', isset($image->file_path) ? $image->file_path : '') ?? '' }}"
                                            alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="grid grid-cols-1 tablet:grid-cols-2 gap-x-3 gap-y-10">
                                <div class="grid grid-cols-2">
                                    <div class="col-span-1">
                                        <div class="flex">
                                            <p>コンポジPDF</p>
                                            @error('composite_path')
                                                <p class="text-error text-sm">※{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button class="dui-btn " onclick="setPdf(this)"
                                            type="button">ファイルを選択</button>
                                        <input type="hidden" id="js-cp-input" name="composite_path">
                                    </div>
                                    <div id="js-cp-conteinr">

                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="col-span-1">
                                        <div>
                                            <p>プロフィールPDF</p>
                                            @error('profile_path')
                                                <p class="text-error text-sm">※{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button class="dui-btn " onclick="setPdf(this)"
                                            type="button">ファイルを選択</button>
                                        <input type="hidden" id="js-pf-input" name="profile_path">
                                    </div>
                                    <div id="js-pf-conteinr">

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between my-5">
                                    <div>
                                        <p class="font-bold">フォトギャラリー</p>
                                    </div>
                                    <div class="dui-btn-group dui-btn-group-vertical">
                                        <button type="button" id="js-add-btn"
                                            class="dui-btn dui-btn-success dui-btn-outline w-6 h-6">＋</button>
                                        <button type="button" id="js-rm-btn"
                                            class="dui-btn dui-btn-error dui-btn-outline w-6 h-6">-</button>
                                    </div>
                                </div>

                                <div id="js-gallery-container"
                                    class="grid grid-cols-1 tablet:grid-cols-3 gap-x-3 gap-y-10">
                                    @if (!empty(old('gallery_path')))
                                        @foreach (old('gallery_path') as $key => $image)
                                            <div id=`{{ 'js-gallery' . $key + 1 }}` class="grid grid-cols-1">
                                                <div class="col-span-1">
                                                    <p>フォトギャラリー{{ $key + 1 }}</p>
                                                    <button id=`{{ 'js-gallery-button' . $key + 1 }}` class="dui-btn "
                                                        onclick="setImg(this)" type="button">ファイルを選択</button>
                                                    <input id=`{{ 'js-gallery-input' . $key + 1 }}` type="hidden"
                                                        name="gallery_path[]" value="{{ $image }}">
                                                    @error('gallery_path.' . $key)
                                                        <p class="text-error text-sm">※{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="py-5">
                                                    <img id=`{{ 'js-gallery-img' . $key + 1 }}`
                                                        src="{{ $image }}" alt="">
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif (!empty($artist->images))
                                        @foreach ($artist->images as $key => $image)
                                            @if (!$image->is_top)
                                                <div id=`{{ 'js-gallery' . $key + 1 }}` class="grid grid-cols-1">
                                                    <div class="col-span-1">
                                                        <p>フォトギャラリー{{ $key + 1 }}</p>
                                                        <button id=`{{ 'js-gallery-button' . $key + 1 }}`
                                                            class="dui-btn " onclick="setImg(this)"
                                                            type="button">ファイルを選択</button>
                                                        <input id=`{{ 'js-gallery-input' . $key + 1 }}` type="hidden"
                                                            name="gallery_path[]" value="{{ $image->file_path }}">
                                                        @error('gallery_path.' . $key)
                                                            <p class="text-error text-sm">※{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="py-5">
                                                        <img id=`{{ 'js-gallery-img' . $key + 1 }}`
                                                            src="{{ $image->file_path }}" alt="">
                                                    </div>
                                                </div>
                                            @else
                                                <div id="js-gallery1" class="grid grid-cols-1">
                                                    <div class="col-span-1">
                                                        <p>フォトギャラリー１</p>
                                                        <button id="js-gallery-button1" class="dui-btn "
                                                            onclick="setImg(this)" type="button">ファイルを選択</button>
                                                        <input id="js-gallery-input1" type="hidden"
                                                            name="gallery_path[]">
                                                    </div>
                                                    <div class="py-5">
                                                        <img id="js-gallery-img1" src="" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div id="js-gallery1" class="grid grid-cols-1">
                                            <div class="col-span-1">
                                                <p>フォトギャラリー１</p>
                                                <button id="js-gallery-button1" class="dui-btn "
                                                    onclick="setImg(this)" type="button">ファイルを選択</button>
                                                <input id="js-gallery-input1" type="hidden" name="gallery_path[]">
                                            </div>
                                            <div class="py-5">
                                                <img id="js-gallery-img1" src="" alt="">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="grid grid-cols-2 gap-3 mt-10">
                        <div class="w-full">
                            <a href="{{ route('admin.sample.list') }}"
                                class="dui-btn dui-btn-outline dui-btn-error">戻る</a>
                        </div>
                        <div class="flex justify-end items-center">
                            <button type="submit" form="form"
                                class="dui-btn border border-lime-400 bg-lime-400 hover:bg-lime-200">{{ isset($artist)? '更新' : '登録' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        const domain = @json(config('app.url'));

        document.addEventListener('DOMContentLoaded', function() {
            const chipsContainer = document.getElementById('chips-container');
            const chipsInput = document.getElementById('chips-input');
            const chipsHiddenInput = document.getElementById('chips-hidden-input');
            const chipsForm = document.getElementById('form');
            const autocompleteContainer = document.getElementById('autocomplete-container');
            @if (!empty(old('tags')))
                const tags = @json(old('tags'));
                let registerdCategory = tags.split(",");
            @elseif (!empty($artist->contentCategory))
                const category = @json($artist->contentCategory);
                let registerdCategory = []
                category.map((v, index) => {
                    registerdCategory[index] = v['name'];
                })
            @else
                let registerdCategory = null
            @endif
            let chips = [];

            if (registerdCategory !== null) {
                registerdCategory.map((v) => {
                    addChip(v)
                })
            }

            function updateHiddenInput() {
                chipsHiddenInput.value = chips.join(',');
            }

            function addChip(value) {
                if (!chips.includes(value)) {
                    const chip = document.createElement('div');
                    const parent = chipsInput.parentElement;
                    chip.className = 'chip';
                    chip.textContent = value;
                    const closeButton = document.createElement('span');
                    closeButton.className = 'closebtn';
                    closeButton.textContent = '×';
                    closeButton.onclick = function() {
                        chipsContainer.removeChild(chip);
                        chips = chips.filter(c => c !== value);
                        updateHiddenInput();
                    };

                    chip.appendChild(closeButton);
                    chipsContainer.insertBefore(chip, parent.nextSibling);

                    chips.push(value);
                    updateHiddenInput();
                }
            }

            function fetchAllChips() {
                fetch(domain + `/chips`)
                    .then(response => response.json())
                    .then(data => {
                        autocompleteContainer.innerHTML = '';
                        data.forEach(item => {
                            const suggestion = document.createElement('div');
                            suggestion.className = 'autocomplete-suggestion';
                            suggestion.textContent = item.name;
                            suggestion.onclick = function() {
                                addChip(item.name);
                                chipsInput.value = '';
                                autocompleteContainer.innerHTML = '';
                            };
                            autocompleteContainer.appendChild(suggestion);
                        });
                    });
            }

            chipsInput.addEventListener('focus', function() {
                fetchAllChips();
                autocompleteContainer.classList.add('show');
            });

            chipsInput.addEventListener('blur', function() {
                setTimeout(function() {
                    autocompleteContainer.classList.remove('show');
                }, 200); // 一時的な遅延を追加して、クリックされた項目が選択されるまでの時間を確保します
            });

            chipsInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter' && chipsInput.value.trim() !== '') {
                    event.preventDefault();
                    addChip(chipsInput.value.trim());
                    chipsInput.value = '';
                    autocompleteContainer.innerHTML = '';
                }
            });

            chipsInput.addEventListener('input', function() {
                const query = chipsInput.value.trim();
                if (query.length > 0) {
                    fetch(domain + `/chips?query=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            autocompleteContainer.innerHTML = '';
                            data.forEach(item => {
                                const suggestion = document.createElement('div');
                                suggestion.className = 'autocomplete-suggestion';
                                suggestion.textContent = item.name;
                                suggestion.onclick = function() {
                                    addChip(item.name);
                                    chipsInput.value = '';
                                    autocompleteContainer.innerHTML = '';
                                };
                                autocompleteContainer.appendChild(suggestion);
                            });
                        });
                } else {
                    autocompleteContainer.innerHTML = '';
                }
            });

            chipsForm.addEventListener('submit', function() {
                updateHiddenInput();
            });
        });

        window.addEventListener('load', () => {
            @if (!empty($artist->composite_path))
                let composePath = @json($artist->composite_path);

                const cpConteinr = document.getElementById('js-cp-conteinr');
                const cpInput = document.getElementById('js-cp-input');
                cpInput.value = composePath;
                if (window.matchMedia('(max-width: 768px)').matches) {
                    // ウィンドウサイズ768px以下のときの処理
                    renderPDF(composePath, 0.3, cpConteinr);
                } else {
                    // それ以外の処理
                    renderPDF(composePath, 0.8, cpConteinr);
                }
            @endif
            @if (!empty($artist->profile_path))
                let profilePath = @json($artist->profile_path);

                const pfConteinr = document.getElementById('js-pf-conteinr');
                const pfInput = document.getElementById('js-pf-input');
                pfInput.value = profilePath;
                if (window.matchMedia('(max-width: 768px)').matches) {
                    // ウィンドウサイズ768px以下のときの処理
                    renderPDF(profilePath, 0.3, pfConteinr);
                } else {
                    // それ以外の処理
                    renderPDF(profilePath, 0.8, pfConteinr);
                }
            @endif
        })


        function setImg(elm) {
            const input = elm.nextElementSibling;
            const parent = elm.parentElement;
            const img = parent.nextElementSibling.firstElementChild;
            let route_prefix = domain + '/laravel-filemanager';
            window.open(route_prefix + '?type=Image', 'FileManager', 'width=900,height=600');
            window.SetUrl = function(items) {
                let file_path = items.map(function(item) {
                    return item.url;
                }).join(',');
                input.value = file_path;
                img.setAttribute('src', file_path);
            };
        }

        function setPdf(elm) {
            const input = elm.nextElementSibling;
            const parent = elm.parentElement;
            const canvasConteinr = parent.nextElementSibling;
            let route_prefix = domain + '/laravel-filemanager';
            window.open(route_prefix + '?type=pdfs', 'FileManager', 'width=900,height=600');
            window.SetUrl = function(items) {
                let file_path = items.map(function(item) {
                    return item.url;
                }).join(',');
                console.log(items)
                input.value = file_path;
                if (window.matchMedia('(max-width: 768px)').matches) {
                    // ウィンドウサイズ768px以下のときの処理
                    renderPDF(file_path, 0.3, canvasConteinr);
                } else {
                    // それ以外の処理
                    renderPDF(file_path, 0.8, canvasConteinr);
                }
            };
        }


        // PDF.jsを使用してPDFを描画する関数
        function renderPDF(url, scale, canvasContainer) {
            // PDF.jsの設定
            pdfjsLib.getDocument(url).promise.then(function(pdf) {
                let divElm = document.createElement('div');
                pdf.getPage(1).then(function(page) {
                    let viewport = page.getViewport({
                        scale: scale
                    });

                    // キャンバスを作成
                    let canvas = document.createElement('canvas');
                    let context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    canvas.classList.add("border", "border-solid", "border-gray-300", "my-5",
                        "w-full");

                    divElm.appendChild(canvas)

                    // PDFをキャンバスに描画
                    let renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
                canvasContainer.appendChild(divElm);
            });
        }

        $(document).ready(function() {
            // Define function to open filemanager window
            const lfm = function(options, cb) {
                const route_prefix = domain + options && options.prefix ? options.prefix :
                    "/laravel-filemanager";
                lfmWindow = window.open(
                    route_prefix + "?type=" + options.type || "file",
                    "FileManager",
                    "width=900,height=600"
                );
                window.SetUrl = cb;
            };

            // Define LFM summernote button
            const LFMImageButton = function(context) {
                const ui = $.summernote.ui;
                const button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    click: function() {
                        lfm({
                                type: "image",
                                prefix: "/laravel-filemanager",
                            },
                            function(lfmItems, path) {
                                lfmItems.forEach(function(lfmItem) {
                                    context.invoke("insertImage", lfmItem.url);
                                });
                            }
                        );
                    },
                });
                return button.render();
            };

            // Define LFMVideoButton
            const LFMVideoButton = function(context) {
                const ui = $.summernote.ui;
                const button = ui.button({
                    contents: '<i class="">mp4</i> ',
                    click: function() {
                        lfm({
                                type: "video",
                                prefix: "/laravel-filemanager",
                            },
                            function(lfmItems, path) {

                                lfmItems.forEach(function(lfmItem) {
                                    const videoUrl = lfmItem.url;
                                    const videoTag =
                                        `<video controls="" src="${videoUrl}" width="80%" class="note-video-clip"></video>`;
                                    context.invoke("editor.pasteHTML", videoTag);
                                    context.invoke("editor.focus");
                                });
                            }
                        );
                    },
                });
                return button.render();
            };

            // Initialize summernote with LFM and YouTube buttons in the toolbar
            $("#summernote-editor").summernote({
                lang: "ja-JP",
                fontSizes: ["8", "9", "10", "11", "12", "14", "18", "24", "36", "48"],
                fontNames: [
                    "Serif",
                    "Sans",
                    "Arial",
                    "Arial Black",
                    "Courier",
                    "Courier New",
                    "Comic Sans MS",
                    "Helvetica",
                    "Impact",
                    "Lucida Grande",
                    "Sacramento",
                ],
                fontNamesIgnoreCheck: [
                    "Serif",
                    "Sans",
                    "Arial",
                    "Arial Black",
                    "Courier",
                    "Courier New",
                    "Comic Sans MS",
                    "Helvetica",
                    "Impact",
                    "Lucida Grande",
                    "Sacramento",
                ],
                placeholder: "CM・TV・ラジオ・舞台などの出演歴",
                tabsize: 2,
                height: 300,
                toolbar: [
                    ["font", ["fontsize", "bold", "underline", "clear"]],
                    ["style", ["strikethrough", "italic"]],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ["color", ["forecolor", "color"]],
                    ["table", ["table"]],
                    ["insert", ["link", "lfmImage", "lfmVideo", "video"]],
                    // ["view", ["fullscreen", "help", "codeview"]],
                ],
                buttons: {
                    lfmImage: LFMImageButton,
                    lfmVideo: LFMVideoButton
                },
                callbacks: {
                    onPaste: function() {
                        $("#summernote-editor").summernote('focus');
                    },
                    onKeydown: function(e) {
                        // バックスペースまたはデリートキーが押された場合
                        if (e.keyCode === 8 || e.keyCode === 46) {
                            // 現在の選択範囲を取得
                            const selection = window.getSelection();
                            if (selection.rangeCount > 0) {
                                const range = selection.getRangeAt(0);
                                // 選択範囲の親要素が動画を含む場合、動画を削除
                                const parentNode = range.startContainer.parentNode;
                                if (parentNode && parentNode.classList.contains("video-wrapper")) {
                                    parentNode.remove();
                                    e.preventDefault();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-layouts.admin>
