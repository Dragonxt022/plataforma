<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

// Models
use App\Models\Treinamento;
use App\Models\Banner;
use App\Models\DescontosAutomaticos;

use App\Models\Inscricoes;
use App\Models\Participante;


use Carbon\Carbon;

class FrontendController extends Controller
{
    // Página de início do site
    public function PaginaInicio()
    {
        // Recuperar todos os banners
        $banners = Banner::all();

        // Passar os banners para a view
        return view('site.inicio', compact('banners'));
    }

    // Página que lista os treinamentos
    public function Listatreinamento()
    {
        // Buscar todos os treinamentos
        $treinamentos = Treinamento::all();

        // Converter e formatar as datas de início e término
        foreach ($treinamentos as $treinamento) {
            // Formatando a data de início
            $dataInicio = Carbon::parse($treinamento->data_inicio)->isoFormat('D');
            // Formatando a data de término
            $dataTermino = Carbon::parse($treinamento->data_termino)->isoFormat('[ao dia] D [de] MMMM [de] YYYY');
    
            // Concatenando as datas no formato desejado
            $treinamento->periodo = $dataInicio . ' ' . $dataTermino;
        }

        // Passar os treinamentos formatados para a view
        return view('site.treinamentos', compact('treinamentos'));
    }


    // Página que exibe os detalhes de um treinamento específico
    public function Detalhestreinamento($slug)
    {
        // Buscar o treinamento pelo slug
        $treinamentos = Treinamento::where('slug', $slug)->firstOrFail();

        // Limitar o tamanho do nome para cada treinamento       
        $treinamentos ->data_inicio = Carbon::parse($treinamentos->data_inicio)->format('d/m/Y');
        $treinamentos ->data_termino = Carbon::parse($treinamentos->data_termino)->format('d/m/Y');

        // Passar o treinamento para a view
        return view('site.Treinamentos_detalhes', compact('treinamentos'));
    }

