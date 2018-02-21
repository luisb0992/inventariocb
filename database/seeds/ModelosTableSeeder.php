<?php

use Illuminate\Database\Seeder;

class ModelosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelos = array(
  			array(
  				'name' => 'Barcelona'),
  			array(
  				'name' => 'Cuenca'),
  			array(
  				'name' => 'Cordova'),
  			array(
  				'name' => 'Ibiza'),
  			array(
  				'name' => 'Madrid'),
  			array(
  				'name' => 'Mallorca'),
  			array(
  				'name' => 'Menorca'),
  			array(
  				'name' => 'Sevilla'),
  			array(
  				'name' => 'Valencia'),
  		);

  		\DB::table('modelos')->insert($modelos);
    }
}
