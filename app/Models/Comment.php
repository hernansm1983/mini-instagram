<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //use HasFactory;
    
    protected $table = 'comments';
    
    // Relacion Many to One
    public function user(){
        $this->belongsTo('App\Models\User', 'user_id');
    }
    
    
    // Relacion Many to One
    public function image(){
        $this->belongsTo('App\Models\Image', 'image_id');
    }
}