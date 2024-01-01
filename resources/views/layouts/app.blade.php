<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('APP_NAME') }}</title>
        <link rel="stylesheet" href="/assets/css/flowbite/flowbite.min.css">
        <link rel="stylesheet" href="/assets/fonts/fontawesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="/assets/fonts/fontawesome/css/all.min.css">

        <style>
            @font-face {
                font-family: Vazir;
                src: url("/assets/fonts/vazir/Vazir.ttf");
            }

            * {
                font-family: Vazir !important;
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" dir="rtl">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex flex-col items-center justify-center gap-6 px-4 py-6 md:px-8 md:py-12 bg-gray-700">
                {{ $slot }}
            </main>
            @include('layouts.footer')
        </div>
    </body>
    <script src="/assets/js/flowbite/flowbite.min.js"></script>
</html>
