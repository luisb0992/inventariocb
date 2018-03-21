<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";

    protected $fillable =  [
    	"numero_contrato", "user_id", "articulo_id", "descripcion", "precio", "unidad_id", "entrada", "salida", "deuda", "status_id"
    ];
}
