<?php

use Illuminate\Database\Seeder;
use App\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Servicio::create([
        	'name'		=> 'Lavado',
            'price'		=> '5.50',
        ]);

        factory(Servicio::class, 9)->create();
        
    }
}
