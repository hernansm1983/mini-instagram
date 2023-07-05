@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            
            <!-- Listado de todas las imagenes -->
            @foreach($images as $image)
            <div class="card pub_image">
                <div class="card-header">
                    @if($image->user->image)
                        @php ($avatar = $image->user->image)
                    @else
                        @php ($avatar = 'sin_imagen.jpg')
                    @endif
                    <div class="container-avatar">
                        <img src="{{ url('../storage/app/users', ['filename'=>$avatar]) }}" alt="alt" class="avatar" />   
                    </div>
                    
                    
                    <div class="data-user">
                        {{ $image->user->surname.', '.$image->user->name.' | ' }}
                        <span class="nickname"><a href="">{{'@'.$image->user->nick}}</a></span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ url('../storage/app/images',['filename'=>$image->image_path]) }}" alt="alt"/>  
                    </div>
                    <div class="likes">
                        
                    </div>
                    <div class="description">
                        <span class="nickname">{{ '@'.$image->user->nick }}</span>
                        <p>{{ $image->description }}</p>
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
</div>
@endsection
