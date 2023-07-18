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
                        <a href="/">
                            {{ $image->user->surname.', '.$image->user->name.' | ' }}
                            <span class="nickname">{{'@'.$image->user->nick}}</span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container">
                        <a href="{{ route('image.detail', ['id'=>$image->id]) }}">
                            <img src="{{ url('../storage/app/images',['filename'=>$image->image_path]) }}" alt="alt"/> 
                        </a>
                    </div>
                    
                    <div class="description">
                        
                        <span class="nickname">{{ '@'.$image->user->nick }}</span>
                        <span class="created_at">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}</span>
                        <p>{{ $image->description }}</p>
                    </div>
                    
                    <div class="likes">
                        
                        <!-- Comprobamos si el like pertenece al usuario logueado - -->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                        @if($user_like == false)
                            <img src="{{ url('../resources/img/heart-black.png')}}" class="btn-dislike"/>
                        @elseif($user_like == true)
                            <img src="{{ url('../resources/img/heart-red.png')}}" class="btn-like"/>
                        @endif
                        <span class="number_likes">{{count($image->likes)}}</span>
                    </div>
                    
                    <div class="comments">
                        <a href="{{ route('image.detail', ['id'=>$image->id]) }}" class="btn btn-sm btn-warning btn-comments">Comentarios ({{ count($image->comments) }})</a>
                    </div>
                </div>
            </div>

            @endforeach
            <!-- PAGINACION -->
            {{ $images->links() }}


        </div>


    </div>
</div>
@endsection
