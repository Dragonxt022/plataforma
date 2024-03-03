<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use Illuminate\Http\Request;
use App\Models\CategoriaNota;

class NotasController extends Controller
{
    public function index()
    {
        $notas = Notas::all();
        $categorias = CategoriaNota::all();
        return view('admin.admin_lista_notas_notas', compact('notas', 'categorias'));
    }

    public function create()
    {
        return view('notas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_nota' => 'required|string|max:255',
            'link_arquivo' => 'required|string',
            'data_vencimento' => 'required|date',
            'id_notas_categoria' => 'required|exists:categoria_notas,id',
        ]);

        Notas::create($request->all());

        return redirect()->route('notas.index')->with('success', 'Nota criada com sucesso.');
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

        return redirect()->route('notas.index')->with('success', 'Nota atualizada com sucesso.');
    }

    public function destroy(Notas $nota)
    {
        $nota->delete();

        return redirect()->route('notas.index')->with('success', 'Nota excluída com sucesso.');
    }
}
