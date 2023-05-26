<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Creation D\'Un Classe') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10 px-2 md:px-0">

    @if (session()->has('success'))
        <div class="flex p-4 my-2 text-lg text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
                {{session('success')}}
            </div>
        </div>
    @endif

        <button class='inline-flex items-center justify-center px-1 py-2 md:px-3 md:py-2 mb-4  bg-gray-800 dark:text-gray-200 dark:border-gray-400 border border-transparent rounded-lg text-white tracking-widest hover:text-gray-400 dark:hover:text-gray-800 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
            <a href="{{route('admin.allClasses')}}">Retourner</a>
        </button>
        <form action="{{route('admin.storeClasse')}}" method="POST">
            @csrf
            <div class="col-span-2 inline">
                <x-input-label for="branche" :value="__('Filière')"  />
                <x-text-input id="annee_scolaire" class="uppercase mt-1 block w-full" type="text" name="branche" :value="old('branche')"
                    required autofocus autocomplete="branche" />
                <x-input-error :messages="$errors->get('branche')" class="mt-2" />
            </div>
            <div class="col-span-2 inline">
                <x-input-label for="num_group" :value="__('Group')"  />
                <x-text-input id="num_group" class="mt-1 block w-full" type="text" name="num_group" :value="old('branche')"
                    required autofocus autocomplete="num_group" />
                <x-input-error :messages="$errors->get('num_group')" class="mt-2" />
            </div>
            <div class="col-span-2 inline">
                <x-input-label for="annee_scolaire" :value="__('Annee scolaire')"  />
                <x-text-input id="annee_scolaire" class="mt-1 block w-full" type="text" name="annee_scolaire" :value="old('branche')"
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
