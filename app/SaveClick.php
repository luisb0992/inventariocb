<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveClick extends Model
{
    protected $table = "save_clicks";
    protected $fillable = ["red_id", "user_id", "fecha", "hora"];
    
    public function red(){
    	return $this->belongsTo("App\Red", "red_id");
    }
    
    public function user(){
    	return $this->belongsTo("App\User", "user_id");
    }
}
