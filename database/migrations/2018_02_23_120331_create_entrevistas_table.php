<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('nombre');
            $table->string('apellido');
            $table->text('direccion')->nullable();
            $table->string('email');
            $table->string('telefono');
            $table->string('contacto');
            $table->integer('pais_id')->unsigned();
            $table->foreign('pais_id')->references('id')
                  ->on('paises')
                  ->onDelete('cascade');
            $table->string('distrito')->nullable();
            $table->string('provincia')->nullable();
            $table->string('tiempo_embarazo')->nullable();
            $table->string('sexo_bebe')->nullable();
            $table->integer('comentario_id')->unsigned();
            $table->foreign('comentario_id')->references('id')
                  ->on('comentarios')
                  ->onDelete('cascade');
            $table->dateTime('fecha_hora_cita');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrevistas');
    }
}
