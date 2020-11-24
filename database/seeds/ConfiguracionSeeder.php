<?php

use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// factory(App\Configuracion::class)->create();

        \App\Configuracion::create([
            'tasa_financiamiento' => 2.3,
            'porc_enganche' => 20,
            'plazo_maximo' => 12
        ]);
    }
}
