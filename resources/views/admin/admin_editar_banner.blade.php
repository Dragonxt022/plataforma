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
            <h4 class="card-title">Banners</h4>
            <p class="text-muted mb-3">Editar Banner de destaque na pagina Inicial do site.</p>

            <div class="row">
                <div class="col">
                    

                    <form method="POST" action="{{ route('admin.categorias.update', ['banners' => $banners->id]) }}" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        {{-- Linha com coluna 1 --}}
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="titulo" class="form-label">Titulo:</label>
    
                                            <input class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" value="{{ $banners->titulo }}">
    
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
    
                                            <input class="form-control @error('subtitulo') is-invalid @enderror" name="subtitulo" id="subtitulo" value="{{ $banners->subtitulo }}">
    
                                            @error('subtitulo')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="paragrafo" class="form-label">Paragrafo:</label>
                                            
                                            <textarea class="form-control @error('paragrafo') is-invalid @enderror"  name="paragrafo" id="paragrafo" cols="10" rows="5" value="{{ $banners->paragrafo }}"></textarea>
    
                                            @error('paragrafo')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <!-- Adicionar input de arquivo invisível em cima da imagem -->
                                            <input type="file" id="img_banner" name="img_banner" style="display: none;" accept="image/jpeg,image/png">
                                            <!-- Imagem clicável -->
                                            <label for="img_banner">
                                                <img id="showImage" src="{{ url('upload/empresas_images/semimagem.png') }}" alt="Banner" style="border: solid 1px cornflowerblue; cursor: pointer;" class="img-fluid @error('img_banner') is-invalid @enderror">

                                                @error('img_banner')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col d-grid gap-2 pb-2">
                                        <button type="button" class="btn btn-warning mt-2 " onclick="document.getElementById('img_banner').click()">Adicionar Imagem</button>        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="link_botao" class="form-label">Apontar para Link:</label>
    
                                            <input class="form-control @error('link_botao') is-invalid @enderror" name="link_botao" id="link_botao" value="{{ $banners->link_botao }}">
    
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
                                        <button type="submit" class="btn btn-primary btn-block">Adicionar</button>
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