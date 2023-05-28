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
        data: null,
        action: null,
        isModalOpen: false,
        toggleModal(action = null, data = null) {
            console.log({ action, data, })
    
            this.action = action;
            this.data = data;
            this.isModalOpen = !this.isModalOpen;
        }
    }">
        @if ($errors->has('error'))
            <div class="my-2 flex rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ $errors->first('error') }}</span>
                </div>
            </div>
        @endif

        <x-custom-modal name="isModalOpen" maxWidth="2xl">
            <!-- Modal content here -->
            <x-slot name="title">
                <p x-text="(action === 'update' ?  'Modifier' : 'Noté' ) +  ' L\'absence'"></p>
            </x-slot>

            {{-- ! create popup --}}
            <template x-if="action === 'create'">
                <form class="my-6 flex flex-col gap-y-2" action="{{ url()->current() }}" method="POST">
                    @csrf
                    <input type="hidden" id="stagiaire_id" name="stagiaire_id" x-bind:value="data.stagiaire_id"
                        value="{{ old('stagiaire_id') }}" readonly>
                    <input type="hidden" id="classe_id" name="classe_id" x-bind:value="data.classe_id"
                        value="{{ old('classe_id') }}" readonly>

                    <div class="col-span-2 inline">
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" name="date" class="mt-1 block w-full" type="text"
                            x-bind:value="data.date" readonly />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>
                    <div class="col-span-2 inline">
                        <x-input-label for="stagiaire_index" :value="__('Stagiaire')" />
                        <x-text-input id="stagiaire_index" class="mt-1 block w-full" type="text"
                            name="stagiaire_index" x-bind:value="data.stagiaire_index" readonly />
                        <x-input-error :messages="$errors->get('stagiaire_index')" class="mt-2" />
                    </div>

                    <div class="col-span-2 inline">
                        <x-input-label for="seance" :value="__('Seance')" />
                        <x-text-input id="seance" class="mt-1 block w-full" type="text" name="seance"
                            x-bind:value="data.seance" value="{{ old('seance') }}" required autofocus
                            autocomplete="seance" />
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                            pour plusieurs sessions, définissez "," entre eux, par exemple: "1,2".
                        </p>
                        <x-input-error :messages="$errors->get('seance')" class="mt-2" />
                    </div>

                    {{-- <div class="col-span-2 inline">
                        <x-input-label for="preuve" _value="__('Preuve')" />
                        <x-text-input id="preuve" class="mt-1 block w-full" type="text" name="preuve"
                             _value="old('preuve')" required autofocus autocomplete="preuve" />
                        <x-input-error  _messages="$errors->get('preuve')" class="mt-2" />
                    </div> --}}

                    <!-- Is Presente -->
                    <div class="mt-4 block">
                        <label for="isPresence" class="inline-flex cursor-pointer items-center">
                            <input id="isPresence" type="checkbox" checked="true"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="isPresence">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Présent(e)') }}</span>
                        </label>
                    </div>
                    <div class="flex w-full justify-center gap-x-4">
                        <x-secondary-button type="button" @click="toggleModal()">Close</x-secondary-button>
                        <x-primary-button>Sauvegarder</x-primary-button>
                    </div>
                </form>
            </template>

            {{-- ! update popup --}}
            <template x-if="action === 'update'">
                <form class="my-6 flex flex-col gap-y-2" action="{{ url()->current() }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="presence_id" name="presence_id" x-bind:value="data.presence_id"
                        value="{{ old('presence_id') }}">

                    <div class="col-span-2 inline">
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" name="date" class="mt-1 block w-full" type="text"
                            x-bind:value="data.date" readonly />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>
                    <div class="col-span-2 inline">
                        <x-input-label for="stagiaire_index" :value="__('Stagiaire')" />
                        <x-text-input id="stagiaire_index" class="mt-1 block w-full" type="text"
                            name="stagiaire_index" x-bind:value="data.stagiaire_index" readonly />
                        <x-input-error :messages="$errors->get('stagiaire_index')" class="mt-2" />
                    </div>

                    <div class="col-span-2 inline">
                        <x-input-label for="seance" :value="__('Seance')" />
                        <x-text-input id="seance" class="mt-1 block w-full" type="text" name="seance"
                            x-bind:value="data.seance" value="{{ old('seance') }}" required autofocus
                            autocomplete="seance" />
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                            pour plusieurs sessions, définissez "," entre eux, par exemple: "1,2".
                        </p>
                        <x-input-error :messages="$errors->get('seance')" class="mt-2" />
                    </div>

                    <!-- Is Presente -->
                    <div class="mt-4 block">
                        <label for="isPresence" class="inline-flex cursor-pointer items-center">
                            <input id="isPresence" type="checkbox" x-bind:checked="data.isPresence"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="isPresence">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Présent(e)') }}</span>
                        </label>
                    </div>
                    <div class="flex w-full justify-center gap-x-4">
                        <x-secondary-button type="button" @click="toggleModal()">Close</x-secondary-button>
                        <x-primary-button>Sauvegarder</x-primary-button>
                    </div>
                </form>
            </template>
        </x-custom-modal>
        <button
            class='mb-4 inline-flex items-center justify-center rounded-lg border border-transparent bg-gray-800 px-1 py-2 tracking-widest text-white transition duration-150 ease-in-out hover:text-gray-100 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:border-gray-400 dark:text-gray-200 dark:hover:bg-white dark:hover:text-gray-800 dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300 md:px-3 md:py-2'>
            <a href="{{ url()->previous() }}">Retourner</a>
        </button>

        {{-- * Table --}}
        <div class="scrollbar mt-6 flex flex-col justify-between gap-3 overflow-x-auto md:flex-row">
            <div>
                <table id="presence_table" class="min-w-full divide-y divide-gray-200 dark:text-gray-100"
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
                                        $classe_id = $presence->classe_id;
                                        $stagiaire_id = $presence->stagiaire_id;
                                        $stagiaire_index = $i + 1;
                                        $seance = $presence->seance;
                                
                                        foreach ($sessionNumbers as $sessionNumber) {
                                            $sessions[(int) $sessionNumber] = compact('classe_id', 'stagiaire_id', 'stagiaire_index', 'seance', 'isPresence', 'preuve', 'presence_id', 'date');
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
                                                    data-date="{{ $weekDays[$jour] }}"
                                                    @click="toggleModal('{{ $session === null ? 'create' : 'update' }}', {{ json_encode(
                                                        $session !== null
                                                            ? $session
                                                            : [
                                                                'classe_id' => $classe->id,
                                                                'stagiaire_id' => $stg->id,
                                                                'stagiaire_index' => $i + 1,
                                                                'seance' => $index,
                                                                'date' => $weekDays[$jour],
                                                            ],
                                                    ) }})"
                                                    class="flex h-5 w-5 items-center justify-center border border-gray-400">
                                                    @if ($session !== null && !$session['isPresence'])
                                                        <span class="">
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

        @auth('admin')
            <x-primary-button class="my-4" onclick="ExportToExcel('xlsx', '#presence_table')">
                Export presence to excel
            </x-primary-button>
        @endauth

    </div>

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script>
        function isDisabled(date) {
            const currentDate = new Date().toISOString().split('T')[0];
            return false // (date !== currentDate);
        }



        function ExportToExcel(type, selector, fn, dl) {
            const elt = document.querySelector(selector);
            const tempTable = document.createElement('table');
            // Input string containing the HTML table
            const htmlString = elt.innerHTML
            // Regular expression pattern to match the SVG elements with the specified class
            const regex = /<svg\s+class="svg-inline--fa fa-xmark"[^>]*>.*?<\/svg>/g;
            // Replace the matched SVG elements with an X mark
            let replacedString = htmlString.replace(regex, '<span>X</span>');
            // Remove HTML comments
            const commentRegex = /<!--[\s\S]*?-->/g;
            replacedString = replacedString.replace(commentRegex, '');
            tempTable.innerHTML = replacedString;

            const wb = XLSX.utils.table_to_book(tempTable, {
                sheet: "sheet1"
            });

            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64',
                }) :
                XLSX.writeFile(wb, fn || (
                    "Presence_de_classe_{{ $classe->id }}__Semain_du_{{ $week['start'] }}_au_{{ $week['end'] }}__." +
                    (type || 'xlsx')));
        }
    </script>
</x-app-layout>
