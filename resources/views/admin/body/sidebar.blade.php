<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        GRUPO<span>INCAP</span>
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
            {{-- Gerenciar de TREINAMENTOS --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#treinamentos" role="button" aria-expanded="false" aria-controls="treinamentos">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Cursos/Treinamentos</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="treinamentos">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('admin.treinamentos.index') }}" class="nav-link">Lista todas</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.treinamentos.create') }}" class="nav-link">Cadastrar novo</a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            {{-- Gerenciar de INSCRIÇÕES --}}
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#inscricao" role="button" aria-expanded="false" aria-controls="inscricao">
                                <i class="link-icon" data-feather="airplay"></i>
                                <span class="link-title">Inscrições</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="inscricao">
                                <ul class="nav sub-menu">

                                    <li class="nav-item">
                                        <a href="{{ route('admin.inscricoes.index') }}" class="nav-link">Lista Inscrições</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
            
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

            {{-- Getenciar POSTAGENS --}}
            <li class="nav-item nav-category">POSTAGENS</li>
            {{-- Gerenciar de treinamentos --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#treinamentos" role="button" aria-expanded="false" aria-controls="treinamentos">
                    <i class="link-icon" data-feather="pen-tool"></i>
                    <span class="link-title">Categorias</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="treinamentos">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('admin.categoria.index') }}" class="nav-link">Listar de categorias</a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Configurações</li>
            {{-- Gerenciar EMPRESAS --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#Empresas" role="button" aria-expanded="false" aria-controls="Empresas">
                    <i class="link-icon" data-feather="trello"></i>
                    <span class="link-title">Empresas</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="Empresas">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.empresas.create') }}" class="nav-link">Adicionar</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.lista.empressas') }}" class="nav-link">Lista Empresas</a>
                        </li>
                    </ul>
                    
                </div>
            </li>

            {{-- Gerenciar BANNERS --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#Banners" role="button" aria-expanded="false" aria-controls="Banners">
                    <i class="link-icon" data-feather="image"></i>
                    <span class="link-title">Banners</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="Banners">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.banners.index') }}" class="nav-link">Pagina Inicial</a>
                        </li>
                    </ul>
                    
                </div>
            </li>

            {{-- Gerenciar de USÚARIOS --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#submenuUsuarios" role="button" aria-expanded="false" aria-controls="submenuUsuarios">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Usuários</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="submenuUsuarios">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('admin.usuarios.cadastrar') }}" class="nav-link">Adicionar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.lista.profile') }}" class="nav-link">Lista de usuários</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Gerenciar de Geral --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#geral" role="button" aria-expanded="false" aria-controls="geral">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Geral</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="geral">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="#" class="nav-link">Templete do Site</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.configuracao.desconto') }}" class="nav-link">Descontos automaticos</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Configurações de E-mail</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Configurações Gerador PDF</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

