<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredients;
use App\User;

class Pantry extends Model
{
    protected $fillable = [
        'user_id','pantry_id'
        
    ];
    public function Ingredients()
    {
        return $this->belongsToMany(Ingredients::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
