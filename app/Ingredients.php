<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipes;

class Ingredients extends Model
{
    protected $fillable = [
        'ingredient_name',
        'ingredient_type',
        'ingredient_quantity',
        'ingredient_proteins',
        'ingredient_type',
        'ingredient_price',
        'ingredient_servings',
        'ingredient_created_at'       
    ];
    public function recipes()
    {
        return $this->belongsToMany(Recipes::class);
    }
}
