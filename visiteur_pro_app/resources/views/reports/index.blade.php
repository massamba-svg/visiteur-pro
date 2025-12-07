<x-app-layout>
    <div class="w-full max-w-7xl mx-auto">
        <!-- PageHeading with Export -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Rapports d'Activité</h1>
                <p class="text-base font-normal text-gray-500">Analyse complète des visites et performance</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('reports.export-pdf') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-[#135bec] text-white hover:bg-[#135bec]/90 text-sm font-semibold">
                    <span class="material-symbols-outlined text-lg">download</span>
                    <span>Exporter PDF</span>
                </a>
                <button class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-sm font-semibold">
                    <span class="material-symbols-outlined text-lg">date_range</span>
                    <span>Période</span>
                </button>
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
                    {{ $visitsTrend >= 0 ? '+' : '' }}{{ $visitsTrend }}% vs mois dernier
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
            <!-- Bar Chart -->
            <div class="lg:col-span-2 rounded-xl p-6 bg-white border border-gray-200">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Tendance des Visites (6 derniers mois)</h2>
                <div class="h-64 flex items-end gap-2 justify-around px-4 py-8">
                    @php
                        $maxCount = $monthlyVisits->max('count') ?: 1;
                    @endphp
                    @forelse($monthlyVisits as $month)
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-12 bg-[#135bec] rounded-t transition-all" style="height: {{ ($month['count'] / $maxCount) * 100 }}%"></div>
                            <p class="text-xs font-semibold text-gray-600">{{ $month['month'] }}</p>
                            <p class="text-xs font-medium text-gray-500">{{ $month['count'] }}</p>
                        </div>
                    @empty
                        <div class="flex items-center justify-center w-full h-full text-gray-500">
                            <p>Aucune donnée disponible</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Top Clients -->
            <div class="rounded-xl p-6 bg-white border border-gray-200">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Top 5 Clients</h2>
                <div class="flex flex-col gap-4">
                    @php
                        $colors = ['blue', 'green', 'purple', 'orange', 'red'];
                    @endphp
                    @forelse($topClients as $index => $client)
                        @php
                            $color = $colors[$index] ?? 'gray';
                        @endphp
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <p class="text-sm font-medium text-gray-900">{{ $client->company ?: $client->name }}</p>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-{{ $color }}-100 text-{{ $color }}-800 text-xs font-semibold">
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
                                        $convColor = $period['conversion'] >= 70 ? 'green' : ($period['conversion'] >= 50 ? 'blue' : 'orange');
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-{{ $convColor }}-100 text-{{ $convColor }}-800 text-xs font-semibold">
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
</x-app-layout>
