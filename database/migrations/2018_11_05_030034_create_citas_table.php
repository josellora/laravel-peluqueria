<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cliente_id')->nullable(false);
            $table->date('fecha')->nullable(false);
            $table->time('hora')->nullable(false);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cliente_id')
                    ->references('id')
                    ->on('clientes')
                    ->onDelete('cascade')
                    ->onUpdae('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
