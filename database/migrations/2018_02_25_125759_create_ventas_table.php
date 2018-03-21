<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_contrato');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->integer('articulo_id')->unsigned();
            $table->foreign('articulo_id')
                    ->references('id')
                    ->on('articulos')
                    ->onDelete('cascade');

            $table->text('descripcion')->nullable();        
            $table->decimal('precio',15,2); //centavos      
            
            $table->integer('unidad_id')->unsigned(); //soles, dolares, euros
            $table->foreign('unidad_id')
                    ->references('id')
                    ->on('unidades')
                    ->onDelete('cascade');

            $table->decimal('entrada',15,2); //centavos
            $table->decimal('salida',15,2); //centavos
            $table->decimal('deuda',15,2); //centavos

            $table->integer('status_id')->unsigned(); //status de entrega
            $table->foreign('status_id')
                    ->references('id')
                    ->on('status')
                    ->onDelete('cascade');

            $table->integer('entrevista_id')->unsigned(); //entrevista
            $table->foreign('entrevista_id')
                    ->references('id')
                    ->on('entrevistas')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('ventas');
    }
}
