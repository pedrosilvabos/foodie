<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Recipes extends Model
{
    protected $fillable = [
        'recipes_name',
        'recipes_type',
        'recipes_cost',
        'recipes_discription',
        'recipes_protein',
        'recipes_preparation',
     
    ];
   
    public function ingredients()
    {
        return $this->belongsToMany(Ingredients::class);
    }
}
