<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipes;

class Ingredients extends Model
{
    protected $fillable = [
        'name',
        'type',
        'servings',
        'price',
        'quantity_kg',
        'proteins',
        'calories',
        'lifetime',
        'icon',
        'created_at'       
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipes::class);
    }
}
