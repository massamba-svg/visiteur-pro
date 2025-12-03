<x-app-layout>
    <!-- Page Heading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
        <p class="text-4xl font-black leading-tight tracking-[-0.033em] min-w-72 text-[#0d121b]">Enregistrement des Visites</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Form -->
        <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em] mb-6">Ajouter une nouvelle visite</h2>
            <form action="{{ route('visits.store') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                <label class="flex flex-col">
                    <p class="text-base font-medium leading-normal pb-2">Nom du Visiteur</p>
                    <input 
                        type="text"
                        name="visitor_name"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-slate-300 bg-[#f6f6f8] h-12 placeholder:text-slate-400 p-3 text-base font-normal leading-normal" 
                        placeholder="Entrez le nom complet"
                        value="{{ old('visitor_name') }}"
                        required
                    />
                </label>
                <label class="flex flex-col">
                    <p class="text-base font-medium leading-normal pb-2">Entreprise (Client)</p>
                    <select 
                        name="client_id"
                        class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-slate-300 bg-[#f6f6f8] h-12 p-3 text-base font-normal leading-normal"
                    >
                        <option value="">Sélectionnez un client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->company ?? $client->full_name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label class="flex flex-col">
                    <p class="text-base font-medium leading-normal pb-2">Personne Rencontrée</p>
                    <input 
                        type="text"
                        name="person_met"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-slate-300 bg-[#f6f6f8] h-12 placeholder:text-slate-400 p-3 text-base font-normal leading-normal" 
                        placeholder="Qui le visiteur vient-il voir ?"
                        value="{{ old('person_met') }}"
                        required
                    />
                </label>
                <label class="flex flex-col">
                    <p class="text-base font-medium leading-normal pb-2">Motif de la Visite</p>
                    <select 
                        name="reason"
                        class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-slate-300 bg-[#f6f6f8] h-12 p-3 text-base font-normal leading-normal"
                        required
                    >
                        <option value="Réunion" {{ old('reason') == 'Réunion' ? 'selected' : '' }}>Réunion</option>
                        <option value="Livraison" {{ old('reason') == 'Livraison' ? 'selected' : '' }}>Livraison</option>
                        <option value="Entretien" {{ old('reason') == 'Entretien' ? 'selected' : '' }}>Entretien</option>
                        <option value="Autre" {{ old('reason') == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </label>
                <label class="flex flex-col">
                    <p class="text-base font-medium leading-normal pb-2">Heure d'Arrivée</p>
                    <input 
                        type="datetime-local"
                        name="arrival_time"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-slate-300 bg-[#f6f6f8] h-12 placeholder:text-slate-400 p-3 text-base font-normal leading-normal" 
                        value="{{ old('arrival_time', now()->format('Y-m-d\TH:i')) }}"
                        required
                    />
                </label>
                <button type="submit" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-[#135bec] text-white gap-2 text-base font-bold leading-normal tracking-[0.015em] mt-4 hover:bg-[#135bec]/90 transition-colors">
                    <span class="material-symbols-outlined">login</span>
                    Enregistrer l'Arrivée
                </button>
            </form>
        </div>

        <!-- Right Column: Table -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em]">Historique des Visites Récentes</h2>
                <div class="flex items-center gap-3">
                    <a href="{{ route('history.index') }}" class="flex items-center justify-center gap-2 cursor-pointer rounded-lg h-10 px-4 bg-[#135bec] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#135bec]/90 transition-colors">
                        <span class="material-symbols-outlined text-lg">history</span>
                        <span class="truncate">Afficher l'historique complet</span>
                    </a>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-end items-start sm:items-center gap-4 mb-6">
                <form action="{{ route('visits.index') }}" method="GET" class="relative w-full sm:w-64">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input 
                        type="text"
                        name="search"
                        class="form-input w-full rounded-lg border border-slate-300 bg-[#f6f6f8] h-10 pl-10 placeholder:text-slate-400 focus:ring-2 focus:ring-[#135bec]/50 focus:outline-none" 
                        placeholder="Rechercher un visiteur..."
                        value="{{ request('search') }}"
                    />
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-200 text-slate-500">
                        <tr>
                            <th class="p-3 font-medium">Nom du Visiteur</th>
                            <th class="p-3 font-medium">Personne Rencontrée</th>
                            <th class="p-3 font-medium">Arrivée</th>
                            <th class="p-3 font-medium">Départ</th>
                            <th class="p-3 font-medium">Statut</th>
                            <th class="p-3 font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visits as $visit)
                            <tr class="border-b border-slate-200">
                                <td class="p-3 font-medium text-gray-900">{{ $visit->visitor_name }}</td>
                                <td class="p-3">{{ $visit->person_met }}</td>
                                <td class="p-3">{{ $visit->arrival_time->format('H:i') }}</td>
                                <td class="p-3">{{ $visit->departure_time ? $visit->departure_time->format('H:i') : '-' }}</td>
                                <td class="p-3">
                                    @if($visit->status === 'en_cours')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800">
                                            <span class="size-2 rounded-full bg-green-500"></span>
                                            En cours
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-800">
                                            <span class="size-2 rounded-full bg-slate-500"></span>
                                            Terminée
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3">
                                    @if($visit->status === 'en_cours')
                                        <form action="{{ route('visits.end', $visit) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-center text-sm font-medium text-[#135bec] hover:text-[#135bec]/80">
                                                Enregistrer le Départ
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-slate-500">
                                    <span class="material-symbols-outlined text-4xl mb-2">calendar_today</span>
                                    <p>Aucune visite enregistrée.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($visits->hasPages())
                <div class="mt-4 pt-4 border-t border-slate-200">
                    {{ $visits->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
