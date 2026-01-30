@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Image principale -->
        <div class="mb-6">
            <img src="{{ asset('storage/' . $recipe->image) }}" 
                 alt="{{ $recipe->title }}" 
                 class="w-full h-64 object-cover rounded-lg shadow">
        </div>

        <!-- En-tête -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $recipe->category->name }}
                </span>
                
                @auth
                <form action="{{ route('recipes.favorite', $recipe) }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2">
                        @if($recipe->isFavoritedBy(Auth::user()))
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        @endif
                        <span class="text-sm text-gray-600">{{ $recipe->favoritedBy->count() }}</span>
                    </button>
                </form>
                @endauth
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $recipe->title }}</h1>
            
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-medium">
                    {{ substr($recipe->user->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">Par {{ $recipe->user->name }}</p>
                    <p class="text-xs text-gray-500">Publié {{ $recipe->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-8 p-4 bg-gray-50 rounded-lg">
            <h2 class="text-lg font-bold text-gray-900 mb-2">Description</h2>
            <p class="text-gray-700">{{ $recipe->description }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Ingrédients -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ingrédients</h2>
                    
                    <ul class="space-y-3">
                        @if(is_array($recipe->ingredients))
                            @foreach($recipe->ingredients as $ing)
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-emerald-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-700">
                                        @if(is_array($ing))
                                            <span class="font-medium">{{ $ing['qty'] }}</span> {{ $ing['name'] }}
                                        @else
                                            {{ $ing }}
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <p class="text-gray-400 italic">Aucun ingrédient listé.</p>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Préparation -->
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Préparation</h2>
                    
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($recipe->instructions)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Commentaires -->
        <div class="border-t border-gray-200 pt-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Commentaires ({{ $recipe->comments->count() }})</h2>
            </div>

            @auth
            <form action="{{ route('comments.store', $recipe) }}" method="POST" class="mb-8">
                @csrf
                <div class="mb-4">
                    <textarea name="content" rows="3" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="Partagez votre avis..."></textarea>
                </div>
                <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-emerald-700 transition">
                    Envoyer
                </button>
            </form>
            @else
            <div class="mb-8 p-4 bg-gray-50 rounded-lg text-center">
                <p class="text-gray-600 mb-2">Connectez-vous pour commenter</p>
                <a href="{{ route('login') }}" class="text-emerald-600 font-medium hover:underline">Se connecter</a>
            </div>
            @endauth

            <!-- Liste des commentaires -->
            <div class="space-y-6">
                @forelse($recipe->comments as $comment)
                    <div class="border-b border-gray-100 pb-6 last:border-0">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-medium flex-shrink-0">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="font-medium text-gray-900">{{ $comment->user->name }}</h4>
                                    <span class="text-xs text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-gray-700">{{ $comment->content }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <p class="text-gray-400">Aucun commentaire pour le moment</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection