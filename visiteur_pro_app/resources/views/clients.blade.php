<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Gestion des Clients</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    @vite(['resources/css/clients.css', 'resources/js/clients.js'])
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
<div class="flex h-screen w-full">
    <!-- SideNavBar -->
    <aside class="flex flex-col w-64 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark">
        <div class="flex h-full min-h-0 flex-col justify-between p-4">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="User avatar for Kara SAMB" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAuzkd-DLOCj6T6EfMTd56b70R7eo5vl3MgpNBMv1Px3sQadDxhgnpcK9t4Clvqk2bImJGZQzhX-45rH_5M2WUv766eNq-3g_VNdNQn3ktIGKRDGc8immxUyLzYAJw4JdcdcwpqbNdpKifFfZ5OUK3e4psuci-OafzZTIagAIoD_65_deDRxbujnti3S0MFbCcLygaiYn97Wzwun_M9SBRknVghPvxTkHF2AMWEc5sglq7s0-zenH1Rp2AP5LfUfnHMmUK0NvCNzA");'></div>
                    <div class="flex flex-col">
                        <h1 class="text-gray-900 dark:text-white text-base font-medium leading-normal">Kara SAMB</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal">Manager</p>
                    </div>
                </div>
                <nav class="flex flex-col gap-2 mt-4">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="{{ route('dashboard') }}">
                        <span class="material-symbols-outlined text-gray-900 dark:text-white">dashboard</span>
                        <p class="text-sm font-medium">Tableau de bord</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 dark:bg-primary/20" href="{{ route('clients.index') }}">
                        <span class="material-symbols-outlined font-bold text-primary">group</span>
                        <p class="text-primary text-sm font-bold">Clients</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="{{ route('visits.register') }}">
                        <span class="material-symbols-outlined text-gray-900 dark:text-white">calendar_today</span>
                        <p class="text-sm font-medium">Visites</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
                        <span class="material-symbols-outlined text-gray-900 dark:text-white">bar_chart</span>
                        <p class="text-sm font-medium">Rapports</p>
                    </a>
                </nav>
            </div>
            <div class="flex flex-col gap-1">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
                    <span class="material-symbols-outlined text-gray-900 dark:text-white">settings</span>
                    <p class="text-sm font-medium">Paramètres</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
                    <span class="material-symbols-outlined text-gray-900 dark:text-white">help</span>
                    <p class="text-sm font-medium">Aide</p>
                </a>
            </div>
        </div>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <div class="p-8">
            <!-- Page Heading -->
            <header class="flex flex-wrap justify-between gap-4 items-center mb-8">
                <div class="flex min-w-72 flex-col">
                    <h1 class="text-gray-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Gestion des Clients</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal mt-1">Ajouter, modifier, et consulter les clients et leurs visites.</p>
                </div>
            </header>
            <div class="grid grid-cols-12 gap-6">
                <!-- Left Column: Client List -->
                <div class="col-span-4">
                    <div class="bg-white dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-800 h-full">
                        <div class="p-4 border-b border-gray-200 dark:border-gray-800">
                            <h2 class="text-gray-900 dark:text-white text-lg font-bold">Liste des Clients</h2>
                        </div>
                        <div class="p-4">
                            <!-- SearchBar -->
                            <label class="flex flex-col min-w-40 h-11 w-full">
                                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                    <div class="text-gray-500 dark:text-gray-400 flex bg-gray-100 dark:bg-gray-800 items-center justify-center pl-3.5 rounded-l-lg border-y border-l border-gray-200 dark:border-gray-700">
                                        <span class="material-symbols-outlined">search</span>
                                    </div>
                                    <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-y border-r border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 focus:border-primary/50 h-full placeholder:text-gray-500 dark:placeholder:text-gray-400 px-3 pl-2 text-sm font-normal leading-normal" placeholder="Rechercher par nom, entreprise..." value="" />
                                </div>
                            </label>
                            <!-- SingleButton -->
                            <button class="flex w-full mt-4 min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em]">
                                <span class="material-symbols-outlined text-base">add</span>
                                <span class="truncate">Ajouter un Client</span>
                            </button>
                        </div>
                        <!-- Client List -->
                        <div class="px-2 pb-2 flex flex-col gap-1 max-h-[calc(100vh-320px)] overflow-y-auto">
                            <div class="p-3 rounded-lg cursor-pointer bg-primary/10 dark:bg-primary/20">
                                <p class="font-semibold text-sm text-primary">Alexandre Martin</p>
                                <p class="text-xs text-primary/80">Innovatech Solutions</p>
                            </div>
                            <div class="p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800">
                                <p class="font-medium text-sm text-gray-800 dark:text-gray-200">Béatrice Dubois</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Quantum Leap Inc.</p>
                            </div>
                            <div class="p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800">
                                <p class="font-medium text-sm text-gray-800 dark:text-gray-200">Camille Laurent</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Pinnacle Corp</p>
                            </div>
                            <div class="p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800">
                                <p class="font-medium text-sm text-gray-800 dark:text-gray-200">David Moreau</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Synergy Group</p>
                            </div>
                            <div class="p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800">
                                <p class="font-medium text-sm text-gray-800 dark:text-gray-200">Élise Fournier</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Apex Industries</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Column: Client Details -->
                <div class="col-span-8">
                    <div class="bg-white dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-800">
                        <!-- SectionHeader -->
                        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-800">
                            <h2 class="text-gray-900 dark:text-white text-lg font-bold">Détails de Alexandre Martin</h2>
                            <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary/10 dark:bg-primary/20 text-primary gap-2 text-sm font-bold leading-normal tracking-[0.015em]">
                                <span class="material-symbols-outlined text-base">edit</span>
                                <span class="truncate">Modifier</span>
                            </button>
                        </div>
                        <!-- Tabs -->
                        <div class="border-b border-gray-200 dark:border-gray-800">
                            <nav aria-label="Tabs" class="flex gap-6 -mb-px px-4">
                                <a class="shrink-0 border-b-2 border-primary px-1 py-3 text-sm font-bold text-primary" href="#">
                                    Informations du Client
                                </a>
                                <a class="shrink-0 border-b-2 border-transparent px-1 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 hover:border-gray-300 dark:hover:border-gray-700 hover:text-gray-700 dark:hover:text-gray-200" href="#">
                                    Historique des Visites
                                </a>
                            </nav>
                        </div>
                        <!-- Client Info Form -->
                        <div class="p-6 grid grid-cols-2 gap-x-6 gap-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="nom">Nom</label>
                                <input class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text:white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="nom" readonly type="text" value="Martin" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="prenom">Prénom</label>
                                <input class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text:white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="prenom" readonly type="text" value="Alexandre" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="telephone">Téléphone</label>
                                <input class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text:white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="telephone" readonly type="tel" value="06 12 34 56 78" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="email">Email</label>
                                <input class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text:white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="email" readonly type="email" value="alexandre.martin@innovatech.com" />
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="entreprise">Entreprise</label>
                                <input class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text:white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="entreprise" readonly type="text" value="Innovatech Solutions" />
                            </div>
                        </div>
                    </div>
                </div><!-- /Right Column -->
            </div>
        </div>
    </main>
</div>
</body>
</html>