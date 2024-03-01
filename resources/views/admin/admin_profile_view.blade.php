@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
            

                <div>
                    <img class="wd-100 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                    <span class="h4 ms-3"> {{ $profileData->name }}</span>
                </div>

            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Nome:</label>
              <p class="text-muted"> {{ $profileData->name }} </p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">E-mail:</label>
              <p class="text-muted"> {{ $profileData->email }} </p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Celular:</label>
              <p class="text-muted"> {{ $profileData->phone }} </p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Endereço:</label>
              <p class="text-muted"> {{ $profileData->address }} </p>
            </div>
            <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->

      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Editar Perfil</h6>

                        <form method="POST" action=" {{ route('admin.profile.store') }} " class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            {{-- Linha 1 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" name="username" id="username" autocomplete="off" value="{{ $profileData->username }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nome</label>
                                        <input type="text" class="form-control"  name="name" id="name" autocomplete="off" value="{{ $profileData->name }}">
                                    </div>
                                </div>
                            </div>
                            {{-- Linha 2 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control"  name="email" id="email" value="{{ $profileData->email }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Celular</label>
                                        <input type="text" class="form-control"  name="phone" id="phone" value="{{ $profileData->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Endereço</label>
                                        <input type="text" class="form-control"  name="address" id="address" value="{{ $profileData->address }}">
                                    </div>
                                </div>
                            </div>
                            {{-- linha 4 --}}
                            <div class="row py-5">
                                <div class="col-1 py-3">
                                    <img id="showImage" class="wd-55 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="photo">Foto do Perfil</label>
                                        <input class="form-control" name="photo" type="file" id="image" value="{{ $profileData->photo }}" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            {{-- Linha 5 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Atualizar informações
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
      <!-- middle wrapper end -->

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