<?php

use Illuminate\Database\Seeder;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// factory(App\Articulo::class, 10)->create();

        \App\Articulo::create([
            'descripcion' => 'Lavadora',
            'modelo' => 'ABCD',
            'precio' => 2000,
            'existencia' => 5
        ]);

        \App\Articulo::create([
            'descripcion' => 'Secadora',
            'modelo' => 'ZXCV',
            'precio' => 2000,
            'existencia' => 5
        ]);

        \App\Articulo::create([
            'descripcion' => 'Refrigerador',
            'modelo' => 'QWERT',
            'precio' => 2750,
            'existencia' => 2
        ]);

         \App\Articulo::create([
            'descripcion' => 'Estufa',
            'modelo' => 'UIOP',
            'precio' => 1500,
            'existencia' => 3
        ]);

          \App\Articulo::create([
            'descripcion' => 'Microondas',
            'modelo' => 'TYUI',
            'precio' => 2100,
            'existencia' => 0
        ]);

    }
}