    // Página que exibe o formulario para realizar a inscrição
    public function paginaFormulario(Request $request)
    {   

        // Validar os dados recebidos
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nome' => 'required|string',
            'data_inicio' => 'required',
            'data_termino' => 'required',
            'local' => 'required|string',
            'id_empresa' => 'required|integer',
            'banner' => 'required|string',
            'docente' => 'required|string',
            'quantidade_inscritos' => 'required|integer|min:1',
        ], [
            'id.required' => '* ID é obrigatório.',
            'id.integer' => '* ID deve ser um número inteiro.',
            'nome.required' => '* Nome é obrigatório.',
            'nome.string' => '* Nome deve ser uma string.',
            'slug.required' => '* Slug é obrigatório.',
            'slug.string' => '* Slug deve ser uma string.',
            'folder.required' => '* Folder é obrigatório.',
            'folder.string' => '* Folder deve ser uma string.',
            'descricao.required' => '* Descrição é obrigatório.',
            'descricao.string' => '* Descrição deve ser uma string.',
            'data_inicio.required' => '* Data de Início é obrigatório.',
            'data_inicio.date' => '* Data de Início deve ser uma data válida.',
            'data_termino.required' => '* Data de Término é obrigatório.',
            'data_termino.date' => '* Data de Término deve ser uma data válida.',
            'valor.required' => '* Valor é obrigatório.',
            'valor.numeric' => '* Valor deve ser um número.',
            'vagas.required' => '* Vagas é obrigatório.',
            'vagas.integer' => '* Vagas deve ser um número inteiro.',
            'local.required' => '* Local é obrigatório.',
            'local.string' => '* Local deve ser uma string.',
            'id_empresa.required' => '* ID da Empresa é obrigatório.',
            'id_empresa.integer' => '* ID da Empresa deve ser um número inteiro.',
            'banner.required' => '* Banner é obrigatório.',
            'banner.string' => '* Banner deve ser uma string.',
            'docente.required' => '* Docente é obrigatório.',
            'docente.string' => '* Docente deve ser uma string.',
            'quantidade_inscritos.required' => '* Quantidade de Participantes é obrigatório.',
            'quantidade_inscritos.integer' => '* Quantidade de Participantes deve ser um número inteiro.',
            'quantidade_inscritos.min' => '* Quantidade de Participantes deve ser no mínimo :min.',
        ]);

    
        // Se a validação falhar, redirecione de volta com os erros
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Obter o treinamento pelo ID do produto
        $treinamento = Treinamento::findOrFail($request->id);

        // Obter o valor do curso
        $valorCurso = $treinamento->valor;

        // Calcular o subtotal
        $subtotal = $valorCurso * $request->quantidade_inscritos;

        // Consultar o modelo de desconto para obter os valores do desconto
        $descontos = DescontosAutomaticos::first();

        // Aplicar o desconto com base na quantidade de participantes
        $desconto = 0;
        if ($request->quantidade_inscritos == 1) {
            $desconto = $descontos->valor_1;
        } elseif ($request->quantidade_inscritos == 2) {
            $desconto = $descontos->valor_2;
        } elseif ($request->quantidade_inscritos == 3) {
            $desconto = $descontos->valor_3;
        } elseif ($request->quantidade_inscritos == 4) {
            $desconto = $descontos->valor_4;
        } elseif ($request->quantidade_inscritos == 5) {
            $desconto = $descontos->valor_5;
        } elseif ($request->quantidade_inscritos > 5) {
            $desconto = $descontos->mais_de_5;
        }

        // Calcular o total com desconto
        $totalComDesconto = $subtotal - $desconto;

        // Adiciona os valores de subtotal, desconto e total com desconto à requisição
        $request->merge([
            'subtotal' => $subtotal,
            'desconto' => $desconto,
            'total' => $totalComDesconto,
            'valor_curso' => $valorCurso,
        ]);

        // Armazena os dados na sessão
        $request->session()->put('dados', $request->all());


        // Em seguida, chame a função diretamente
        return view('site.formulario');


    }


    public function formulario()
    {
        // Obtenha os dados da sessão
        $dados = session('dados');

        // Faça o que você quiser com os dados
        
        // Por exemplo, passe os dados para a visão para exibição
        return view('site.formulario', compact('dados'));
    }


    public function insereFormulario(Request $request){

        // Obtenha os dados da sessão
        $dados = session('dados', []);
        $subtotal = $dados['subtotal'] ?? null;
        $desconto = $dados['desconto'] ?? null;
        $totalComDesconto = $dados['total'] ?? null;
        $valorCurso = $dados['valor_curso'] ?? null;

        // Mesclar os dados da requisição com os dados da sessão
        $dadosRequisicao = $request->all();
        $dadosRequisicao['subtotal'] = $subtotal;
        $dadosRequisicao['desconto'] = $desconto;
        $dadosRequisicao['total'] = $totalComDesconto;
        $dadosRequisicao['valor_curso'] = $valorCurso;

         // Formatando data de início
        $dadosRequisicao['data_inicio'] = Carbon::createFromFormat('d/m/Y', $dadosRequisicao['data_inicio'])->format('Y-m-d');

        // Formatando data de término
        $dadosRequisicao['data_termino'] = Carbon::createFromFormat('d/m/Y', $dadosRequisicao['data_termino'])->format('Y-m-d');

        // Adicionando a data de criação da inscrição
        $dadosRequisicao['data_realizacao'] = Carbon::now();

        // dd($dadosRequisicao);

        // Validação dos dados
        $validator = Validator::make($dadosRequisicao, [
            'cnpj' => 'required|string|max:30',
            'nome_juridico' => 'required|string|max:255',
            'cep' => 'required|string|max:30',
            'cidade' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero' => 'required|numeric',
            'responsavel' => 'required|string|max:255',
            'telefone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'acessibilidade' => 'nullable|string|max:255',
            'quantidade_inscritos' => 'required|numeric',
            'valor_curso' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'desconto' => 'required|numeric', 
            'total' => 'required|numeric',
            'id_treinamento' => 'required|numeric',
            'participante' => 'required|array',
            'participante.*.nome' => 'required|string|max:255',
            'participante.*.celular' => 'required|string|max:20',
            'participante.*.email' => 'required|email|max:255',
        ]);

        // Se a validação falhar, redirecione de volta com os erros
        if ($validator->fails()) {
            $errors = $validator->errors(); // Obtém todas as mensagens de erro
            
            // Lista para armazenar os campos que falharam na validação
            $camposInvalidos = [];
        
            // Itera sobre os erros para obter os campos que falharam na validação
            foreach ($errors->keys() as $campo) {
                $camposInvalidos[] = $campo;
            }
        
            // Exibe uma mensagem indicando os campos que falharam na validação
            echo "Os seguintes campos falharam na validação: " . implode(', ', $camposInvalidos) . "<br>";
        
            // Exibe as mensagens de erro para cada campo
            foreach ($errors->all() as $error) {
                echo $error . "<br>";
            }
        }
        

        // dd($dadosRequisicao);
        
        // Crie a inscrição no banco de dados
        $inscricao = Inscricoes::create($dadosRequisicao);

        // Crie os participantes, se houver
        foreach ($dadosRequisicao['participante'] as $participante) {
            $this->criarParticipante($inscricao->id, $dadosRequisicao['id_treinamento'], $participante['nome'], $participante['celular'], $participante['email']);
        }

        // Passar os dados da inscrição para a página de obrigado
        Session::put('dados_requisicao', $dadosRequisicao);

        // Redirecione para a página de obrigado
        return redirect()->route('site.formulario.obrigado');
    }

    // Função para criar novos participantes
    private function criarParticipante($inscricaoId, $idTreinamento, $nome, $celular, $email) {
        Participante::create([
            'inscricao_id' => $inscricaoId, // Usar o id da inscrição
            'id_treinamento' => $idTreinamento, // Usar o id_treinamento do participante
            'nome' => $nome,
            'celular' => $celular,
            'email' => $email // Se desejar, pode incluir o email aqui também
        ]);
    }

    public function obrigado() {
        // Obter todos os dados da requisição da sessão
        $dadosRequisicao = Session::get('dados_requisicao');
    
        // Se precisar, você pode fazer qualquer manipulação adicional dos dados aqui
    
        // Retorne a view de agradecimento com os dados da requisição
        return view('site.obrigado', compact('dadosRequisicao'));
    }

    // Pagina referente sobre nós
    public function Noticias()
    {
       

        // Passar o treinamento para a view
        return view('site.noticias');
    }
}