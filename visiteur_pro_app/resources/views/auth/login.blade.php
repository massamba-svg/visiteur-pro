<x-guest-layout>
    <div class="layout-content-container flex flex-col w-full bg-white shadow-sm rounded-xl p-6 sm:p-8">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="w-24 h-8 bg-center bg-no-repeat bg-contain" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA3IyxQ10_JjgZ0nEwh0FcqRx5275FJJJp6OsXEdcVzAFyt9Dw4Yct_hWTAH4-etsjWDyUfWoAcrcPz3wuj1E6hD5dwO3kOF27ISJuUZH0XOkGXpdjFbkhlHSkVMC3hanGk5SpGgtTZehxICc23eCtq7qMUMTMqknGoccMmqc4XnFTf_VbA1R7Y8ODIuk80-xWKAq7Ijb-Fbzj9JGf3wB8Nnegm91satIfbnBXJCQc7sSWq7qZxDR7i8OvUm_nXKPkuRpDbWjQ5qw');"></div>
        </div>

        <!-- Title -->
        <h1 class="text-gray-900 tracking-tight text-3xl font-bold leading-tight px-4 text-center pb-3 pt-6">
            Connexion à votre espace
        </h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 mt-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4 px-4 py-3">
            @csrf

            <!-- Email Address -->
            <label class="flex flex-col w-full">
                <p class="text-gray-900 text-base font-medium leading-normal pb-2">
                    Nom d'utilisateur ou email
                </p>
                <input id="email" 
                       class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 focus:outline-0 focus:ring-2 focus:ring-blue-500/50 border border-gray-300 bg-gray-50 focus:border-blue-600 h-14 placeholder:text-gray-500 p-[15px] text-base font-normal leading-normal" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="Entrez votre nom d'utilisateur ou email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </label>

            <!-- Password -->
            <label class="flex flex-col w-full">
                <p class="text-gray-900 text-base font-medium leading-normal pb-2">
                    Mot de passe
                </p>
                <x-password-input id="password"
                                 name="password"
                                 required
                                 autocomplete="current-password"
                                 placeholder="Entrez votre mot de passe" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </label>

            <!-- Login Button -->
            <div class="flex px-4 py-3 mt-2">
                <button type="submit" class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 flex-1 bg-blue-600 hover:bg-blue-700 text-white text-base font-bold leading-normal tracking-[0.015em] transition-colors">
                    <span class="truncate">Se connecter</span>
                </button>
            </div>

            <!-- Links -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2 px-4 pt-4 text-sm text-center">
                @if (Route::has('password.request'))
                    <a class="text-blue-600 hover:underline" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
                @if (Route::has('register'))
                    <a class="text-blue-600 hover:underline" href="{{ route('register') }}">
                        Créer un compte
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>

