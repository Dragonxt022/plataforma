@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            <h4 class="card-title">Inscrições</h4>
            <p class="text-muted mb-3">Gerencie inscri.</p>

            <div class="row">

                <div class="col-12">

                    <div class="table-responsive pt-3">
                        <table id="dataTabelatreinamento" class="table table-dark display responsive" style="width:100%">
                          <thead>
                              <tr>
                                  <th class="text-center">ID</th>
                                  <th>Nome</th>
                                  <th>Categoria</th>
                                  <th class="text-center" >Data</th>
                                  <th class="text-center"> Ação </th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($notas as $nota)
                              <tr>
                                  <td class="text-center align-middle {{ $nota->data_vencimento_class }}">{{ $nota->id }}</td>
                                  <td class="align-middle {{ $nota->data_vencimento_class }}">{{ $nota->nome_nota }}</td>
                                  <td class="align-middle {{ $nota->data_vencimento_class }}">
                                        @foreach ($categorias as $categoria)
                                            @if ($categoria->id == $nota->id_notas_categoria)
                                                {{ $categoria->nome_categoria }}
                                            @endif
                                        @endforeach
                                  </td>
                                  <td class="text-center align-middle {{ $nota->data_vencimento_class }}">{{ $nota->data_vencimento }}</td>
                                  <td class="text-center align-middle">
                                    {{-- <button type="button" class="btn btn-primary btn-icon mx-2">
                                        <a href="{{ asset('upload/notas_pdf/' . $nota->link_arquivo) }}" target="_blank">
                                            <i data-feather="eye" style="color: #ffffff;"></i> 
                                        </a>
                                    </button>
                                    
                      
                                      <button type="button" class="btn btn-danger btn-icon" data-toggle="modal"
                                          data-target="#confirmDelete{{ $nota->id }}">
                                          <i data-feather="trash-2"></i>
                                      </button> --}}
                                  </td>
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

    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
{{-- @foreach ($notas as $nota)
<div class="modal fade" id="confirmDelete{{ $nota->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esta nota? {{ $nota->nome_nota }} <br><br> ATENÇÃO! Se a nota estiver vinculada com algum arquivo, esse arquivo assumira a nota padrão do sistema.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('admin.notas.destroy', $nota) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach --}}

<script>
    $(document).ready(function() {
        $('#dataTabelatreinamento').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json"
            },
            "order": [[2, "asc"]] // Defina a ordem inicial da primeira coluna em ordem decrescente
        });
    });

</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection