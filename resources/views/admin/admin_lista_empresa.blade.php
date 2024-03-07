@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista de Empressas</h4>
            <p class="text-muted mb-3"><code>Importante! É preciso ter uma empresa cadastrada para poder conseguir cadastrar um curso.</code></p>
            <div class="table-responsive pt-3">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Banco</th>
                    <th> Ação </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($empresas as $empresa)
                  <tr>
                    <td class="text-center align-middle">{{ $empresa->id }}</td>
                    <td class=" align-middle">{{ $empresa->nome }}</td>
                    <td class=" align-middle">{{ $empresa->cnpj }}</td>
                    <td class=" align-middle">{{ $empresa->banco }}</td>
                    <td class="d-flex">
                      <button type="button" class="btn btn-primary btn-xs btn-icon mx-2">
                          <a href="{{ route('admin.editar.empresa', ['empresa' => $empresa->id]) }}">
                              <i data-feather="edit" style="color: #ffffff;"></i>
                          </a>
                      </button>
                    
                      <button type="button" class="btn btn-danger btn-xs btn-icon"  data-toggle="modal" data-target="#confirmDelete{{ $empresa->id }}">
                        <i data-feather="trash-2"></i>
                      </button>
                  </td>
                  
                  <!-- Modal de Confirmação de Exclusão -->
                  <div class="modal fade" id="confirmDelete{{ $empresa->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  Tem certeza que deseja excluir esta empresa? {{ $empresa->nome }}
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  <form method="POST" action="{{ route('admin.empresas.destroy', $empresa) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Excluir</button>
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
      <!-- middle wrapper end -->

    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection