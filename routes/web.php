<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    /*$images = Image::all();

    foreach($images as $image){
        //var_dump($image);
        echo $image->image_path."</br>";
        echo $image->description."</br>";
        //var_dump($image->user);
        echo $image->user->name." ".$image->user->surname."</br>";

        if(count($image->comments) >= 1){
            echo "<strong>Comentarios</strong></br>";
            foreach($image->comments as $comment){
                echo "<p><strong>".$comment->user->name." ".$comment->user->surname.":</strong>"." ";
                echo $comment->content."</br></p>";
            }
        }

        echo "Likes: ".count($image->likes);
        echo "<hr>";
        
    }
    die();
    Para poder ver los estilos y compilar vistas vue ejecutar comando 'npm install && npm run dev'  */
    return view('welcome'); 
}); 

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/configuracion', [UserController::class, 'config'])->name('user.config');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');
Route::get('/subir-imagen', [ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
Route::get('/imagen/{id}', [ImageController::class, 'detail'])->name('image.detail');
