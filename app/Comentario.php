<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = "comentarios";

    public function entrevista(){
		return $this->belongsTo("App\Entrevista", "entrevista_id");
	}
}
