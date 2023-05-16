<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @auth('admin')

        <div class="mt-8 flex flex-col-reverse md:flex-col">
            <div class="mx-6 flex flex-col justify-between gap-y-3 px-2 md:mx-12 md:flex-row md:px-12">
                <div
                    class="dark:bg-slate-950 mt-4 rounded-lg bg-slate-50 p-8 text-center font-medium shadow dark:text-slate-50 md:mt-0 md:py-6 md:px-8 md:text-start">
                    <p class="mb-2 text-2xl font-bold">{{ $nbr_absence }}</p>
                    <p>Absence cette année</p>
                </div>
                <div
                    class="dark:bg-slate-950 rounded-lg bg-slate-50 p-8 text-center font-medium shadow dark:text-slate-50 md:py-6 md:px-8 md:text-start">
                    <p class="mb-2 text-2xl font-bold">{{ $nbr_absence_sans_preuve }}</p>
                    <p>Absence sans preuve</p>
                </div>
                <div
                    class="dark:bg-slate-950 rounded-lg bg-slate-50 p-8 text-center font-medium shadow dark:text-slate-50 md:py-6 md:px-8 md:text-start">
                    <p class="mb-2 text-2xl font-bold">{{ number_format($nbr_absences_par_stagiaire, 2, ',') }}%</p>
                    <p>Absence par stagiaire</p>
                </div>
                <div
                    class="dark:bg-slate-950 rounded-lg bg-slate-50 p-8 text-center font-medium shadow dark:text-slate-50 md:py-6 md:px-8 md:text-start">
                    <p class="mb-2 text-2xl font-bold">{{ number_format($avg_absence_par_classe, 2, ',') }}%</p>
                    <p>Absence par classe</p>
                </div>
            </div>
            <div class="mx-6 mt-6 flex flex-col justify-between gap-3 px-2 md:mx-12 md:flex-row md:px-12">
                <div>
                    <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
                        title="Les dernières absences enregistrées.">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                                    Nom</th>
                                <th scope="col"
                                    class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                                    Prénom</th>
                                <th scope="col"
                                    class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                                    Filière</th>
                                <th scope="col"
                                    class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                                    Groupe</th>
                                <th scope="col"
                                    class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                                    Date d'absence</th>
                                <th scope="col"
                                    class="dark:bg-gray-950 hidden px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:table-cell md:px-6 md:py-3">
                                    Preuve</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:text-gray-100">
                            @foreach ($derniere_stagiaire_absencet as $stg)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        {{ $stg->nom }}</td>
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        {{ $stg->prenom }}</td>
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        {{ $stg->branche }}</td>
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        {{ $stg->num_group }}</td>
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        {{ $stg->date }}</td>
                                    <td
                                        class="hidden whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100 md:block md:px-6 md:py-4">
                                        {{ $stg->preuve }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div>
                    <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
                        title="Le classement des classes en fonction de l'absence">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="dark:bg-gray-950 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    N°</th>
                                <th scope="col"
                                    class="dark:bg-gray-950 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    Classe</th>
                                <th scope="col"
                                    class="dark:bg-gray-950 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    Nombre d'absences</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:text-gray-100">
                            @foreach ($classes_en_fonction_absences as $key => $classe)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100">
                                        {{ $key + 1 }}</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100">
                                        {{ $classe->branche }} {{ $classe->num_group }}</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100">
                                        {{ $classe->absence_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    @endauth
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
