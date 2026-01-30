<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Partagez vos meilleures recettes avec une communauté passionnée.">
    
    <title>Saveurs & Partage | Communauté Culinaire</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(229, 231, 235, 0.5); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#FDFBF7] text-gray-900 flex flex-col min-h-screen" x-data="{ mobileMenuOpen: false, userMenuOpen: false }">

    <nav class="sticky top-0 z-50 glass transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2 group">
                        <span class="bg-emerald-100 text-emerald-600 p-2 rounded-xl group-hover:scale-110 transition-transform">👨‍🍳</span>
                        Saveurs<span class="text-emerald-600">&Partage</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-sm font-bold text-gray-600 hover:text-emerald-600 transition">Explorer</a>
                    
                    @auth
                        <a href="{{ route('recipes.create') }}" class="group flex items-center gap-2 bg-gray-900 text-white px-5 py-2.5 rounded-2xl text-sm font-bold hover:bg-emerald-600 transition-all shadow-lg hover:shadow-emerald-200 hover:-translate-y-0.5">
                            <svg class="w-4 h-4 text-emerald-400 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Publier
                        </a>

                        <div class="relative ml-4" @click.away="userMenuOpen = false">
                            <button @click="userMenuOpen = !userMenuOpen" class="flex items-center gap-3 focus:outline-none group">
                                <span class="text-sm font-bold text-gray-700 group-hover:text-emerald-600 transition">{{ Auth::user()->name }}</span>
                                <div class="w-10 h-10 rounded-full bg-emerald-100 border-2 border-white shadow-sm flex items-center justify-center text-emerald-700 font-bold group-hover:ring-2 ring-emerald-200 transition">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>

                            <div x-show="userMenuOpen" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-cloak
                                 class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden py-1">
                                
                                <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50">
                                    <p class="text-xs text-gray-500 font-bold uppercase">Connecté en tant que</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                    Mon Espace Chef
                                </a>
                                
                                <div class="border-t border-gray-100 my-1"></div>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-sm font-semibold text-red-500 hover:bg-red-50 transition flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>

                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900 transition">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-6 py-2.5 rounded-2xl text-sm font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-200 hover:-translate-y-0.5">
                            S'inscrire
                        </a>
                    @endauth
                </div>

                <div class="flex md:hidden items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-500 hover:text-emerald-600 focus:outline-none p-2 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-cloak
             class="md:hidden absolute top-20 left-0 w-full bg-white border-b border-gray-100 shadow-xl z-40">
            <div class="px-4 py-6 space-y-4">
                <a href="/" class="block text-base font-bold text-gray-700 hover:text-emerald-600">Explorer les recettes</a>
                
                @auth
                    <a href="{{ route('recipes.create') }}" class="block text-base font-bold text-gray-700 hover:text-emerald-600">+ Publier une recette</a>
                    <a href="{{ route('dashboard') }}" class="block text-base font-bold text-emerald-600">Mon Espace Chef</a>
                    <div class="border-t border-gray-100 pt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-base font-bold text-red-500 hover:text-red-600 w-full text-left">Déconnexion</button>
                        </form>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <a href="{{ route('login') }}" class="text-center py-3 rounded-xl border border-gray-200 font-bold text-gray-700 hover:bg-gray-50">Connexion</a>
                        <a href="{{ route('register') }}" class="text-center py-3 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700">S'inscrire</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('success') || session('error'))
    <div class="max-w-7xl mx-auto px-4 mt-6">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in-down">
                <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-100 text-red-800 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in-down">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <a href="/" class="text-2xl font-black text-gray-900 tracking-tight inline-block mb-4 hover:opacity-80 transition">
                Saveurs<span class="text-emerald-600">.</span>
            </a>
            <div class="flex justify-center space-x-6 mb-6">
                <a href="#" class="text-gray-400 hover:text-emerald-600 transition">À propos</a>
                <a href="#" class="text-gray-400 hover:text-emerald-600 transition">Règles</a>
                <a href="#" class="text-gray-400 hover:text-emerald-600 transition">Confidentialité</a>
            </div>
            <p class="text-gray-400 text-sm font-medium">
                &copy; {{ date('Y') }} Saveurs & Partage. Conçu avec ❤️ et du ☕ par Abdellah.
            </p>
        </div>
    </footer>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.5s ease-out; }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>