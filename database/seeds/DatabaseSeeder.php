<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PerfilTableSeeder::class);
        $this->call(ColoresTableSeeder::class);
        $this->call(ModelosTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(PaisTableSeeder::class);
        $this->call(UnidadTableSeeder::class);

        App\User::create([
          'name'   => 'Admin',
          'apellido'   => 'Admin',
          'email'     => 'admin@admin.com',
          'password'  => bcrypt('admin'),
          'perfil_id'  => '1',
          'status'  => '1'
        ]);
    }
}
