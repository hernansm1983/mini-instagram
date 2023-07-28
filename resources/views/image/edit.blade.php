@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Editar la Publicacion</div>

                <div class="card-body">
                    <form action="{{ route('image.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                        <!-- Imagen -->   
                        <div class="row mb-3">
                            <label for="image_path" class="col-md-4 col-form-label text-md-end">Imagen</label>
                            <div class="col-md-6">
                                @if($image->image_path)
                                @php ($image_path = $image->image_path)
                                @else
                                @php ($image_path = 'sin_imagen.jpg')
                                @endif
                               

                                <img src="{{ url('../storage/app/images',['filename'=>$image_path]) }}" width="400" height="300" alt="alt"/>
                                <br/><br/>
                                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" value="{{ old('image_path') }}" autocomplete="image_path" autofocus>

                                @error('image_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Description --> 
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Descripcion</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">{{ $image->description }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Editar Imagen
                                </button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection