<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        Plataforma<span>PN</span>
        </a>
        <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Menu</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item nav-category">Administrativo</li>
            {{-- Gerenciar de treinamentos --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#treinamentos" role="button" aria-expanded="false" aria-controls="treinamentos">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Gerencia Cursos</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="treinamentos">
                    <ul class="nav sub-menu">
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.treinamentos.index') }}" class="nav-link">Lista</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.treinamentos.create') }}" class="nav-link">Cadastrar</a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Configurações</li>

            {{-- Gerenciar Categoria --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#gerenciarNotas" role="button" aria-expanded="false" aria-controls="gerenciarNotas">
                    
                    <i class="link-icon"data-feather="file"></i>
                    <span class="link-title">Documentos</span>
                    <i class="link-arrow" data-feather="chevron-down" ></i>
                </a>

                <div class="collapse" id="gerenciarNotas">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href=" {{ route('admin.notas.index') }} " class="nav-link"> Gerenciar </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.categorias.index') }}" class="nav-link">Categorias </a>
                        </li>
                        
                    </ul>
                </div>
                
                

            </li>

            {{-- Gerenciar Empresas --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#Empresas" role="button" aria-expanded="false" aria-controls="Empresas">
                    <i class="link-icon" data-feather="trello"></i>
                    <span class="link-title">Empresas</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="Empresas">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.empresas.create') }}" class="nav-link">Cadastrar</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.lista.empressas') }}" class="nav-link">Lista</a>
                        </li>
                    </ul>
                    
                </div>
            </li>
            {{-- Gerenciar de usuários --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#submenuUsuarios" role="button" aria-expanded="false" aria-controls="submenuUsuarios">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Usuários</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="submenuUsuarios">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('admin.usuarios.cadastrar') }}" class="nav-link">Cadastar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.lista.profile') }}" class="nav-link">Lista</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

