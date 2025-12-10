<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les dates de filtrage
        $periodType = $request->get('period_type', 'month'); // today, week, month, quarter, year, custom
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $compareEnabled = $request->boolean('compare', false);
        
        // Calculer les dates selon le type de période
        $dates = $this->calculatePeriodDates($periodType, $dateFrom, $dateTo);
        $startDate = $dates['start'];
        $endDate = $dates['end'];
        $previousStartDate = $dates['previous_start'];
        $previousEndDate = $dates['previous_end'];
        $periodLabel = $dates['label'];
        
        // Total visits pour la période
        $totalVisits = Visit::whereBetween('arrival_time', [$startDate, $endDate])->count();
        $previousTotalVisits = Visit::whereBetween('arrival_time', [$previousStartDate, $previousEndDate])->count();
        
        // Active clients
        $activeClients = Client::whereHas('visits', function($query) use ($startDate, $endDate) {
            $query->whereBetween('arrival_time', [$startDate, $endDate]);
        })->count();
        
        // Conversion rate
        $completedVisits = Visit::whereBetween('arrival_time', [$startDate, $endDate])
            ->whereNotNull('departure_time')
            ->count();
        $conversionRate = $totalVisits > 0 ? round(($completedVisits / $totalVisits) * 100) : 0;
        
        // Average duration
        $avgDuration = Visit::whereBetween('arrival_time', [$startDate, $endDate])
            ->whereNotNull('departure_time')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_duration')
            ->value('avg_duration');
        $avgDuration = $avgDuration ? round($avgDuration) : 0;
        
        // Visits trend
        $visitsTrend = $previousTotalVisits > 0 
            ? round((($totalVisits - $previousTotalVisits) / $previousTotalVisits) * 100, 1) 
            : ($totalVisits > 0 ? 100 : 0);
        
        // Monthly visits (adapté à la période)
        $monthlyVisits = $this->getVisitsByPeriod($startDate, $endDate);
        
        // Top clients
        $topClients = Client::withCount(['visits' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('arrival_time', [$startDate, $endDate]);
        }])
            ->having('visits_count', '>', 0)
            ->orderBy('visits_count', 'desc')
            ->take(5)
            ->get();
        
        // Visits by purpose
        $visitsByPurpose = Visit::whereBetween('arrival_time', [$startDate, $endDate])
            ->selectRaw('reason, COUNT(*) as count')
            ->groupBy('reason')
            ->get()
            ->mapWithKeys(function ($item) use ($totalVisits) {
                $percentage = $totalVisits > 0 ? round(($item->count / $totalVisits) * 100, 1) : 0;
                return [$item->reason => [
                    'count' => $item->count,
                    'percentage' => $percentage,
                ]];
            });
        
        // Period details
        $periodDetails = $this->getPeriodDetails($startDate, $endDate);
        
        // Données de comparaison (si activée)
        $comparisonData = null;
        if ($compareEnabled) {
            $comparisonData = [
                'total_visits' => $previousTotalVisits,
                'period_label' => $this->getPreviousPeriodLabel($periodType, $previousStartDate, $previousEndDate),
            ];
        }
        
        // Données du filtre pour la vue
        $filterData = [
            'period_type' => $periodType,
            'date_from' => $startDate->format('Y-m-d'),
            'date_to' => $endDate->format('Y-m-d'),
            'compare' => $compareEnabled,
            'period_label' => $periodLabel,
            'days_count' => $startDate->diffInDays($endDate) + 1,
        ];

        return view('reports.index', compact(
            'totalVisits',
            'activeClients',
            'conversionRate',
            'avgDuration',
            'monthlyVisits',
            'topClients',
            'visitsByPurpose',
            'periodDetails',
            'visitsTrend',
            'filterData',
            'comparisonData'
        ));
    }
    
    private function calculatePeriodDates($periodType, $dateFrom = null, $dateTo = null)
    {
        $now = Carbon::now();
        
        switch ($periodType) {
            case 'today':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                $previousStart = $now->copy()->subDay()->startOfDay();
                $previousEnd = $now->copy()->subDay()->endOfDay();
                $label = "Aujourd'hui";
                break;
                
            case 'week':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                $previousStart = $now->copy()->subWeek()->startOfWeek();
                $previousEnd = $now->copy()->subWeek()->endOfWeek();
                $label = "Cette semaine";
                break;
                
            case 'month':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $previousStart = $now->copy()->subMonth()->startOfMonth();
                $previousEnd = $now->copy()->subMonth()->endOfMonth();
                $label = "Ce mois";
                break;
                
            case 'quarter':
                $start = $now->copy()->startOfQuarter();
                $end = $now->copy()->endOfQuarter();
                $previousStart = $now->copy()->subQuarter()->startOfQuarter();
                $previousEnd = $now->copy()->subQuarter()->endOfQuarter();
                $label = "Ce trimestre";
                break;
                
            case 'year':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                $previousStart = $now->copy()->subYear()->startOfYear();
                $previousEnd = $now->copy()->subYear()->endOfYear();
                $label = "Cette année";
                break;
                
            case 'last_7_days':
                $start = $now->copy()->subDays(6)->startOfDay();
                $end = $now->copy()->endOfDay();
                $previousStart = $now->copy()->subDays(13)->startOfDay();
                $previousEnd = $now->copy()->subDays(7)->endOfDay();
                $label = "7 derniers jours";
                break;
                
            case 'last_30_days':
                $start = $now->copy()->subDays(29)->startOfDay();
                $end = $now->copy()->endOfDay();
                $previousStart = $now->copy()->subDays(59)->startOfDay();
                $previousEnd = $now->copy()->subDays(30)->endOfDay();
                $label = "30 derniers jours";
                break;
                
            case 'last_month':
                $start = $now->copy()->subMonth()->startOfMonth();
                $end = $now->copy()->subMonth()->endOfMonth();
                $previousStart = $now->copy()->subMonths(2)->startOfMonth();
                $previousEnd = $now->copy()->subMonths(2)->endOfMonth();
                $label = "Mois dernier";
                break;
                
            case 'custom':
                $start = $dateFrom ? Carbon::parse($dateFrom)->startOfDay() : $now->copy()->startOfMonth();
                $end = $dateTo ? Carbon::parse($dateTo)->endOfDay() : $now->copy()->endOfDay();
                $daysDiff = $start->diffInDays($end);
                $previousStart = $start->copy()->subDays($daysDiff + 1);
                $previousEnd = $start->copy()->subDay();
                $label = $start->format('d/m/Y') . ' - ' . $end->format('d/m/Y');
                break;
                
            default:
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $previousStart = $now->copy()->subMonth()->startOfMonth();
                $previousEnd = $now->copy()->subMonth()->endOfMonth();
                $label = "Ce mois";
        }
        
        return [
            'start' => $start,
            'end' => $end,
            'previous_start' => $previousStart,
            'previous_end' => $previousEnd,
            'label' => $label,
        ];
    }
    
    private function getVisitsByPeriod($startDate, $endDate)
    {
        $daysDiff = $startDate->diffInDays($endDate);
        
        if ($daysDiff <= 7) {
            // Par jour
            return Visit::whereBetween('arrival_time', [$startDate, $endDate])
                ->selectRaw('DATE(arrival_time) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->map(function ($item) {
                    return [
                        'month' => Carbon::parse($item->date)->translatedFormat('D d'),
                        'count' => $item->count,
                    ];
                });
        } elseif ($daysDiff <= 60) {
            // Par semaine
            return Visit::whereBetween('arrival_time', [$startDate, $endDate])
                ->selectRaw('YEARWEEK(arrival_time) as week, MIN(arrival_time) as week_start, COUNT(*) as count')
                ->groupBy('week')
                ->orderBy('week')
                ->get()
                ->map(function ($item) {
                    return [
                        'month' => 'Sem. ' . Carbon::parse($item->week_start)->weekOfYear,
                        'count' => $item->count,
                    ];
                });
        } else {
            // Par mois
            return Visit::whereBetween('arrival_time', [$startDate, $endDate])
                ->selectRaw('MONTH(arrival_time) as month, YEAR(arrival_time) as year, COUNT(*) as count')
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get()
                ->map(function ($item) {
                    $date = Carbon::createFromDate($item->year, $item->month, 1);
                    return [
                        'month' => $date->translatedFormat('M Y'),
                        'count' => $item->count,
                    ];
                });
        }
    }
    
    private function getPeriodDetails($startDate, $endDate)
    {
        $details = [];
        $daysDiff = $startDate->diffInDays($endDate);
        
        if ($daysDiff <= 31) {
            // Par semaine pour les périodes courtes
            $currentDate = $startDate->copy();
            while ($currentDate <= $endDate) {
                $weekEnd = $currentDate->copy()->endOfWeek()->min($endDate);
                
                $periodVisits = Visit::whereBetween('arrival_time', [$currentDate, $weekEnd])->count();
                $periodClients = Visit::whereBetween('arrival_time', [$currentDate, $weekEnd])
                    ->distinct('client_id')
                    ->count('client_id');
                $periodCompleted = Visit::whereBetween('arrival_time', [$currentDate, $weekEnd])
                    ->whereNotNull('departure_time')
                    ->count();
                $periodConversion = $periodVisits > 0 ? round(($periodCompleted / $periodVisits) * 100) : 0;
                $periodAvgDuration = Visit::whereBetween('arrival_time', [$currentDate, $weekEnd])
                    ->whereNotNull('departure_time')
                    ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_duration')
                    ->value('avg_duration');
                
                $details[] = [
                    'period' => 'Semaine du ' . $currentDate->format('d/m'),
                    'visits' => $periodVisits,
                    'clients' => $periodClients,
                    'conversion' => $periodConversion,
                    'avg_duration' => $periodAvgDuration ? round($periodAvgDuration) : 0,
                ];
                
                $currentDate = $weekEnd->copy()->addDay();
            }
        } else {
            // Par mois pour les périodes longues
            $currentDate = $startDate->copy()->startOfMonth();
            while ($currentDate <= $endDate) {
                $monthEnd = $currentDate->copy()->endOfMonth()->min($endDate);
                $monthStart = $currentDate->copy()->max($startDate);
                
                $periodVisits = Visit::whereBetween('arrival_time', [$monthStart, $monthEnd])->count();
                $periodClients = Visit::whereBetween('arrival_time', [$monthStart, $monthEnd])
                    ->distinct('client_id')
                    ->count('client_id');
                $periodCompleted = Visit::whereBetween('arrival_time', [$monthStart, $monthEnd])
                    ->whereNotNull('departure_time')
                    ->count();
                $periodConversion = $periodVisits > 0 ? round(($periodCompleted / $periodVisits) * 100) : 0;
                $periodAvgDuration = Visit::whereBetween('arrival_time', [$monthStart, $monthEnd])
                    ->whereNotNull('departure_time')
                    ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_duration')
                    ->value('avg_duration');
                
                $details[] = [
                    'period' => $currentDate->translatedFormat('F Y'),
                    'visits' => $periodVisits,
                    'clients' => $periodClients,
                    'conversion' => $periodConversion,
                    'avg_duration' => $periodAvgDuration ? round($periodAvgDuration) : 0,
                ];
                
                $currentDate = $currentDate->addMonth();
            }
        }
        
        return array_slice($details, 0, 6); // Limiter à 6 entrées
    }
    
    private function getPreviousPeriodLabel($periodType, $start, $end)
    {
        return $start->format('d/m/Y') . ' - ' . $end->format('d/m/Y');
    }

    public function exportPdf(Request $request)
    {
        // Utiliser les mêmes filtres que index
        $periodType = $request->get('period_type', 'month');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        
        // Calculer les dates selon le type de période
        $dates = $this->calculatePeriodDates($periodType, $dateFrom, $dateTo);
        $startDate = $dates['start'];
        $endDate = $dates['end'];
        $periodLabel = $dates['label'];
        
        // Total visits pour la période
        $totalVisits = Visit::whereBetween('arrival_time', [$startDate, $endDate])->count();
        
        // Active clients
        $activeClients = Client::whereHas('visits', function($query) use ($startDate, $endDate) {
            $query->whereBetween('arrival_time', [$startDate, $endDate]);
        })->count();
        
        // Conversion rate
        $completedVisits = Visit::whereBetween('arrival_time', [$startDate, $endDate])
            ->whereNotNull('departure_time')
            ->count();
        $conversionRate = $totalVisits > 0 ? round(($completedVisits / $totalVisits) * 100) : 0;
        
        // Average duration
        $avgDuration = Visit::whereBetween('arrival_time', [$startDate, $endDate])
            ->whereNotNull('departure_time')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_duration')
            ->value('avg_duration');
        $avgDuration = $avgDuration ? round($avgDuration) : 0;
        
        // Visits par période (dynamique selon la durée)
        $monthlyVisits = $this->getVisitsByPeriod($startDate, $endDate);
        
        // Top clients pour la période
        $topClients = Client::withCount(['visits' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('arrival_time', [$startDate, $endDate]);
        }])
            ->having('visits_count', '>', 0)
            ->orderBy('visits_count', 'desc')
            ->take(5)
            ->get();
        
        // Visits by purpose pour la période
        $visitsByPurpose = Visit::whereBetween('arrival_time', [$startDate, $endDate])
            ->selectRaw('reason, COUNT(*) as count')
            ->groupBy('reason')
            ->get();

        $pdf = PDF::loadView('reports.pdf', compact(
            'totalVisits',
            'activeClients',
            'conversionRate',
            'avgDuration',
            'monthlyVisits',
            'topClients',
            'visitsByPurpose',
            'periodLabel',
            'startDate',
            'endDate'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('rapport-activite-' . $periodType . '-' . now()->format('Y-m-d') . '.pdf');
    }
}
