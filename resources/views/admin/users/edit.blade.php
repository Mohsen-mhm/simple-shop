@extends('admin.layouts.app')

@section('content')
    @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            @foreach($errors->all() as $error)
                <span class="font-medium">{{ $error }}</span>
            @endforeach
        </div>
    @endif
    <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 mb-12 leading-tight">
        ویرایش کاربر {{ $user->name }}
    </h2>
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="max-w-md mx-auto">
        @csrf
        @method('PUT')
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام</label>
                <input type="text" id="name" value="{{ old('name', $user->name) }}" name="name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') dark:border-red-400 @enderror"
                       placeholder="مرضیه" required>
                @error('name')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ایمیل</label>
                <input type="email" id="email" value="{{ old('email', $user->email) }}" name="email"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') dark:border-red-400 @enderror"
                       placeholder="marzieh@gmail.com" required>
                @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 mt-3">
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رمز عبور (در
                    صورت نیاز)</label>
                <input type="password" id="password" name="password"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') dark:border-red-400 @enderror">
                @error('password')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تکرار
                    رمز عبور (در صورت نیاز)</label>
                <input type="password" id="confirm-password" name="confirm_password"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('confirm_password') dark:border-red-400 @enderror">
                @error('confirm_password')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">{{ $message }}</span></p>
                @enderror
            </div>
        </div>
        <div class="w-full">
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نقش</label>
            <select id="role" name="role"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                <option value="USER" @if($user->roles->first()?->name != \App\Models\Role::ADMIN_ROLE) selected @endif>کاربر عادی</option>
                <option value="ADMIN" @if($user->roles->first()?->name == \App\Models\Role::ADMIN_ROLE) selected @endif>ادمین</option>
            </select>
        </div>
        <button type="submit"
                class="p-2 mt-4 font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 transition">
            ذخیره تغییرات
        </button>
    </form>
@endsection
