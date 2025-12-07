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
    /**
     * Display the reports page.
     */
    public function index()
    {
        // Total visits
        $totalVisits = Visit::count();
        
        // Active clients (clients with at least one visit)
        $activeClients = Client::whereHas('visits')->count();
        
        // Conversion rate (completed visits / total visits)
        $completedVisits = Visit::whereNotNull('departure_time')->count();
        $conversionRate = $totalVisits > 0 ? round(($completedVisits / $totalVisits) * 100) : 0;
        
        // Average visit duration (in minutes)
        $avgDuration = Visit::whereNotNull('departure_time')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_duration')
            ->value('avg_duration');
        $avgDuration = $avgDuration ? round($avgDuration) : 0;
        
        // Monthly visits for the last 6 months
        $monthlyVisits = Visit::selectRaw('MONTH(arrival_time) as month, YEAR(arrival_time) as year, COUNT(*) as count')
            ->where('arrival_time', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $date = Carbon::createFromDate($item->year, $item->month, 1);
                return [
                    'month' => $date->translatedFormat('M'),
                    'count' => $item->count,
                ];
            });
        
        // Top 5 clients by visit count
        $topClients = Client::withCount('visits')
            ->orderBy('visits_count', 'desc')
            ->take(5)
            ->get();
        
        // Visits by reason (motif)
        $visitsByPurpose = Visit::selectRaw('reason, COUNT(*) as count')
            ->groupBy('reason')
            ->get()
            ->mapWithKeys(function ($item) use ($totalVisits) {
                $percentage = $totalVisits > 0 ? round(($item->count / $totalVisits) * 100, 1) : 0;
                return [$item->reason => [
                    'count' => $item->count,
                    'percentage' => $percentage,
                ]];
            });
        
        // Period details (last 3 months)
        $periodDetails = [];
        for ($i = 0; $i < 3; $i++) {
            $startDate = Carbon::now()->subMonths($i)->startOfMonth();
            $endDate = Carbon::now()->subMonths($i)->endOfMonth();
            
            $periodVisits = Visit::whereBetween('arrival_time', [$startDate, $endDate])->count();
            $periodClients = Visit::whereBetween('arrival_time', [$startDate, $endDate])
                ->distinct('client_id')
                ->count('client_id');
            $periodCompleted = Visit::whereBetween('arrival_time', [$startDate, $endDate])
                ->whereNotNull('departure_time')
                ->count();
            $periodConversion = $periodVisits > 0 ? round(($periodCompleted / $periodVisits) * 100) : 0;
            $periodAvgDuration = Visit::whereBetween('arrival_time', [$startDate, $endDate])
                ->whereNotNull('departure_time')
                ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_duration')
                ->value('avg_duration');
            
            $periodDetails[] = [
                'period' => $startDate->translatedFormat('F Y'),
                'visits' => $periodVisits,
                'clients' => $periodClients,
                'conversion' => $periodConversion,
                'avg_duration' => $periodAvgDuration ? round($periodAvgDuration) : 0,
            ];
        }
        
        // Previous month comparison
        $currentMonthVisits = Visit::whereMonth('arrival_time', Carbon::now()->month)
            ->whereYear('arrival_time', Carbon::now()->year)
            ->count();
        $lastMonthVisits = Visit::whereMonth('arrival_time', Carbon::now()->subMonth()->month)
            ->whereYear('arrival_time', Carbon::now()->subMonth()->year)
            ->count();
        $visitsTrend = $lastMonthVisits > 0 
            ? round((($currentMonthVisits - $lastMonthVisits) / $lastMonthVisits) * 100, 1) 
            : 0;
        
        return view('reports.index', compact(
            'totalVisits',
            'activeClients',
            'conversionRate',
            'avgDuration',
            'monthlyVisits',
            'topClients',
            'visitsByPurpose',
            'periodDetails',
            'visitsTrend'
        ));
    }

    /**
     * Export report to PDF
     */
    public function exportPdf()
    {
        // Get the same data as index
        $totalVisits = Visit::count();
        $activeClients = Client::whereHas('visits')->count();
        $completedVisits = Visit::whereNotNull('departure_time')->count();
        $conversionRate = $totalVisits > 0 ? round(($completedVisits / $totalVisits) * 100) : 0;
        
        $avgDuration = Visit::whereNotNull('departure_time')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_duration')
            ->value('avg_duration');
        $avgDuration = $avgDuration ? round($avgDuration) : 0;
        
        $monthlyVisits = Visit::selectRaw('MONTH(arrival_time) as month, YEAR(arrival_time) as year, COUNT(*) as count')
            ->where('arrival_time', '>=', Carbon::now()->subMonths(6))
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
        
        $topClients = Client::withCount('visits')
            ->orderBy('visits_count', 'desc')
            ->take(5)
            ->get();
        
        $visitsByPurpose = Visit::selectRaw('reason, COUNT(*) as count')
            ->groupBy('reason')
            ->get();

        $pdf = Pdf::loadView('reports.pdf', compact(
            'totalVisits',
            'activeClients',
            'conversionRate',
            'avgDuration',
            'monthlyVisits',
            'topClients',
            'visitsByPurpose'
        ));

        return $pdf->download('rapport-activite-' . now()->format('Y-m-d') . '.pdf');
    }
}
