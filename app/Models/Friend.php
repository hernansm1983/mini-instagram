<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;
    
    protected $table = 'friends';
    
    protected $hidden = [
        'id',
    ];
    
    // Relacion Many to One
    public function user(){
        return $this->belongsTo('App\Models\User', 'id_f2');
        
    }
    
   /* // Relacion Many to One
    public function isFriend(){
        return $this->belongsTo('App\Models\User')
    }*/
}
