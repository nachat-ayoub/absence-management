<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('L\'absence') }}
        </h2>
    </x-slot>

    <div class="mt-6 flex w-full flex-col justify-between gap-3 px-2 md:flex-row md:px-12">

        <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100" title="Les classes trouvées.">
            <thead>
                <tr>
                    <th scope="col"
                        class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                        Branche
                        {{-- Filière --}}
                    </th>

                    <th scope="col"
                        class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                        Groupe
                    </th>
                    <th scope="col"
                        class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                        Année scolaire
                    </th>
                    <th scope="col"
                        class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                        creé par admin
                    </th>

                    <th scope="col"
                        class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3">
                        absence
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white dark:text-gray-100">
                @foreach ($classes as $classe)
                    <tr>
                        <td
                            class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                            {{ $classe->branche }}
                        </td>
                        <td
                            class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                            {{ $classe->num_group }}
                        </td>
                        <td
                            class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                            {{ $classe->annee_scolaire }}
                        </td>
                        <td
                            class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                            {{ $classe->admin->email }}
                        </td>
                        <td
                            class="whitespace-nowrap px-3 py-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                            <x-primary-button>
                                <a href="{{ route('formateur.absence.classe', $classe->id) }}">Noté</a>
                            </x-primary-button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>

</x-app-layout>
