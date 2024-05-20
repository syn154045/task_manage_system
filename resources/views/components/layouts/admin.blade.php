<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title & favicon --}}
    <title>{{ config('app.name', 'Laravel') . "-" . $title }}</title>
    <link rel="shortcut icon" href="{{ config('app.url') }}/favicon.png">

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    {{-- fontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    {{-- tailwindcss --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-zen-maru bg-slate-100">
    {{-- login page --}}
    @if (Request::is('admin/login'))
    <main class="w-screen h-screen">
        {{ $slot }}
    </main>

    {{-- admin page --}}
    @else
    <div class="bg-gray-100 flex h-screen">
        @if (!(Request::is('admin/dashboard')))
        <aside class="hidden tablet:block fixed bg-white w-52 h-screen shadow-xl overflow-y-scroll hidden-scrollbar">
            <x-admin.sidebar />
        </aside>
        <div class="tablet:ml-52"></div>
        @endif

        <container class="w-full flex flex-col">
            {{-- desktop header --}}
            <header class="hidden tablet:block sticky top-0 z-10 bg-white shadow-lg">
                <x-admin.header />
            </header>

            {{-- mobile header --}}
            <header class="block tablet:hidden sticky top-0 z-10 bg-white shadow-lg">
                <x-admin.hamburger />
            </header>

            <main class="flex-grow overflow-y-auto">
                {{ $slot }}
            </main>
        </container>
    </div>
    @endif
</body>
</html>
