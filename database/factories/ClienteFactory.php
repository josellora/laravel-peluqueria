<?php

use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

$factory->define(App\Cliente::class, function (Faker $faker) {

	$spanishFaker = FakerFactory::create("es_ES");
    return [
        'name' 		=> $spanishFaker->firstName,
        'surname' 	=> $spanishFaker->lastName,
        'email' 	=> $spanishFaker->unique()->safeEmail,
        'telefono'	=> $spanishFaker->phoneNumber,
    ];
});
