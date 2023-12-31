@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Gente</h1>
            <hr>
            @include('includes.message')
            
            <form action="{{ route('user.index') }}" id="buscador" method="GET">
                <div class="row">
                    <div class="form-group col">
                        <label for="name">Buscar:</label>
                        <input type="text" id="search" value="{{ $request->search }}" class="form-control search" />
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" class="btn btn-success" value="Buscar" />   
                    </div>   
                </div>
            </form>
            <br>
            <hr>    
            <!-- Listado de todas los usuarios -->
            @foreach($users as $user)
            
            <div class="profile-user">
                @if($user && $user->image)
                @php ($avatar = $user->image)
                @else
                @php ($avatar = 'sin_imagen.jpg')
                @endif

                <div class="container-avatar">
                    <img src="{{ url('../storage/app/users', ['filename'=>$avatar]) }}" alt="alt" class="avatar" />   
                </div>

                <div class="user-info">
                    
                        <h2>{{ '@'.$user->nick }}</h2>
                        <h3>{{ $user->surname.', '.$user->name }}</h3>
                  
                    <p>{{ 'Se unió hace: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                    <a href="{{ route('profile', ['id' => $user->id])}}" class="btn btn-success">Ver Perfil</a>
                    
                    <!-- Si el campo ACCEPTED en la tabla Friends es Cero muestro el boton seguir -->
                    
                    <!-- ACCEPTED = 0 (MOSTRAR BOTON SEGUIR)
                         ACCEPTED = 1 (SOLICITUD ENVIADA)
                         ACCEPTED = 2 (YA SON AMIGOS)
                    -->
                    @php ($accepted = IsFriend::getFriend($user->id))
                    
                    @if($accepted == 0)
                        <a href="{{ route('friend.follow', ['id_f2' => $user->id])}}" class="btn btn-success">Seguir</a>
                    
                    @elseif($accepted == 1)
                        &nbsp;(Solicitud Enviada)
                 
                    @elseif($accepted == 2)
                        &nbsp;(Ya son Amigos)
                        
                    @endif
                    
                </div>
                <div class="clearfix"></div>
                <hr>
            </div>


            @endforeach

            <!-- PAGINACION -->
            {{ $users->links() }}

        </div>
    </div>
</div>
@endsection

