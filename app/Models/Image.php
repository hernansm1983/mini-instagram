<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //use HasFactory;
    
    protected $table = 'images';
    
    // Relacion One to Many / de uno a muchos
    public function comments(){
        return $this->hasMany('App\Models\Comment')->orderBy('created_at', 'DESC');
    }
    
    
    // Relacion One to Many
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }
    
    
    // Relacion Many to One
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
