<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 mb-10  mt-10">


        <div class="bg-white rounded-lg">
            <div class=" m-5">

                <i class="fa-solid fa-user fa-2xl inline " style="color: #1d4ed8;"></i>
                <span class=" text-2xl"># id {{$formateur->id}}</span>
                <h2 class=" text-lg my-6">nom & prenom : {{$formateur->nom}} {{$formateur->prenom}}</h2>
                <h2 class=" text-lg">email : {{$formateur->email}} </h2>

                <div class="flex flex-row gap-4 my-6 mb-6 mx-6">
                    <x-primary-button class="hover:bg-slate-400 text-slate-950 dark:text-white bg-slate-300 dark:bg-slate-700 w-24 md:w-auto px-2 py-1 inline">
                                    <a href="{{ route('admin.editFormateur' , $formateur->id) }}" class="inline"><i class="fa-regular fa-pen-to-square fa-2xl" style="color: #15803d;"></i></a>
                    </x-primary-button>

                    <!-- delete -->

                    <form action="{{ route('admin.destroyFormateur', $formateur->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <x-primary-button class="hover:bg-slate-400 text-slate-950 dark:text-white bg-slate-300 dark:bg-slate-700 w-full md:w-auto px-2 py-1 inline">
                            <a class="inline w-full h-full"><i class="fa-solid fa-trash-can fa-2xl" style="color: #e60f0f;"></i></a>
                        </x-primary-button>
                    </form>
                </div>

            </div>
        </div>


    </div>



</x-app-layout>
