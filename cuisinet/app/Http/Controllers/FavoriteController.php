<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
class FavoriteController extends Controller
{
    //

    public function toggle(Recipe $recipe)
    {
        
        Auth::user()->favorites()->toggle($recipe->id);
        return back();  
    }
}
