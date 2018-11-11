<?php

use Illuminate\Database\Seeder;
use App\Articulo;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Articulo::create([
            'name'      => 'Secador',
            'price'     => '55.50',
        ]);
        Articulo::create([
            'name'      => 'Cepillo',
            'price'     => '5.00',
        ]);

        factory(Articulo::class, 9)->create();
        
    }
}
