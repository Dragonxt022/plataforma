<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{   
    // Pagina que lista os banners
    public function index()
    {
        $banners = Banner::all();
        return view('admin.admin_lista_banner', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    // Adiciona o banner
    public function store(Request $request)
    {
        Banner::create($request->all());
        
        return redirect()->route('admin.admin_lista_banner')->with('success', 'Banner criado com sucesso!');
    }

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $banner->update($request->all());
        return redirect()->route('banners.index')->with('success', 'Banner atualizado com sucesso!');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner excluído com sucesso!');
    }
}
