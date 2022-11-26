<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
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
Route::post('/comment/save', [CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [LikeController::class, 'disLike'])->name('like.delete');
Route::get('/likes', [LikeController::class, 'index'])->name('like.index');
Route::get('/perfil/{id}', [UserController::class, 'profile'])->name('user.profile');
Route::get('/image/delete/{id}', [ImageController::class, 'delete'])->name('image.delete');
Route::get('/image/edit/{id}', [ImageController::class, 'edit'])->name('image.edit');
Route::post('/image/update', [ImageController::class, 'update'])->name('image.update');



