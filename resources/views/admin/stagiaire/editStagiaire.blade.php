<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Modifier Les Informations  D\'Un Stagiaire') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10 px-2 md:px-0">

        <button class='inline-flex items-center justify-center px-1 py-2 md:px-3 md:py-2 mb-4  bg-gray-800 dark:text-gray-200 dark:border-gray-400 border border-transparent rounded-lg text-white tracking-widest hover:text-gray-200 dark:hover:text-gray-800 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
            <a href="{{route('admin.allStagiaire')}}">Retourner</a>
        </button>
        <form action="{{route('admin.updateStagiaire', $stagiaire->id)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <!-- Nom -->
                    <div >
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="mt-1 block w-full" type="text" name="nom" :value="$stagiaire->nom" required autofocus autocomplete="nom" />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- Prenom -->
                    <div >
                        <x-input-label for="prenom" :value="__('Prenom')" />
                        <x-text-input id="prenom" class="mt-1 block w-full" type="text" name="prenom" :value="$stagiaire->prenom"
                            required autofocus autocomplete="prenom" />
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>
                <!-- email -->
                <div class="col-span-2 flex flex-col gap-2 md:flex-row">
                    <div class="inline">
                        <x-input-label for="branche" class="mt-1  w-full inline mr-7 md:block md:mx-auto" :value="__('Filière')"  />
                        <select name="branche" class="py-2 rounded-lg mt-5 md:mt-1 dark:bg-gray-800 dark:text-slate-200">
                            <option>choisir un filiere</option>
                            @foreach ($branches as  $branche)
                                <option value="{{$branche}}" {{ $stagiaire->Classe->branche == $branche ? 'selected' : '' }}> {{$branche}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inline w-full">
                        <x-input-label for="num_group" :value="__('Group')" class="mt-1  w-full inline mr-7 md:block md:mx-auto"/>
                        <x-text-input id="num_group" class="mt-1 block w-full" type="text" name="num_group" :value="$stagiaire->Classe->num_group" required autofocus autocomplete="num_group" />
                        <x-input-error :messages="$errors->get('num_group')" class="mt-2" />
                    </div>
                </div>
                <!-- password -->
                <div class="col-span-2 inline">
                    <x-input-label for="annee_scolaire" :value="__('Année scolaire')"  />
                    <x-text-input id="annee_scolaire" class="mt-1 block w-full" type="text" name="annee_scolaire" :value="$stagiaire->Classe->annee_scolaire" required autofocus autocomplete="annee_scolaire" />
                    <x-input-error :messages="$errors->get('annee_scolaire')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <input type="submit" class="font-medium bg-gray-800 text-slate-100 px-5 py-2 rounded-lg mr-6 hover:bg-slate-900   dark:text-gray-200 " value="Modifier">
                    <input type="reset" class="font-medium bg-gray-600 text-slate-100 px-5 py-2 rounded-lg dark:bg-gray-800 hover:bg-slate-800 hover:text-gray-200  " value="Annuler">
                </div>
            </div>
        </form>
    </div>




</x-app-layout>
