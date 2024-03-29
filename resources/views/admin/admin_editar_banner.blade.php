@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            <h4 class="card-title">Banner</h4>
            <p class="text-muted mb-3">Editar Banner de destaque na pagina Inicial do site.</p>

            <div class="row">
                <div class="col">
                    

                    <form method="POST" action="{{ route('admin.banners.update', ['banner' => $banner->id]) }}" class="forms-sample" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        {{-- Linha com coluna 1 --}}
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="titulo" class="form-label">Titulo:</label>
    
                                            <input class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" value="{{ $banner->titulo }}">
    
                                            @error('titulo')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="subtitulo" class="form-label">Subtitulo:</label>
    
                                            <input class="form-control @error('subtitulo') is-invalid @enderror" name="subtitulo" id="subtitulo" value="{{ $banner->subtitulo }}">
    
                                            @error('subtitulo')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="paragrafo" class="form-label">Parágrafo:</label>
                                            <textarea class="form-control @error('paragrafo') is-invalid @enderror" name="paragrafo" id="paragrafo" cols="10" rows="5">{{ $banner->paragrafo }}</textarea>
                                            @error('paragrafo')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <!-- Adicionar input de arquivo invisível em cima da imagem -->
                                            <input type="file" id="img_banner" name="img_banner" style="display: none;" accept="image/jpeg,image/png">
                                            <!-- Imagem clicável -->
                                            <label for="img_banner">
                                                <img id="showImage" src="{{ $banner->img_banner ? asset('upload/admin_banner/' . $banner->img_banner) : asset('upload/empresas_images/semimagem.png') }}" alt="Banner" style="border: solid 1px cornflowerblue; cursor: pointer;" class="img-fluid @error('img_banner') is-invalid @enderror">
                                            </label>
                                            <!-- Mensagem de erro, se houver -->
                                            @error('img_banner')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col d-grid gap-2 pb-2">
                                        <button type="button" class="btn btn-xs btn-warning mt-2 " onclick="document.getElementById('img_banner').click()">Adicionar Imagem</button>        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="link_botao" class="form-label">Apontar para Link:</label>
    
                                            <input class="form-control @error('link_botao') is-invalid @enderror" name="link_botao" id="link_botao" value="{{ $banner->link_botao }}">
    
                                            @error('link_botao')
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
                                <p>Atualize, edite seu banner.</p>
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


<script>
  $(document).ready(function() {
        $('#dataTabelatreinamento').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json"
            }
        });
    });

    $(document).ready(function() {
        $('#img_banner').change(function(e) {
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection