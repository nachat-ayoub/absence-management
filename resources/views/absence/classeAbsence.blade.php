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
    <div class="container mx-auto mt-10 px-4" x-data="{
        action: null
        isModalOpen: false,
        toggleModal() {
            this.action = 'actionName';
            this.isModalOpen = !this.isModalOpen;
        }
    }">
        <button @click="isModalOpen = !isModalOpen"
            class="my-4 flex transform items-center justify-center space-x-2 rounded-md bg-indigo-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-indigo-600 focus:bg-indigo-500 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-50 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>

            <span>Open Modal</span>
        </button>

        <x-custom-modal name="isModalOpen" maxWidth="2xl">
            <!-- Modal content here -->
            <x-slot name="title">Noté L'absence:</x-slot>

            <form class="my-6 flex flex-col gap-y-2" action="POST" method="post">
                <div class="col-span-2 inline">
                    <x-input-label for="stagiaire_id" :value="__('Stagiaire id')" />
                    <x-text-input id="stagiaire_id" class="mt-1 block w-full" type="text" name="stagiaire_id"
                        :value="old('stagiaire_id')" value='test stagiaire' required autofocus autocomplete="stagiaire_id"
                        disabled="true" />
                    <x-input-error :messages="$errors->get('stagiaire_id')" class="mt-2" />
                </div>

                <div class="col-span-2 inline">
                    <x-input-label for="seance" :value="__('Seance')" />
                    <x-text-input id="seance" class="mt-1 block w-full" type="text" name="seance"
                        :value="old('seance')" required autofocus autocomplete="seance" />
                    <x-input-error :messages="$errors->get('seance')" class="mt-2" />
                </div>

                <div class="col-span-2 inline">
                    <x-input-label for="preuve" :value="__('Preuve')" />
                    <x-text-input id="preuve" class="mt-1 block w-full" type="text" name="preuve"
                        :value="old('preuve')" required autofocus autocomplete="preuve" />
                    <x-input-error :messages="$errors->get('preuve')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="mt-4 block">
                    <label for="isPresence" class="inline-flex cursor-pointer items-center">
                        <input id="isPresence" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="isPresence">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Présent(e)') }}</span>
                    </label>
                </div>

            </form>

            <x-primary-button @click="isModalOpen = !isModalOpen">Close</x-primary-button>
        </x-custom-modal>

        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-100 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ url()->previous() }}">Retourner</a>
        </button>

        {{-- * Table --}}
        <div class="scrollbar mt-6 flex flex-col justify-between gap-3 overflow-x-auto md:flex-row">
            <div>
                <table class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
                    title="Les absences de cette semain.">
                    <thead
                        class="dark:bg-gray-950 bg-gray-800 text-left text-xs font-bold uppercase tracking-wider text-gray-50">
                        <tr>
                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">
                                N°
                            </th>

                            <th class="px-2 py-2 md:px-6 md:py-3" scope="col">
                                Nom & Prénom
                            </th>

                            @foreach ($week['jours'] as $jour => $dateJour)
                                <th colspan="4" class="px-0 py-2 text-center md:px-6 md:py-3" scope="col">
                                    {{ $jour . ' ' . explode('-', $dateJour)[2] }}
                                </th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 bg-white dark:divide-gray-200 dark:text-gray-100">

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
                                    @foreach ($presence as $index => $session)
                                        {{-- * No presence found --}}

                                        <td data-index="{{ $index }}"
                                            class="{{ (int) explode('-', $weekDays[$jour])[2] % 2 === 0 ? 'bg-gray-200 dark:!bg-gray-800/95' : '' }} {{ $index === 1 ? '!border-gray-600 dark:!border-gray-300' : '' }} whitespace-nowrap px-[0.55rem] py-2 text-base font-medium text-gray-900 dark:bg-gray-800 dark:text-gray-100 md:py-4">
                                            <div class="flex justify-center">
                                                <button x-bind:disabled="isDisabled('{{ $weekDays[$jour] }}')"
                                                    x-on:click="openPresenceModal = true"
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
