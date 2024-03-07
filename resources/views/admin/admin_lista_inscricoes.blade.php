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
            <p class="text-muted mb-3">Página de gerenciamento de inscrições recebidas pelos formulários</p>

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
                                  <th class="text-center"> DATA </th>
                                  <th>Valor</th>
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
                                  <td class="align-middle">R$ {{ $inscricao->total }}</td>

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
                                    <button type="button" class="btn btn-primary btn-xs btn-icon mx-2" data-bs-toggle="modal" data-bs-target="#detalhesInscricao{{ $inscricao->id }}">
                                        <i data-feather="eye" style="color: #ffffff;"></i> 
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
@foreach ($inscricoes as $inscricao)
    <div class="modal fade" id="detalhesInscricao{{ $inscricao->id }}" tabindex="-1" aria-labelledby="detalhesInscricaoLabel{{ $inscricao->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- Linha  --}}
            <div class="row">
                <div class="modal-header">
                    <div class="col-10 d-flex justify-content-between ms-3">
                        <h5 class="modal-title" id="detalhesInscricaoLabel{{ $inscricao->id }}">Detalhes da Inscrição N° {{ $inscricao->id }}</h5>
                        <p class="text-left {{ $inscricao->cor_classe }}">{{ $inscricao->status }}</p>
                    </div>
                    <div class="col ms-6">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    
                </div>
            </div>
            {{-- Linha --}}
            <div class="row">
                
            </div>
            <div class="modal-body">
                <ul>
                    <li>Quantidade de Inscritos: {{ $inscricao->quantidade_inscritos }}</li>
                    <li>Valor do Curso: R$ {{ $inscricao->valor_curso }}</li>
                    <li>Subtotal: R$ {{ $inscricao->subtotal }}</li>
                    <li>Desconto: R$ {{ $inscricao->desconto }}</li>
                    <li>Total: R$ {{ $inscricao->total }}</li>
                    <!-- Adicione outras informações da inscrição aqui -->
                </ul>
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
            "order": [[0, "desc"]] 
        });
    });

</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection