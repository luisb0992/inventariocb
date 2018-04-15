<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    protected $table = 'redes';

    protected $fillable = ['user_id','link_f','fecha','cantidad','descripcion'];

    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }

}
