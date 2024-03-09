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
            <p class="text-muted mb-3">Lista contendo os Banner que ficara em destaque na pagina Inicial do site.</p>

            <div class="row">
                <div class="col-4">
                    

                    <form method="POST" action="{{ route('admin.banners.store') }}" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        {{-- Linha com coluna 1 --}}
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="titulo" class="form-label">Titulo:</label>
    
                                            <input class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" value="{{ old('titulo') }}">
    
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
    
                                            <input class="form-control @error('subtitulo') is-invalid @enderror" name="subtitulo" id="subtitulo" value="{{ old('subtitulo') }}">
    
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
                                            
                                            <textarea class="form-control @error('paragrafo') is-invalid @enderror"  name="paragrafo" id="paragrafo" cols="10" rows="5" value="{{ old('paragrafo') }}"></textarea>
    
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
    
                                            <input class="form-control @error('link_botao') is-invalid @enderror" name="link_botao" id="link_botao" value="{{ old('link_botao') }}">
    
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
                                <p>Adicione ou edite seus banners.</p>
                            </div>
                        </div>
                        
                    </form> 

                </div>

                <div class="col-8">

                    <div class="table-responsive pt-3">
                        <table id="dataTabelatreinamento" class="table table-dark display responsive" style="width:100%">
                          <thead>
                              <tr>
                                  <th class="text-center">ID</th>
                                  <th class="text-center"> </th>
                                  <th>Titulo</th>
                                  <th>Link</th>
                                  <th class="text-center"> Ação </th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($banners as $banner)
                              <tr>
                                  <td class="text-center align-middle">{{ $banner->id }}</td>

                                  <td class="text-center align-middle">

                                    <img src="{{ $banner->img_banner ? asset('upload/admin_banner/' . $banner->img_banner) : asset('upload/semimagemBanner.jpg') }}" alt="banner" class="wd-55 rounded-circle">

                                  </td>

                                  <td class="align-middle">{{ $banner->titulo }}</td>
                                
                                  <td class="align-middle"><a href="{{ $banner->link_botao }}" target="_blank">{{ $banner->link_botao }}</a></td>


                                  <td class="text-center align-middle">
                                      <button type="button" class="btn btn-primary btn-xs btn-icon mx-2">
                                          <a href="{{ route('admin.banners.edit', ['banner' => $banner->id]) }}">
                                              <i data-feather="edit" style="color: #ffffff;"></i>
                                          </a>
                                      </button>
                      
                                      <button type="button" class="btn btn-danger btn-xs btn-icon" data-toggle="modal"
                                          data-target="#confirmDelete{{ $banner->id }}" @if ($banner->id <= 3) disabled @endif>
                                          <i data-feather="trash-2"></i>
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
@foreach ($banners as $banner)
<div class="modal fade" id="confirmDelete{{ $banner->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir este Banner? {{ $banner->titulo }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
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