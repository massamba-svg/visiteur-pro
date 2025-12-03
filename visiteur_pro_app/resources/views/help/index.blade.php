<x-app-layout>
    <div class="w-full max-w-4xl mx-auto" x-data="{ openSection: null }">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Centre d'Aide</h1>
            <p class="text-base font-normal text-gray-500 mt-2">Trouvez les réponses à vos questions</p>
        </div>

        <!-- Search Box -->
        <div class="mb-8">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                <input type="text" placeholder="Rechercher dans l'aide..." class="w-full pl-12 pr-4 py-3 rounded-lg bg-white border border-gray-200 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#135bec]/50"/>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <a href="#" class="p-4 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100/50 border border-blue-200/50 hover:shadow-lg transition-shadow">
                <span class="material-symbols-outlined text-2xl text-blue-600 mb-2">rocket_launch</span>
                <h3 class="font-semibold text-gray-900">Démarrage Rapide</h3>
                <p class="text-sm text-gray-600 mt-1">Guide pour les nouveaux utilisateurs</p>
            </a>

            <a href="#" class="p-4 rounded-lg bg-gradient-to-br from-green-50 to-green-100/50 border border-green-200/50 hover:shadow-lg transition-shadow">
                <span class="material-symbols-outlined text-2xl text-green-600 mb-2">tips_and_updates</span>
                <h3 class="font-semibold text-gray-900">Conseils & Astuces</h3>
                <p class="text-sm text-gray-600 mt-1">Optimisez votre utilisation</p>
            </a>

            <a href="mailto:support@karasamb.com" class="p-4 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100/50 border border-purple-200/50 hover:shadow-lg transition-shadow">
                <span class="material-symbols-outlined text-2xl text-purple-600 mb-2">support_agent</span>
                <h3 class="font-semibold text-gray-900">Contacter le Support</h3>
                <p class="text-sm text-gray-600 mt-1">Parler avec notre équipe</p>
            </a>
        </div>

        <!-- FAQ Sections -->
        <div class="space-y-6">
            @foreach($faqSections as $index => $section)
                @php
                    $iconColorClass = match($section['icon_color']) {
                        'blue' => 'text-blue-600',
                        'green' => 'text-green-600',
                        'red' => 'text-red-600',
                        'purple' => 'text-purple-600',
                        'orange' => 'text-orange-600',
                        default => 'text-gray-600',
                    };
                @endphp
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <button 
                        @click="openSection = openSection === {{ $index }} ? null : {{ $index }}"
                        class="w-full p-6 bg-white hover:bg-gray-50 flex items-center justify-between cursor-pointer transition-colors"
                    >
                        <div class="flex items-center gap-4 text-left">
                            <span class="material-symbols-outlined text-2xl {{ $iconColorClass }}">{{ $section['icon'] }}</span>
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $section['title'] }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $section['description'] }}</p>
                            </div>
                        </div>
                        <span 
                            class="material-symbols-outlined transition-transform duration-200"
                            :class="openSection === {{ $index }} ? 'rotate-180' : ''"
                        >expand_more</span>
                    </button>
                    <div 
                        x-show="openSection === {{ $index }}"
                        x-collapse
                        class="border-t border-gray-200 p-6 bg-gray-50/50"
                    >
                        <div class="space-y-4">
                            @foreach($section['questions'] as $qa)
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">{{ $qa['question'] }}</h4>
                                    <p class="text-sm text-gray-700">{{ $qa['answer'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Contact Section -->
        <div class="mt-8 p-6 rounded-xl bg-gradient-to-r from-[#135bec]/10 to-[#135bec]/5 border border-[#135bec]/20">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-3xl text-[#135bec]">contact_support</span>
                <div class="flex-1">
                    <h3 class="font-bold text-gray-900">Vous n'avez pas trouvé votre réponse ?</h3>
                    <p class="text-sm text-gray-600 mt-1">Notre équipe support est disponible du lundi au vendredi, 9h-18h.</p>
                </div>
                <a href="mailto:support@karasamb.com" class="px-4 py-2 bg-[#135bec] text-white text-sm font-semibold rounded-lg hover:bg-[#135bec]/90 transition-colors">
                    Nous contacter
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
