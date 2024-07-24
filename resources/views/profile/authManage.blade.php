<x-layouts.admin>
    @push('title')
        ユーザー権限管理
    @endpush

    <div class="text-center text-base h-4">
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

    <div class="w-[90%] mx-auto border rounded-2xl border-admin-accent2 p-6 bg-admin-accent2/10 relative mt-8">
        <h2 class="absolute -top-3 bg-admin-accent2 text-white px-4 py-1 text-sm rounded-xl">
            ユーザー一覧
        </h2>
        <form action="" method="POST">
            @csrf
            <div class="mt-2 w-full flex px-4 py-2 bg-admin-main font-semibold">
                <div class="flex-1 grow-[1]">ユーザー名</div>
                <div class="hidden tablet:flex flex-1 grow-[2]">メールアドレス</div>
                <div class="w-24">現在 / 切替</div>
            </div>
            @forelse($users as $key => $user)
            <section class="w-full flex px-4 py-2 {{ $user->name === Auth::guard('administrators')->user()->name ? 'bg-admin-accent/30' : '' }}">
                <div class="flex-1 grow-[1]">
                    {{ $user->name }}
                </div>
                <div class="hidden tablet:flex flex-1 grow-[2]">
                    {{ $user->email }}
                </div>
                <div class="w-24 flex justify-between">
                    <div class="">
                        @switch($user->role)
                            @case('admin')
                                <span>一般</span>
                                @break
                            @case('super')
                                <span>管理者</span>
                                @break
                            @default
                        @endswitch
                    </div>
                    <label for="checkbox{{$key}}" class="text-admin-text-sub hover:text-admin-text-subhover cursor-pointer select-none flex items-center">
                        <input type="hidden" value="{{ $user->id }}" name="admin_ids[]" {{ $user->name === Auth::guard('administrators')->user()->name ? 'disabled' : '' }}>
                        <input
                            type="checkbox"
                            id="checkbox{{$key}}"
                            name="super_ids[]"
                            value="{{$user->id}}"
                            {{ ($user->role === 'super') ? 'checked' : '' }}
                            {{ $user->name === Auth::guard('administrators')->user()->name ? 'disabled' : '' }}
                            class="js-chkbox appearance-none w-6 h-6 border border-admin-text-sub rounded-md bg-transparent inline-block relative cursor-pointer checked:border-admin-text-sub hover:scale-90 transition-all duration-300
                                before:content-[''] before:bg-admin-text-sub before:block before:absolute before:top-1/2 before:left-1/2 before:-translate-x-1/2 before:-translate-y-1/2 before:scale-0 before:w-3 before:h-3 before:rounded-sm before:transition-all before:duration-300 checked:before:scale-100"
                        >
                    </label>
                </div>
            </section>
            @empty
            @endforelse
            <div class="mt-4 flex flex-col tablet:flex-row justify-start items-center">
                <button type="submit" class="w-1/3 min-w-48 bg-admin-accent p-2 rounded-md hover:bg-admin-accent/60 focus:outline-none focus:bg-admin-accent/60 transition-colors duration-300">
                    ユーザー権限更新
                </button>
                <span class="text-xs text-elem-alert mt-4 ml-0 tablet:mt-0 tablet:ml-4">
                    ※！ログインしている管理者自身の権限は変更できません！※
                </span>
            </div>
        </form>
    </div>

</x-layouts.admin>
