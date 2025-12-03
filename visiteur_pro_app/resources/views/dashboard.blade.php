<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Tableau de Bord</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
</head>

<body class="font-display bg-background-light dark:bg-background-dark">
    <div class="relative flex min-h-screen w-full">
        <!-- SideNavBar -->
        <aside
            class="flex flex-col w-64 p-4 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark text-gray-800 dark:text-gray-200 shrink-0">
            <div class="flex items-center gap-3 mb-8">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                    data-alt="Kara SAMB avatar"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBgavw87N5b5LhrSUYDy9ZaUIwrypQG-TlBTEtUv1Vqztmk0Lx1aQry5GmQcRCgKGVIYQxo6zNEfUF_NRPGG38ot5khYQNRj9-FhP41eFi2LjAQy-TBLGWmF0HpfS-HWz_4FFUwQXvuuscEBl5Lus6_2ETKsity1SgmIJ5IYe0EFwMZWUilPTNPeCBAY-1MVW8qOYUcW9AjbmEwzngC0u1CLfu0TykrHorXbuaAjBJgBJ-bxccwDYOmRiMEWcO5xSuxJSNCl2lDBA");'>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-base font-bold text-gray-900 dark:text-white">Kara SAMB</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Gestionnaire</p>
                </div>
            </div>
            <nav class="flex flex-col gap-2 flex-grow">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined fill">dashboard</span>
                    <p class="text-sm font-medium">Tableau de Bord</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
                    href="{{ route('visits.history') }}">
                    <span class="material-symbols-outlined">calendar_month</span>
                    <p class="text-sm font-medium">Visites</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
                    href="{{ route('clients.index') }}">
                    <span class="material-symbols-outlined">groups</span>
                    <p class="text-sm font-medium">Clients</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
                    href="{{ route('visits.history') }}">
                    <span class="material-symbols-outlined">bar_chart</span>
                    <p class="text-sm font-medium">Rapports</p>
                </a>
            </nav>
            <div class="flex flex-col gap-4">
                <button
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90">
                    <span class="truncate">Ajouter une visite</span>
                </button>
                <div class="flex flex-col gap-1">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
                        href="#">
                        <span class="material-symbols-outlined">settings</span>
                        <p class="text-sm font-medium">Paramètres</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
                        href="#">
                        <span class="material-symbols-outlined">help</span>
                        <p class="text-sm font-medium">Aide</p>
                    </a>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-6 lg:p-8">
            <div class="w-full max-w-7xl mx-auto">
                <!-- PageHeading -->
                <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900 dark:text-white">
                            Tableau de Bord</h1>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Aperçu des visites clients et
                            des tendances.</p>
                    </div>
                    <!-- Chips -->
                    <div class="flex gap-2">
                        <button
                            class="flex h-9 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-white/10 pl-4 pr-3 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-white/20">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Aujourd'hui</p>
                            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400"
                                style="font-size: 20px;">expand_more</span>
                        </button>
                        <button
                            class="flex h-9 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-white/10 pl-4 pr-3 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-white/20">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Cette semaine</p>
                            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400"
                                style="font-size: 20px;">expand_more</span>
                        </button>
                    </div>
                </div>
                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                        <p class="text-base font-medium text-gray-600 dark:text-gray-400">Visiteurs Actuels</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">12</p>
                        <p class="text-base font-medium text-green-600 dark:text-green-500">+5%</p>
                    </div>
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                        <p class="text-base font-medium text-gray-600 dark:text-gray-400">Visites du Jour</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">84</p>
                        <p class="text-base font-medium text-red-600 dark:text-red-500">-2%</p>
                    </div>
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                        <p class="text-base font-medium text-gray-600 dark:text-gray-400">Visites de la Semaine</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">452</p>
                        <p class="text-base font-medium text-green-600 dark:text-green-500">+10%</p>
                    </div>
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                        <p class="text-base font-medium text-gray-600 dark:text-gray-400">Taux de Conversion</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">15%</p>
                        <p class="text-base font-medium text-green-600 dark:text-green-500">+1.2%</p>
                    </div>
                </div>
                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div
                        class="lg:col-span-2 flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 p-6 bg-white dark:bg-background-dark">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-base font-bold text-gray-900 dark:text-white">Tendance des Visites
                                    Mensuelles</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">3 derniers mois</p>
                            </div>
                            <div class="flex gap-1 items-center">
                                <p class="text-4xl font-bold text-gray-900 dark:text-white">1,890</p>
                                <p class="text-base font-medium text-green-600 dark:text-green-500 mt-2">+8%</p>
                            </div>
                        </div>
                        <div class="flex min-h-[250px] flex-1 flex-col gap-8 py-4">
                            <svg class="h-full" fill="none" preserveaspectratio="none" viewbox="-3 0 478 150"
                                width="100%" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <lineargradient gradientunits="userSpaceOnUse" id="chartGradient" x1="236" x2="236"
                                        y1="1" y2="149">
                                        <stop stop-color="#135bec" stop-opacity="0.2"></stop>
                                        <stop offset="1" stop-color="#135bec" stop-opacity="0"></stop>
                                    </lineargradient>
                                </defs>
                                <path
                                    d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25V149H0V109Z"
                                    fill="url(#chartGradient)"></path>
                                <path
                                    d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25"
                                    stroke="#135bec" stroke-linecap="round" stroke-width="3"></path>
                            </svg>
                            <div class="flex justify-around text-gray-500 dark:text-gray-400 text-sm font-bold">
                                <p>Jan</p>
                                <p>Fév</p>
                                <p>Mar</p>
                                <p>Avr</p>
                                <p>Mai</p>
                                <p>Juin</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="lg:col-span-1 flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 p-6 bg-white dark:bg-background-dark">
                        <p class="text-base font-bold text-gray-900 dark:text-white">Visites par Semaine</p>
                        <div
                            class="grid min-h-[250px] grid-flow-col gap-4 grid-rows-[1fr_auto] items-end justify-items-center px-3 pt-6">
                            <div class="bg-primary/20 dark:bg-primary/40 rounded-t w-full" style="height: 80%;"></div>
                            <div class="bg-primary/20 dark:bg-primary/40 rounded-t w-full" style="height: 40%;"></div>
                            <div class="bg-primary/20 dark:bg-primary/40 rounded-t w-full" style="height: 50%;"></div>
                            <div class="bg-primary/20 dark:bg-primary/40 rounded-t w-full" style="height: 20%;"></div>
                            <div class="bg-primary/20 dark:bg-primary/40 rounded-t w-full" style="height: 60%;"></div>
                            <div class="bg-primary/20 dark:bg-primary/40 rounded-t w-full" style="height: 90%;"></div>
                            <div class="bg-primary rounded-t w-full" style="height: 100%;"></div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-bold">Lun</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-bold">Mar</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-bold">Mer</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-bold">Jeu</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-bold">Ven</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-bold">Sam</p>
                            <p class="text-gray-900 dark:text-white text-sm font-bold">Dim</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>