<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = array(
  			array(
  				'name' => 'Entregado'),
  			array(
  				'name' => 'Separado'),
  			array(
  				'name' => 'Seguimiento'),
  			array(
  				'name' => 'En espera'),
        array(
          'name' => 'De Baja')
  		);

  		\DB::table('status')->insert($status);
    }
}
