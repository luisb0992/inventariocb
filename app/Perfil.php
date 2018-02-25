<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = "perfiles";

    // relaciones
    
    public function users(){
    	return $this->hasMany("App\User");
    }
}
