<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DescontosAutomaticos;
use Illuminate\Support\Facades\Validator;

class DescontosAutomaticosController extends Controller
{
    public function index()
    {
        $descontos = DescontosAutomaticos::first();

        return view('admin.admin_descontos', ['descontos' => $descontos]);
    }


    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'valor_1' => 'required|numeric',
            'valor_2' => 'required|numeric',
            'valor_3' => 'required|numeric',
            'valor_4' => 'required|numeric',
            'valor_5' => 'required|numeric',
            'mais_de_5' => 'required|numeric',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute deve ser um número.',
        ]);

        // Se a validação falhar, redireciona de volta com os erros
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Localiza o registro a ser atualizado no banco de dados
        $desconto = DescontosAutomaticos::findOrFail($id);

        // Atualiza os valores dos descontos com base nos dados do formulário
        $desconto->valor_1 = $request->input('valor_1');
        $desconto->valor_2 = $request->input('valor_2');
        $desconto->valor_3 = $request->input('valor_3');
        $desconto->valor_4 = $request->input('valor_4');
        $desconto->valor_5 = $request->input('valor_5');
        $desconto->mais_de_5 = $request->input('mais_de_5');

        // Salva as alterações no banco de dados
        $desconto->save();

        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Descontos Atualizada.',
            'alert-type' => 'success',
        ];
        
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
    }

}
