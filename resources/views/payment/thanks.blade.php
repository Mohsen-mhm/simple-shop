@extends('layouts.master')

@section('content')
    <main class="flex flex-col items-center justify-center bg-gray-100">
        <div class="rounded-lg border bg-gray-800 text-white shadow-sm max-w-md w-full" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-2xl font-semibold leading-none tracking-tight text-center">با تشکر از خرید و اعتماد
                    شما!</h3>
            </div>
            <div class="p-6 flex flex-col items-center justify-center space-y-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="w-16 h-16 text-green-500"
                >
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <p class="text-lg text-green-400">پرداخت شما موفق بود.</p>
                <div class="flex items-center space-x-2">
                    <span class="text-white m-2">کد پیگیری سفارش: </span>
                    <div
                        class="inline-flex items-center rounded-full py-2 px-3 text-base border-transparent bg-blue-700 text-white">
                        {{ $resnumber }}
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center p-6">
                <a href="{{ route('home') }}" type="button"
                   class="focus:outline-none text-white bg-green-700 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition">
                    بازگشت به صفحه اصلی
                </a>
            </div>
        </div>
    </main>
@endsection
