@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="profile-user">
                <div class="col-md-4">
                    @if($user->image)
                        <div class="container-avatar"> 
                            <img src="{{ route('user.avatar', ['filename'=> $user->image]) }}"  />
                        </div> 
                    @endif
                </div>    

                <div class="user-info">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name.' '.$user->surname}}</h2>
                    <span class="nickName date">{{'Se unió '.$user->created_at->diffForHumans()}}</span>
                </div>  
                
                <div class="clearfix"></div>
                <hr>  
            </div>

            <div class="clearfix"></div>
            
            @foreach($user->images as $image)
                @include('includes.image', ['image' => $image])
            @endforeach
            
                 <!-- Paginación -->
       
       
            
    </div>
</div>
@endsection