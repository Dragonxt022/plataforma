@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista de cursos/Treinamentos</h4>
            <p class="text-muted mb-3">Esta pagina contem a lista de cursos cadastrados, tendo a posibilidade de estar atualizar e vendo os status dos Curso ou Treinamento.</p>
            <div class="table-responsive pt-3">
              <table id="dataTabelatreinamento" class="table table-dark display responsive" style="width:100%">

                <thead>
                  <tr>
                    <th class="text-center">ID</th>
                    <th>  </th>
                    <th>Curso/Treinamento</th>
                    <th>Vagas</th>
                    <th class="text-center">Inicio</th>
                    <th>Empresa</th>
                    <th class="text-center">Status</th>
                    <th class="text-center"> Ação </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($treinamentos as $treinamento)
                  <tr>
                    <td class="text-center align-middle {{ $treinamento->data_inicio_class }}">{{ $treinamento->id }}</td>
                    <td class="text-center">
                      <img src="{{ $treinamento->banner ? asset('upload/cursos_images/' . $treinamento->banner) : asset('upload/cursos_images/semimagembanner.png') }}">


                     </td>
                    <td class="align-middle {{ $treinamento->data_inicio_class }}" title="{{ $treinamento->title }}">{{ $treinamento->nome }}</td>
                    <td class="text-center align-middle {{ $treinamento->data_inicio_class }}">{{ $treinamento->vagas }}</td>
                    <td class="text-center align-middle {{ $treinamento->data_inicio_class }}">{{ $treinamento->data_inicio }}</td>
                    <td class="align-middle {{ $treinamento->data_inicio_class }}" >{{ $treinamento->empresa->nome }}</td>

                    <td class=" text-center align-middle {{ $treinamento->data_inicio_class }}">
                     {{ $treinamento->status }}
                    </td>
                    <td class="d-flex">
                        <button type="button" class="btn btn-primary btn-xs btn-icon mx-2">
                            <a href="{{ route('admin.treinamentos.edit', ['treinamento' => $treinamento->id]) }}">
                                <i data-feather="edit" style="color: #ffffff;"></i>
                            </a>
                        </button>
                        
                        <button type="button" class="btn btn-danger btn-xs btn-icon"  data-toggle="modal" data-target="#confirmDelete{{ $treinamento->id }}">
                          <i data-feather="trash-2"></i>
                        </button>
                  </td>
                  
                  {{-- <!-- Modal de Confirmação de Exclusão --> --}}
                  <div class="modal fade" id="confirmDelete{{ $treinamento->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                Tem certeza que deseja excluir este treinamento? {{ $treinamento->nome }}
                            
                                <p class="text-danger"><br> ATENÇÃO!!!<br> Isso apagará também todas as fichas de inscrições associadas a este curso, ou seja, todas as inscrições realizadas neste curso serão excluídas sem nenhuma possibilidade de recuperação.</p>
                            </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  <form method="POST" action="{{ route('admin.treinamentos.destroy', $treinamento) }}">
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

    </div>
</div>

<script>
  $(document).ready(function() {
        $('#dataTabelatreinamento').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json"
            },
            "order": [[3, "desc"]]
        });
    });
</script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection