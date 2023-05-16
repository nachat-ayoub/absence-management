<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto mb-10 mt-10 px-4">

        <div class="w-full rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                #{{ $formateur->id }} {{ $formateur->nom }} {{ $formateur->prenom }}
            </h5>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $formateur->email }}</p>

            <div class="mt-6 flex flex-row gap-4">

                <!-- update -->
                <x-primary-button
                    class="w-full bg-slate-200 px-2 py-1 text-slate-400 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-700 dark:text-slate-400 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto">
                    <a class="text-lg" href="{{ route('admin.editFormateur', $formateur->id) }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </x-primary-button>

                <!-- delete -->
                <form action="{{ route('admin.destroyFormateur', $formateur->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-primary-button
                        class="w-full bg-slate-200 text-slate-400 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-700 dark:text-slate-400 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto">
                        <a class="text-lg">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </x-primary-button>
                </form>
            </div>

        </div>

        {{-- <div class="rounded-lg bg-white">
            <div class="m-5">

                <i class="fa-solid fa-user fa-2xl inline" style="color: #1d4ed8;"></i>
                <span class="text-2xl"># id {{ $formateur->id }}</span>
                <h2 class="my-6 text-lg">nom & prenom : {{ $formateur->nom }} {{ $formateur->prenom }}</h2>
                <h2 class="text-lg">email : {{ $formateur->email }} </h2>

                <div class="my-6 mx-6 mb-6 flex flex-row gap-4">
                    <x-primary-button
                        class="text-slate-950 inline w-24 bg-slate-300 px-2 py-1 hover:bg-slate-400 dark:bg-slate-700 dark:text-white md:w-auto">
                        <a href="{{ route('admin.editFormateur', $formateur->id) }}" class="inline"><i
                                class="fa-regular fa-pen-to-square fa-2xl" style="color: #15803d;"></i></a>
                    </x-primary-button>

                    <!-- delete -->
                    <form action="{{ route('admin.destroyFormateur', $formateur->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button
                            class="text-slate-950 inline w-full bg-slate-300 px-2 py-1 hover:bg-slate-400 dark:bg-slate-700 dark:text-white md:w-auto">
                            <a class="inline h-full w-full"><i class="fa-solid fa-trash-can fa-2xl"
                                    style="color: #e60f0f;"></i></a>
                        </x-primary-button>
                    </form>
                </div>

            </div>
        </div> --}}

    </div>

</x-app-layout>
