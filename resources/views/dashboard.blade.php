<x-app-layout>
    <x-slot name="header" >
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Dashboard') }}
            </h2>
            
    </x-slot>

    <div class="py-12" id="loginBox">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    @auth('admin')
        <div class="dark:bg-gray-800 flex  flex-col-reverse py-12 md:flex-col">
            <div class="mx-auto flex flex-col justify-between gap-y-2 gap-x-3 px-1 lg:mx-12 md:flex-row md:px-12">
                <div class="flex flex-col w-1/2 gap-x-3 md:flex-row md:w-full">
                    <div
                    class="dark:bg-gray-800 mt-4 rounded-lg bg-gray-50 ring-1 ring-slate-200 p-8 text-center font-medium shadow dark:text-gray-100 dark:ring-2 dark:rounded dark:ring-gray-700 md:mt-0 md:py-6 md:px-6 md:text-start lg:w-1/2 ">
                    <p class="mb-2 text-2xl font-bold" ><span name="numbers" data-val="{{ $nbr_absence }}">00</span></p>
                    <p>Absence cette année</p>
                    </div>
                    <div
                        class="dark:bg-gray-800 mt-4 rounded-lg bg-gray-50 ring-1 ring-slate-200 p-8 text-center font-medium shadow dark:text-gray-100 dark:ring-2 dark:rounded dark:ring-gray-700 md:mt-0 md:py-6 md:px-6 md:text-start lg:w-1/2 ">
                        <p class="mb-2 text-2xl font-bold"><span name="numbers" data-val="{{ $nbr_absence_sans_preuve }}">00</span></p>
                        <p>Absence sans preuve</p>
                    </div>
                </div>
                <div class="flex flex-col w-1/2 gap-x-3 md:flex-row md:w-full">
                    <div
                        class="dark:bg-gray-800 mt-4 rounded-lg bg-gray-50 ring-1 ring-slate-200 p-8 text-center font-medium shadow dark:text-gray-100 dark:ring-2 dark:rounded dark:ring-gray-700 md:mt-0 md:py-6 md:px-6 md:text-start lg:w-1/2 ">
                        <p class="mb-2 text-2xl font-bold"><span name="numbers" data-val={{number_format($nbr_absences_par_stagiaire, 2, ',') }}>00</span>%</p>
                        <p>Absence par stagiaire</p>
                    </div>
                    <div
                        class="dark:bg-gray-800 mt-4 rounded-lg bg-gray-50 ring-1 ring-slate-200 p-8 text-center font-medium shadow dark:text-gray-100 dark:ring-2 dark:rounded dark:ring-gray-700 md:mt-0 md:py-6 md:px-6 md:text-start lg:w-1/2 ">
                        <p class="mb-2 text-2xl font-bold"><span name="numbers" data-val = {{ number_format($avg_absence_par_classe, 2, ',') }}>00%</span>%</p>
                        <p>Absence par classe</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-800 mx-8  mt-4 flex flex-col justify-between gap-3 px-2 lg:mx-12 xl:flex-row lg:px-12">
                <div>
                    <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100 dark:ring-2 dark:ring-gray-700 dark:rounded"
                        title="Les dernières absences enregistrées.">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="dark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    Nom</th>
                                <th scope="col"
                                    class="dark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    Prénom</th>
                                <th scope="col"
                                    class="dark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    Filière</th>
                                <th scope="col"
                                    class=" dark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 ">
                                    Groupe</th>
                                <th scope="col"
                                    class="hidden dark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:table-cell">
                                    Date d'absence</th>
                                <th scope="col"
                                    class="dark:bg-gray-800 hidden px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 lg:table-cell md:px-6 md:py-3">
                                    Preuve</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:text-gray-100">
                            @foreach ($derniere_stagiaire_absencet as $stg)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        {{ $stg->nom }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        {{ $stg->prenom }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                        {{ $stg->branche }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100">
                                        {{ $stg->num_group }}
                                    </td>
                                    <td
                                        class="hidden whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:table-cell">
                                        {{ $stg->date }}
                                    </td>
                                    <td
                                        class="hidden whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 lg:table-cell md:px-6 md:py-4">
                                        {{ $stg->preuve }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div>
                    <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100 dark:ring-2 dark:ring-gray-700 dark:rounded"
                        title="Le classement des classes en fonction de l'absence">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="ddark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    N°</th>
                                <th scope="col"
                                    class="ddark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    Classe</th>
                                <th scope="col"
                                    class="ddark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                                    Nombre d'absences</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:text-gray-100" id="tableClasses">
                            @foreach ($classes_en_fonction_absences as $key => $classe)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100">
                                        {{ $key + 1 }}</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100">
                                        {{ $classe->branche }} {{ $classe->num_group }}</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100">
                                        {{ $classe->absence_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endauth
    <script>
        function animationNumber() {
            var animationNumbers = document.getElementsByName('numbers');
            let interval = 2000;
            animationNumbers.forEach((animationNumber) => {
                let startValue = 0;
                let endValue =  parseInt(animationNumber.getAttribute('data-val'));
                let duration = 1000;
                if(endValue != 0){
                  duration = Math.floor(interval / endValue);
                    let counter =  setInterval(() => {
                        startValue += 1;
                        animationNumber.textContent = startValue;
                        if(startValue == endValue){
                            clearInterval(counter);
                        }
                    }, duration);
                }else{
                    animationNumber.textContent = 0;
                }
            });
        }
        
        function tableRows() {
            let table = document.querySelectorAll('#tableClasses tr');
            let rows = "";
            let tbody = "";
            if(table.length < 5){
                for(let i = 0 ; i <5 - table.length ;i++){
                    rows += `
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100">${table.length + i + 1 }</td>
                    `
                    for(let j = 0 ; j < 2 ; j++){
                        rows += `
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100">-</td>
                        `
                    }
                    tbody += `<tr>${rows}<tr/>`;
                    rows = "";
                }
                document.querySelector('#tableClasses').innerHTML +=  tbody;
            }
        }
        onload = () => {
            animationNumber();
            tableRows();
        }
        var modeButton = document.getElementById('modeButton');
        var sunIcon = document.getElementById('sunIcon');
        var moonIcon = document.getElementById('moonIcon');

        modeButton.addEventListener('click', function() {
        document.body.classList.toggle('dark'); 
        sunIcon.classList.toggle('hidden'); 
        moonIcon.classList.toggle('hidden'); 
        });

    </script>
</x-app-layout>
