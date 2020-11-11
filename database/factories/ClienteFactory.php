<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido_paterno' => $faker->lastName,
        'apellido_materno' => $faker->lastName,
        'rfc' => $faker->text(18),
    ];
});
