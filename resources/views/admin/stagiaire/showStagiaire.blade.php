<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Stagiaire') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10 px-2 md:px-0">
        <button class='inline-flex items-center justify-center px-1 py-2 md:px-3 md:py-2 mb-4  bg-gray-800 dark:text-gray-200 dark:border-gray-400 border border-transparent rounded-lg text-white tracking-widest hover:text-gray-100 dark:hover:text-gray-800 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
            <a href="{{route('admin.allStagiaire')}}">Retourner</a>
        </button>

        <div class="w-full rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                #{{ $stagiaire->id }} {{ $stagiaire->nom }} {{ $stagiaire->prenom }}
            </h3>

            <h5 class="mb-3 font-medium text-gray-700 dark:text-gray-400">{{ $stagiaire->Classe->branche }} {{$stagiaire->Classe->num_group}}</h5>
            <div class="mt-6 flex flex-row gap-4">
                <!-- update -->
                <div class="w-full bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto" title="modifier les information de stagiaire">
                    <a class="text-lg" href="{{ route('admin.editStagiaire', $stagiaire->id) }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </div>

                <!-- delete -->
                <form action="{{ route('admin.destroyStagiaire', $stagiaire->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="w-full bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto" title="supprimer ce stagiaire">
                        <a class="text-lg">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </div>
                </form>
            </div>

        </div>


    </div>

</x-app-layout>
