@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            <h1>Personas</h1>
            <form method="GET" action="{{route('user.index')}}" id="buscador">
                <div class="form-group row">
                    <div class="form-group col">
                        <input id="search"  type="text" class="form-control" />
                    </div>    
                    <div class="form-group col btn-search">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>  
                </div>      
            </form>    
            <hr>
            @foreach($users as $user)
            <div class="profile-user">
                <div class="col-md-4">
                    @if($user->image)
                        <div class="container-avatar"> 
                            <img src="{{ route('user.avatar', ['filename'=> $user->image]) }}"  />
                        </div> 
                    @endif
                </div>    

                <div class="user-info">
                    <h2>{{'@'.$user->nick}}</h2>
                    <h3>{{$user->name.' '.$user->surname}}</h3>
                    <span class="nickName date">{{'Se unió '.$user->created_at->diffForHumans()}}</span>
                <br><br>
                    <a href="{{route('user.profile', ['id' => $user->id])}}" class="btn btn-success">Ver perfil</a>
                </div>  
                
                <div class="clearfix"></div>
                <hr>  
            </div>
            @endforeach
            
                 <!-- Paginación -->
        <div class="clearfix"></div>
        <div>{{$users->links()}}</div>
        
        </div>
       
            
    </div>
</div>
@endsection