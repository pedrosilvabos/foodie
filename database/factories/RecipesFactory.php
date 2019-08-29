<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Recipes;
use App\Ingredients;

$factory->define(App\Recipes::class, function (Faker $faker) {
$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
    return [
        'id' =>  factory('App\Ingredients')->create()->id,
        'recipes_name' => $faker->foodName(),
        'recipes_type' => $faker->text(20),
        'recipes_cost'=> $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10),
        'recipes_discription'=> $faker->text(90),
        'recipes_protein'=> $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 900),

    ];
});
