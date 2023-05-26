<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Les Classes') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10 px-2 md:px-0">

    @if (session()->has('success'))
        <div class="flex p-4 mb-2 text-lg text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
                {{session('success')}}
            </div>
        </div>
    @endif

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
                            branche</th>
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
                                <div class="flex space-y-2 flex-row md:space-y-0 md:space-x-4">

                                    <!-- show -->

                                    <a class="text-lg mt-2 md:mt-0" href="{{ route('admin.showClasse', $classe->id) }}">
                                        <div class="w-full  bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto " title="details de stagiaire">
                                            <i class="fa-regular fa-eye"></i>
                                        </div>
                                    </a>

                                    <!-- update -->

                                    <a class="text-lg" href="{{ route('admin.editClasse', $classe->id) }}">
                                        <div class="w-full bg-slate-50 rounded-lg text-center items-center px-4 py-2 text-slate-700 hover:bg-slate-300 hover:text-slate-500 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-slate-300 md:w-auto" title="modifier les information de stagiaire">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </a>

                                    <!-- delete -->

                                    <form action="{{ route('admin.destroyClasse', $classe->id) }}" method="POST" onsubmit="return confirm('Le nombre de stagiaires au niveau de cette classe est {{$classe->stagiaires->count()}} ! Voulez-vous supprimer cette classe ?')" >
                                        @csrf
                                        @method('DELETE')
                                        {{-- {{dd($classe->stagiaires->count())}} --}}
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
            {{ $classes->links() }}
        </div>
    </div>
</x-app-layout>
<script>
    var forms = document.querySelectorAll('.formDalete');
    forms[0].addEventListener('mouseenter' , function(){
        console.log(forms);
    })
</script>
