<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    protected $table = "entrevistas";

    protected $fillable = [
    	"user_id", "nombre", "apellido", "direccion", "email",
    	"telefono", "contacto", "pais_id", "distrito", "provincia",
    	"tiempo_embarazo", "sexo_bebe", "tiempo_nacido", "comentario_id",
    	"articulo_id", "fecha_hora_cita"
    ];

	// relaciones
	
	public function vendedor(){
		return $this->belongsTo("App\User", "user_id");
	}

	public function pais(){
		return $this->belongsTo("App\Pais", "pais_id");
	}

	public function comentarios(){
		return $this->belongsTo("App\Comentario", "comentario_id");
	}

	public function articulo(){
		return $this->belongsTo("App\Articulo", "articulo_id");
	}
}
