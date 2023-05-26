<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Group') }}: {{ $classe->branche . $classe->num_group }} - Année: {{ $classe->annee_scolaire }}
        </h2>
    </x-slot>
    <div class="container mx-auto mt-10 px-4">
        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-100 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ back() }}">Retourner</a>
        </button>

        {{-- <div class="w-full rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
            <h2 class="text-xl font-bold">CLass: {{ $classe->id }}</h2>
        </div> --}}

        {{-- * Table --}}
        <div class="mx-6 mt-6 flex flex-col justify-between gap-3 px-2 md:mx-12 md:flex-row md:px-12">
            <div>
                <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
                    title="Les dernières absences enregistrées.">
                    <thead>
                        <tr>
                            <th class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                N°
                            </th>

                            <th class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                Nom & Prénom
                            </th>

                            @php
                                $jours = ['Lundi', 'Mardi', 'Mercredi'];
                            @endphp

                            @foreach ($jours as $jour)
                                <th class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                    scope="col">
                                    {{ $jour }}
                                </th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:text-gray-100">
                        @foreach ($classe->stagiaires as $i => $stg)
                            <tr>
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                    {{ $i + 1 }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                    {{ $stg->nom . ' ' . $stg->prenom }}
                                </td>

                                @foreach ($jours as $j => $jour)
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        <div class="flex justify-center">
                                            <span class="w-fit border border-gray-400 px-1.5 py-0.5">
                                                <span
                                                    class="{{ isset($stg->presences[$j]) && !$stg->presences[$j]->isPresence ? 'inline-block' : 'invisible' }}">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </span>
                                            </span>
                                            </span>
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
