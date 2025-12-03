<aside class="flex flex-col w-64 border-r border-gray-200 bg-white">
    <div class="flex h-full min-h-0 flex-col justify-between p-4">
        <div class="flex flex-col gap-4">
            <!-- User Info -->
            <div class="flex items-center gap-3">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAuzkd-DLOCj6T6EfMTd56b70R7eo5vl3MgpNBMv1Px3sQadDxhgnpcK9t4Clvqk2bImJGZQzhX-45rH_5M2WUv766eNq-3g_VNdNQn3ktIGKRDGc8immxUyLzYAJw4JdcdcwpqbNdpKifFfZ5OUK3e4psuci-OafzZTIagAIoD_65_deDRxbujnti3S0MFbCcLygaiYn97Wzwun_M9SBRknVghPvxTkHF2AMWEc5sglq7s0-zenH1Rp2AP5LfUfnHMmUK0NvCNzA');"></div>
                <div class="flex flex-col">
                    <h1 class="text-gray-900 text-base font-medium leading-normal">{{ Auth::user()->first_name ?? Auth::user()->name }}</h1>
                    <p class="text-gray-500 text-sm font-normal leading-normal">{{ Auth::user()->role?->name ?? 'Manager' }}</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col gap-2 mt-4">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-[#135bec]/10' : 'text-gray-700 hover:bg-gray-100' }}" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('dashboard') ? 'font-bold text-[#135bec]' : 'text-gray-900' }}">dashboard</span>
                    <p class="text-sm {{ request()->routeIs('dashboard') ? 'font-bold text-[#135bec]' : 'font-medium' }}">Tableau de bord</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('clients.*') ? 'bg-[#135bec]/10' : 'text-gray-700 hover:bg-gray-100' }}" href="{{ route('clients.index') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('clients.*') ? 'font-bold text-[#135bec]' : 'text-gray-900' }}">group</span>
                    <p class="text-sm {{ request()->routeIs('clients.*') ? 'font-bold text-[#135bec]' : 'font-medium' }}">Clients</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('visits.*') ? 'bg-[#135bec]/10' : 'text-gray-700 hover:bg-gray-100' }}" href="{{ route('visits.index') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('visits.*') ? 'font-bold text-[#135bec]' : 'text-gray-900' }}">calendar_today</span>
                    <p class="text-sm {{ request()->routeIs('visits.*') ? 'font-bold text-[#135bec]' : 'font-medium' }}">Visites</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('history.*') ? 'bg-[#135bec]/10' : 'text-gray-700 hover:bg-gray-100' }}" href="{{ route('history.index') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('history.*') ? 'font-bold text-[#135bec]' : 'text-gray-900' }}">bar_chart</span>
                    <p class="text-sm {{ request()->routeIs('history.*') ? 'font-bold text-[#135bec]' : 'font-medium' }}">Rapports</p>
                </a>
            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="flex flex-col gap-1">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">
                <span class="material-symbols-outlined text-gray-900">settings</span>
                <p class="text-sm font-medium">Paramètres</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100" href="#">
                <span class="material-symbols-outlined text-gray-900">help</span>
                <p class="text-sm font-medium">Aide</p>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 w-full text-left">
                    <span class="material-symbols-outlined text-gray-900">logout</span>
                    <p class="text-sm font-medium">Déconnexion</p>
                </button>
            </form>
        </div>
    </div>
</aside>
