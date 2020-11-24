<?php

use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// factory(App\Cliente::class, 10)->create();

        \App\Cliente::create([
            'nombre' => 'Miguel',
            'apellido_paterno' => 'Lopez',
            'apellido_materno' => 'Cabrera',
            'rfc' => 'QWERTYUIOPQWERTY01',
        ]);

        \App\Cliente::create([
            'nombre' => 'Toribio',
            'apellido_paterno' => 'Lugo',
            'apellido_materno' => 'Villegas',
            'rfc' => 'QWERTYUIOPQWERTY02',
        ]);

        \App\Cliente::create([
            'nombre' => 'Perla',
            'apellido_paterno' => 'Perez',
            'apellido_materno' => 'Perez',
            'rfc' => 'QWERTYUIOPQWERTY03',
        ]);

        \App\Cliente::create([
            'nombre' => 'Rubi',
            'apellido_paterno' => 'Cervantes',
            'apellido_materno' => 'Cervantes',
            'rfc' => 'QWERTYUIOPQWERTY04',
        ]);

        \App\Cliente::create([
            'nombre' => 'Rubi',
            'apellido_paterno' => 'Espinoza',
            'apellido_materno' => 'Espinoza',
            'rfc' => 'QWERTYUIOPQWERTY05',
        ]);
    }
}
