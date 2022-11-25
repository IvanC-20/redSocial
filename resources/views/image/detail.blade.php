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
                            <!-- Comprobar si el usuario le dio like a la imagen -->
                            <?php $user_like = false; ?>
                            @foreach($image->likes as $like)
                                @if($like->user_id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            @if($user_like)
                                <img src="{{asset('img/hearts-64-red.png')}}" data-id="{{$image->id}}" class="btn-dislike" />
                                
                            @else    
                                <img src="{{asset('img/hearts-64.png')}}" data-id="{{$image->id}}" class="btn-like" /> 
                                
                            @endif

                            <span class="number-likes">{{count($image->likes)}}</span>
                            
                        </div>

                        @if(Auth::user() && Auth::user()->id == $image->user->id)
                            <div class="actions">
                                <a href="" class="btn btn-sm btn-primary">Actualizar</a>
                            <!--    <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-sm btn-danger">Borrar</a> -->

                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Eliminar
                                </button>
                            
                                <!-- The Modal -->
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">¿Estás seguro?</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                        Si eliminas esta imagen nunca podrás recuperarla ¿estás seguro de querer borrarla?
                                        </div>
                                
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Borrar definitivamente</a>
                                        </div>
                                
                                    </div>
                                    </div>
                                </div>

                            </div>    
                        @endif

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
