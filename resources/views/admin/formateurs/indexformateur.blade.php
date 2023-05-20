<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Les Formateurs') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <table
                class="my-8 min-w-full table-auto divide-y divide-gray-200 px-2 py-1 dark:text-gray-100 md:px-6 md:py-3">
                <thead>
                    <tr>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            # Id</th>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            Nom</th>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            Prenom</th>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            Email</th>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            Operation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:text-gray-100">
                    @foreach ($formateurs as $formateur)
                        <tr>
                            <td
                                class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-4 md:py-1">
                                {{ $formateur->id }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                {{ $formateur->nom }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                {{ $formateur->prenom }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                {{ $formateur->email }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-lg font-medium dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4">

                                    <!-- show -->

                                    <a class="text-lg mt-2 md:mt-0" href="{{ route('admin.showFormateur', $formateur->id) }}">
                                    <div class="w-full  bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto " title="details de stagiaire">
                                            <i class="fa-regular fa-eye"></i>
                                        </div>
                                    </a>

                                    <!-- update -->
                                    <a class="text-lg" href="{{ route('admin.editFormateur', $formateur->id) }}">
                                    <div class="w-full bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto" title="modifier les information de stagiaire">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </a>

                                    <!-- delete -->
                                    <form action="{{ route('admin.destroyFormateur', $formateur->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="w-full bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto" title="supprimer ce stagiaire">
                                            <button type=""submit" class="text-lg">
                                                <i class="fa-regular fa-trash-can "></i>
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="dark my-4">
            {{ $formateurs->links() }}
        </div>

    </div>

</x-app-layout>
