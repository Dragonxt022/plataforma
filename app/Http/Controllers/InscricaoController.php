<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\Inscricoes;
use App\Models\Treinamento;
use App\Models\Participante;



class InscricaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar todas as inscrições ordenadas pelo ID em ordem decrescente
        $inscricoes = Inscricoes::orderBy('id', 'desc')->get();

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
        
        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Ficha Atualizada.',
            'alert-type' => 'success',
        ];
        
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
