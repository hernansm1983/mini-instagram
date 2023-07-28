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

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/configuracion', 'App\Http\Controllers\UserController@config')->name('config');

Route::post('/user/update', 'App\Http\Controllers\UserController@update')->name('user.update');

Route::get('/user/avatar/{filename}', 'App\Http\Controllers\UserController@getImage')->name('user.avatar');

Route::get('/perfil/{id}', 'App\Http\Controllers\UserController@profile')->name('profile');

Route::get('/subir-imagen', 'App\Http\Controllers\ImageController@create')->name('image.create');

Route::post('/image/save', 'App\Http\Controllers\ImageController@save')->name('image.save');

Route::get('/image/edit/{id}', 'App\Http\Controllers\ImageController@edit')->name('image.edit');

Route::post('/image/update', 'App\Http\Controllers\ImageController@update')->name('image.update');

Route::get('/image/delete/{id}', 'App\Http\Controllers\ImageController@delete')->name('image.delete');

Route::get('/image/file/{filename}', 'App\Http\Controllers\ImageController@getImage')->name('image.file');

Route::get('/imagen/{id}', 'App\Http\Controllers\ImageController@detail')->name('image.detail');

Route::post('/comment/save', 'App\Http\Controllers\CommentController@save')->name('comment.save');

Route::get('/comment/delete/{id}', 'App\Http\Controllers\CommentController@delete')->name('comment.delete');

Route::get('/like/{image_id}', 'App\Http\Controllers\LikeController@like')->name('like.save');

Route::get('/dislike/{image_id}', 'App\Http\Controllers\LikeController@dislike')->name('like.delete');

Route::get('/likes', 'App\Http\Controllers\LikeController@index')->name('like.index');