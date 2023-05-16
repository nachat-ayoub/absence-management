<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @auth('admin')


    <div class="flex flex-col-reverse mt-8 md:flex-col">
        <div class="flex flex-col justify-between gap-y-3  px-2 mx-6 md:flex-row md:mx-12 md:px-12">
            <div class="font-medium p-8 mt-4 text-center shadow rounded-lg bg-slate-50 dark:bg-slate-950 dark:text-slate-50 md:py-6 md:px-8 md:text-start md:mt-0">
                <p class="font-bold text-2xl mb-2">{{$nbr_absence}}</p>
                <p>Absence cette année</p>
            </div>
            <div class="font-medium  p-8 text-center shadow rounded-lg bg-slate-50 dark:bg-slate-950 dark:text-slate-50 md:py-6 md:px-8 md:text-start">
                <p class="font-bold text-2xl mb-2">{{ $nbr_absence_sans_preuve  }}</p>
                <p>Absence sans preuve</p>
            </div>
            <div class="font-medium  p-8 text-center shadow rounded-lg bg-slate-50 dark:bg-slate-950 dark:text-slate-50 md:py-6 md:px-8 md:text-start">
                <p class="font-bold text-2xl mb-2">{{ number_format($nbr_absences_par_stagiaire , 2 , ",") }}%</p>
                <p>Absence par stagiaire</p>
            </div>
            <div class="font-medium  p-8 text-center shadow rounded-lg bg-slate-50 dark:bg-slate-950 dark:text-slate-50 md:py-6 md:px-8 md:text-start">
                <p class="font-bold text-2xl mb-2">{{number_format($avg_absence_par_classe , 2 , ",")}}%</p>
                <p>Absence par classe</p>
            </div>
        </div>
        <div class="flex flex-col justify-between gap-3 mt-6 px-2 mx-6 md:flex-row md:mx-12 md:px-12">
            <div>
                <table class="divide-y divide-gray-200 dark:text-gray-100 min-w-full" title="Les dernières absences enregistrées.">
                    <thead >
                      <tr>
                        <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nom</th>
                        <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Prénom</th>
                        <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Filière</th>
                        <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Groupe</th>
                        <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date d'absence</th>
                        <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden md:block">Preuve</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:text-gray-100">
                        @foreach ($derniere_stagiaire_absencet as $stg)
                        <tr>
                            <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{$stg->nom}}</td>
                            <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{$stg->prenom}}</td>
                            <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm text-gray-500">{{$stg->branche}}</td>
                            <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm text-gray-500">{{$stg->num_group}}</td>
                            <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm text-gray-500">{{$stg->date}}</td>
                            <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm text-gray-500 hidden md:block">{{$stg->preuve}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                  </table>

            </div>
            <div>
                <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100 " title="Le classement des classes en fonction de l'absence">
                    <thead>
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left dark:text-gray-50 dark:bg-gray-950 text-xs font-bold text-gray-500 uppercase tracking-wider">N°</th>
                        <th scope="col" class="px-6 py-3 text-left dark:text-gray-50 dark:bg-gray-950 text-xs font-bold text-gray-500 uppercase tracking-wider">Classe</th>
                        <th scope="col" class="px-6 py-3 text-left dark:text-gray-50 dark:bg-gray-950 text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre d'absences</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:text-gray-100">
                        @foreach ($classes_en_fonction_absences as $key => $classe)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{$key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{$classe->branche}} {{$classe->num_group}}</td>
                            <td class="px-6 py-4 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm text-gray-500">{{$classe->absence_count}}</td>
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
