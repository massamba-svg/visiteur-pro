<x-app-layout>
    <div x-data="{ 
        showModal: false, 
        loading: false,
        report: null,
        clientStats: null,
        async openReport(visitId) {
            this.loading = true;
            this.showModal = true;
            try {
                const response = await fetch(`/history/${visitId}`);
                const data = await response.json();
                this.report = data.visit;
                this.clientStats = data.client_stats;
            } catch (error) {
                console.error('Erreur:', error);
            }
            this.loading = false;
        },
        closeModal() {
            this.showModal = false;
            this.report = null;
            this.clientStats = null;
        }
    }">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div class="flex flex-col">
                <h1 class="text-[#0d121b] text-4xl font-black leading-tight tracking-[-0.033em]">Historique des Visites</h1>
                <p class="text-[#4c669a] text-base font-normal leading-normal mt-1">Consultez, filtrez et exportez les détails de toutes les visites enregistrées.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('visits.index') }}" class="flex items-center justify-center gap-2 cursor-pointer rounded-lg h-10 px-4 bg-gray-200 text-[#0d121b] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-gray-300 transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                    <span class="truncate">Fermer l'historique</span>
                </a>
                <button class="flex items-center justify-center gap-2 cursor-pointer rounded-lg h-10 px-4 bg-[#135bec] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#135bec]/90 transition-colors">
                    <span class="material-symbols-outlined text-white text-lg">download</span>
                    <span class="truncate">Exporter</span>
                </button>
            </div>
        </div>

        <!-- Chips / Filters -->
        <form action="{{ route('history.index') }}" method="GET" class="flex flex-wrap gap-3 p-3 bg-white rounded-xl border border-[#e7ebf3] mb-6">
            <div class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7ebf3] pl-3 pr-2 text-[#0d121b]">
                <span class="material-symbols-outlined text-lg">person</span>
                <select name="client_id" class="bg-transparent border-0 text-sm font-medium leading-normal focus:ring-0 pr-6">
                    <option value="">Filtrer par Client</option>
                    @foreach($clients ?? [] as $client)
                        <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>{{ $client->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7ebf3] pl-3 pr-2 text-[#0d121b]">
                <span class="material-symbols-outlined text-lg">calendar_month</span>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="bg-transparent border-0 text-sm font-medium leading-normal focus:ring-0 w-32" placeholder="Date début">
                <span class="text-sm">-</span>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="bg-transparent border-0 text-sm font-medium leading-normal focus:ring-0 w-32" placeholder="Date fin">
            </div>
            <div class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7ebf3] pl-3 pr-2 text-[#0d121b]">
                <span class="material-symbols-outlined text-lg">info</span>
                <select name="reason" class="bg-transparent border-0 text-sm font-medium leading-normal focus:ring-0 pr-6">
                    <option value="">Motif de la visite</option>
                    <option value="Réunion" {{ request('reason') == 'Réunion' ? 'selected' : '' }}>Réunion</option>
                    <option value="Livraison" {{ request('reason') == 'Livraison' ? 'selected' : '' }}>Livraison</option>
                    <option value="Entretien" {{ request('reason') == 'Entretien' ? 'selected' : '' }}>Entretien</option>
                    <option value="Autre" {{ request('reason') == 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>
            <div class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#e7ebf3] pl-3 pr-2 text-[#0d121b]">
                <span class="material-symbols-outlined text-lg">groups</span>
                <input type="text" name="person_met" value="{{ request('person_met') }}" class="bg-transparent border-0 text-sm font-medium leading-normal focus:ring-0 w-40" placeholder="Personne rencontrée">
            </div>
            <button type="submit" class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#135bec] px-3 text-white hover:bg-[#135bec]/90 transition-colors">
                <span class="material-symbols-outlined text-lg">search</span>
                <span class="text-sm font-medium">Filtrer</span>
            </button>
            @if(request()->hasAny(['client_id', 'date_from', 'date_to', 'reason', 'person_met']))
                <a href="{{ route('history.index') }}" class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-gray-300 px-3 text-[#0d121b] hover:bg-gray-400 transition-colors">
                    <span class="material-symbols-outlined text-lg">refresh</span>
                    <span class="text-sm font-medium">Réinitialiser</span>
                </a>
            @endif
        </form>

        <!-- Table -->
        <div class="bg-white rounded-xl border border-[#e7ebf3] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#f8f9fc]">
                            <th class="p-4 text-[#0d121b] text-sm font-medium leading-normal w-1/5">Date</th>
                            <th class="p-4 text-[#0d121b] text-sm font-medium leading-normal w-1/4">Client</th>
                            <th class="p-4 text-[#0d121b] text-sm font-medium leading-normal w-1/4">Motif de la visite</th>
                            <th class="p-4 text-[#0d121b] text-sm font-medium leading-normal w-1/5">Personne rencontrée</th>
                            <th class="p-4 text-[#0d121b] text-sm font-medium leading-normal">Rapport</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visits as $visit)
                            <tr class="border-t border-t-[#cfd7e7] hover:bg-[#f8f9fc] transition-colors">
                                <td class="h-[72px] p-4 text-[#4c669a] text-sm font-normal leading-normal">{{ $visit->arrival_time->format('Y-m-d') }}</td>
                                <td class="h-[72px] p-4 text-[#0d121b] text-sm font-normal leading-normal">{{ $visit->client?->company ?? $visit->client?->full_name ?? '-' }}</td>
                                <td class="h-[72px] p-4 text-[#4c669a] text-sm font-normal leading-normal">{{ $visit->reason }}</td>
                                <td class="h-[72px] p-4 text-[#4c669a] text-sm font-normal leading-normal">{{ $visit->person_met }}</td>
                                <td class="h-[72px] p-4">
                                    <button 
                                        @click="openReport({{ $visit->id }})"
                                        class="text-[#135bec] text-sm font-bold leading-normal tracking-[0.015em] cursor-pointer hover:underline"
                                    >
                                        Voir le rapport
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-[#4c669a]">
                                    <span class="material-symbols-outlined text-4xl mb-2">history</span>
                                    <p>Aucune visite dans l'historique.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-center p-4 mt-4">
            {{ $visits->withQueryString()->links() }}
        </div>

        <!-- Modal Rapport -->
        <div 
            x-show="showModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
            @click.self="closeModal()"
            @keydown.escape.window="closeModal()"
            style="display: none;"
        >
            <div 
                x-show="showModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-xl shadow-2xl w-full max-w-md flex flex-col"
                style="max-height: 70vh;"
            >
                <!-- Loading State -->
                <div x-show="loading" class="p-6 text-center">
                    <span class="material-symbols-outlined text-2xl text-[#135bec] animate-spin">sync</span>
                    <p class="mt-2 text-gray-500 text-sm">Chargement...</p>
                </div>

                <!-- Report Content -->
                <div x-show="!loading && report" class="flex flex-col h-full">
                    <!-- Header -->
                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 shrink-0">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-[#135bec]">description</span>
                            <h2 class="text-base font-bold text-gray-900">Rapport de Visite</h2>
                        </div>
                        <button @click="closeModal()" class="p-1 hover:bg-gray-100 rounded transition-colors">
                            <span class="material-symbols-outlined text-gray-500 text-lg">close</span>
                        </button>
                    </div>

                    <!-- Body (scrollable) -->
                    <div class="p-3 space-y-3 overflow-y-auto flex-1 text-sm">
                        <!-- Visiteur + Client -->
                        <div class="grid grid-cols-2 gap-2">
                            <div class="p-2 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500">Visiteur</p>
                                <p class="font-medium text-gray-900 truncate" x-text="report?.visitor_name || '-'"></p>
                            </div>
                            <div class="p-2 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500">Entreprise</p>
                                <p class="font-medium text-gray-900 truncate" x-text="report?.client_company"></p>
                            </div>
                            <div class="p-2 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500">Client</p>
                                <p class="font-medium text-gray-900 truncate" x-text="report?.client_name"></p>
                            </div>
                            <div class="p-2 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-500">Personne rencontrée</p>
                                <p class="font-medium text-gray-900 truncate" x-text="report?.person_met"></p>
                            </div>
                        </div>

                        <!-- Horaires -->
                        <div class="flex items-center gap-2 p-2 bg-blue-50 rounded-lg">
                            <span class="material-symbols-outlined text-blue-500 text-lg">schedule</span>
                            <div class="flex-1 flex items-center justify-between text-xs">
                                <span><span class="text-gray-500">Date:</span> <span class="font-medium" x-text="report?.date"></span></span>
                                <span><span class="text-gray-500">Arrivée:</span> <span class="font-medium" x-text="report?.arrival_time"></span></span>
                                <span><span class="text-gray-500">Départ:</span> <span class="font-medium" x-text="report?.departure_time"></span></span>
                                <span class="font-bold text-[#135bec]" x-text="report?.duration"></span>
                            </div>
                        </div>

                        <!-- Motif + Stats -->
                        <div class="flex items-center gap-2">
                            <div class="flex-1 p-2 bg-purple-50 rounded-lg flex items-center gap-2">
                                <span class="material-symbols-outlined text-purple-500 text-lg">label</span>
                                <span class="font-medium text-purple-800 text-xs" x-text="report?.reason"></span>
                            </div>
                            <div x-show="clientStats" class="p-2 bg-green-50 rounded-lg text-center">
                                <span class="font-bold text-green-700" x-text="clientStats?.total_visits"></span>
                                <span class="text-xs text-gray-500">visites</span>
                            </div>
                        </div>

                        <!-- Enregistré par -->
                        <div class="flex items-center gap-1 text-xs text-gray-400">
                            <span class="material-symbols-outlined text-xs">person_check</span>
                            <span>Par: <span class="text-gray-600" x-text="report?.registered_by"></span></span>
                        </div>
                    </div>

                    <!-- Footer (fixed) -->
                    <div class="flex items-center justify-end gap-2 px-3 py-2 border-t border-gray-200 bg-gray-50 shrink-0 rounded-b-xl">
                        <button @click="closeModal()" class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-200 rounded transition-colors">
                            Fermer
                        </button>
                        <button class="flex items-center gap-1 px-3 py-1.5 bg-[#135bec] text-white text-xs font-bold rounded hover:bg-[#135bec]/90 transition-colors">
                            <span class="material-symbols-outlined text-xs">download</span>
                            PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
