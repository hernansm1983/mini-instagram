@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Gente</h1>
            <hr>
            @include('includes.message')

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

