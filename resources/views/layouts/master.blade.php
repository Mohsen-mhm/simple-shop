<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="./assets/css/flowbite/flowbite.min.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome/css/all.min.css">

    <style>
        @font-face {
            font-family: Vazir;
            src: url("./assets/fonts/vazir/Vazir.ttf");
        }

        * {
            font-family: Vazir !important;
        }
    </style>
</head>
<body dir="rtl">

<main class="min-h-screen flex flex-col items-center justify-center gap-6 px-4 py-6 md:px-8 md:py-12 bg-gray-700">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
</main>

<script src="./assets/js/flowbite/flowbite.min.js"></script>
<script src="./assets/js/tailwind/tailwind-3.3.5.js"></script>
</body>
</html>
