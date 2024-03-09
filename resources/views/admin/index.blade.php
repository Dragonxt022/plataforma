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
                    <h6 class="card-title mb-0">NOVOS CLIENTES</h6>
                    
                    </div>
                    <div class="row">
                    <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">3,897</h3>
                        <div class="d-flex align-items-baseline">
                        <p class="text-success">
                            <span>+3.3%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
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
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">NOVOS PEDIDOS</h6>
                    </div>
                    <div class="row">
                    <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">35,084</h3>
                        <div class="d-flex align-items-baseline">
                        <p class="text-danger">
                            <span>-2.8%</span>
                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                        </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-7">
                        <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">CRECIMENTO</h6>
                    </div>
                    <div class="row">
                    <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">89.87%</h3>
                        <div class="d-flex align-items-baseline">
                        <p class="text-success">
                            <span>+2.8%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                        </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-7">
                        <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Relátorio Anual</h6>
                    <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Visualizar</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Imprimir</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Baixar</span></a>
                        </div>
                    </div>
                    </div>
                    <p class="text-muted">Realatório detalhado referente ao desempenho, informações obitidas do banco de dados de acordo com suas inscrições. Sómente informações com status de canselado não será contabilizada.</p>
                    <div id="monthlySalesChart"></div>
                </div> 
            </div>
        </div>
        
    </div> <!-- row -->

    <div class="row">
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Caixa de Mensagens</h6>
                <div class="dropdown mb-2">
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
                </div>
                </div>
                <div class="d-flex flex-column">
                <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3">
                    <div class="me-3">
                    <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                    </div>
                    <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body mb-2">Leonardo Payne</h6>
                        <p class="text-muted tx-12">12.30 PM</p>
                    </div>
                    <p class="text-muted tx-13">Hey! there I'm available...</p>
                    </div>
                </a>
                <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                    <div class="me-3">
                    <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                    </div>
                    <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body mb-2">Carl Henson</h6>
                        <p class="text-muted tx-12">02.14 AM</p>
                    </div>
                    <p class="text-muted tx-13">I've finished it! See you so..</p>
                    </div>
                </a>
                <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                    <div class="me-3">
                    <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                    </div>
                    <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body mb-2">Jensen Combs</h6>
                        <p class="text-muted tx-12">08.22 PM</p>
                    </div>
                    <p class="text-muted tx-13">This template is awesome!</p>
                    </div>
                </a>
                <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                    <div class="me-3">
                    <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                    </div>
                    <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body mb-2">Amiah Burton</h6>
                        <p class="text-muted tx-12">05.49 AM</p>
                    </div>
                    <p class="text-muted tx-13">Nice to meet you</p>
                    </div>
                </a>
                <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                    <div class="me-3">
                    <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                    </div>
                    <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body mb-2">Yaretzi Mayo</h6>
                        <p class="text-muted tx-12">01.19 AM</p>
                    </div>
                    <p class="text-muted tx-13">Hey! there I'm available...</p>
                    </div>
                </a>
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
                            <h6 class="card-title mb-0">Informações de desempenho</h6>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <p class="text-muted"> Visualize o status do seu curso a quantidade de inscrito e o valor previsto.</p>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive  py-4">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th class="pt-0">ID</th>
                            <th class="pt-0"> </th>
                            <th class="pt-0">Nome do curso</th>
                            <th class="pt-0">Data de inicio</th>
                            <th class="pt-0">Status</th>
                            <th class="pt-0">Qt</th>
                            <th class="pt-0">Valor total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>img</td>
                            <td>Treinamento de Saneamento basico e suas</td>
                            <td>09/11/2024</td>
                            <td><span class="badge bg-warning">Andamento</span></td>
                            <td>62</td>
                            <td>R$ 50.00,00</td>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
    </div> <!-- row -->
</div>

@endsection