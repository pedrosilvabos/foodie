<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Support\Facades\Auth; 
use App\Pantry;
use Illuminate\Http\Request;
use App\Ingredients;
use App\Pantries;

class PantryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user== null){
            $user = 0;
        }
        return view('pantry.index', compact('user'));    
    
    }

    /**
     * Creates a new pantry for the specified user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create a new pantry
        $user = Auth::user();
        
        $pantries = new Pantries();
        $pantries->save();
        //get the new pantry id
        $pantry = Pantry::find($pantries->id);
        //attach the pantry id and the user id,accepts an array so itll be easy for a pantry to have multiple users
        $pantry->user()->attach(
            [$user->id]
        );
        return $pantry->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pantry = Pantry::find($id);
        if($pantry == null)
        {
            return "recipe does not exist";
        }
        $ingredients = Ingredients::whereHas('pantry', function ($query) use($id) {
            $query->where('id', 'like', $id);
        })->get();
        
        $pantry->ingredients = $ingredients;

        return $pantry->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     * check pantry for an array of ingredients
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
}
