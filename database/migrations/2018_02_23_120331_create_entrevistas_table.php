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
						$table->foreign('user_id')
						        ->references('id')
								->on('users')
								->onDelete('cascade');

						$table->string('nombre');
						$table->string('apellido');
						$table->text('direccion')->nullable();
						$table->string('email')->nullable();
						$table->string('telefono')->nullable();
						$table->string('contacto')->nullable();
						
						$table->integer('pais_id')->unsigned();
						$table->foreign('pais_id')
								->references('id')
								->on('paises')
								->onDelete('cascade');
						
						$table->string('distrito')->nullable();
						$table->string('provincia')->nullable();
						$table->string('tiempo_embarazo')->nullable();
						$table->string('sexo_bebe')->nullable();
						$table->string('tiempo_nacido')->nullable();
						$table->string('fecha_nac')->nullable();

						$table->integer('articulo_id')->unsigned();
						$table->foreign('articulo_id')
						        ->references('id')
								->on('articulos')
								->onDelete('cascade');

						$table->string('precio_ref')->nullable();
						$table->string('fecha')->nullable();
						$table->string('hora')->nullable();
						$table->integer('status')->unsigned();      
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
