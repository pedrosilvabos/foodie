<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipes;

class Ingredients extends Model
{
    protected $fillable = [
        'ingredient_name',
        'ingredient_type',
        'ingredient_servings',
        'ingredient_price',
        'ingredient_quantity_kg',
        'ingredient_proteins',
        'ingredient_calories',
        'ingredient_lifetime',
        'ingredient_icon',
        'ingredient_created_at'       
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipes::class);
    }
}
