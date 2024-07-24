<h2 class="mt-10 text-center">
    お疲れ様です、{{ Auth::guard('administrators')->user()->name }}　さん
</h2>

{{-- navigation button (600px~) --}}
<nav class="mt-8 w-[90%] max-w-4xl mx-auto hidden tablet:flex justify-center items-center">
    <div class="w-1/3 text-nowrap rounded-t-xl mx-2 hover:bg-admin-accent transition-all duration-300 {{ Request::is('profile/edit') ? 'bg-admin-accent' : 'bg-admin-accent/60' }}">
        <a href="{{ route('profile.edit.view') }}" class="inline-block px-4 py-2 w-full text-center">
            ユーザー情報変更
        </a>
    </div>
    {{-- super only --}}
    @if(Auth::guard('administrators')->user()->role === 'super')
    <div class="w-1/3 text-nowrap rounded-t-xl mx-2 hover:bg-admin-accent transition-all duration-300 {{ Request::is('profile/auth-manage') ? 'bg-admin-accent' : 'bg-admin-accent/60' }}">
        <a href="{{ route('profile.auth-manage.view') }}" class="inline-block px-4 py-2 w-full text-center">
            ユーザー権限管理
        </a>
    </div>
    @endif
</nav>

{{-- navigation button (~600px) --}}
<nav id="profileNavContainer" class="tablet:hidden flex justify-center items-center mt-8 relative bg-admin-accent2/20 transition-all duration-500 w-16 mx-auto rounded-xl">
    <button id="toggleProfileNav" class="py-2 px-5 transition-all duration-500 opacity-100">
        <i id="profileNavIcon" class="fas fa-terminal"></i>
    </button>
    {{-- menu --}}
    <section id="profileNavMenu" class="hidden opacity-0 transition-opacity duration-500 ease-out py-2 px-4 w-[80%] mx-auto">
        {{-- <div class="flex flex-col justify-center items-center"> --}}
            <div class="w-full border-b border-admin-text-main">
                <a href="{{ route('profile.edit.view') }}" class="block hover:opacity-70 transition-opacity duration-300 py-2">
                    ユーザー情報変更
                </a>
            </div>
            @if(Auth::guard('administrators')->user()->role === 'super')
            <div class="w-full">
                <a href="{{ route('profile.auth-manage.view') }}" class="block hover:opacity-70 transition-opacity duration-300 py-2">
                    ユーザー権限管理
                </a>
            </div>
            @endif
        {{-- </div> --}}
    </section>
</nav>


@push('script')
<script>
        document.addEventListener('DOMContentLoaded', function() {
        const profileNavContainer = document.getElementById('profileNavContainer');
        const toggleProfileNav = document.getElementById('toggleProfileNav');
        const profileNavIcon = document.getElementById('profileNavIcon');
        const profileNavMenu = document.getElementById('profileNavMenu');

        // navContainer height animation
        function setNavContainerHeight(expanded) {
            if (expanded) {
                const menuHeight = profileNavMenu.offsetHeight;
                profileNavContainer.style.height = `${menuHeight + toggleProfileNav.offsetHeight}px`;
            } else {
                profileNavContainer.style.height = `${toggleProfileNav.offsetHeight}px`;
            }
        }

        function showMenu() {
            // { button } opacity-animation : 100 -> 0
            toggleProfileNav.classList.remove('opacity-100');
            toggleProfileNav.classList.add('opacity-0');

            setTimeout(() => {
                // animationが終了してからhidden
                toggleProfileNav.classList.add('hidden');
                // { navContainer } width-animation : 4rem -> 80%
                profileNavContainer.classList.remove('w-16')
                profileNavContainer.classList.add('w-[80%]');

                setTimeout(() => {
                    // { navMenu } hidden除去(opacity-0)
                    profileNavMenu.classList.remove('hidden');
                    // { navContainer } height-animation : button -> navMenu
                    setNavContainerHeight(true);

                    setTimeout(() => {
                        // { navMenu } opacity-animation : 0 -> 100
                        profileNavMenu.classList.remove('opacity-0');
                        profileNavMenu.classList.add('opacity-100');
                    }, 200);
                }, 200);
            }, 300);
        }

        function hideMenu() {
            // { navMenu } opacity-animation : 100 -> 0
            profileNavMenu.classList.remove('opacity-100');
            profileNavMenu.classList.add('opacity-0');

            setTimeout(() => {
                // animationが終了してからhidden
                profileNavMenu.classList.add('hidden');
                // { button } hidden除去(opacity-0)
                toggleProfileNav.classList.remove('hidden');
                // { navContainer } height-animation : navMenu -> button
                setNavContainerHeight(false);

                setTimeout(() => {
                    // { navContainer } width-animation : 80% -> 4rem
                    profileNavContainer.classList.remove('w-[80%]');
                    profileNavContainer.classList.add('w-16');

                    setTimeout(() => {
                        // { button } opacity-animation : 0 -> 100
                        toggleProfileNav.classList.remove('opacity-0');
                        toggleProfileNav.classList.add('opacity-100');
                    }, 200);
                }, 200);
            }, 300);
        }


        toggleProfileNav.addEventListener('click', function() {
            if (profileNavMenu.classList.contains('hidden')) {
                showMenu();
            } else {
                hideMenu();
            }
        });

        document.addEventListener('click', function(event) {
            if (!toggleProfileNav.contains(event.target) && !profileNavMenu.contains(event.target)) {
                if (!profileNavMenu.classList.contains('hidden')) {
                    hideMenu();
                }
            }
        });

        setNavContainerHeight(false);
    });
</script>
@endpush

