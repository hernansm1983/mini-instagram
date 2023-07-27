<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Http\Controllers\DumpController;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Solo pueden acceder los usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    // Carga la vista para crear una nueva Publicacion
    public function create(){
        return view('image.create');
    }
    
    
    // Guarda la Publicacion
    public function save(Request $request){
        
        // Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);
        
        // Recojer Datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');
        
        // Asignar valores al Objeto
        $image = new Image();
        $image->user_id = \Auth::user()->id;
        
        $image->description = $description;
        
        // Subir Imagen
        if($image_path){
            // Poner nombre Unico
            $image_path_name = time().$image_path->getClientOriginalName();
            
            // Guardar en la carpeta storage (storage/app/users)
            \Storage::disk('images')->put($image_path_name, File::get($image_path));
            
            // Seteo el nombre de la imagen en el objeto
            $image->image_path = $image_path_name;
            
        }
        
        // Guarda el Objeto en la DB
        $image->save();
        
        return redirect()->route('home')->with([
            'message' => 'La Foto ha sido subida correctamente !!'
        ]);
    }
    
    
    // Obtiene la Imagen
    public function getImage($filename){
        $image = \Storage::disk('images')->get($filename);
        
        return Response ($image, 200);
    }
    
    
    // Carga la vista para ver el detalle de la imagen
    public function detail($id){
        
        $image = Image::find($id);
        
        return view ('image.detail',[
            'image'=>$image
        ]);
    }
    
    
    // Carga la vista para la edicion de la imagen
    public function edit($id){
        $image = Image::find($id);
        
        return view('image.create',[
            'image'=>$image
        ]);
    }
    
    
    // Borrado de la Publicacion
    public function delete($id){
        
        // 
        $user = \Auth::user();
        
        // Traemos los datos de la imagen
        $image = Image::find($id);
        
        // Traemos los comentarios asociados a la imagen
        $comments = Comment::where('image_id', $id)->get();
        
        // Traemos los Likes asociados a la imagen
        $likes = Like::where('image_id', $id)->get();
        
        if($user && $image && ($image->user_id == $user->id || $user->role == 'admin')){
            
            // Eliminar Comentarios
            if($comments && count($comments) >= 1){
                foreach($comments as $comment){
                    $comment->delete();    
                }
            }
            
            // Eliminar Likes
            if($likes && count($likes) >= 1){
                foreach($likes as $like){
                    $like->delete();
                }
            }
            
            // Eliminar archivo de la imagen
            \Storage::disk('images')->delete($image->image_path);
            
            // Eliminar registro de la imagen
            $image->delete($id);   
            
            $message = array('message' => 'La imagen se ha eliminado correctamente');
            
        }else{
            
            $message = array('message' => 'La imagen no se ha podido eliminar');
            
        }
        
         
        return redirect('home')->with($message);
        
    }
}
