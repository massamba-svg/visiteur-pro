<x-app-layout>
    <!-- PageHeading -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Gestion des Rôles</h1>
            <p class="text-base font-normal text-gray-500">Gérez les rôles et les permissions des utilisateurs.</p>
        </div>
        <a href="{{ route('roles.create') }}" class="flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-white text-sm font-bold hover:bg-blue-700 transition-colors">
            <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
            <span>Nouveau rôle</span>
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Roles Section -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Rôles disponibles</h2>
            <div class="space-y-4">
                @forelse($roles as $role)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $role->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $role->description ?? 'Aucune description' }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $role->users_count }} utilisateur(s)</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('roles.edit', $role) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                            </a>
                            @if($role->users_count == 0)
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Aucun rôle défini.</p>
                @endforelse
            </div>
        </div>

        <!-- Users Section -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Attribution des rôles</h2>
            <div class="space-y-4">
                @foreach($users as $user)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <form action="{{ route('users.assign-role', $user) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <select name="role_id" class="form-select rounded-lg border border-gray-300 bg-white h-9 px-3 text-sm text-gray-900 focus:border-blue-600" onchange="this.form.submit()">
                                <option value="">-- Aucun rôle --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
