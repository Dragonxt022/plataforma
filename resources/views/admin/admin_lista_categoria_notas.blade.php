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
            <h4 class="card-title">Categorias</h4>
            <p class="text-muted mb-3">Lista contendo as categorias usadas para separação de documentos.</p>

            <div class="row">
                <div class="col-4">
                    

                    <form method="POST" action="{{ route('admin.categorias.store') }}" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        {{-- Linha com coluna 1 --}}
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="nome_categoria" class="form-label">Nome da Categoria:</label>
    
                                            <input class="form-control @error('nome_categoria') is-invalid @enderror" name="nome_categoria" id="nome_categoria" value="{{ old('nome_categoria') }}">
    
                                            @error('nome_categoria')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-block">Adicionar</button>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col py-3">
                                <p>Adicione ou edite suas categorias, para que você possa organizar seus arquivos e documentos.</p>
                            </div>
                        </div>
                        
                    </form> 

                </div>

                <div class="col-8">

                    <div class="table-responsive pt-3">
                        <table id="dataTabelatreinamento" class="table table-dark display responsive" style="width:100%">
                          <thead>
                              <tr>
                                  <th class="text-center">ID</th>
                                  <th>Categoria</th>
                                  <th class="text-center"> Ação </th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($categorias as $categoria)
                              <tr>
                                  <td class="text-center align-middle">{{ $categoria->id }}</td>
                                  <td class="align-middle">{{ $categoria->nome_categoria }}</td>
                                  <td class="text-center align-middle">
                                      <button type="button" class="btn btn-primary btn-xs btn-icon mx-2">
                                          <a href="{{ route('admin.categorias.edit', ['categoria' => $categoria->id]) }}">
                                              <i data-feather="edit" style="color: #ffffff;"></i>
                                          </a>
                                      </button>
                      
                                      <button type="button" class="btn btn-xs btn-danger btn-xs btn-icon" data-toggle="modal"
                                          data-target="#confirmDelete{{ $categoria->id }}" @if ($categoria->id == 1) disabled @endif>
                                          <i data-feather="trash-2"></i>
                                      </button>
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
@foreach ($categorias as $categoria)
<div class="modal fade" id="confirmDelete{{ $categoria->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esta categoria? {{ $categoria->nome_categoria }} <br><br> ATENÇÃO! Se a categoria estiver vinculada com algum arquivo, esse arquivo assumira a categoria padrão do sistema.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('admin.categorias.destroy', $categoria) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
  $(document).ready(function() {
        $('#dataTabelatreinamento').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json"
            }
        });
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection