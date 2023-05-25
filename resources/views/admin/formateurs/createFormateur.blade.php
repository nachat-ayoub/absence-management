<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Ajouter Un Formateur') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10 px-2 md:px-0">

        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-100 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ route('admin.formateurs') }}">Retourner</a>
        </button>

        <form action="/admin/formateur/store" method="post">
            {{ csrf_field() }}
            <div class="">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Nom -->
                    <div class="">
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="mt-1 block w-full" type="text" name="nom"
                            :value="old('nom')" required autofocus autocomplete="nom" />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- Prenom -->
                    <div class="">
                        <x-input-label for="prenom" :value="__('Prenom')" />
                        <x-text-input id="prenom" class="mt-1 block w-full" type="text" name="prenom"
                            :value="old('prenom')" required autofocus autocomplete="prenom" />
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>
                </div>
                <!-- classes -->
                <div class="mt-2">
                    <x-input-label for="classes" :value="__('Classes')" />
                    <x-multi-select>
                        @foreach ($classes as $option)
                            <option value="{{ $option->id }}" selected=>{{ $option->branche }}
                                {{ $option->num_group }}</option>
                        @endforeach
                    </x-multi-select>
                </div>

            </div>
            <!-- email -->
            <div class="inline w-full">
                <x-input-label for="email" :value="__('email')" />
                <x-text-input id="email" class="mt-1 block w-full" type="text" name="email" :value="old('email')"
                    required autofocus autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- password -->
            <div class="col-span-2 mt-2">
                <x-input-label for="password" :value="__('password')" />
                <x-text-input id="password" class="mt-1 block w-full" type="password" name="password"
                    :value="old('password')" required autofocus autocomplete="password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-8">
                <input type="submit"
                    class="mr-6 rounded-lg bg-gray-800 px-5 py-2 font-medium text-slate-100 hover:bg-slate-900 dark:text-gray-200"
                    value="Ajouter">
                <input type="reset"
                    class="rounded-lg bg-gray-600 px-5 py-2 font-medium text-slate-100 hover:bg-slate-800 hover:text-gray-200 dark:bg-gray-800"
                    value="Annuler">
            </div>
    </div>
    </form>
    </div>

</x-app-layout>
