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
        $recipeIngredientDepedency = factory(App\Recipes::class, 10)
        ->create()
        ->each(function ($ingredient) {
            $ingredient
            ->ingredients()
            ->save(factory(App\Ingredients::class)
            ->make());
            $ingredient
            ->ingredients()
            ->save(factory(App\Ingredients::class)
            ->make());
        });
        
    }
}
