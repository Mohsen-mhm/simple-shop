@extends('admin.layouts.app')

@section('content')
    @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            @foreach($errors->all() as $error)
                <span class="font-medium">{{ $error }}</span>
            @endforeach
        </div>
    @endif
    <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight mb-8">
        ویرایش سفارش
    </h2>
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('PUT')
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="mb-5">
                <label for="tracking_serial" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">کد
                    رهگیری</label>
                <input type="text" id="tracking_serial" name="tracking_serial"
                       value="{{ old('tracking_serial', $order->tracking_serial) }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('tracking_serial') dark:border-red-400 @enderror"
                       placeholder="18798415687413574">
                @error('tracking_serial')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="status"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">وضعیت</label>
                <select id="status" name="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="{{ \App\Models\Order::STATUS_UNPAID }}"
                            @if($order->status == \App\Models\Order::STATUS_UNPAID) selected @endif>{{ \App\Models\Order::FA_UNPAID }}</option>
                    <option
                        value="{{ \App\Models\Order::STATUS_PREPARATION }}"
                        @if($order->status == \App\Models\Order::STATUS_PREPARATION) selected @endif>{{ \App\Models\Order::FA_PREPARATION }}</option>
                    <option value="{{ \App\Models\Order::STATUS_POSTED }}"
                            @if($order->status == \App\Models\Order::STATUS_POSTED) selected @endif>{{ \App\Models\Order::FA_POSTED }}</option>
                    <option
                        value="{{ \App\Models\Order::STATUS_RECEIVED }}"
                        @if($order->status == \App\Models\Order::STATUS_RECEIVED) selected @endif>{{ \App\Models\Order::FA_RECEIVED }}</option>
                    <option
                        value="{{ \App\Models\Order::STATUS_CANCELED }}"
                        @if($order->status == \App\Models\Order::STATUS_CANCELED) selected @endif>{{ \App\Models\Order::FA_CANCELED }}</option>
                </select>
                @error('title')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
        </div>

        <button type="submit"
                class="p-2 mt-4 font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 transition">
            ویرایش سفارش
        </button>
    </form>
@endsection
