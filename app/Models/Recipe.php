<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'image',
        'description',
        'cooking_time',
        'has_dishes',
        'instructions',
        'reference_url',
        'user_id'
    ];

    protected $casts = [
        'instructions' => 'array',
        'has_dishes' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function shoppingMemos()
    {
        return $this->hasMany(ShoppingMemo::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
