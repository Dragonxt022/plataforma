@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      
        <div class="col-md-8 col-xl-12  middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body p-2">
                        <h6 class="card-title py-4">Atualizar ficha de inscrição</h6>

                        <form method="POST" action="{{ route('admin.inscricoes.update', ['inscricao' => $inscricao->id]) }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Sublinha Linha  --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="nome_juridico" class="form-label">Jurídico/Entidade:</label>

                                        <input class="form-control @error('nome_juridico') is-invalid @enderror" name="nome_juridico" id="nome_juridico" value="{{ $inscricao->nome_juridico }}">

                                        @error('nome_juridico')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="cnpj" class="form-label">CNPJ:</label>
                                        
                                        <input type="text" class="form-control @error('cnpj') is-invalid @enderror"  name="cnpj" id="cnpj" value="{{ $inscricao->cnpj }}">
                            
                                        @error('cnpj')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="cep" class="form-label">CEP:</label>
                                        <input type="text" class="form-control @error('cep') is-invalid @enderror"  name="cep" id="cep" value="{{ $inscricao->cep }}">
                                        @error('cep')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            {{-- Sublinha Linha  --}}
                            <div class="row">
                                
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="cidade" class="form-label">Cidade:</label>
                                        <input type="text" class="form-control @error('cidade') is-invalid @enderror"  name="cidade" id="cidade" value="{{ $inscricao->cidade }}">
                                        @error('cidade')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="bairro" class="form-label">Bairro:</label>
                                        <input type="text" class="form-control @error('bairro') is-invalid @enderror"  name="bairro" id="bairro" value="{{ $inscricao->bairro }}">
                                        @error('bairro')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="rua" class="form-label">Rua:</label>
                                        <input type="text" class="form-control @error('rua') is-invalid @enderror"  name="rua" id="rua" value="{{ $inscricao->rua }}">
                                        @error('rua')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Sublinha Linha --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="numero" class="form-label">Número:</label>
                                        <input type="number" class="form-control @error('numero') is-invalid @enderror"  name="numero" id="numero" value="{{ $inscricao->numero }}">
                                        @error('numero')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail Responsavel:</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"  name="email" id="email" value="{{ $inscricao->email }}">
                                        @error('email')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="telefone" class="form-label">Telefone Responsavel:</label>
                                        <input type="text" class="form-control @error('telefone') is-invalid @enderror"  name="telefone" id="telefone" value="{{ $inscricao->telefone }}">
                                        @error('telefone')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- sublinha linha --}}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <a href="#" class="btn btn-xs btn-primary">Atualizar</a>
                                    <a href="#" class="btn  btn-xs btn-danger">Baixar PDF</a>
                                    <a href="#" class="btn  btn-xs btn-primary">Imprimir</a>
                                    <a href="#" class="btn  btn-xs btn-warning">Enviar por E-mail</a>     
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