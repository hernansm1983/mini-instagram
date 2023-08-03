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
            'image_path' => 'required|image|max:5242880'
        ]);
        
        // Recojer Datos
        $image_path = $request->file('image_path');
        $size = filesize($image_path);
        
        // Si la imagen es menor a 5MB continuamos con la subida 
        if($size < 5242880){
           
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
        
        }else{ // si la imagen es mayor a 5MB cancelamos la subida y redireccionamos
            
            return redirect()->route('image.create')
                         ->with('message', 'La imagen debe ser menor a 5MB para poder crear la publicación correctamente');
        }
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
        
        // Conseguir el usuario identificado
        $user = \Auth::user();
        
        // Traemos los datos de la imagen
        $image = Image::find($id);
        
        if($user && $image && ($user->id == $image->user->id || $user->role == 'admin')){
            
            return view('image.edit',[
                'image'=>$image
            ]);  
            
        }else{
            return redirect()->route('home');
        }
    }
    
    
    // Borrado de la Publicacion
    public function delete($id){
        
        // Conseguir el usuario identificado
        $user = \Auth::user();
        
        // Traemos los datos de la imagen
        $image = Image::find($id);
        
        // Traemos los comentarios asociados a la imagen
        $comments = Comment::where('image_id', $id)->get();
        
        // Traemos los Likes asociados a la imagen
        $likes = Like::where('image_id', $id)->get();
        
        if($user && $image && ($image->user->id == $user->id || $user->role == 'admin')){
            
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
    
    
    
    public function update(Request $request){
        
               
        // Recoger datos del formulario
        $description = $request->input('description');
        $image_id    = $request->input('image_id');
        $image_path  = $request->file('image_path');
       
        
        // validar datos del formulario
        $validate = $this->validate($request, [
            'description' => ['required', 'string', 'max:255'],
            'image_path'  => ['image', 'max:5242880']
        ]);
             
        // Conseguimos los datos de la imagen existente
        $image = Image::find($image_id);
        
        $size = filesize($image_path);    
        
        // Subir la imagen
        if($image_path){
           
            // Si la imagen es menor a 5MB continuamos con la subida 
            if($size < 5242880){ 
            
            
                if($image){
                    // Eliminar archivo de la imagen existente
                    \Storage::disk('images')->delete($image->image_path);    
                }

                // Poner nombre Unico
                $image_path_name = time().$image_path->getClientOriginalName();

                // Guardar en la carpeta storage (storage/app/users)
                \Storage::disk('images')->put($image_path_name, File::get($image_path));

                // Seteo el nombre de la imagen en el objeto
                $image->image_path = $image_path_name;
                
                
            }else{
                return redirect()->route('image.detail', ['id' => $image_id])
                             ->with('message', 'La Publicacion no ha sido modificada correctamente, la imagen debe ser menor a 5MB');
            }

            // Asignar nuevos valores al objeto
            $image->description = $description;

            // Ejecutar consulta y cambios en la DB
            $image->update();

            return redirect()->route('image.detail', ['id' => $image_id])
                             ->with('message', 'La Publicacion ha sido modificada correctamente');
            
            }
        }
}
