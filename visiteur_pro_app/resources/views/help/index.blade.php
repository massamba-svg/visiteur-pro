<x-app-layout>
    <div class="w-full max-w-4xl mx-auto" x-data="helpCenter()">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Centre d'Aide</h1>
            <p class="text-base font-normal text-gray-500 mt-2">Trouvez les réponses à vos questions</p>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <!-- Démarrage Rapide -->
            <button 
                @click="showQuickStart = true"
                class="p-4 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100/50 border border-blue-200/50 hover:shadow-lg transition-all hover:-translate-y-1 text-left"
            >
                <span class="material-symbols-outlined text-2xl text-blue-600 mb-2">rocket_launch</span>
                <h3 class="font-semibold text-gray-900">Démarrage Rapide</h3>
                <p class="text-sm text-gray-600 mt-1">Guide pour les nouveaux utilisateurs</p>
            </button>

            <!-- Conseils & Astuces -->
            <button 
                @click="showTips = true"
                class="p-4 rounded-lg bg-gradient-to-br from-green-50 to-green-100/50 border border-green-200/50 hover:shadow-lg transition-all hover:-translate-y-1 text-left"
            >
                <span class="material-symbols-outlined text-2xl text-green-600 mb-2">tips_and_updates</span>
                <h3 class="font-semibold text-gray-900">Conseils & Astuces</h3>
                <p class="text-sm text-gray-600 mt-1">Optimisez votre utilisation</p>
            </button>

            <!-- Contacter le Support -->
            <button 
                @click="showContact = true"
                class="p-4 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100/50 border border-purple-200/50 hover:shadow-lg transition-all hover:-translate-y-1 text-left"
            >
                <span class="material-symbols-outlined text-2xl text-purple-600 mb-2">support_agent</span>
                <h3 class="font-semibold text-gray-900">Contacter le Support</h3>
                <p class="text-sm text-gray-600 mt-1">Parler avec notre équipe</p>
            </button>
        </div>

        <!-- FAQ Sections -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Questions Fréquentes</h2>
            
            @foreach($faqSections as $index => $section)
                @php
    $iconColorClass = match ($section['icon_color']) {
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
                                    <p class="text-sm text-gray-700 leading-relaxed">{{ $qa['answer'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- L'équipe de Développement -->
        <div class="mt-8 p-6 rounded-xl bg-white border border-gray-200">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-2xl text-[#135bec]">groups</span>
                <div>
                    <h3 class="font-bold text-gray-900">L'Équipe de Développement</h3>
                    <p class="text-sm text-gray-500">Les créateurs de Visiteur Pro</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <!-- Jérémie -->
                <div class="p-4 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100/30 border border-purple-100">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-full bg-purple-200 flex items-center justify-center">
                            <span class="text-purple-700 font-bold text-lg">JN</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Jérémie Nnanna E.</p>
                            <p class="text-xs text-gray-500">Développeur Full Stack</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=jeremie.nnannaenouani@uahb.sn&su=Support%20Visiteur%20Pro&body=Bonjour%2C%0A%0AJ'ai%20besoin%20d'assistance." 
                            target="_blank"
                            class="flex-1 flex items-center justify-center gap-1 py-2 px-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            <span class="material-symbols-outlined text-base">mail</span>
                            Email
                        </a>
                        <button 
                            @click="copyEmail('jeremie.nnannaenouani@uahb.sn')"
                            class="flex items-center justify-center px-3 py-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors"
                            title="Copier l'email"
                        >
                            <span class="material-symbols-outlined text-base">content_copy</span>
                        </button>
                    </div>
                </div>
                
                

                <!-- Ibrahima -->
                <div class="p-4 rounded-lg bg-gradient-to-br from-green-50 to-green-100/30 border border-green-100">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-full bg-green-200 flex items-center justify-center">
                            <span class="text-green-700 font-bold text-lg">ID</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Ibrahima A. Diallo</p>
                            <p class="text-xs text-gray-500">Développeur Full Stack</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ibrahimaahmed.diallo@uahb.sn&su=Support%20Visiteur%20Pro&body=Bonjour%2C%0A%0AJ'ai%20besoin%20d'assistance." 
                            target="_blank"
                            class="flex-1 flex items-center justify-center gap-1 py-2 px-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            <span class="material-symbols-outlined text-base">mail</span>
                            Email
                        </a>
                        <button 
                            @click="copyEmail('ibrahimaahmed.diallo@uahb.sn')"
                            class="flex items-center justify-center px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors"
                            title="Copier l'email"
                        >
                            <span class="material-symbols-outlined text-base">content_copy</span>
                        </button>
                    </div>
                </div>

                <!-- Massamba -->
                <div class="p-4 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100/30 border border-blue-100">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-full bg-blue-200 flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-lg">MD</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Massamba Diagne</p>
                            <p class="text-xs text-gray-500">Développeur Full Stack</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a 
                            href="https://mail.google.com/mail/?view=cm&fs=1&to=massamba.diagne@uahb.sn&su=Support%20Visiteur%20Pro&body=Bonjour%2C%0A%0AJ'ai%20besoin%20d'assistance." 
                            target="_blank"
                            class="flex-1 flex items-center justify-center gap-1 py-2 px-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            <span class="material-symbols-outlined text-base">mail</span>
                            Email
                        </a>
                        <button 
                            @click="copyEmail('massamba.diagne@uahb.sn')"
                            class="flex items-center justify-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors"
                            title="Copier l'email"
                        >
                            <span class="material-symbols-outlined text-base">content_copy</span>
                        </button>
                    </div>
                </div>
                
            </div>
            
            <p class="text-center text-sm text-gray-500 mt-4">
                Projet réalisé dans le cadre du cours de Développement Back-End • STIC3 • UAHB {{ date('Y') }}
            </p>
        </div>

        <!-- Toast de confirmation copie -->
        <div 
            x-show="showCopyToast" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="fixed bottom-4 right-4 z-50 flex items-center gap-2 px-4 py-3 bg-gray-900 text-white rounded-lg shadow-lg"
            style="display: none;"
        >
            <span class="material-symbols-outlined text-green-400">check_circle</span>
            <span x-text="copyToastMessage"></span>
        </div>

        <!-- ============================================== -->
        <!-- MODAL: Démarrage Rapide -->
        <!-- ============================================== -->
        <div 
            x-show="showQuickStart" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
            @click.self="showQuickStart = false"
            @keydown.escape.window="showQuickStart = false"
            style="display: none;"
        >
            <div 
                x-show="showQuickStart"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100/50">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-blue-600 text-2xl">rocket_launch</span>
                        <h2 class="text-lg font-bold text-gray-900">Guide de Démarrage Rapide</h2>
                    </div>
                    <button @click="showQuickStart = false" class="p-1 hover:bg-blue-200 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-gray-500">close</span>
                    </button>
                </div>
                
                <!-- Body -->
                <div class="p-6 overflow-y-auto">
                    <div class="space-y-6">
                        <!-- Étape 1 -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">1</div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Créez vos premiers clients</h3>
                                <p class="text-sm text-gray-600 mb-2">Commencez par ajouter les clients que vous allez visiter régulièrement.</p>
                                <a href="{{ route('clients.create') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:underline">
                                    <span class="material-symbols-outlined text-base">add</span>
                                    Ajouter un client
                                </a>
                            </div>
                        </div>
                        
                        <!-- Étape 2 -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">2</div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Enregistrez vos visites</h3>
                                <p class="text-sm text-gray-600 mb-2">Pour chaque visite, notez le client, la date, le motif et les observations.</p>
                                <a href="{{ route('visits.create') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:underline">
                                    <span class="material-symbols-outlined text-base">add</span>
                                    Enregistrer une visite
                                </a>
                            </div>
                        </div>
                        
                        <!-- Étape 3 -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">3</div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Consultez votre tableau de bord</h3>
                                <p class="text-sm text-gray-600 mb-2">Visualisez vos statistiques et suivez votre activité en temps réel.</p>
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:underline">
                                    <span class="material-symbols-outlined text-base">dashboard</span>
                                    Voir le tableau de bord
                                </a>
                            </div>
                        </div>
                        
                        <!-- Étape 4 -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">4</div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Générez des rapports</h3>
                                <p class="text-sm text-gray-600 mb-2">Exportez vos données en PDF pour vos réunions ou archives.</p>
                                <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:underline">
                                    <span class="material-symbols-outlined text-base">description</span>
                                    Accéder aux rapports
                                </a>
                            </div>
                        </div>
                        
                        <!-- Étape 5 -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center font-bold">
                                <span class="material-symbols-outlined">check</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Vous êtes prêt !</h3>
                                <p class="text-sm text-gray-600">Explorez toutes les fonctionnalités et n'hésitez pas à contacter le support si besoin.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <button @click="showQuickStart = false" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        C'est compris !
                    </button>
                </div>
            </div>
        </div>

        <!-- ============================================== -->
        <!-- MODAL: Conseils & Astuces -->
        <!-- ============================================== -->
        <div 
            x-show="showTips" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
            @click.self="showTips = false"
            @keydown.escape.window="showTips = false"
            style="display: none;"
        >
            <div 
                x-show="showTips"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-green-100/50">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-green-600 text-2xl">tips_and_updates</span>
                        <h2 class="text-lg font-bold text-gray-900">Conseils & Astuces</h2>
                    </div>
                    <button @click="showTips = false" class="p-1 hover:bg-green-200 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-gray-500">close</span>
                    </button>
                </div>
                
                <!-- Body -->
                <div class="p-6 overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Astuce 1 -->
                        <div class="p-4 bg-green-50 rounded-lg border border-green-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-green-600">lightbulb</span>
                                <h4 class="font-semibold text-gray-900">Raccourcis clavier</h4>
                            </div>
                            <p class="text-sm text-gray-600">Utilisez <kbd class="px-1.5 py-0.5 bg-gray-200 rounded text-xs">Échap</kbd> pour fermer les modales rapidement.</p>
                        </div>
                        
                        <!-- Astuce 2 -->
                        <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-blue-600">filter_alt</span>
                                <h4 class="font-semibold text-gray-900">Filtres puissants</h4>
                            </div>
                            <p class="text-sm text-gray-600">Combinez les filtres de période et de recherche pour trouver rapidement vos données.</p>
                        </div>
                        
                        <!-- Astuce 3 -->
                        <div class="p-4 bg-purple-50 rounded-lg border border-purple-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-purple-600">download</span>
                                <h4 class="font-semibold text-gray-900">Export PDF</h4>
                            </div>
                            <p class="text-sm text-gray-600">Exportez vos rapports en PDF pour les partager ou les archiver facilement.</p>
                        </div>
                        
                        <!-- Astuce 4 -->
                        <div class="p-4 bg-orange-50 rounded-lg border border-orange-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-orange-600">schedule</span>
                                <h4 class="font-semibold text-gray-900">Durée automatique</h4>
                            </div>
                            <p class="text-sm text-gray-600">La durée de visite est calculée automatiquement entre l'arrivée et le départ.</p>
                        </div>
                        
                        <!-- Astuce 5 -->
                        <div class="p-4 bg-red-50 rounded-lg border border-red-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-red-600">security</span>
                                <h4 class="font-semibold text-gray-900">Sessions sécurisées</h4>
                            </div>
                            <p class="text-sm text-gray-600">Vérifiez régulièrement vos sessions actives dans les paramètres de sécurité.</p>
                        </div>
                        
                        <!-- Astuce 6 -->
                        <div class="p-4 bg-teal-50 rounded-lg border border-teal-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-teal-600">person_add</span>
                                <h4 class="font-semibold text-gray-900">Clients rapides</h4>
                            </div>
                            <p class="text-sm text-gray-600">Créez un client directement depuis le formulaire de visite si nécessaire.</p>
                        </div>
                        
                        <!-- Astuce 7 -->
                        <div class="p-4 bg-indigo-50 rounded-lg border border-indigo-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-indigo-600">trending_up</span>
                                <h4 class="font-semibold text-gray-900">Analysez les tendances</h4>
                            </div>
                            <p class="text-sm text-gray-600">Le tableau de bord affiche les tendances sur différentes périodes pour mieux analyser.</p>
                        </div>
                        
                        <!-- Astuce 8 -->
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-gray-600">dark_mode</span>
                                <h4 class="font-semibold text-gray-900">Mode sombre (bientôt)</h4>
                            </div>
                            <p class="text-sm text-gray-600">Un mode sombre sera bientôt disponible pour un meilleur confort visuel.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <button @click="showTips = false" class="w-full py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors">
                        Super, merci !
                    </button>
                </div>
            </div>
        </div>

        <!-- ============================================== -->
        <!-- MODAL: Contacter le Support -->
        <!-- ============================================== -->
        <div x-show="showContact" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" @click.self="showContact = false"
            @keydown.escape.window="showContact = false" style="display: none;">
            <div 
                x-show="showContact"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-xl shadow-2xl w-full max-w-lg overflow-hidden"
            >
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-purple-100/50">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-purple-600 text-2xl">support_agent</span>
                        <h2 class="text-lg font-bold text-gray-900">Contacter le Support</h2>
                    </div>
                    <button @click="showContact = false" class="p-1 hover:bg-purple-200 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-gray-500">close</span>
                    </button>
                </div>
                
                <!-- Body -->
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-4">Choisissez un membre de l'équipe à contacter :</p>
                    
                    <div class="space-y-3">
                        <!-- Jérémie -->
                        <div
                            class="flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all group">
                            <div
                                class="w-12 h-12 rounded-full bg-purple-200 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="text-purple-700 font-bold text-lg">JN</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Jérémie Nnanna Enouani</p>
                                <p class="text-sm text-gray-500">jeremie.nnannaenouani@uahb.sn</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=jeremie.nnannaenouani@uahb.sn&su=Support%20Visiteur%20Pro&body=Bonjour%2C%0A%0AJ'ai%20besoin%20d'assistance." 
                                    target="_blank"
                                    class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" title="Envoyer un email">
                                    <span class="material-symbols-outlined text-base">mail</span>
                                </a>
                                <button @click="copyEmail('jeremie.nnannaenouani@uahb.sn')"
                                    class="p-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors"
                                    title="Copier l'email">
                                    <span class="material-symbols-outlined text-base">content_copy</span>
                                </button>
                            </div>
                        </div>
                        
                        
                        
                        <!-- Ibrahima -->
                        <div class="flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all group">
                            <div class="w-12 h-12 rounded-full bg-green-200 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="text-green-700 font-bold text-lg">ID</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Ibrahima Ahmed Diallo</p>
                                <p class="text-sm text-gray-500">ibrahimaahmed.diallo@uahb.sn</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ibrahimaahmed.diallo@uahb.sn&su=Support%20Visiteur%20Pro&body=Bonjour%2C%0A%0AJ'ai%20besoin%20d'assistance." 
                                    target="_blank"
                                    class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" title="Envoyer un email">
                                    <span class="material-symbols-outlined text-base">mail</span>
                                </a>
                                <button 
                                    @click="copyEmail('ibrahimaahmed.diallo@uahb.sn')"
                                    class="p-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors"
                                    title="Copier l'email"
                                >
                                    <span class="material-symbols-outlined text-base">content_copy</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Massamba -->
                        <div class="flex items-center gap-4 p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all group">
                            <div class="w-12 h-12 rounded-full bg-blue-200 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="text-blue-700 font-bold text-lg">MD</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Massamba Diagne</p>
                                <p class="text-sm text-gray-500">massamba.diagne@uahb.sn</p>
                            </div>
                            <div class="flex gap-2">
                                <a 
                                    href="https://mail.google.com/mail/?view=cm&fs=1&to=massamba.diagne@uahb.sn&su=Support%20Visiteur%20Pro&body=Bonjour%2C%0A%0AJ'ai%20besoin%20d'assistance." 
                                    target="_blank"
                                    class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    title="Envoyer un email"
                                >
                                    <span class="material-symbols-outlined text-base">mail</span>
                                </a>
                                <button 
                                    @click="copyEmail('massamba.diagne@uahb.sn')"
                                    class="p-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors"
                                    title="Copier l'email"
                                >
                                    <span class="material-symbols-outlined text-base">content_copy</span>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 text-center">
                            <span class="material-symbols-outlined text-sm align-middle">info</span>
                            Cliquez sur <span class="material-symbols-outlined text-xs align-middle">mail</span> pour ouvrir votre client mail ou sur <span class="material-symbols-outlined text-xs align-middle">content_copy</span> pour copier l'adresse
                        </p>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
                    <button @click="showContact = false" class="px-4 py-2 text-gray-600 hover:bg-gray-200 rounded-lg transition-colors">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function helpCenter() {
            return {
                openSection: null,
                showQuickStart: false,
                showTips: false,
                showContact: false,
                showCopyToast: false,
                copyToastMessage: '',
                
                copyEmail(email) {
                    navigator.clipboard.writeText(email).then(() => {
                        this.copyToastMessage = `Email copié : ${email}`;
                        this.showCopyToast = true;
                        setTimeout(() => {
                            this.showCopyToast = false;
                        }, 3000);
                    }).catch(err => {
                        // Fallback pour les navigateurs qui ne supportent pas clipboard API
                        const textArea = document.createElement('textarea');
                        textArea.value = email;
                        document.body.appendChild(textArea);
                        textArea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textArea);
                        
                        this.copyToastMessage = `Email copié : ${email}`;
                        this.showCopyToast = true;
                        setTimeout(() => {
                            this.showCopyToast = false;
                        }, 3000);
                    });
                }
            }
        }
    </script>
</x-app-layout>
