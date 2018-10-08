<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = "ubdepartamento";

    protected $fillable = ["departamento"];

    public function provincias(){
      return $this->hasMany("App\Provincia", "departamento_id");
    }
}
