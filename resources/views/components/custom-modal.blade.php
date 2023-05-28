@props(['name', 'maxWidth' => '2xl'])

@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div x-cloak x-show="{{ $name }}" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">
    <div class="flex min-h-screen items-end justify-center px-4 text-center sm:block sm:p-0 md:items-center">
        <div x-cloak @click="{{ $name }} = false" x-show="{{ $name }}"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-40 backdrop-blur-[1px] transition-opacity" aria-hidden="true">
        </div>

        <div x-cloak x-show="{{ $name }}" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="{{ $maxWidth }} my-20 inline-block w-full transform overflow-hidden rounded-lg bg-white p-8 text-left shadow-xl transition-all dark:bg-gray-800 dark:text-white">
            <div class="{{ isset($title) ? 'justify-between' : 'justify-end' }} flex items-center space-x-4">
                <!-- Modal Heading -->
                @if (isset($title))
                    <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">{{ $title }}</h3>
                @endif

                <button @click="{{ $name }} = false"
                    class="text-gray-600 hover:text-gray-700 focus:outline-none dark:text-gray-500 dark:hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class=""> {{ $slot }}</div>

        </div>
    </div>
</div>
