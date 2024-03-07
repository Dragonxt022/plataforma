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
                                  <th>JURIDICO/OGRÃO</th>
                                  {{-- <th> CURSO/TREINAMENTO </th> --}}
                                  <th> CIDADE </th>
                                  <th class="text-center"> DATA/HORA </th>
                                  <th>Valor R$ </th>
                                  <th class="text-center"> STATUS </th>
                                  <th class="text-center"> Ação </th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($inscricoes as $inscricao)
                              <tr>
                                  <td class="text-center align-middle">{{ $inscricao->id }}</td>
                                  <td class="align-middle">{{ $inscricao->nome_empresa }}</td>
                                  {{-- <td class="align-middle">{{ $inscricao->nome_treinamento }}</td> --}}
                                  <td class="align-middle">{{ $inscricao->cidade }}</td>

                                  <td class="align-middle text-center">{{ $inscricao->data_realizacao }}</td>
                                  <td class="align-middle">{{ $inscricao->total }}</td>

                                  <td class="align-middle text-center">
                                        <form method="POST" action="{{ route('admin.alterar.status', $inscricao->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <select class="form-control {{ $inscricao->cor_classe }}" name="status" onchange="this.form.submit()">
                                                    <option value="Processando" {{ $inscricao->status == 'Processando' ? 'selected' : '' }}>Processando</option>
                                                    <option value="Pago" {{ $inscricao->status == 'Pago' ? 'selected' : '' }}>Concluído</option>
                                                    <option value="Cancelado" {{ $inscricao->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                                </select>
                                            </div>
                                        </form>
                                  </td>

                                  <td class="text-center align-middle">
                                    <button type="button" class="btn btn-primary btn-xs btn-icon mx-2">
                                        <a href="{{ asset('upload/inscricoes_pdf/' . $inscricao->pdf_caminho) }}" target="_blank">
                                            <i data-feather="eye" style="color: #ffffff;"></i> 
                                        </a>
                                    </button>
                                    
                      
                                      <button type="button" class="btn btn-warning btn-xs btn-icon" data-toggle="modal"
                                          data-target="#confirmDelete{{ $inscricao->id }}">
                                          <i data-feather="edit"></i>
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
{{-- @foreach ($inscricoes as $inscricoe)
<div class="modal fade" id="confirmDelete{{ $inscricoe->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esta inscricoe? {{ $inscricoe->nome_inscricoe }} <br><br> ATENÇÃO! Se a inscricoe estiver vinculada com algum arquivo, esse arquivo assumira a inscricoe padrão do sistema.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('admin.inscricoes.destroy', $inscricoe) }}">
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
            "order": [[0, "desc"]] // Defina a ordem inicial da primeira coluna em ordem decrescente
        });
    });

</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection