<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Creation D\'Un Classe') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-10 px-2 md:px-0">

        @if (session()->has('success'))
            <div class="my-2 flex rounded-lg border border-green-300 bg-green-50 p-4 text-lg text-green-800 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
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

        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-400 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ route('admin.allClasses') }}">Retourner</a>
        </button>
        <form action="{{ route('admin.storeClasse') }}" method="POST">
            @csrf
            <div class="col-span-2 inline">
                <x-input-label for="branche" :value="__('Filière')" />
                <x-text-input id="annee_scolaire" class="mt-1 block w-full uppercase" type="text" name="branche"
                    value="{{ old('branche') }}" required autofocus autocomplete="branche" />
                <x-input-error :messages="$errors->get('branche')" class="mt-2" />
            </div>
            <div class="w-full flex flex-col gap-2 justify-between md:flex-row">
                <div class="w-full  md:w-2/3">
                    <x-input-label for="num_group" :value="__('Group')" />
                    <x-text-input id="num_group" class="mt-1 block w-full" type="text" name="num_group"
                    value="{{ old('num_group') }}" required autofocus autocomplete="num_group" />
                    <x-input-error :messages="$errors->get('num_group')" class="mt-2" />
                </div>
                <div class="w-full md:w-1/3">
                    <x-input-label for="annee_scolaire" :value="__('Annee scolaire')" />
                    <select name="annee_scolaire" value="{{old('annee_scolaire')}}"
                        class="mt-5 w-full rounded-lg py-2 dark:bg-gray-800 dark:text-slate-200 md:mt-1">
                        <option>Choisir l'année scolaire</option>
                        
                    </select>
                </div>
            </div>
            <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}">
            <div class="mt-8">
                <input type="submit"
                    class="mr-6 rounded-lg bg-gray-800 px-5 py-2 font-medium text-slate-100 hover:bg-slate-900 dark:text-gray-200"
                    value="Ajouter">
                <input type="reset"
                    class="rounded-lg bg-gray-600 px-5 py-2 font-medium text-slate-100 hover:bg-slate-800 hover:text-gray-200 dark:bg-gray-800"
                    value="Annuler">
            </div>
        </form>
    </div>

</x-app-layout>
<script>
    onload =  function() {
        var select = document.querySelector('select');
        var options = "";
        for(let i  =  2020 ; i < 2040  ; i++ ) {
            options += `
            <option value"${i}-${i+1}">${i}-${i+1}</option>
            `;
        }
        select.innerHTML += options;
    }
</script>