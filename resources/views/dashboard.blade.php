<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            داشبورد
        </h2>
    </x-slot>

    <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
        سفارشات
    </h2>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 border-b dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ردیف
                </th>
                <th scope="col" class="px-6 py-3">
                    قیمت
                </th>
                <th scope="col" class="px-6 py-3">
                    وضعیت
                </th>
                <th scope="col" class="px-6 py-3">
                    کد پیگیری
                </th>
                <th scope="col" class="px-6 py-3">
                    کد رهگیری پست
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">جزئیات</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @if($orders->count())
                @foreach($orders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $order->price }}
                        </td>
                        <td class="px-6 py-4">
                            @switch($order->status)
                                @case(\App\Models\Order::STATUS_UNPAID)
                                    <span class="text-gray-400">{{ \App\Models\Order::FA_UNPAID }}</span>
                                    @break
                                @case(\App\Models\Order::STATUS_PREPARATION)
                                    <span class="text-purple-400">{{ \App\Models\Order::FA_PREPARATION }}</span>
                                    @break
                                @case(\App\Models\Order::STATUS_POSTED)
                                    <span class="text-yellow-400">{{ \App\Models\Order::FA_POSTED }}</span>
                                    @break
                                @case(\App\Models\Order::STATUS_RECEIVED)
                                    <span class="text-green-400">{{ \App\Models\Order::FA_RECEIVED }}</span>
                                    @break
                                @case(\App\Models\Order::STATUS_CANCELED)
                                    <span class="text-red-400">{{ \App\Models\Order::FA_CANCELED }}</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            {{ collect($order->payments)->first()->resnumber ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->tracking_serial ?? 'ثبت نشده' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" data-modal-target="{{ $order->uuid }}"
                                    data-modal-toggle="{{ $order->uuid }}"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 transition">
                                جزئیات
                            </button>
                        </td>
                    </tr>

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
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">مبلغ کل:</h5>
                                    <div class="flex items-baseline text-gray-900 dark:text-white">
                                        <span
                                            class="text-xl font-extrabold text-green-300 tracking-tight">{{ $order->price }}</span>
                                        <span
                                            class="ms-1 text-base font-normal text-gray-500 dark:text-gray-400">تومان</span>
                                    </div>
                                    <ul role="list" class="space-y-5 my-7">
                                        @foreach($order->products as $product)
                                            <li class="flex text-white items-center mb-1">
                                                <svg class="w-3.5 h-3.5 me-2 text-green-400 dark:text-green-500"
                                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 16 12">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="M1 5.917 5.724 10.5 15 1.5"/>
                                                </svg>
                                                <span class="text-sm">{{ $product->name }} : {{ $product->price }}</span>
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
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <div
                            class="p-4 m-4 text-center text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                            role="alert">
                            <span class="font-medium">سفارشی ثبت نشده!</span>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
</x-app-layout>
