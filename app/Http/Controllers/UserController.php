<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Image;

class UserController extends Controller
{
    // Evita que se pueda ingresar a la seccion SIN loguearse
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    // Muestra Todos los usuarios
    public function index(Request $request, $search = null){
        
        // conseguir usuario identificado
        $user = \Auth::user();
        $id   = $user->id;
        
        
        if(!empty($search)){
        
            $users = User::where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%')
                              ->orWhere('surname', 'LIKE', '%' . $search . '%')
                              ->orWhere('nick', 'LIKE', '%' . $search . '%')
                              ->orWhere('email', 'LIKE', '%' . $search . '%');
                    })
                    ->whereNotIn('id', [$id]) // Excluir el ID del usuario Logueado
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10);
            
        }else{
            // Conseguimos todos los usuarios de la DB
            $users = User::where('id', '!=', $id) // Excluir el ID del usuario Logueado
                           ->orderBy('id', 'desc')
                           ->simplePaginate(10);
                              
            
        }
        
        return view('user.index', compact('request'), ['users' => $users]);
        
        //return view('nombre_de_tu_vista', compact('request'));
    }
    
    
    public function config(){
        return view ('user.config');
    }
    
    
    public function update(Request $request){
        
        // conseguir usuario identificado
        $user = \Auth::user();
        $id   = $user->id;
        
                
        // validar datos del formulario
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            
        ]);
        
        // Recoger datos del formulario
        $name    = $request->input('name');
        $surname = $request->input('surname');
        $nick    = $request->input('nick');
        $email   = $request->input('email');
        
        // Asignar nuevos valores al objeto
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        
        // Subir la imagen
        $image_path = $request->file('image_path');
        if($image_path){
            // Poner nombre Unico
            $image_path_name = time().$image_path->getClientOriginalName();
            
            // Guardar en la carpeta storage (storage/app/users)
            \Storage::disk('users')->put($image_path_name, File::get($image_path));
            
            // Seteo el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }
        
        // Ejecutar consulta y cambios en la DB
        $user->update();
        
        return redirect()->route('config')->with('message', 'El Usuario ha sido modificados correctamente');
        
    }
    
    
    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    
    
    public function profile($id){
        
        $user = User::find($id);
        return view('user.profile', ['user'=>$user]);
    }
  
}
