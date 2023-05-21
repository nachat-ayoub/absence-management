<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10">

        <button
            class='mb-8 inline-flex items-center justify-center rounded-md border border-transparent bg-gray-800 px-6 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300'>
            <a class="flex items-center" href="{{ route('admin.formateurs') }}">
                Annuler</a>
        </button>

        <form action="{{ route('admin.updateFormateur', $formateur->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="">

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <!-- Nom -->
                    <div class="">
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="mt-1 block w-full" type="text" name="nom"
                            value="{{ $formateur->nom }}" required autofocus autocomplete="nom" />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- Prenom -->
                    <div class="">
                        <x-input-label for="prenom" :value="__('Prenom')" />
                        <x-text-input id="prenom" class="mt-1 block w-full" type="text" name="prenom"
                            value="{{ $formateur->prenom }}" required autofocus autocomplete="prenom" />
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>
                <!-- email -->
                <div class="col-span-2 inline">
                    <x-input-label for="email" :value="__('email')" />
                    <x-text-input id="email" class="mt-1 block w-full" type="text" name="email"
                        value="{{ $formateur->email }}" required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- password -->
                <div class="col-span-2 inline">
                    <x-input-label for="password" :value="__('password')" />
                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required
                        autofocus autocomplete="password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <x-primary-button class="">
                        {{ __('Modifier') }}
                    </x-primary-button>
                    <x-primary-button class="mx-5">
                        <a href="{{ route('admin.editFormateur', $formateur->id) }}">RÉINITIALISER</a>
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
