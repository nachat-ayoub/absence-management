<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Modifier les information de la Classe') }} {{ $classe->branche }} {{ $classe->num_group }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-10 px-2 md:px-0">
        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-400 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ route('admin.allClasses') }}">Retourner</a>
        </button>
        <form action="{{ route('admin.updateClasse', $classe->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="col-span-2 inline">
                <x-input-label for="branche" :value="__('Filière')" />
                <x-text-input id="annee_scolaire" class="mt-1 block w-full uppercase" type="text" name="branche"
                    :value="$classe->branche" required autofocus autocomplete="branche" />
                <x-input-error :messages="$errors->get('branche')" class="mt-2" />
            </div>
            <div class="w-full flex flex-col gap-2 justify-between md:flex-row">
                <div class="w-full md:w-2/3">
                    <x-input-label for="num_group" :value="__('Group')" />
                    <x-text-input id="num_group" class="mt-1 block w-full" type="text" name="num_group" :value="$classe->num_group"
                    required autofocus autocomplete="num_group" />
                    <x-input-error :messages="$errors->get('num_group')" class="mt-2" />
                </div>
                <div class="w-full md:w-1/3">
                    <x-input-label for="annee_scolaire" :value="__('Annee scolaire')" />
                    <select name="annee_scolaire" value="{{old('annee_scolaire')}}"
                    class="mt-5 w-full rounded-lg py-2 dark:bg-gray-800 dark:text-slate-200 md:mt-1" id="select">
                        <option>Choisir l'année scolaire</option>

                    </select>
                </div>
            </div>
            <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" />
            <div class="mt-8">
                <input type="submit"
                    class="mr-6 rounded-lg bg-gray-800 px-5 py-2 font-medium text-slate-100 hover:bg-slate-900 dark:text-gray-200"
                    value="Modifier">
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
            if(`${i}-${i+1}` == {!! $data !!}){
                options += `
                    <option value"${i}-${i+1}" selected=${true}>${i}-${i+1}</option>
                `;    
            }
            options += `
                <option value"${i}-${i+1}">${i}-${i+1}</option>
            `;
        }
        select.innerHTML += options;
    }
</script>