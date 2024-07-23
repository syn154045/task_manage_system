<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title & favicon --}}
    <title>{{ config('app.name', 'Laravel') . "|" }}@stack('title')</title>
    <link rel="shortcut icon" href="{{ config('app.url') }}/favicon.ico">

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
    {{-- fontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    {{-- tailwindcss --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-zen-maru bg-admin-base text-admin-text-main min-h-screen w-full antialiased">
    <div class="h-full">
        <div class="p-5 h-12 w-full bg-admin-main shadow-admin-main shadow-md">
            <a href="{{ route('home') }}" class="text-2xl font-semibold hover:text-admin-text-mainhover transition duration-500">
                <i class="fas fa-left-long fa-xs"></i>
                トップページ
            </a>
        </div>
        <h2 class="mt-10 text-center">
            お疲れ様です、{{ Auth::guard('administrators')->user()->name }}　さん
        </h2>
        {{-- navigation button (600px~) --}}
        <nav class="mt-12 w-full hidden tablet:flex justify-center items-center">
            <div class="bg-admin-accent rounded-t-xl mx-2 hover:bg-admin-accent/60 transition-all duration-300 {{ Request::is('profile/edit') ? 'bg-admin-accent/60' : '' }}">
                <a href="{{ route('profile.edit.view') }}" class="inline-block px-4 py-2">
                    アカウント情報変更
                </a>
            </div>
            <div class="bg-admin-accent rounded-t-xl mx-2 hover:bg-admin-accent/60 transition-all duration-300 {{ Request::is('profile/delete') ? 'bg-admin-accent/60' : '' }}">
                <a href="{{ route('profile.delete.view') }}" class="inline-block px-4 py-2">
                    アカウント削除
                </a>
            </div>
            {{-- super only --}}
            @if(Auth::guard('administrators')->user()->role === 'super')
            <div class="bg-admin-accent rounded-t-xl mx-2 hover:bg-admin-accent/60 transition-all duration-300 {{ Request::is('profile/user-manage') ? 'bg-admin-accent/60' : '' }}">
                <a href="{{ route('profile.user-manage.view') }}" class="inline-block px-4 py-2">
                    ユーザー管理
                </a>
            </div>
            @endif
        </nav>
        {{-- navigation bar (~600px) --}}


        {{-- main --}}
        <main class="mt-24 tablet:mt-0 border-4 rounded-xl bg-admin-accent/30 border-admin-accent w-[90%] max-w-5xl mx-auto px-4 py-10">
            {{ $slot }}
        </main>
    </div>
    <x-footer />
    @stack('script')
</body>
</html>
