<footer class="border-t border-gray-100 bg-white dark:border-gray-700/70 dark:bg-gray-800">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 md:px-8 lg:py-8">
        <div class="md:flex md:items-start md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="/" class="flex items-center">
                    <x-application-logo class="dark:text-primary w-24 fill-current text-gray-800" />
                </a>
            </div>
            <div class="">
                <div>
                    <h2 class="mb-5 text-sm font-semibold uppercase text-gray-900 dark:text-white">Les Développeurs</h2>
                    <ul
                        class="gird-col-1 grid gap-3 font-medium capitalize text-gray-600 dark:text-gray-400 md:grid-cols-2">
                        @php
                            $devs = [
                                [
                                    'full_name' => 'Nachat Ayoub',
                                    'github_link' => 'https://github.com/nachat-ayoub',
                                ],
                                [
                                    'full_name' => 'Abodo Hatim',
                                    'github_link' => 'https://github.com/Abodo-Hatim',
                                ],
                                [
                                    'full_name' => 'Zaaraoui Mustapha',
                                    'github_link' => 'https://github.com/mustapha-zaaraoui',
                                ],
                                [
                                    'full_name' => 'Ouakili Badreddine',
                                    'github_link' => 'https://github.com/Badreddine2002',
                                ],
                            ];
                        @endphp

                        @foreach ($devs as $dev)
                            <li>
                                <a ùtarget="_blank" href="{{ $dev['github_link'] }}"
                                    class="hover:underline">{{ $dev['full_name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 dark:border-gray-700 sm:mx-auto lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 dark:text-gray-400 sm:text-center">© <span
                    x-text="new Date().toISOString().split('T')[0]?.split('-')?.at(0)"></span> · All Rights Reserved.
            </span>
            <div class="mt-4 flex space-x-6 sm:mt-0 sm:justify-center">
                <a href="https://github.com/nachat-ayoub/absence-management"
                    class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">GitHub Repositories</span>
                </a>

            </div>
        </div>
    </div>
</footer>
