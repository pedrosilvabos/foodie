<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Ingredients;


$factory->define(App\Ingredients::class, function (Faker $faker) {
$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
    return [
        
        'ingredient_name' => $faker->vegetableName(),
        'ingredient_type' => $faker->text(20),
        'ingredient_quantity_kg' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10),
        'ingredient_proteins' => $faker->randomFloat($nbMaxDecimals = 0, $min = 0, $max = 900),
        'ingredient_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10),
        'ingredient_servings' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10),
  
    ];
});

