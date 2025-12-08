<x-app-layout>
    <div x-data="{ 
        period: '{{ $period ?? 'today' }}',
        stats: @js($stats),
        loading: false,
        
        async changePeriod(newPeriod) {
            if (this.period === newPeriod) return;
            
            this.loading = true;
            this.period = newPeriod;
            
            try {
                const response = await fetch(`/dashboard?period=${newPeriod}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (response.ok) {
                    window.location.href = `/dashboard?period=${newPeriod}`;
                }
            } catch (error) {
                console.error('Erreur:', error);
            } finally {
                this.loading = false;
            }
        }
    }">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Tableau de Bord</h1>
                <p class="text-base font-normal text-gray-500">Aperçu des visites clients et des tendances.</p>
            </div>
            
            <!-- Chips Dynamiques -->
            <div class="flex gap-2">
                <button 
                    @click="changePeriod('today')"
                    :class="period === 'today' ? 'bg-[#135bec] text-white' : 'bg-white text-gray-800 hover:bg-gray-50'"
                    class="flex h-9 items-center justify-center gap-x-2 rounded-lg pl-4 pr-3 border border-gray-200 transition-colors"
                    :disabled="loading"
                >
                    <p class="text-sm font-medium">Aujourd'hui</p>
                    <span class="material-symbols-outlined" :class="period === 'today' ? 'text-white' : 'text-gray-500'" style="font-size: 20px;">calendar_today</span>
                </button>
                
                <button 
                    @click="changePeriod('week')"
                    :class="period === 'week' ? 'bg-[#135bec] text-white' : 'bg-white text-gray-800 hover:bg-gray-50'"
                    class="flex h-9 items-center justify-center gap-x-2 rounded-lg pl-4 pr-3 border border-gray-200 transition-colors"
                    :disabled="loading"
                >
                    <p class="text-sm font-medium">Cette semaine</p>
                    <span class="material-symbols-outlined" :class="period === 'week' ? 'text-white' : 'text-gray-500'" style="font-size: 20px;">date_range</span>
                </button>
                
                <button 
                    @click="changePeriod('month')"
                    :class="period === 'month' ? 'bg-[#135bec] text-white' : 'bg-white text-gray-800 hover:bg-gray-50'"
                    class="flex h-9 items-center justify-center gap-x-2 rounded-lg pl-4 pr-3 border border-gray-200 transition-colors"
                    :disabled="loading"
                >
                    <p class="text-sm font-medium">Ce mois</p>
                    <span class="material-symbols-outlined" :class="period === 'month' ? 'text-white' : 'text-gray-500'" style="font-size: 20px;">calendar_month</span>
                </button>
                
                <button 
                    @click="changePeriod('all')"
                    :class="period === 'all' ? 'bg-[#135bec] text-white' : 'bg-white text-gray-800 hover:bg-gray-50'"
                    class="flex h-9 items-center justify-center gap-x-2 rounded-lg pl-4 pr-3 border border-gray-200 transition-colors"
                    :disabled="loading"
                >
                    <p class="text-sm font-medium">Tout</p>
                    <span class="material-symbols-outlined" :class="period === 'all' ? 'text-white' : 'text-gray-500'" style="font-size: 20px;">history</span>
                </button>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div x-show="loading" class="fixed inset-0 bg-black/20 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-4 shadow-xl">
                <span class="material-symbols-outlined text-[#135bec] animate-spin text-4xl">sync</span>
            </div>
        </div>

        <!-- Stats - Affichage dynamique selon le filtre -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Carte 1 : Visiteurs Actuels (toujours affichée) -->
            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200">
                <p class="text-base font-medium text-gray-600">Visiteurs Actuels</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['current_visitors'] ?? 0 }}</p>
                <p class="text-base font-medium {{ $stats['current_visitors_trend'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $stats['current_visitors_trend'] >= 0 ? '+' : '' }}{{ $stats['current_visitors_trend'] }}%
                </p>
            </div>
            
            <!-- Carte 2 : Visites du Jour (affichée si period = 'today' ou 'all') -->
            <div 
                x-show="period === 'today' || period === 'all'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200"
            >
                <p class="text-base font-medium text-gray-600">Visites du Jour</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['today_visits'] ?? 0 }}</p>
                <p class="text-base font-medium {{ $stats['today_visits_trend'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $stats['today_visits_trend'] >= 0 ? '+' : '' }}{{ $stats['today_visits_trend'] }}%
                </p>
            </div>
            
            <!-- Carte 3 : Visites de la Semaine (affichée si period = 'week' ou 'all') -->
            <div 
                x-show="period === 'week' || period === 'all'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200"
            >
                <p class="text-base font-medium text-gray-600">Visites de la Semaine</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['week_visits'] ?? 0 }}</p>
                <p class="text-base font-medium {{ $stats['week_visits_trend'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $stats['week_visits_trend'] >= 0 ? '+' : '' }}{{ $stats['week_visits_trend'] }}%
                </p>
            </div>
            
            <!-- Carte 4 : Visites du Mois (affichée si period = 'month' ou 'all') -->
            <div 
                x-show="period === 'month' || period === 'all'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200"
            >
                <p class="text-base font-medium text-gray-600">Visites du Mois</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['month_visits'] ?? 0 }}</p>
                <p class="text-base font-medium {{ $stats['month_visits_trend'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $stats['month_visits_trend'] >= 0 ? '+' : '' }}{{ $stats['month_visits_trend'] }}%
                </p>
            </div>
            
            <!-- Carte 5 : Total Clients (toujours affichée) -->
            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200">
                <p class="text-base font-medium text-gray-600">Total Clients</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_clients'] ?? 0 }}</p>
                <p class="text-base font-medium {{ $stats['clients_trend'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $stats['clients_trend'] >= 0 ? '+' : '' }}{{ $stats['clients_trend'] }}%
                </p>
            </div>
            
            <!-- Carte 6 : Taux de Conversion (toujours affichée) ✨ NOUVELLE -->
            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white border border-gray-200">
                <div class="flex items-center gap-2">
                    <p class="text-base font-medium text-gray-600">Taux de Conversion</p>
                    <span class="material-symbols-outlined text-purple-500 text-2xl">percent</span>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['conversion_rate'] ?? 0 }}%</p>
                <p class="text-sm font-medium text-gray-500">Visites terminées</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Chart - Tendance Mensuelle -->
            <div class="lg:col-span-2 flex flex-col gap-4 rounded-xl border border-gray-200 p-6 bg-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-base font-bold text-gray-900">Tendance des Visites Mensuelles</p>
                        <p class="text-sm text-gray-500">6 derniers mois</p>
                    </div>
                    <div class="flex gap-1 items-center">
                        <p class="text-4xl font-bold text-gray-900">{{ $stats['total_visits'] ?? 0 }}</p>
                    </div>
                </div>
                
                <div class="flex min-h-[250px] flex-1 flex-col gap-8 py-4">
                    @php
                        $maxMonthlyCount = collect($monthlyVisits)->max('count') ?: 1;
                    @endphp
                    
                    <!-- Graphique SVG Dynamique -->
                    <div class="relative h-full">
                        <svg class="h-full w-full" preserveAspectRatio="none" viewBox="0 0 600 150" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color:#135bec;stop-opacity:0.2" />
                                    <stop offset="100%" style="stop-color:#135bec;stop-opacity:0" />
                                </linearGradient>
                            </defs>
                            
                            @php
                                $points = [];
                                $pathPoints = [];
                                $width = 600;
                                $spacing = $width / (count($monthlyVisits) - 1);
                                
                                foreach ($monthlyVisits as $index => $month) {
                                    $x = $index * $spacing;
                                    $y = 150 - (($month['count'] / $maxMonthlyCount) * 130); // 130 pour garder de la marge
                                    $points[] = "$x,$y";
                                    $pathPoints[] = ($index === 0 ? "M $x $y" : "L $x $y");
                                }
                                
                                $pathLine = implode(' ', $pathPoints);
                                $pathArea = $pathLine . " L " . ($width - $spacing) . " 150 L 0 150 Z";
                            @endphp
                            
                            <!-- Zone remplie -->
                            <path d="{{ $pathArea }}" fill="url(#chartGradient)" />
                            
                            <!-- Ligne -->
                            <path d="{{ $pathLine }}" fill="none" stroke="#135bec" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            
                            <!-- Points -->
                            @foreach ($monthlyVisits as $index => $month)
                                @php
                                    $x = $index * $spacing;
                                    $y = 150 - (($month['count'] / $maxMonthlyCount) * 130);
                                @endphp
                                <circle cx="{{ $x }}" cy="{{ $y }}" r="4" fill="#135bec" />
                            @endforeach
                        </svg>
                    </div>
                    
                    <!-- Labels des mois -->
                    <div class="flex justify-around text-gray-500 text-sm font-bold">
                        @foreach ($monthlyVisits as $month)
                            <div class="text-center">
                                <p>{{ $month['month'] }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $month['count'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Bar Chart - Visites par jour de la semaine -->
            <div class="lg:col-span-1 flex flex-col gap-4 rounded-xl border border-gray-200 p-6 bg-white">
                <p class="text-base font-bold text-gray-900">Visites par Jour</p>
                
                @php
                    $maxWeeklyCount = collect($weeklyVisits)->max('count') ?: 1;
                @endphp
                
                <div class="grid min-h-[250px] grid-flow-col gap-4 grid-rows-[1fr_auto] items-end justify-items-center px-3 pt-6">
                    @foreach ($weeklyVisits as $day)
                        @php
                            $heightPercent = $maxWeeklyCount > 0 
                                ? ($day['count'] / $maxWeeklyCount) * 100 
                                : 0;
                            $bgColor = $day['is_today'] ? 'bg-[#135bec]' : 'bg-[#135bec]/20';
                        @endphp
                        
                        <!-- Barre -->
                        <div 
                            class="{{ $bgColor }} rounded-t w-full transition-all hover:opacity-80 relative group" 
                            style="height: {{ $heightPercent }}%;"
                            title="{{ $day['count'] }} visite(s)"
                        >
                            <!-- Tooltip au survol -->
                            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                {{ $day['count'] }} visite{{ $day['count'] > 1 ? 's' : '' }}
                            </div>
                        </div>
                        
                        <!-- Label -->
                        <p class="text-sm font-bold {{ $day['is_today'] ? 'text-gray-900' : 'text-gray-500' }}">
                            {{ $day['day'] }}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
