@extends('site.templete')

@section('title', 'Formulário')

@section('content')

    {{-- css personalizado da pagina --}}
    <style class="css/text">
        .textoColuna{
            color: #2b2b2b
        }

        .aviso{
            color: rgb(172, 2, 2)
        }
        .resumo{
            background: ivory;
        }
        .btn{
            cursor: pointer;
            background: blue;
            color: #fff;

        }
        label{
            color: #242452
        }

    </style>

    <div class="page">
        {{-- Cabeçalho --}}
        <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap" style="background-image: url({{ asset('site/assets/images/noticias.png')}}">
            <div class="container">
            <div class="page-title">
                <h3> Ficha de Inscrição</h3>
            </div>
            </div>
        </section>
        {{-- Mostruario de treinamentos --}}
        <section class="section-50 section-md-75 section-lg-100">

            {{-- inicio do formulario  --}}
            <form action="{{ route('site.insere.formulario') }}" method="POST">
                @csrf
                <div class="container">
                    {{-- Linha --}}
                    <div class="row row-40">
                        {{-- Coluna FORMULARIO DA EMPRESA--}}
                        <div class="col-md-6 col-lg-8 height-fill card">
                            <div>
                                <h4 class="p-3">Informações Jurídico/Empresa<h4>
                            </div>
                            <div class="card-body bg-light">
                            
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="cnpj">CNPJ:</label>
                                        <input type="text" class="form-control" name="cnpj" id="cnpj" value="023545687988" required="">
                                        <span id="cnpj-validation-message"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="nome_juridico">Jurídico/Empresa:</label>
                                        <input type="text" class="form-control" name="nome_juridico" id="nome_juridico" value="Camara de São Francisco" required="">
                                    </div>

                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="cep">CEP:</label>
                                        <input type="text" class="form-control" name="cep" id="cep" value="76864-000" required="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="cidade">Cidade:</label>
                                        <input type="text" class="form-control" name="cidade" id="cidade" value="São francisco" required="">
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="bairro">Bairro:</label>
                                        <input type="text" class="form-control" name="bairro" id="bairro"  value="Centro" required="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="rua">Endereço:</label>
                                        <input type="text" class="form-control" name="rua" id="rua" value="Rua teixeiropolis" required="">
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="numero">Número:</label>
                                        <input type="number" class="form-control" name="numero" id="numero" value="2658" required="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="responsavel">Responsável pelo empenho:</label>
                                        <input type="text" class="form-control" name="responsavel" id="responsavel" value="Rosivaldo Cristiano neves" required="">
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="telefone">Telefone:</label>
                                        <input type="text" class="form-control" name="telefone" id="telefone" value="69984791753" required="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">E-mail:</label>
                                        <input type="email" class="form-control" name="email" id="email" value="contato@saofrancisco.com.br" required="">
                                    </div>

                                </div>
                                <div class="form-row py-4">

                                    <div class="form-group col-md-12">
                                        <label for="acessibilidade"><span class="text-danger">Possui algum participante que necessita de acessibilidade?</span></label>
                                        <input type="text" class="form-control" name="acessibilidade" id="acessibilidade" placeholder="Descreva as necessidades de acessibilidade, se houver">
                                    </div>
                                    

                                </div>
                            </div>
                            
                        </div>
                        
                        {{-- Coluna RESUMO--}}
                        <div class="col-md-6 col-lg-4 coluna2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <p class="py-3">Resumo da Inscrição</p>
                                        <div class="row">
                                            <div class="col-md-4">
                                              <!-- Div para a miniatura da imagem -->
                                              <div class=" overflow-hidden" style="width: 100px; height: 100px;">
                                                <img src="{{ asset('upload/cursos_images/' . session('dados')['banner']) }}" alt="Imagem">
                                              </div>
                                            </div>
                                            <div class="col-md-8">
                                              <!-- Div para o texto -->
                                              <div class="form-group">
                                                <p><span class="font-weight-bold textoColuna">{{ session('dados')['nome'] }} x {{ session('dados')['quantidade_inscritos'] }}</span></p>
                                              </div>
                                            </div>
                                          </div>
                                          
                                          
                                        <hr>
                                        <div class="card p-3 resumo">
                                            <p>Resumo do Orçamento</p>
                                            <h6 class="text-dark"><i class="bi bi-cash"></i> Subtotal: R$ {{ number_format(session('dados')['subtotal'], 2, ',', '.') }}</h6>
                                            <h6 class="text-danger"><i class="bi bi-currency-dollar"></i> Desconto: R$ {{ number_format(session('dados')['desconto'], 2, ',', '.') }}</h6>
                                            <h6 class="text-success"><i class="bi bi-cash-coin"></i> Total: R$ {{ number_format(session('dados')['total'], 2, ',', '.') }}</h6>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="m-2 py-3 aviso">
                                            <p><i class="bi bi-info-circle-fill"></i> Por favor, lembre-se de que qualquer cancelamento ou inclusão de participantes adicionais deve ser comunicado com pelo menos 2 dias de antecedência.</p>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-block">Confirmar inscrição</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    {{-- PARTICIPANTES --}}
                    <div class="row py-3 card p-4">
                        <div>
                            <h4>Informações dos participantes</h4>
                        </div>
                    
                        <div id="participantes">
                            <!-- Os campos de participantes serão gerados dinamicamente aqui -->
                        </div>
                    </div>

                    {{-- OUTRAS INFORMAÇÕES --}}
                    <input type="hidden" name="id_treinamento" value="{{ session('dados')['id'] }}">
                    <input type="hidden" name="nome" value="{{ session('dados')['nome'] }}">
                    <input type="hidden" name="data_inicio" value="{{ session('dados')['data_inicio'] }}">
                    <input type="hidden" name="data_termino" value="{{ session('dados')['data_termino'] }}">

                    <input type="hidden" name="local" value="{{ session('dados')['local'] }}">
                    <input type="hidden" name="id_empresa" value="{{ session('dados')['id_empresa'] }}">
                    <input type="hidden" name="banner" value="{{ session('dados')['banner'] }}">
                    <input type="hidden" name="docente" value="{{ session('dados')['docente'] }}">
                    <input type="hidden" name="quantidade_inscritos" id="quantidade_inscritos" value="{{ session('dados')['quantidade_inscritos'] }}">  

                
            </form>
            
        </section>
    </div>

<script src="{{ asset('backend/assets/vendors/inputmask/inputmask.min.js') }}"></script>

<script class="text/javascript">
    // Função para gerar os campos de nome, telefone e e-mail para cada participante
    function gerarCamposParticipantes() {
        var quantidadeParticipantes = document.getElementById('quantidade_inscritos').value;
        var participantesDiv = document.getElementById('participantes');
        participantesDiv.innerHTML = ''; // Limpa os campos anteriores

        // Loop para gerar os campos para cada participante
        for (var i = 0; i < quantidadeParticipantes; i++) {
            var participanteHTML = `
                <div class="form-row">
                    <div class="form-group col">
                        <label for="nome${i}">Nome completo</label>
                        <input type="text" class="form-control" name="participante[${i}][nome]" id="nome${i}" required>
                    </div>
                    <div class="form-group col">
                        <label for="celular${i}">Celular:</label>
                        <input type="text" class="form-control" name="participante[${i}][celular]" id="celular${i}" required>
                    </div>
                    <div class="form-group col">
                        <label for="email${i}">E-mail:</label>
                        <input type="text" class="form-control" name="participante[${i}][email]" id="email${i}" required>
                    </div>
                </div>
            `;
            participantesDiv.innerHTML += participanteHTML;
        }
    }

    // Chama a função para gerar os campos de nome, celular e e-mail para cada participante ao carregar a página
    gerarCamposParticipantes();



</script>

@endsection
