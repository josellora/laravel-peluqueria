<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   

        /*
        * Mapa de nombres para las relaciones polimórficas
        */
        Relation::morphMap([
            'servicios' => 'App\Servicio',
        ]);



        /*
        * Para evitar el error en las migraciones
        * SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
        */
        Schema::defaultStringLength(128);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
