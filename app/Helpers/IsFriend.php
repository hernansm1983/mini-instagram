<?php

namespace App\Helpers;
  
use Illuminate\Support\Facades\DB;
use App\Models\Friend;

Class IsFriend{
    
// Consigue el amigo
    public static function getFriend($id){
        
        // Conseguimos los datos del usuario logueado
        $user = \Auth::user();
        
        $friend = Friend::where('id_f1', $user->id)
                        ->where('id_f2', $id)
                        ->first();    
        
        // devuelve 1 sin son amigos o 0 si todavia no son amigos
        return $friend ? $friend->accepted : 0;
       
            
     
    }
}
?>