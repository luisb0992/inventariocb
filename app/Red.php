<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    protected $table = 'redes';

    protected $fillable = ['user_id','link_f','fecha','hora','cantidad','descripcion','provincia_id'];

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

    public function provincia(){
    	return $this->belongsTo("App\Provincia", "provincia_id");
    }

}
