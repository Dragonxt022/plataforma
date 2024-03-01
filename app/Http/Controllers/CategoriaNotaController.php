<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaNota;
use App\Models\Notas;


class CategoriaNotaController extends Controller
{
    public function index()
    {
        $categorias = CategoriaNota::all();
        return view('admin.admin_lista_categoria_notas', compact('categorias'));
    }

    public function create()
    {
        $categorias = CategoriaNota::all();
        return view('admin.admin_editar_categoria_notas', compact('categorias'));
        
    }

    public function store(Request $request)
    {
        // Valide os dados do formulário
        $request->validate([
            'nome_categoria' => 'required|string|max:255',
        ] , [
            'nome_categoria.required' => 'Precisa de um nome antes de cadastar!',
        ]);

        // Crie a categoria
        $categoria = new CategoriaNota();
        $categoria->nome_categoria = $request->nome_categoria;
        $categoria->save();

        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Categoria adicionada.',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function edit(CategoriaNota $categoria)
    {
        return view('admin.admin_editar_categoria_notas', compact('categoria'));
    }

    public function update(Request $request, CategoriaNota $categoria)
    {
        
        // Valide os dados do formulário
        $request->validate([
            'nome_categoria' => 'required|string|max:255',
        ], [
            'nome_categoria.required' => 'Precisa de um nome antes de cadastrar!',
        ]);

        // Atualizar os dados da categoria
        $categoria->nome_categoria = $request->nome_categoria;
        $categoria->save();

        ;

        // Redirecionar para a página de lista de categorias após a atualização
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(CategoriaNota $categoria)
    {

        // Verificar se a categoria é a categoria padrão (ID 1)
        if ($categoria->id === 1) {
            // Retornar uma mensagem informando que a categoria padrão não pode ser excluída
            $notification = [
                'message' => 'A categoria padrão não pode ser excluída.',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        // Verificar se a categoria está sendo referenciada em outra tabela
        if ($categoria->notas()->exists()) {
            // Atualizar os registros na outra tabela para usar o ID da categoria padrão (1)
            Notas::where('id_notas_categoria', $categoria->id)
                ->update(['id_notas_categoria' => 1]);
        }

        // Excluir a categoria mesmo que esteja sendo referenciada em outra tabela
        $categoria->delete();

        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Categoria excluída e referências atualizadas para a categoria padrão.',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

}
