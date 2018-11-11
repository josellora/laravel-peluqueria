<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitaLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita_lineas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cita_id')->nullable(false);
            $table->morphs('cita_linea_origen'); //la clave de todo
            //$table->unsignedInteger('origen_id');
            //$table->enum('origen_type', ['SERVICIO', 'ARTICULO', 'PRODUCTO', 'OTRO']);
            $table->string('concepto', 128)->nullable(false);
            $table->decimal('precio', 5, 2)->nullable();
            $table->integer('cantidad')->nullable();
            $table->timestamps();

            $table->foreign('cita_id')
                    ->references('id')
                    ->on('citas')
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
        Schema::dropIfExists('cita_lineas');
    }
}
