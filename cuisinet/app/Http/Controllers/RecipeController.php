<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(Request $request)
    { 
        $query = Recipe::with(['category', 'user'])->latest();
 
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
 
        if ($request->has('category_id') && $request->category_id != 'all') {
            $query->where('category_id', $request->category_id);
        }
 
        $recipes = $query->get();
 
        $totalRecipes = Recipe::count();
        $topRecipes = Recipe::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();

        $categories = Category::all();
 
        return view('recipes.index', compact('recipes', 'categories', 'totalRecipes', 'topRecipes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'ingredients_qty' => 'required|array|min:1',
            'ingredients_name' => 'required|array|min:1',
            'instructions' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
        ]);


        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('recipes', 'public');
        }

        $final_ingredients = [];
        for ($i = 0; $i < count($request->ingredients_name); $i++) {
            $final_ingredients[] = [
                'qty' => $request->ingredients_qty[$i],
                'name' => $request->ingredients_name[$i]
            ];
        }
        //  [{"qty":"200g", "name":"Farine"},]

        Recipe::create([
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $final_ingredients,
            'instructions' => $request->instructions,
            'category_id' => $request->category_id,
            'image' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('home')->with('success', 'Recette créée avec succès !');
    }
    public function dashboard()
    {

        $user = Auth::user();
        $myRecipes = $user->recipes()->latest()->get();
        $myFavorites = $user->favorites()->latest()->get();
        return view('dashboard', compact('myRecipes', 'myFavorites'));
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !==  Auth::id()) {
            abort(403, "cette publication ne  Pas seulement pour vous");
        }


        if ($recipe->image) {
             Storage::disk('public')->delete($recipe->image);
        }

        $recipe->delete();
        return back()->with('success', 'Recette supprimée avec succès !');
    }


    public function edit(string $id)
    {
        $categories  = Category::All();
        $recipe = Recipe::find($id);
        return view('recipes.edit', compact('recipe', 'categories'));
    }
    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {

            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }

            $data['image'] = $request->file('image')->store('recipes', 'public');
        }

        if ($request->has('ingredients_name')) {
            $final_ingredients = [];
            for ($i = 0; $i < count($request->ingredients_name); $i++) {
                $final_ingredients[] = [
                    'qty' => $request->ingredients_qty[$i],
                    'name' => $request->ingredients_name[$i]
                ];
            }
            $data['ingredients'] = $final_ingredients;
        }

        $recipe->update($data);

        return redirect()->route('dashboard')->with('success', 'Recette mise à jour avec succès !');
    }





    public function show(string $id)
    {

        $recipe = Recipe::find($id);
        $categories = Category::all();

        return view('recipes.show', compact('recipe', 'categories'));
    }
}
