<x-guest-layout :simple='true'>

    <div class="flex w-full flex-col items-center justify-center gap-12">

        <h1
            class="dark:hover:text-primary hover:text-primary text-3xl font-bold text-gray-800 transition-colors duration-150 dark:text-white">
            Gestion De Presence
        </h1>
        <div
            class="grid-col-1 grid w-full place-items-center gap-10 text-gray-600 transition-all duration-300 ease-in-out dark:text-gray-600 md:grid-cols-2 md:px-8">

            @auth('admin')
                <section
                    class="dark:hover:border-primary/40 hover:border-primary/40 group flex w-full max-w-lg items-center justify-between rounded border-2 border-gray-100 bg-white p-4 shadow-sm hover:animate-pulse dark:border-gray-700 dark:bg-gray-800 dark:shadow-none md:col-span-2 md:p-6">
                    <div
                        class="dark:group-hover:text-primary group-hover:text-primary flex flex-col justify-center pr-4 md:pr-10">
                        <span class="text-9xl">
                            <i class="fa-solid fa-user-tie"></i>
                        </span>

                        <span class="mt-1 text-4xl font-bold capitalize">
                            Admin
                        </span>

                    </div>

                    <div class="flex flex-col gap-y-5 pr-4 font-bold capitalize text-gray-500 dark:text-gray-200 md:pr-10">
                        <a href="{{ route('admin.dashboard') }}"
                            class="dark:hover:text-primary hover:text-gray-900 hover:underline">
                            Dashboard
                        </a>
                    </div>
                </section>
            @else
                @auth('formateur')
                    <section
                        class="dark:hover:border-primary/40 hover:border-primary/40 group flex w-full max-w-lg items-center justify-between rounded border-2 border-gray-100 bg-white p-4 shadow-sm hover:animate-pulse dark:border-gray-700 dark:bg-gray-800 dark:shadow-none md:col-span-2 md:p-6">
                        <div class="dark:group-hover:text-primary group-hover:text-primary flex flex-col justify-center">
                            <span class="text-9xl">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </span>

                            <span class="font-boldRegister mt-1 text-4xl capitalize">
                                Formateur
                            </span>

                        </div>

                        <div class="flex flex-col gap-y-5 px-4 font-bold capitalize text-gray-500 dark:text-gray-200">
                            <a href="{{ route('formateur.dashboard') }}"
                                class="dark:hover:text-primary hover:text-gray-900 hover:underline">
                                Dashboard
                            </a>
                        </div>
                    </section>
                @else
                    @guest
                        <section
                            class="dark:hover:border-primary/40 hover:border-primary/40 group flex w-full max-w-lg items-center justify-between rounded border-2 border-gray-100 bg-white p-4 shadow-sm hover:animate-pulse dark:border-gray-700 dark:bg-gray-800 dark:shadow-none md:p-6">
                            <div
                                class="dark:group-hover:text-primary group-hover:text-primary flex flex-col justify-center pr-4 md:pr-10">
                                <span class="text-9xl">
                                    <i class="fa-solid fa-user-tie"></i>
                                </span>

                                <span class="mt-1 text-4xl font-bold capitalize">
                                    Admin
                                </span>

                            </div>

                            <div class="flex flex-col gap-y-5 pr-4 font-bold capitalize text-gray-500 dark:text-gray-200 md:pr-10">
                                <a href="{{ route('admin.login') }}"
                                    class="dark:hover:text-primary hover:text-gray-900 hover:underline">
                                    Login
                                </a>
                                <a href="{{ route('admin.register') }}"
                                    class="dark:hover:text-primary hover:text-gray-900 hover:underline">
                                    Register
                                </a>
                            </div>
                        </section>

                        <section
                            class="dark:hover:border-primary/40 hover:border-primary/40 group flex w-full max-w-lg items-center justify-between rounded border-2 border-gray-100 bg-white p-4 shadow-sm hover:animate-pulse dark:border-gray-700 dark:bg-gray-800 dark:shadow-none md:p-6">
                            <div class="dark:group-hover:text-primary group-hover:text-primary flex flex-col justify-center">
                                <span class="text-9xl">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </span>

                                <span class="font-boldRegister mt-1 text-4xl capitalize">
                                    Formateur
                                </span>

                            </div>

                            <div class="flex flex-col gap-y-5 px-4 font-bold capitalize text-gray-500 dark:text-gray-200">
                                <a href="{{ route('formateur.login') }}"
                                    class="dark:hover:text-primary hover:text-gray-900 hover:underline">
                                    Login
                                </a>
                            </div>
                        </section>

                    @endguest
                @endauth
            @endauth

        </div>

    </div>
</x-guest-layout>
