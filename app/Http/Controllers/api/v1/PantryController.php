<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pantry;
use App\Ingredients;
use App\User;
use Illuminate\Support\Facades\Auth;
class PantryController extends Controller
{
    /**
     * Display a listing of patries for a specif user
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
   //this is wrongm and index has no arguments!!!
       // $pantries = Pantry::all(); //gets all the pantries good for admin
       $pantries = Pantry::where('user_id', $id);

        if($pantries == null)
        {
            return "there are no pantries";
        }
        $numberOfPantries = count($pantries)-1;
        //this gets one user for one pantry
        for ($x = 0; $x <= $numberOfPantries; $x++) {
            $pantryId = $pantries[$x]->id;
            $user = User::whereHas('pantry', function ($query) use($pantryId) {
            $query->where('pantry_id', 'like', $pantryId);
            })->get();
            //this gets all the users for each pantry
            $numberOfUsers = count($user)-1;
            $listOfUsers = [];
            for($y = 0; $y <= $numberOfUsers; $y++){
                
                array_push($listOfUsers, $user[$y]->name);
            }
            $pantries[$x]->{"name"}= $listOfUsers;

        }
        
        return $pantries->toJson(JSON_PRETTY_PRINT);;
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
        $ingredient = new Ingredients;

        $ingredient->name = $request->name;
        $ingredient->type = $request->type;
        $ingredient->price = $request->price;

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
        //this gets the pantries for the user with the $id in an array with the pantries in objects
        $pantry = Pantry::whereHas('user', function ($query) use($id) {
            $query->where('user_id', 'like', $id);
        })->get();

        if($pantry == null)
        {
            return "pantry does not exist";
        }
        $ingredients = Ingredients::whereHas('pantry', function ($query) use($id) {
            $query->where('id', 'like', $id);
        })->get();
        
        $pantry->ingredients = $ingredients;

        return $pantry->toJson(JSON_PRETTY_PRINT);;
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
        $justIds = [];
        for($i = 0; $i < count((array)$request['ingredient']); ++$i) {
            array_push($justIds,$request['ingredient'][$i]['id']);
        }
        $pantry = new Pantry();
        //this keeps the ingredients passed into a specific pantry
        $pantry->Ingredients()->attach($justIds, ['pantry_id' => $id]);
        return "OK";
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
    public function checkForIngredient()
    {   
        $pantry  = [1, 10, 30];
        $id = [10, 20, 30];
        
        $ingredient = Ingredients::find(array_diff($pantry, $id));
       return  $ingredient;
        
    }
   
}
