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
        <header class="tablet:hidden stickey top-0 z-20">

        </header>
        <header class="hidden tablet:block stickey top-0 z-20 p-5 h-12 w-full bg-admin-main shadow-admin-main shadow-md">
            <a href="{{ route('home') }}" class="text-2xl font-semibold hover:text-admin-text-mainhover transition duration-500">
                <i class="fas fa-left-long fa-xs"></i>
                IN NO USE
            </a>
        </header>

    </div>
    <x-footer />
    @stack('script')
</body>
</html>
