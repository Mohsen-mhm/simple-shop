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
            محصولات
        </h2>
        <a href="{{ route('admin.products.create') }}"
           class="p-2 font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 transition">
            ایجاد محصول
        </a>
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
                    نام
                </th>
                <th scope="col" class="px-6 py-3">
                    قیمت
                </th>
                <th scope="col" class="px-6 py-3">
                    تعداد
                </th>
                <th scope="col" class="px-6 py-3">
                    رنگ بندی
                </th>
                <th scope="col" class="px-6 py-3">
                    عملیات
                </th>
            </tr>
            </thead>
            <tbody>
            @if($products->count())
                @foreach($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->price }} تومان
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->quantity }}
                        </td>
                        <td class="px-6 py-4">
                            <ul class="flex flex-wrap w-full gap-1">
                                @foreach(json_decode($product->colors) as $color)
                                    <li>
                                        <div
                                            class="inline-flex items-center justify-between w-full p-3 bg-{{ $color }}-500 border-{{ $color }}-500 rounded-full cursor-pointer peer-checked:border-2 peer-checked:border-white peer-checked:bg-{{ $color }}-700 hover:bg-{{ $color }}-600"></div>
                                    </li>
                                @endforeach
                            </ul>
                        </td>

                        <td class="px-6 py-4 flex justify-center items-center">
                            @can(\App\Models\Product::PRODUCT_EDIT)
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="p-2 mx-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                                    ویرایش
                                </a>
                            @endcan
                            @can(\App\Models\Product::PRODUCT_DELETE)
                                <a href="{{ route('admin.products.destroy', $product->id) }}"
                                   onclick="event.preventDefault(); document.querySelector('#destroy-product-{{ $product->id }}').submit()"
                                   class="p-2 mx-1 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 transition">
                                    حذف
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                      method="POST" class="hidden"
                                      id="destroy-product-{{ $product->id }}">@csrf @method('DELETE')</form>
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
                            <span class="font-medium">محصولی پیدا نشد!</span>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
@endsection
