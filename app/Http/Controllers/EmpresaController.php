<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmpresaController extends Controller
{
    
    public function ListaDeEmpressas()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        $empresas = Empresa::all();
        return view('admin.admin_lista_empresa', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_cadastrar_empresa');

    }

    public function store(Request $request)
    {
        
        // Validar dados
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:empresas,cnpj|max:18',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|integer',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
            'banco' => 'required|string|max:255',
            'conta' => 'required|string|max:255',
            'beneficiario' => 'required|string|max:255',
            'cabecalho' => 'required|image|mimes:jpeg,png',
            'rodape' => 'required|image|mimes:jpeg,png',
        ],[
            'nome.required' => '*Este campo é obrigatório.',
            'cnpj.required' => '*Deve ser único, no maximo 14 números',
            'endereco.required' => '*Este campo é obrigatório.',
            'numero.required' => '*Este campo é obrigatório.',
            'bairro.required' => '*Este campo é obrigatório.',
            'cep.required' => '*Este campo é obrigatório.',
            'banco.required' => '*Este campo é obrigatório.',
            'conta.required' => '*Este campo é obrigatório.',
            'beneficiario.required' => '*Este campo é obrigatório.',
            'cabecalho.required' => '*Formato permitido PNG ou JPG',
            'rodape.required' => '*Formato permitido PNG ou JPG',
        ]
        
        );

        // dd($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Criar nova empresa
        $empresa = new Empresa();
        $empresa->nome = $request->nome;
        $empresa->cnpj = $request->cnpj;
        $empresa->endereco = $request->endereco;
        $empresa->numero = $request->numero;
        $empresa->bairro = $request->bairro;
        $empresa->cep = $request->cep;
        $empresa->banco = $request->banco;
        $empresa->conta = $request->conta;
        $empresa->beneficiario = $request->beneficiario;

        // Tratar upload da imagem do cabeçalho
        if ($request->hasFile('cabecalho')) {
            $image = $request->file('cabecalho');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/empresas_images'), $filename);
            $empresa->cabecalho = $filename;
        }

        // Tratar upload da imagem do rodapé
        if ($request->hasFile('rodape')) {
            $image = $request->file('rodape');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('upload/empresas_images'), $filename);
            $empresa->rodape = $filename;
        }

        // Salvar nova empresa
        $empresa->save();

        // Retornar mensagem de sucesso
        $notification = array(
            'message' => 'Empresa cadastrada com sucesso!',
            'alert-type' => 'success',
        );
       
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->route('admin.lista.empressas')->with('success', 'cadastrada com sucesso!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */


    public function edit(Empresa $empresa)
    {
        return view('admin.admin_editar_empresa', compact('empresa'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request, Empresa $empresa)
{
    // Validar dados
    $validator = Validator::make($request->all(), [
        'nome' => 'required|string|max:255',
        'cnpj' => 'required|string|max:18',
        'endereco' => 'required|string|max:255',
        'numero' => 'required|integer',
        'bairro' => 'required|string|max:255',
        'cep' => 'required|string|max:10',
        'banco' => 'required|string|max:255',
        'conta' => 'required|string|max:255',
        'beneficiario' => 'required|string|max:255',
        'cabecalho' => 'nullable|image|mimes:jpeg,png',
        'rodape' => 'nullable|image|mimes:jpeg,png',
    ], [
        'nome.required' => '*Este campo é obrigatório.',
        'cnpj.required' => '*Este campo é obrigatório.',
        'endereco.required' => '*Este campo é obrigatório.',
        'numero.required' => '*Este campo é obrigatório.',
        'bairro.required' => '*Este campo é obrigatório.',
        'cep.required' => '*Este campo é obrigatório.',
        'banco.required' => '*Este campo é obrigatório.',
        'conta.required' => '*Este campo é obrigatório.',
        'beneficiario.required' => '*Este campo é obrigatório.',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    // Tratar upload da imagem do cabeçalho
    if ($request->hasFile('cabecalho')) {
        $image = $request->file('cabecalho');
        $filename = date('YmdHi') . $image->getClientOriginalName();
        $image->move(public_path('upload/empresas_images'), $filename);
        
        // Excluir imagem antiga, se existir
        if (!empty($empresa->cabecalho)) {
            $oldImagePath = public_path('upload/empresas_images/' . $empresa->cabecalho);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        
        $empresa->cabecalho = $filename;
    }
    
    // Tratar upload da imagem do rodapé
    if ($request->hasFile('rodape')) {
        $image = $request->file('rodape');
        $filename = date('YmdHi') . $image->getClientOriginalName();
        $image->move(public_path('upload/empresas_images'), $filename);
        
        // Excluir imagem antiga, se existir
        if (!empty($empresa->rodape)) {
            $oldImagePath = public_path('upload/empresas_images/' . $empresa->rodape);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        
        $empresa->rodape = $filename;
    }
    
    // Atualizar os campos da empresa com os dados do formulário
    $empresa->nome = $request->input('nome');
    $empresa->cnpj = $request->input('cnpj');
    $empresa->endereco = $request->input('endereco');
    $empresa->numero = $request->input('numero');
    $empresa->bairro = $request->input('bairro');
    $empresa->cep = $request->input('cep');
    $empresa->banco = $request->input('banco');
    $empresa->conta = $request->input('conta');
    $empresa->beneficiario = $request->input('beneficiario');
    
    // Salvar as alterações no banco de dados
    $empresa->save();
    
    // Retornar mensagem de sucesso
    $notification = [
        'message' => 'Empresa atualizada com sucesso!',
        'alert-type' => 'success',
    ];
    
    // Retornar a notificação ou redirecionar para a página desejada
    return redirect()->back()->with($notification);
}

     
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        // Excluir as imagens associadas à empresa
        if (!empty($empresa->cabecalho)) {
            $cabecalhoImagePath = public_path('upload/empresas_images/' . $empresa->cabecalho);
            if (file_exists($cabecalhoImagePath)) {
                unlink($cabecalhoImagePath);
            }
        }

        if (!empty($empresa->rodape)) {
            $rodapeImagePath = public_path('upload/empresas_images/' . $empresa->rodape);
            if (file_exists($rodapeImagePath)) {
                unlink($rodapeImagePath);
            }
        }

        // Excluir a empresa
        $empresa->delete();

        return redirect()->route('admin.lista.empressas')->with('success', 'Empresa excluída com sucesso!');
    }

}
