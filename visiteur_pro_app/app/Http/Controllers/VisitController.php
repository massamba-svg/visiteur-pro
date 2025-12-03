<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $query = Visit::with(['client', 'user'])
                       ->orderBy('arrival_time', 'desc');
        
        // Recherche par nom du visiteur
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('visitor_name', 'like', "%{$search}%");
        }
        
        $visits = $query->paginate(10);
        $clients = Client::orderBy('last_name')->get();
        
        return view('visits.index', compact('visits', 'clients'));
    }

    public function create()
    {
        $clients = Client::orderBy('last_name')->get();
        return view('visits.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'visitor_name' => 'required|string|max:255',
            'client_id' => 'nullable|exists:clients,id',
            'person_met' => 'required|string|max:255',
            'reason' => 'required|string|max:500',
            'arrival_time' => 'required|date',
        ]);

        $validated['status'] = 'en_cours';
        $validated['user_id'] = auth()->id();

        Visit::create($validated);

        return redirect()->route('visits.index')
                         ->with('success', 'Visite enregistrée avec succès.');
    }

    public function show(Visit $visit)
    {
        return view('visits.show', compact('visit'));
    }

    public function edit(Visit $visit)
    {
        $clients = Client::orderBy('last_name')->get();
        return view('visits.edit', compact('visit', 'clients'));
    }

    public function update(Request $request, Visit $visit)
    {
        $validated = $request->validate([
            'visitor_name' => 'required|string|max:255',
            'client_id' => 'nullable|exists:clients,id',
            'person_met' => 'required|string|max:255',
            'reason' => 'required|string|max:500',
            'status' => 'required|in:en_cours,termine',
        ]);

        if ($validated['status'] === 'termine' && !$visit->departure_time) {
            $validated['departure_time'] = Carbon::now();
        }

        $visit->update($validated);

        return redirect()->route('visits.index')
                         ->with('success', 'Visite mise à jour avec succès.');
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();

        return redirect()->route('visits.index')
                         ->with('success', 'Visite supprimée avec succès.');
    }

    public function endVisit(Visit $visit)
    {
        $visit->update([
            'departure_time' => Carbon::now(),
            'status' => 'termine',
        ]);

        return redirect()->back()
                         ->with('success', 'Visite terminée avec succès.');
    }
}
