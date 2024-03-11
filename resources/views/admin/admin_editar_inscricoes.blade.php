@extends('admin.admin_dashboard')  

@section('admin')

<div class="page-content">
    <div class="row profile-body">
      
        <div class="col-md-8 col-xl-12  middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body p-2">
                        <h6 class="card-title py-4"> <i data-feather="clipboard"></i> Atualizar ficha de inscrição   N° {{ $inscricao->id }} </h6>

                        <form method="POST" action="{{ route('admin.inscricoes.update', ['inscricao' => $inscricao->id]) }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- input ocutos --}}

                            <input type="hidden" class="form-control" name="id_treinamento" id="id_treinamento" value="{{ $inscricao->id_treinamento }}">
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
                            <div class="row py-4">
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

                            {{-- Sublinha Linha Gerencia valores --}}
                            <div class="row bg-dark  ">
                                <h5 class="card-title py-3 "> <i data-feather="list"></i> {{ $treinamento->nome }} </h5>
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Quantidade participantes</td>
                                                    <td class="text-end">{{ $inscricao->quantidade_inscritos }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td class="text-end" id="subtotal">R$ {{ $inscricao->subtotal }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800 ">Valor da Inscrição</td>
                                                    <td class="text-bold-800 text-end" id="valorInscricao"> R$ {{ $inscricao->valor_curso }} </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">Desconto</td>
                                                    <td class="text-bold-800 text-end text-danger" id="desconto"> R$ - {{ $inscricao->desconto }}</td>
                                                    
                                                </tr>
                                                <tr>
                                                    
                                                </tr>
                                                <tr class="bg-dark">
                                                    <td class="text-bold-800">Total</td>
                                                    <td class="text-bold-800 text-end text-success" id="total">R$ {{ $inscricao->total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>   
                            </div>
                            <div id="camposEditar" style="display: none;">
                                <div class="row justify-content-end text-end">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="quantidade_inscritos" class="form-label">Inscritos</label>
                                            <input type="text" class="form-control text-end @error('quantidade_inscritos') is-invalid @enderror" name="quantidade_inscritos" id="quantidade_inscritos" value="{{ $inscricao->quantidade_inscritos }}">
                                            @error('quantidade_inscritos')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
    
                                        <div class="col">
                                            <label for="valor_curso" class="form-label">Valor total</label>
                                            <input type="text" class="form-control text-end @error('valor_curso') is-invalid @enderror" name="valor_curso" id="valor_curso" value="{{ $inscricao->total }}">
                                            @error('valor_curso')
                                            <span class="text-danger pt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="desconto" id="total-com-desconto" value="{{ $inscricao->desconto }}">
                                
                                </div>
                                
                            </div>
                            <div class="row py-3 ">
                                <div class="">
                                    
                                </div>

                                <div class="col text-end ">

                                    <a id="editarValores" class="btn btn-primary btn-xs">DESCONTO</a>
                                
                                </div>

                            </div>
                            
                            <div class="row py-5">
                                <h5 class="card-title py-4"><i data-feather="user"></i> Participantes </h5>
                                <div id="participantes-container">
                                    @isset($participantes)
                                        @foreach ($participantes as $index => $participante)
                                            <div class="participante row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="nome_participante_{{ $index }}" class="form-label">Nome:</label>
                                                        <input type="text" class="form-control" id="nome_participante_{{ $index }}" name="participantes[{{ $index }}][nome]" value="{{ $participante->nome }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="celular_participante_{{ $index }}" class="form-label">Celular:</label>
                                                        <input type="text" class="form-control" id="celular_participante_{{ $index }}" name="participantes[{{ $index }}][celular]" value="{{ $participante->celular }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="email_participante_{{ $index }}" class="form-label">E-mail:</label>
                                                        <input type="email" class="form-control" id="email_participante_{{ $index }}" name="participantes[{{ $index }}][email]" value="{{ $participante->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-1" style="margin-top: 2.8%;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="excluir_participante_{{ $index }}" name="participantes[{{ $index }}][excluir]">
                                                        <label class="form-check-label" for="excluir_participante_{{ $index }}">Excluir</label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="participantes[{{ $index }}][participante_id]" value="{{ $participante->id }}">
                                                <input type="hidden" name="participantes[{{ $index }}][id_treinamento]" value="{{ $inscricao->id_treinamento }}">
                                                <input type="hidden" name="id_treinamento" value="{{ $inscricao->id_treinamento }}">

                                            </div>
                                        @endforeach
                                    @else
                                        <p>Não há participantes cadastrados para esta inscrição.</p>
                                    @endisset
                                </div>
                                
                                <div class="row">
                                    <div class="col text-end">
                                        <button type="button" id="add-participante-btn" class="btn btn-primary btn-xs"> Adicionar Participante</button>
                                    </div>
                                </div>
                            </div>
                            
                            
                           
                            {{-- sublinha linha --}}
                            <div class="row py-5">
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-xs btn-primary">Atualizar</button>

                                    @if(!empty($inscricao->pdf_caminho))
                                        <a href="{{ $inscricao->pdf_caminho }}" class="btn btn-xs btn-primary" title="Baixe uma cópia da ficha de inscrição em PDF">Baixar Ficha PDF</a>
                                    @else
                                        <button class="btn btn-xs btn-danger" title="Não Arquivo presente no momento" disabled>Baixar Ficha PDF</button>
                                    @endif

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

{{-- botão responsavel por editar os desconto --}}
<script class="text/javascript">
    document.getElementById('editarValores').addEventListener('click', function() {
        var camposEditar = document.getElementById('camposEditar');
        if (camposEditar.style.display === 'none' || camposEditar.style.display === '') {
            camposEditar.style.display = 'block'; // Se estiver oculto, exibe
        } else {
            camposEditar.style.display = 'none'; // Se estiver visível, oculta
        }
    });


    // Função para formatar um número para o formato de moeda brasileira
    function formatarMoeda(valor) {
        return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    // Função para calcular o desconto com base no novo total
    function calcularDesconto(novoTotal, subtotal) {
        // Arredondar para duas casas decimais antes de subtrair para evitar erros de precisão
        var desconto = Math.round((subtotal - novoTotal) * 100) / 100;
        return desconto;
    }

    // Ouvinte de eventos para detectar alterações no valor total
    document.addEventListener('DOMContentLoaded', function() {
        var valorCursoInput = document.getElementById('valor_curso');
        var subtotalElement = document.getElementById('subtotal'); // Elemento que exibe o subtotal na tabela
        var descontoElement = document.getElementById('desconto'); // Elemento que exibe o desconto na tabela
        var totalDescontoElement = document.getElementById('total-com-desconto'); // Elemento que exibe o total com desconto na tabela

        // Obter o subtotal da tabela
        var subtotal = parseFloat(subtotalElement.textContent.replace('R$ ', '').replace('.', '').replace(',', '.')); // Remover "R$" e substituir vírgula por ponto

        valorCursoInput.addEventListener('input', function(event) {
            var novoTotal = parseFloat(event.target.value.replace('.', '').replace(',', '.')); // Tratar vírgula como ponto
            var novoDesconto = calcularDesconto(novoTotal, subtotal);
            var totalComDesconto = novoTotal - novoDesconto; 

            descontoElement.textContent = ' ' + formatarMoeda(novoDesconto);
            totalDescontoElement.value = formatarMoeda(novoDesconto);
        });

    });
    

</script>


<script>
    $(document).ready(function() {
        // Contador para controlar o índice dos novos participantes
        var index = {{ isset($participantes) ? count($participantes) : 0 }};
        
        // Manipulador de evento para adicionar um novo participante
        $('#add-participante-btn').click(function() {
            // Incrementar o contador de índice
            index++;
            
            // Construir HTML para um novo participante
            var newParticipant = `
                <div class="participante row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="nome_participante_${index}" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome_participante_${index}" name="participantes[${index}][nome]">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="celular_participante_${index}" class="form-label">Celular:</label>
                            <input type="text" class="form-control" id="celular_participante_${index}" name="participantes[${index}][celular]">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="email_participante_${index}" class="form-label">E-mail:</label>
                            <input type="email" class="form-control" id="email_participante_${index}" name="participantes[${index}][email]">
                        </div>
                    </div>
                    <!-- Adicionar um campo oculto para o ID do participante -->
                    <input type="hidden" name="participantes[${index}][participante_id]" value="">
                    <!-- Adicionar um campo oculto para o ID do treinamento -->
                    <input type="hidden" name="participantes[${index}][id_treinamento]" value="{{ $inscricao->id_treinamento }}">
                    
                    <div class="col-1" style="margin-top: 2.7%;">
                        <button type="button" class="remove-participante-btn btn btn-primary btn-xs btn-icon">
                            X
                        </button>
                    </div>
                </div>
            `;

            
            // Adicionar o novo participante ao contêiner de participantes
            $('#participantes-container').append(newParticipant);
        });

        // Manipulador de evento para remover um participante
        $(document).on('click', '.remove-participante-btn', function() {
            // Remover o elemento pai do botão de remoção, que é o contêiner do participante
            $(this).closest('.participante').remove();
        });
    });
</script>





@endsection