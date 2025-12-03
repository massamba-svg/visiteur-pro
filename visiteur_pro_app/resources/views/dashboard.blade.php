<x-app-layout>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Tableau de Bord</h1>
            <p class="text-base font-normal text-gray-500">Aperçu des visites clients et des tendances.</p>
        </div>
        <!-- Chips -->
        <div class="flex gap-2">
            <button class="flex h-9 items-center justify-center gap-x-2 rounded-lg bg-white pl-4 pr-3 border border-gray-200 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-800">Aujourd'hui</p>
                <span class="material-symbols-outlined text-gray-500" style="font-size: 20px;">expand_more</span>
            </button>
            <button class="flex h-9 items-center justify-center gap-x-2 rounded-lg bg-white pl-4 pr-3 border border-gray-200 hover:bg-gray-50">
                <p class="text-sm font-medium text-gray-800">Cette semaine</p>
                <span class="material-symbols-outlined text-gray-500" style="font-size: 20px;">expand_more</span>
            </button>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200">
            <p class="text-base font-medium text-gray-600">Visiteurs Actuels</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['current_visitors'] ?? 0 }}</p>
            <p class="text-base font-medium text-green-600">+5%</p>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200">
            <p class="text-base font-medium text-gray-600">Visites du Jour</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['today_visits'] ?? 0 }}</p>
            <p class="text-base font-medium text-red-600">-2%</p>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200">
            <p class="text-base font-medium text-gray-600">Visites de la Semaine</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['week_visits'] ?? 0 }}</p>
            <p class="text-base font-medium text-green-600">+10%</p>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200">
            <p class="text-base font-medium text-gray-600">Total Clients</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_clients'] ?? 0 }}</p>
            <p class="text-base font-medium text-green-600">+1.2%</p>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Chart -->
        <div class="lg:col-span-2 flex flex-col gap-4 rounded-xl border border-gray-200 p-6 bg-white">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-base font-bold text-gray-900">Tendance des Visites Mensuelles</p>
                    <p class="text-sm text-gray-500">3 derniers mois</p>
                </div>
                <div class="flex gap-1 items-center">
                    <p class="text-4xl font-bold text-gray-900">{{ $stats['total_visits'] ?? 0 }}</p>
                    <p class="text-base font-medium text-green-600 mt-2">+8%</p>
                </div>
            </div>
            <div class="flex min-h-[250px] flex-1 flex-col gap-8 py-4">
                <svg class="h-full" fill="none" preserveAspectRatio="none" viewBox="-3 0 478 150" width="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient gradientUnits="userSpaceOnUse" id="chartGradient" x1="236" x2="236" y1="1" y2="149">
                            <stop stop-color="#135bec" stop-opacity="0.2"></stop>
                            <stop offset="1" stop-color="#135bec" stop-opacity="0"></stop>
                        </linearGradient>
                    </defs>
                    <path d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25V149H0V109Z" fill="url(#chartGradient)"></path>
                    <path d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25" stroke="#135bec" stroke-linecap="round" stroke-width="3"></path>
                </svg>
                <div class="flex justify-around text-gray-500 text-sm font-bold">
                    <p>Jan</p>
                    <p>Fév</p>
                    <p>Mar</p>
                    <p>Avr</p>
                    <p>Mai</p>
                    <p>Juin</p>
                </div>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="lg:col-span-1 flex flex-col gap-4 rounded-xl border border-gray-200 p-6 bg-white">
            <p class="text-base font-bold text-gray-900">Visites par Semaine</p>
            <div class="grid min-h-[250px] grid-flow-col gap-4 grid-rows-[1fr_auto] items-end justify-items-center px-3 pt-6">
                <div class="bg-blue-600/20 rounded-t w-full" style="height: 80%;"></div>
                <div class="bg-blue-600/20 rounded-t w-full" style="height: 40%;"></div>
                <div class="bg-blue-600/20 rounded-t w-full" style="height: 50%;"></div>
                <div class="bg-blue-600/20 rounded-t w-full" style="height: 20%;"></div>
                <div class="bg-blue-600/20 rounded-t w-full" style="height: 60%;"></div>
                <div class="bg-blue-600/20 rounded-t w-full" style="height: 90%;"></div>
                <div class="bg-blue-600 rounded-t w-full" style="height: 100%;"></div>
                <p class="text-gray-500 text-sm font-bold">Lun</p>
                <p class="text-gray-500 text-sm font-bold">Mar</p>
                <p class="text-gray-500 text-sm font-bold">Mer</p>
                <p class="text-gray-500 text-sm font-bold">Jeu</p>
                <p class="text-gray-500 text-sm font-bold">Ven</p>
                <p class="text-gray-500 text-sm font-bold">Sam</p>
                <p class="text-gray-900 text-sm font-bold">Dim</p>
            </div>
        </div>
    </div>
</x-app-layout>
