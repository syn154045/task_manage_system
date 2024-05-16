<header class="flex items-center justify-between border-b border-slate-800 border-opacity-60">
    <h1 class="flex h-16 text-2xl text-slate-800 font-semibold items-center p-6">
            管理ページ
    </h1>
    {{-- <button onclick="menuToggle()" class="w-10 mr-3"> --}}
        <label for="checkbox" class="toggle relative w-10 h-10 cursor-pointer flex flex-col justify-center items-center gap-3 duration-500 has-[:checked]:rotate-180 has-[:checked]:duration-500">
            <div id="bar1" class="bars w-3/4 h-1 bg-slate-800 rounded-sm has-[:checked]:absolute has-[:checked]:w-full has-[:checked]:rotate-45 has-[:checked]:duration-500"></div>
            <div id="bar2" class="bars w-full h-1 bg-slate-800 rounded-sm duration-1000 has-[:checked]:absolute has-[:checked]:w-full has-[:checked]:scale-x-0 has-[:checked]:duration-500"></div>
            <div id="bar3" class="bars w-3/4 h-1 bg-slate-800 rounded-sm has-[:checked]:absolute has-[:checked]:w-full has-[:checked]:-rotate-45 has-[:checked]:duration-500"></div>
        </label>
        <input type="checkbox" id="checkbox" class="hidden">
    {{-- </button> --}}
    <nav>
        <button id="button" type="button" class="fixed top-6 right-6 z-10">
            <i id="bars" class="fa-solid fa-bars fa-2x"></i>
            <i id="xmark" class="fa-solid fa-xmark fa-2x hidden"></i>
            {{-- <label for="hamburger" class="w-9 h-10 cursor-pointer flex flex-col items-center justify-center space-y-1.5">
                <input id="hamburger" type="checkbox" class="hidden peer" />
                <div class="w-2/3 h-1.5 bg-purple-600 rounded-lg transition-all duration-300 origin-right peer-checked:w-full peer-checked:rotate-[-30deg] peer-checked:translate-y-[-5px]"></div>
                <div class="w-full h-1.5 bg-purple-600 rounded-lg transition-all duration-300 origin-center peer-checked:rotate-90 peer-checked:translate-x-4"></div>
                <div class="w-2/3 h-1.5 bg-purple-600 rounded-lg transition-all duration-300 origin-right peer-checked:w-full peer-checked:rotate-[30deg] peer-checked:translate-y-[5px]"></div>
            </label> --}}
            <ul id="menu" class="fixed top-0 left-0 z-0 w-full translate-x-full bg-slate-300 text-center text-xl font-bold text-white transition-all duration-500 ease-in-out">
                <li class="p-3"><a href="">TOP</a></li>
                <li class="p-3"><a href="">BLOG</a></li>
                <li class="p-3"><a href="">CONTACT</a></li>
            </ul>
        </button>
    </nav>
</header>
    <script>
        // const btn = document.getElementById(hamburger)
        button.addEventListener('click', event => {
            bars.classList.toggle('hidden')
            xmark.classList.toggle('hidden')
            menu.classList.toggle('translate-x-full')
        });
    </script>
