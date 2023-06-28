<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolsController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//use App\Models\Image;

Route::get('/', function () {
   /* 
    // Tu código PHP
    $images = image::all();
    foreach($images as $image){
        echo $image->image_path."<br/>";
        echo $image->description."<br/>";
        echo $image->user->name.' '.$image->user->surname;
        
        if(count($image->comments) >=1){
            foreach($image->comments as $comment){
                echo '<h4>Comentarios</h4>';
                echo $comment->user->name.' '.$comment->user->surname.': ';
                echo $comment->content.'<br/>'; 
            }
        }
        
        echo "<br/>Likes: ".count($image->likes); 
               // ToolsController::showArray($image);
        echo "<hr><br/>";
    }*/
    //

    
    
    
    return view('welcome');
});

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');


