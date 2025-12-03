<x-app-layout>
    <div class="w-full max-w-4xl mx-auto">
        <!-- Page Heading -->
        <div class="mb-8">
            <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900">Paramètres</h1>
            <p class="text-base font-normal text-gray-500 mt-2">Gérez votre compte et vos préférences</p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Account Information -->
        <div class="rounded-xl border border-gray-200 p-6 bg-white mb-6">
            <div class="flex items-center gap-4 mb-6">
                <span class="material-symbols-outlined text-3xl text-[#135bec]">account_circle</span>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Informations du Compte</h2>
                    <p class="text-sm text-gray-500">Vos données personnelles</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom Complet</label>
                    <input type="text" value="{{ $user->name }}" readonly class="w-full px-4 py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" value="{{ $user->email }}" readonly class="w-full px-4 py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                    <input type="text" value="{{ $user->role ? ucfirst($user->role->name) : 'Non assigné' }}" readonly class="w-full px-4 py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date d'Inscription</label>
                    <input type="text" value="{{ $user->created_at->translatedFormat('d F Y') }}" readonly class="w-full px-4 py-2 rounded-lg bg-gray-50 border border-gray-200 text-gray-900"/>
                </div>
            </div>
        </div>

        <!-- Preferences Générales -->
        <div class="rounded-xl border border-gray-200 p-6 bg-white mb-6" x-data="{
            emailNotifications: true,
            systemNotifications: false,
            analyticsData: true
        }">
            <div class="flex items-center gap-4 mb-6">
                <span class="material-symbols-outlined text-3xl text-purple-500">tune</span>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Préférences Générales</h2>
                    <p class="text-sm text-gray-500">Personnalisez votre expérience</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">Notifications Email</p>
                        <p class="text-sm text-gray-500">Recevoir les alertes par email</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="emailNotifications" class="sr-only peer"/>
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#135bec]/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#135bec]"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">Notifications Système</p>
                        <p class="text-sm text-gray-500">Notifications desktop en temps réel</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="systemNotifications" class="sr-only peer"/>
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#135bec]/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#135bec]"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">Données Analytiques</p>
                        <p class="text-sm text-gray-500">Nous aider à améliorer l'app</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="analyticsData" class="sr-only peer"/>
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#135bec]/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#135bec]"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Security & Privacy -->
        <div class="rounded-xl border border-gray-200 p-6 bg-white mb-6">
            <div class="flex items-center gap-4 mb-6">
                <span class="material-symbols-outlined text-3xl text-red-500">security</span>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Sécurité & Confidentialité</h2>
                    <p class="text-sm text-gray-500">Protégez votre compte</p>
                </div>
            </div>
            <div class="space-y-3">
                <a href="{{ route('password.request') }}" class="w-full flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="text-left">
                        <p class="font-medium text-gray-900">Changer le Mot de Passe</p>
                        <p class="text-sm text-gray-500">Modifier votre mot de passe actuel</p>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">arrow_forward</span>
                </a>

                <button type="button" class="w-full flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="text-left">
                        <p class="font-medium text-gray-900">Authentification à Deux Facteurs</p>
                        <p class="text-sm text-gray-500">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">Non configurée</span>
                        </p>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">arrow_forward</span>
                </button>

                <button type="button" class="w-full flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="text-left">
                        <p class="font-medium text-gray-900">Gérer les Sessions Actives</p>
                        <p class="text-sm text-gray-500">1 session active actuellement</p>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">arrow_forward</span>
                </button>

                <button type="button" class="w-full flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="text-left">
                        <p class="font-medium text-gray-900">Télécharger vos Données</p>
                        <p class="text-sm text-gray-500">Exporter un archivage personnel</p>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">arrow_forward</span>
                </button>
            </div>
        </div>

        <!-- Integrations -->
        <div class="rounded-xl border border-gray-200 p-6 bg-white mb-6">
            <div class="flex items-center gap-4 mb-6">
                <span class="material-symbols-outlined text-3xl text-blue-500">extension</span>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Intégrations API</h2>
                    <p class="text-sm text-gray-500">Connectez d'autres applications</p>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100/50 rounded-lg" x-data="{ copied: false }">
                <div>
                    <p class="font-medium text-gray-900">Clé API</p>
                    <p class="text-sm text-gray-500 font-mono">sk_live_{{ substr(md5($user->id . $user->email), 0, 20) }}...</p>
                </div>
                <button 
                    @click="navigator.clipboard.writeText('sk_live_{{ md5($user->id . $user->email) }}'); copied = true; setTimeout(() => copied = false, 2000)"
                    class="px-3 py-2 bg-[#135bec] text-white text-sm font-semibold rounded-lg hover:bg-[#135bec]/90"
                    x-text="copied ? 'Copié !' : 'Copier'"
                >Copier</button>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="rounded-xl border border-red-200 p-6 bg-red-50">
            <div class="flex items-center gap-4 mb-6">
                <span class="material-symbols-outlined text-3xl text-red-600">warning</span>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Zone Dangereuse</h2>
                    <p class="text-sm text-gray-600">Actions irréversibles</p>
                </div>
            </div>
            <button type="button" class="w-full flex items-center justify-between p-4 bg-red-100 rounded-lg hover:bg-red-200 transition-colors text-red-700 font-medium" x-data @click="if(confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')) { alert('Fonctionnalité en cours de développement.'); }">
                <div class="text-left">
                    <p>Supprimer le Compte</p>
                    <p class="text-sm font-normal text-red-600">Cette action est définitive</p>
                </div>
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>
        </div>
    </div>
</x-app-layout>
