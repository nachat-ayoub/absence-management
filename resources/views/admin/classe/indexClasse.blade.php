<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Les Classes') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-10 px-2 md:px-0">

        @if (session()->has('success'))
            <div class="mb-2 flex rounded-lg border border-green-300 bg-green-50 p-4 text-lg text-green-800 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="mt-6">
            <label for="default-search"
                class="sr-only mb-2 text-sm font-medium text-gray-900 dark:text-white">Recherche</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg aria-hidden="true" class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="search" id="searchInput"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    placeholder="Search Formateur, Nom..." required>
                <button disabled
                    class="absolute right-2.5 bottom-2.5 hidden rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 md:inline">Search</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table
                class="my-1 min-w-full table-auto divide-y divide-gray-200 px-2 py-1 dark:text-gray-100 md:px-6 md:py-3">
                <thead>
                    <tr>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            # Id</th>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            Filière</th>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            numero group</th>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            annee scolaire</th>
                        <th scope="col"
                            class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-50 md:px-6 md:py-3">
                            Operation</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="divide-y divide-gray-200 bg-white dark:text-gray-100">
                    @foreach ($classes as $classe)
                        <tr>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                {{ $classe->id }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                {{ $classe->branche }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                {{ $classe->num_group }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                {{ $classe->annee_scolaire }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-lg font-medium dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                <div class="flex flex-row space-y-2 md:space-y-0 md:space-x-4">

                                    <!-- show -->

                                    <a class="mt-2 text-lg md:mt-0" href="{{ route('admin.showClasse', $classe->id) }}">
                                        <div class="w-full items-center rounded-lg bg-slate-50 px-4 py-2 text-center text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto"
                                            title="details de stagiaire">
                                            <i class="fa-regular fa-eye"></i>
                                        </div>
                                    </a>

                                    <!-- update -->

                                    <a class="text-lg" href="{{ route('admin.editClasse', $classe->id) }}">
                                        <div class="w-full items-center rounded-lg bg-slate-50 px-4 py-2 text-center text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto"
                                            title="modifier les information de stagiaire">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </a>

                                    <!-- delete -->

                                    <form action="{{ route('admin.destroyClasse', $classe->id) }}" method="POST"
                                        onsubmit="return confirm('Le nombre de stagiaires au niveau de cette classe est {{ $classe->stagiaires->count() }} ! Voulez-vous supprimer cette classe ?')">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="dark my-4 pagination-container">
            {{ $classes->links() }}
        </div>
    </div>
</x-app-layout>
<script>
    var data = {!! $data !!};
    var input = document.getElementById("searchInput");
    input.onkeydown = function() {
        var classes = ``;
        console.log((data[0].num_group.toString().includes(107)));
        var inputValue = input.value.toLowerCase();
        for (var i = 0; i < data.length; i++) {
            if (data[i].branche.toLowerCase().includes(inputValue) || data[i].num_group.toString().includes(
                    inputValue) || data[i].annee_scolaire.includes(inputValue)) {
                console.log(inputValue);
                idClasse = data[i].id;
                classes +=
                    `
                    <tr>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                ${data[i].branche}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                {{ $classe->branche }}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                ${data[i].num_group}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                ${data[i].annee_scolaire}</td>
                            <td
                                class="whitespace-nowrap px-3 py-2 text-lg font-medium dark:bg-gray-800 dark:text-gray-100 md:px-2 md:py-1">
                                <div class="flex space-y-2 flex-row md:space-y-0 md:space-x-4">

                                    <!-- show -->

                                    <a class="text-lg mt-2 md:mt-0" href="'admin/classe/show/${idClasse}'">
                                        <div class="w-full  bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto " title="details de stagiaire">
                                            <i class="fa-regular fa-eye"></i>
                                        </div>
                                    </a>

                                    <!-- update -->

                                    <a class="text-lg" href="'admin/classe/${idClasse}/edit">
                                        <div class="w-full bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto" title="modifier les information de stagiaire">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </a>

                                    <!-- delete -->

                                    <form action="'admin/classe/${idClasse}'" method="POST" onsubmit="return confirm('Le nombre de stagiaires au niveau de cette classe est {{ $classe->stagiaires->count() }} ! Voulez-vous supprimer cette classe ?')" >
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
                    `;
                document.getElementById('tbody').innerHTML = classes;
            }
        }
    }
</script>
