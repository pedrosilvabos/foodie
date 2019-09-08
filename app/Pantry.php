<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredients;
class Pantry extends Model
{
    protected $fillable = [
        'user_id',
        
    ];
    public function Ingredients()
    {
        return $this->belongsToMany(Ingredients::class);
    }
    
}
