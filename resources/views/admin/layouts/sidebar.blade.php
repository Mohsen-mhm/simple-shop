<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-300 rounded-lg sm:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-700 transition">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>

<aside id="default-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
       aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800 border-r border-dashed border-gray-500">
        <h1 class="text-sm font-medium title-font mb-4 text-gray-200">خوش آمدی {{ auth()->user()->name }}</h1>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('admin.index') }}"
                   class="flex justify-end items-center p-2 text-gray-300 hover:text-white transition rounded-lg hover:bg-gray-700 group {{ \Illuminate\Support\Facades\Route::is('admin.index') ? 'bg-gray-600' : '' }}">
                    <span class="me-3">داشبورد</span>
                    <svg class="w-5 h-5 text-gray-200 transition group-hover:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                </a>
            </li>
            @can(\App\Models\User::USER_INDEX)
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex justify-end items-center p-2 text-gray-300 hover:text-white transition rounded-lg hover:bg-gray-700 group {{ \Illuminate\Support\Facades\Route::is('admin.users.index') ? 'bg-gray-600' : '' }}">
                        <span class="me-3">کاربران</span>
                        <svg class="w-5 h-5 text-gray-200 transition group-hover:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                        </svg>
                    </a>
                </li>
            @endcan
            @can(\App\Models\Product::PRODUCT_INDEX)
                <li>
                    <a href="{{ route('admin.products.index') }}"
                       class="flex justify-end items-center p-2 text-gray-300 hover:text-white transition rounded-lg hover:bg-gray-700 group {{ \Illuminate\Support\Facades\Route::is('admin.products.index') ? 'bg-gray-600' : '' }}">
                        <span class="me-3">محصولات</span>
                        <svg class="w-5 h-5 text-gray-200 transition group-hover:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                        </svg>
                    </a>
                </li>
            @endcan
            @can(\App\Models\Order::ORDER_INDEX)
                <li>
                    <a href="{{ route('admin.orders.index') }}"
                       class="flex justify-end items-center p-2 text-gray-300 hover:text-white transition rounded-lg hover:bg-gray-700 group {{ \Illuminate\Support\Facades\Route::is('admin.orders.index') ? 'bg-gray-600' : '' }}">
                        <span class="me-3">سفارشات</span>
                        <svg class="w-5 h-5 text-gray-200 transition group-hover:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                        </svg>
                    </a>
                </li>
            @endcan
            @can(\App\Models\Payment::PAYMENT_INDEX)
                <li>
                    <a href="{{ route('admin.payments.index') }}"
                       class="flex justify-end items-center p-2 text-gray-300 hover:text-white transition rounded-lg hover:bg-gray-700 group {{ \Illuminate\Support\Facades\Route::is('admin.payments.index') ? 'bg-gray-600' : '' }}">
                        <span class="me-3">پرداخت ها</span>
                        <svg class="w-5 h-5 text-gray-200 transition group-hover:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                            <path
                                d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM2 12V6h16v6H2Z"/>
                            <path d="M6 8H4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm8 0H9a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2Z"/>
                        </svg>
                    </a>
                </li>
            @endcan
        </ul>
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200">
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.querySelector('#logout-form').submit();"
                   class="flex justify-end items-center p-2 text-gray-300 hover:text-white transition rounded-lg hover:bg-gray-700 group">
                    <span class="me-3">خروج</span>
                    <svg class="w-5 h-5 text-gray-200 transition group-hover:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                    </svg>
                </a>
                <form method="POST" id="logout-form" class="hidden" action="{{ route('logout') }}">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>
