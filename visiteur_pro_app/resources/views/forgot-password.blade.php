<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Mot de Passe Oublié</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @vite(['resources/css/forgot-password.css', 'resources/js/forgot-password.js'])
</head>
<body class="font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <div class="flex flex-1 items-center justify-center p-4 sm:p-6 lg:p-8">
            <div class="flex w-full max-w-md flex-col items-center justify-center gap-6 rounded-xl border border-slate-200/50 bg-white dark:border-slate-800/50 dark:bg-background-dark p-6 shadow-sm sm:p-8">
                <!-- Logo -->
                <div class="flex w-full justify-center">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-3xl">
                            waves
                        </span>
                        <span class="text-2xl font-bold tracking-tighter text-[#0d121b] dark:text-white">Kara SAMB</span>
                    </div>
                </div>
                <!-- Headline and Body Text -->
                <div class="flex w-full flex-col items-center gap-2 text-center">
                    <h1 class="text-[#0d121b] dark:text-white tracking-tight text-2xl sm:text-3xl font-bold leading-tight">Mot de passe oublié ?</h1>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base font-normal leading-normal">Entrez votre email pour recevoir les instructions de réinitialisation.</p>
                </div>
                <!-- Form Fields -->
                <div class="flex w-full flex-col gap-4">
                    <div class="flex w-full flex-col items-start gap-1.5">
                        <label class="text-[#0d121b] dark:text-white text-sm font-medium leading-normal" for="email">Adresse e-mail</label>
                        <div class="relative w-full">
                            <span class="material-symbols-outlined pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 dark:text-slate-500">
                                mail
                            </span>
                            <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 focus:border-primary dark:focus:border-primary h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 pl-11 pr-4 py-3 text-base font-normal leading-normal" id="email" placeholder="votre.email@exemple.com" type="email" value="" />
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="flex w-full flex-col items-stretch pt-2">
                    <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-wide hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 dark:focus:ring-offset-background-dark">
                        <span class="truncate">Envoyer le lien de réinitialisation</span>
                    </button>
                </div>
                <!-- Secondary Link to Login -->
                <div class="flex w-full flex-col items-stretch pt-2">
                    <a class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 text-slate-700 dark:text-slate-300 text-base font-medium leading-normal tracking-wide hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 dark:focus:ring-offset-background-dark" href="{{ route('login') }}">
                        <span aria-hidden="true" class="material-symbols-outlined mr-2 text-xl">
                            arrow_back
                        </span>
                        <span class="truncate">Retour à la connexion</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>