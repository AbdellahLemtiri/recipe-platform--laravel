@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- En-tête -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Nos recettes</h1>
            <p class="text-gray-600">Découvrez des recettes délicieuses partagées par notre communauté</p>
        </div>

        <!-- Barre de recherche -->
        <div class="mb-8">
            <form action="{{ route('home') }}" method="GET" class="max-w-md mx-auto">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                           placeholder="Rechercher une recette...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                
                @if(request('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar des catégories -->
            <aside class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
                    <h3 class="font-bold text-gray-900 mb-4">Catégories</h3>
                    
                    <div class="space-y-2">
                        <a href="{{ route('home', ['search' => request('search')]) }}" 
                           class="block px-4 py-2 rounded-lg text-sm font-medium transition
                           {{ !request('category_id') ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-600 hover:bg-gray-100' }}">
                            Toutes les catégories
                        </a>

                        @foreach($categories as $category)
                            <a href="{{ route('home', ['category_id' => $category->id, 'search' => request('search')]) }}" 
                               class="block px-4 py-2 rounded-lg text-sm font-medium transition
                               {{ request('category_id') == $category->id ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-600 hover:bg-gray-100' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Statistiques</h3>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-emerald-600">{{ $totalRecipes }}</p>
                        <p class="text-sm text-gray-500">Recettes au total</p>
                    </div>
                </div>

                <!-- Recettes populaires -->
                @if(isset($topRecipes) && $topRecipes->count() > 0)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mt-6">
                    <h3 class="font-bold text-gray-900 mb-4">Recettes populaires</h3>
                    <div class="space-y-4">
                        @foreach($topRecipes->take(3) as $top)
                        <a href="{{ route('recipes.show', $top) }}" class="flex items-center gap-3 group">
                            <img src="{{ asset('storage/' . $top->image) }}" 
                                 class="w-12 h-12 rounded-lg object-cover">
                            <div>
                                <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-600">
                                    {{ $top->title }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $top->comments_count }} avis</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>

            <!-- Contenu principal -->
            <main class="lg:w-3/4">
                <!-- Résultats de recherche -->
                @if(request('search'))
                    <div class="mb-6 p-4 bg-white rounded-lg shadow border border-gray-200">
                        <p class="text-gray-600">
                            Résultats pour : 
                            <span class="font-bold text-gray-900">"{{ request('search') }}"</span>
                        </p>
                    </div>
                @endif

                <!-- Liste des recettes -->
                @if($recipes->count() > 0)
                    @include('recipes.partials.list')
                @else
                    <div class="bg-white rounded-lg shadow border border-gray-200 p-8 text-center">
                        <div class="text-5xl mb-4">🍳</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune recette trouvée</h3>
                        <p class="text-gray-600 mb-6">
                            @if(request('search') || request('category_id'))
                                Aucune recette ne correspond à vos critères de recherche.
                            @else
                                Aucune recette disponible pour le moment.
                            @endif
                        </p>
                        <a href="{{ route('home') }}" 
                           class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition">
                            Voir toutes les recettes
                        </a>
                    </div>
                @endif
            </main>

        </div>
    </div>
</div>
@endsection