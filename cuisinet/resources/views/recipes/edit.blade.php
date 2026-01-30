<!-- @extends('layouts.app') -->

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-[#FDFBF7]">
    
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-emerald-50 blur-3xl opacity-50 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 rounded-full bg-orange-50 blur-3xl opacity-50 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto relative z-10">
        
        <div class="mb-10 text-center">
            <span class="text-emerald-600 font-bold tracking-wider uppercase text-xs bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">Mise à jour</span>
            <h1 class="mt-4 text-4xl font-black text-gray-900 tracking-tight">
                Modifier votre <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Recette</span>
            </h1>
            <p class="mt-2 text-gray-500">Corrigez les détails ou ajoutez une touche secrète !</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-8 md:p-12">
            
            <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Titre de la recette</label>
                        <input type="text" name="title" value="{{ old('title', $recipe->title) }}" 
                            class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl text-gray-900 font-bold focus:ring-2 focus:ring-emerald-500 transition placeholder-gray-400" 
                            placeholder="ex: Tajine aux pruneaux" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Catégorie</label>
                        <div class="relative">
                            <select name="category_id" class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl text-gray-900 font-bold focus:ring-2 focus:ring-emerald-500 appearance-none cursor-pointer">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </button>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Photo du plat</label>
                        <div class="relative group">
                            <div class="absolute right-2 top-2 z-10">
                                <img src="{{ asset('storage/' . $recipe->image) }}" class="w-10 h-10 rounded-lg object-cover border-2 border-white shadow-sm" title="Image actuelle">
                            </div>
                            
                            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-4 file:px-6 file:rounded-2xl file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition cursor-pointer bg-gray-50 rounded-2xl">
                        </div>
                        <p class="text-xs text-gray-400 mt-2 ml-2">Laissez vide pour garder l'image actuelle.</p>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Description courte</label>
                        <textarea name="description" rows="3" class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl text-gray-900 font-medium focus:ring-2 focus:ring-emerald-500 transition placeholder-gray-400" placeholder="Donnez envie en quelques mots...">{{ old('description', $recipe->description) }}</textarea>
                    </div>

                    <div class="col-span-2 bg-emerald-50/50 p-6 rounded-3xl border border-emerald-100">
                        <div class="flex justify-between items-center mb-4">
                            <label class="block text-sm font-bold text-gray-800">Ingrédients</label>
                            <button type="button" onclick="addIngredient()" class="text-xs font-bold text-emerald-600 bg-white px-3 py-1.5 rounded-lg border border-emerald-200 hover:bg-emerald-50 transition shadow-sm">
                                + Ajouter
                            </button>
                        </div>
                        
                        <div id="ingredients-container" class="space-y-3">
                            @if(is_array($recipe->ingredients))
                                @foreach($recipe->ingredients as $index => $ing)
                                    <div class="flex gap-3 group">
                                        <div class="w-1/3">
                                            <input type="text" name="ingredients_qty[]" 
                                                value="{{ is_array($ing) ? $ing['qty'] : '' }}"
                                                class="w-full px-4 py-3 bg-white border-0 text-gray-900 font-medium rounded-xl shadow-sm focus:ring-2 focus:ring-emerald-400 placeholder-gray-400" 
                                                placeholder="Qté" required>
                                        </div>
                                        <div class="flex-1">
                                            <input type="text" name="ingredients_name[]" 
                                                value="{{ is_array($ing) ? $ing['name'] : $ing }}"
                                                class="w-full px-4 py-3 bg-white border-0 text-gray-900 font-medium rounded-xl shadow-sm focus:ring-2 focus:ring-emerald-400 placeholder-gray-400" 
                                                placeholder="Ingrédient" required>
                                        </div>
                                        <button type="button" onclick="this.closest('.flex').remove()" class="w-12 flex items-center justify-center bg-white border border-red-100 text-red-400 hover:bg-red-50 hover:text-red-600 hover:border-red-200 rounded-xl transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Instructions de préparation</label>
                        <textarea name="instructions" rows="6" class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl text-gray-900 font-medium focus:ring-2 focus:ring-emerald-500 transition placeholder-gray-400 leading-relaxed" placeholder="Détaillez les étapes...">{{ old('instructions', is_array($recipe->instructions) ? implode("\n", $recipe->instructions) : $recipe->instructions) }}</textarea>
                        <p class="text-xs text-gray-400 mt-2 ml-2">Conseil: Sautez des lignes pour chaque étape.</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition">
                        Annuler
                    </a>
                    <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-emerald-600 hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-gray-200">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addIngredient() {
        const container = document.getElementById('ingredients-container');
        const div = document.createElement('div');
        div.className = 'flex gap-3 group animate-fadeIn mt-2';
        
        div.innerHTML = `
            <div class="w-1/3">
                <input type="text" name="ingredients_qty[]" class="w-full px-4 py-3 bg-white border-0 text-gray-900 font-medium rounded-xl shadow-sm focus:ring-2 focus:ring-emerald-400 placeholder-gray-400" placeholder="Qté" required>
            </div>
            <div class="flex-1">
                <input type="text" name="ingredients_name[]" class="w-full px-4 py-3 bg-white border-0 text-gray-900 font-medium rounded-xl shadow-sm focus:ring-2 focus:ring-emerald-400 placeholder-gray-400" placeholder="Ingrédient" required>
            </div>
            <button type="button" onclick="this.closest('.flex').remove()" class="w-12 flex items-center justify-center bg-white border border-red-100 text-red-400 hover:bg-red-50 hover:text-red-600 hover:border-red-200 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        `;
        
        container.appendChild(div);
        div.querySelector('input').focus();
    }
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }
</style>
@endsection