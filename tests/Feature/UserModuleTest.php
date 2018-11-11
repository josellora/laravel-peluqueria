<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class UserModuleTest extends TestCase
{

	use RefreshDatabase;

    /**  @test */
    function test_example()
    {
        $this->get('/hola')
        	->assertStatus(200)
        	->assertSeeText('hola');
    }

    
    /**  @test */
    function listado_de_usuarios()
    {
        $this->withoutExcepcionHandling();

        $this->get('/users')
        	->assertStatus(200)
        	->assertSeeText('Listado de Usuarios')
        	->assertSeeText('No hay usuarios que mostrar');

        User::create([
        	'name'		=> 'jose',
        	'email'		=> 'josellora@hotmail.com',
        	'password'	=> bcrypt('llora'),
        ]);

        factory(User::class)->create([
        	'name'		=> 'juan',
        ]);

        factory(User::class, 8)->create();

        $this->get('/users')
        	->assertStatus(200)
        	->assertSeeText('juan')
        	->assertSeeText('jose');

    }

    /**  @test */
    function detalle_de_usuario()
    {
        $user = factory(User::class)->create([
        	'name'		=> 'juan',
        ]);


        $this->get('/users/' . $user->id)
        	->assertStatus(200)
        	->assertSeeText('juan');

    }

	        	




}
