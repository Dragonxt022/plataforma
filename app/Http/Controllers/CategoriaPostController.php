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
    }
}
