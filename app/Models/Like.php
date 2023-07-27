<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //use HasFactory;
    
    protected $table = 'likes';
       
    
    // Relacion Many To One
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    
    // Relacion Many to One
    Public function image(){
        return $this->belongsTo('App\Models\Image', 'image_id');
    }

}
