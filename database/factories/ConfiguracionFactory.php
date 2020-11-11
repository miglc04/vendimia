<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Configuracion;
use Faker\Generator as Faker;

$factory->define(Configuracion::class, function (Faker $faker) {
    return [
        'tasa_financiamiento' => 2.3,
        'porc_enganche' => 20,
        'plazo_maximo' => 12,
    ];
});
