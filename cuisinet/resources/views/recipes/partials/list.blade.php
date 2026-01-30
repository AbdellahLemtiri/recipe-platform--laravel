<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($recipes as $recipe)
        <article class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <!-- Image -->
            <div class="relative h-48 overflow-hidden">
                <img src="{{ asset('storage/' . $recipe->image) }}" 
                     alt="{{ $recipe->title }}" 
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                <div class="absolute top-3 left-3">
                    <span class="bg-white text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">
                        {{ $recipe->category->name }}
                    </span>
                </div>
            </div>

            <!-- Contenu -->
            <div class="p-5">
                <!-- En-tête -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm">
                            {{ substr($recipe->user->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-gray-700">{{ $recipe->user->name }}</span>
                    </div>
                    
                    @if($recipe->prep_time)
                    <div class="flex items-center gap-1 text-gray-500 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $recipe->prep_time }} min
                    </div>
                    @endif
                </div>

                <!-- Titre et description -->
                <a href="{{ route('recipes.show', $recipe) }}" class="block mb-3">
                    <h3 class="text-xl font-bold text-gray-900 hover:text-emerald-600 transition-colors mb-2">
                        {{ $recipe->title }}
                    </h3>
                </a>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    {{ $recipe->description }}
                </p>

                <!-- Stats -->
                <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1 text-gray-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs font-medium">{{ $recipe->favorites_count ?? 0 }}</span>
                        </div>
                        
                        <div class="flex items-center gap-1 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span class="text-xs font-medium">{{ $recipe->comments_count ?? 0 }}</span>
                        </div>
                    </div>
                    
                    @if($recipe->average_rating)
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-sm font-bold text-gray-700">{{ number_format($recipe->average_rating, 1) }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </article>

    @empty
        <!-- État vide -->
        <div class="col-span-full py-16">
            <div class="max-w-md mx-auto text-center">
                <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Aucune recette trouvée</h2>
                <p class="text-gray-600 mb-8">
                    Aucune recette ne correspond à votre recherche.
                </p>
                
                @auth
                <a href="{{ route('recipes.create') }}" 
                   class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Créer une recette
                </a>
                @endauth
            </div>
        </div>
    @endforelse
</div>