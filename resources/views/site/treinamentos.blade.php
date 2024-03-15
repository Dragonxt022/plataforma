@extends('site.templete')

@section('title', 'Treinamento')

@section('content')

    {{-- css personalizado da pagina --}}
    <style class="css/text">
        .icon-box {
            max-width: none !important;
            padding: 10px !important;
        }

        .textCurso{
             color: blue !important;
        }
    </style>

    <div class="page">
        {{-- Cabeçalho --}}
        <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap" style="background-image: url({{ asset('site/assets/images/noticias.png')}}">
            <div class="container">
            <div class="page-title">
                <h2>Treinamentos</h2>
            </div>
            </div>
        </section>
        {{-- Mostruario de treinamentos --}}
        <section class="section-50 section-md-75 section-lg-100">
            <div class="container">
                <div class="row row-40">
                    @foreach($treinamentos as $treinamento)
                        <div class="col-md-6 col-lg-3 height-fill">
                            <article class="icon-box">
                                <a href="{{ route('site.treinamento.detalhes', $treinamento->slug) }}">
                                    <div>
                                        <div><img src="{{ asset('upload/cursos_images/' . $treinamento->banner) }}" alt="{{ $treinamento->titulo }}"></div>
                                        <div class="divider bg-accent"></div>
                                        <div>
                                            <h6>{{ $treinamento->nome }}</h6>
                                        </div>
                                    </div>
                                    <div class="box-body py-3 textCurso">
                                        <p><i class="bi bi-clock"></i> {{ $treinamento->periodo }}</p>
                                        <p><i class="bi bi-geo-alt"></i> {{ $treinamento->local }}</p>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
                                
            </div>
        </section>
    </div>
@endsection
