<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Visit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $weekStart = Carbon::now()->startOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();
        $lastMonth = Carbon::now()->subMonth();
        
        // Statistiques actuelles
        $currentVisitors = Visit::whereNull('departure_time')
                                ->whereDate('arrival_time', $today)
                                ->count();
        $yesterdayVisitors = Visit::whereNull('departure_time')
                                  ->whereDate('arrival_time', $yesterday)
                                  ->count();
        
        $todayVisits = Visit::whereDate('arrival_time', $today)->count();
        $yesterdayVisits = Visit::whereDate('arrival_time', $yesterday)->count();
        
        $weekVisits = Visit::where('arrival_time', '>=', $weekStart)->count();
        $lastWeekVisits = Visit::whereBetween('arrival_time', [$lastWeekStart, $lastWeekEnd])->count();
        
        $totalClients = Client::count();
        $lastMonthClients = Client::where('created_at', '<=', $lastMonth)->count();
        
        $totalVisits = Visit::count();
        
        // Calcul des pourcentages
        $currentVisitorsTrend = $yesterdayVisitors > 0 
            ? round((($currentVisitors - $yesterdayVisitors) / $yesterdayVisitors) * 100, 1) 
            : ($currentVisitors > 0 ? 100 : 0);
            
        $todayVisitsTrend = $yesterdayVisits > 0 
            ? round((($todayVisits - $yesterdayVisits) / $yesterdayVisits) * 100, 1) 
            : ($todayVisits > 0 ? 100 : 0);
            
        $weekVisitsTrend = $lastWeekVisits > 0 
            ? round((($weekVisits - $lastWeekVisits) / $lastWeekVisits) * 100, 1) 
            : ($weekVisits > 0 ? 100 : 0);
            
        $clientsTrend = $lastMonthClients > 0 
            ? round((($totalClients - $lastMonthClients) / $lastMonthClients) * 100, 1) 
            : ($totalClients > 0 ? 100 : 0);
        
        $stats = [
            'current_visitors' => $currentVisitors,
            'current_visitors_trend' => $currentVisitorsTrend,
            'today_visits' => $todayVisits,
            'today_visits_trend' => $todayVisitsTrend,
            'week_visits' => $weekVisits,
            'week_visits_trend' => $weekVisitsTrend,
            'total_clients' => $totalClients,
            'clients_trend' => $clientsTrend,
            'total_visits' => $totalVisits,
        ];

        return view('dashboard', compact('stats'));
    }
}
