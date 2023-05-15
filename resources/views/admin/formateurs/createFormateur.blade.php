<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10 ">
        <form action="/admin/formateur/store" method="post">
            {{csrf_field()}}
            <div class="grid grid-cols-2 gap-4 ">

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
                <!-- email -->
                <div class="col-span-2 inline">
                    <x-input-label for="email" :value="__('email')" />
                    <x-text-input id="email" class="mt-1 block w-full" type="text" name="email" :value="old('email')"
                        required autofocus autocomplete="email"  />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- password -->
                <div class="col-span-2 inline">
                    <x-input-label for="password" :value="__('password')"  />
                    <x-text-input id="password" class="mt-1 block w-full" type="text" name="password" :value="old('password')"
                        required autofocus autocomplete="password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-primary-button class="">
                        {{ __('Ajouter') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>




</x-app-layout>
