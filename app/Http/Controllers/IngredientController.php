<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredients;
use Auth;

class IngredientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //maybe we should use auth middleware
        $ingredients = Ingredients::all();
        $user = Auth::user();
        if($user== null){
            $user = 0;
        }
        return view('ingredient.index', compact('ingredients', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('ingredient.create', compact('user'));
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
        $ingredient->ingredient_name = $request->get('ingredient_name');
        $ingredient->ingredient_type = $request->get('ingredient_type');
        $ingredient->ingredient_quantity = $request->get('ingredient_quantity');
        $ingredient->ingredient_proteins = $request->get('ingredient_proteins');
        $ingredient->ingredient_type = $request->get('ingredient_type');
        $ingredient->ingredient_price = $request->get('ingredient_price');
        $ingredient->ingredient_servings = $request->get('ingredient_servings');
        $ingredient->created_at = date("Y-m-d H:i:s");
        //recheck this updated and created at
        $ingredient->save();

        return 'Success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', compact('ingredientss'));
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
