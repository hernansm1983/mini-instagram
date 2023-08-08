<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;

class FriendController extends Controller
{
    // Evita que se pueda ingresar a la seccion SIN loguearse
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    // Se envia la solicitud al segundo usuario
    public function follow($id_f2){
        
        // Conseguimos los datos del usuario logueado
        $user = \Auth::user();
        
        if($id_f2 && $user){
            $friend = new Friend();
            $friend->id_f1 = $user->id;
            $friend->id_f2 = $id_f2;
            $friend->accepted = 1; // ACCEPTED = 1 (Solicitud Enviada)
            
            $friend->save();
            
            return redirect()->route('user.index');
        }
    }
    
    
    // Se envia la solicitud al segundo usuario
    public function accept($id){
        
        // Conseguimos los datos del usuario logueado
        $user = \Auth::user();
        
        // Conseguimos los datos de la relacion existente
        $friend = Friend::find($id);
        
        
        if($id && !empty($friend) && $user){
            
            $friend->accepted = 2; // ACCEPTED = 2 (Solicitud Aceptada)
            
            $friend->update();
            
            return redirect()->route('friend.index');
        }
    }
    
    
    
    // Se muestra la lista de amigos
    public function index(){
        
        $user = \Auth::user();
        
        // Se muestra la lista de todos los usuarios disponibles
        $friends = Friend::where('id_f1', $user->id)
                            ->with('user')
                            ->get();
        
      /*  echo '<pre>';
        var_dump($friends); 
        echo '</pre>';
        die();*/
        
        return view('friend.index', ['friends' => $friends]);
    }
    
}
