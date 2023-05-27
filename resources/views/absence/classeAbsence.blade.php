<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Group') }}: {{ $classe->branche . $classe->num_group }} - Année: {{ $classe->annee_scolaire }}
            </h2>

            <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Semain du') }}: <span class="underline">{{ $week['start'] }}</span> au <span
                    class="underline">{{ $week['end'] }}</span>
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto mt-10 px-4" x-data="{ openPresenceModal: false }">
        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-100 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ back() }}">Retourner</a>
        </button>

        {{-- * Table --}}
        <div class="scrollbar mt-6 flex flex-col justify-between gap-3 overflow-x-auto md:flex-row">
            <div>
                <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
                    title="Les absences de cette semain.">
                    <thead>
                        <tr>
                            <th class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                N°
                            </th>

                            <th class="dark:bg-gray-950 px-0 py-2 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                scope="col">
                                Nom & Prénom
                            </th>

                            @foreach ($week['jours'] as $jour => $dateJour)
                                <th colspan="4"
                                    class="dark:bg-gray-950 px-0 py-2 text-center text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-50 md:px-6 md:py-3"
                                    scope="col">
                                    {{ $jour . ' ' . explode('-', $dateJour)[2] }}
                                </th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:text-gray-100">

                        @foreach ($classe->stagiaires as $i => $stg)
                            @php
                                $weekDays = $week['jours'];
                                $presenceData = [];
                                
                                foreach ($weekDays as $dayName => $date) {
                                    $presences = collect($stg->presences)->where('date', $date);
                                    $sessions = array_fill(1, 4, null);
                                
                                    foreach ($presences as $presence) {
                                        $sessionNumbers = explode(',', $presence['seance']);
                                        $isPresence = $presence['isPresence'] == 1;
                                        $presence_id = $presence->id;
                                        $preuve = $presence->preuve;
                                        $date = $presence->date;
                                
                                        foreach ($sessionNumbers as $sessionNumber) {
                                            $sessions[(int) $sessionNumber] = compact('isPresence', 'presence_id', 'preuve', 'date');
                                        }
                                    }
                                
                                    $presenceData[$dayName] = $sessions;
                                }
                                
                            @endphp

                            <tr class="divide-x divide-gray-500 text-gray-800 dark:divide-gray-600">
                                <td
                                    class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-6 md:py-4">
                                    {{ $i + 1 }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:px-4 md:py-4">
                                    {{ $stg->nom . ' ' . $stg->prenom }}
                                </td>

                                @foreach ($presenceData as $jour => $presence)
                                    {{-- @php
                                        dd($jour);
                                    @endphp --}}
                                    @foreach ($presence as $index => $session)
                                        {{-- * No presence found --}}

                                        <td data-index="{{ $index }}"
                                            class="{{ (int) explode('-', $weekDays[$jour])[2] % 2 === 0 ? 'bg-gray-200 dark:!bg-gray-800/95' : '' }} {{ $index === 1 ? '!border-gray-600 dark:!border-gray-300' : '' }} whitespace-nowrap px-[0.55rem] py-2 text-base font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:py-4">
                                            <div class="flex justify-center">
                                                <button x-bind:disabled="isDisabled('{{ $weekDays[$jour] }}')"
                                                    x-on:click="openModal = true"
                                                    class="flex h-5 w-5 items-center justify-center border border-gray-400">
                                                    @if ($session !== null)
                                                        <span
                                                            class="{{ $session['isPresence'] ? 'invisible' : 'inline-block' }}">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </span>
                                                    @else
                                                        <span></span>
                                                    @endif
                                                </button>
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            function isDisabled(date) {
                const currentDate = new Date().toISOString().split('T')[0];
                return date === currentDate;
            }
        </script>
    @endpush

</x-app-layout>
