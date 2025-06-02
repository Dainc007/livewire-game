<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Empire Builder') }} - Strategy Game</title>
    <meta name="description" content="Build your empire, manage resources, and conquer territories in this epic strategy game inspired by Civilization, Ikariam, and Heroes of Might & Magic.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-white min-h-screen">
    <!-- Navigation -->
    <nav class="relative z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">
                    Empire Builder
                </h1>
            </div>
            
            @if (Route::has('login'))
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/app') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 rounded-lg font-medium transition-colors">
                            Go to Game
                        </a>
                    @else
                        <a href="{{ url('/app/login') }}" class="text-gray-300 hover:text-white transition-colors">
                            Sign In
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ url('/app/register') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 rounded-lg font-medium transition-colors">
                                Sign Up
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-32 h-32 bg-amber-500/10 rounded-full blur-xl"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-purple-500/10 rounded-full blur-xl"></div>
            <div class="absolute bottom-20 left-1/3 w-40 h-40 bg-blue-500/10 rounded-full blur-xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-20">
            <div class="text-center mb-16">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Build Your 
                    <span class="bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 bg-clip-text text-transparent">
                        Empire
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Command armies, manage resources, and expand your territory in this epic strategy game. 
                    Inspired by the greatest civilization builders of all time.
                </p>
                
                @guest
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                        <a href="{{ url('/app/login') }}" 
                           class="group relative px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold text-lg rounded-xl shadow-2xl shadow-amber-500/25 transition-all duration-300 transform hover:scale-105 hover:shadow-amber-500/40">
                            <span class="flex items-center space-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span>Start Playing</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-orange-500 rounded-xl blur opacity-30 group-hover:opacity-50 transition-opacity -z-10"></div>
                        </a>
                        <a href="#features" class="px-8 py-4 border-2 border-gray-600 hover:border-amber-500 text-gray-300 hover:text-white font-semibold text-lg rounded-xl transition-all duration-300">
                            Learn More
                        </a>
                    </div>
                @else
                    <div class="mb-12">
                        <a href="{{ url('/app') }}" 
                           class="group relative px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold text-lg rounded-xl shadow-2xl shadow-amber-500/25 transition-all duration-300 transform hover:scale-105 hover:shadow-amber-500/40">
                            <span class="flex items-center space-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Continue Playing</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-orange-500 rounded-xl blur opacity-30 group-hover:opacity-50 transition-opacity -z-10"></div>
                        </a>
                    </div>
                @endguest

                <!-- Game Preview -->
                <div class="relative max-w-4xl mx-auto">
                    <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50 shadow-2xl">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-gradient-to-br from-amber-500/20 to-orange-500/20 rounded-lg p-4 border border-amber-500/30">
                                <div class="text-amber-400 text-2xl mb-2">🏛️</div>
                                <div class="font-semibold">Buildings</div>
                                <div class="text-sm text-gray-400">Construct & Upgrade</div>
                            </div>
                            <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-lg p-4 border border-green-500/30">
                                <div class="text-green-400 text-2xl mb-2">⚡</div>
                                <div class="font-semibold">Resources</div>
                                <div class="text-sm text-gray-400">Manage & Trade</div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-lg p-4 border border-blue-500/30">
                                <div class="text-blue-400 text-2xl mb-2">🗺️</div>
                                <div class="font-semibold">Territory</div>
                                <div class="text-sm text-gray-400">Expand & Defend</div>
                            </div>
                            <div class="bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-lg p-4 border border-purple-500/30">
                                <div class="text-purple-400 text-2xl mb-2">⚔️</div>
                                <div class="font-semibold">Combat</div>
                                <div class="text-sm text-gray-400">Strategic Warfare</div>
                            </div>
                        </div>
                        <div class="text-gray-400 text-sm">
                            Experience the depth of classic strategy games with modern gameplay mechanics
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="relative py-20 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    Game Features
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Everything you need to build and manage your civilization
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm rounded-xl p-6 border border-gray-700/50 hover:border-amber-500/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">City Building</h3>
                    <p class="text-gray-400">Construct and upgrade buildings to unlock new technologies and boost your empire's capabilities.</p>
                </div>

                <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm rounded-xl p-6 border border-gray-700/50 hover:border-green-500/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Resource Management</h3>
                    <p class="text-gray-400">Manage multiple resources strategically to fuel your empire's growth and military campaigns.</p>
                </div>

                <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm rounded-xl p-6 border border-gray-700/50 hover:border-blue-500/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Territory Expansion</h3>
                    <p class="text-gray-400">Explore new lands, establish settlements, and expand your borders to control valuable resources.</p>
                </div>

                <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm rounded-xl p-6 border border-gray-700/50 hover:border-purple-500/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Strategic Combat</h3>
                    <p class="text-gray-400">Command armies in tactical battles with unit positioning, terrain advantages, and strategic timing.</p>
                </div>

                <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm rounded-xl p-6 border border-gray-700/50 hover:border-red-500/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-orange-500 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Multiplayer</h3>
                    <p class="text-gray-400">Join games with other players, form alliances, trade resources, and compete for dominance.</p>
                </div>

                <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm rounded-xl p-6 border border-gray-700/50 hover:border-yellow-500/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-amber-500 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Real-time Strategy</h3>
                    <p class="text-gray-400">Experience dynamic gameplay with real-time decision making and live multiplayer interactions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm rounded-2xl p-12 border border-gray-700/50">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    Ready to Rule?
                </h2>
                <p class="text-xl text-gray-400 mb-8 max-w-2xl mx-auto">
                    Join thousands of players building their empires. Your journey to greatness starts here.
                </p>
                
                @guest
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url('/app/register') }}" 
                           class="group relative px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold text-lg rounded-xl shadow-2xl shadow-amber-500/25 transition-all duration-300 transform hover:scale-105 hover:shadow-amber-500/40">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Create Account</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-orange-500 rounded-xl blur opacity-30 group-hover:opacity-50 transition-opacity -z-10"></div>
                        </a>
                        <a href="{{ url('/app/login') }}" class="px-8 py-4 border-2 border-gray-600 hover:border-amber-500 text-gray-300 hover:text-white font-semibold text-lg rounded-xl transition-all duration-300">
                            Sign In
                        </a>
                    </div>
                @else
                    <a href="{{ url('/app') }}" 
                       class="group relative inline-flex px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold text-lg rounded-xl shadow-2xl shadow-amber-500/25 transition-all duration-300 transform hover:scale-105 hover:shadow-amber-500/40">
                        <span class="flex items-center space-x-2">
                            <span>Enter Your Empire</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-orange-500 rounded-xl blur opacity-30 group-hover:opacity-50 transition-opacity -z-10"></div>
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-6 md:mb-0">
                    <div class="w-8 h-8 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"></path>
                        </svg>
                    </div>
                    <span class="text-lg font-bold bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">
                        Empire Builder
                    </span>
                </div>
                <div class="text-gray-400 text-sm">
                    © {{ date('Y') }} Empire Builder. Built with Laravel & Filament.
                </div>
            </div>
        </div>
    </footer>

    <!-- Smooth scrolling -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
