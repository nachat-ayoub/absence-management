<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Modifier les information de la Classe') }} {{$classe->branche}} {{$classe->num_group}}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10">
        <button class='inline-flex items-center justify-center px-1 py-2 md:px-3 md:py-2 mb-4  bg-gray-800 dark:text-gray-200 dark:border-gray-400 border border-transparent rounded-lg text-white tracking-widest hover:text-gray-400 dark:hover:text-gray-800 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
            <a href="{{route('admin.allClasses')}}">Retourner</a>
        </button>
        <form action="{{route('admin.updateClasse' , $classe->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="col-span-2 inline">
                <x-input-label for="branche" :value="__('Filière')"  />
                <x-text-input id="annee_scolaire" class="uppercase mt-1 block w-full" type="text" name="branche" :value="$classe->branche"
                    required autofocus autocomplete="branche" />
                <x-input-error :messages="$errors->get('branche')" class="mt-2" />
            </div>
            <div class="col-span-2 inline">
                <x-input-label for="num_group" :value="__('Group')"  />
                <x-text-input id="num_group" class="mt-1 block w-full" type="text" name="num_group" :value="$classe->num_group"
                    required autofocus autocomplete="num_group" />
                <x-input-error :messages="$errors->get('num_group')" class="mt-2" />
            </div>
            <div class="col-span-2 inline">
                <x-input-label for="annee_scolaire" :value="__('Annee scolaire')"  />
                <x-text-input id="annee_scolaire" class="mt-1 block w-full" type="text" name="annee_scolaire" :value="$classe->annee_scolaire"
                    required autofocus autocomplete="annee_scolaire" />
                <x-input-error :messages="$errors->get('annee_scolaire')" class="mt-2" />
            </div>
            <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">
            <div class="mt-8">
                <input type="submit" class="font-medium bg-gray-800 text-slate-100 px-5 py-2 rounded-lg mr-6 hover:bg-slate-900   dark:text-gray-200 " value="Ajouter">
                <input type="reset" class="font-medium bg-gray-600 text-slate-100 px-5 py-2 rounded-lg dark:bg-gray-800 hover:bg-slate-800 hover:text-gray-200" value="Annuler">
            </div>
        </form>
    </div>
    
</x-app-layout>