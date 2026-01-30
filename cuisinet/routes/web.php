<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [RecipeController::class, 'index'])->name('home');



Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::PUT('/recipes/{recipe}/update', [RecipeController::class, 'update'])->name('recipes.update');
    Route::get('/recipes/{recipe}/distroy', [RecipeController::class, 'distroy'])->name('recipes.distroy');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
    Route::get('/profile/{user}', [RecipeController::class, 'profile'])->name('profile.show');
    Route::post('/recipes/{recipe}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/recipes/{recipe}/favorite', [FavoriteController::class, 'toggle'])->name('recipes.favorite');
    Route::get('/recipes/{recipe}/show', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/dashboard', [RecipeController::class, 'dashboard'])->name('dashboard');
});
