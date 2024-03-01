@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
    
        <div class="col-md-8 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Cadastrar novo Perfil</h6>

                        <form method="POST" action="{{ route('admin.usuarios.salvar') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            {{-- Linha 1 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Usuário</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" autocomplete="off" value="{{ old('username') }}">
                                        @error('username')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" id="name" autocomplete="off" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Linha 2 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Celular</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"  name="phone" id="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"  name="email" id="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Linha 3 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Endereço</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"  name="address" id="address" value="{{ old('address') }}">
                                        @error('address')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Senha:</label>

                                        <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" autocomplete="off">

                                        @error('password')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Função</label>
                                        <select class="form-select" name="role" id="role">
                                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário</option>
                                            
                                            <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>Agente</option>

                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            
                                        </select>
                                    </div>
                                </div>                                
                            </div>
                            {{-- linha 4 --}}
                            <div class="row py-5">
                                <div class="col-1 py-3">
                                    <img id="showImage" class="wd-55 rounded-circle" src="{{ url('upload/no_image.jpg') }}" alt="profile">
                                    
                                </div>
                        
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="photo">Foto do Perfil</label>
                                        <input class="form-control @error('photo') is-invalid @enderror" name="photo" type="file" id="image" accept="image/*">
                                        @error('photo')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Linha 5 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Cadastrar Usuário</button>
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
</div>



@endsection