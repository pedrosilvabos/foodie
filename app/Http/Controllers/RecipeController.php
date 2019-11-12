<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $recipes = Recipes::all();
        $user = Auth::user();
        if($user== null){
            $user = 0;
        }
        return view('recipe.index', compact('recipes', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      

        
        return view('recipe.create' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipes $recipe)
    {
    
        return view('recipe.show', compact('recipe'));
    }
/**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $recipe = new Recipes;
        $recipe->recipes_name = $request->get('recipe_name');
        $recipe->recipes_protein = $request->get('recipe_protein');
        $recipe->recipes_type = $request->get('recipe_type');
        $recipe->recipes_cost = $request->get('recipe_cost');
        $recipe->recipes_discription = $request->get('recipe_discription');
        $recipe->updated_at = date("Y-m-d H:i:s");
        $recipe->created_at = date("Y-m-d H:i:s");
//recheck this updated and created at
        $recipe->save();
//the ingredients need to be selected in javasript
        $ingredient = Ingredients::find([1, 2]);

        $recipe->ingredients()->attach($ingredient);

        return 'Success';
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

    public function ajax($id) {
        $msg = "This is a simple message.";
      
        return response()->json(array('msg'=> $id), 200);
     }
}
