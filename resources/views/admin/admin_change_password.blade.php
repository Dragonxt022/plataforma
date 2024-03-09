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
                        <h6 class="card-title">Editar Credenciais</h6>

                        <form method="POST" action="{{ route('admin.update.password') }}" class="forms-sample" enctype="multipart/form-data">
                          @csrf
                          {{-- Linha --}}
                          <div class="row">
                              <div class="col">
                                  <div class="mb-3">
                                      <label for="old_password" class="form-label">Senha antiga</label>
                                      <div class="input-group">
                                          <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password" autocomplete="off">
                                          <button class="btn btn-outline-secondary" type="button" id="toggleOldPassword">
                                              <i data-feather="eye"></i>
                                          </button>
                                      </div>
                                      @error('old_password')
                                      <span class="text-danger"> {{ $message }} </span>
                                      @enderror
                                  </div>
                              </div>
                          </div>
                          {{-- Linha --}}
                          <div class="row">
                              <div class="col">
                                  <div class="mb-3">
                                      <label for="new_password" class="form-label">Nova Senha</label>
                                      <div class="input-group">
                                          <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" autocomplete="off">
                                          <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                            <i data-feather="eye"></i>
                                          </button>
                                      </div>
                                      @error('new_password')
                                      <span class="text-danger"> {{ $message }} </span>
                                      @enderror
                                  </div>
                              </div>
                          </div>
                      
                          {{-- Linha --}}
                          <div class="row">
                              <div class="col">
                                  <div class="mb-3">
                                      <label for="new_password_confirmation" class="form-label">Confirmar nova Senha</label>
                                      <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" autocomplete="off">
                                  </div>
                              </div>
                          </div>
                          {{-- Linha --}}
                          <div class="row">
                              <div class="col py-3">
                                  <div class="mb-3">
                                      <button type="submit" class="btn btn-xs42 btn-primary">Atualizar
                                  </div>
                              </div>
                          </div>
                      </form>
                      
                      <script>
                          // Mostrar ou ocultar senha antiga
                          $('#toggleOldPassword').click(function() {
                              var oldPasswordField = $('#old_password');
                              var oldPasswordFieldType = oldPasswordField.attr('type');
                              if (oldPasswordFieldType === 'password') {
                                  oldPasswordField.attr('type', 'text');
                              } else {
                                  oldPasswordField.attr('type', 'password');
                              }
                          });
                      
                          // Mostrar ou ocultar nova senha
                          $('#toggleNewPassword').click(function() {
                              var newPasswordField = $('#new_password');
                              var newPasswordFieldType = newPasswordField.attr('type');
                              if (newPasswordFieldType === 'password') {
                                  newPasswordField.attr('type', 'text');
                              } else {
                                  newPasswordField.attr('type', 'password');
                              }
                          });
                      </script>
                      
                    </div>
                </div>
            </div>
      </div>
      <!-- middle wrapper end -->

    </div>
</div>


@endsection