<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    // --- Autoriza la entrada si esta logueado ---
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function like($image_id){
        // Recojer datos del usuario y la imagen
        $user = \Auth::user();
        
        // Condicion para ver si existe el like y no duplicarlo
        $isset_like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->count();
        
        if($isset_like == 0){
              $like = new Like();
              $like->user_id = $user->id;
              $like->image_id = (int)$image_id;

              $like->save();
              
              return response()->json([
                  'like' => $like
              ]);
              
        }else{
            return response()->json([
                'message' => 'Ya existe el Like'
            ]);
        }        
            
    }
    
    
    public function dislike($image_id){
        $user = \Auth::user();
        
        // Chequeamos que no haya otro like igual
        $like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->first();
        
        if($like){
            
            // Eliminar Like
            $like->delete();
            
            return response()->json([
                  'like' => $like,
                  'message' => 'Has dado Dislike Correctamente'
              ]);
            
        }else{
            
            return response()->json([
                'message' => 'Ya existe el Like'
            ]);
        }
        
    }
    
}
