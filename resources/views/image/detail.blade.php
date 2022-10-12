@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')

           
                <div class="card pub_image pub_image_detail">
                    <div class="card-header">
                            @if($image->user->image)
                                <div class="container-avatar"> 
                                    <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}"  />
                                </div> 
                            @endif

                            <div class="data-user">{{ $image->user->name.' '.$image->user->surname}}
                                <span class="nickName"> {{ '| @'.$image->user->nick }} </span>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="image-container image-detail">
                            <img src="{{ route('image.file',['filename' => $image->image_path])}}" />
                        </div>    
                    
                   
                        <div class="description">
                            <span class="nickName"> {{ '@'.$image->user->nick }} </span>
                            <span class="nickName date">{{' | '.$image->created_at->diffForHumans()}}</span> 
                            <p>{{$image->description}}</p>
                        </div>

                        <div class="likes">
                            <img src="{{asset('img/hearts-64.png')}}" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="comments">
                            <h2>Comentarios ({{count($image->comments)}}) </h2>
                            <hr> 
                            
                            <form method="POST" action=" {{route('comment.save')}}">
                                @csrf
                                <input type="hidden" name="image_id" value="{{$image->id}}" />
                                <p>
                                    <textarea class="form-control {{ $errors->has('content')? 'is-invalid': ''}} " name="content"></textarea>
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('content')}}</strong>
                                        </span>
                                    @endif  
                                </p>
                               
                                <button class="btn btn-success" type="submit">Enviar</button>  
                            </form> 
                            <hr> 
                            @foreach ($image->comments as $comment)
                                <div class="comments">
                                    <span class="nickName"> {{ '@'.$comment->user->nick }} </span>
                                        {{$comment->content}}
                                    <span class="nickName date">{{' | '.$comment->created_at->diffForHumans().'   '}}</span>
                                    
                                    @if(Auth::Check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                        <a href="{{route('comment.delete', ['id' => $comment->id])}}" class="btn btn-sm btn-danger">
                                            Eliminar
                                        </a> 
                                    @endif            
                                </div>
                            @endforeach
                        </div> 
                    </div>      
                </div>
                  
        </div>
       
            
    </div>
</div>
@endsection
