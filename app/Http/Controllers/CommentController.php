<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

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
        
        $comment = new Comment();
        $comment->user_id = \Auth::user()->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        $comment->save();
        
               
        return redirect()->route('image.detail', ['id' => $image_id])->with([
                'message' => 'El Comentario ha sido creado correctamente'
                ]);
        
        
    }
}
