<x-app-layout>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Nouveau Client</h1>
            <p class="text-base font-normal text-gray-500">Ajoutez un nouveau client à votre base.</p>
        </div>
        <a href="{{ route('clients.index') }}" class="flex h-10 items-center justify-center gap-2 rounded-lg bg-gray-100 px-4 text-gray-700 text-sm font-medium hover:bg-gray-200 transition-colors">
            <span class="material-symbols-outlined" style="font-size: 20px;">arrow_back</span>
            <span>Retour</span>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('clients.store') }}" method="POST" class="flex flex-col gap-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- First Name -->
                <div class="flex flex-col gap-2">
                    <label for="first_name" class="text-sm font-medium text-gray-900">Prénom *</label>
                    <input type="text" 
                           id="first_name" 
                           name="first_name" 
                           value="{{ old('first_name') }}"
                           class="form-input rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                           placeholder="Prénom du client"
                           required>
                    @error('first_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="flex flex-col gap-2">
                    <label for="last_name" class="text-sm font-medium text-gray-900">Nom *</label>
                    <input type="text" 
                           id="last_name" 
                           name="last_name" 
                           value="{{ old('last_name') }}"
                           class="form-input rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                           placeholder="Nom du client"
                           required>
                    @error('last_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company -->
                <div class="flex flex-col gap-2">
                    <label for="company" class="text-sm font-medium text-gray-900">Entreprise *</label>
                    <input type="text" 
                           id="company" 
                           name="company" 
                           value="{{ old('company') }}"
                           class="form-input rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                           placeholder="Nom de l'entreprise"
                           required>
                    @error('company')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="flex flex-col gap-2">
                    <label for="email" class="text-sm font-medium text-gray-900">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           class="form-input rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                           placeholder="email@exemple.com">
                    @error('email')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="flex flex-col gap-2">
                    <label for="phone" class="text-sm font-medium text-gray-900">Téléphone</label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone') }}"
                           class="form-input rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                           placeholder="+221 XX XXX XX XX">
                    @error('phone')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Address -->
            <div class="flex flex-col gap-2">
                <label for="address" class="text-sm font-medium text-gray-900">Adresse</label>
                <textarea id="address" 
                          name="address" 
                          rows="3"
                          class="form-textarea rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                          placeholder="Adresse complète">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('clients.index') }}" class="flex h-12 items-center justify-center rounded-lg bg-gray-100 px-6 text-gray-700 text-sm font-bold hover:bg-gray-200 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="flex h-12 items-center justify-center rounded-lg bg-blue-600 px-6 text-white text-sm font-bold hover:bg-blue-700 transition-colors">
                    Ajouter le client
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
