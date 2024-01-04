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
            پرداخت ها
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
                    سفارش
                </th>
                <th scope="col" class="px-6 py-3">
                    وضعیت
                </th>
                <th scope="col" class="px-6 py-3">
                    کد پیگیری
                </th>
            </tr>
            </thead>
            <tbody>
            @if($payments->count())
                @foreach($payments as $payment)
                    <tr class="bg-white text-gray-300 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline transition"
                               href="{{ route('admin.orders.index', ['search' => $payment->order->uuid]) }}">
                                <small>{{ $payment->order->uuid }}</small>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            @switch($payment->status)
                                @case(\App\Models\Payment::STATUS_UNPAID)
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300">{{ \App\Models\Payment::FA_UNPAID }}</span>
                                    @break
                                @case(\App\Models\Payment::STATUS_PAID)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ \App\Models\Payment::FA_PAID }}</span>
                                    @break
                                @case(\App\Models\Payment::STATUS_CANCELED)
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ \App\Models\Payment::FA_CANCELED }}</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            {{ $payment->resnumber ? : '-' }}
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
    {{ $payments->links() }}
@endsection
