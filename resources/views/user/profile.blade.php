@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <h1>{{ '@'.$user->nick }}</h1>
                    <h2>{{ $user->surname.', '.$user->name }}</h2>
                    <p>{{ 'Se unió hace: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                </div>
                <div class="clearfix"></div>
                <hr>
            </div>
            
            @include('includes.message')
            
            <div class="clearfix"></div>
            <!-- Listado de todas las imagenes -->
            @foreach($user->images as $image)
            
                @include('includes.image', ['image' => $image])

            @endforeach
            
           

        </div>
    </div>
</div>
@endsection

