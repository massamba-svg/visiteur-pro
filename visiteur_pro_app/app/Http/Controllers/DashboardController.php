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
        $weekStart = Carbon::now()->startOfWeek();
        
        $stats = [
            'current_visitors' => Visit::whereNull('departure_time')
                                       ->whereDate('arrival_time', $today)
                                       ->count(),
            'today_visits' => Visit::whereDate('arrival_time', $today)->count(),
            'week_visits' => Visit::where('arrival_time', '>=', $weekStart)->count(),
            'total_clients' => Client::count(),
            'total_visits' => Visit::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
