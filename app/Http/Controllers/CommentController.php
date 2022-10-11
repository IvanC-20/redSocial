<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $image_id = $request->input('image_id'); 
        $content = $request->input('content');

     }
}
