<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="w-full flex justify-between">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-200"/>
                    </a>
                </div>

                <div class="h-full flex justify-center items-center">
                    <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')" style="border: none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                             class="w-5 h-5 mx-2 text-yellow-400" aria-hidden="true">
                            <path
                                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"/>
                        </svg>
                    </x-nav-link>
                    <!-- Navigation Links -->
                    <div class="h-full hidden sm:flex text-white">
                        @auth
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                داشبورد
                            </x-nav-link>
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                پروفایل
                            </x-nav-link>
                            <x-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                document.querySelector('#logout-form').submit();">
                                خروج
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                ورود
                            </x-nav-link>
                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                عضویت
                            </x-nav-link>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-400 hover:bg-gray-900 focus:outline-none focus:bg-gray-900 focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-600">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            @endauth
        </div>

        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    داشبورد
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    پروفایل
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        خروج
                    </x-responsive-nav-link>
                </form>
            @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    ورود
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    عضویت
                </x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>
