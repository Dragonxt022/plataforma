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
                                    <th>Tipo</th>
                                    <th>ID/Inscrição</th>
                                    <th>Nome/ Orgão</th>
                                    <th>Nome/ Cidade / E-mail</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inscricoes as $inscricao)
                                <tr>
                                    <td>Inscrição</td>
                                    <td>{{ $inscricao->id }}</td>
                                    <td>{{ $inscricao->nome_juridico }}</td>
                                    <td>{{ $inscricao->cidade }}</td>
                                </tr>
                                @endforeach
                        
                                @foreach($participantes as $participante)
                                <tr>
                                    <td>Participante</td>
                                    <td>{{ $participante->id }}</td>
                                    <td>{{ $participante->nome }}</td>
                                    <td>{{ $participante->email }}</td>
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