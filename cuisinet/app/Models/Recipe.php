<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'instructions',
        'image',
        'category_id',
        'user_id'
    ];


    protected $casts = [
        'ingredients' => 'array',
        'instructions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favoritedBy->contains($user);
    }
}
