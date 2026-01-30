<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Recipe;
    //

class CommentController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'recipe_id' => $recipe->id
        ]);

        return back()->with('success', 'Commentaire ajouté !');
    }
}


