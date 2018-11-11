<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Cliente::create([
        	'name'		=> 'Angeles',
        	'surname'	=> 'Tortajada',
        	'email'		=> 'atortor@gmail.com',
        	'telefono'	=> '654987321',
        ]);

        factory(Cliente::class, 20)->create();
    }
}
