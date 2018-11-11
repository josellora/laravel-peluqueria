<?php

use Faker\Generator as Faker;

$factory->define(App\Articulo::class, function (Faker $faker) {
    return [
        'name' 		=> $faker->sentence($nbWords = 3, $variableNbWords = true),
        'price' 	=> $faker->randomFloat($nbMaxDecimals = 1, $min = 10, $max = 60),
    ];
});
