<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredients;

class Recipes extends Model
{
    protected $fillable = [
        'recipes_name',
        'recipes_type',
        'recipes_cost',
        'recipes_discription',
        'recipes_protein',
     
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredients::class);
    }
}
