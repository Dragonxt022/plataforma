<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-BR">
  <head>

    <title>@yield('title')</title>

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    {{-- icone do site --}}
    <link rel="icon" href="{{ asset('site/assets/images/favicon.ico') }}" type="image/x-icon">

    {{-- Fontes --}}
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic%7CLato:300,300italic,400,400italic,700,900%7CMerriweather:700italic">

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="{{ asset('site/assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">

  </head>
  <body>

    @include('site.body.cabecalho') <!-- Include do Cabeçalho -->
      <div class="preloader">
        <div class="preloader-body">
          <div class="cssload-container">
            <div class="cssload-speeding-wheel"> </div>
          </div>
          <p>Carregando...</p>
        </div>
      </div>
      
      {{-- templete --}}
      @yield('content')
      

    @include('site.body.rodape') <!-- Include do Cabeçalho -->


    </div>

    <div class="snackbars" id="form-output-global"></div>

    {{-- Script --}}
    <script src="{{ asset('site/assets/js/core.min.js')}}"></script>
    <script src="{{ asset('site/assets/js/script.js')}}"></script>
  </body>
</html>
