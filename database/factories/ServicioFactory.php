<?php

use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

$factory->define(App\Servicio::class, function (Faker $faker) {

    return [
        'name' 		=> $faker->sentence($nbWords = 3, $variableNbWords = true),
        'price' 	=> $faker->randomFloat($nbMaxDecimals = 1, $min = 10, $max = 60),
    ];
});
