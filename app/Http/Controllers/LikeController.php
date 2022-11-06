<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //Verifico usuario autenticado
    public function __construct()
     {
         $this->middleware('auth');
     }

     public function index(){
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id )->orderBy('id', 'desc')
                              ->paginate(5);
        return view ('like.index', [
                    'likes' => $likes 
        ]);
    }

     public function like($image_id){

        //Recoger datos de usuario de la imagen
        $user = Auth::user();

        //Condición para ver si ya existe el like y no duplicarlo
        $isset_like = Like::Where('user_id', $user->id)
                            ->Where('image_id', $image_id)
                            ->count();
        
        if($isset_like == 0){

            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            //Guardar 
            $like->save();

            //$image = new Image();
            //$image->id = $image_id;
            $count = count($like->image->likes); //$image->likes

            return Response()->Json([
                'like' => $like,
                'count' => $count,
                'message' => 'Diste like correctamente'
            ]);

        }else{
            return Response()->Json([
                'message' => 'Ya le diste like'
            ]);
        }

     }

     public function disLike($image_id){

        //Recoger datos de usuario de la imagen
        $user = Auth::user();

        //Condición para ver si existe el objeto 
        $like = Like::Where('user_id', $user->id)
                            ->Where('image_id', $image_id)
                            ->first();
        
        if($like){

            //Eliminar like
            $like->delete();
            //$image = new Image();
            //$image->id = $image_id;
            $count = count($like->image->likes);

            return Response()->Json([
                'like' => $like,
                'count' => $count,
                'message' => 'Diste dislike correctamente'
            ]);

        }else{
            return Response()->Json([
                'message' => 'El like no existe'
            ]);
        }

    }

    
}
