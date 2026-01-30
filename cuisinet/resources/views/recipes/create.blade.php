@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 bg-gray-50">
    <div class="max-w-3xl mx-auto">
        
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Créer une nouvelle recette</h1>
            <p class="text-gray-600">Partagez votre recette avec la communauté</p>
        </div>

        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 md:p-8">
            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Titre -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre de la recette</label>
                    <input type="text" name="title" id="title"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                           placeholder="ex: Tajine aux pruneaux" required>
                </div>

                <!-- Catégorie -->
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select name="category_id" id="category_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                              placeholder="Décrivez votre recette..." required></textarea>
                </div>

                <!-- Ingrédients -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <label class="block text-sm font-medium text-gray-700">Ingrédients</label>
                        <button type="button" onclick="addIngredient()"
                                class="text-sm text-emerald-600 font-medium hover:text-emerald-700">
                            + Ajouter un ingrédient
                        </button>
                    </div>
                    
                    <div id="ingredients-container" class="space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input type="text" name="ingredients_qty[]"
                                   class="px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500"
                                   placeholder="Quantité (ex: 200g)" required>
                            <input type="text" name="ingredients_name[]"
                                   class="px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500"
                                   placeholder="Nom de l'ingrédient" required>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="mb-6">
                    <label for="instructions" class="block text-sm font-medium text-gray-700 mb-2">Instructions</label>
                    <textarea name="instructions" id="instructions" rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                              placeholder="Étapes de préparation..." required></textarea>
                </div>

                <!-- Image -->
                <div class="mb-8">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                    
                    <div id="image-upload-container" class="relative">
                        <input type="file" name="image" id="image" 
                               onchange="previewImage(event)"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                               accept="image/*" required>
                        
                        <div id="upload-placeholder" class="mt-2 text-sm text-gray-500">
                            PNG, JPG jusqu'à 2MB
                        </div>
                        
                        <img id="image-preview" src="#" alt="Aperçu" 
                             class="mt-4 max-h-64 rounded-lg hidden">
                    </div>
                </div>

                <!-- Submit -->
                <div class="pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="w-full bg-emerald-600 text-white font-medium py-3 rounded-lg hover:bg-emerald-700 transition">
                        Publier la recette
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
        div.className = 'grid grid-cols-1 md:grid-cols-2 gap-3 mt-3';
        
        div.innerHTML = `
            <input type="text" name="ingredients_qty[]"
                   class="px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500"
                   placeholder="Quantité" required>
            <div class="flex gap-2">
                <input type="text" name="ingredients_name[]"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500"
                       placeholder="Nom" required>
                <button type="button" onclick="this.parentElement.parentElement.remove()"
                        class="px-3 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded">
                    ✕
                </button>
            </div>
        `;
        
        container.appendChild(div);
        div.querySelector('input').focus();
    }

    function previewImage(event) {
        const imageField = document.getElementById("image-preview");
        const placeholder = document.getElementById("upload-placeholder");
        
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imageField.src = e.target.result;
                imageField.classList.remove("hidden");
                placeholder.classList.add("hidden");
            }
            
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection