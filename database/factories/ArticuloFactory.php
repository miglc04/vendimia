<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articulo;
use Faker\Generator as Faker;

$factory->define(Articulo::class, function (Faker $faker) {
    return [
    	'descripcion' => $faker->text(100),
    	'modelo' => $faker->text(15),
    	'precio' => $faker->randomNumber(4),
    	'existencia' => $faker->randomNumber(2)
    ];
});
