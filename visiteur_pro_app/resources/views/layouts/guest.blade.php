<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .material-symbols-outlined {
                font-variation-settings:
                    'FILL' 0,
                    'wght' 400,
                    'GRAD' 0,
                    'opsz' 24;
                font-size: 24px;
            }
        </style>
    </head>
    <body class="font-display text-gray-900 antialiased" style="background-color: #f6f6f8;">
        <div class="relative flex h-auto min-h-screen w-full flex-col items-center justify-center overflow-x-hidden p-4 sm:p-6" style="background-color: #f6f6f8;">
            <div class="layout-container flex h-full grow flex-col w-full max-w-md">
                <div class="flex flex-col items-center justify-center flex-1">
                    {{ $slot }}
                </div>
                <div class="text-center mt-6">
                    <p class="text-xs text-gray-500">© 2024 Kara SAMB. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </body>
</html>

