<?php

use Illuminate\Database\Seeder;
use App\Cita;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Cita::create([
        	'cliente_id'	=> 1,
            'fecha'         => '2018-11-11',
            'hora'         => '11:11',
        ]);

        factory(Cita::class, 199)->create();
        
    }
}
