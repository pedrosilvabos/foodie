<?php

use Illuminate\Database\Seeder;
use App\Recipes;
use App\Ingredients;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $populateRecipes = factory(App\Recipes::class, 10)->create();

        $populateIngredients = factory(App\Ingredients::class, 10)->create();

        $allIngredients = App\Ingredients::all();
        //for each recipe attach a random  number (1 to 3) of random ingredient
        App\Recipes::all()->each(function ($Recipe) use ($allIngredients) { 
            $Recipe->ingredients()->attach(
                $allIngredients->random(rand(1, 3))->pluck('id')->toArray()
            );
            
        });
        
    }
}
