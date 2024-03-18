@extends('site.templete')  
@section('content')

<div class="page">

    {{-- Cabeçalho --}}
    <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap" style="background-image: url({{ asset('site/assets/images/noticias.png')}}">
      <div class="container">
        <div class="page-title">
          <h2>Obrigado</h2>
        </div>
      </div>
    </section>
    {{-- SESSÃO DE ÚTIMAS NOTICIAS NOTICIAS --}}
    <section class="section-50 section-md-75 section-xl-100">
      <div class="container">
        <h3 class="text-center">Obrigado pela sua inscrição</h3>
        <div class="row row-40 row-offset-1 justify-content-sm-center justify-content-md-start">

          <div class="col-sm-9 col-md-12 col-lg-12 col-xl-12">
            <p>Nome do Curso: {{ $dadosRequisicao['nome'] }}</p>
            <p>Data de Início: {{ $dadosRequisicao['data_inicio'] }}</p>
            <p>Data de Término: {{ $dadosRequisicao['data_termino'] }}</p>
          </div>
        </div>
      </div>
    </section>


@endsection