@extends('admin.admin_dashboard')  
@section('admin')
    
<div class="page-content">
    @php
                
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);

    @endphp

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Olá, {{$profileData->name}}</h4>
    </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
            <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
            <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
            </div>
            <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="printer"></i>
            Imprimir
            </button>
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
            Baixar Relatório
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Participantes diários (Mês)</h6>
                    
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-12 col-xl-5">
                            <h3 class="mb-2">{{ $participantesMesAtual['quantidadeParticipantesAtual'] }}</h3>
                            <div class="d-flex align-items-baseline">
                                <p class="{{ $participantesMesAtual['diferencaParticipantes'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    <span>{{ $participantesMesAtual['diferencaParticipantes'] >= 0 ? '+' : '' }}{{ $participantesMesAtual['diferencaParticipantes'] }} Mês Anterior</span>
                                    <i data-feather="{{ $participantesMesAtual['diferencaParticipantes'] >= 0 ? 'arrow-up' : 'arrow-down' }}" class="icon-sm mb-1"></i>
                                </p>
                            </div>
                        </div>
                    <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-8 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Inscrições diárias (Mês)</h6>
                    </div>
                    <div class="row">
                    <div class="col-6 col-md-12 col-xl-4">
                        <div class="col-6 col-md-12 col-xl-6">
                            <h3 class="mb-2">{{ number_format($dadosGanhosMensais['totalMesAtual'], 2, ',', '.') }}</h3>
                            <div class="d-flex align-items-baseline">
                                @if (strpos($dadosGanhosMensais['diferencaFormatada'], '-') !== false)
                                    <p class="text-danger">
                                        <span>{{ $dadosGanhosMensais['diferencaFormatada'] }}</span>
                                        <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                    </p>
                                @else
                                    <p class="text-success">
                                        <span>{{ $dadosGanhosMensais['diferencaFormatada'] }}</span>
                                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                    </p>
                                @endif
                            </div>
                        </div>                        
                        
                    </div>
                    <div class="col-8 col-md-12 col-xl-7">
                        <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-lg-6 col-xl-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Relátorio (Ano)</h6>
                    {{-- <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Visualizar</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Imprimir</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Baixar</span></a>
                        </div>
                    </div> --}}
                    </div>
                    <p class="text-muted">Realatório detalhado referente ao desempenho, informações obitidas do banco de dados de acordo com suas inscrições. Sómente informações com status de canselado não será contabilizada.</p>
                    <div id="monthlySalesChart"></div>
                </div> 
            </div>
        </div>
        <div class="col-lg-6 col-xl-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Desenpenho (Ano)</h6>
                    </div>
                    <div id="apexDonut"></div>
                    
                    <p class="text-muted text-center"><span class="text-warning">Processando</span> , <span class="text-success">Concluido</span>, <span class="text-danger">Cancelados</span>, <span class="text-primary">Descontos</span>.</p>
                    <p class="text-muted"><br>Tenha um relátorio completo anual do desempenho de suas inscrições.</p>
                </div>
            </div>
        </div>
        
    </div> <!-- row -->

    <div class="row">
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0 py-4">Últimas inscrições</h6>
                {{-- <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Visualizar</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Editar</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Excluir</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Imprimir</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Baixar</span></a>
                    </div>
                </div> --}}
                </div>
                <div class="d-flex flex-column">
                    @foreach($ultimasInscricoes as $inscricao)
                        <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3">
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center"> <!-- Adicione esta div para envolver o ícone e o texto -->
                                        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift icon-sm text-white"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                                        </div>
                                        <div> <!-- Adicione esta div para envolver o texto -->
                                            <h6 class="text-body mb-2">{{ $inscricao->nome_juridico }}</h6>
                                            <p class="text-muted tx-12">{{ $inscricao->created_at->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                    <p class="text-muted tx-13">{{ $inscricao->quantidade_inscritos }} Inscritos </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                
                
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Desenpenho do Curso</h6>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <p class="text-muted"> Visualize a quantidade de inscritos por curso até o momento.</p>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive  py-4">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="pt-0">ID</th>
                                <th class="pt-0"> </th>
                                <th class="pt-0">Nome</th>
                                <th class="pt-0">Status</th>
                                <th class="pt-0">Qt</th>
                                <th class="pt-0">Total</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estatisticasTreinamentos as $estatistica)
                            <tr>
                                <td>{{ $estatistica['id'] }}</td>
                                
                                <td><img src="{{ $estatistica['imagem'] }}" alt="Imagem do Curso" style="max-width: 100px;"></td>
                                
                                <td title="{{ $estatistica['nome'] }}">{{ Str::limit($estatistica['nome'], 30) }}</td>
                                <td>
                                    @if(\Carbon\Carbon::parse($estatistica['data_inicio'])->isPast())
                                        <span class="badge bg-secondary">Encerrado</span>
                                    @else
                                        <span class="badge bg-warning">Andamento</span>
                                    @endif
                                </td>
                                <td>{{ $estatistica['quantidade_inscritos'] }}</td>
                                <td>R$ {{ number_format($estatistica['valor_total_vendido'], 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                
            </div> 
        </div>
    </div>
    </div> <!-- row -->
</div>

<script>
    var options = {
  // Definições do gráfico
    };

    $.ajax({
    url: "{{ route('vendas-por-mes') }}",
    type: "GET",
    success: function(response) {
        // Atualizar os dados do gráfico com os dados recebidos da resposta
        options.series[0].data = response.valores;
        options.xaxis.categories = response.labels;

        // Renderizar o gráfico com os novos dados
        var apexBarChart = new ApexCharts(document.querySelector("#monthlySalesChart"), options);
        apexBarChart.render();
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
    });

</script>

@endsection