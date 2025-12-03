<x-app-layout>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Modifier le Rôle</h1>
            <p class="text-base font-normal text-gray-500">Modifiez les informations du rôle.</p>
        </div>
        <a href="{{ route('roles.index') }}" class="flex h-10 items-center justify-center gap-2 rounded-lg bg-gray-100 px-4 text-gray-700 text-sm font-medium hover:bg-gray-200 transition-colors">
            <span class="material-symbols-outlined" style="font-size: 20px;">arrow_back</span>
            <span>Retour</span>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 max-w-xl">
        <form action="{{ route('roles.update', $role) }}" method="POST" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="flex flex-col gap-2">
                <label for="name" class="text-sm font-medium text-gray-900">Nom du rôle *</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $role->name) }}"
                       class="form-input rounded-lg border border-gray-300 bg-gray-50 h-12 px-4 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50"
                       required>
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="flex flex-col gap-2">
                <label for="description" class="text-sm font-medium text-gray-900">Description</label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          class="form-textarea rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/50">{{ old('description', $role->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('roles.index') }}" class="flex h-12 items-center justify-center rounded-lg bg-gray-100 px-6 text-gray-700 text-sm font-bold hover:bg-gray-200 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="flex h-12 items-center justify-center rounded-lg bg-blue-600 px-6 text-white text-sm font-bold hover:bg-blue-700 transition-colors">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
