@props(['title'])

<div x-data="{ reportsOpen: false }">
    <div @click="reportsOpen = !reportsOpen"
        class='flex w-full items-center justify-between overflow-hidden border-l-4 border-transparent py-2 pl-3 pr-4 text-left text-base font-medium text-gray-600 transition duration-150 ease-in-out hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 focus:border-gray-300 focus:bg-gray-50 focus:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-200 dark:focus:border-gray-600 dark:focus:bg-gray-700 dark:focus:text-gray-200'>
        <div class='mr-3'>
            {{ $title }}
        </div>

        <div class='w-10 transform px-2 transition duration-300 ease-in-out'
            :class="{ 'rotate-90': reportsOpen, ' -translate-y-0.0': !reportsOpen }">
            <i class="fa-solid fa-chevron-down"></i>
        </div>
    </div>

    <div class="flex w-full transform border-b border-gray-200 pl-4 pr-2 transition duration-300 ease-in-out dark:border-gray-600"
        x-cloak x-show="reportsOpen" x-collapse x-collapse.duration.500ms>
        {{ $slot }}
    </div>
</div>
