@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      
        <div class="col-md-8 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title py-4">Cadastrar Empressa</h6>

                        <form method="POST" action="{{ route('admin.empresas.store') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            {{-- Linha 1 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome da Empresa:</label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" id="nome" value="{{ old('nome') }}">
                                        @error('nome')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="cnpj" class="form-label">CNPJ:</label>
                                        <input type="text" class="form-control @error('cnpj') is-invalid @enderror"  name="cnpj" id="cnpj" value="{{ old('cnpj') }}">
                                        @error('cnpj')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="endereco" class="form-label">Endereço:</label>
                                        <input type="text" class="form-control @error('endereco') is-invalid @enderror"  name="endereco" id="endereco" value="{{ old('endereco') }}">
                                        @error('endereco')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Linha 2 --}}
                            <div class="row">
                                
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="numero" class="form-label">Número:</label>
                                        <input type="number" class="form-control @error('numero') is-invalid @enderror"  name="numero" id="numero" value="{{ old('numero') }}">
                                        @error('numero')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="bairro" class="form-label">Bairro:</label>
                                        <input type="text" class="form-control @error('bairro') is-invalid @enderror"  name="bairro" id="bairro" value="{{ old('bairro') }}">
                                        @error('bairro')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="cep" class="form-label">CEP:</label>
                                        <input type="text" class="form-control @error('cep') is-invalid @enderror"  name="cep" id="cep" value="{{ old('cep') }}">
                                        @error('cep')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Linha --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="banco" class="form-label">Nome do Banco:</label>
                                        <input type="text" class="form-control @error('banco') is-invalid @enderror"  name="banco" id="banco" value="{{ old('banco') }}">
                                        @error('banco')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="conta" class="form-label">Agência/Conta/PIX:</label>
                                        <input type="text" class="form-control @error('conta') is-invalid @enderror"  name="conta" id="conta" value="{{ old('conta') }}">
                                        @error('conta')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="beneficiario" class="form-label">Beneficiario:</label>
                                        <input type="text" class="form-control @error('beneficiario') is-invalid @enderror"  name="beneficiario" id="beneficiario" value="{{ old('beneficiario') }}">
                                        @error('beneficiario')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- linha --}}
                            <div class="row pt-5">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="cabecalho">Imagem Cabeçalho</label>
                                        <input class="form-control @error('cabecalho') is-invalid @enderror" name="cabecalho" type="file" id="cabecalho" accept="image/jpeg,image/png">
                                        @error('cabecalho')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="rodape">Imagem Rodapé</label>
                                        <input class="form-control @error('rodape') is-invalid @enderror" name="rodape" type="file" id="rodape" accept="image/jpeg,image/png">
                                        @error('rodape')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row pb-5">
                                <div class="col">
                                    <img id="cabecalhoPreview" class="img-fluid">
                                </div>
                                <div class="col">
                                    <img id="rodapePreview" class="img-fluid">
                                </div>
                            </div>
                            {{-- Linha 5 --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-xs btn-primary">Cadastrar Empresa</button>
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

<script class="text/javascript">
    $(document).ready(function() {
      $('#cabecalho').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#cabecalhoPreview').attr('src', e.target.result);
        };
        reader.readAsDataURL(e.target.files[0]);
      });
    
      $('#rodape').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#rodapePreview').attr('src', e.target.result);
        };
        reader.readAsDataURL(e.target.files[0]);
      });
    });

    // Selecione o campo CNPJ
    var cnpjInput = document.getElementById('cnpj');

    // Aplique a máscara usando Inputmask
    Inputmask("99.999.999/9999-99").mask(cnpjInput);
    </script>



@endsection