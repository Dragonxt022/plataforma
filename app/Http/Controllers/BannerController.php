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
        $banners = Banner::pluck('titulo', 'id');
        return view('admin.admin_editar_banner', compact('banners'));
    }


    // Adiciona o banner
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'required|string',
            'paragrafo' => 'required|string',
            'img_banner' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'dimensions:min_width=1920,min_height=650,max_width=1920,max_height=650',
                'max:2048'
            ],
            'link_botao' => 'required|string|max:255',
        ], [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O campo título deve ser uma string.',
            'titulo.max' => 'O campo título não pode ter mais de 255 caracteres.',
            'subtitulo.required' => 'O campo subtítulo é obrigatório.',
            'subtitulo.string' => 'O campo subtítulo deve ser uma string.',
            'paragrafo.required' => 'O campo parágrafo é obrigatório.',
            'paragrafo.string' => 'O campo parágrafo deve ser uma string.',
            'img_banner.required' => 'É obrigatório carregar uma imagem para o banner.',
            'img_banner.image' => 'O arquivo do banner deve ser uma imagem.',
            'img_banner.mimes' => 'O banner deve estar em um dos formatos: jpeg, png, jpg, gif.',
            'img_banner.dimensions' => 'A imagem do banner deve ter exatamente 1920x650 pixels.',
            'img_banner.max' => 'O tamanho máximo permitido para o banner é de 2048 KB.',
            'link_botao.required' => 'O campo link do botão é obrigatório.',
            'link_botao.string' => 'O campo link do botão deve ser uma string.',
            'link_botao.max' => 'O campo link do botão não pode ter mais de 255 caracteres.',
        ]);
    
        // Processar o upload da imagem do banner
        if ($request->hasFile('img_banner')) {
            $imgBanner = $request->file('img_banner');
            $imgBannerNome = time() . '_' . $imgBanner->getClientOriginalName();
            $imgBanner->move(public_path('upload/admin_banner'), $imgBannerNome);
 
        }
    
        // Criar um novo treinamento
        $treinamento = new Banner();
        $treinamento->titulo = $request->titulo;
        $treinamento->subtitulo = $request->subtitulo;
        $treinamento->paragrafo = $request->paragrafo;
        $treinamento->img_banner = $imgBannerNome;
        $treinamento->link_botao = $request->link_botao;
        // Outros campos aqui...
    
        $treinamento->save();
    
        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Banner adicionado com sucesso!',
            'alert-type' => 'success',
        ];
    
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
    }
    

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
         // Validação dos dados
         $request->validate([
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'required|string',
            'paragrafo' => 'required|string',
            'img_banner' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'dimensions:min_width=1920,min_height=650,max_width=1920,max_height=650',
                'max:2048'
            ],
            'link_botao' => 'required|string|max:255',
        ], [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O campo título deve ser uma string.',
            'titulo.max' => 'O campo título não pode ter mais de 255 caracteres.',
            'subtitulo.required' => 'O campo subtítulo é obrigatório.',
            'subtitulo.string' => 'O campo subtítulo deve ser uma string.',
            'paragrafo.required' => 'O campo parágrafo é obrigatório.',
            'paragrafo.string' => 'O campo parágrafo deve ser uma string.',
            'img_banner.required' => 'É obrigatório carregar uma imagem para o banner.',
            'img_banner.image' => 'O arquivo do banner deve ser uma imagem.',
            'img_banner.mimes' => 'O banner deve estar em um dos formatos: jpeg, png, jpg, gif.',
            'img_banner.dimensions' => 'A imagem do banner deve ter exatamente 1920x650 pixels.',
            'img_banner.max' => 'O tamanho máximo permitido para o banner é de 2048 KB.',
            'link_botao.required' => 'O campo link do botão é obrigatório.',
            'link_botao.string' => 'O campo link do botão deve ser uma string.',
            'link_botao.max' => 'O campo link do botão não pode ter mais de 255 caracteres.',
        ]);

        // Remover a imagem anterior se uma nova imagem for fornecida
        if ($request->hasFile('img_banner')) {
            // Verificar se o banner atual tem uma imagem associada
            if ($banner->img_banner) {
                // Remover a imagem anterior do servidor
                Storage::delete('upload/admin_banner/' . $banner->img_banner);
            }
        }

        // Atualizar os dados do banner
        $banner->update([
            'titulo' => $request->titulo,
            'subtitulo' => $request->subtitulo,
            'paragrafo' => $request->paragrafo,
            'link_botao' => $request->link_botao,
            // Adicione aqui outros campos que você deseja atualizar
        ]);

        // Processar o upload da nova imagem do banner
        if ($request->hasFile('img_banner')) {
            $imgBanner = $request->file('img_banner');
            $imgBannerNome = time() . '_' . $imgBanner->getClientOriginalName();
            $imgBanner->move(public_path('upload/admin_banner'), $imgBannerNome);

            // Atualizar o nome da imagem no banco de dados
            $banner->update(['img_banner' => $imgBannerNome]);
        }

        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Banner Atualizado com sucesso!',
            'alert-type' => 'success',
        ];
    
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
    }


    public function destroy(Banner $banner)
    {
        // Verificar se o banner tem uma imagem associada
        if ($banner->img_banner) {
            // Remover a imagem do servidor
            Storage::delete('upload/admin_banner' . $banner->img_banner);
        }

        // Excluir o banner do banco de dados
        $banner->delete();

        // Retornar uma resposta de sucesso
        return redirect()->route('admin.admin_lista_banner')->with('success', 'Banner excluído com sucesso!');

    }
}
