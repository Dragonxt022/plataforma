@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
    
        <div class="col-md-8 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Editar Perfil</h6>

                        <form method="POST" action="{{ route('admin.atualizar.perfil', ['id' => $usuarios->id]) }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            {{-- Linha 1 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" name="username" id="username" autocomplete="off" value="{{ $usuarios->username }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control"  name="name" id="name" autocomplete="off" value="{{ $usuarios->name }}">
                                    </div>
                                </div>
                            </div>
                            {{-- Linha 2 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Celular</label>
                                        <input type="text" class="form-control"  name="phone" id="phone" value="{{ $usuarios->phone }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control"  name="email" id="email" value="{{ $usuarios->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Endereço</label>
                                        <input type="text" class="form-control"  name="address" id="address" value="{{ $usuarios->address }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Função</label>
                                        <select class="form-select" name="role" id="role">
                                            <option value="user" {{ $usuarioCargo == 'user' ? 'selected' : '' }}>Usuário</option>
                                            <option value="agent" {{ $usuarioCargo == 'agent' ? 'selected' : '' }}>Agente</option>
                                            <option value="admin" {{ $usuarioCargo == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>
                                </div>                                
                            </div>
                            {{-- linha 4 --}}
                            <div class="row py-5">
                                <div class="col-1 py-3">
                                    <img id="showImage" class="wd-55 rounded-circle" src="{{ (!empty($usuarios->photo)) ? url('upload/admin_images/'.$usuarios->photo) : url('upload/no_image.jpg') }}" alt="profile">
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="photo">Foto do Perfil</label>
                                        <input class="form-control" name="photo" type="file" id="image" value="{{ $usuarios->photo }}" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            {{-- Linha 5 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-xs btn-primary">Atualizar informações
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="{{ asset('backend/assets/vendors/inputmask/inputmask.min.js') }}"></script>
<script class="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        
        });
    });

    // Selecione o campo de entrada para o número de celular
    var phoneInput = document.getElementById('phone');

    // Aplique a máscara usando Inputmask
    Inputmask("(99) 99999-9999").mask(phoneInput);


</script>


@endsection