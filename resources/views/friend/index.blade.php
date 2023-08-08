@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Amigos</h1>
            <hr>
            @include('includes.message')
            
            <form action="" id="buscador" method="GET">
                <div class="row">
                    <div class="form-group col">
                        <label for="name">Buscar:</label>
                        <input type="text" id="search" value="" class="form-control search" />
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" class="btn btn-success" value="Buscar" />   
                    </div>   
                </div>
            </form>
            <br>
            <hr>    
            <!-- Listado de todas los amigos (usuarios seguidos) -->
            
            @foreach($friends as $friend)
         
            <div class="profile-user">
                @if($friend && $friend->user->image)
                @php ($avatar = $friend->user->image)
                @else
                @php ($avatar = 'sin_imagen.jpg')
                @endif

                <div class="container-avatar">
                    <img src="{{ url('../storage/app/users', ['filename'=>$avatar]) }}" alt="alt" class="avatar" />   
                </div>

                <div class="user-info">
                    
                        <h2>{{ '@'.$friend->user->nick }}</h2>
                        <h3>{{ $friend->user->surname.', '.$friend->user->name }}</h3>
                  
                    <p>{{ 'Se unió hace: '.\FormatTime::LongTimeFilter($friend->user->created_at) }}</p>
                    
                    <a href="{{ route('profile', ['id' => $friend->user->id])}}" class="btn btn-success">Ver Perfil</a>
                    
                    <!-- Si el campo ACCEPTED en la tabla Friends es Cero muestro el boton seguir -->
                    
                    <!-- ACCEPTED = 1 (MOSTRAR BOTON ACEPTAR )
                         ACCEPTED = 1 (SOLICITUD ENVIADA)
                         ACCEPTED = 2 (YA SON AMIGOS)
                    -->
                    @php ($accepted = IsFriend::getFriend($friend->user->id))
                    
                    @if($accepted == 1)
                        <a href="{{ route('friend.accept', ['id' => $friend->id])}}" class="btn btn-success">Aceptar</a>
                    
                    
                 
                    @elseif($accepted == 2)
                        &nbsp;(Ya son Amigos)
                        
                    @endif

                </div>
                <div class="clearfix"></div>
                <hr>
            </div>

            @endforeach

            
        </div>
    </div>
</div>
@endsection

