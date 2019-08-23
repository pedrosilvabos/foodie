<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

   
});
Route::get('recipe/create', 'RecipeController@create')->name('recipe.create');
Route::get('recipe/{recipe}', 'RecipeController@show')->name('recipe.show');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('recipe/ingredient/{ingredient}', 'RecipeController@destroy')->name('recipe.ingredient.delete');