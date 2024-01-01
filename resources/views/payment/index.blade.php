<x-app-layout>
    <div class="flex flex-col justify-center text-white items-center space-x-8 mt-5">
        <aside class="w-full max-w-xs">
            <div class="rounded-lg border bg-gray-800 text-card-foreground shadow-sm w-full" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold leading-none tracking-tight">درگاه
                        پرداخت {{ env('APP_NAME') }}</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between font-bold">
                        <span>قیمت نهایی : &nbsp; <b
                                class="text-green-300">{{ number_format($order->price) }} تومان</b></span>
                    </div>
                </div>
            </div>
        </aside>
        <div class="rounded-lg border bg-gray-800 text-card-foreground shadow-sm w-full max-w-lg m-2" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-2xl font-semibold leading-none tracking-tight">اکنون پرداخت کنید</h3>
                <p class="text-sm text-muted-foreground">اطلاعات حساب بانکی خود را وارد کنید</p>
            </div>
            <div class="p-6 space-y-4">
                <div class="space-y-2">
                    <div>
                        <label for="small-input"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره
                            کارت</label>
                        <input type="text" id="small-input" disabled readonly
                               class="block w-full transition p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <div>
                            <label for="small-input"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ماه</label>
                            <input type="number" id="small-input" disabled readonly
                                   class="block w-full transition p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div>
                            <label for="small-input"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">سال</label>
                            <input type="number" id="small-input" disabled readonly
                                   class="block w-full transition p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div>
                            <label for="small-input"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CVV</label>
                            <input type="number" id="small-input" disabled readonly
                                   class="block w-full transition p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('payment.handle') }}" method="POST">
                @csrf
                <div class="flex justify-between items-center p-6">
                    <input type="text" name="result" id="payment-result" hidden>
                    <input type="text" name="order" value="{{ $order->id }}" hidden>
                    <button type="submit" onclick="document.querySelector('#payment-result').value = 1"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-green-800 transition">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 18 21">
                            <path
                                d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                        </svg>
                        موفق
                    </button>
                    <button type="submit" onclick="document.querySelector('#payment-result').value = 0"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 18 21">
                            <path
                                d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                        </svg>
                        ناموفق
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
