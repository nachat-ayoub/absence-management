<x-app-layout>
    <x-slot name="header">
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
@auth('formateur')
    <div class=" flex flex-col-reverse py-8 md:flex-col bg-gray-100 dark:bg-gray-800 dark:text-gray-200">
        <div class="mx-6 flex flex-col justify-between gap-y-2 gap-x-3 px-1 md:mx-12 md:flex-row md:px-12">
            <div class="dark:bg-gray-800 mt-4 rounded-lg bg-gray-50 ring-1 ring-slate-200 p-8 text-center font-medium shadow dark:text-gray-100 dark:ring-2 dark:rounded dark:ring-gray-700 md:mt-0 md:py-6 md:px-6 md:text-start md:w-1/4">
                <p class="mb-2 text-2xl font-bold"><span name="numbers" data-val="{{$nbr_absences_regestrer_formateur[0]}}">00</span></p>
                <p>Absence enregister cette année par vous</p>
            </div>
            <div class="dark:bg-gray-800 mt-4 rounded-lg bg-gray-50 ring-1 ring-slate-200 p-8 text-center font-medium shadow dark:text-gray-100 dark:ring-2 dark:rounded dark:ring-gray-700 md:mt-0 md:py-6 md:px-6 md:text-start md:w-1/4">
                <p class="mb-2 text-2xl font-bold"><span name="numbers" data-val="{{$nbrAbsences[0]}}">00</span></p>
                <p>Total d'absences cette année</p>
            </div>
            <div class="dark:bg-gray-800 mt-4 rounded-lg bg-gray-50 ring-1 ring-slate-200 p-8 text-center font-medium shadow dark:text-gray-100 dark:ring-2 dark:rounded dark:ring-gray-700 md:mt-0 md:py-6 md:px-6 md:text-start md:w-1/4">
                <p class="mb-2 text-2xl font-bold"><span name="numbers" data-val="{{number_format($absenceParFormateur, 2, '.')}}">00.00</span>%</p>
                <p>D'Absence enregister cette année par vous</p>
            </div>
            <div class="dark:bg-gray-800 mt-4 rounded-lg bg-gray-50 ring-1 ring-slate-200 p-8 text-center font-medium shadow dark:text-gray-100 dark:ring-2 dark:rounded dark:ring-gray-700 md:mt-0 md:py-6 md:px-6 md:text-start md:w-1/4">
                <p class="mb-2 text-2xl font-bold"><span name="numbers" data-val="{{$classeDeFormateur}}">0</span></p>
                <p>Total de votre classes</p>
            </div>
        </div>
        <div class="bg-gray-100 dark:bg-gray-800 justify-between items-center mt-4 flex flex-col xl:mx-12 xl:flex-row ">
        <div id="diagramme" class="md:h-96 px-12 w-full mt-5 md:w-7/12 md:ml-12 md:mr-8 lg:px-0  block" >
            <canvas id="myChart" aria-label="chart" role="img"  class=" bg-gray-100 shadow dark:ring-2 dark:rounded dark:ring-gray-700 dark:bg-gray-800 overflow-hidden " title="les absences de chaque mois"  ></canvas>
        </div>
        <div class="m-auto lg:ml-12" id="table">
            <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100 dark:ring-2 dark:ring-gray-700 dark:rounded "
            title="Le classement des classes en fonction de l'absence">
            <thead>
                <tr>
                    <th scope="col"
                        class="dark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                        N°</th>
                    <th scope="col"
                        class="dark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                        Classe</th>
                    <th scope="col"
                        class="dark:bg-gray-800 px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50">
                        Nombre d'absences</th>
                </tr>
            </thead>
            <tbody id="tableClasses" class="divide-y divide-gray-200 bg-white dark:text-gray-100">
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
                    if(startValue ==  endValue){
                        clearInterval(counter);
                    }
                }, duration);
            }else{
                animationNumber.textContent = startValue;
            }
        });
    }

        function createOfDiagramme() {
            const ctx = document.getElementById('myChart').getContext('2d');
            // const min = 5;
            // const max = 20;
            var dataFromDB =  {!! $data !!}
            var dataOfDiagramme = [];
            for(let i = 0 ;  i < 11 ; i++){
                if(!Object.keys(dataFromDB).includes(String(i))){
                    dataOfDiagramme[i] = 0;
                    // dataOfDiagramme[i] = Math.floor(Math.random() * (max - min + 1)) + min;
                }else{
                    dataOfDiagramme[i] = dataFromDB[i];
                }
            }
            const dataFinal = dataOfDiagramme.slice(8).concat(dataOfDiagramme.slice(0, 8));
            const barChart = new Chart( ctx , {
                type: 'bar',
                data: {
                    labels: [ "Septembre","Octobre","Novembre","Décembre","Janvier","Février","Mars","Avril","Mai","Juin","Juillet"],
                    datasets: [{
                        label : 'Stagiaires',
                        data: dataFinal, 
                        backgroundColor: '#9BD0F5',
                        fill : false,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                display: true
                            }
                        },
                        x:{
                            grid: {
                                display: false
                            },
                            ticks: {
                                display: true
                            }
                        }

                    },
                },
                
            });
        }

        function tableRows() {
            let table = document.querySelectorAll('#tableClasses tr');
            let rows = "";
            let tbody = "";
            if(table.length < 5){
                for(let i = 0 ; i <6 - table.length ;i++){
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
        onload = function() {
            animationNumber();
            createOfDiagramme();
            tableRows();
        }
    </script>
@endauth
</x-app-layout>