<x-app-layout>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Modifier la Visite</h1>
            <p class="text-base font-normal text-gray-500">Modifiez les informations de la visite.</p>
        </div>
        <a href="{{ route('visits.index') }}" class="flex h-10 items-center justify-center gap-2 rounded-lg bg-gray-100 px-4 text-gray-700 text-sm font-medium hover:bg-gray-200 transition-colors">
            <span class="material-symbols-outlined" style="font-size: 20px;">arrow_back</span>
            <span>Retour</span>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('visits.update', $visit) }}" method="POST" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Visitor Name -->
                <div class="flex flex-col gap-2">
                    <label for="visitor_name" class="text-sm font-medium text-gray-900">Nom du visiteur *</label>
                    <input type="text" 
                           id="visitor_name" 
                           name="visitor_name" 
                           value="{{ old('visitor_name', $visit->visitor_name) }}"
                           class="form-input rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                           required>
                    @error('visitor_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Client -->
                <div class="flex flex-col gap-2">
                    <label for="client_id" class="text-sm font-medium text-gray-900">Client (optionnel)</label>
                    <select id="client_id" 
                            name="client_id" 
                            class="form-select rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50">
                        <option value="">-- Sélectionner un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $visit->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->full_name }} {{ $client->company ? '(' . $client->company . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Person Met -->
                <div class="flex flex-col gap-2">
                    <label for="person_met" class="text-sm font-medium text-gray-900">Personne rencontrée *</label>
                    <input type="text" 
                           id="person_met" 
                           name="person_met" 
                           value="{{ old('person_met', $visit->person_met) }}"
                           class="form-input rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                           required>
                    @error('person_met')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="flex flex-col gap-2">
                    <label for="status" class="text-sm font-medium text-gray-900">Statut *</label>
                    <select id="status" 
                            name="status" 
                            class="form-select rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                            required>
                        <option value="en_cours" {{ old('status', $visit->status) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="termine" {{ old('status', $visit->status) == 'termine' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>
            </div>

            <!-- Reason -->
            <div class="flex flex-col gap-2">
                <label for="reason" class="text-sm font-medium text-gray-900">Motif de la visite *</label>
                <textarea id="reason" 
                          name="reason" 
                          rows="4"
                          class="form-textarea rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                          required>{{ old('reason', $visit->reason) }}</textarea>
                @error('reason')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('visits.index') }}" class="flex h-12 items-center justify-center rounded-lg bg-gray-100 px-6 text-gray-700 text-sm font-bold hover:bg-gray-200 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="flex h-12 items-center justify-center rounded-lg bg-blue-600 px-6 text-white text-sm font-bold hover:bg-blue-700 transition-colors">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
