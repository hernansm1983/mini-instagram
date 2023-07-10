<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //use HasFactory;
    
    protected $table = 'comments';
    
    protected $fillable = [
        'content',
    ];
    
    protected $hidden = [
        'id',
    ];
    
    // Relacion Many to One
    public function user(){
        //return $this->belongsTo(User::class);
         return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    
    // Relacion Many to One
    public function image(){
        return $this->belongsTo('App\Models\Image', 'image_id');
    }
}
