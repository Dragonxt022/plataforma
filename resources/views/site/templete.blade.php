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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    


    <!-- Estilos CSS -->
    <link rel="stylesheet" href="{{ asset('site/assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">
    {{-- CDNs toastr --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

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

    {{-- cdn js toastr  --}}
	  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
      @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type) {
          case 'info':
            toastr.info("{{ Session::get('message') }}", "Informação", { 
              positionClass: 'toast-bottom-right', 
              progressBar: true, 
              progressBarClass: 'white-progress',
              closeButton: true, // Adiciona um botão de fechar à mensagem
              tapToDismiss: false, // Impede que a mensagem seja fechada ao clicar nela
              newestOnTop: true, // Exibe a mensagem mais recente no topo
              showDuration: 300, // Define a duração de exibição da mensagem em milissegundos
              hideDuration: 1000, // Define a duração de ocultação da mensagem em milissegundos
              timeOut: 5000, // Define o tempo em milissegundos antes da mensagem ser fechada automaticamente
              extendedTimeOut: 1000, // Define o tempo em milissegundos antes da mensagem ser fechada automaticamente (se o mouse estiver sobre ela)
              showEasing: 'swing', // Define a animação de exibição da mensagem
              hideEasing: 'linear', // Define a animação de ocultação da mensagem
              showMethod: 'fadeIn', // Define o método de exibição da mensagem
              hideMethod: 'fadeOut' // Define o método de ocultação da mensagem
            });
            break;
          case 'success':
            toastr.success("{{ Session::get('message') }}", "Sucesso", { 
              positionClass: 'toast-bottom-right', 
              progressBar: true, 
              progressBarClass: 'white-progress',
              closeButton: true, 
              tapToDismiss: false, 
              newestOnTop: true, 
              showDuration: 300, 
              hideDuration: 1000, 
              timeOut: 5000, 
              extendedTimeOut: 1000, 
              showEasing: 'swing', 
              hideEasing: 'linear', 
              showMethod: 'fadeIn', 
              hideMethod: 'fadeOut' 
            });
            break;
          case 'warning':
            toastr.warning("{{ Session::get('message') }}", "Aviso", { 
              positionClass: 'toast-bottom-right', 
              progressBar: true, 
              progressBarClass: 'white-progress',
              closeButton: true, 
              tapToDismiss: false, 
              newestOnTop: true, 
              showDuration: 300, 
              hideDuration: 1000, 
              timeOut: 5000, 
              extendedTimeOut: 1000, 
              showEasing: 'swing', 
              hideEasing: 'linear', 
              showMethod: 'fadeIn', 
              hideMethod: 'fadeOut' 
            });
            break;
          case 'error':
            toastr.error("{{ Session::get('message') }}", "Erro", { 
              positionClass: 'toast-bottom-right', 
              progressBar: true, 
              progressBarClass: 'white-progress',
              closeButton: true, 
              tapToDismiss: false, 
              newestOnTop: true, 
              showDuration: 300, 
              hideDuration: 1000, 
              timeOut: 5000, 
              extendedTimeOut: 1000, 
              showEasing: 'swing', 
              hideEasing: 'linear', 
              showMethod: 'fadeIn', 
              hideMethod: 'fadeOut' 
            });
            break;
        }
      @endif
    </script>
  </body>
</html>
