<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Formateur') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-10 px-2 md:px-0">
        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-100 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ route('admin.allFormateur') }}">Retourner</a>
        </button>

        <div class="w-full rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                #{{ $formateur->id }} - {{ $formateur->nom }} {{ $formateur->prenom }}
            </h5>

            <div class= mx-4 mt-6 flex flex-col justify-between gap-3 px-2 md:flex-row">
            <div class=" w-full">
                <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
                    title="Les dernières absences enregistrées.">
                    <thead
                        class="dark:bg-gray-950 bg-gray-800 text-left text-xs font-bold uppercase tracking-wider text-gray-50">

                        <tr>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">#id</th>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">nom</th>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">prenom</th>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">email</th>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">classe  -  numéro group</th>
                        </tr>
                    </thead>
                    <tbody
                        class="whitespace-nowrap text-sm font-medium text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100">
                        <tr>
                            <td class="px-3 py-2 md:px-6 md:py-4">{{ $formateur->id }}</td>
                            <td class="px-3 py-2 md:px-6 md:py-4">{{ $formateur->nom }}</td>
                            <td class="px-3 py-2 md:px-6 md:py-4">{{ $formateur->prenom }}</td>
                            <td class="px-3 py-2 md:px-6 md:py-4">{{ $formateur->email }}</td>
                            <td class="px-3 py-2 md:px-6 md:py-4">
                            <ul>
                                @foreach($classes as $classe)
                                    <!-- <li class=" pl-8">{{ $classe->branche }}  -   {{ $classe->num_group }}</li> -->
                                    <li class=" px-8 py-2">
                                        <a  href="{{ route('admin.showClasse', $classe->id) }}">
                                        - {{ $classe->branche }}  -  Groupe   {{ $classe->num_group }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>

            <div class="mt-6 flex flex-row gap-4">

                <!-- update -->
                <a class="text-lg" href="{{ route('admin.editFormateur', $formateur->id) }}">
                    <div class="w-full items-center rounded-lg bg-slate-50 px-4 py-2 text-center text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto"
                        title="modifier les information de stagiaire">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </div>
                </a>

                <!-- delete -->
                <form action="{{ route('admin.destroyFormateur', $formateur->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="w-full items-center rounded-lg bg-slate-50 px-4 py-2 text-center text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto"
                        title="supprimer ce stagiaire">
                        <button type=""submit" class="text-lg">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>

        {{-- <div class="rounded-lg bg-white">
            <div class="m-5">

                <i class="fa-solid fa-user fa-2xl inline"></i>
                <span class="text-2xl"># id {{ $formateur->id }}</span>
                <h2 class="my-6 text-lg">nom & prenom : {{ $formateur->nom }} {{ $formateur->prenom }}</h2>
                <h2 class="text-lg">email : {{ $formateur->email }} </h2>

                <div class="my-6 mx-6 mb-6 flex flex-row gap-4">
                    <x-primary-button
                        class="text-slate-950 inline w-24 bg-slate-300 px-2 py-1 hover:bg-slate-400 dark:bg-slate-700 dark:text-white md:w-auto">
                        <a href="{{ route('admin.editFormateur', $formateur->id) }}" class="inline"><i
                                class="fa-regular fa-pen-to-square fa-2xl"></i></a>
                    </x-primary-button>

                    <!-- delete -->
                    <form action="{{ route('admin.destroyFormateur', $formateur->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button
                            class="text-slate-950 inline w-full bg-slate-300 px-2 py-1 hover:bg-slate-400 dark:bg-slate-700 dark:text-white md:w-auto">
                            <a class="inline h-full w-full"><i class="fa-solid fa-trash-can fa-2xl"></i></a>
                        </x-primary-button>
                    </form>
                </div>

            </div>
        </div> --}}

    </div>

</x-app-layout>
