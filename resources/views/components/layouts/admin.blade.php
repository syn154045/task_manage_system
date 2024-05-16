<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title & favicon --}}
    <title>{{ config('app.name', 'Laravel') . "-" . $title }}</title>
    <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">

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
        <div class="hidden sm:block relative bg-white w-64 h-screen shadow-xl overflow-y-scroll hidden-scrollbar">
            <x-admin.sidebar />
        </div>
        @endif

        <div class="w-full h-screen overflow-y-hidden">
            {{-- desktop header --}}
            <div class="hidden sm:block">

            </div>

            {{--  --}}
            <div class="block sm:hidden sticky">
                <x-admin.hamburger />
            </div>

            {{ $slot }}
        </div>
    </div>

        {{-- <div class="w-full flex flex-col h-screen overflow-y-hidden">
            <!-- デスクトップ　ヘッダー -->
            <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
                <div class="w-1/2"></div>
                <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                    <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 overflow-hidden hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                        メニュー
                    </button>
                    <button x-show="isOpen" @click="isOpen = false" class="fixed inset-0 cursor-default"></button>
                    <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                        <a href="" class="block px-4 py-2 account-link hover:text-rhome-green">
                            サインアウト
                        </a>
                    </div>
                </div>
            </header> --}}

            <!-- モバイル　ナビ&ヘッダー -->
            {{-- <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
                <div class="flex items-center justify-between">
                    <a href="" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
                        管理ページ
                    </a>
                    <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                        <i x-show="!isOpen" class="fas fa-bars"></i>
                        <i x-show="isOpen" class="fas fa-times"></i>
                    </button>
                </div>

                <nav :class="isOpen ? 'flex' : 'hidden'" class="flex flex-col pt-4">
                    <a href="" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        ダッシュボード
                    </a>
                    <a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        〇〇一覧
                    </a>
                    <a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-calendar mr-3"></i>
                        △△一覧
                    </a>
                    <a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-user mr-3"></i>
                        アカウント
                    </a>
                    <a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        サインアウト
                    </a>
                </nav>
            </header> --}}
            {{-- {{ $slot }}
        </div>
    </div> --}}
</body>
</html>
