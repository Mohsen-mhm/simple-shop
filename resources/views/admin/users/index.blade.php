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
            کاربران
        </h2>
        <a href="{{ route('admin.users.create') }}"
           class="p-2 font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 transition">
            ایجاد کاربر
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
                    ایمیل
                </th>
                <th scope="col" class="px-6 py-3">
                    مسدود
                </th>
                <th scope="col" class="px-6 py-3">
                    نقش
                </th>
                <th scope="col" class="px-6 py-3">
                    عملیات
                </th>
            </tr>
            </thead>
            <tbody>
            @if($users->count())
                @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 flex justify-center">
                            @if($user->blocked)
                                <svg class="w-3.5 h-3.5 me-2 text-green-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="2"
                                          d="M1 5.917 5.724 10.5 15 1.5"/>
                                </svg>
                            @else
                                <svg class="w-3 h-3 me-2.5 text-red-500" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="2"
                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @if($user->roles->first())
                                @switch($user->roles->first()->name)
                                    @case(\App\Models\Role::GOD_ROLE)
                                        <span
                                            class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">مدیر</span>
                                        @break
                                    @case(\App\Models\Role::ADMIN_ROLE)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">ادمین</span>
                                        @break
                                @endswitch
                            @else
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">کاربر</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 flex justify-center items-center">
                            @if($user->roles->first()?->name != \App\Models\Role::GOD_ROLE)
                                @can(\App\Models\User::USER_EDIT)
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="p-2 mx-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition">
                                        ویرایش
                                    </a>
                                @endcan
                                @can(\App\Models\User::USER_BLOCK)
                                    @if($user->blocked)
                                        <a href="{{ route('admin.users.toggle.block', $user->id) }}"
                                           onclick="event.preventDefault(); document.querySelector('#toggle-block-user-{{ $user->id }}').submit()"
                                           class="p-2 mx-1 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition">
                                            فعال کردن
                                        </a>
                                    @else
                                        <a href="{{ route('admin.users.toggle.block', $user->id) }}"
                                           onclick="event.preventDefault(); document.querySelector('#toggle-block-user-{{ $user->id }}').submit()"
                                           class="p-2 mx-1 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 transition">
                                            غیرفعال کردن
                                        </a>
                                    @endif
                                @endcan
                                <form action="{{ route('admin.users.toggle.block', $user->id) }}"
                                      method="POST" class="hidden"
                                      id="toggle-block-user-{{ $user->id }}">@csrf @method('PUT')</form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">
                        <div
                            class="p-4 m-4 text-center text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                            role="alert">
                            <span class="font-medium">کاربری پیدا نشد!</span>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
@endsection
