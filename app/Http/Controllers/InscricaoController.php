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

    // Método para formatar valor para moeda
    private function formatRevert($value)
    {
        return number_format($value, 2, '', '.');
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inscricoes $inscricao)
    {   
        // dd($request->all());

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
            'participantes' => 'required|array',
            // Regras de validação para os dados dos participantes
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
            // Adicione mais mensagens conforme necessário para os outros campos
        ]);
        

         // Remover formatação brasileira e converter para americano
        $valor_sem_formatacao = str_replace(['.', ','], ['', '.'], $request->valor_curso);
        $valor_numerico = floatval($valor_sem_formatacao);
        $valor_formatado_americano = number_format($valor_numerico, 2, '.', '');

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
        ]);


        $inscricao->save();


        $idTreinamento = $inscricao->id_treinamento;

        // Percorrer os participantes enviados no request
        foreach ($request['participantes'] as $participantData) {
            if (isset($participantData['participante_id'])) {
                // Participante existente
                $participante = Participante::find($participantData['participante_id']);
            } else {
                // Novo participante, crie um novo registro
                $participante = new Participante();
                // Definir o valor de inscricao_id para associar o participante à inscrição existente
                $participante->inscricao_id = $inscricao->id;
            }

            // Preencher os dados do participante
            $participante->nome = $participantData['nome'];
            $participante->celular = $participantData['celular'];
            $participante->email = $participantData['email'];
            
            // Atribuir o id_treinamento ao participante
            $participante->id_treinamento = $idTreinamento;

            // Salvar o participante
            $participante->save();
        }

        
        // 

        
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
