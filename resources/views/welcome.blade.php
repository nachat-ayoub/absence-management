<!DOCTYPE html>
<html x-data :class="$store.darkMode.on && 'dark'" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
@vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="bg-gray-100 pt-6 dark:bg-gray-900 dark:text-white">
    <div class="absolute top-5 right-3">
        <x-darkmode-switcher></x-darkmode-switcher>
    </div>

    <div class="flex min-h-screen w-full flex-col items-center justify-center gap-12">
        <span>
            <a href="/" class="">
                <x-application-logo class="text-primary h-40 w-40 fill-current" />
            </a>

        </span>

        <h1 class="hover:text-primary text-3xl font-bold transition-colors duration-150">Gestion D'absences</h1>

        @auth('admin')
            <div class="flex flex-col items-center justify-center gap-4 text-lg font-bold text-gray-400">
                <a href="/admin/dashboard" class="capitalize hover:text-gray-200 hover:underline">admin Dashboard</a>
            </div>
        @else
            @auth
                <div class="flex flex-col items-center justify-center gap-4 text-lg font-bold text-gray-400">
                    <a href="/dashboard" class="capitalize hover:text-gray-200 hover:underline">Dashboard</a>
                </div>
            @else
                <div
                    class="flex w-full flex-col items-center justify-center gap-4 text-lg font-bold text-gray-500 dark:text-gray-200">
                    <a href="{{ route('formateur.login') }}"
                        class="dark:hover:text-primary capitalize hover:text-gray-900 hover:underline">formateur Login</a>

                    <div class="bg-primary/60 my-4 h-0.5 w-1/2"></div>

                    <a href="/admin/login"
                        class="dark:hover:text-primary capitalize text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-200">admin
                        Login</a>
                    <div class="flex items-center justify-center gap-x-2">
                        <div class="h-0.5 w-16 bg-gray-600"></div>
                        <span class="">Or</span>
                        <div class="h-0.5 w-16 bg-gray-600"></div>
                    </div>
                    <a href="/admin/register"
                        class="dark:hover:text-primary capitalize text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-200">admin
                        Register</a>
                </div>
            @endauth
        @endauth
        @auth('formateur')
            <div class="flex flex-col items-center justify-center gap-4 text-lg font-bold text-gray-400">
                <a href="/formateur/dashboard" class="capitalize hover:text-gray-200 hover:underline">Formateur
                    Dashboard</a>
            </div>
        @endauth
    </div>
</body>

</html>
