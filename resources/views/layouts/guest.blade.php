@props(['simple'])

<!DOCTYPE html>
<html x-data :class="$store.darkMode.on && 'dark'" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="flex flex-col bg-gray-100 pt-6 font-sans text-gray-900 antialiased dark:bg-gray-900 sm:justify-center sm:pt-0">
    <div class="absolute top-2 right-2">
        <x-darkmode-switcher></x-darkmode-switcher>
    </div>
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 dark:bg-gray-900 sm:justify-center sm:pt-0">
        <div>
            <a href="/">
                <x-application-logo class="dark:text-primary w-40 fill-current text-gray-800" />
            </a>
        </div>

        @if (isset($simple) && $simple)
            <div class="w-full overflow-hidden px-6 py-4">
                {{ $slot }}
            </div>
        @else
            <div
                class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md dark:bg-gray-800 sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        @endif
    </div>
</body>

</html>
