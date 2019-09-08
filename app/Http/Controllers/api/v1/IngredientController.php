<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ingredients;
class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredients::all();
        return $ingredients;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingredient = new Ingredients;

        $ingredient->name = $request->name;
        $ingredient->type = $request->type;
        $ingredient->price = $request->price;
        $ingredient->servings = $request->servings;
        $ingredient->quantity_kg = $request->quantity_kg;
        $ingredient->proteins = $request->proteins;
        $ingredient->calories = $request->calories;
        $ingredient->lifetime = $request->lifetime;
        $ingredient->icon = $request->icon;


        $ingredient->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingredient = Ingredients::find($id);
        if($ingredient == null)
        {
            return "ingredient does not exist";
        }

        return $ingredient;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function v($id)
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
      
         $ingredient = Ingredients::find($id);
         if($ingredient == null)
         {
             return "ingredient does not exist";
         }
        $ingredient->name = $request->name;
        $ingredient->type = $request->name;
        $ingredient->price = $request->name;
        $ingredient->quantity_kg = $request->name;
        $ingredient->proteins = $request->name;
        $ingredient->calories = $request->name;
        $ingredient->lifetime = $request->name;
        $ingredient->icon = $request->name;

         $ingredient->save();

         $updated = Ingredients::find($id);
         return $updated;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredients::find($id);
        if($ingredient == null)
        {
            return "ingredient does not exist";
        }
        $ingredient->delete();

        return $ingredientc['name'] . " was deleted";
    }
}
