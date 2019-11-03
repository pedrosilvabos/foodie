<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api_token = Auth::user();

    Route::post('login', 'api\v1\AuthController@login');
    Route::post('register', 'api\v1\AuthController@register');
    Route::group(['middleware' => 'auth:api'], function(){
     Route::post('getUser', 'api\v1\AuthController@getUser');
    });
    Route::resource('pantry', 'api\v1\PantryController');
    Route::post('pantry/pantryOwner/{pantryId}', 'api\v1\PantryController@pantryOwner')->name('getOwner');
Route::resource('ingredients', 'api\v1\IngredientController');
Route::resource('recipes', 'api\v1\RecipeController');


