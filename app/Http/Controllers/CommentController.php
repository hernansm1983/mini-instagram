<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Controllers\DumpController;

class CommentController extends Controller
{
    // Solo pueden acceder los usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function save(Request $request){
        
        // Validamos los datos que llegan del form
        $validate = $this->validate($request, [
            'image_id'=>'integer|required',
            'content'=>'string|required'
        ]);
        
        // Guardamos los datos en variables
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        // Asignamos los valores al nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = \Auth::user()->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        $comment->save();
        
               
        return redirect()->route('image.detail', ['id' => $image_id])->with([
                'message' => 'El Comentario ha sido creado correctamente'
                ]);   
    }
    
    
    public function delete($id){
        
        // Conseguir los datos del usuario logueado
        $user = \Auth::user();
        //$id_user = $user->id;
        
        // Conseguir el objeto del comentario
        $comment = Comment::find($id); 
        
        // Si el usuario es el propietario de la publicacion o del comentario se permite el borrado
        if($user && ($user->id == $comment->user_id || $user->id == $comment->image->user_id)){
        
            $comment->delete();

            $message = 'El Comentario ha sido eliminado correctamente';
            
        }else{
            
            $message = 'El Comentario no se ha podido eliminar correctamente';
                
        }
        
        return redirect()->route('image.detail', ['id' => $comment->image->id])->with([
                    'message' => $message
                ]); 
        
    }
}
