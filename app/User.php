<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','apellido','password','perfil_id', 'email', 'status', 'clave'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // relaciones
    
    public function perfil(){
        return $this->belongsTo("App\Perfil", "perfil_id");
    }

    public function nameStatus(){
        $status = "";
        
        if ($this->status == 1) {
            $status = "Activo";
        }elseif($this->status == 2){
            $status = "Inactivo";
        }elseif($this->status == 3){
            $status = "Suspendido";
        }

        return $status;
    }

    public function countVentas($id){
    	return Venta::whereMonth("created_at", date("m"))->where('user_id', $id)->groupBy("user_id");
    }
}
