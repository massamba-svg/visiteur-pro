<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Visit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Déterminer la période sélectionnée
        $period = $request->get('period', 'today');
        
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $weekStart = Carbon::now()->startOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        $lastMonth = Carbon::now()->subMonth();
        
        // Visiteurs actuels
        $currentVisitors = Visit::whereNull('departure_time')
                                ->whereDate('arrival_time', $today)
                                ->count();
        $yesterdayVisitors = Visit::whereNull('departure_time')
                                 ->whereDate('arrival_time', $yesterday)
                                 ->count();
        $currentVisitorsTrend = $yesterdayVisitors > 0 
            ? round((($currentVisitors - $yesterdayVisitors) / $yesterdayVisitors) * 100, 1) 
            : ($currentVisitors > 0 ? 100 : 0);
        
        // Visites du jour
        $todayVisits = Visit::whereDate('arrival_time', $today)->count();
        $yesterdayVisits = Visit::whereDate('arrival_time', $yesterday)->count();
        $todayVisitsTrend = $yesterdayVisits > 0 
            ? round((($todayVisits - $yesterdayVisits) / $yesterdayVisits) * 100, 1) 
            : ($todayVisits > 0 ? 100 : 0);
        
        // Visites de la semaine
        $weekVisits = Visit::where('arrival_time', '>=', $weekStart)->count();
        $lastWeekVisits = Visit::whereBetween('arrival_time', [$lastWeekStart, $lastWeekEnd])->count();
        $weekVisitsTrend = $lastWeekVisits > 0 
            ? round((($weekVisits - $lastWeekVisits) / $lastWeekVisits) * 100, 1) 
            : ($weekVisits > 0 ? 100 : 0);
        
        // Visites du mois
        $monthVisits = Visit::where('arrival_time', '>=', $monthStart)->count();
        $lastMonthVisits = Visit::whereBetween('arrival_time', [$lastMonthStart, $lastMonthEnd])->count();
        $monthVisitsTrend = $lastMonthVisits > 0 
            ? round((($monthVisits - $lastMonthVisits) / $lastMonthVisits) * 100, 1) 
            : ($monthVisits > 0 ? 100 : 0);
        
        // Total clients
        $totalClients = Client::count();
        $lastMonthClients = Client::where('created_at', '<=', $lastMonth)->count();
        $clientsTrend = $lastMonthClients > 0 
            ? round((($totalClients - $lastMonthClients) / $lastMonthClients) * 100, 1) 
            : ($totalClients > 0 ? 100 : 0);
        
        // Taux de conversion
        $totalVisits = Visit::count();
        $completedVisits = Visit::whereNotNull('departure_time')->count();
        $conversionRate = $totalVisits > 0 ? round(($completedVisits / $totalVisits) * 100) : 0;
        
        // ============================================
        // DONNÉES POUR LES GRAPHIQUES
        // ============================================
        
        // Chart 1: Tendance mensuelle (6 derniers mois)
        $monthlyVisits = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $monthCount = Visit::whereYear('arrival_time', $monthDate->year)
                               ->whereMonth('arrival_time', $monthDate->month)
                               ->count();
            
            $monthlyVisits[] = [
                'month' => $monthDate->translatedFormat('M'),
                'count' => $monthCount,
            ];
        }
        
        // Chart 2: Visites par jour de la semaine (semaine en cours)
        $weeklyVisits = [];
        $daysOfWeek = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        
        for ($i = 0; $i < 7; $i++) {
            $dayDate = Carbon::now()->startOfWeek()->addDays($i);
            $dayCount = Visit::whereDate('arrival_time', $dayDate)->count();
            
            $weeklyVisits[] = [
                'day' => $daysOfWeek[$i],
                'count' => $dayCount,
                'is_today' => $dayDate->isToday(),
            ];
        }
        
        $stats = [
            'current_visitors' => $currentVisitors,
            'current_visitors_trend' => $currentVisitorsTrend,
            
            'today_visits' => $todayVisits,
            'today_visits_trend' => $todayVisitsTrend,
            
            'week_visits' => $weekVisits,
            'week_visits_trend' => $weekVisitsTrend,
            
            'month_visits' => $monthVisits,
            'month_visits_trend' => $monthVisitsTrend,
            
            'total_clients' => $totalClients,
            'clients_trend' => $clientsTrend,
            
            'conversion_rate' => $conversionRate,
            
            'total_visits' => $totalVisits,
        ];

        return view('dashboard', compact('stats', 'period', 'monthlyVisits', 'weeklyVisits'));
    }
}
