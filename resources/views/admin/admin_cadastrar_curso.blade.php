@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      
        <div class="col-md-8 col-xl-12  middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body p-2">
                        <h6 class="card-title py-4">Cadastrar Curso/Treinamento</h6>

                        <form method="POST" action="{{ route('admin.treinamentos.store') }}" class="forms-sample d-flex flex-row flex-wrap justify-content-around" enctype="multipart/form-data">
                            @csrf
                            {{-- Linha com coluna 1 --}}
                            <div class="row" style="width: 78%;">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome do curso:</label>
        
                                                <input class="form-control @error('nome') is-invalid @enderror" name="nome" id="nome" value="{{ old('nome') }}">
        
                                                @error('nome')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="descricao" class="form-label">Descrição:</label>
                                                
                                                <textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" id="editor" value="{{ old('descricao') }}"></textarea>
        
                                                @error('descricao')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Linha 2 --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="data_inicio" class="form-label">Data de Início:</label>
                                                <input type="date" class="form-control @error('data_inicio') is-invalid @enderror"  name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}">
                                                @error('data_inicio')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="data_termino" class="form-label">Data de Término:</label>
                                                <input type="date" class="form-control @error('data_termino') is-invalid @enderror"  name="data_termino" id="data_termino" value="{{ old('data_termino') }}">
                                                @error('data_termino')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="valor" class="form-label">Valor R$:</label>
                                                <input type="number" class="form-control @error('valor') is-invalid @enderror"  name="valor" id="valor" value="{{ old('valor') }}">
                                                @error('valor')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="vagas" class="form-label">Vagas:</label>
                                                <input type="number" class="form-control @error('vagas') is-invalid @enderror"  name="vagas" id="vagas" value="{{ old('vagas') }}">
                                                @error('vagas')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Linha 4 --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="local" class="form-label">Local:</label>
                                                <input type="text" class="form-control @error('local') is-invalid @enderror"  name="local" id="local" value="{{ old('local') }}">
                                                @error('local')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="folder" class="form-label">Arquivo (ex. PDF, Word):</label>
        
                                                <input type="file" class="form-control @error('folder') is-invalid @enderror" name="folder" id="folder" value="{{ old('folder') }}">
        
                                                @error('folder')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                     {{-- Linha 6 --}}
                                     <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="id_empresa" class="form-label">Empresa:</label>
                                                <select class="form-select @error('id_empresa') is-invalid @enderror" name="id_empresa" id="id_empresa">
                                                    <option value="">Selecione uma empresa</option>
                                                    @foreach($empresas as $id => $nome)
                                                        <option value="{{ $id }}" {{ old('id_empresa') == $id ? 'selected' : '' }}>{{ $nome }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_empresa')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="docente" class="form-label">Professor(a):</label>
                                                <input type="text" class="form-control @error('docente') is-invalid @enderror"  name="docente" id="docente" value="{{ old('docente') }}">
                                                @error('docente')
                                                    <span class="text-danger pt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                        </div> 
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="col">
                                        <!-- Adicionar input de arquivo invisível em cima da imagem -->
                                        <input type="file" id="banner" name="banner" style="display: none;" accept="image/jpeg,image/png">
                                        <!-- Imagem clicável -->
                                        <label for="banner">
                                            <img id="showImage" src="{{ url('upload/cursos_images/semimagembanner.png') }}" alt="profile" style="max-width: 215px; border: solid 1px cornflowerblue; cursor: pointer;" class="@error('banner') is-invalid @enderror">

                                            @error('banner')
                                                <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col d-grid gap-2 pb-2">
                                            <button type="button" class="btn btn-xs btn-warning mt-2 " onclick="document.getElementById('banner').click()">Adicionar Imagem</button>        
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col d-grid gap-2">
                                            <button type="submit" class="btn btn-xs btn-primary btn-block">Cadastrar</button>
                                        </div>
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

<script src="{{ asset('backend/assets/vendors/inputmask/inputmask.min.js') }}"></script>

<script src="{{ asset('backend/assets/vendors/tinymce/tinymce.min.js') }}"></script>

{{-- customização --}}
<script src="{{ asset('backend/assets/js/tinymce.js') }}"></script>

<script class="text/javascript">
    $(document).ready(function() {
        $('#banner').change(function(e) {
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





@endsection