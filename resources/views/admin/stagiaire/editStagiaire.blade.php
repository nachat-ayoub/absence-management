<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Modifier Les Informations  D\'Un Stagiaire') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-10 px-2 md:px-0">

        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-200 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ route('admin.allStagiaire') }}">Retourner</a>
        </button>
        <form action="{{ route('admin.updateStagiaire', $stagiaire->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <!-- Nom -->
                    <div>
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="mt-1 block w-full" type="text" name="nom"
                            :value="$stagiaire->nom" required autofocus autocomplete="nom" />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- Prenom -->
                    <div>
                        <x-input-label for="prenom" :value="__('Prenom')" />
                        <x-text-input id="prenom" class="mt-1 block w-full" type="text" name="prenom"
                            :value="$stagiaire->prenom" required autofocus autocomplete="prenom" />
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>
                <!-- email -->
                <div class="col-span-2 flex flex-col gap-2 md:flex-row">
                    <div class="inline">
                        <x-input-label for="branche" class="mt-1 mr-7 inline w-full md:mx-auto md:block"
                            :value="__('Filière')" />
                        <select name="branche"
                            class="mt-5 rounded-lg py-2 dark:bg-gray-800 dark:text-slate-200 md:mt-1">
                            <option>choisir un filiere</option>
                            @foreach ($branches as $branche)
                                <option value="{{ $branche }}"
                                    {{ $stagiaire->Classe->branche == $branche ? 'selected' : '' }}> {{ $branche }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inline w-full">
                        <x-input-label for="num_group" :value="__('Group')"
                            class="mt-1 mr-7 inline w-full md:mx-auto md:block" />
                        <x-text-input id="num_group" class="mt-1 block w-full" type="text" name="num_group"
                            :value="$stagiaire->Classe->num_group" required autofocus autocomplete="num_group" />
                        <x-input-error :messages="$errors->get('num_group')" class="mt-2" />
                    </div>
                </div>
                <!-- password -->
                <div class="col-span-2 inline">
                    <x-input-label for="annee_scolaire" :value="__('Année scolaire')" />
                    <x-text-input id="annee_scolaire" class="mt-1 block w-full" type="text" name="annee_scolaire"
                        :value="$stagiaire->Classe->annee_scolaire" required autofocus autocomplete="annee_scolaire" />
                    <x-input-error :messages="$errors->get('annee_scolaire')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <input type="submit"
                        class="mr-6 rounded-lg bg-gray-800 px-5 py-2 font-medium text-slate-100 hover:bg-slate-900 dark:text-gray-200"
                        value="Modifier">
                    <input type="reset"
                        class="rounded-lg bg-gray-600 px-5 py-2 font-medium text-slate-100 hover:bg-slate-800 hover:text-gray-200 dark:bg-gray-800"
                        value="Annuler">
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
