<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('cantidad')->unsigned();
            $table->integer('modelo_id')->unsigned();
            $table->foreign('modelo_id')
                    ->references('id')
                    ->on('modelos')
                    ->onDelete('cascade');
            $table->integer('color_id')->unsigned();
            $table->foreign('color_id')
                    ->references('id')
                    ->on('colores')
                    ->onDelete('cascade');
            $table->text('observacion')->nullable();      
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
        Schema::dropIfExists('articulos');
    }
}
