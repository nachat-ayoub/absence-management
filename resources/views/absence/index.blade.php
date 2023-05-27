<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Les Classes') }}:
            </h2>

        </div>
    </x-slot>
    <div class="container mx-auto mt-10 px-4">
        {{-- <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-100 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ url()->previous() }}">Retourner</a>
        </button> --}}

        {{-- * Table --}}
        <div class="mx-4 mt-6 flex flex-col justify-between gap-3 px-2 md:flex-row">
            <div>
                <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
                    title="Les dernières absences enregistrées.">
                    <thead>
                        <tr>
                            <th class="dark:bg-gray-950 p-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                N°
                            </th>
                            <th class="dark:bg-gray-950 p-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                branche
                            </th>
                            <th class="dark:bg-gray-950 p-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                group
                            </th>
                            <th class="dark:bg-gray-950 p-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                Année Scolaire
                            </th>
                            <th class="dark:bg-gray-950 p-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                Noté L'absence
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($classes as $classeIndex => $classe)
                            <tr>
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                    {{ $classeIndex + 1 }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                    {{ $classe->branche }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                    {{ $classe->num_group }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                    {{ $classe->annee_scolaire }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">

                                    <!-- show -->

                                    <a class="mt-2 text-lg md:mt-0"
                                        href="{{ route('formateur.absence.classeAbsence', $classe->id) }}">
                                        <div class="w-full items-center rounded-lg bg-slate-50 px-4 py-2 text-center text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto"
                                            title="details de stagiaire">
                                            <i class="fa-regular fa-eye"></i>
                                        </div>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
</x-app-layout>
