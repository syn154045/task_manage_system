<x-layouts.admin title="sampleList Page">
    @push('script')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-ja-JP.min.js"></script>
    @endpush
    <style>
        .note-editable {
            background-color: rgba(255, 255, 255) !important;
            /* フルスクリーンモードの背景を白に設定 */
        }
    </style>
    <div class="w-11/12 tablet:w-full  mx-auto pl-2 mt-8">
        <h1 class="text-2xl font-semibold text-slate-800 h-[10vh]">
            アーティスト登録
        </h1>

        {{-- メインコンテンツ --}}
        <div class="flex justify-center w-full">
            <div class="w-11/12 h-full bg-white border border-solid flex justify-center items-center py-10">
                <div class="w-11/12 h-[90%]">
                    <form>
                        <div class="grid gap-y-4">
                            <div class="grid grid-cols-1 tablet:grid-cols-3 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        名前
                                    </label>
                                    <input type="text" name="name"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="テスト太郎" />
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        名前サブ
                                    </label>
                                    <input type="text" name="name_sub"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="Test Taro" />
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        生年月日
                                    </label>
                                    <input type="date" name="birthday"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="テスト太郎" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 tablet:grid-cols-2 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        国籍
                                    </label>
                                    <input type="text" name="nationality"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="日本" />
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        出身地
                                    </label>
                                    <input type="text" name="birth_place"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="東京都" />
                                </div>
                            </div>
                            <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        身長
                                    </label>
                                    <input type="number" name="height"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="160.0" />
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        体重
                                    </label>
                                    <input type="number" name="weight"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="50.0" />
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        バスト
                                    </label>
                                    <input type="number" name="bust"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="50" />
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        ウェスト
                                    </label>
                                    <input type="number" name="waist"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="50" />
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        ヒップ
                                    </label>
                                    <input type="number" name="hip"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="50" />
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        靴サイズ
                                    </label>
                                    <input type="number" name="shose_size"
                                        class="grow dui-input dui-input-bordered w-full" placeholder="26.5" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 tablet:grid-cols-2 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        趣味
                                    </label>
                                    <textarea name="hobby" class="dui-textarea dui-textarea-bordered w-full" placeholder="読書"></textarea>
                                </div>
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        特技
                                    </label>
                                    <textarea name="sekill" class="dui-textarea dui-textarea-bordered w-full" placeholder="空手黒帯"></textarea>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-3">
                                <div class="w-full">
                                    <label class="flex items-center gap-2">
                                        経歴
                                    </label>
                                    <div class="summernote-container">
                                        <textarea id="summernote-editor" name="career">
                                            {{-- {!! old('content', $content) !!} --}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Define function to open filemanager window
            const lfm = function(options, cb) {
                const route_prefix = options && options.prefix ? options.prefix : "/laravel-filemanager";
                window.open(
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
                                prefix: "/admin/laravel-filemanager",
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
                                prefix: "/admin/laravel-filemanager",
                            },
                            function(lfmItems, path) {
                                lfmItems.forEach(function(lfmItem) {
                                    const videoUrl = lfmItem.url;
                                    let videoWidth = prompt(
                                        "動画の幅を入力してください（単位: %）:");

                                    videoWidth = convertToHalfWidth(videoWidth);
                                    // 動画URLをvideoタグのsrc属性に挿入
                                    const videoTag =
                                        `<video width="${videoWidth}%" controls><source src="${videoUrl}" type="video/mp4"></video>`;
                                    context.invoke("editor.pasteHTML",
                                        videoTag); // pasteHTMLを使ってHTMLを挿入
                                });
                            }
                        );
                    },
                });
                return button.render();
            };

            // 半角に変換する関数
            function convertToHalfWidth(input) {
                return input.replace(/[０-９]/g, function(s) {
                    return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
                });
            }

            // Initialize summernote with LFM and YouTube buttons in the toolbar
            $("#summernote-editor").summernote({
                lang: "ja-JP",
                fontSizes: ["8", "9", "10", "11", "12", "13", "14", "18", "24", "36"],
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
                placeholder: "hogehoeghogehoge",
                tabsize: 2,
                height: 200,

                toolbar: [
                    ["style", ["style"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["color", ["color"]],
                    ["table", ["table"]],
                    ["insert", ["link", "lfmImage", "lfmVideo", "video"]],
                    ["view", ["fullscreen", "help"]],
                ],
                buttons: {
                    lfmImage: LFMImageButton,
                    lfmVideo: LFMVideoButton
                },
            });
        });
    </script>
</x-layouts.admin>
