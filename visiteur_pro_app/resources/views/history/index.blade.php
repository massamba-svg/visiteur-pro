<x-app-layout>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Historique des Visites</h1>
            <p class="text-base font-normal text-gray-500">Consultez l'historique complet des visites terminées.</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <form action="{{ route('history.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex flex-col gap-2 flex-1 min-w-[200px]">
                <label for="search" class="text-sm font-medium text-gray-700">Recherche</label>
                <input type="text" 
                       id="search" 
                       name="search" 
                       value="{{ request('search') }}"
                       class="form-input rounded-lg border border-gray-300 bg-gray-50 h-10 px-4 text-gray-900 focus:border-blue-600"
                       placeholder="Nom, motif...">
            </div>
            <div class="flex flex-col gap-2">
                <label for="date_from" class="text-sm font-medium text-gray-700">Du</label>
                <input type="date" 
                       id="date_from" 
                       name="date_from" 
                       value="{{ request('date_from') }}"
                       class="form-input rounded-lg border border-gray-300 bg-gray-50 h-10 px-4 text-gray-900 focus:border-blue-600">
            </div>
            <div class="flex flex-col gap-2">
                <label for="date_to" class="text-sm font-medium text-gray-700">Au</label>
                <input type="date" 
                       id="date_to" 
                       name="date_to" 
                       value="{{ request('date_to') }}"
                       class="form-input rounded-lg border border-gray-300 bg-gray-50 h-10 px-4 text-gray-900 focus:border-blue-600">
            </div>
            <button type="submit" class="flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-white text-sm font-bold hover:bg-blue-700 transition-colors">
                <span class="material-symbols-outlined" style="font-size: 18px;">search</span>
                Filtrer
            </button>
            @if(request()->hasAny(['search', 'date_from', 'date_to']))
                <a href="{{ route('history.index') }}" class="flex h-10 items-center justify-center rounded-lg bg-gray-100 px-4 text-gray-700 text-sm font-medium hover:bg-gray-200 transition-colors">
                    Réinitialiser
                </a>
            @endif
        </form>
    </div>

    <!-- History Table -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visiteur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Personne rencontrée</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motif</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrivée</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Départ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($visits as $visit)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $visit->visitor_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $visit->client?->full_name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $visit->person_met }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                            {{ $visit->reason }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $visit->arrival_time->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $visit->departure_time->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $visit->arrival_time->diff($visit->departure_time)->format('%Hh %Im') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl mb-2">history</span>
                            <p>Aucune visite dans l'historique.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $visits->withQueryString()->links() }}
    </div>
</x-app-layout>
