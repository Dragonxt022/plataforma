<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Aqui você pode adicionar a lógica para listar os treinamentos
        return view('site.treinamentos');
    }

    // Página que exibe os detalhes de um treinamento específico
    public function Detalhestreinamento($slug)
    {
        // Buscar o treinamento pelo slug
        $treinamento = Treinamento::where('slug', $slug)->firstOrFail();

        // Limitar o tamanho do nome para cada treinamento       
        $treinamento->data_inicio = Carbon::parse($treinamento->data_inicio)->format('d/m/Y');
        $treinamento->data_termino = Carbon::parse($treinamento->data_termino)->format('d/m/Y');

        // Passar o treinamento para a view
        return view('site.Treinamentos_detalhes', compact('treinamento'));
    }
}
