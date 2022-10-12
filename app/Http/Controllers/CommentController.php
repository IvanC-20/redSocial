<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
     //restringimos acceso sólo a usuarios identificados
     public function __construct()
     {
         $this->middleware('auth');
     }
    
     public function save(Request $request){

        //Validación
        $validate = $this->validate($request, [
            'image_id' => 'int|required',
            'content' => 'string|required'
        ]);

        //Recoger datos formulario
        $user = Auth::user();
        $image_id = $request->input('image_id'); 
        $content = $request->input('content');

        //Asigno valores a mi nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        
       //Guardar en la db
       $comment->save();

       //Redirección
       return redirect()->route('image.detail', ['id' => $image_id])
                        ->with([
                            'message' => 'Comentario publicado correctamente'
                        ]);

     }

     public function delete($id){
            //Conseguir datos del usuario logueado
            $user = Auth::user();

            //Conseguir objeto del comentario
            $comment = Comment::find($id);

            //comprobar si soy el dueño del comentario o de la publicación
            if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
                    $comment->delete();
                    return redirect()->route('image.detail', ['id' => $comment->image->id])
                                     ->with([
                                        'message' => 'El comentario se ha eliminado correctamente'
                                     ]);
            }else{
                return redirect()->route('image.detail', ['id' => $comment->image->id])
                ->with([
                   'message' => 'El comentario no se pudo eliminar'
                ]);
            }   
     }
}
