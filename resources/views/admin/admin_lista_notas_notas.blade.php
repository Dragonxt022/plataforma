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
            <h4 class="card-title">notas</h4>
            <p class="text-muted mb-3">Gerencie a documentação de sua empresa.</p>

            <div class="row">
                <div class="col-3">
                    

                    <form method="POST" action="{{ route('admin.notas.store') }}" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        {{-- Linha com coluna 1 --}}
                        <div class="row">
                            <div class="col">
                                {{-- coluna --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="nome_nota" class="form-label">Nome do arquivo:</label>
    
                                            <input class="form-control @error('nome_nota') is-invalid @enderror" name="nome_nota" id="nome_nota" value="{{ old('nome_nota') }}">
    
                                            @error('nome_nota')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- Coluna --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="data_vencimento" class="form-label">Data de válida (em branco se não ouver):</label>
    
                                            <input type="date" class="form-control @error('data_vencimento') is-invalid @enderror" name="data_vencimento" id="data_vencimento" value="{{ old('data_vencimento') }}">
    
                                            @error('data_vencimento')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Coluna --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="link_arquivo" class="form-label">Arquivo (ex. PDF, Word):</label>
    
                                            <input type="file" class="form-control @error('link_arquivo') is-invalid @enderror" name="link_arquivo" id="link_arquivo" value="{{ old('link_arquivo') }}">
    
                                            @error('link_arquivo')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Coluna --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="id_notas_categoria" class="form-label">Empresa:</label>
                                            <select class="form-select @error('id_notas_categoria') is-invalid @enderror" name="id_notas_categoria" id="id_notas_categoria">
                                                <option value="">Selecione uma categoria</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" {{ old('id_notas_categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome_categoria }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_notas_categoria')
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
                                        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col py-3">
                                <p>Notas, certidões, foders entre outros documentos.</p>
                            </div>
                        </div>
                        
                    </form> 

                </div>

                <div class="col-9">

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
                                    <button type="button" class="btn btn-primary btn-icon mx-2">
                                        <a href="{{ asset('upload/notas_pdf/' . $nota->link_arquivo) }}" target="_blank">
                                            <i data-feather="eye" style="color: #ffffff;"></i> 
                                        </a>
                                    </button>
                                    
                      
                                      <button type="button" class="btn btn-danger btn-icon" data-toggle="modal"
                                          data-target="#confirmDelete{{ $nota->id }}">
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
@foreach ($notas as $nota)
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
@endforeach

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