<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Client;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Visit::with(['client', 'user'])
                      ->whereNotNull('departure_time')
                      ->orderBy('departure_time', 'desc');

        // Filtre par client
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        // Filtre par motif
        if ($request->filled('reason')) {
            $query->where('reason', $request->reason);
        }

        // Filtre par personne rencontrée
        if ($request->filled('person_met')) {
            $query->where('person_met', 'like', "%{$request->person_met}%");
        }

        // Filtre par date
        if ($request->filled('date_from')) {
            $query->whereDate('arrival_time', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('arrival_time', '<=', $request->date_to);
        }

        $visits = $query->paginate(15);
        $clients = Client::orderBy('last_name')->get();

        return view('history.index', compact('visits', 'clients'));
    }

    /**
     * Afficher le rapport détaillé d'une visite terminée.
     */
    public function show(Visit $visit)
    {
        // S'assurer que la visite est terminée
        if (!$visit->departure_time) {
            return response()->json(['error' => 'Cette visite n\'est pas encore terminée.'], 400);
        }

        $visit->load(['client', 'user']);

        // Calculer la durée de la visite
        $duration = $visit->arrival_time->diff($visit->departure_time);
        $durationFormatted = '';
        if ($duration->h > 0) {
            $durationFormatted .= $duration->h . 'h ';
        }
        $durationFormatted .= $duration->i . 'min';

        // Statistiques du client
        $clientStats = null;
        if ($visit->client) {
            $totalVisits = Visit::where('client_id', $visit->client_id)
                ->whereNotNull('departure_time')
                ->count();
            
            $lastVisit = Visit::where('client_id', $visit->client_id)
                ->whereNotNull('departure_time')
                ->where('id', '!=', $visit->id)
                ->orderBy('departure_time', 'desc')
                ->first();

            $clientStats = [
                'total_visits' => $totalVisits,
                'last_visit' => $lastVisit ? $lastVisit->arrival_time->translatedFormat('d F Y') : null,
            ];
        }

        return response()->json([
            'visit' => [
                'id' => $visit->id,
                'visitor_name' => $visit->visitor_name,
                'client_name' => $visit->client?->full_name ?? '-',
                'client_company' => $visit->client?->company ?? '-',
                'person_met' => $visit->person_met,
                'reason' => $visit->reason,
                'date' => $visit->arrival_time->translatedFormat('d F Y'),
                'arrival_time' => $visit->arrival_time->format('H:i'),
                'departure_time' => $visit->departure_time->format('H:i'),
                'duration' => $durationFormatted,
                'registered_by' => $visit->user?->name ?? '-',
            ],
            'client_stats' => $clientStats,
        ]);
    }
}
