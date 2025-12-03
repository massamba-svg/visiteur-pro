<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Historique des Visites</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,0" rel="stylesheet" />
    @vite(['resources/css/visits-history.css', 'resources/js/visits-history.js'])
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-[#0d121b] dark:text:white">
<div class="flex min-h-screen">
    <!-- SideNavBar -->
    <aside class="w-64 shrink-0 bg-[#f8f9fc] dark:bg-[#181f2c] border-r border-[#e7ebf3] dark:border-[#2a3140] p-4 flex flex-col justify-between">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3 p-2">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="User avatar for Kara SAMB" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDm31whziKfIledgo5A-QkgzjNJMm4j59XLAEZY--JWsHDN8jObyf0gAhqyFqRsDhY0wjY-RndwduAuI0lvnixEz9PD8BbOWtSSYTgQhmECQzOWDi9WT4rBCLXJmzWvQmWP9MOuM4K_muYGtEyyhiezn_ACPMTyfNMZedBytuikyQFkx_eAvPhyPXRha16Q-taoc2UHE_uTHQwalcL5jf7dFGVBZIJZnXpR42zCfusZ4AZK35LC8ZOFB4_u6i90j_5GODtYaDAaJQ");'></div>
                <div class="flex flex-col">
                    <h1 class="text-[#0d121b] dark:text:white text-base font-medium leading-normal">Kara SAMB</h1>
                    <p class="text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Gestionnaire</p>
                </div>
            </div>
            <nav class="flex flex-col gap-2 mt-4">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text:white">dashboard</span>
                    <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Dashboard</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors" href="{{ route('clients.index') }}">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text:white">group</span>
                    <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Clients</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 dark:bg-primary/30" href="{{ route('visits.history') }}">
                    <span class="material-symbols-outlined text-primary dark:text:white" style="font-variation-settings: 'FILL' 1;">history</span>
                    <p class="text-primary dark:text:white text-sm font-bold leading-normal">Historique des Visites</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors" href="#">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text:white">bar_chart</span>
                    <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Rapports</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors" href="#">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text:white">toggle_on</span>
                    <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Paramètres</p>
                </a>
            </nav>
        </div>
        <div class="flex flex-col gap-1">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors" href="#">
                <span class="material-symbols-outlined text-[#0d121b] dark:text:white">logout</span>
                <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Déconnexion</p>
            </a>
        </div>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-7xl mx-auto">
            <!-- PageHeading -->
            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <div class="flex flex-col">
                    <h1 class="text-[#0d121b] dark:text:white text-4xl font-black leading-tight tracking-[-0.033em]">Historique des Visites</h1>
                    <p class="text-[#4c669a] dark:text-[#a0aec0] text-base font-normal leading-normal mt-1">Consultez, filtrez et exportez les détails de toutes les visites enregistrées.</p>
                </div>
                <button class="flex items-center justify-center gap-2 cursor-pointer rounded-lg h-10 px-4 bg-primary text:white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                    <span class="material-symbols-outlined text:white text-lg">download</span>
                    <span class="truncate">Exporter</span>
                </button>
            </div>
            <!-- Chips / Filters -->
            <div class="flex flex-wrap gap-3 p-3 bg-white dark:bg-[#181f2c] rounded-xl border border-[#e7ebf3] dark:border-[#2a3140] mb-6">
                <button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] pl-3 pr-2 text-[#0d121b] dark:text:white hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors">
                    <span class="material-symbols-outlined text-lg">person</span>
                    <p class="text-sm font-medium leading-normal">Filtrer par Client</p>
                    <span class="material-symbols-outlined text-lg">arrow_drop_down</span>
                </button>
                <button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] pl-3 pr-2 text-[#0d121b] dark:text:white hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors">
                    <span class="material-symbols-outlined text-lg">calendar_month</span>
                    <p class="text-sm font-medium leading-normal">Date de la visite</p>
                    <span class="material-symbols-outlined text-lg">arrow_drop_down</span>
                </button>
                <button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] pl-3 pr-2 text-[#0d121b] dark:text:white hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors">
                    <span class="material-symbols-outlined text-lg">info</span>
                    <p class="text-sm font-medium leading-normal">Motif de la visite</p>
                    <span class="material-symbols-outlined text-lg">arrow_drop_down</span>
                </button>
                <button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] pl-3 pr-2 text-[#0d121b] dark:text:white hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors">
                    <span class="material-symbols-outlined text-lg">groups</span>
                    <p class="text-sm font-medium leading-normal">Personne rencontrée</p>
                    <span class="material-symbols-outlined text-lg">arrow_drop_down</span>
                </button>
            </div>
            <!-- Table -->
            <div class="bg-white dark:bg-[#181f2c] rounded-xl border border-[#e7ebf3] dark:border-[#2a3140] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-[#f8f9fc] dark:bg-black/20">
                                <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal w-1/5">Date</th>
                                <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal w-1/4">Client</th>
                                <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal w-1/4">Motif de la visite</th>
                                <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal w-1/5">Personne rencontrée</th>
                                <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Rapport</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-t-[#cfd7e7] dark:border-t-[#2a3140] hover:bg-[#f8f9fc] dark:hover:bg:black/20 transition-colors">
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">2023-10-26</td>
                                <td class="h-[72px] p-4 text-[#0d121b] dark:text:white text-sm font-normal leading-normal">Innovatech SARL</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Suivi de projet</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Marie Dubois</td>
                                <td class="h-[72px] p-4 text-primary text-sm font-bold leading-normal tracking-[0.015em] cursor-pointer hover:underline">Voir le rapport</td>
                            </tr>
                            <tr class="border-t border-t-[#cfd7e7] dark:border-t-[#2a3140] hover:bg-[#f8f9fc] dark:hover:bg:black/20 transition-colors">
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">2023-10-24</td>
                                <td class="h-[72px] p-4 text-[#0d121b] dark:text:white text-sm font-normal leading-normal">Solutions Logistiques SA</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Démonstration produit</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Paul Martin</td>
                                <td class="h-[72px] p-4 text-primary text-sm font-bold leading-normal tracking-[0.015em] cursor-pointer hover:underline">Voir le rapport</td>
                            </tr>
                            <tr class="border-t border-t-[#cfd7e7] dark:border-t-[#2a3140] hover:bg-[#f8f9fc] dark:hover:bg:black/20 transition-colors">
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">2023-10-22</td>
                                <td class="h-[72px] p-4 text-[#0d121b] dark:text:white text-sm font-normal leading-normal">Bâtiment Durable Corp</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Négociation contrat</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Lucie Bernard</td>
                                <td class="h-[72px] p-4 text-primary text-sm font-bold leading-normal tracking-[0.015em] cursor-pointer hover:underline">Voir le rapport</td>
                            </tr>
                            <tr class="border-t border-t-[#cfd7e7] dark:border-t-[#2a3140] hover:bg-[#f8f9fc] dark:hover:bg:black/20 transition-colors">
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">2023-10-21</td>
                                <td class="h-[72px] p-4 text-[#0d121b] dark:text:white text-sm font-normal leading-normal">Gourmet &amp; Cie</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Visite de courtoisie</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Jean Lefebvre</td>
                                <td class="h-[72px] p-4 text-primary text-sm font-bold leading-normal tracking-[0.015em] cursor-pointer hover:underline">Voir le rapport</td>
                            </tr>
                            <tr class="border-t border-t-[#cfd7e7] dark:border-t-[#2a3140] hover:bg-[#f8f9fc] dark:hover:bg:black/20 transition-colors">
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">2023-10-19</td>
                                <td class="h-[72px] p-4 text-[#0d121b] dark:text:white text-sm font-normal leading-normal">Tech Avancée</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Support technique</td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Sophie Petit</td>
                                <td class="h-[72px] p-4 text-primary text-sm font-bold leading-normal tracking-[0.015em] cursor-pointer hover:underline">Voir le rapport</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-center p-4 mt-4">
                <a class="flex size-10 items-center justify-center text-[#0d121b] dark:text:white rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-[#2a3140] transition-colors" href="#">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </a>
                <a class="text-sm font-bold leading-normal tracking-[0.015em] flex size-10 items-center justify-center text:white rounded-lg bg-primary" href="#">1</a>
                <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#0d121b] dark:text:white rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-[#2a3140] transition-colors" href="#">2</a>
                <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#0d121b] dark:text:white rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-[#2a3140] transition-colors" href="#">3</a>
                <span class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#0d121b] dark:text:white rounded-lg">...</span>
                <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#0d121b] dark:text:white rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-[#2a3140] transition-colors" href="#">10</a>
                <a class="flex size-10 items-center justify-center text-[#0d121b] dark:text:white rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-[#2a3140] transition-colors" href="#">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </a>
            </div>
        </div>
    </main>
</div>
</body>
</html>