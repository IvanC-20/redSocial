<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;

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
    die(); */
    return view('welcome'); 
}); 

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route::get('/', [HomeController::class, 'index'])->name('home');
