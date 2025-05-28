<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Settlement Builder' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-gray-100 min-h-screen">
        <div class="flex flex-col h-screen">
            <!-- Header -->
            <header class="bg-gray-800 text-white p-4">
                <livewire:game-navigation />
            </header>

            <!-- Main Content -->
            <main class="flex-1 container mx-auto p-4">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 h-full">
                    <!-- Game Board -->
                    <div class="lg:col-span-full bg-white rounded-lg shadow-lg p-4">
                        <div class="aspect-square bg-gray-200 rounded-lg">
                            <livewire:game-board />
                        </div>
                    </div>
                </div>
            </main>
        </div>

        @livewireScripts
    </body>
</html>
