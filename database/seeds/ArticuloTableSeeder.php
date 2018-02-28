<?php

use Illuminate\Database\Seeder;

class ArticuloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $articulos = array(
			  			array(
			  				'id' => '1',
			  				'name' => 'Coches de bebe',
			  				'cantidad' => '2',
			  				'modelo_id' => '1',
			  				'color_id' => '1',
			  			),
			  			array(
			  				'id' => '2',
			  				'name' => 'Coches baston',
			  				'cantidad' => '2',
			  				'modelo_id' => '2',
			  				'color_id' => '6',
			  			),
			  			array(
			  				'id' => '3',
			  				'name' => 'Coches de bebe + asiento',
			  				'cantidad' => '2',
			  				'modelo_id' => '3',
			  				'color_id' => '4',
			  			),
			  			array(
			  				'id' => '4',
			  				'name' => 'Silla de comer',
			  				'cantidad' => '2',
			  				'modelo_id' => '4',
			  				'color_id' => '2',
			  			)
			  		);

  		\DB::table('articulos')->insert($articulos);
    }
}
