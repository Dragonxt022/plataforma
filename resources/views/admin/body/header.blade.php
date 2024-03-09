<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
                    <input type="text" class="form-control" id="navbarForm" placeholder="Buscar por...">
                </div>
        </form>
        <ul class="navbar-nav">
            @php
                
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);

            @endphp

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="mail"></i>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>9 Novas Mensagens</p>
                        <a href="javascript:;" class="text-muted">Limpar todas</a>
                    </div>
                <div class="p-1">
                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                    <div class="me-3">
                    <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="userr">
                    </div>
                    <div class="d-flex justify-content-between flex-grow-1">
                    <div class="me-4">
                        <p>Camara de Ji-Paraná</p>
                        <p class="tx-12 text-muted">Nova Inscrição</p>
                    </div>
                    <p class="tx-12 text-muted">2 min ago</p>
                    </div>	
                </a>
                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                    <div class="me-3">
                    <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="userr">
                    </div>
                    <div class="d-flex justify-content-between flex-grow-1">
                    <div class="me-4">
                        <p>Prefeitura de Cacaulandia</p>
                        <p class="tx-12 text-muted">Novo comentário</p>
                    </div>
                    <p class="tx-12 text-muted">30 min ago</p>
                    </div>	
                </a>
                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                    <div class="me-3">
                    <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="userr">
                    </div>
                    <div class="d-flex justify-content-between flex-grow-1">
                    <div class="me-4">
                        <p>Camara Cerejeiras</p>
                        <p class="tx-12 text-muted">Emitiu certificado</p>
                    </div>
                    <p class="tx-12 text-muted">1 hrs ago</p>
                    </div>	
                </a>

                </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="javascript:;">Ver todos</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>6 Novas notificações</p>
                        <a href="javascript:;" class="text-muted">Limpar todas</a>
                    </div>
                    <div class="p-1">
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                                    <i class="icon-sm text-white" data-feather="gift"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                                    <p>Certidão Municipal - Vencida</p>
                                                    <p class="tx-12 text-muted">30 min ago</p>
                            </div>	
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                                    <i class="icon-sm text-white" data-feather="alert-circle"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>Adriano Silva - Fez Login</p>
                                <p class="tx-12 text-muted">1 hrs ago</p>
                            </div>	
                        </a>
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                            <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="userr">
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>Sua parcela vence em 3 dias</p>
                                <p class="tx-12 text-muted">2 sec ago</p>
                            </div>	
                        </a>
                        </div>
                        <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                            <a href="javascript:;">Ver todas</a>
                        </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder"> {{$profileData->name}} </p>
                            <p class="tx-12 text-muted py-1" id="copyEmail" title="Click para copiar">{{$profileData->email}}</p>
                            <p class="tx-12 text-muted" id="copyPhone" title="Click para copiar">{{$profileData->phone}}</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ route('admin.profile') }}" class="text-body ms-0">
                            <i class="me-2 icon-md" data-feather="user"></i>
                            <span>Perfil</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href=" {{ route('admin.change.password') }} " class="text-body ms-0">
                            <i class="me-2 icon-md" data-feather="edit"></i>
                            <span>Editar Perfil</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="javascript:;" class="text-body ms-0">
                            <i class="me-2 icon-md" data-feather="repeat"></i>
                            <span>Trocar de usuario</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="{{ route('admin.logout') }}" class="text-body ms-0">
                            <i class="me-2 icon-md" data-feather="log-out"></i>
                            <span>Desconectar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

{{-- Sistema de copiar infor do perfil sidebar --}}
<script>
    document.getElementById('copyEmail').addEventListener('click', function() {
        copyToClipboard('{{$profileData->email}}');
    });

    document.getElementById('copyPhone').addEventListener('click', function() {
        copyToClipboard('{{$profileData->phone}}');
    });

    function copyToClipboard(text) {
        var dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        alert("Copiado para a área de transferência: " + text);
    }
</script>