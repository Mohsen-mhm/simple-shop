@extends('admin.layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 w-3/4">
        <section class="text-gray-200 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-200">آمار کلی</h1>
                </div>
                <div class="flex flex-wrap -m-4 text-center">
                    <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                        <div class="border-2 border-gray-200 p-6 rounded-lg">
                            <svg class="text-indigo-500 w-12 h-12 mb-3 inline-block" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                            </svg>
                            <h2 class="title-font font-medium text-3xl text-gray-400">{{ \App\Models\User::query()->count() }}</h2>
                            <p class="leading-relaxed">کاربر</p>
                        </div>
                    </div>
                    <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                        <div class="border-2 border-gray-200 p-6 rounded-lg">
                            <svg class="text-indigo-500 w-12 h-12 mb-3 inline-block" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path
                                    d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                            </svg>
                            <h2 class="title-font font-medium text-3xl text-gray-400">{{ \App\Models\Product::query()->count() }}</h2>
                            <p class="leading-relaxed">محصول</p>
                        </div>
                    </div>
                    <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                        <div class="border-2 border-gray-200 p-6 rounded-lg">
                            <svg class="text-indigo-500 w-12 h-12 mb-3 inline-block" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <h2 class="title-font font-medium text-3xl text-gray-400">{{ \App\Models\Order::query()->count() }}</h2>
                            <p class="leading-relaxed">سفارش</p>
                        </div>
                    </div>
                    <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                        <div class="border-2 border-gray-200 p-6 rounded-lg">
                            <svg class="text-indigo-500 w-12 h-12 mb-3 inline-block" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path
                                    d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM2 12V6h16v6H2Z"/>
                                <path d="M6 8H4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm8 0H9a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2Z"/>
                            </svg>
                            <h2 class="title-font font-medium text-3xl text-gray-400">{{ \App\Models\Payment::query()->count() }}</h2>
                            <p class="leading-relaxed">پرداخت</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
