<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Inscricoes;
use Carbon\Carbon;

class InscricaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar todas as inscrições ordenadas pelo ID em ordem decrescente
        $inscricoes = Inscricoes::orderBy('id', 'desc')->get();

        foreach ($inscricoes as $inscricao) {
            // Limitar o tamanho do nome para cada inscricao
            $inscricao->nome_empresa = substr($inscricao->nome_empresa, 0, 40);

            $inscricao->data_realizacao = Carbon::parse($inscricao->data_realizacao)->format('d/m/Y');

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

        

        return view('admin.admin_lista_inscricoes', compact('inscricoes'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
