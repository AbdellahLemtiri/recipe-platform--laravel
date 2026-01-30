<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace Chef | Saveurs & Partage</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900" x-data="{ sidebarOpen: false }">

    <div class="md:hidden flex items-center justify-between bg-white border-b border-gray-200 p-4 fixed w-full z-30 top-0">
        <a href="/" class="text-xl font-extrabold text-emerald-600 flex items-center gap-2">
            <span class="text-2xl">👨‍🍳</span> Saveurs<span class="text-gray-900">.</span>
        </a>
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-emerald-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-900 text-white transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 flex flex-col h-screen">
        
        <div class="h-20 flex items-center justify-center border-b border-gray-800">
            <a href="/" class="text-2xl font-black tracking-tight flex items-center gap-2 hover:opacity-80 transition">
                <span class="bg-emerald-600 text-white p-1.5 rounded-lg">👨‍🍳</span>
                <span>Saveurs<span class="text-emerald-500">.</span></span>
            </a>
        </div>

        <div class="p-6 border-b border-gray-800 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center font-bold text-lg">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400">Membre Chef</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/20' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="font-medium">Vue d'ensemble</span>
            </a>

            <a href="{{ route('dashboard') }}?tab=recipes" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors text-gray-400 hover:bg-gray-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <span class="font-medium">Mes Recettes</span>
            </a>

            <a href="{{ route('recipes.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('recipes.create') ? 'bg-emerald-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span class="font-medium">Publier une recette</span>
            </a>

            <a href="{{ route('dashboard') }}?tab=favorites" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors text-gray-400 hover:bg-gray-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="font-medium">Mes Favoris</span>
            </a>

            <div class="border-t border-gray-800 my-4"></div>

            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors text-gray-400 hover:bg-gray-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium">Retour au site</span>
            </a>

        </nav>

        <div class="p-4 border-t border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="font-bold text-sm">Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 h-screen overflow-y-auto pt-20 md:pt-0 bg-gray-50">
        <header class="hidden md:flex items-center justify-between bg-white border-b border-gray-200 px-8 py-4 sticky top-0 z-20">
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    @yield('title', 'Tableau de bord')
                </h2>
                <p class="text-sm text-gray-500">Bienvenue, {{ Auth::user()->name }} 👋</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('recipes.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow hover:bg-emerald-700 transition">
                    + Nouveau
                </a>
            </div>
        </header>

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="mx-8 mt-6 bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex justify-between items-center animate-fadeIn">
                <span class="font-bold flex items-center gap-2">
                    ✅ {{ session('success') }}
                </span>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-800">&times;</button>
            </div>
        @endif

        <div class="p-4 md:p-8">
            @yield('content')
        </div>
    </main>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-30 md:hidden" x-transition.opacity></div>

</body>
</html>