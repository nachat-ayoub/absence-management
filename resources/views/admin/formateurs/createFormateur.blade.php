<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Ajouter Un Formateur') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10 ">


        <button class='inline-flex items-center justify-center px-1 py-2 md:px-3 md:py-2 mb-4  bg-gray-800 dark:text-gray-200 dark:border-gray-400 border border-transparent rounded-lg text-white tracking-widest hover:text-gray-100 dark:hover:text-gray-800 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
            <a href="{{route('admin.formateurs')}}">Retourner</a>
        </button>


        <form action="/admin/formateur/store" method="post">
            {{csrf_field()}}
            <div class="">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <!-- Nom -->
                    <div class="">
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="mt-1 block w-full" type="text" name="nom" :value="old('nom')"
                            required autofocus autocomplete="nom" />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- Prenom -->
                    <div class="">
                        <x-input-label for="prenom" :value="__('Prenom')" />
                        <x-text-input id="prenom" class="mt-1 block w-full" type="text" name="prenom" :value="old('prenom')"
                            required autofocus autocomplete="prenom" />
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-2 mt-3 flex flex-col gap-2 md:flex-row">
                    <!-- branche -->
                    <div class="inline">
                        <x-input-label for="classe[]" :value="__('Classe')" />
                        <select name="classe[]" id="classe" multiple class=" w-full mt-1 h-11 rounded-lg border-gray-300 hover:h-32">
                            <option value="none" class="mb-2 mt-1 -pl-2 pr-3">choisir classe</option>
                            @foreach ($classes as $classe)
                            <option  value="{{$classe->id}}">{{$classe->branche}} {{$classe->num_group}}</option>
                            @endforeach
                        </select>
                    </div >
                    <!-- email -->
                    <div class="inline w-full">
                        <x-input-label for="email" :value="__('email')" />
                        <x-text-input id="email" class="mt-1 block w-full" type="text" name="email" :value="old('email')"
                        required autofocus autocomplete="email"  />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <!-- password -->
                <div class="col-span-2 inline">
                    <x-input-label for="password" :value="__('password')"  />
                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" :value="old('password')"
                        required autofocus autocomplete="password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <input type="submit" class="font-medium bg-gray-800 text-slate-100 px-5 py-2 rounded-lg mr-6 hover:bg-slate-900   dark:text-gray-200 " value="Ajouter">
                    <input type="reset" class="font-medium bg-gray-600 text-slate-100 px-5 py-2 rounded-lg dark:bg-gray-800 hover:bg-slate-800 hover:text-gray-200  " value="Annuler">
                </div>
            </div>
        </form>
    </div>




</x-app-layout>
