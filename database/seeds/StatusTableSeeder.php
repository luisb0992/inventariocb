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
  				'name' => 'Separado'),
  			array(
  				'name' => 'Vendido'),
  			array(
  				'name' => 'De baja'),
  			array(
  				'name' => 'Devolucion')
  		);

  		\DB::table('status')->insert($status);
    }
}
