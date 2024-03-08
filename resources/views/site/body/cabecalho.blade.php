<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href=" {{ route('site.pagina.inicio') }} ">Plataforma PL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.pagina.inicio') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" {{ route('site.treinamentos') }}">Treinamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contatos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" {{ route('admin.dashboard') }} " target="_blank">Login</a>
                </li>
            </ul>
        </div>
    </div>
    
</nav>
