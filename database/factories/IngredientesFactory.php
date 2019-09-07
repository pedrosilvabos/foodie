<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Ingredients;


$factory->define(App\Ingredients::class, function (Faker $faker) {
$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
    return [
        
        'name' => $faker->vegetableName(),
        'type' => $faker->text(20),
        'quantity_kg' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10),
        'icon' => $faker->image($dir = public_path('images/icons'), $width = 100, $height = 100, 'cats'),
        'proteins' => $faker->randomFloat($nbMaxDecimals = 0, $min = 0, $max = 900),
        'calories' => $faker->randomFloat($nbMaxDecimals = 0, $min = 0, $max = 900),
        'lifetime' => $faker->randomFloat($nbMaxDecimals = 0, $min = 0, $max = 30),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10),
        'servings' => $faker->randomFloat($nbMaxDecimals = 0, $min = 1, $max = 10),
  
    ];
});

