<header class="sticky top-0 flex items-center justify-between w-full px-4 shadow-md bg-gray-800 z-10 rounded-xl">
    <a class="text-xl font-semibold text-gray-200" href="#">
        {{ env('APP_NAME') }}
    </a>
    <nav
        aria-label="Main" data-orientation="horizontal"
        class="relative z-10 flex max-w-max flex-1 items-center justify-center p-5">
        <div style="position: relative;">
            <ul data-orientation="horizontal"
                class="group flex-1 list-none items-center justify-center space-x-1 flex gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="text-base font-medium text-gray-200" data-radix-collection-item="">داشبورد</a>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-base font-medium text-gray-200" data-radix-collection-item="">ورود</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="text-base font-medium text-gray-200" data-radix-collection-item="">عضویت</a>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
        <div class="absolute left-0 top-full flex justify-center"></div>
    </nav>
</header>
