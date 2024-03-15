<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CategoriaPost;

use Illuminate\Support\Str;

class CategoriaPostController extends Controller
{
    //Pagina de visualização das cátegorias
    public function index(){

        // Recuperar todos os banners
        $categorias = CategoriaPost::all();

        // Passar os banners para a view
        return view('admin.admin_lista_categoria_post', compact('categorias'));
        
    } // Fim do metodo

    //Pagina de visualização das cátegorias
    public function store(Request $request)
    {
        // Valide os dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
        ], [
            'nome.required' => 'Precisa de um nome antes de cadastrar!',
        ]);

        // Tente salvar a categoria
        try {
            // Crie a categoria
            $categoria = new CategoriaPost();
            $categoria->nome = $request->nome;

            // Gere o slug a partir do nome usando o método slug() do helper Str
            $categoria->slug = Str::slug($request->nome);

            $categoria->save();

            // Retornar mensagem de sucesso
            $notification = [
                'message' => 'Categoria do post adicionada.',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Em caso de erro ao salvar, retorne uma mensagem de erro
            $notification = [
                'message' => 'Erro ao adicionar a categoria do post. CONTATE O SUPORTE',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    //  Método que apaga a categoria
    public function destroy(CategoriaPost $categoria)
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

        
        $categoria->delete();

        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Categoria excluída com sucesso.',
            'alert-type' => 'success',
        ];


        return redirect()->back()->with($notification);
        
    }

    // Metodo de edição de categoria do poste
    public function edit(CategoriaPost $categoria)
    {
        return view('admin.admin_editar_categoria_post', compact('categoria'));
    }

    public function update(Request $request, CategoriaPost $categoria)
    {
        
        // Valide os dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
        ], [
            'nome.required' => 'Precisa de um nome antes de atualizar!',
        ]);

        // Atualizar os dados da categoria
        $categoria->nome = $request->nome;
        // Gere o slug a partir do nome usando o método slug() do helper Str
        $categoria->slug = Str::slug($request->nome);
        
        $categoria->save();

        $notification = [
            'message' => 'Categoria do post atualizada.',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

        
    }


}
