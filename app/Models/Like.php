<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //use HasFactory;
    
    protected $table = 'likes';
    
    // Relacion Many to One
    Public function image(){
        $this->belongsTo('App\Models\Image', 'imagen_id');
    }
    
    
    // Relacion Many To One
    public function user(){
        $this->belongsTo('App\Models\User', 'user_id');
    }
}
