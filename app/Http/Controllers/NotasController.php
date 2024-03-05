<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use Illuminate\Http\Request;

use App\Models\CategoriaNota;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;

use Illuminate\Support\Str;


class NotasController extends Controller
{
    public function index()
    {
        $notas = Notas::all();
        $categorias = CategoriaNota::all();

        // Formatando a data no padrão brasileiro e ajustando o nome do arquivo
        foreach ($notas as $nota) {
            $nota->nome_nota = substr($nota->nome_nota, 0, 40);

             // Verificando se há uma data de vencimento definida
            if ($nota->data_vencimento) {
                // Verificando se $nota->data_vencimento é uma instância de Carbon
                if (is_string($nota->data_vencimento)) {
                    // Tentar parsear a string de data com o Carbon
                    $dataVencimentoCarbon = Carbon::parse($nota->data_vencimento);
                    // Verificar se o parse foi bem-sucedido
                    if ($dataVencimentoCarbon->isValid()) {
                        // Formatar a data no padrão brasileiro
                        $nota->data_vencimento = $dataVencimentoCarbon->format('d/m/Y');
                        // Adicionar classe CSS condicionalmente se a nota estiver vencida
                        if (Carbon::now()->greaterThan($dataVencimentoCarbon)) {
                            $nota->data_vencimento_class = 'text-danger';
                        } else {
                            $nota->data_vencimento_class = '';
                        }
                    } else {
                        // Se a data não for válida, definir como "Vitalício" e adicionar classe de sucesso
                        $nota->data_vencimento = 'Vitalício';
                        $nota->data_vencimento_class = 'text-success';
                    }
                } else {
                    // Se $nota->data_vencimento já for uma instância de Carbon, formatá-la diretamente
                    $nota->data_vencimento = $nota->data_vencimento->format('d/m/Y');
                    // Adicionar classe CSS condicionalmente se a nota estiver vencida
                    if (Carbon::now()->greaterThan($nota->data_vencimento)) {
                        $nota->data_vencimento_class = 'text-danger';
                    } else {
                        $nota->data_vencimento_class = '';
                    }
                }
            } else {
                // Se não houver data de vencimento definida, definir como "Vitalício" e adicionar classe de sucesso
                $nota->data_vencimento = 'Vitalício';
                $nota->data_vencimento_class = 'text-success';
            }
        }

        return view('admin.admin_lista_notas_notas', compact('notas', 'categorias'));
    }

    public function create()
    {
        return view('notas.create');
    }

    public function store(Request $request)
    {
        // Validar dados
        $validator = Validator::make($request->all(), [
            'nome_nota' => 'required|string|max:255',
            'link_arquivo' => 'required|file|mimes:pdf,png,jpg,doc,docx,xlsx|max:4048', // Permitir vários tipos
            'data_vencimento' => 'nullable|date',
            'id_notas_categoria' => 'required|exists:categoria_notas,id',
        ], [
            'nome_nota.required' => '*Este campo é obrigatório.',
            'link_arquivo.required' => '*Arquivo é obrigatório.',
            'data_vencimento' => '*Este campo é obrigatório.',
            'id_notas_categoria.required' => '*Este campo é obrigatório.',
            'link_arquivo.mimes' => '*Formato permitido: PDF, PNG, JPG, DOC, DOCX, XLSX, tamanho maximo 12mb',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Processar o upload do arquivo
        if ($request->hasFile('link_arquivo')) {
            $arquivo = $request->file('link_arquivo');
            $arquivoNome = time() . '_' . $arquivo->getClientOriginalName();
            $arquivo->move(public_path('upload/notas_pdf'), $arquivoNome);
        } else {
            $arquivoNome = null; // Se não houver arquivo enviado, defina como null
        }

        // Criar nova nota
        $nota = new Notas();
        $nota->nome_nota = $request->nome_nota;
        $nota->link_arquivo = $arquivoNome;
        $nota->data_vencimento = $request->data_vencimento;
        $nota->id_notas_categoria = $request->id_notas_categoria;

        // Salvar nova nota
        $nota->save();

        // Retornar mensagem de sucesso
        return redirect()->route('admin.notas.store')->with('success', 'Nota criada com sucesso.');
    }


    public function show(Notas $nota)
    {
        return view('notas.show', compact('nota'));
    }

    public function edit(Notas $nota)
    {
        return view('notas.edit', compact('nota'));
    }

    public function update(Request $request, Notas $nota)
    {
        $request->validate([
            'nome_nota' => 'required|string|max:255',
            'link_arquivo' => 'required|string',
            'data_vencimento' => 'required|date',
            'id_notas_categoria' => 'required|exists:categoria_notas,id',
        ]);

        $nota->update($request->all());

        return redirect()->route('admin.notas.store')->with('success', 'Nota atualizada com sucesso.');
    }

    public function destroy(Notas $nota)
    {
         // Excluir o arquivo físico, se existir
        if (File::exists(public_path('upload/notas_pdf/' . $nota->link_arquivo))) {
            File::delete(public_path('upload/notas_pdf/' . $nota->link_arquivo));
        }

        // Excluir a nota do banco de dados
        $nota->delete();

        return redirect()->route('admin.notas.store')->with('success', 'Nota excluída com sucesso.');
    }
}
