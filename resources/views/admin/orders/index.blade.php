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
                            @can(\App\Models\Order::ORDER_EDIT)
                                <a href="{{ route('admin.orders.edit', $order->id) }}"
                                   class="p-2 mx-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                                    ویرایش
                                </a>
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
