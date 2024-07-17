<x-layouts.admin>
    @push('title')
        商品詳細
    @endpush

    <div class="w-11/12 tablet:w-full  mx-auto mt-8">
        <div class="w-full flex justify-between items-center relative">
            <h1 class="tablet:pl-2 text-2xl font-semibold">
                商品{{ isset($res)? '更新' : '登録' }}
            </h1>
        </div>
        <div class="mt-2 h-4 text-sm text-elem-alert pl-8">
            @error('err')
            {{ $message }}
            @enderror
        </div>

        <div class="w-full mx-auto mt-12 mb-10 tablet:px-4">
            <div class="w-full bg-white flex flex-col justify-center items-center p-10 rounded-xl">
                <form id="form" action="{{ isset($res) ? route('item.update', $res->id) : route('item.store') }}" method="post"
                    class="w-full">
                    @csrf
                    <div class="flex flex-col tablet:flex-row justify-between">
                        <div class="relative mt-4 tablet:mt-0 tablet:mx-4 flex-grow-[1]">
                            <input type="text" id="email" name="name" value="{{ old('name', isset($res->name) ? $res->name : '') ?? '' }}" placeholder="name" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                            <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                            <label for="name" class="block absolute -top-3 cursor-none text-xs transition-all duration-500 peer-focus:-top-3 peer-focus:text-xs peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-placeholder-shown:cursor-text">
                                商品名
                            </label>
                            @error('name')
                                <div class="absolute top-12 text-xs text-elem-alert opacity-80">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="relative mt-4 tablet:mt-0 tablet:mx-4">
                            <input type="text" id="email" name="code" value="{{ old('code', isset($res->code) ? $res->code : '') ?? '' }}" placeholder="code" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                            <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                            <label for="code" class="block absolute -top-3 cursor-none text-xs transition-all duration-500 peer-focus:-top-3 peer-focus:text-xs peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-placeholder-shown:cursor-text">
                                商品コード
                            </label>
                            @error('code')
                                <div class="absolute top-12 text-xs text-elem-alert opacity-80">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="relative mt-4 tablet:mt-0 tablet:mx-4">
                            <input type="text" id="email" name="type" value="{{ old('type', isset($res->type) ? $res->type : '') ?? '' }}" placeholder="type" class="peer p-2 w-full outline-none bg-transparent placeholder:text-transparent">
                            <div class="h-[0.125rem] bg-admin-accent2 peer-focus:bg-gradient-to-r from-admin-accent to-admin-accent2 transition-colors duration-300"></div>
                            <label for="type" class="block absolute -top-3 cursor-none text-xs transition-all duration-500 peer-focus:-top-3 peer-focus:text-xs peer-focus:transition-all peer-focus:duration-500 peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-placeholder-shown:cursor-text">
                                商品タイプ
                            </label>
                            @error('type')
                                <div class="absolute top-12 text-xs text-elem-alert opacity-80">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 tablet:mx-4">
                        <label class="flex items-center gap-2">
                            商品説明
                        </label>
                        <textarea name="description" class="px-2 py-4 w-full border-2 border-admin-accent2 min-h-12 rounded-xl outline-none focus:border-admin-accent2/60" placeholder="説明">{{ old('description', isset($res->description) ? $res->description : '') ?? '' }}</textarea>
                        @error('description')
                            <p class="text-elem-alert text-xs">※{{ $message }}</p>
                        @enderror
                    </div>
                </form>

                <div class="w-full flex justify-center items-center mt-10">
                    <div class="w-1/2 pc:w-1/4 text-center">
                        <a href="{{ route('item.list') }}" class="rounded-xl border-2 border-elem-alert w-full px-6 py-2 hover:bg-elem-alert/30 transition-all duration-300">
                            戻る
                        </a>
                    </div>
                    <div class="w-1/2 pc:w-1/4 text-center">
                        <button type="submit" form="form" class="rounded-xl border-2 border-elem-info px-6 py-2 hover:bg-elem-info/30 transition-all duration-300">
                            {{ isset($res)? '更新' : '登録' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
