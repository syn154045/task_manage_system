<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title & favicon --}}
    <title>{{ config('app.name', 'Laravel') . "-"}}@stack('title')</title>
    <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    {{-- fontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    {{-- tailwindcss --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-black antialiased">
    <div class="flex flex-col">

        <div class="p-2 w-full h-16 sticky top-0 flex bg-white">

            <div class="w-20 flex-none">
                <a href="/">
                    <x-app-logo />
                </a>
            </div>

            @if (isset($header))
                <div class="flex-auto w-1/2">
                    <x-header />
                </div>
            @endif
        </div>

        <main>
            {{ $slot }}
        </main>

        <x-footer />
    </div>
</body>
</html>
