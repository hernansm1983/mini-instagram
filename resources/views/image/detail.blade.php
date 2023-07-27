@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row justify-content-center">
            <span class="titulo-seccion">Detalles de la Publicacion</span>
        </div>
        <div class="col-md-10">
            @include('includes.message')

            
            
            <div class="card pub_image pub_image_detail">
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
                    <div class="image-container image-detail">
                        <img src="{{ url('../storage/app/images',['filename'=>$image->image_path]) }}" alt="alt"/>  
                    </div>
                    
                    <div class="description">
                        <span class="nickname">{{ '@'.$image->user->nick }}</span>
                        <span class="created_at">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}</span>
                        <p>{{ $image->description }}</p>
                    </div>
                    
                    <div class="likes">
                        <!-- Comprobamos si el usuario esta logueado -->
                        @if(isset(Auth::user()->id))
                            <!-- Comprobamos si el like pertenece al usuario logueado - -->
                            <?php $user_like = false; ?>
                            @foreach($image->likes as $like)
                                @if($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            @if($user_like)
                                <img src="{{ url('../resources/img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike"/>

                            @else
                                <img src="{{ url('../resources/img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like"/>
                            @endif
                        @else
                            <img src="{{ url('../resources/img/heart-black.png')}}" />
                        @endif
                        <span class="number_likes">{{count($image->likes)}}</span>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="comments">
                        <h2>Comentarios ({{ count($image->comments) }})</h2>
                        <hr>
                        
                        <form method="POST" action="{{ route('comment.save') }}">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}" />
                            <p>
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content">{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </p>    
                            
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                        <hr>
                        @foreach($image->comments as $comment)
                            <div class="comment">
                                <span class="nickname">{{ '@'.$comment->user->nick }}</span>
                                <span class="created_at">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                <p>
                                    {{ $comment->content }}<br/>
                                    <!-- Si el usuario es el propietario de la publicacion o del comentario se permite el borrado -->
                                    @if(\Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $comment->image->user_id))
                                        <a href="{{ route('comment.delete', ['id'=>$comment->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                                    @endif
                                </p>
                            </div>
                        <br/>
                        @endforeach
                    </div>
                </div>
            </div>

            
        </div>


    </div>
</div>
@endsection
