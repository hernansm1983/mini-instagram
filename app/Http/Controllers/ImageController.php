<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Http\Controllers\DumpController;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Solo pueden acceder los usuarios identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function create(){
        return view('image.create');
    }
    
    
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
    
    
    public function getImage($filename){
        $image = \Storage::disk('images')->get($filename);
        
        return Response ($image, 200);
    }
    
    
    public function detail($id){
        
        $image = Image::find($id);
        
        return view ('image.detail',[
            'image'=>$image
        ]);
    }
}
