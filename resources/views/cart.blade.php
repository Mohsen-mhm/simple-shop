@extends('layouts.master')

@section('content')
    <main class="px-6 py-8">
        <header class="mb-4">
            <h1 class="font-bold text-2xl text-white">سبد خرید</h1>
        </header>
        <div class="grid lg:grid-cols-3 gap-4">
            <div class="lg:col-span-2">
                @if(session()->get('cart') != null)
                    @if(!session()->get('cart')->isEmpty())
                        @foreach(\App\Helpers\Cart\Cart::all() as $cart)
                            @if(isset($cart['product']))
                                @php
                                    $product = $cart['product'];
                                @endphp
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm mb-4 text-white"
                                     data-v0-t="card">
                                    <div class="flex flex-col space-y-1.5 p-6 pb-2">
                                        <h3 class="text-2xl font-semibold leading-none tracking-tight">{{ $product->name }}</h3>
                                    </div>
                                    <div class="p-6 flex items-center gap-4">
                                        <img src="/storage/images/products/{{ $product->image->image }}"
                                             class="rounded-md object-cover" alt="{{ $product->name }}"
                                             width="100" height="100"
                                             style="aspect-ratio: 100 / 100; object-fit: cover;"/>
                                        <div class="">
                                            @if($cart['quantity'] != 1)
                                                <p class="text-red-300"><span
                                                        class="text-white">قیمت واحد: </span>{{ number_format($product->price) }} تومان
                                                </p>
                                                <p class="text-green-300"><span
                                                        class="text-white">قیمت کل: </span><strong>{{ number_format($product->price * $cart['quantity']) }}
                                                        تومان</strong></p>
                                            @else
                                                <p class="text-green-300"><span
                                                        class="text-white">قیمت کل: </span><strong>{{ number_format($product->price * $cart['quantity']) }}
                                                        تومان</strong></p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-wrap justify-center items-center pb-5">
                                        <div
                                            class="w-8 h-8 mx-3 p-3 bg-{{ $cart['color'] }}-500 cursor-pointer rounded-full"></div>
                                        <select onchange="changeQuantity(event,'{{ $cart['id'] }}')" name="quantity"
                                                id="quantity"
                                                class="bg-gray-50 mx-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block min-w-[5rem] p-2.5 dark:bg-gray-700 dark:border-gray-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            @foreach(range(1, $product->quantity) as $item)
                                                <option
                                                    value="{{ $item }}" {{ $cart['quantity'] == $item ? 'selected' : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div
                            class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">سبد خرید شما خالی است!</span>
                            </div>
                        </div>
                    @endif
                @else
                    <div
                        class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">سبد خرید شما خالی است!</span>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm text-white" data-v0-t="card">
                    <div class="flex flex-col space-y-1.5 p-6 pb-2">
                        <h3 class="text-2xl font-semibold leading-none tracking-tight">خلاصه سفارش</h3>
                    </div>
                    <div class="p-6 grid gap-2">
                        @php
                            $totalPrice = \App\Helpers\Cart\Cart::all()->sum(function ($cart){
                                return $cart['product']->price * $cart['quantity'];
                            });
                        @endphp
                        <span>قیمت نهایی : &nbsp; <b class="text-green-300">{{ number_format($totalPrice) }} تومان</b></span>

                        <form action="{{ route('cart.payment') }}" method="POST" id="cart-payment">@csrf</form>
                        <button onclick="document.querySelector('#cart-payment').submit()"
                                class="transition text-gray-900 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
                            <b>پرداخت سبد خرید</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function changeQuantity(event, id, cartName) {
            fetch('cart/quantity/change', {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    quantity: event.target.value,
                    cart: cartName
                })
            })
                .then(function (res) {
                    return res.json();
                })
                .then(function (data) {
                    location.reload();
                })
                .catch(function (error) {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
