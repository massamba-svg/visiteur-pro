<x-app-layout>
    <div x-data="usersManager()">
        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div class="flex min-w-72 flex-col gap-2">
                <p class="text-[#0d121b] text-3xl font-black leading-tight tracking-tight">Gestion des Rôles et Utilisateurs</p>
                <p class="text-[#4c669a] text-base font-normal leading-normal">Ajoutez, modifiez et consultez les utilisateurs et leurs permissions.</p>
            </div>
            <a href="{{ route('users.create') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#135bec] text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#135bec]/90 transition-colors">
                <span class="material-symbols-outlined text-base">add</span>
                <span class="truncate">Ajouter un Utilisateur</span>
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        @endif

        <!-- Search and Filter -->
        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
            <div class="flex-grow">
                <form action="{{ route('roles.index') }}" method="GET">
                    <!-- Conserver les filtres actuels -->
                    @if(request('role_filter'))
                        <input type="hidden" name="role_filter" value="{{ request('role_filter') }}">
                    @endif
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
            
            <!-- Bouton Filtres avec Dropdown -->
            <div class="relative">
                <button 
                    @click="showFilters = !showFilters"
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-white text-[#0d121b] border border-[#cfd7e7] gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-gray-50 transition-colors"
                    :class="{ 'border-[#135bec] bg-[#135bec]/5': hasActiveFilters }"
                >
                    <span class="material-symbols-outlined text-base">filter_list</span>
                    <span class="truncate">Filtres</span>
                    <span x-show="hasActiveFilters" class="flex items-center justify-center w-5 h-5 bg-[#135bec] text-white text-xs rounded-full">
                        <span x-text="activeFilterCount"></span>
                    </span>
                </button>
                
                <!-- Dropdown Filtres -->
                <div 
                    x-show="showFilters" 
                    @click.away="showFilters = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-72 bg-white border border-[#cfd7e7] rounded-xl shadow-lg z-50"
                    style="display: none;"
                >
                    <form action="{{ route('roles.index') }}" method="GET">
                        <!-- Conserver la recherche -->
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        
                        <div class="p-4 border-b border-[#cfd7e7]">
                            <h3 class="text-sm font-bold text-[#0d121b] mb-3">Filtrer par rôle</h3>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="role_filter" value="" {{ !request('role_filter') ? 'checked' : '' }} class="text-[#135bec] focus:ring-[#135bec]">
                                    <span class="text-sm text-[#0d121b]">Tous les utilisateurs</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="role_filter" value="no_role" {{ request('role_filter') == 'no_role' ? 'checked' : '' }} class="text-[#135bec] focus:ring-[#135bec]">
                                    <span class="text-sm text-[#0d121b]">Sans rôle</span>
                                </label>
                                @foreach($roles as $role)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="role_filter" value="{{ $role->id }}" {{ request('role_filter') == $role->id ? 'checked' : '' }} class="text-[#135bec] focus:ring-[#135bec]">
                                        <span class="text-sm text-[#0d121b]">{{ $role->name }}</span>
                                        <span class="text-xs text-[#4c669a]">({{ $role->users_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="p-4 border-b border-[#cfd7e7]">
                            <h3 class="text-sm font-bold text-[#0d121b] mb-3">Trier par</h3>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="sort" value="newest" {{ request('sort', 'newest') == 'newest' ? 'checked' : '' }} class="text-[#135bec] focus:ring-[#135bec]">
                                    <span class="text-sm text-[#0d121b]">Plus récent</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="sort" value="oldest" {{ request('sort') == 'oldest' ? 'checked' : '' }} class="text-[#135bec] focus:ring-[#135bec]">
                                    <span class="text-sm text-[#0d121b]">Plus ancien</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="sort" value="name_asc" {{ request('sort') == 'name_asc' ? 'checked' : '' }} class="text-[#135bec] focus:ring-[#135bec]">
                                    <span class="text-sm text-[#0d121b]">Nom (A-Z)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="sort" value="name_desc" {{ request('sort') == 'name_desc' ? 'checked' : '' }} class="text-[#135bec] focus:ring-[#135bec]">
                                    <span class="text-sm text-[#0d121b]">Nom (Z-A)</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="p-4 flex items-center justify-between gap-2">
                            <a href="{{ route('roles.index') }}" class="px-3 py-2 text-sm text-[#4c669a] hover:text-[#0d121b] transition-colors">
                                Réinitialiser
                            </a>
                            <button type="submit" class="px-4 py-2 bg-[#135bec] text-white text-sm font-semibold rounded-lg hover:bg-[#135bec]/90 transition-colors">
                                Appliquer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Barre d'actions groupées (visible quand des utilisateurs sont sélectionnés) -->
        <div 
            x-show="selectedUsers.length > 0" 
            x-transition
            class="mb-4 p-4 bg-[#135bec]/10 border border-[#135bec]/30 rounded-xl flex flex-wrap items-center justify-between gap-4"
        >
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[#135bec]">check_circle</span>
                <span class="text-sm font-medium text-[#0d121b]">
                    <span x-text="selectedUsers.length"></span> utilisateur(s) sélectionné(s)
                </span>
            </div>
            
            <div class="flex items-center gap-2">
                <!-- Assigner un rôle en masse -->
                <div class="relative" x-data="{ showRoleDropdown: false }">
                    <button 
                        @click="showRoleDropdown = !showRoleDropdown"
                        class="flex items-center gap-2 px-3 py-2 bg-white border border-[#cfd7e7] rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors"
                    >
                        <span class="material-symbols-outlined text-base">badge</span>
                        <span>Assigner un rôle</span>
                        <span class="material-symbols-outlined text-base">expand_more</span>
                    </button>
                    
                    <div 
                        x-show="showRoleDropdown" 
                        @click.away="showRoleDropdown = false"
                        x-transition
                        class="absolute left-0 mt-2 w-48 bg-white border border-[#cfd7e7] rounded-lg shadow-lg z-50"
                        style="display: none;"
                    >
                        @foreach($roles as $role)
                            <button 
                                type="button"
                                @click="bulkAssignRole({{ $role->id }}); showRoleDropdown = false"
                                class="w-full px-4 py-2 text-left text-sm hover:bg-[#e7ebf3] transition-colors first:rounded-t-lg last:rounded-b-lg"
                            >
                                {{ $role->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <!-- Supprimer en masse -->
                <button 
                    @click="confirmBulkDelete()"
                    class="flex items-center gap-2 px-3 py-2 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors"
                >
                    <span class="material-symbols-outlined text-base">delete</span>
                    <span>Supprimer</span>
                </button>
                
                <!-- Désélectionner tout -->
                <button 
                    @click="selectedUsers = []; selectAll = false"
                    class="flex items-center gap-2 px-3 py-2 text-[#4c669a] hover:text-[#0d121b] text-sm font-medium transition-colors"
                >
                    <span class="material-symbols-outlined text-base">close</span>
                    <span>Annuler</span>
                </button>
            </div>
        </div>

        <!-- Filtres actifs -->
        @if(request('role_filter') || request('sort'))
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="text-sm text-[#4c669a]">Filtres actifs:</span>
                @if(request('role_filter'))
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-[#135bec]/10 text-[#135bec] text-sm rounded-full">
                        @if(request('role_filter') == 'no_role')
                            Sans rôle
                        @else
                            {{ $roles->firstWhere('id', request('role_filter'))?->name ?? 'Rôle' }}
                        @endif
                        <a href="{{ route('roles.index', array_merge(request()->except('role_filter'))) }}" class="hover:text-[#0d121b]">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </a>
                    </span>
                @endif
                @if(request('sort') && request('sort') != 'newest')
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-[#135bec]/10 text-[#135bec] text-sm rounded-full">
                        @switch(request('sort'))
                            @case('oldest') Plus ancien @break
                            @case('name_asc') Nom (A-Z) @break
                            @case('name_desc') Nom (Z-A) @break
                        @endswitch
                        <a href="{{ route('roles.index', array_merge(request()->except('sort'))) }}" class="hover:text-[#0d121b]">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </a>
                    </span>
                @endif
            </div>
        @endif

        <!-- Table -->
        <div class="w-full">
            <div class="flex overflow-hidden rounded-xl border border-[#cfd7e7] bg-white">
                <table class="w-full">
                    <thead class="border-b border-[#cfd7e7]">
                        <tr class="bg-[#f6f6f8]">
                            <th class="px-4 py-3 text-left w-12">
                                <input 
                                    x-model="selectAll"
                                    @change="toggleSelectAll()"
                                    class="h-5 w-5 rounded-md border-[#cfd7e7] bg-transparent text-[#135bec] checked:bg-[#135bec] checked:border-[#135bec] focus:ring-0 focus:ring-offset-0 cursor-pointer" 
                                    type="checkbox"
                                />
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
                            <tr 
                                class="border-t border-[#cfd7e7] hover:bg-[#e7ebf3]/50 transition-colors"
                                :class="{ 'bg-[#135bec]/5': selectedUsers.includes({{ $user->id }}) }"
                            >
                                <td class="h-[72px] px-4 py-2 text-center">
                                    <input 
                                        type="checkbox"
                                        value="{{ $user->id }}"
                                        x-model.number="selectedUsers"
                                        @change="updateSelectAll()"
                                        class="h-5 w-5 rounded-md border-[#cfd7e7] bg-transparent text-[#135bec] checked:bg-[#135bec] checked:border-[#135bec] focus:ring-0 focus:ring-offset-0 cursor-pointer"
                                    />
                                </td>
                                <td class="h-[72px] px-4 py-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-[#135bec]/20 flex items-center justify-center">
                                            <span class="text-[#135bec] font-semibold text-sm">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                        </div>
                                        <span class="text-[#0d121b] text-sm font-medium leading-normal">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="h-[72px] px-4 py-2 text-[#4c669a] text-sm font-normal leading-normal">{{ $user->email }}</td>
                                <td class="h-[72px] px-4 py-2">
                                    <form action="{{ route('users.assign-role', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <select 
                                            name="role_id" 
                                            class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium border-0 focus:ring-2 focus:ring-[#135bec]/50 cursor-pointer {{ $user->role?->name === 'Administrateur' ? 'bg-[#135bec]/20 text-[#135bec]' : ($user->role ? 'bg-[#e7ebf3] text-[#0d121b]' : 'bg-orange-100 text-orange-700') }}"
                                            onchange="this.form.submit()"
                                        >
                                            <option value="">Aucun rôle</option>
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
                                        <a href="{{ route('users.edit', $user) }}" class="p-2 rounded-md hover:bg-[#e7ebf3] text-[#4c669a] transition-colors" title="Modifier">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-md hover:bg-red-50 text-[#4c669a] hover:text-red-600 transition-colors" title="Supprimer">
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
                                    @if(request('search') || request('role_filter'))
                                        <a href="{{ route('roles.index') }}" class="text-[#135bec] hover:underline mt-2 inline-block">
                                            Effacer les filtres
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination (si vous l'avez) -->
        @if($users->hasPages())
            <div class="mt-4">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif

        <!-- Roles Management Section -->
        <div class="mt-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-[#0d121b]">Rôles disponibles</h2>
            </div>
            <div class="flex flex-wrap gap-3">
                @foreach($roles as $role)
                    <div class="flex items-center gap-2 px-4 py-2 bg-white border border-[#cfd7e7] rounded-lg hover:shadow-sm transition-shadow">
                        <span class="inline-flex items-center rounded-full bg-[#135bec]/20 px-2 py-0.5 text-xs font-medium text-[#135bec]">{{ $role->users_count }}</span>
                        <span class="text-sm font-medium text-[#0d121b]">{{ $role->name }}</span>
                        <a href="{{ route('roles.edit', $role) }}" class="text-[#4c669a] hover:text-[#135bec]" title="Modifier">
                            <span class="material-symbols-outlined text-sm">edit</span>
                        </a>
                        @if($role->users_count == 0)
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce rôle?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#4c669a] hover:text-red-600" title="Supprimer">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Formulaires cachés pour les actions groupées -->
        <form id="bulk-assign-form" action="{{ route('users.bulk-assign-role') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="user_ids" x-bind:value="JSON.stringify(selectedUsers)">
            <input type="hidden" name="role_id" id="bulk-role-id">
        </form>
        
        <form id="bulk-delete-form" action="{{ route('users.bulk-delete') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="user_ids" x-bind:value="JSON.stringify(selectedUsers)">
        </form>
    </div>
    
    <script>
        function usersManager() {
            return {
                showFilters: false,
                selectedUsers: [],
                selectAll: false,
                allUserIds: @json($users->pluck('id')->toArray()),
                
                get hasActiveFilters() {
                    const params = new URLSearchParams(window.location.search);
                    return params.has('role_filter') || (params.has('sort') && params.get('sort') !== 'newest');
                },
                
                get activeFilterCount() {
                    let count = 0;
                    const params = new URLSearchParams(window.location.search);
                    if (params.has('role_filter')) count++;
                    if (params.has('sort') && params.get('sort') !== 'newest') count++;
                    return count;
                },
                
                toggleSelectAll() {
                    if (this.selectAll) {
                        this.selectedUsers = [...this.allUserIds];
                    } else {
                        this.selectedUsers = [];
                    }
                },
                
                updateSelectAll() {
                    this.selectAll = this.selectedUsers.length === this.allUserIds.length && this.allUserIds.length > 0;
                },
                
                bulkAssignRole(roleId) {
                    if (this.selectedUsers.length === 0) {
                        alert('Veuillez sélectionner au moins un utilisateur.');
                        return;
                    }
                    
                    document.getElementById('bulk-role-id').value = roleId;
                    document.getElementById('bulk-assign-form').submit();
                },
                
                confirmBulkDelete() {
                    if (this.selectedUsers.length === 0) {
                        alert('Veuillez sélectionner au moins un utilisateur.');
                        return;
                    }
                    
                    if (confirm(`Êtes-vous sûr de vouloir supprimer ${this.selectedUsers.length} utilisateur(s) ?`)) {
                        document.getElementById('bulk-delete-form').submit();
                    }
                }
            }
        }
    </script>
</x-app-layout>
