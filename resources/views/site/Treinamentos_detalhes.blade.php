@extends('site.inicio')

@section('title', 'Detalhes do Treinamento')

@section('content')
<div class="row bg-black">
    <div class="col py-7 ">
        <h1 class="text-center">{{ $treinamento->nome }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <h4>{{ $treinamento->nome }}</h4>
        <p>{!! $treinamento->descricao !!}</p>
        <!-- Adicion                            e mais informações do treinamento conforme necessário -->
    </div>

    <div class="col-md-3">
        @if(!empty($treinamento->banner) && file_exists(public_path('upload/cursos_images/' . $treinamento->banner)))
            <img src="{{ asset('upload/cursos_images/' . $treinamento->banner) }}" class="img-fluid">
        @else
            <img src="{{ asset('upload/cursos_images/semimagembanner.png') }}" class="img-fluid">
        @endif

        <div class="row">
            <div class="col py-4">
                <a href="{{ asset('upload/folder/' . $treinamento->folder) }}" class="btn btn-primary mt-2" target="_blank">Abrir Folder</a>
            </div>

            <div class="col py-4">
                <a href="#" class="btn btn-primary mt-2" target="_blank">Inscrever - se</a>
            </div>
            
        </div>
    </div>
 
</div>

@endsection