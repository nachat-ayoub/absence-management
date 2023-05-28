<!-- component -->
<!-- This is an example component -->

<div class="flex w-full">

    <select class="hidden" id="select">

        {{ $slot }}

    </select>

    <div x-data="dropdown()" x-init="loadOptions()" class="-mt-1 flex w-full rounded-lg">
        <form>
            <input name="classes" type="hidden" x-bind:value="selectedValues()" id="classes">
            <div class="relative inline-block w-full">
                <div class="relative flex flex-col items-center">
                    <div x-on:click="open" class="w-full">
                        <div class="my-2 flex rounded border border-gray-300 bg-white p-1 shadow-sm dark:border-gray-700 dark:bg-gray-900"
                            x-bind:class="{ 'p-0.5 ring-1 border-indigo-500 dark:border-indigo-600 ring-indigo-500 dark:ring-indigo-600': isOpen() }">

                            <div class="flex flex-auto flex-wrap">
                                <template x-for="(option,index) in selected" :key="options[option].value">
                                    <div
                                        class="dark:text-primary dark:border-primary m-1 flex items-center justify-center rounded border border-gray-700 bg-white px-2 font-bold text-gray-700 dark:bg-gray-800">
                                        <div class="x-model= max-w-full flex-initial text-xs leading-none"
                                            options[option]" x-text="options[option].text"></div>

                                        <div class="flex flex-auto flex-row-reverse">
                                            <div x-on:click="remove(index,option)">

                                                <span class="ml-2">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <div x-show="selected.length == 0" class="flex-1">
                                    <input placeholder="Selectioner les classes"
                                        class="h-full w-full appearance-none bg-transparent p-1 px-2 text-gray-800 outline-none placeholder:text-gray-700 dark:text-gray-200 dark:placeholder:text-gray-400"
                                        x-bind:value="selectedValues()">
                                </div>
                            </div>
                            <div
                                class="flex w-8 items-center border-l border-gray-300 py-1 pl-2 pr-1 text-gray-300 dark:border-gray-700">

                                <button type="button" x-show="isOpen() === true" x-on:click="open"
                                    class="h-6 w-6 cursor-pointer text-gray-600 outline-none focus:outline-none">

                                    <i class="fa-solid fa-chevron-down"></i>

                                </button>
                                <button type="button" x-show="isOpen() === false" @click="close"
                                    class="h-6 w-6 cursor-pointer text-gray-600 outline-none focus:outline-none">

                                    <i class="fa-solid fa-chevron-up"></i>

                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4">
                        <div x-show.transition.origin.top="isOpen()"
                            class="top-100 lef-0 absolute z-40 max-h-64 w-fit max-w-full overflow-y-auto rounded border border-gray-300 bg-white shadow"
                            x-on:click.away="close">
                            <div class="flex w-full flex-col">
                                <template x-for="(option,index) in options" :key="option">
                                    <div>
                                        <div class="dark:hover:bg-primary/40 w-full cursor-pointer rounded-t border-b border-gray-100 pr-8 hover:bg-teal-100"
                                            @click="select(index,$event)">
                                            <div x-bind:class="option.selected ? 'border-teal-600 dark:border-primary' :
                                                'border-transparent'"
                                                class="relative flex w-full items-center border-l-2 p-2 pl-2">
                                                <div class="flex w-full items-center">
                                                    <div class="opt mx-2 leading-6" x-model="option"
                                                        x-text="option.text"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- on tailwind components page will no work  -->

        </form>
    </div>

    <script>
        function dropdown() {
            return {
                options: [],
                selected: [],
                show: false,
                open() {
                    this.show = true
                },
                close() {
                    this.show = false
                },
                isOpen() {
                    return this.show === true
                },
                select(index, event) {
                    if (!this.options[index].selected) {

                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);

                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
                },
                remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);
                },
                loadOptions() {
                    const options = document.getElementById('select').options;
                    for (let i = 0; i < options.length; i++) {
                        const option = {
                            value: options[i].value,
                            text: options[i].innerText.trim(),
                            selected: (options[i].getAttribute('selected') === null) ? false : (options[i]
                                .getAttribute('selected') === "true")
                        }

                        this.options.push(option);

                        if (option.selected) {
                            this.selected.push(i);
                        }
                    }
                },
                selectedValues() {
                    return this.selected.map((option) => {
                        return this.options[option].value;
                    })
                }
            }
        }
    </script>
</div>
