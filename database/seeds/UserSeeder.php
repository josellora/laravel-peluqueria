<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
        	'name'		=> 'jose',
        	'email'		=> 'josellora@hotmail.com',
        	'password'	=> bcrypt('llora'),
        ]);

        factory(User::class, 9)->create();
    }


}
