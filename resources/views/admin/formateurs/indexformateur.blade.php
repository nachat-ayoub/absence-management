<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- <div class=" mt-6 mx-6  px-2 py-1 md:px-6 md:py-3">
        <table class="divide-y divide-gray-200 dark:text-gray-100 my-8 px-2 py-1 md:px-6 md:py-3">
            <thead>
                <tr>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider"># Id</th>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Nom</th>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Prenom</th>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Email</th>
                    <th scope="col" class="md:px-6 md:py-3 px-0 py-2 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Operation</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:text-gray-100">
                @foreach ($formateurs as $formateur)
                <tr>
                    <td  class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->id }}</td>
                    <td  class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->nom }}</td>
                    <td  class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->prenom}}</td>
                    <td  class="md:px-6 md:py-4 px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->email }}</td>
                    <td  class="md:px-6 md:py-4  px-3 py-2 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">
                    <x-primary-button class="md:block bg-slate-300 text-black dark:bg-slate-700 dark:text-white">
                        <a href="{{ route('admin.showFormateur' , $formateur->id) }}" class="">Détails</a>
                    </x-primary-button> |
                    <x-primary-button class="md:block bg-green-600 text-white dark:bg-green-500 dark:text-white">
                        <a href="{{ route('admin.showFormateur' , $formateur->id) }}" class="">MODIFIER</a>
                    </x-primary-button> |
                    <x-primary-button class="md:block bg-red-500 text-white dark:bg-red-500 dark:text-white">
                        <a href="{{ route('admin.showFormateur' , $formateur->id) }}" class="">SUPPRIMER</a>
                    </x-primary-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div> -->
        <div class="overflow-x-auto">
        <table class="table-auto min-w-full divide-y divide-gray-200 dark:text-gray-100 my-8 px-2 py-1 md:px-6 md:py-3">
            <thead>
                <tr>
                    <th scope="col" class="px-0 py-2 md:px-6 md:py-3 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider"># Id</th>
                    <th scope="col" class="px-0 py-2 md:px-6 md:py-3 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Nom</th>
                    <th scope="col" class="px-0 py-2 md:px-6 md:py-3 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Prenom</th>
                    <th scope="col" class="px-0 py-2 md:px-6 md:py-3 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-0 py-2 md:px-6 md:py-3 dark:text-gray-50 dark:bg-gray-950 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">Operation</th>
                </tr>
            </thead>
            <tbody  class="bg-white divide-y divide-gray-200 dark:text-gray-100">
                @foreach ($formateurs as $formateur)
                <tr>
                    <td   class="px-3 py-2 md:px-2 md:py-1 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->id }}</td>
                    <td   class="px-3 py-2 md:px-2 md:py-1 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->nom }}</td>
                    <td   class="px-3 py-2 md:px-2 md:py-1 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->prenom}}</td>
                    <td   class="px-3 py-2 md:px-2 md:py-1 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-sm font-medium text-gray-900">{{ $formateur->email }}</td>
                    <td   class="px-3 py-2 md:px-2 md:py-1 whitespace-nowrap dark:bg-gray-800 dark:text-gray-100 text-lg font-medium ">
                        <div class="flex flex-col space-y-2 md:space-y-0 md:flex-row md:space-x-2">

                            <!-- show -->

                            <x-primary-button class="hover:bg-slate-400 text-slate-950 dark:text-white bg-slate-300 dark:bg-slate-700 w-24 md:w-auto px-2 py-1">
                                <a href="{{ route('admin.showFormateur' , $formateur->id) }}" class="block"><i class="fa-solid fa-user fa-2xl" style="color: #1d4ed8;"></i></a>
                            </x-primary-button>

                            <!-- update -->

                            <x-primary-button class="hover:bg-slate-400 text-slate-950 dark:text-white bg-slate-300 dark:bg-slate-700 w-24 md:w-auto px-2 py-1">
                                <a href="{{ route('admin.editFormateur' , $formateur->id) }}" class="block"><i class="fa-regular fa-pen-to-square fa-2xl" style="color: #15803d;"></i></a>
                            </x-primary-button>

                            <!-- delete -->

                            <form action="{{ route('admin.destroyFormateur', $formateur->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <x-primary-button class="hover:bg-slate-400 text-slate-950 dark:text-white bg-slate-300 dark:bg-slate-700 w-full md:w-auto px-2 py-1 ">
                                    <a class="block w-full h-full"><i class="fa-solid fa-trash-can fa-2xl" style="color: #e60f0f;"></i></a>
                                </x-primary-button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-4 dark">
            {{ $formateurs->links() }}
        </div>

</x-app-layout>
