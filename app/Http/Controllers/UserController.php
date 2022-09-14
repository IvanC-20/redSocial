<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //
    public function config(){
        return view('user.config');
        
    }

    public function update(Request $request){
        
        //Conseguir usuario identificado
        $user = Auth::user();
        $id = $user->id;
        
        //Validación del formulario
        $validate = $this->validate($request,[
            'name'=> 'required|string|max:255|alpha',
            'surname' => 'required|string|max:255|alpha',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
            ]);

        
        
        // o este es lo mismo $ids = $request->user()->id;
        //Recoger los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');  
        
        //Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Ejecutar consulta y cambios en la bd
       // var_dump($user);
        //die();
        $user->update();

        return redirect()->route('user.config')
                         ->with(['message'=>'Usuario actualizado correctamente']);

      
    }
}