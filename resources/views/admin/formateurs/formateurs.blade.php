<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-col justify-between gap-3 mt-6 px-2 mx-6 md:flex-row md:mx-12 md:px-12">
        <table class="min-w-full table-auto my-10 w-full">
            <thead>
                <tr>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"># Id</th>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nom</th>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Prenom</th>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formateurs as $formateur)
                <tr class=" text-left">
                    <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->id }}</td>
                    <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->nom }}</td>
                    <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->prenom}}</td>
                    <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->email }}</td>
                    <td class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">Operation</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="  m-10">
            {{$formateurs->links()}}
        </div>

</x-app-layout>
