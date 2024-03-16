@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
                
            <h4 class="card-title">Discontos</h4>
            <p class="text-muted mb-3">Controle de descontos automaticos das inscrições.</p>

            <div class="row">
                <div class="col">
                    
                    <form action="{{ route('admin.configuracao.desconto.update', $descontos->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                        <div class="form-group p-2">
                            <label for="valor_1">Valor 1:</label>
                            <input type="number" class="form-control @error('valor_1') is-invalid @enderror" name="valor_1" id="valor_1" value="{{ $descontos->valor_1 }}">

                            @error('valor_1')
                                <span class="text-danger pt-2">{{ $message }}</span>
                            @enderror

                        </div>
                    
                        <div class="form-group p-2">
                            <label for="valor_2">Valor 2:</label>
                            <input type="number" class="form-control @error('valor_2') is-invalid @enderror" name="valor_2" id="valor_2" value="{{ $descontos->valor_2 }}">

                            @error('valor_2')
                                <span class="text-danger pt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <div class="form-group p-2">
                            <label for="valor_3">Valor 3:</label>
                            <input type="number" class="form-control @error('valor_3') is-invalid @enderror" name="valor_3" id="valor_3" value="{{ $descontos->valor_3 }}">

                            @error('valor_3')
                                <span class="text-danger pt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <div class="form-group p-2">
                            <label for="valor_4">Valor 4:</label>
                            <input type="number" class="form-control @error('valor_4') is-invalid @enderror" name="valor_4" id="valor_4" value="{{ $descontos->valor_4 }}">

                            @error('valor_4')
                                <span class="text-danger pt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <div class="form-group p-2">
                            <label for="valor_5">Valor 5:</label>
                            <input type="number" class="form-control @error('valor_5') is-invalid @enderror" name="valor_5" id="valor_5" value="{{ $descontos->valor_5 }}">

                            @error('valor_5')
                                <span class="text-danger pt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <div class="form-group p-2">
                            <label for="mais_de_5">Mais de 5:</label>
                            <input type="number" class="form-control @error('mais_de_5') is-invalid @enderror" name="mais_de_5" id="mais_de_5" value="{{ $descontos->mais_de_5 }}">

                            @error('mais_de_5')
                                <span class="text-danger pt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col p-2">
                            <div class="row">
                                <div class="col d-grid gap-2">
                                    <button type="submit" class="btn btn-xs btn-primary btn-block">Atualizar</button>
                                </div>
                            </div>
                        </div> 
                        
                    </form>
                    

                </div>
                
            </div>
            
          </div>
        </div>
      </div>

    </div>
</div>



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection