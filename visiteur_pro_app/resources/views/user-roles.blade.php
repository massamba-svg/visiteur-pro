<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Gestion des Rôles Utilisateur</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @vite(['resources/css/user-roles.css', 'resources/js/user-roles.js'])
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
<div class="relative flex h-auto min-h-screen w-full flex-col">
    <div class="flex h-full min-h-screen">
        <!-- SideNavBar -->
        <aside class="flex w-64 flex-col border-r border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark p-4">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Kara SAMB avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDjZTgrysrV5XyfYLI9fGcmRpV1TfqDI594X6uU3qe9Q2UMJMzcnILz_xjCQOy5JMtyIW4P19qNvu2rc2g2tDyuom8ffgJ5Ppv1T2_HhWQKI-i5egaBBR4BUy_zq_Z28GGubAiZDRs539TGVMyUr8UvxEAn3IF_K540quNgzuYsng8aSJgIjOZUJyqohhOFUPKZNXmmo1u8Zrkkl8K47xDFUAWbt4PqYk32l4Samjee0yDN1x8sV2qgc3wHi8LpTtJyLjRlvI2lfA");'></div>
                    <div class="flex flex-col">
                        <h1 class="text-text-light dark:text-text-dark text-base font-medium leading-normal">Kara SAMB</h1>
                        <p class="text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">Gestion de visites</p>
                    </div>
                </div>
                <nav class="flex flex-col gap-2 mt-4">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 dark:bg-primary/30 text-primary" href="{{ route('roles.index') }}">
                        <span class="material-symbols-outlined text-primary">group</span>
                        <p class="text-sm font-medium leading-normal">Liste des Utilisateurs</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-light dark:text-text-dark" href="{{ route('roles.index') }}">
                        <span class="material-symbols-outlined">person_add</span>
                        <p class="text-sm font-medium leading-normal">Créer un Utilisateur</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-light dark:text-text-dark" href="{{ route('visits.history') }}">
                        <span class="material-symbols-outlined">shield</span>
                        <p class="text-sm font-medium leading-normal">Historique des Actions</p>
                    </a>
                </nav>
            </div>
            <div class="mt-auto flex flex-col gap-2">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-light dark:text-text-dark" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <p class="text-sm font-medium leading-normal">Paramètres</p>
                </a>
                <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-muted-bg-light dark:bg-muted-bg-dark text-text-light dark:text-text-dark text-sm font-bold leading-normal tracking-[0.015em] w-full mt-2">
                    <span class="truncate">Déconnexion</span>
                </button>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="w-full max-w-7xl mx-auto">
                <!-- PageHeading -->
                <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                    <div class="flex min-w-72 flex-col gap-2">
                        <p class="text-text-light dark:text-text-dark text-3xl font-black leading-tight tracking-tight">Gestion des Rôles et Utilisateurs</p>
                        <p class="text-text-muted-light dark:text-text-muted-dark text-base font-normal leading-normal">Ajoutez, modifiez et consultez les utilisateurs et leurs permissions.</p>
                    </div>
                    <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text:white gap-2 text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="material-symbols-outlined text-base">add</span>
                        <span class="truncate">Ajouter un Utilisateur</span>
                    </button>
                </div>
                <!-- Search and Filter -->
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
                    <div class="flex-grow">
                        <label class="flex flex-col min-w-40 h-12 w-full">
                            <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                <div class="text-text-muted-light dark:text-text-muted-dark flex border-r-0 border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark items-center justify-center pl-4 rounded-l-lg">
                                    <span class="material-symbols-outlined">search</span>
                                </div>
                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark h-full placeholder:text-text-muted-light dark:placeholder:text-text-muted-dark px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" placeholder="Rechercher un utilisateur par nom ou email..." value="" />
                            </div>
                        </label>
                    </div>
                    <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-card-light dark:bg-card-dark text-text-light dark:text-text-dark border border-border-light dark:border-border-dark gap-2 text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="material-symbols-outlined text-base">filter_list</span>
                        <span class="truncate">Filtres</span>
                    </button>
                </div>
                <!-- Table -->
                <div class="w-full @container">
                    <div class="flex overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark">
                        <table class="w-full">
                            <thead class="border-b border-border-light dark:border-border-dark">
                                <tr class="bg-background-light dark:bg-background-dark">
                                    <th class="px-4 py-3 text-left w-12">
                                        <input class="h-5 w-5 rounded-md border-border-light dark:border-border-dark bg-transparent text-primary checked:bg-primary checked:border-primary focus:ring-0 focus:ring-offset-0 focus:border-border-light" type="checkbox" />
                                    </th>
                                    <th class="px-4 py-3 text-left text-text-light dark:text-text-dark text-sm font-medium leading-normal">Nom</th>
                                    <th class="px-4 py-3 text-left text-text-light dark:text-text-dark text-sm font-medium leading-normal">Email</th>
                                    <th class="px-4 py-3 text-left text-text-light dark:text-text-dark text-sm font-medium leading-normal">Rôle</th>
                                    <th class="px-4 py-3 text-left text-text-light dark:text-text-dark text-sm font-medium leading-normal">Date de création</th>
                                    <th class="px-4 py-3 text-left text-text-muted-light dark:text-text-muted-dark text-sm font-medium leading-normal">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t border-border-light dark:border-border-dark hover:bg-muted-bg-light/50 dark:hover:bg-muted-bg-dark/50">
                                    <td class="h-[72px] px-4 py-2 text-center">
                                        <input class="h-5 w-5 rounded-md border-border-light dark:border-border-dark bg-transparent text-primary checked:bg-primary checked:border-primary focus:ring-0 focus:ring-offset-0" type="checkbox" />
                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-text-light dark:text-text-dark text-sm font-medium leading-normal">Amina Diallo</td>
                                    <td class="h-[72px] px-4 py-2 text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">amina.diallo@example.com</td>
                                    <td class="h-[72px] px-4 py-2">
                                        <span class="inline-flex items-center rounded-full bg-primary/20 px-3 py-1 text-sm font-medium text-primary">Administrateur</span>
                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">15/07/2023</td>
                                    <td class="h-[72px] px-4 py-2">
                                        <div class="flex items-center gap-2">
                                            <button class="p-2 rounded-md hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-muted-light dark:text-text-muted-dark"><span class="material-symbols-outlined text-xl">edit</span></button>
                                            <button class="p-2 rounded-md hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-muted-light dark:text-text-muted-dark"><span class="material-symbols-outlined text-xl">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-t border-border-light dark:border-border-dark hover:bg-muted-bg-light/50 dark:hover:bg-muted-bg-dark/50">
                                    <td class="h-[72px] px-4 py-2 text-center">
                                        <input class="h-5 w-5 rounded-md border-border-light dark:border-border-dark bg-transparent text-primary checked:bg-primary checked:border-primary focus:ring-0 focus:ring-offset-0" type="checkbox" />
                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-text-light dark:text-text-dark text-sm font-medium leading-normal">Moussa Fall</td>
                                    <td class="h-[72px] px-4 py-2 text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">moussa.fall@example.com</td>
                                    <td class="h-[72px] px-4 py-2">
                                        <span class="inline-flex items-center rounded-full bg-muted-bg-light dark:bg-muted-bg-dark px-3 py-1 text-sm font-medium text-text-light dark:text-text-dark">Réceptionniste</span>
                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">12/06/2023</td>
                                    <td class="h-[72px] px-4 py-2">
                                        <div class="flex items-center gap-2">
                                            <button class="p-2 rounded-md hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-muted-light dark:text-text-muted-dark"><span class="material-symbols-outlined text-xl">edit</span></button>
                                            <button class="p-2 rounded-md hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-muted-light dark:text-text-muted-dark"><span class="material-symbols-outlined text-xl">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-t border-border-light dark:border-border-dark hover:bg-muted-bg-light/50 dark:hover:bg-muted-bg-dark/50">
                                    <td class="h-[72px] px-4 py-2 text-center">
                                        <input class="h-5 w-5 rounded-md border-border-light dark:border-border-dark bg-transparent text-primary checked:bg-primary checked:border-primary focus:ring-0 focus:ring-offset-0" type="checkbox" />
                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-text-light dark:text-text-dark text-sm font-medium leading-normal">Fatou Ndiaye</td>
                                    <td class="h-[72px] px-4 py-2 text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">fatou.ndiaye@example.com</td>
                                    <td class="h-[72px] px-4 py-2">
                                        <span class="inline-flex items-center rounded-full bg-muted-bg-light dark:bg-muted-bg-dark px-3 py-1 text-sm font-medium text-text-light dark:text-text-dark">Réceptionniste</span>
                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">10/05/2023</td>
                                    <td class="h-[72px] px-4 py-2">
                                        <div class="flex items-center gap-2">
                                            <button class="p-2 rounded-md hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-muted-light dark:text-text-muted-dark"><span class="material-symbols-outlined text-xl">edit</span></button>
                                            <button class="p-2 rounded-md hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-muted-light dark:text-text-muted-dark"><span class="material-symbols-outlined text-xl">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-t border-border-light dark:border-border-dark hover:bg-muted-bg-light/50 dark:hover:bg-muted-bg-dark/50">
                                    <td class="h-[72px] px-4 py-2 text-center">
                                        <input class="h-5 w-5 rounded-md border-border-light dark:border-border-dark bg-transparent text-primary checked:bg-primary checked:border-primary focus:ring-0 focus:ring-offset-0" type="checkbox" />
                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-text-light dark:text-text-dark text-sm font-medium leading-normal">Ibrahima Sow</td>
                                    <td class="h-[72px] px-4 py-2 text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">ibrahima.sow@example.com</td>
                                    <td class="h-[72px] px-4 py-2">
                                        <span class="inline-flex items-center rounded-full bg-muted-bg-light dark:bg-muted-bg-dark px-3 py-1 text-sm font-medium text-text-light dark:text-text-dark">Réceptionniste</span>
                                    </td>
                                    <td class="h-[72px] px-4 py-2 text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal">01/03/2023</td>
                                    <td class="h-[72px] px-4 py-2">
                                        <div class="flex items-center gap-2">
                                            <button class="p-2 rounded-md hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-muted-light dark:text-text-muted-dark"><span class="material-symbols-outlined text-xl">edit</span></button>
                                            <button class="p-2 rounded-md hover:bg-muted-bg-light dark:hover:bg-muted-bg-dark text-text-muted-light dark:text-text-muted-dark"><span class="material-symbols-outlined text-xl">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /Table -->
            </div>
        </main>
    </div>
</div>
</body>
</html>