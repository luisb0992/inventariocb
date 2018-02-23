<?php

use Illuminate\Database\Seeder;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles = array(
  			array(
  				'id' => '1',
  				'name' => 'admin',
  				'observacion' => 'administrador del sistema'),
  			array(
  				'id' => '2',
  				'name' => 'vendedor',
  				'observacion' => 'empleado / vendedor de articulos')
  		);

  		\DB::table('perfiles')->insert($perfiles);
    }
}
