@php
    $guard = auth()
        ->guard('formateur')
        ->check()
        ? 'formateur'
        : 'admin';
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Les Classes') }}:
            </h2>

        </div>
    </x-slot>
    <div class="container mx-auto py-10 px-4">

        {{-- * Table --}}
        <div class="mx-4 mt-6 flex flex-col justify-between gap-3 px-2 md:flex-row">
            <div>
                <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
                    title="Les dernières absences enregistrées.">
                    <thead
                        class="dark:bg-gray-950 bg-gray-800 text-left text-xs font-bold uppercase tracking-wider text-gray-50">

                        <tr>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">
                                N°
                            </th>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">
                                branche
                            </th>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">
                                group
                            </th>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">
                                Année Scolaire
                            </th>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">
                                Noté L'absence
                            </th>
                        </tr>
                    </thead>

                    <tbody
                        class="whitespace-nowrap text-sm font-medium text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100">

                        @foreach ($classes as $classeIndex => $classe)
                            <tr>
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    {{ $classeIndex + 1 }}
                                </td>
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    {{ $classe->branche }}
                                </td>
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    {{ $classe->num_group }}
                                </td>
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    {{ $classe->annee_scolaire }}
                                </td>
                                <td class="px-3 py-2 text-center md:px-6 md:py-4">

                                    <!-- show -->
                                    <a class="mt-2 text-lg md:mt-0"
                                        href="{{ route($guard . '.absence.classeAbsence', $classe->id) }}">
                                        <div class="inline-block items-center rounded-lg border border-gray-300 bg-slate-200 px-4 py-2 text-center text-slate-700 shadow-sm hover:bg-slate-300/70 hover:text-slate-600 dark:border-0 dark:bg-slate-700 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto"
                                            title="details de stagiaire">
                                            <i class="fa-solid fa-marker"></i>
                                        </div>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
        <div class="dark my-4">
            {{ $classes->links() }}
        </div>
    </div>
</x-app-layout>
