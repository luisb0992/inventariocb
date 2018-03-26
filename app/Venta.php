<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";

    protected $fillable =  [
    	"numero_contrato", "user_id", "articulo_id", "descripcion", "precio", "unidad_id", "entrada", "salida", "deuda", "status_id", "entrevista_id"
    ];

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

    public function articulo(){
    	return $this->belongsTo("App\Articulo", "articulo_id");
    }

    public function unidad(){
    	return $this->belongsTo("App\Unidad", "unidad_id");
    }

    public function status(){
    	return $this->belongsTo("App\Status", "status_id");
    }

    public function entrevista(){
    	return $this->belongsTo("App\Entrevista", "entrevista_id");
    }

    // conversion del formato de creacion y actualizacion del registro
    public function formatoCreated(){
        $created = $this->created_at;
        $newcreated = date('d-m-Y',strtotime(str_replace('/', '-', $created)));
        return $newcreated;
    }
}
