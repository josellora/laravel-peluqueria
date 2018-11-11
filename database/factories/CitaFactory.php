<?php

use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

$factory->define(App\Cita::class, function (Faker $faker) {

	$date 	= $faker->dateTimeBetween('-2 years', 'now', $timezone = null);
	$fecha 	= $date->format('Y-m-d'); 

	$mins	= ['00', '15', '30', '45'];
	$hora 	= rand ( 9 , 19 ) . ':' . $mins[array_rand($mins)];

    return [
        'fecha' 		=> $fecha,
        'hora' 			=> $hora,
        //'hora'			=> $faker->dateTimeBetween('-2 years', 'now', $timezone = null),
        'cliente_id'	=> $faker->numberBetween($min = 1, $max = 20),
    ];
});
