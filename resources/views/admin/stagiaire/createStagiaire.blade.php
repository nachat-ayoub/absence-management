<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Ajouter Un Stagiaire') }}
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
        @if (session()-> has('error'))
                <div class="my-2 flex p-4 mb-4  text-lg text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div>
                        {{session('error')}}
                    </div>
                </div>
        @endif

        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-400 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ route('admin.allStagiaire') }}">Retourner</a>
        </button>

        <form action="{{ route('admin.storeStagiaire') }}" method="post" id="form">
            @csrf
            <div class="">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <!-- Nom -->
                    <div>
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="mt-1 block w-full" type="text" name="nom"
                            value="{{ old('nom') }}" required autofocus autocomplete="nom" />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- Prenom -->
                    <div>
                        <x-input-label for="prenom" :value="__('Prenom')" />
                        <x-text-input id="prenom" class="mt-1 block w-full" type="text" name="prenom"
                            value="{{ old('prenom') }}" required autofocus autocomplete="prenom" />
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>
                <!-- email -->
                <div class="w-full flex flex-col gap-2 justify-between md:flex-row">
                    <div class="inline md:w-1/3">
                        <x-input-label for="branche" class="mt-1 mr-7 inline w-full md:mx-auto md:block"
                            :value="__('Filière')" />
                        <select name="branche"
                            class="mt-5 w-full rounded-lg py-2 dark:bg-gray-800 dark:text-slate-200 md:mt-1" id='selectBranche'  required>
                            <option>Choisir un Filiere</option>
                            @foreach ($branches as $branche)
                                <option value="{{ $branche }}">{{ $branche }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inline md:w-1/3">
                        <x-input-label for="num_group" :value="__('Group')"
                            class="mt-1 mr-7 inline  md:mx-auto md:block" />
                            <select name="num_group"
                            class="mt-5 w-full rounded-lg py-2 dark:bg-gray-800 dark:text-slate-200 md:mt-1" id="selectGroup" required >
                            <option>Choisir un Group</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group }}">{{ $group }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- password -->
                    <div class="inline md:w-1/3">
                        <x-input-label for="annee_scolaire" :value="__('Année scolaire')"
                        class="mt-1 mr-7 inline  md:mx-auto md:block" />
                        <select name="annee_scolaire"
                        class="mt-5 w-full rounded-lg py-2 dark:bg-gray-800 dark:text-slate-200 md:mt-1" required>
                        <option>Choisir l'Année scolaire</option>
                        @foreach ($annee_scolaires as $annee_scolaire)
                        <option value="{{ $annee_scolaire }}">{{ $annee_scolaire }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

                <div class="mt-8">
                    <input type="submit"
                        class="mr-6 rounded-lg bg-gray-800 px-5 py-2 font-medium text-slate-100 hover:bg-slate-900 dark:text-gray-200"
                        value="Ajouter" id="ajouter">
                    <input type="reset"
                        class="rounded-lg bg-gray-600 px-5 py-2 font-medium text-slate-100 hover:bg-slate-800 hover:text-gray-200 dark:bg-gray-800"
                        value="Annuler">
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
<script>
    var selectBranche = document.getElementById('selectBranche');
    var selectGroup = document.getElementById('selectGroup');
    var classes = {!! $classe !!};
    selectBranche.onchange = () => {
        selectGroup.innerHTML = '<option selected>Choisir un group</option>'
        var options = '';
        for(let i  = 0; i < classes.length ; i++){
            if(classes[i].branche === selectBranche.value){
                    options += `
                    <option value="${classes[i].num_group}">${classes[i].num_group}</option>
                    `;
                }
            }

        selectGroup.innerHTML += options;
    }
    document.getElementById('form').onsubmit = function(){
        var allSelects = document.querySelectorAll('select');
        var valueOfAllSelects = true;
        for(let i  = 0 ; i < allSelects.length ;i++){
            if(allSelects[i].value.toLowerCase().includes('choisir')){
                valueOfAllSelects = false;
                return false;
            }
        }

        return  true;
    }
</script>
