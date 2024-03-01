<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Painel Administrativo Mestre">
	<meta name="author" content="Pissinet">
	<meta name="keywords" content="plataforma, tecnologia, agencia web, web, desenvolvimento">

	<title>Painel Administrativo</title>

	{{-- jquery 3.7.1 --}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
 	 <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />


	
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}.">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}" />

  {{-- CDNs toastr --}}
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >


</head>
<body>
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
		@include('admin.body.sidebar')
		
        <!-- partial -->

    
        <div class="page-wrapper">
                
        <!-- partial:partials/_navbar.html -->
        @include('admin.body.header')
        
        <!-- partial -->
        @yield('admin')
        
        <!-- partial:partials/_footer.html -->
        @include('admin.body.footer')

        <!-- partial -->
    
    </div>
	</div>

	<!-- core:js -->
	<script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
	<script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
	<script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
	<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json"></script>

	
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/template.js') }}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
  	<script src="{{ asset('backend/assets/js/dashboard-dark.js') }}"></script>
	{{-- End custom js for this page --}}

	{{-- cdn js toastr  --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	

	{{-- Sistema de notificação --}}
	<style>
		.white-progress {
			background-color: #ffffff; 
			box-shadow: none;
		}
	</style>
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