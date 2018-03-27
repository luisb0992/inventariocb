<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = "articulos";

    protected $fillable = [
    	"name", "cantidad", "modelo_id", "color_id", "color_tubo", "observacion"
    ];

    // relaciones
    
    public function modelo(){
    	return $this->belongsTo("App\Modelo", "modelo_id");
    }

    public function color(){
    	return $this->belongsTo("App\Color", "color_id");
    }
}
