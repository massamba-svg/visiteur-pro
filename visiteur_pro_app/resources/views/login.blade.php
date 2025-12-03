<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Écran de Connexion</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @vite(['resources/css/login.css', 'resources/js/login.js'])
</head>
<body class="font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col items-center justify-center bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden p-4 sm:p-6" style='font-family: Inter, "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col w-full max-w-md">
        <div class="flex flex-col items-center justify-center flex-1">
            <div class="layout-content-container flex flex-col w-full bg-white dark:bg-background-dark dark:border dark:border-white/10 shadow-sm rounded-xl p-6 sm:p-8">
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-8 bg-center bg-no-repeat bg-contain" data-alt="Kara SAMB company logo" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA3IyxQ10_JjgZ0nEwh0FcqRx5275FJJJp6OsXEdcVzAFyt9Dw4Yct_hWTAH4-etsjWDyUfWoAcrcPz3wuj1E6hD5dwO3kOF27ISJuUZH0XOkGXpdjFbkhlHSkVMC3hanGk5SpGgtTZehxICc23eCtq7qMUMTMqknGoccMmqc4XnFTf_VbA1R7Y8ODIuk80-xWKAq7Ijb-Fbzj9JGf3wB8Nnegm91satIfbnBXJCQc7sSWq7qZxDR7i8OvUm_nXKPkuRpDbWjQ5qw");'></div>
                </div>
                <h1 class="text-[#0d121b] dark:text-white tracking-light text-[32px] font-bold leading-tight px-4 text-center pb-3 pt-6">Connexion à votre espace</h1>
                <div class="flex flex-col gap-4 px-4 py-3">
                    <label class="flex flex-col w-full">
                        <p class="text-[#0d121b] dark:text-white/80 text-base font-medium leading-normal pb-2">Nom d'utilisateur ou email</p>
                        <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#cfd7e7] dark:border-white/20 bg-[#f8f9fc] dark:bg-white/5 focus:border-primary h-14 placeholder:text-[#4c669a] dark:placeholder:text-white/40 p-[15px] text-base font-normal leading-normal" placeholder="Entrez votre nom d'utilisateur ou email" value="" />
                    </label>
                    <label class="flex flex-col w-full">
                        <p class="text-[#0d121b] dark:text-white/80 text-base font-medium leading-normal pb-2">Mot de passe</p>
                        <div class="flex w-full flex-1 items-stretch">
                            <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg text-[#0d121b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#cfd7e7] dark:border-white/20 bg-[#f8f9fc] dark:bg-white/5 focus:border-primary h-14 placeholder:text-[#4c669a] dark:placeholder:text-white/40 p-[15px] border-r-0 text-base font-normal leading-normal" placeholder="Entrez votre mot de passe" type="password" value="" />
                            <div class="text-[#4c669a] dark:text-white/60 flex border border-[#cfd7e7] dark:border-white/20 bg-[#f8f9fc] dark:bg-white/5 items-center justify-center pr-[15px] rounded-r-lg border-l-0" data-icon="Eye" data-size="24px" data-weight="regular">
                                <span class="material-symbols-outlined cursor-pointer">visibility</span>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="flex px-4 py-3 mt-2">
                    <button class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 flex-1 bg-primary hover:bg-primary/90 text-[#f8f9fc] dark:text-white text-base font-bold leading-normal tracking-[0.015em] transition-colors">
                        <span class="truncate">Se connecter</span>
                    </button>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 px-4 pt-4 text-sm text-center">
                    <a class="text-primary hover:underline dark:text-primary/90" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    <a class="text-primary hover:underline dark:text-primary/90" href="{{ route('login') }}">Créer un compte</a> <!-- ou une autre route si tu crées une page inscription -->
                </div>
            </div>
            <div class="text-center mt-6">
                <p class="text-xs text-gray-500 dark:text-gray-400">© 2024 Kara SAMB. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>