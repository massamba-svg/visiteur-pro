<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accès non autorisé - Visiteur Pro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#135bec',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-[#f6f6f8] min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 text-center">
        <div class="w-20 h-20 mx-auto mb-6 bg-red-100 rounded-full flex items-center justify-center">
            <span class="material-symbols-outlined text-4xl text-red-500">lock</span>
        </div>
        
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Accès non autorisé</h1>
        <p class="text-gray-500 mb-6">
            Vous n'avez pas les permissions nécessaires pour accéder à cette page.
        </p>
        
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <p class="text-sm text-gray-600">
                <span class="font-medium">Code d'erreur:</span> 403
            </p>
            @if(isset($exception) && $exception->getMessage())
                <p class="text-sm text-gray-600 mt-1">
                    {{ $exception->getMessage() }}
                </p>
            @endif
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition-colors">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Retour
            </a>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors">
                <span class="material-symbols-outlined text-lg">dashboard</span>
                Tableau de bord
            </a>
        </div>
    </div>
</body>
</html>
