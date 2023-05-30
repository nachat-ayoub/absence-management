<section id="update-info">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informations sur le profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mettez à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>

        @if (session('status') === 'profile-updated')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                class="my-2 flex items-center rounded-lg border border-green-300 bg-green-50 p-4 text-base text-green-800 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ __('Enregistré.') }}
                </div>
            </div>
        @endif
    </header>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for='nom' :value="__('Nom')" />
            <x-text-input id='nom' name='nom' type="text" class="mt-1 block w-full" :value="old('nom', auth('admin')->user()->nom)"
                required autofocus autocomplete='nom' />
            <x-input-error class="mt-2" :messages="$errors->get('nom')" />
        </div>
        <div>
            <x-input-label for='prenom' :value="__('Prenom')" />
            <x-text-input id='prenom' name='prenom' type="text" class="mt-1 block w-full" :value="old('prenom', auth('admin')->user()->prenom)"
                required autofocus autocomplete='prenom' />
            <x-input-error class="mt-2" :messages="$errors->get('prenom')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', auth('admin')->user()->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>
        </div>
    </form>
</section>
