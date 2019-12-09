<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipes;
use App\Ingredients;

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
        return $recipes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $recipe = new Recipes();
        $recipe->recipes_name = $request->recipes_name;
        $recipe->recipes_type = $request->recipes_type;
        $recipe->recipes_cost = $request->recipes_cost;
        $recipe->recipes_discription = $request->recipes_discription;
        $recipe->recipes_protein = $request->recipes_protein;
        $recipe->recipes_name = $request->recipes_name;
        $recipe->save();
        $ingredientCount = count($request->ingredients);
       
        for ($i = 0; $i<$ingredientCount; $i++){
            $recipe->ingredients()->attach($request->ingredients[$i],['quantity_gr' => $request->quantity[$i]]);
        }
    
  
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipes = Recipes::find($id);
        if($recipes == null)
        {
            return "recipe does not exist";
        }
        $ingredients = Ingredients::whereHas('recipes', function ($query) use($id) {
            $query->where('id', 'like', $id);
        })->get();
        
        $recipes->ingredients = $ingredients;

        return $recipes->toJson(JSON_PRETTY_PRINT);;
       
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
}
