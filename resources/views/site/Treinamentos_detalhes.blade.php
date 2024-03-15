@extends('site.templete')

@section('title', 'Detalhes')

@section('content')

    {{-- css personalizado da pagina --}}
    <style class="css/text">
        .coluna2 {
            position: relative;
            margin-top: -200px;
            background: #fffffff0;
            padding: 1% 2% 2% 2%;
            border-radius: 11px;
            border-width: 1px;
            box-shadow: 2px 2px 4px rgb(0 0 0 / 6%);
        }

        .botoes{
            margin-top: 8px;

        }

        .incputDados{
       
            width: 100%;
            height: auto;
            margin-bottom: -20px;
            min-height: 52px;
            padding: 14px 19px;
            border: 1px solid #060bff;
            border-radius: 25px;
            -webkit-appearance: none;
            line-height: 24px;
        }
    </style>

    <div class="page">
        {{-- Cabeçalho --}}
        <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap" style="background-image: url({{ asset('site/assets/images/noticias.png')}}">
            <div class="container">
            <div class="page-title">
                <h3>{{ $treinamentos->nome }}</h3>
            </div>
            </div>
        </section>
        {{-- Mostruario de treinamentos --}}
        <section class="section-50 section-md-75 section-lg-100">
            <div class="container">

                {{-- linha --}}
                <div class="row row-40">
                    {{-- Coluna  --}}
                    <div class="col-md-6 col-lg-9 height-fill">
                        
                        <h5 class="text-center">{{ $treinamentos->nome }}</h5>
                        <p>
                            {!! $treinamentos->descricao !!}
                        </p>
                    </div>

                    {{-- coluna --}}
                    <div class="col-md-6 col-lg-3 coluna2">
                        <div class="row">
                            {{-- formulalrio --}}
                            <form action="{{ route('site.pagina.formulario') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col text-center">
                                        <label for="quantidade_participantes">Quantidade de Participantes:</label>
                                        <input type="number" class="incputDados" id="quantidade_participantes" name="quantidade_participantes" min="1">
                                    </div>
                                </div>
                            
                                <!-- Campos adicionais para os dados do treinamento -->
                                <input type="hidden" name="id" value="{{ $treinamentos->id }}">
                                <input type="hidden" name="nome" value="{{ $treinamentos->nome }}">
                                <input type="hidden" name="slug" value="{{ $treinamentos->slug }}">
                                <input type="hidden" name="folder" value="{{ $treinamentos->folder }}">
                                <input type="hidden" name="descricao" value="{{ $treinamentos->descricao }}">
                                <input type="hidden" name="data_inicio" value="{{ $treinamentos->data_inicio }}">
                                <input type="hidden" name="data_termino" value="{{ $treinamentos->data_termino }}">
                                <input type="hidden" name="valor" value="{{ $treinamentos->valor }}">
                                <input type="hidden" name="vagas" value="{{ $treinamentos->vagas }}">
                                <input type="hidden" name="local" value="{{ $treinamentos->local }}">
                                <input type="hidden" name="id_empresa" value="{{ $treinamentos->id_empresa }}">
                                <input type="hidden" name="banner" value="{{ $treinamentos->banner }}">
                                <input type="hidden" name="docente" value="{{ $treinamentos->docente }}">
                            
                                <div class="row">
                                    
                                    <div class="col">
                                        <div class="py-3">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- botão --}}
                                        <button type="submit" class="botoes button button-block button-primary mb-2">REALIZAR INSCRIÇÃO</button>
                                        <a class="botoes button button-block button-success mb-2" href="{{ asset('upload/folder/' . $treinamentos->folder) }}" download>BAIXAR FOLDER</a>

                                    </div>
                                </div>
                            </form>                            
                        </div>
                        
                        <div class="row ">
                            {{-- imagem --}}
                            
                            <div>
                                <img src="{{ asset('upload/cursos_images/' . $treinamentos->banner) }}" title="{{ $treinamentos->nome }}" alt="{{ $treinamentos->nome }}">
                            </div>

                        </div>
                        

                    </div>

                </div>
                                
            </div>
        </section>
    </div>
@endsection
