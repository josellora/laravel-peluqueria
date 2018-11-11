<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    protected $toTruncate = ['users', 'citas', 'clientes'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Class ________Seeder does not exist
        // composer dump-autoload

        //$this->truncateTables();

        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(CitaSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(ArticuloSeeder::class);
    }
    
    public function truncateTables() {
        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
    }
}
