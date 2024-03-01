<!DOCTYPE html>

<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="pagina de autentificação">
	<meta name="author" content="pissinet">
	<meta name="keywords" content="Login">

	<title>Entrar</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">

    <style type="text/css">
        .authlogin-side-wrapper{
            width: 100%;
            height: 100%;
            background-image: url({{ asset('upload/introLogin.png') }});
        }
    
    </style>
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('backend/assets/css/demo1/style.css') }}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="authlogin-side-wrapper">

                </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">Plataforma<span>PL</span></a>
                    <h5 class="text-muted fw-normal mb-4">Bem-vindo de volta! Faça a conexão para entrar em sua conta.</h5>
                    
                    <form method="POST" class="forms-sample" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">

                            <label for="login" class="form-label">E-mail/ Usuario/ Celular</label>
                            <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" id="login">
                            @error('login')
                                <span class="text-danger pt-2"> {{ $message }} </span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                                <span class="text-danger pt-2"> {{ $message }} </span>
                            @enderror

                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="authCheck">
                            <label class="form-check-label" for="authCheck">
                            Relembrar - me
                            </label>
                        </div>
                        <div>
                        
                            <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">Conectar</button>

                        </div>
                        <div class="pt-4">
                          @if (Route::has('password.request'))
                              <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                  {{ __('Esqueceu a senha?') }}
                              </a>
                          @endif
                        </div>
                          
                    </form>
                  </div>
                </div>
                </div>
			</div>
		</div>
	</div>

	<!-- core:js -->
	<script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->


	<!-- inject:js -->
	<script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/template.js') }}"></script>
	<!-- endinject -->

</body>
</html>