<x-guest-layout>
    <div class="layout-content-container flex flex-col w-full bg-white shadow-sm rounded-xl p-6 sm:p-8">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-blue-600 text-3xl">waves</span>
                <span class="text-2xl font-bold tracking-tighter text-gray-900">Kara SAMB</span>
            </div>
        </div>

        <!-- Title and Description -->
        <div class="flex flex-col items-center gap-2 text-center mb-6">
            <h1 class="text-gray-900 tracking-tight text-2xl sm:text-3xl font-bold leading-tight">
                Mot de passe oublié ?
            </h1>
            <p class="text-gray-600 text-sm sm:text-base font-normal leading-normal">
                Entrez votre email pour recevoir les instructions de réinitialisation.
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4 w-full">
            @csrf

            <!-- Email Address -->
            <div class="flex flex-col items-start gap-1.5 w-full">
                <label class="text-gray-900 text-sm font-medium leading-normal" for="email">
                    Adresse e-mail
                </label>
                <div class="relative w-full">
                    <span class="material-symbols-outlined pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                        mail
                    </span>
                    <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 focus:outline-0 focus:ring-2 focus:ring-blue-500/50 border border-gray-300 bg-gray-50 focus:border-blue-600 h-12 placeholder:text-gray-400 pl-11 pr-4 py-3 text-base font-normal leading-normal" 
                           id="email" 
                           name="email"
                           type="email"
                           :value="old('email')"
                           placeholder="votre.email@exemple.com" 
                           required 
                           autofocus />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Submit Button -->
            <div class="flex w-full flex-col items-stretch pt-2">
                <button type="submit" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-blue-600 text-white text-base font-bold leading-normal tracking-wide hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:ring-offset-2 transition-colors">
                    <span class="truncate">Envoyer le lien de réinitialisation</span>
                </button>
            </div>

            <!-- Back to Login Link -->
            <div class="flex w-full flex-col items-stretch pt-2">
                <a href="{{ route('login') }}" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 text-gray-700 text-base font-medium leading-normal tracking-wide hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:ring-offset-2 transition-colors">
                    <span class="material-symbols-outlined mr-2 text-xl">arrow_back</span>
                    <span class="truncate">Retour à la connexion</span>
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
