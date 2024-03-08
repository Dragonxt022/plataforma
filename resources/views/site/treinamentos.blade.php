@extends('site.inicio')

@section('title', 'Treinamento')

@section('content')
<div class="row">
    @foreach($treinamentos as $treinamento)
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">

                <img src="{{ asset('upload/cursos_images/' . $treinamento->banner) }}" class="img-fluid">

                <h5 class="card-title">{{ $treinamento->nome }}</h5>
                <p class="card-text"><strong>Data de Início:</strong> <span class="{{ $treinamento->data_inicio_class }}">{{ $treinamento->data_inicio }}</span></p>
                <p class="card-text"><strong>Data de Término:</strong> {{ $treinamento->data_termino }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $treinamento->status }}</p>
                <!-- Adicione mais informações do treinamento conforme necessário -->
            </div>
            <div class="card-footer">
                <a href="{{ route('site.treinamentos_detalhes', $treinamento->id) }}" class="btn btn-primary">Mais detalhes</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection