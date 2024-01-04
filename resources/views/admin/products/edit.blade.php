@extends('admin.layouts.app')

@section('content')
    @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            @foreach($errors->all() as $error)
                <span class="font-medium">{{ $error }}</span>
            @endforeach
        </div>
    @endif
    <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
        ویرایش محصول
    </h2>
    <div class="w-full flex justify-center items-center mb-12">
        <img src="{{ asset("storage/images/products/" . $product->image->image) }}" alt="{{ $product->name }}"
             class="object-cover w-1/4 h-auto" width="100" style="aspect-ratio: 400 / 300; object-fit: cover;"/>
    </div>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="max-w-md mx-auto"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') dark:border-red-400 @enderror"
                       placeholder="کفش 1" required>
                @error('name')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">توضیحات</label>
                <input type="text" id="title" name="title" value="{{ old('title', $product->title) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('title') dark:border-red-400 @enderror"
                       placeholder="این کفش شماره یک است." required>
                @error('title')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="mb-5">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">قیمت
                    (تومان)</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('price') dark:border-red-400 @enderror"
                       placeholder="250000" required>
                @error('price')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="quantity"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">موجودی</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('quantity') dark:border-red-400 @enderror"
                       placeholder="12" required>
                @error('quantity')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
        </div>

        <div class="w-full mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">عکس
                محصول</label>
            <input name="image" value="{{ old('image') }}"
                   class="block mb-3 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                   id="file_input" type="file">
        </div>

        <div>
            <h2 class="text-center font-bold mb-3 mt-4">رنگ ها</h2>
            <div class="w-full flex justify-center items-center flex-wrap gap-3">
                <div class="flex items-center me-4">
                    <input id="red-checkbox" type="checkbox" name="colors[]" value="red" @if(in_array('red', json_decode($product->colors))) checked @endif
                           class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="red-checkbox"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">قرمز</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="green-checkbox" type="checkbox" name="colors[]" value="green" @if(in_array('green', json_decode($product->colors))) checked @endif
                           class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="green-checkbox"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">سبز</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="purple-checkbox" type="checkbox" name="colors[]" value="purple" @if(in_array('purple', json_decode($product->colors))) checked @endif
                           class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="purple-checkbox"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">بنفش</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="black-checkbox" type="checkbox" name="colors[]" value="gray" @if(in_array('gray', json_decode($product->colors))) checked @endif
                           class="w-4 h-4 text-gray-900 bg-gray-100 border-gray-300 rounded focus:ring-gray-800 dark:focus:ring-gray-800 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="black-checkbox"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">مشکی</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="yellow-checkbox" type="checkbox" name="colors[]" value="yellow" @if(in_array('yellow', json_decode($product->colors))) checked @endif
                           class="w-4 h-4 text-yellow-400 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="yellow-checkbox"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">زرد</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="orange-checkbox" type="checkbox" name="colors[]" value="orange" @if(in_array('orange', json_decode($product->colors))) checked @endif
                           class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="orange-checkbox"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">نارنجی</label>
                </div>
            </div>
        </div>

        <button type="submit"
                class="p-2 mt-4 font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 transition">
            ویرایش محصول
        </button>
    </form>
@endsection
