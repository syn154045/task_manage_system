<header class="flex flex-wrap justify-between items-baseline px-8">

    <!-- TODO ヘッダー作成（ログアウト・パスワード変更・プロフィール変更をプルダウン形式にする） -->
    <h1 class="flex-auto text-center text-2xl">
        {{ config('app.name', 'laravel') }}
    </h1>

    <div class="content-end">
        <div class="relative inline-block text-left">
            <div>
                <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="false" aria-haspopup="true">
                    @auth
                        {{ Auth::user()->name }}
                    @else
                        Guest
                    @endauth
                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            
            
            <div class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="menu">
                <div class="py-1" role="none">
                    @auth
                        <a href="" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">Edit Profile</a>
                        <a href="" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">Change Password </a>
                        <a href="" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-1">Support (preparing)</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-2">Sign Out</a>
                        
                        <form method="POST" action="{{ route('logout') }}" role="none" id="logout-form" class="">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">Sign In</a>
                        <a href="{{ route('register') }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-1">Sign On</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-1">Donate (preparing)</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menu-button');
        const menu = document.getElementById('menu');
        
        menuButton.addEventListener('click', function() {
            const expanded = menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', String(!expanded));
            menu.classList.toggle('hidden', expanded);
        });
        
        // Close the menu if a click occurs outside of it
        document.addEventListener('click', function(event) {
            if (!menuButton.contains(event.target) && !menu.contains(event.target)) {
                menuButton.setAttribute('aria-expanded', 'false');
                menu.classList.add('hidden');
            }
        });
    });
</script>
