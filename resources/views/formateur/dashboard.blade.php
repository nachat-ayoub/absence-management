<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Formateur Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex items-center justify-center p-4 text-center">
        <x-primary-button class="hover:underline">
            <a href="{{ route('formateur.absence.index') }}">Noté L'Absence</a>
        </x-primary-button>
    </div>

</x-app-layout>
