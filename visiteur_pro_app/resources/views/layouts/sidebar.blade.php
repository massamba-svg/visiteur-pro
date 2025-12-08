<aside class="flex flex-col w-64 h-screen border-r border-gray-200 bg-white shrink-0 sticky top-0">
    <div class="flex h-full flex-col justify-between p-4 overflow-y-auto">
        <div class="flex flex-col gap-4">
            <!-- User Info -->
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBgavw87N5b5LhrSUYDy9ZaUIwrypQG-TlBTEtUv1Vqztmk0Lx1aQry5GmQcRCgKGVIYQxo6zNEfUF_NRPGG38ot5khYQNRj9-FhP41eFi2LjAQy-TBLGWmF0HpfS-HWz_4FFUwQXvuuscEBl5Lus6_2ETKsity1SgmIJ5IYe0EFwMZWUilPTNPeCBAY-1MVW8qOYUcW9AjbmEwzngC0u1CLfu0TykrHorXbuaAjBJgBJ-bxccwDYOmRiMEWcO5xSuxJSNCl2lDBA');"></div>
                <div class="flex flex-col">
                    <h1 class="text-base font-bold text-gray-900">{{ Auth::user()->first_name ?? Auth::user()->name }}</h1>
                    <p class="text-sm text-gray-500">{{ Auth::user()->role?->name ?? 'Utilisateur' }}</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col gap-2 flex-grow">
                {{-- Tableau de Bord - Tous les rôles --}}
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-[#135bec]/10 text-[#135bec]' : 'hover:bg-gray-100' }}" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('dashboard') ? 'fill' : '' }}">dashboard</span>
                    <p class="text-sm font-medium">Tableau de Bord</p>
                </a>

                {{-- Visites / Historique - Tous les rôles --}}
                @if(request()->routeIs('history.*'))
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-[#135bec]/10 text-[#135bec]" href="{{ route('history.index') }}">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">history</span>
                        <p class="text-sm font-medium">Historique des Visites</p>
                    </a>
                @else
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('visits.*') ? 'bg-[#135bec]/10 text-[#135bec]' : 'hover:bg-gray-100' }}" href="{{ route('visits.index') }}">
                        <span class="material-symbols-outlined {{ request()->routeIs('visits.*') ? 'fill' : '' }}">calendar_month</span>
                        <p class="text-sm font-medium">Visites</p>
                    </a>
                @endif

                {{-- Clients - Tous les rôles (consultation) --}}
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('clients.*') ? 'bg-[#135bec]/10 text-[#135bec]' : 'hover:bg-gray-100' }}" href="{{ route('clients.index') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('clients.*') ? 'fill' : '' }}">groups</span>
                    <p class="text-sm font-medium">Clients</p>
                </a>

                {{-- Rapports - Admin et Gestionnaire uniquement --}}
                @if(Auth::user()->canViewReports())
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('reports.*') ? 'bg-[#135bec]/10 text-[#135bec]' : 'hover:bg-gray-100' }}" href="{{ route('reports.index') }}">
                        <span class="material-symbols-outlined {{ request()->routeIs('reports.*') ? 'fill' : '' }}">bar_chart</span>
                        <p class="text-sm font-medium">Rapports</p>
                    </a>
                @endif

                {{-- Gestion des Rôles - Admin uniquement --}}
                @if(Auth::user()->canManageRoles())
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('roles.*') ? 'bg-[#135bec]/10 text-[#135bec]' : 'hover:bg-gray-100' }}" href="{{ route('roles.index') }}">
                        <span class="material-symbols-outlined {{ request()->routeIs('roles.*') ? 'fill' : '' }}">admin_panel_settings</span>
                        <p class="text-sm font-medium">Gestion des Rôles</p>
                    </a>
                @endif
            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="flex flex-col gap-4">
            <!-- Add Visit Button - Tous les rôles -->
            <a href="{{ route('visits.index') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#135bec] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#135bec]/90 transition-colors">
                <span class="truncate">Ajouter une visite</span>
            </a>
            
            <div class="flex flex-col gap-1">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('settings.*') ? 'bg-[#135bec]/10 text-[#135bec]' : 'hover:bg-gray-100' }}" href="{{ route('settings.index') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('settings.*') ? 'fill' : '' }}">settings</span>
                    <p class="text-sm font-medium">Paramètres</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('help.*') ? 'bg-[#135bec]/10 text-[#135bec]' : 'hover:bg-gray-100' }}" href="{{ route('help.index') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('help.*') ? 'fill' : '' }}">help</span>
                    <p class="text-sm font-medium">Aide</p>
                </a>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 w-full text-left">
                    <span class="material-symbols-outlined">logout</span>
                    <p class="text-sm font-medium">Déconnexion</p>
                </button>
            </form>
        </div>
    </div>
</aside>
