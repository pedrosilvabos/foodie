<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ingredients;
use App\Recipes;
;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $recipe = new Recipes;
        $recipe->recipes_name = 'Peixe no forno';
        $recipe->recipes_protein = 40;
        $recipe->recipes_type = "jantar";
        $recipe->recipes_cost = 40;
        $recipe->recipes_discription = "comida favorita da Alice";

        $recipe->save();

        $ingredient = Ingredients::find([1, 2]);
    
        $recipe->ingredients()->attach($ingredient);

        return 'Success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipes $recipe)
    {
       // dd($recipe);
        return view('recipe.show', compact('recipe'));
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
    public function destroy(Ingredients $ingredient)
    {
        $recipe = Recipes::find(3);

        $ingredient->recipes()->detach($ingredient);
    }
}
