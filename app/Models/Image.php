<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //use HasFactory;
    
    protected $table = 'images';
    
    // Relacion One to Many / de uno a muchos
    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
    
    
    // Relacion One to Many
    public function like(){
        return $this->hasMany('App\Models\Like');
    }
    
    
    // Relacion Many to One
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
