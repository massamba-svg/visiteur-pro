<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Enregistrement des Visites</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @vite(['resources/css/visits-register.css', 'resources/js/visits-register.js'])
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-[#0d121b] dark:text-white/90">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
    <header class="sticky top-0 z-10 flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 px-4 sm:px-6 md:px-10 py-3 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm">
        <div class="flex items-center gap-4 text-[#0d121b] dark:text-white">
            <div class="size-6 text-primary">
                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
                </svg>
            </div>
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Gestion des Visites - Kara SAMB</h2>
        </div>
        <div class="flex flex-1 justify-end gap-3">
            <button class="flex items-center justify-center rounded-full h-10 w-10 bg-slate-200/80 dark:bg-slate-800/80 text-[#0d121b] dark:text-white text-sm font-bold">
                <span class="material-symbols-outlined text-xl">notifications</span>
            </button>
            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="User profile picture" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAupna637UbWQyASbkO37qPkT7VX5I5msGIDV1hIxxmOdiFWAKTLU7buPEwGzt9u9UAO7KM1ayCA6xU9yTsphm6ma7tit90aexrTg1Zmkuio7iuiqa5JmPdp6_ImDPVYoOYv-IKq7gTVLG264EXW0NOq4FYGKiwf2LEq_fORMFUUwMrOaoq7FJMLF3Pq6NWcPOzP5H_kiD-EpIvpFHqZx768QtSitgeXXm7ZWh8DCZb-GZLpseS6OXNNM9I_wstBWNQNpHgSkmxMg");'></div>
        </div>
    </header>
    <nav class="hidden md:flex items-center gap-4 ml-8">
        <a class="text-sm font-medium hover:underline" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="text-sm font-medium hover:underline" href="{{ route('clients.index') }}">Clients</a>
        <a class="text-sm font-medium hover:underline" href="{{ route('visits.history') }}">Historique</a>
    </nav>
    <main class="layout-container flex h-full grow flex-col">
        <div class="px-4 sm:px-6 md:px-10 flex flex-1 justify-center py-8">
            <div class="layout-content-container flex flex-col w-full">
                <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                    <p class="text-4xl font-black leading-tight tracking-[-0.033em] min-w-72 dark:text:white">Enregistrement des Visites</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Form -->
                    <div class="lg:col-span-1 bg-white dark:bg-slate-900/70 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
                        <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em] mb-6 dark:text-white">Ajouter une nouvelle visite</h2>
                        <form class="flex flex-col gap-5">
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text-white/90">Nom du Visiteur</p>
                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text:white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-base font-normal leading-normal" placeholder="Entrez le nom complet" value="" />
                            </label>
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text:white/90">Entreprise</p>
                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text:white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-base font-normal leading-normal" placeholder="Entrez le nom de l'entreprise" value="" />
                            </label>
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text:white/90">Personne Rencontrée</p>
                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text:white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-base font-normal leading-normal" placeholder="Qui le visiteur vient-il voir ?" value="" />
                            </label>
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text:white/90">Motif de la Visite</p>
                                <select class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text:white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-12 p-3 text-base font-normal leading-normal">
                                    <option>Réunion</option>
                                    <option>Livraison</option>
                                    <option>Entretien</option>
                                    <option>Autre</option>
                                </select>
                            </label>
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text:white/90">Heure d'Arrivée</p>
                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] dark:text:white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-base font-normal leading-normal" type="datetime-local" value="2023-10-27T10:30" />
                            </label>
                            <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary text:white gap-2 text-base font-bold leading-normal tracking-[0.015em] mt-4 hover:bg-primary/90 transition-colors">
                                <span class="material-symbols-outlined">login</span>
                                Enregistrer l'Arrivée
                            </button>
                        </form>
                    </div>
                    <!-- Right Column: Table -->
                    <div class="lg:col-span-2 bg-white dark:bg-slate-900/70 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                            <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em] dark:text:white">Historique des Visites Récentes</h2>
                            <div class="relative w-full sm:w-64">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                                <input class="form-input w-full rounded-lg border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-10 pl-10 placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-primary/50 focus:outline-none" placeholder="Rechercher un visiteur..." type="text" />
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400">
                                    <tr>
                                        <th class="p-3 font-medium">Nom du Visiteur</th>
                                        <th class="p-3 font-medium">Personne Rencontrée</th>
                                        <th class="p-3 font-medium">Arrivée</th>
                                        <th class="p-3 font-medium">Départ</th>
                                        <th class="p-3 font-medium">Statut</th>
                                        <th class="p-3 font-medium">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="dark:text:white/90">
                                    <tr class="border-b border-slate-200 dark:border-slate-800">
                                        <td class="p-3 font-medium">Amina Diop</td>
                                        <td class="p-3">Moussa Fall</td>
                                        <td class="p-3">10:30</td>
                                        <td class="p-3">-</td>
                                        <td class="p-3">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 dark:bg-green-900/50 px-2.5 py-1 text-xs font-medium text-green-800 dark:text-green-300">
                                                <span class="size-2 rounded-full bg-green-500"></span>
                                                En cours
                                            </span>
                                        </td>
                                        <td class="p-3">
                                            <button class="flex items-center justify-center text-sm font-medium text-primary hover:text-primary/80">Enregistrer le Départ</button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-slate-200 dark:border-slate-800">
                                        <td class="p-3 font-medium">Babacar Ndiaye</td>
                                        <td class="p-3">Fatou Sene</td>
                                        <td class="p-3">09:45</td>
                                        <td class="p-3">-</td>
                                        <td class="p-3">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 dark:bg-green-900/50 px-2.5 py-1 text-xs font-medium text-green-800 dark:text-green-300">
                                                <span class="size-2 rounded-full bg-green-500"></span>
                                                En cours
                                            </span>
                                        </td>
                                        <td class="p-3">
                                            <button class="flex items-center justify-center text-sm font-medium text-primary hover:text-primary/80">Enregistrer le Départ</button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-slate-200 dark:border-slate-800">
                                        <td class="p-3 font-medium">Issa Gueye</td>
                                        <td class="p-3">Ousmane Diallo</td>
                                        <td class="p-3">09:15</td>
                                        <td class="p-3">10:05</td>
                                        <td class="p-3">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 dark:bg-slate-800 px-2.5 py-1 text-xs font-medium text-slate-800 dark:text-slate-300">
                                                <span class="size-2 rounded-full bg-slate-500"></span>
                                                Terminée
                                            </span>
                                        </td>
                                        <td class="p-3"></td>
                                    </tr>
                                    <tr class="border-b border-slate-200 dark:border-slate-800">
                                        <td class="p-3 font-medium">Mariama Ba</td>
                                        <td class="p-3">Alioune Sow</td>
                                        <td class="p-3">08:50</td>
                                        <td class="p-3">09:30</td>
                                        <td class="p-3">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 dark:bg-slate-800 px-2.5 py-1 text-xs font-medium text-slate-800 dark:text-slate-300">
                                                <span class="size-2 rounded-full bg-slate-500"></span>
                                                Terminée
                                            </span>
                                        </td>
                                        <td class="p-3"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /Right Column -->
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>