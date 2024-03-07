@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista de Usuarios</h4>
            <p class="text-muted mb-3">Essa tabela contem todos os usuarios ativos até o momento.</p>
            <div class="table-responsive pt-3">
              <table id="dataTabelaUsuario" class=" table table-dark display responsive" style="width:100%">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>  </th>
                    <th>Função</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th class="text-center"> Ação </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($usuarios as $usuario)
                  <tr>
                    <td class=" align-middle">{{ $usuario->id }}</td>
                    <td class="text-center">
                      <img src="{{ $usuario->photo ? asset('upload/admin_images/' . $usuario->photo) : asset('upload/no_image.jpg') }}" alt="Foto do perfil" class="wd-55 rounded-circle">

                     </td>
                     <td class=" align-middle">
                        @php
                            $role = $usuario->role;
                            // Mapeamento para traduzir os valores do papel para o português
                            $roles = [
                                'user' => 'Usuário',
                                'agent' => 'Agente',
                                'admin' => 'Administrador',
                                // Adicione mais traduções conforme necessário
                            ];
                            // Verifique se o valor do papel está no array de traduções
                            $roleTranslation = isset($roles[$role]) ? $roles[$role] : $role;
                        @endphp
                        {{ $roleTranslation }}
                    </td>
                    <td class=" align-middle">{{ $usuario->name }}</td>
                    <td class=" align-middle">{{ $usuario->email }}</td>
                    <td class=" align-middle">{{ $usuario->phone }}</td>
                    <td class="d-flex text-center">

                      <button type="button" class="btn btn-primary btn-xs btn-icon mx-2">
                          <a  href="{{ route('admin.editar.perfil', ['usuarios' => $usuario->id]) }}">
                              <i data-feather="edit" style="color: #ffffff;"></i>
                          </a>
                      </button>
                    
                      <button type="button" class="btn btn-danger btn-xs btn-icon"  data-toggle="modal" data-target="#confirmDelete{{ $usuario->id }}">
                        <i data-feather="trash-2"></i>
                      </button>
                  </td>
                  
                  {{-- <!-- Modal de Confirmação de Exclusão --> --}}
                  <div class="modal fade" id="confirmDelete{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  Tem certeza que deseja excluir? {{ $usuario->nome }}
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger ">Excluir</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  </tr>
                  @endforeach

                </tbody>
                
              </table>
              
            </div>
          </div>
        </div>
      </div>

    </div>
</div>

<script>
  $(document).ready(function() {
        $('#dataTabelaUsuario').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json"
            }
        });
    });
</script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection