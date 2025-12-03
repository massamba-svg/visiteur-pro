<x-app-layout>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex min-w-72 flex-col gap-2">
            <p class="text-[#0d121b] text-3xl font-black leading-tight tracking-tight">Gestion des Rôles et Utilisateurs</p>
            <p class="text-[#4c669a] text-base font-normal leading-normal">Ajoutez, modifiez et consultez les utilisateurs et leurs permissions.</p>
        </div>
        <a href="{{ route('roles.create') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#135bec] text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#135bec]/90 transition-colors">
            <span class="material-symbols-outlined text-base">add</span>
            <span class="truncate">Ajouter un Utilisateur</span>
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
        <div class="flex-grow">
            <form action="{{ route('roles.index') }}" method="GET">
                <label class="flex flex-col min-w-40 h-12 w-full">
                    <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                        <div class="text-[#4c669a] flex border-r-0 border border-[#cfd7e7] bg-white items-center justify-center pl-4 rounded-l-lg">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input 
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d121b] focus:outline-0 focus:ring-2 focus:ring-[#135bec]/50 border border-[#cfd7e7] bg-white h-full placeholder:text-[#4c669a] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" 
                            placeholder="Rechercher un utilisateur par nom ou email..."
                        />
                    </div>
                </label>
            </form>
        </div>
        <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-white text-[#0d121b] border border-[#cfd7e7] gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-gray-50 transition-colors">
            <span class="material-symbols-outlined text-base">filter_list</span>
            <span class="truncate">Filtres</span>
        </button>
    </div>

    <!-- Table -->
    <div class="w-full">
        <div class="flex overflow-hidden rounded-xl border border-[#cfd7e7] bg-white">
            <table class="w-full">
                <thead class="border-b border-[#cfd7e7]">
                    <tr class="bg-[#f6f6f8]">
                        <th class="px-4 py-3 text-left w-12">
                            <input class="h-5 w-5 rounded-md border-[#cfd7e7] bg-transparent text-[#135bec] checked:bg-[#135bec] checked:border-[#135bec] focus:ring-0 focus:ring-offset-0" type="checkbox"/>
                        </th>
                        <th class="px-4 py-3 text-left text-[#0d121b] text-sm font-medium leading-normal">Nom</th>
                        <th class="px-4 py-3 text-left text-[#0d121b] text-sm font-medium leading-normal">Email</th>
                        <th class="px-4 py-3 text-left text-[#0d121b] text-sm font-medium leading-normal">Rôle</th>
                        <th class="px-4 py-3 text-left text-[#0d121b] text-sm font-medium leading-normal">Date de création</th>
                        <th class="px-4 py-3 text-left text-[#4c669a] text-sm font-medium leading-normal">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-t border-[#cfd7e7] hover:bg-[#e7ebf3]/50 transition-colors">
                            <td class="h-[72px] px-4 py-2 text-center">
                                <input class="h-5 w-5 rounded-md border-[#cfd7e7] bg-transparent text-[#135bec] checked:bg-[#135bec] checked:border-[#135bec] focus:ring-0 focus:ring-offset-0" type="checkbox"/>
                            </td>
                            <td class="h-[72px] px-4 py-2 text-[#0d121b] text-sm font-medium leading-normal">{{ $user->name }}</td>
                            <td class="h-[72px] px-4 py-2 text-[#4c669a] text-sm font-normal leading-normal">{{ $user->email }}</td>
                            <td class="h-[72px] px-4 py-2">
                                <form action="{{ route('users.assign-role', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <select 
                                        name="role_id" 
                                        class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium border-0 focus:ring-2 focus:ring-[#135bec]/50 {{ $user->role?->name === 'Administrateur' ? 'bg-[#135bec]/20 text-[#135bec]' : 'bg-[#e7ebf3] text-[#0d121b]' }}"
                                        onchange="this.form.submit()"
                                    >
                                        <option value="">-- Aucun rôle --</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="h-[72px] px-4 py-2 text-[#4c669a] text-sm font-normal leading-normal">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="h-[72px] px-4 py-2">
                                <div class="flex items-center gap-2">
                                    <button class="p-2 rounded-md hover:bg-[#e7ebf3] text-[#4c669a] transition-colors">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </button>
                                    <form action="{{ route('users.assign-role', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="p-2 rounded-md hover:bg-[#e7ebf3] text-[#4c669a] transition-colors">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-[#4c669a]">
                                <span class="material-symbols-outlined text-4xl mb-2">group</span>
                                <p>Aucun utilisateur trouvé.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Roles Management Section (Optional - at the bottom) -->
    <div class="mt-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-[#0d121b]">Rôles disponibles</h2>
            <a href="{{ route('roles.create') }}" class="text-[#135bec] text-sm font-medium hover:underline">+ Créer un rôle</a>
        </div>
        <div class="flex flex-wrap gap-3">
            @foreach($roles as $role)
                <div class="flex items-center gap-2 px-4 py-2 bg-white border border-[#cfd7e7] rounded-lg">
                    <span class="inline-flex items-center rounded-full bg-[#135bec]/20 px-2 py-0.5 text-xs font-medium text-[#135bec]">{{ $role->users_count }}</span>
                    <span class="text-sm font-medium text-[#0d121b]">{{ $role->name }}</span>
                    <a href="{{ route('roles.edit', $role) }}" class="text-[#4c669a] hover:text-[#135bec]">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </a>
                    @if($role->users_count == 0)
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce rôle?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[#4c669a] hover:text-red-600">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
