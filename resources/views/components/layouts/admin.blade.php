<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title & favicon --}}
    <title>{{ config('app.name', 'Laravel') . " - " }}@stack('title')</title>
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

<body class="font-zen-maru bg-admin-base text-admin-text-main">
    {{-- login page --}}
    @if (Request::is('admin/login'))
    <main class="w-screen h-screen">
        {{ $slot }}
    </main>

    {{-- admin page --}}
    @else
    <div class="flex h-screen">
        {{-- dashboardはsideBarを使用しません --}}
        @if (!(Request::is('admin/dashboard')))
        <aside class="hidden tablet:block fixed bg-admin-main w-52 h-screen shadow-admin-main shadow-xl overflow-y-scroll hidden-scrollbar">
            <x-admin.sidebar />
        </aside>
        <div class="tablet:ml-52"></div>
        @endif

        <container class="w-full flex flex-col">
            {{-- desktop header --}}
            <header class="hidden tablet:block sticky top-0 z-20 bg-admin-main shadow-admin-main shadow-md">
                <x-admin.headerPC />
            </header>

            {{-- mobile header --}}
            <header class="block tablet:hidden sticky top-0 z-20 bg-admin-main shadow-admin-main shadow-md">
                <x-admin.headerSP />
            </header>

            {{-- main contents --}}
            <main class="flex-grow overflow-y-auto">
                {{ $slot }}
            </main>
        </container>
    </div>
    @endif

    @stack('script')
</body>
</html>
