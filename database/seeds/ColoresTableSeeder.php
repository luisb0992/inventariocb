<?php

use Illuminate\Database\Seeder;

class ColoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colores = array(
  			array(
  				'name' => 'Negro'),
  			array(
  				'name' => 'Rojo'),
  			array(
  				'name' => 'Celeste'),
  			array(
  				'name' => 'Rosado'),
  			array(
  				'name' => 'Gris'),
  			array(
  				'name' => 'Beige'),
  			array(
  				'name' => 'Marron'),
  			array(
  				'name' => 'Negro'),
  			array(
  				'name' => 'Blanco'),
  			array(
  				'name' => 'Marron con beige'),
  			array(
  				'name' => 'Azul'),
  			array(
  				'name' => 'Verde'),
  			array(
  				'name' => 'Amarillo'),
  			array(
  				'name' => 'Naranja'),
  		);

  		\DB::table('colores')->insert($colores);
    }
}
