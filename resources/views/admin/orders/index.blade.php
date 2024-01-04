@extends('admin.layouts.app')

@section('content')
    @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            @foreach($errors->all() as $error)
                <span class="font-medium">{{ $error }}</span>
            @endforeach
        </div>
    @endif
    <div class="flex justify-between items-center w-full mb-5">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            سفارشات
        </h2>
        <form>
            <label for="search-box"
                   class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">جستجوی سفارش</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" name="search" id="search-box" value="{{ \Illuminate\Support\Facades\Request::input('search') }}"
                       class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="کد سفارش">
                <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 text-sm rounded-lg text-sm p-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    جستجو
                </button>
            </div>
        </form>
    </div>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 border-b dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ردیف
                </th>
                <th scope="col" class="px-6 py-3">
                    ایمیل کاربر
                </th>
                <th scope="col" class="px-6 py-3">
                    قیمت
                </th>
                <th scope="col" class="px-6 py-3">
                    وضعیت پرداخت
                </th>
                <th scope="col" class="px-6 py-3">
                    وضعیت سفارش
                </th>
                <th scope="col" class="px-6 py-3">
                    کد رهگیری
                </th>
                <th scope="col" class="px-6 py-3">
                    عملیات
                </th>
            </tr>
            </thead>
            <tbody>
            @if($orders->count())
                @foreach($orders as $order)
                    <tr class="bg-white text-gray-300 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            <small>{{ $order->user->email }}</small>
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->price }} تومان
                        </td>
                        <td class="px-6 py-4">
                            @switch(!!$order->payments->count())
                                @case(true)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">پرداخت‌شده</span>
                                    @break
                                @case(false)
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">پرداخت‌نشده</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            @switch($order->status)
                                @case(\App\Models\Order::STATUS_UNPAID)
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300">{{ \App\Models\Order::FA_UNPAID }}</span>
                                    @break
                                @case(\App\Models\Order::STATUS_PREPARATION)
                                    <span
                                        class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ \App\Models\Order::FA_PREPARATION }}</span>
                                    @break
                                @case(\App\Models\Order::STATUS_POSTED)
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ \App\Models\Order::FA_POSTED }}</span>
                                    @break
                                @case(\App\Models\Order::STATUS_RECEIVED)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ \App\Models\Order::FA_RECEIVED }}</span>
                                    @break
                                @case(\App\Models\Order::STATUS_CANCELED)
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ \App\Models\Order::FA_CANCELED }}</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->tracking_serial ? : '-' }}
                        </td>

                        <td class="px-6 py-4 flex justify-center items-center">
                            @if(!!$order->payments->count())
                                @can(\App\Models\Order::ORDER_EDIT)
                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                       class="p-2 mx-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                                        ویرایش
                                    </a>
                                @endcan
                            @endif
                            @can(\App\Models\Order::ORDER_INDEX)
                                <button type="button" data-modal-target="{{ $order->uuid }}"
                                        data-modal-toggle="{{ $order->uuid }}"
                                        class="px-3 py-2 text-xs font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 transition">
                                    جزئیات
                                </button>

                                {{-- Order details modal --}}
                                <div id="{{ $order->uuid }}" tabindex="-1"
                                     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                                    جزئیات سفارش
                                                </h3>
                                                <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="{{ $order->uuid }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">
                                                    مبلغ کل:</h5>
                                                <div class="flex items-baseline text-gray-900 dark:text-white">
                                        <span
                                            class="text-xl font-extrabold text-green-300 tracking-tight">{{ $order->price }}</span>
                                                    <span
                                                        class="ms-1 text-base font-normal text-gray-500 dark:text-gray-400">تومان</span>
                                                </div>
                                                <ul role="list" class="space-y-5 my-7">
                                                    @foreach($order->products as $product)
                                                        <li class="flex text-white items-center mb-1">
                                                            <svg
                                                                class="w-3.5 h-3.5 me-2 text-green-400 dark:text-green-500"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none"
                                                                viewBox="0 0 16 12">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                      stroke-linejoin="round" stroke-width="2"
                                                                      d="M1 5.917 5.724 10.5 15 1.5"/>
                                                            </svg>
                                                            <span
                                                                class="text-sm">{{ $product->name }} : {{ $product->price }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- Modal footer -->
                                            <div
                                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="{{ $order->uuid }}" type="button"
                                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition">
                                                    خروج
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End order details modal --}}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">
                        <div
                            class="p-4 m-4 text-center text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                            role="alert">
                            <span class="font-medium">سفارشی پیدا نشد!</span>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
@endsection
