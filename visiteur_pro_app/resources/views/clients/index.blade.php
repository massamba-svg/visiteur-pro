<x-app-layout>
    <!-- Page Heading -->
    <header class="flex flex-wrap justify-between gap-4 items-center mb-8">
        <div class="flex min-w-72 flex-col">
            <h1 class="text-gray-900 text-4xl font-black leading-tight tracking-[-0.033em]">Gestion des Clients</h1>
            <p class="text-gray-500 text-base font-normal leading-normal mt-1">Ajouter, modifier, et consulter les clients et leurs visites.</p>
        </div>
    </header>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-12 gap-6">
        <!-- Left Column: Client List -->
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white rounded-xl border border-gray-200 h-full">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-gray-900 text-lg font-bold">Liste des Clients</h2>
                </div>
                <div class="p-4">
                    <!-- SearchBar -->
                    <form action="{{ route('clients.index') }}" method="GET">
                        <label class="flex flex-col min-w-40 h-11 w-full">
                            <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                <div class="text-gray-500 flex bg-gray-100 items-center justify-center pl-3.5 rounded-l-lg border-y border-l border-gray-200">
                                    <span class="material-symbols-outlined">search</span>
                                </div>
                                <input 
                                    type="text"
                                    name="search"
                                    class="flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-gray-900 focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border-y border-r border-gray-200 bg-gray-100 focus:border-[#135bec]/50 h-full placeholder:text-gray-500 px-3 pl-2 text-sm font-normal leading-normal" 
                                    placeholder="Rechercher par nom, entreprise..." 
                                    value="{{ request('search') }}"
                                />
                            </div>
                        </label>
                    </form>
                    <!-- Add Client Button -->
                    <a href="{{ route('clients.create') }}" class="flex w-full mt-4 min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#135bec] text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="material-symbols-outlined text-base">add</span>
                        <span class="truncate">Ajouter un Client</span>
                    </a>
                </div>
                <!-- Client List -->
                <div class="px-2 pb-2 flex flex-col gap-1 max-h-[calc(100vh-320px)] overflow-y-auto">
                    @forelse($clients as $client)
                        <a 
                            href="{{ route('clients.index', ['selected' => $client->id, 'search' => request('search')]) }}" 
                            class="p-3 rounded-lg cursor-pointer {{ request('selected') == $client->id ? 'bg-[#135bec]/10' : 'hover:bg-gray-100' }}"
                        >
                            <p class="font-{{ request('selected') == $client->id ? 'semibold' : 'medium' }} text-sm {{ request('selected') == $client->id ? 'text-[#135bec]' : 'text-gray-800' }}">
                                {{ $client->first_name }} {{ $client->last_name }}
                            </p>
                            <p class="text-xs {{ request('selected') == $client->id ? 'text-[#135bec]/80' : 'text-gray-500' }}">
                                {{ $client->company ?? 'Sans entreprise' }}
                            </p>
                        </a>
                    @empty
                        <div class="p-4 text-center text-gray-500 text-sm">
                            Aucun client trouvé.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column: Client Details -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-xl border border-gray-200">
                @php
                    $selectedClient = request('selected') ? $clients->firstWhere('id', request('selected')) : $clients->first();
                @endphp

                @if($selectedClient)
                    <!-- Section Header -->
                    <div class="flex justify-between items-center p-4 border-b border-gray-200">
                        <h2 class="text-gray-900 text-lg font-bold">Détails de {{ $selectedClient->first_name }} {{ $selectedClient->last_name }}</h2>
                        <div class="flex gap-2">
                            <a href="{{ route('clients.edit', $selectedClient) }}" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-[#135bec]/10 text-[#135bec] gap-2 text-sm font-bold leading-normal tracking-[0.015em]">
                                <span class="material-symbols-outlined text-base">edit</span>
                                <span class="truncate">Modifier</span>
                            </a>
                            <form action="{{ route('clients.destroy', $selectedClient) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-red-100 text-red-600 gap-2 text-sm font-bold leading-normal tracking-[0.015em]">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                    <span class="truncate">Supprimer</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="border-b border-gray-200">
                        <nav aria-label="Tabs" class="flex gap-6 -mb-px px-4">
                            <a 
                                href="{{ route('clients.index', ['selected' => $selectedClient->id, 'tab' => 'info']) }}"
                                class="shrink-0 border-b-2 {{ request('tab', 'info') == 'info' ? 'border-[#135bec] text-[#135bec] font-bold' : 'border-transparent text-gray-500 font-medium hover:border-gray-300 hover:text-gray-700' }} px-1 py-3 text-sm"
                            >
                                Informations du Client
                            </a>
                            <a 
                                href="{{ route('clients.index', ['selected' => $selectedClient->id, 'tab' => 'history']) }}"
                                class="shrink-0 border-b-2 {{ request('tab') == 'history' ? 'border-[#135bec] text-[#135bec] font-bold' : 'border-transparent text-gray-500 font-medium hover:border-gray-300 hover:text-gray-700' }} px-1 py-3 text-sm"
                            >
                                Historique des Visites
                            </a>
                        </nav>
                    </div>

                    @if(request('tab', 'info') == 'info')
                        <!-- Client Info Form -->
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="nom">Nom</label>
                                <input class="mt-1 block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-[#135bec] focus:ring-[#135bec] sm:text-sm" id="nom" readonly type="text" value="{{ $selectedClient->last_name }}"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="prenom">Prénom</label>
                                <input class="mt-1 block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-[#135bec] focus:ring-[#135bec] sm:text-sm" id="prenom" readonly type="text" value="{{ $selectedClient->first_name }}"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="telephone">Téléphone</label>
                                <input class="mt-1 block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-[#135bec] focus:ring-[#135bec] sm:text-sm" id="telephone" readonly type="tel" value="{{ $selectedClient->phone ?? 'Non renseigné' }}"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                                <input class="mt-1 block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-[#135bec] focus:ring-[#135bec] sm:text-sm" id="email" readonly type="email" value="{{ $selectedClient->email ?? 'Non renseigné' }}"/>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700" for="entreprise">Entreprise</label>
                                <input class="mt-1 block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-[#135bec] focus:ring-[#135bec] sm:text-sm" id="entreprise" readonly type="text" value="{{ $selectedClient->company ?? 'Non renseigné' }}"/>
                            </div>
                            @if($selectedClient->address)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700" for="adresse">Adresse</label>
                                <input class="mt-1 block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-[#135bec] focus:ring-[#135bec] sm:text-sm" id="adresse" readonly type="text" value="{{ $selectedClient->address }}"/>
                            </div>
                            @endif
                        </div>
                    @else
                        <!-- Visit History Tab -->
                        <div class="p-6">
                            @php
                                $clientVisits = $selectedClient->visits()->orderBy('arrival_time', 'desc')->get();
                            @endphp

                            @if($clientVisits->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <thead>
                                            <tr class="border-b border-gray-200">
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visiteur</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure d'arrivée</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure de départ</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motif</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($clientVisits as $visit)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $visit->visitor_name }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $visit->arrival_time->format('d/m/Y') }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $visit->arrival_time->format('H:i') }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $visit->departure_time ? $visit->departure_time->format('H:i') : '-' }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $visit->reason }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <span class="material-symbols-outlined text-4xl mb-2">calendar_today</span>
                                    <p>Aucune visite enregistrée pour ce client.</p>
                                </div>
                            @endif
                        </div>
                    @endif
                @else
                    <!-- No client selected / empty state -->
                    <div class="p-12 text-center text-gray-500">
                        <span class="material-symbols-outlined text-5xl mb-4">group</span>
                        <p class="text-lg">Aucun client sélectionné</p>
                        <p class="text-sm mt-1">Sélectionnez un client dans la liste ou ajoutez-en un nouveau.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
