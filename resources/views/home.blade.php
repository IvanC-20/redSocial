@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')

            @foreach($images as $image)
                <div class="card pub_image">
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
                        <div class="image-container">
                            <img src="{{ route('image.file',['filename' => $image->image_path])}}" />
                        </div>    
                    </div>
                    <div class="likes">

                    </div>

                    <div class="description">
                        <span class="nickName"> {{ '@'.$image->user->nick }} </span> 
                        <p>{{$image->description}}</p>
                    </div>
                </div>
            @endforeach
                 <!-- Paginación -->
        <div class="clearfix"></div>
        <div>{{$images->links()}}</div>
        
        </div>
       
            
    </div>
</div>
@endsection
