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

Route::post('register','api\v1\AuthController@register');
Route::post('login','api\v1\AuthController@login');
Route::middleware('auth:api')->resource('ingredients', 'api\v1\IngredientController');
Route::middleware('auth:api')->resource('pantry', 'api\v1\PantryController');