@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Bonjour, {{ Auth::user()->name }}</h1>
            <p class="text-gray-600">Gérez vos recettes et favoris</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mr-4">
                        📝
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $myRecipes->count() }}</p>
                        <p class="text-sm text-gray-500">Recettes</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center mr-4">
                        ❤️
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $myFavorites->count() }}</p>
                        <p class="text-sm text-gray-500">Favoris</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglets -->
        <div class="flex border-b border-gray-200 mb-6">
            <button id="btn-recipes" class="tab-btn px-6 py-3 font-medium border-b-2 border-emerald-600 text-emerald-600">
                Mes Recettes
            </button>
            <button id="btn-favorites" class="tab-btn px-6 py-3 font-medium text-gray-500 hover:text-gray-700">
                Mes Favoris
            </button>
        </div>

        <!-- Section Mes Recettes -->
        <div id="section-recipes" class="tab-content">
            

            @if($myRecipes->isEmpty())
                <div class="bg-white p-8 rounded-lg shadow border border-gray-200 text-center">
                    <div class="text-4xl mb-4">👨‍🍳</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune recette</h3>
                    <p class="text-gray-600 mb-6">Commencez par créer votre première recette !</p>
                    <a href="{{ route('recipes.create') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition inline-block">
                        Créer ma première recette
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Carte "Créer une recette" -->
                    <a href="{{ route('recipes.create') }}" class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-emerald-400 hover:bg-emerald-50 transition cursor-pointer flex flex-col items-center justify-center min-h-[200px]">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700">Créer une recette</span>
                    </a>

                    <!-- Liste des recettes -->
                    @foreach($myRecipes as $recipe)
                    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                        <div class="h-40 overflow-hidden">
                            <img src="{{ asset('storage/' . $recipe->image) }}" 
                                 alt="{{ $recipe->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-gray-900">{{ $recipe->title }}</h3>
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                    {{ $recipe->category->name }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $recipe->description }}
                            </p>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('recipes.edit', $recipe) }}" 
                                   class="flex-1 text-center bg-gray-100 text-gray-700 font-medium py-2 rounded text-sm hover:bg-gray-200 transition">
                                    Modifier
                                </a>
                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Supprimer cette recette ?')"
                                            class="w-full text-center bg-red-100 text-red-600 font-medium py-2 rounded text-sm hover:bg-red-200 transition">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Section Favoris -->
        <div id="section-favorites" class="tab-content hidden">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Vos favoris</h2>
            
            @if($myFavorites->isEmpty())
                <div class="bg-white p-8 rounded-lg shadow border border-gray-200 text-center">
                    <div class="text-4xl mb-4">💔</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Aucun favori</h3>
                    <p class="text-gray-600 mb-6">Vous n'avez pas encore ajouté de recettes à vos favoris.</p>
                    <a href="{{ route('home') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition inline-block">
                        Explorer les recettes
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($myFavorites as $fav)
                    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                        <div class="h-40 overflow-hidden">
                            <img src="{{ asset('storage/' . $fav->image) }}" 
                                 alt="{{ $fav->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-gray-900">{{ $fav->title }}</h3>
                                <span class="text-xs bg-pink-100 text-pink-600 px-2 py-1 rounded">
                                    Favori
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $fav->description }}
                            </p>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('recipes.show', $fav) }}" 
                                   class="flex-1 text-center bg-emerald-600 text-white font-medium py-2 rounded text-sm hover:bg-emerald-700 transition">
                                    Voir
                                </a>
                                <form action="{{ route('recipes.favorite', $fav) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="px-4 py-2 bg-gray-100 rounded text-gray-400 hover:text-pink-600 hover:bg-pink-50 transition"
                                            title="Retirer des favoris">
                                        ✕
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnRecipes = document.getElementById('btn-recipes');
        const btnFavorites = document.getElementById('btn-favorites');
        const sectionRecipes = document.getElementById('section-recipes');
        const sectionFavorites = document.getElementById('section-favorites');
        
        // Clic sur "Mes Recettes"
        btnRecipes.addEventListener('click', function() {
            // Activer bouton
            btnRecipes.classList.add('border-emerald-600', 'text-emerald-600');
            btnRecipes.classList.remove('text-gray-500');
            btnFavorites.classList.add('text-gray-500');
            btnFavorites.classList.remove('border-emerald-600', 'text-emerald-600');
            
            // Afficher section
            sectionRecipes.classList.remove('hidden');
            sectionFavorites.classList.add('hidden');
        });
        
        // Clic sur "Favoris"
        btnFavorites.addEventListener('click', function() {
            // Activer bouton
            btnFavorites.classList.add('border-emerald-600', 'text-emerald-600');
            btnFavorites.classList.remove('text-gray-500');
            btnRecipes.classList.add('text-gray-500');
            btnRecipes.classList.remove('border-emerald-600', 'text-emerald-600');
            
            // Afficher section
            sectionFavorites.classList.remove('hidden');
            sectionRecipes.classList.add('hidden');
        });
    });
</script>
@endsection