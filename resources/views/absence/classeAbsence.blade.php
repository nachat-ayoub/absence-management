<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __("classe $classe->id") }}
        </h2>
    </x-slot>
    <div class="container mx-auto mt-10 px-4">
        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-100 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ back() }}">Retourner</a>
        </button>

        <div class="w-full rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between">

                <p class="text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $classe->branche }} {{ $classe->num_group }}
                </p>

                <div class="flex flex-row gap-4">

                    <!-- update -->
                    <a class="text-lg" href="{{ route('admin.editClasse', $classe->id) }}">
                        <div class="w-full items-center rounded-lg bg-slate-50 px-4 py-2 text-center text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto"
                            title="modifier les information de stagiaire">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </div>
                    </a>

                    <!-- delete -->
                    <form action="{{ route('admin.destroyClasse', $classe->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="w-full items-center rounded-lg bg-slate-50 px-4 py-2 text-center text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto"
                            title="supprimer ce stagiaire">
                            <button type="submit" class="text-lg">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <p class="text-md mb-3 font-medium text-gray-900 dark:text-gray-400">

                </p>
                <p class="text-md mb-3 font-medium text-gray-900 dark:text-gray-400">
                    Annee Scolaire : {{ $classe->annee_scolaire }}
                </p>
                <p class="text-md mb-3 font-medium text-gray-900 dark:text-gray-400">
                    Totale D'absence: {{ $totalAbsences }}
                </p>
            </div>

            <h5 class="my-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Les Stagiaire Dans La
                Classe :</h5>
            <div class="my-4 overflow-x-auto">
                <table class="text-md my-5 w-full text-left text-gray-900 dark:text-gray-300">
                    <thead class="bg-gray-200 uppercase text-gray-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="font-bold">
                            <th scope="col" class="px-6 py-1 text-center">N°</th>
                            <th scope="col" class="px-6 py-1">Nom</th>
                            <th scope="col" class="px-6 py-1">Prenom</th>
                            <th scope="col" class="px-6 py-1">number D'absente</th>
                            <th scope="col" class="hidden px-6 py-1 md:table-cell">absente son preuve</th>
                            <th scope="col" class="hidden px-6 py-1 md:table-cell">absente avec preuve</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-100">
                        @foreach ($stagiaires as $key => $stagiaire)
                            <tr>
                                <td
                                    class="text-md whitespace-nowrap px-3 py-2 text-center font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                    {{ $stagiaire->id }}</td>
                                <td
                                    class="text-md whitespace-nowrap px-3 py-2 font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                    {{ $stagiaire->nom }}</td>
                                <td
                                    class="text-md whitespace-nowrap px-3 py-2 font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                    {{ $stagiaire->prenom }}</td>
                                <td class="pl-24">{{ $stagiaire->absencesCount }}</td>
                                <td class="hidden pl-24 md:table-cell">{{ $stagiaire->absenceSonPreuv }}</td>
                                <td class="hidden pl-24 md:table-cell">{{ $stagiaire->absenceAvecPreuv }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $stagiaires->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
