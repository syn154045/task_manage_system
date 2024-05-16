<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title & favicon --}}
    <title>{{ config('app.name', 'Laravel') . "-" . $title }}</title>
    <link rel="shortcut icon" href="{{ config('app.url') }}/favicon.png') }}">

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

<body class="font-zen-maru">
    <div class="bg-gray-100 flex">
        @if (isset($sidebar))
        <aside class="hidden sm:block relative bg-white w-64 h-screen shadow-xl overflow-y-scroll hidden-scrollbar">
            <x-admin.sidebar />
        </aside>
        @endif

        <container class="w-full h-screen overflow-y-hidden">
            {{-- desktop header --}}
            <header class="hidden sm:block sticky">
                <x-admin.header />
            </header>

            {{-- mobile header --}}
            <header class="block sm:hidden sticky">
                <x-admin.hamburger />
            </header>

            <main>
                {{ $slot }}
            </main>
        </container>
    </div>
</body>
</html>
