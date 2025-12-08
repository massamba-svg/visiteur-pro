<x-app-layout>
    <div class="w-full max-w-7xl mx-auto" x-data="reportFilters()">
        <!-- PageHeading with Export -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Rapports d'Activité</h1>
                <p class="text-base font-normal text-gray-500">Analyse complète des visites et performance</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('reports.export-pdf', request()->all()) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-[#135bec] text-white hover:bg-[#135bec]/90 text-sm font-semibold">
                    <span class="material-symbols-outlined text-lg">download</span>
                    <span>Exporter PDF</span>
                </a>
                
                <!-- Bouton Période (sans badge jours) -->
                <button 
                    @click="openModal = true"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-sm font-semibold"
                >
                    <span class="material-symbols-outlined text-lg">date_range</span>
                    <span>{{ $filterData['period_label'] ?? 'Période' }}</span>
                </button>
            </div>
        </div>
        
        <!-- Badge période active (sans nombre de jours) -->
        @if(request()->has('period_type'))
        <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#135bec]/10 text-[#135bec] text-sm font-medium">
                <span class="material-symbols-outlined text-base">calendar_month</span>
                {{ $filterData['period_label'] }}
            </span>
            <a href="{{ route('reports.index') }}" class="text-gray-500 hover:text-gray-700">
                <span class="material-symbols-outlined text-lg">close</span>
            </a>
        </div>
        @endif

        <!-- Modal Période -->
        <div 
            x-show="openModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
            @click.self="openModal = false"
            @keydown.escape.window="openModal = false"
            style="display: none;"
        >
            <div 
                x-show="openModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-xl shadow-2xl w-full max-w-lg overflow-hidden"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#135bec] text-2xl">date_range</span>
                        <h2 class="text-lg font-bold text-gray-900">Sélectionner une période</h2>
                    </div>
                    <button @click="openModal = false" class="p-1 hover:bg-gray-200 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-gray-500">close</span>
                    </button>
                </div>
                
                <!-- Body -->
                <form action="{{ route('reports.index') }}" method="GET" class="p-6">
                    <!-- Périodes prédéfinies -->
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Périodes rapides</p>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="relative">
                                <input type="radio" name="period_type" value="today" x-model="periodType" class="peer sr-only">
                                <div class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-[#135bec] peer-checked:bg-[#135bec]/5 transition-all">
                                    <span class="material-symbols-outlined text-gray-500">today</span>
                                    <span class="text-sm font-medium">Aujourd'hui</span>
                                </div>
                            </label>
                            
                            <label class="relative">
                                <input type="radio" name="period_type" value="last_7_days" x-model="periodType" class="peer sr-only">
                                <div class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-[#135bec] peer-checked:bg-[#135bec]/5 transition-all">
                                    <span class="material-symbols-outlined text-gray-500">date_range</span>
                                    <span class="text-sm font-medium">7 derniers jours</span>
                                </div>
                            </label>
                            
                            <label class="relative">
                                <input type="radio" name="period_type" value="last_30_days" x-model="periodType" class="peer sr-only">
                                <div class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-[#135bec] peer-checked:bg-[#135bec]/5 transition-all">
                                    <span class="material-symbols-outlined text-gray-500">calendar_month</span>
                                    <span class="text-sm font-medium">30 derniers jours</span>
                                </div>
                            </label>
                            
                            <label class="relative">
                                <input type="radio" name="period_type" value="month" x-model="periodType" class="peer sr-only">
                                <div class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-[#135bec] peer-checked:bg-[#135bec]/5 transition-all">
                                    <span class="material-symbols-outlined text-gray-500">calendar_view_month</span>
                                    <span class="text-sm font-medium">Ce mois</span>
                                </div>
                            </label>
                            
                            <label class="relative">
                                <input type="radio" name="period_type" value="last_month" x-model="periodType" class="peer sr-only">
                                <div class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-[#135bec] peer-checked:bg-[#135bec]/5 transition-all">
                                    <span class="material-symbols-outlined text-gray-500">history</span>
                                    <span class="text-sm font-medium">Mois dernier</span>
                                </div>
                            </label>
                            
                            <label class="relative">
                                <input type="radio" name="period_type" value="quarter" x-model="periodType" class="peer sr-only">
                                <div class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-[#135bec] peer-checked:bg-[#135bec]/5 transition-all">
                                    <span class="material-symbols-outlined text-gray-500">view_agenda</span>
                                    <span class="text-sm font-medium">Ce trimestre</span>
                                </div>
                            </label>
                            
                            <label class="relative col-span-2">
                                <input type="radio" name="period_type" value="year" x-model="periodType" class="peer sr-only">
                                <div class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-[#135bec] peer-checked:bg-[#135bec]/5 transition-all">
                                    <span class="material-symbols-outlined text-gray-500">event</span>
                                    <span class="text-sm font-medium">Cette année</span>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Période personnalisée -->
                    <div class="mb-6">
                        <label class="relative">
                            <input type="radio" name="period_type" value="custom" x-model="periodType" class="peer sr-only">
                            <div class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-[#135bec] peer-checked:bg-[#135bec]/5 transition-all mb-3">
                                <span class="material-symbols-outlined text-gray-500">edit_calendar</span>
                                <span class="text-sm font-medium">Période personnalisée</span>
                            </div>
                        </label>
                        
                        <div x-show="periodType === 'custom'" x-transition class="grid grid-cols-2 gap-4 mt-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Date de début</label>
                                <input 
                                    type="date" 
                                    name="date_from" 
                                    x-model="dateFrom"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#135bec] focus:border-[#135bec]"
                                >
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Date de fin</label>
                                <input 
                                    type="date" 
                                    name="date_to" 
                                    x-model="dateTo"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#135bec] focus:border-[#135bec]"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <!-- Option de comparaison -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="compare" 
                                value="1"
                                x-model="compareEnabled"
                                class="w-5 h-5 text-[#135bec] border-gray-300 rounded focus:ring-[#135bec]"
                            >
                            <div>
                                <p class="text-sm font-medium text-gray-900">Comparer avec la période précédente</p>
                                <p class="text-xs text-gray-500">Affiche les données de la période équivalente précédente</p>
                            </div>
                        </label>
                    </div>
                    
                    <!-- Aperçu simplifié -->
                    <div class="p-4 bg-[#135bec]/5 border border-[#135bec]/20 rounded-lg mb-6">
                        <div class="flex items-center gap-2 text-[#135bec] mb-2">
                            <span class="material-symbols-outlined text-lg">info</span>
                            <p class="text-sm font-semibold">Aperçu de la sélection</p>
                        </div>
                        <p class="text-sm text-gray-700" x-text="getPreviewText()"></p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3">
                        <button 
                            type="button" 
                            @click="openModal = false" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors"
                        >
                            Annuler
                        </button>
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-[#135bec] text-white text-sm font-semibold rounded-lg hover:bg-[#135bec]/90 transition-colors flex items-center gap-2"
                        >
                            <span class="material-symbols-outlined text-lg">check</span>
                            Appliquer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="flex flex-col gap-3 rounded-xl p-6 bg-white border border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Visites Totales</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($totalVisits, 0, ',', ' ') }}</p>
                    </div>
                    <span class="material-symbols-outlined text-4xl text-blue-500">trending_up</span>
                </div>
                <p class="text-xs font-semibold {{ $visitsTrend >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $visitsTrend >= 0 ? '+' : '' }}{{ $visitsTrend }}% vs période précédente
                </p>
            </div>

            <div class="flex flex-col gap-3 rounded-xl p-6 bg-white border border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Clients Actifs</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $activeClients }}</p>
                    </div>
                    <span class="material-symbols-outlined text-4xl text-green-500">people</span>
                </div>
                <p class="text-xs font-semibold text-green-600">Clients avec visites</p>
            </div>

            <div class="flex flex-col gap-3 rounded-xl p-6 bg-white border border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Taux de Conversion</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $conversionRate }}%</p>
                    </div>
                    <span class="material-symbols-outlined text-4xl text-purple-500">percent</span>
                </div>
                <p class="text-xs font-semibold text-gray-500">Visites terminées</p>
            </div>

            <div class="flex flex-col gap-3 rounded-xl p-6 bg-white border border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Durée Moyenne</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $avgDuration }} min</p>
                    </div>
                    <span class="material-symbols-outlined text-4xl text-orange-500">schedule</span>
                </div>
                <p class="text-xs font-semibold text-gray-500">Par visite</p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Barres Horizontales Dynamiques -->
            <div class="lg:col-span-2 rounded-xl p-6 bg-white border border-gray-200">
                <!-- TITRE DYNAMIQUE -->
                <h2 class="text-lg font-bold text-gray-900 mb-6">
                    Tendance des Visites ({{ $filterData['period_label'] ?? '6 derniers mois' }})
                </h2>
                
                @php
                    $maxCount = $monthlyVisits->max('count') ?: 1;
                    $barColors = ['#135bec', '#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe', '#dbeafe'];
                @endphp
                
                <div class="space-y-4">
                    @foreach ($monthlyVisits as $index => $month)
                        @php
                            $percentage = $maxCount > 0 ? ($month['count'] / $maxCount) * 100 : 0;
                        @endphp
                        <div class="flex items-center gap-4">
                            <div class="w-20 text-right">
                                <p class="text-sm font-semibold text-gray-700">{{ $month['month'] }}</p>
                            </div>
                            
                            <div class="flex-1 relative">
                                <div class="w-full bg-gray-100 rounded-full h-10 overflow-hidden">
                                    <div 
                                        class="h-full rounded-full transition-all duration-500 flex items-center justify-end px-3"
                                        style="width: {{ $percentage }}%; background-color: {{ $barColors[$index % count($barColors)] }}"
                                    >
                                        @if($month['count'] > 0)
                                            <span class="text-white font-bold text-sm">{{ $month['count'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <p class="text-base font-bold text-gray-900">Total</p>
                        <p class="text-2xl font-bold text-[#135bec]">{{ $monthlyVisits->sum('count') }} visites</p>
                    </div>
                </div>
            </div>

            <!-- Top Clients -->
            <div class="rounded-xl p-6 bg-white border border-gray-200">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Top 5 Clients</h2>
                <div class="flex flex-col gap-4">
                    @php
                        $badgeColors = [
                            ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
                            ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
                            ['bg' => 'bg-purple-100', 'text' => 'text-purple-800'],
                            ['bg' => 'bg-orange-100', 'text' => 'text-orange-800'],
                            ['bg' => 'bg-red-100', 'text' => 'text-red-800'],
                        ];
                    @endphp
                    @forelse($topClients as $index => $client)
                        @php
                            $colorClasses = $badgeColors[$index] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800'];
                        @endphp
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <p class="text-sm font-medium text-gray-900">{{ $client->company ?: $client->full_name }}</p>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full {{ $colorClasses['bg'] }} {{ $colorClasses['text'] }} text-xs font-semibold">
                                {{ $client->visits_count }} visite{{ $client->visits_count > 1 ? 's' : '' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Aucun client avec visites</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Motif Distribution -->
        <div class="rounded-xl p-6 bg-white border border-gray-200 mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Distribution par Motif de Visite</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $purposeIcons = [
                        'Réunion' => ['icon' => 'meeting_room', 'color' => 'blue'],
                        'Livraison' => ['icon' => 'local_shipping', 'color' => 'green'],
                        'Entretien' => ['icon' => 'person_check', 'color' => 'purple'],
                        'Maintenance' => ['icon' => 'build', 'color' => 'orange'],
                        'Formation' => ['icon' => 'school', 'color' => 'indigo'],
                        'Commercial' => ['icon' => 'storefront', 'color' => 'teal'],
                    ];
                    $defaultIcon = ['icon' => 'more_horiz', 'color' => 'gray'];
                @endphp
                @forelse($visitsByPurpose as $purpose => $data)
                    @php
                        $iconData = $purposeIcons[$purpose] ?? $defaultIcon;
                    @endphp
                    <div class="flex flex-col gap-2 p-4 bg-gradient-to-br from-{{ $iconData['color'] }}-50 to-{{ $iconData['color'] }}-100/50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-gray-700">{{ $purpose ?: 'Autre' }}</p>
                            <span class="material-symbols-outlined text-{{ $iconData['color'] }}-600">{{ $iconData['icon'] }}</span>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">{{ $data['count'] }}</p>
                        <p class="text-xs text-gray-600">{{ $data['percentage'] }}% du total</p>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-8 text-gray-500">
                        <p>Aucune donnée de motif disponible</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Performance Table -->
        <div class="rounded-xl p-6 bg-white border border-gray-200">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Détails par Période</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Période</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Visites</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Clients</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Taux Conv.</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Durée Moy.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($periodDetails as $period)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $period['period'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-700">{{ $period['visits'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-700">{{ $period['clients'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $convColor = $period['conversion'] >= 70 
                                            ? ['bg' => 'bg-green-100', 'text' => 'text-green-800'] 
                                            : ($period['conversion'] >= 50 
                                                ? ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'] 
                                                : ['bg' => 'bg-orange-100', 'text' => 'text-orange-800']);
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full {{ $convColor['bg'] }} {{ $convColor['text'] }} text-xs font-semibold">
                                        {{ $period['conversion'] }}%
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center text-gray-700">{{ $period['avg_duration'] }} min</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">Aucune donnée disponible</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script>
        function reportFilters() {
            return {
                openModal: false,
                periodType: '{{ $filterData['period_type'] ?? 'month' }}',
                dateFrom: '{{ $filterData['date_from'] ?? '' }}',
                dateTo: '{{ $filterData['date_to'] ?? '' }}',
                compareEnabled: {{ ($filterData['compare'] ?? false) ? 'true' : 'false' }},
                
                getPreviewText() {
                    const labels = {
                        'today': "Données d'aujourd'hui",
                        'last_7_days': "Données des 7 derniers jours",
                        'last_30_days': "Données des 30 derniers jours",
                        'week': "Données de cette semaine",
                        'month': "Données de ce mois",
                        'last_month': "Données du mois dernier",
                        'quarter': "Données de ce trimestre",
                        'year': "Données de cette année",
                        'custom': `Du ${this.dateFrom} au ${this.dateTo}`
                    };
                    
                    let text = labels[this.periodType] || "Sélectionnez une période";
                    
                    if (this.compareEnabled) {
                        text += " (avec comparaison)";
                    }
                    
                    return text;
                }
            }
        }
    </script>
</x-app-layout>
