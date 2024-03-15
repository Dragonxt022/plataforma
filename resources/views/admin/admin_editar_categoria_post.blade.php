@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <h4 class="card-title">Categorias</h4>
            <p class="text-muted mb-3">Edite o nome de sua categoria de poste.</p>

            <div class="row">
                <div class="col">

                    <form method="POST" action="{{ route('admin.categorias.post.update', ['categoria' => $categoria->id]) }}">
                        @csrf
                        @method('PUT')
                        {{-- Linha com coluna 1 --}}
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="nome" class="form-label">Nome da Categoria:</label>
    
                                            <input class="form-control @error('nome') is-invalid @enderror" name="nome" id="nome" value="{{ $categoria->nome }}">
    
                                            @error('nome')
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
                                        <button type="submit" class="btn btn-xs btn-primary btn-block">Atualizar</button>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col py-3">
                                <p>Pode estar renomeando a categoria selecionada.</p>
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