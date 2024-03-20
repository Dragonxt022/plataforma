<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use TCPDF;
use Carbon\Carbon;

use App\Models\Inscricoes;
use App\Models\Treinamento;
use App\Models\Participante;
use App\Models\Empresa;



class InscricaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar todas as inscrições ordenadas pelo ID em ordem decrescente
        $inscricoes = Inscricoes::orderBy('id', 'desc')->get();

        // Verificar se há inscrições antes de continuar
        if ($inscricoes->isEmpty()) {
            // Se não houver inscrições, retorne uma mensagem ou redirecione para uma página de erro
            return view('admin.index'); // Exemplo de uma view para quando não houver inscrições
        }

        // Inicializar um array para armazenar os treinamentos correspondentes
        $treinamentos = [];

        foreach ($inscricoes as $inscricao) {
            // Limitar o tamanho do nome para cada inscricao
            $inscricao->nome_empresa = substr($inscricao->nome_empresa, 0, 40);

            $inscricao->data_realizacao = Carbon::parse($inscricao->data_realizacao)->format('d/m/Y');

            // Buscar o treinamento correspondente ao ID da inscrição
            $treinamento = Treinamento::findOrFail($inscricao->id_treinamento);

            // Limitar o tamanho do nome para cada curso
            $treinamento->nome = substr($treinamento->nome, 0, 78);

            // Adicionar o treinamento ao array
            $treinamentos[] = $treinamento;

            // Converter o valor para o formato de moeda brasileira
            $inscricao->valor_curso = number_format($inscricao->valor_curso, 2, ',', '.');
            $inscricao->subtotal = number_format($inscricao->subtotal, 2, ',', '.');
            $inscricao->desconto = number_format($inscricao->desconto, 2, ',', '.');
            $inscricao->total = number_format($inscricao->total, 2, ',', '.');

           // Adicionar classe de cor com base no status
            switch ($inscricao->status) {
                case 'Processando':
                    $inscricao->cor_classe = 'btn btn-xs text-black bg-warning text-center';
                    break;
                case 'Concluido':
                    $inscricao->cor_classe = 'btn btn-xs text-white bg-success text-center';
                    break;
                case 'Cancelado':
                    $inscricao->cor_classe = 'btn btn-xs text-white bg-danger text-center';
                    break;
                default:
                    $inscricao->cor_classe = '';
            }



        } 

        return view('admin.admin_lista_inscricoes', compact('inscricoes', 'treinamento'));
    }

    public function dataTable(Request $request)
    {
        // Recuperar os dados das inscrições
        $inscricoes = Inscricoes::all();

        // Formatar os dados no formato esperado pelo DataTables
        $dadosFormatados = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $inscricoes->count(),
            'recordsFiltered' => $inscricoes->count(),
            'data' => $inscricoes,
        ];

        // Retornar os dados formatados como uma resposta JSON
        return response()->json($dadosFormatados);
    }



    
    // Método para alterar o status da inscrição
    public function alterarStatus(Request $request, $id)
    {
        $inscricao = Inscricoes::findOrFail($id);
        $inscricao->status = $request->status;
        $inscricao->save();

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar a inscrição pelo ID
        $inscricao = Inscricoes::findOrFail($id);

        // Converter os valores
        $inscricao->valor_curso = $this->formatCurrency($inscricao->valor_curso);
        $inscricao->subtotal = $this->formatCurrency($inscricao->subtotal);
        $inscricao->desconto = $this->formatCurrency($inscricao->desconto);
        $inscricao->total = $this->formatCurrency($inscricao->total);
        
        // Buscar o treinamento correspondente ao ID da inscrição
        $treinamento = Treinamento::findOrFail($inscricao->id_treinamento);

        // Buscar os participantes associados à ficha de inscrição
        $participantes = Participante::where('inscricao_id', $id)->get();

        // Retornar a view de edição com a inscrição e o nome do curso
        return view('admin.admin_editar_inscricoes', compact('inscricao', 'treinamento', 'participantes'));
    }

    // Método para formatar valor para moeda
    private function formatCurrency($value)
    {
        return number_format($value, 2, ',', '.');
    }


    /**
     * Update the specified resource in storage.
     */

    // Função para atualizar participantes existentes
    private function atualizarParticipante($participanteId, $inscricaoId, $idTreinamento, $nome, $celular, $email) {
        Participante::updateOrCreate(
            ['id' => $participanteId], // Condição para encontrar o participante existente pelo ID
            [
                'inscricao_id' => $inscricaoId, // Usar o id da inscrição
                'id_treinamento' => $idTreinamento, // Usar o id_treinamento do participante
                'nome' => $nome,
                'celular' => $celular,
                'email' => $email // Se desejar, pode incluir o email aqui também
            ]
        );
    }

    // Função para criar novos participantes
    private function criarParticipante($inscricaoId, $idTreinamento, $nome, $celular, $email) {
        // dd($idTreinamento);
        Participante::create([
            'inscricao_id' => $inscricaoId, // Usar o id da inscrição
            'id_treinamento' => $idTreinamento, // Usar o id_treinamento do participante
            'nome' => $nome,
            'celular' => $celular,
            'email' => $email // Se desejar, pode incluir o email aqui também
        ]);
    }

    public function update(Request $request, Inscricoes $inscricao)
    {   
        
        // dd($request);

        $validator = Validator::make($request->all(), [
            'nome_juridico' => 'required|string|max:255',
            'cnpj' => 'required|string|max:30',
            'cep' => 'required|string|max:30',
            'cidade' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero' => 'required|numeric',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:30',
            'quantidade_inscritos' => 'required|numeric',
            'valor_curso' => 'required|numeric',
            'desconto' => 'required',
            // Adicione regras de validação para os dados dos participantes
            'participantes' => 'required|array',
            'participantes.*.nome' => 'required|string|max:255',
            'participantes.*.celular' => 'required|string|max:20',
            'participantes.*.email' => 'required|email|max:255',
        ], [
            'nome_juridico.required' => 'O nome do curso é obrigatório.',
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cep.required' => 'O CEP é obrigatório.',
            'cidade.required' => 'A cidade é obrigatória.',
            'bairro.required' => 'O bairro é obrigatório.',
            'rua.required' => 'A rua é obrigatória.',
            'numero.required' => 'O número é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'quantidade_inscritos.required' => 'A quantidade de inscritos é obrigatória.',
            'valor_curso.required' => 'O valor do curso é obrigatório.',
            // Adicione mais mensagens conforme necessário para os outros campos e participantes
        ]);
        
        

         // Remover formatação brasileira e converter para americano
        $valor_sem_formatacao = str_replace(['.', ','], ['', '.'], $request->valor_curso);
        $valor_numerico = floatval($valor_sem_formatacao);
        $valor_formatado_americano = number_format($valor_numerico, 2, '.', '');

        // Obter o valor do desconto do request
        $desconto = $request->desconto;

        // Remover formatação brasileira e converter para americano
        $valor_sem_formatacaoDesconto = preg_replace('/[^0-9.,]/', '', $desconto); // Remover todos os caracteres que não são dígitos, pontos ou vírgulas
        $valor_formatado_americanoDesconto = str_replace(',', '.', $valor_sem_formatacaoDesconto); // Substituir a vírgula por ponto (se houver)
        $valor_numericoDesconto = floatval($valor_formatado_americanoDesconto); // Converter para float

        // Exibir para verificar se o valor está correto
        // dd($valor_numericoDesconto);

        // Agora $valor_numericoDesconto contém o valor do desconto em formato numérico americano


        // Atualizar os dados do inscricao
        $inscricao->update([
            'nome_juridico' => $request->nome_juridico,
            'cnpj' => Str::slug($request->cnpj),
            'cep' => $request->cep,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'quantidade_inscritos' => $request->quantidade_inscritos,
            'total' => $valor_formatado_americano,
            'desconto' => $valor_formatado_americanoDesconto,
           
        ]);


        $inscricao->save();

        // Obter o id_treinamento da inscrição
        foreach ($request['participantes'] as $participantData) {
            // Tratar os dados do participante
            $nome = trim($participantData['nome']); // Remover espaços em branco no início e no final
            $celular = preg_replace('/[^0-9]/', '', $participantData['celular']); // Remover caracteres não numéricos
            $email = strtolower($participantData['email']); // Converter para minúsculas
            $participanteId = $participantData['participante_id']; // Obter o ID do participante

            // Obter o ID do treinamento do participante
            $idTreinamento = $participantData['id_treinamento'];

            // Verificar se o participante deve ser excluído
            if (isset($participantData['excluir']) && $participantData['excluir'] == true) {
                // Excluir o participante
                Participante::destroy($participanteId);
            } else {
                // Verificar se o participante já existe
                if ($participanteId) {
                    // Atualizar o participante existente
                    $this->atualizarParticipante($participanteId, $inscricao->id, $idTreinamento, $nome, $celular, $email);
                } else {
                    // Criar um novo participante
                    $this->criarParticipante($inscricao->id, $idTreinamento, $nome, $celular, $email);
                }
            }
        }
        
        // Chamando a função para gerar o PDF
        $this->gerarPDF($request, $inscricao);
        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Ficha Atualizada.',
            'alert-type' => 'success',
        ];
        
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
        
    }

    public function gerarPDF(Request $request, Inscricoes $inscricao)
    {
        
        // Cria um novo objeto TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

        // Configurações do PDF
        $pdf->SetCreator('Grupo Incap www.grupoincap.com.br');
        $pdf->SetTitle('Ficha de inscrição - Grupo Incap');

        // Define a fonte e o tamanho para todo o documento
        $pdf->SetFont('helvetica', '', 8);

        // Ativa o corte automático da página
        $pdf->SetAutoPageBreak(true, 5);

        // Cabeçalho
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 12);

        // Obtenha o id_empresa da inscrição
        $idEmpresa = $inscricao->id_empresa;

        // Acesse o modelo Empresa para obter o caminho das imagens do cabeçalho e rodapé
        $empresa = Empresa::find($idEmpresa);

        // Verifique se a empresa foi encontrada no banco de dados
        if ($empresa) {
            // Caminho completo para o cabeçalho
            $imagePath1 = public_path('upload/empresas_images/' . $empresa->cabecalho);

            // Caminho completo para o rodapé
            $imagePath2 = public_path('upload/empresas_images/' . $empresa->rodape);

            // Verifica se o cabeçalho é um arquivo PNG válido
            if (file_exists($imagePath1)) {
                $pdf->Image($imagePath1, 0, 0, 210, 0); // Carrega o cabeçalho
            } else {
                echo "Erro: O arquivo do cabeçalho não existe.";
            }

            // Verifica se o rodapé é um arquivo PNG válido
            if (file_exists($imagePath2)) {
                $pdf->Image($imagePath2, 0, 260, 210, 0); // Carrega o rodapé
            } else {
                echo "Erro: O arquivo do rodapé não existe.";
            }
        } else {
            echo "Erro: Empresa não encontrada.";
        }

        $pdf->SetY(35); // Ajuste esta coordenada conforme necessário
        
        // Título
        $pdf->Cell(0, 5, 'FICHA DE INSCRIÇÃO', 0, 1, 'C');

        $pdf->Ln(0.1);

        // Informações da inscrição
        $pdf->SetFont('helvetica', 'B', 8);
        
        // Obtém os dados da inscrição
        $nome_juridico = $inscricao->nome_juridico;
        $cnpj = $inscricao->cnpj;
        $telefone = $inscricao->telefone;
        $email = $inscricao->email;
        $cep = $inscricao->cep;
        $cidade = $inscricao->cidade;
        $bairro = $inscricao->bairro;
        $rua = $inscricao->rua;
        $numero = $inscricao->numero;
        $inscricao_id = $inscricao->id;
        $data_formatada_formatada = $inscricao->created_at->format('d/m/Y');
        $responsavel = $inscricao->responsavel;
        $quantidade_inscritos = $inscricao->quantidade_inscritos;
        $data_inicio_formatada = \DateTime::createFromFormat('Y-m-d', $inscricao->data_inicio)->format('d/m/Y');
        $data_termino_formatada = \DateTime::createFromFormat('Y-m-d', $inscricao->data_termino)->format('d/m/Y');

        // Obtém os valores da inscrição
        $subtotal = number_format($inscricao->subtotal, 2, ',', '.');
        $desconto = number_format($inscricao->desconto, 2, ',', '.'); 
        $total = number_format($inscricao->total, 2, ',', '.'); 
        $nome_treinamento = $inscricao->nome_treinamento;
       
        // Obtém os dados da empresa
        $nome_empresa = $empresa->nome;
        $endereco_empresa = $empresa->endereco;
        $numero_empresa = $empresa->numero;
        $bairro_empresa = $empresa->bairro;
        $cep_empresa = $empresa->cep;
        $cnpj_empresa = $empresa->cnpj;

        $conta_empresa = $empresa->conta;
        $banco_empresa = $empresa->banco;
        $beneficiario_empresa = $empresa->beneficiario;

        $nome_treinamento = $request->nome_treinamento;
        
        $html = '
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 40%; padding: 0px;">
                        <p>JURÍDICO/ENTIDADE: ' . $nome_juridico . '<br>CNPJ: ' . $cnpj . '<br>TELEFONE: ' . $telefone . '<br>E-MAIL: ' . $email . '<br>CEP: ' . $cep . '<br>PAIS: Brasil</p>
                    </td>
                    <td style="width: 25%; padding: 0px;">
                       
                    </td>
                    <td style="width: 40%; padding: 0px;">
                        <p>CIDADE: ' . $cidade . '<br>BAIRRO: ' . $bairro . '<br>RUA: ' . $rua . '<br>N°: ' . $numero . '<br>NÚMERO DA FICHA: ' . $inscricao_id . '<br>INSCRITO: ' . $data_formatada_formatada . '</p>
                    </td>
                </tr>
            </table>';

        // Adicione a tabela ao PDF
        $pdf->writeHTML($html, true, false, false, false, '');

        $pdf->Ln(0);

        // Nome do treinamento
        $pdf->SetFont('helvetica', 'B', 9);

        $infor = "Responsável pelo empenho: $responsavel, Empresa: $nome_juridico, sua inscrição foi realizada com sucesso!";
        $pdf->MultiCell(0, 8, $infor, 0, 'L'); // Alterado 'L' para 'C' (centralizado)
        $pdf->SetFont('helvetica', '', 8); // Restaurar a fonte normal

        $pdf->Ln(0);
        // Defina a fonte e o tamanho
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(0, 8, 'Detalhes da inscrição #', 0, 1, 'L');

        // Crie a tabela
        $html = '
        <table style="border-collapse: collapse; width: 100%;" cellpadding="5">
        <tr style="background-color: #E6E6E6;">
            <th style="width: 5%; padding: 10px; text-align: center;">Qtd</th>
            <th style="width: 65%; padding: 10px;">Treinamento</th>
            <th style="width: 15%; padding: 10px; text-align: center;">Data de Início do Treinamento</th>
            <th style="width: 15%; padding: 10px; text-align: center;">Subtotal</th>
        </tr>
        <tr style="background-color: #c4c4c4;">
            <td style="text-align: center;">' . $quantidade_inscritos . '</td>
            <td>' . $nome_treinamento . '</td>
            <td style="text-align: center;">' . $data_inicio_formatada . ' ao dia ' . $data_termino_formatada . '</td>
            <td style="text-align: center;"> R$ ' . $subtotal . '</td>
        </tr>
        <tr style="background-color: #F5F5F5;">
            <td></td>
            <td >Método de pagamento:</td>
            <td></td>
            <td>Depósito ou<br>transferência</td>
        </tr>
        <tr style="background-color: #c4c4c4;">
            <td></td>
            <td>Desconto:</td>
            <td></td>
            <td style="text-align: center;">' . $desconto . '</td>
        </tr>
        <tr style="background-color: #F5F5F5;">
            <td></td>
            <td>Total:</td>
            <td></td>
            <td style="text-align: center;">' . $total . '</td>
        </tr>
        </table>';
        // Adicione a tabela ao PDF
        $pdf->writeHTML($html, true, false, false, false, '');

        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Cell(0, 8, 'Participantes #', 0, 1, 'L');

        $html = '
        <table style="border-collapse: collapse; width: 100%;" cellpadding="5">
        <tr style="background-color: #E6E6E6;">
            <th style="width: 50%;">Nome</th>
            <th style="width: 20%;">Celular</th>
            <th style="width: 40%;">E-mail</th>
        </tr>';

        $altura_celula = 5; // Altura padrão das células

            foreach ($request->participantes as $participante) {
                $nome = $participante['nome'];
                $celular = $participante['celular'];
                $email = $participante['email'];
            
                $html .= '<tr>';
                $html .= '<td>' . $nome . '</td>';
                $html .= '<td>' . $celular . '</td>';
                $html .= '<td>' . $email . '</td>';
                $html .= '</tr>';
            }

        $html .= '
        </table>';

        // Adicione a tabela HTML ao PDF
        $pdf->writeHTML($html, true, false, false, false, '');


        $pdf->Ln(0);

        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Cell(0, 8, 'Dados para empenho #', 0, 1, 'L');
        
        // dd($empresa);
        $texto = "DADOS PARA O EMPENHO: $nome_empresa, localizada na $endereco_empresa, $numero_empresa - $bairro_empresa, CEP $cep_empresa, de CNPJ $cnpj_empresa.\n\nFORMA DE PAGAMENTO: Deposito ou transferência $conta_empresa, $banco_empresa em nome de $beneficiario_empresa.";

        $pdf->MultiCell(0, 8, $texto, 0, 'L');

        // Defina o caminho completo para a pasta onde os arquivos serão armazenados
        $pasta_arquivos = public_path('upload/inscricao_pdf/');

        // Verifique se o diretório tem permissão de escrita
        if (!is_writable($pasta_arquivos)) {
            echo "Erro: O diretório não tem permissão para escrita.";
            // Adicione a lógica adicional aqui, como interromper o processo ou retornar um erro para o usuário
        } else {
            // Obter a data e hora atual
            $data_hora_atual = date('Ymd_His');

            // Nome do arquivo com data e hora
            $nome_arquivo = 'Ficha_' . $inscricao->id . '_' . Str::slug($inscricao->nome_juridico) . '.pdf';

            // Caminho completo para o arquivo
            $caminho_arquivo = $pasta_arquivos . $nome_arquivo;

            // Verifique se já existe um PDF associado à inscrição
            if ($inscricao->pdf_caminho && file_exists(public_path($inscricao->pdf_caminho))) {
                // Exclua o PDF anterior
                unlink(public_path($inscricao->pdf_caminho));
            }

            // Saída do PDF com o nome de arquivo baseado na data e hora atual
            $pdf->Output($caminho_arquivo, 'F');

            // Atualize o caminho do PDF na tabela de inscrições
            $inscricao->pdf_caminho = 'upload/inscricao_pdf/' . $nome_arquivo;
            $inscricao->save();
        }
    }

}
