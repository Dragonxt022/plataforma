<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Treinamento;
use App\Models\Banner;
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
            'valor' => 'required|numeric',
            'local' => 'required|string',
            'id_empresa' => 'required|integer',
            'banner' => 'required|string',
            'docente' => 'required|string',
            'quantidade_participantes' => 'required|integer|min:1',
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
            'quantidade_participantes.required' => '* Quantidade de Participantes é obrigatório.',
            'quantidade_participantes.integer' => '* Quantidade de Participantes deve ser um número inteiro.',
            'quantidade_participantes.min' => '* Quantidade de Participantes deve ser no mínimo :min.',
        ]);

    
        // Se a validação falhar, redirecione de volta com os erros
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Se a validação for bem-sucedida, armazene os dados na sessão
        $request->session()->put('dados', $request->all());

        // Em seguida, chame a função diretamente
        return $this->formulario($request);
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
        
        dd($request);

    }

    // Pagina referente sobre nós
    public function Noticias()
    {
       

        // Passar o treinamento para a view
        return view('site.noticias');
    }
}