<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = "grupos";

    protected $fillable = ["user_id", "facebook", "clave_face", "email", "clave_email", "observacion"];

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }
}
