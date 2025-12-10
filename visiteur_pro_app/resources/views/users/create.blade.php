<x-app-layout>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex min-w-72 flex-col gap-2">
            <p class="text-[#0d121b] text-3xl font-black leading-tight tracking-tight">Créer un Utilisateur</p>
            <p class="text-[#4c669a] text-base font-normal leading-normal">Ajoutez un nouvel utilisateur au système avec un rôle spécifique.</p>
        </div>
        <a href="{{ route('roles.index') }}" class="flex items-center gap-2 text-[#135bec] hover:text-[#135bec]/80 text-sm font-medium">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Retour à la liste
        </a>
    </div>

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

    <!-- Form -->
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-[#cfd7e7] p-6">
            <form action="{{ route('users.store') }}" method="POST" class="flex flex-col gap-6">
                @csrf

                <!-- Nom -->
                <label class="flex flex-col gap-2">
                    <p class="text-base font-medium text-[#0d121b]">Nom <span class="text-red-500">*</span></p>
                    <input 
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-[#cfd7e7] bg-white h-12 placeholder:text-[#4c669a] px-4 text-base font-normal leading-normal" 
                        placeholder="Nom de famille"
                        required
                    />
                </label>

                <!-- Prénom -->
                <label class="flex flex-col gap-2">
                    <p class="text-base font-medium text-[#0d121b]">Prénom</p>
                    <input 
                        type="text"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-[#cfd7e7] bg-white h-12 placeholder:text-[#4c669a] px-4 text-base font-normal leading-normal" 
                        placeholder="Prénom"
                    />
                </label>

                <!-- Email -->
                <label class="flex flex-col gap-2">
                    <p class="text-base font-medium text-[#0d121b]">Email <span class="text-red-500">*</span></p>
                    <input 
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-[#cfd7e7] bg-white h-12 placeholder:text-[#4c669a] px-4 text-base font-normal leading-normal" 
                        placeholder="utilisateur@exemple.com"
                        required
                    />
                </label>

                <!-- Rôle -->
                <label class="flex flex-col gap-2">
                    <p class="text-base font-medium text-[#0d121b]">Rôle <span class="text-red-500">*</span></p>
                    <select 
                        name="role_id"
                        class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-[#cfd7e7] bg-white h-12 px-4 text-base font-normal leading-normal"
                        required
                    >
                        <option value="">Sélectionnez un rôle</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <!-- Mot de passe -->
                <label class="flex flex-col gap-2">
                    <p class="text-base font-medium text-[#0d121b]">Mot de passe <span class="text-red-500">*</span></p>
                    <input 
                        type="password"
                        name="password"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-[#cfd7e7] bg-white h-12 placeholder:text-[#4c669a] px-4 text-base font-normal leading-normal" 
                        placeholder="••••••••"
                        required
                    />
                    <p class="text-sm text-[#4c669a]">Minimum 8 caractères</p>
                </label>

                <!-- Confirmation mot de passe -->
                <label class="flex flex-col gap-2">
                    <p class="text-base font-medium text-[#0d121b]">Confirmer le mot de passe <span class="text-red-500">*</span></p>
                    <input 
                        type="password"
                        name="password_confirmation"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-[#cfd7e7] bg-white h-12 placeholder:text-[#4c669a] px-4 text-base font-normal leading-normal" 
                        placeholder="••••••••"
                        required
                    />
                </label>

                <!-- Buttons -->
                <div class="flex gap-3 mt-4">
                    <button 
                        type="submit" 
                        class="flex-1 cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-[#135bec] text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#135bec]/90 transition-colors"
                    >
                        Créer l'utilisateur
                    </button>
                    <a 
                        href="{{ route('roles.index') }}" 
                        class="flex items-center justify-center cursor-pointer overflow-hidden rounded-lg h-12 px-4 bg-white text-[#0d121b] border border-[#cfd7e7] gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-gray-50 transition-colors"
                    >
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
