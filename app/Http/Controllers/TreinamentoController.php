<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
// Armazenar um novo treinamento no banco de dados
use App\Models\Treinamento;
use App\Models\Inscricoes;
use App\Models\Banner;



class TreinamentoController extends Controller
{
    // Exibir todos os treinamentos pagina do Admininstrador
    public function index()
    {
        $treinamentos = Treinamento::with('empresa:id,nome')->get();

        // Limitar o tamanho do nome para cada treinamento
        foreach ($treinamentos as $treinamento) {
            $treinamento->nome = substr($treinamento->nome, 0, 45,);
            $treinamento->empresa->nome = substr($treinamento->empresa->nome, 0, 25);

            // Verificar se a data de início está no passado ou no futuro e definir o status
            if (Carbon::parse($treinamento->data_inicio)->isPast()) {
                $treinamento->status = 'Encerrado';
            } else {
                $treinamento->status = 'Ativado';
            }

             // Verificar se a data de início é vencida e definir a cor do texto
            if (Carbon::parse($treinamento->data_inicio)->isPast()) {
                $treinamento->data_inicio_class = 'text-danger';
            } else {
                $treinamento->data_inicio_class = '';
            }

            $treinamento->data_inicio = Carbon::parse($treinamento->data_inicio)->format('d/m/Y');
            $treinamento->title = $treinamento->nome;
            
        }
        
        return view('admin.admin_lista_cursos', compact('treinamentos'));
    }

    
    // Lista todos os Treinamentos na pagina do Site
    public function Listatreinamento()
    {
        $treinamentos = Treinamento::all();

        // Limitar o tamanho do nome para cada treinamento
        foreach ($treinamentos as $treinamento) {
            $treinamento->nome = substr($treinamento->nome, 0, 150,);

            // Verificar se a data de início está no passado ou no futuro e definir o status
            if (Carbon::parse($treinamento->data_inicio)->isPast()) {
                $treinamento->status = 'Encerrado';
            } else {
                $treinamento->status = 'Ativado';
            }

             // Verificar se a data de início é vencida e definir a cor do texto
            if (Carbon::parse($treinamento->data_inicio)->isPast()) {
                $treinamento->data_inicio_class = 'text-danger';
            } else {
                $treinamento->data_inicio_class = '';
            }

            $treinamento->data_inicio = Carbon::parse($treinamento->data_inicio)->format('d/m/Y');
            $treinamento->data_termino = Carbon::parse($treinamento->data_termino)->format('d/m/Y');

            
        }

        return view('site.treinamentos', compact('treinamentos'));
    }
    // Pagina que lista os detalhes de cada treinamento
    public function Detalhestreinamento($slug)
    {
        // Buscar o treinamento pelo slug
        $treinamento = Treinamento::where('slug', $slug)->firstOrFail();

        // Limitar o tamanho do nome para cada treinamento       
        $treinamento->data_inicio = Carbon::parse($treinamento->data_inicio)->format('d/m/Y');
        $treinamento->data_termino = Carbon::parse($treinamento->data_termino)->format('d/m/Y');

            
        

        return view('site.Treinamentos_detalhes', compact('treinamento'));
    }

    // Página de início do site
    public function PaginaInicio()
    {
        // Recuperar todos os banners
        $banners = Banner::all();

        // Passar os banners para a view
        return view('site.inicio', compact('banners'));
    }

    // Exibir formulário para criar um novo treinamento
    public function create()
    {
        $empresas = Empresa::pluck('nome', 'id');
        return view('admin.admin_cadastrar_curso', compact('empresas'));
    }

    

    public function store(Request $request)
    {   
       
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_inicio' => 'required|date',
            'data_termino' => 'required|date',
            'valor' => 'required|numeric',
            'vagas' => 'required|integer',
            'local' => 'required|string|max:255',
            'folder' => 'nullable|file|mimes:pdf,png,jpg,doc,docx,xlsx|max:4048', 
            'id_empresa' => 'required|exists:empresas,id', 
            'docente' => 'required|string|max:255',
            'banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nome.required' => 'O nome do curso é obrigatório.',
            'nome.max' => 'O nome do curso não pode ter mais de 255 caracteres.',
            'descricao.required' => 'A descrição do curso é obrigatória.',
            'data_inicio.required' => 'A data de início do curso é obrigatória.',
            'data_inicio.date' => 'A data de início do curso deve ser uma data válida.',
            'data_termino.required' => 'A data de término do curso é obrigatória.',
            'data_termino.date' => 'A data de término do curso deve ser uma data válida.',
            'valor.required' => 'O valor do curso é obrigatório.',
            'valor.numeric' => 'O valor do curso deve ser um valor numérico.',
            'vagas.required' => 'A quantidade de vagas é obrigatória.',
            'vagas.integer' => 'A quantidade de vagas deve ser um número inteiro.',
            'local.required' => 'O local do curso é obrigatório.',
            'local.max' => 'O local do curso não pode ter mais de 255 caracteres.',
            'folder.mimes' => '*Formato permitido: PDF, PNG, JPG, DOC, DOCX, XLSX, tamanho maximo 12mb',
            'id_empresa.required' => 'É necessário selecionar uma empresa.',
            'id_empresa.exists' => 'A empresa selecionada é inválida.',
            'nome_empresa.required' => 'O nome da empresa é obrigatório.',
            'nome_empresa.max' => 'O nome da empresa não pode ter mais de 255 caracteres.',
            'docente.required' => 'O nome do docente é obrigatório.',
            'docente.max' => 'O nome do docente não pode ter mais de 255 caracteres.',
            'banner.image' => 'O arquivo do banner deve ser uma imagem.',
            'banner.mimes' => 'O banner deve estar em um dos formatos: jpeg, png, jpg, gif.',
            'banner.max' => 'O tamanho máximo permitido para o banner é de 2048 KB.',
        ]);
        
        
        // Processar o upload do banner
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $filename = time() . '_' . $banner->getClientOriginalName();
            $banner->move(public_path('upload/cursos_images'), $filename);
        } else {
            $filename = null; // Se não houver arquivo enviado, defina como null
        }

        // Processar o upload do arquivo
        if ($request->hasFile('folder')) {
            $arquivo = $request->file('folder');
            $arquivoNome = time() . '_' . $arquivo->getClientOriginalName();
            $arquivo->move(public_path('upload/folder'), $arquivoNome);
        } else {
            $arquivoNome = null; // Se não houver arquivo enviado, defina como null
        }

        // Criar um novo treinamento
        $treinamento = new Treinamento();
        $treinamento->nome = $request->nome;
        $treinamento->slug = Str::slug($request->nome);
        $treinamento->descricao = $request->descricao;
        $treinamento->data_inicio = $request->data_inicio;
        $treinamento->data_termino = $request->data_termino;
        $treinamento->valor = $request->valor;
        $treinamento->vagas = $request->vagas;
        $treinamento->local = $request->local;
        $treinamento->folder = $arquivoNome;
        $treinamento->id_empresa = $request->id_empresa;
        $treinamento->docente = $request->docente;
        $treinamento->banner = $filename;
        $treinamento->save();

        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Treinamento cadastrado com sucesso!',
            'alert-type' => 'success',
        ];
        
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
    
    }


    // Exibir formulário para editar um treinamento
    public function edit(Treinamento $treinamento)
    {
        $empresas = Empresa::pluck('nome', 'id');
        return view('admin.admin_editar_curso', compact('treinamento', 'empresas'));
    }


    // Atualizar um treinamento no banco de dados
    public function update(Request $request, Treinamento $treinamento)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_inicio' => 'required|date',
            'data_termino' => 'required|date',
            'valor' => 'required|numeric',
            'vagas' => 'required|integer',
            'local' => 'required|string|max:255',
            'folder' => 'nullable|file|mimes:pdf,png,jpg,doc,docx,xlsx|max:4048', 
            'id_empresa' => 'required|exists:empresas,id', 
            'docente' => 'required|string|max:255',
            'banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nome.required' => 'O nome do curso é obrigatório.',
            'nome.max' => 'O nome do curso não pode ter mais de 255 caracteres.',
            'descricao.required' => 'A descrição do curso é obrigatória.',
            'data_inicio.required' => 'A data de início do curso é obrigatória.',
            'data_inicio.date' => 'A data de início do curso deve ser uma data válida.',
            'data_termino.required' => 'A data de término do curso é obrigatória.',
            'data_termino.date' => 'A data de término do curso deve ser uma data válida.',
            'valor.required' => 'O valor do curso é obrigatório.',
            'valor.numeric' => 'O valor do curso deve ser um valor numérico.',
            'vagas.required' => 'A quantidade de vagas é obrigatória.',
            'vagas.integer' => 'A quantidade de vagas deve ser um número inteiro.',
            'local.required' => 'O local do curso é obrigatório.',
            'local.max' => 'O local do curso não pode ter mais de 255 caracteres.',
            'folder.mimes' => '*Formato permitido: PDF, PNG, JPG, DOC, DOCX, XLSX, tamanho maximo 12mb',
            'id_empresa.required' => 'É necessário selecionar uma empresa.',
            'id_empresa.exists' => 'A empresa selecionada é inválida.',
            'nome_empresa.required' => 'O nome da empresa é obrigatório.',
            'nome_empresa.max' => 'O nome da empresa não pode ter mais de 255 caracteres.',
            'docente.required' => 'O nome do docente é obrigatório.',
            'docente.max' => 'O nome do docente não pode ter mais de 255 caracteres.',
            'banner.image' => 'O arquivo do banner deve ser uma imagem.',
            'banner.mimes' => 'O banner deve estar em um dos formatos: jpeg, png, jpg, gif.',
            'banner.max' => 'O tamanho máximo permitido para o banner é de 2048 KB.',
        ]);
        
        
       // Processar o upload do banner
        if ($request->hasFile('banner')) {
            // Verifica se existe um arquivo de banner atual
            if ($treinamento->banner) {
                // Exclui o arquivo antigo
                if (file_exists(public_path('upload/cursos_images/' . $treinamento->banner))) {
                    unlink(public_path('upload/cursos_images/' . $treinamento->banner));
                }
            }

            // Move o novo banner para o diretório de upload
            $banner = $request->file('banner');
            $bannername = time() . '_' . $banner->getClientOriginalName(); // Variável renomeada para $bannername
            $banner->move(public_path('upload/cursos_images'), $bannername);
        } else {
            // Se não houver arquivo enviado, mantém o valor do banner atual
            $bannername = $treinamento->banner;
        }

        // Processar o upload do folder (folder)
        if ($request->hasFile('folder')) {
            // Verifica se existe um arquivo de folder atual
            if ($treinamento->folder) {
                // Exclui o arquivo antigo
                if (file_exists(public_path('upload/folder/' . $treinamento->folder))) {
                    unlink(public_path('upload/folder/' . $treinamento->folder));
                }
            }

            // Move o novo folder para o diretório de upload
            $folder = $request->file('folder');
            $foldername = time() . '_' . $folder->getClientOriginalName(); // Variável renomeada para $foldername
            $folder->move(public_path('upload/folder'), $foldername);
        } else {
            // Se não houver arquivo enviado, mantém o valor do folder atual
            $foldername = $treinamento->folder;
        }


        // Atualizar os dados do treinamento
        $treinamento->update([
            'nome' => $request->nome,
            'slug' => Str::slug($request->nome),
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
            'data_termino' => $request->data_termino,
            'valor' => $request->valor,
            'vagas' => $request->vagas,
            'local' => $request->local,
            'folder' => $foldername,
            'id_empresa' => $request->id_empresa,
            'docente' => $request->docente,
            'banner' => $bannername,
        ]);


        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Treinamento cadastrado com sucesso!',
            'alert-type' => 'success',
        ];
        
        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
    
    }

    // Excluir um treinamento do banco de dados
    // Excluir um treinamento do banco de dados
    public function destroy(Treinamento $treinamento)
    {
        // Verificar se há inscrições associadas a este treinamento
    if ($treinamento->inscricoes()->exists()) {
        // Se houver inscrições associadas, exclua-as primeiro
        $treinamento->inscricoes()->delete();
    }
        // Excluir a imagem associada ao treinamento se existir
        if ($treinamento->banner) {
            // Construa o caminho completo para a imagem
            $caminhoImagem = public_path('upload/cursos_images/' . $treinamento->banner);
            
            // Verifique se o arquivo de imagem realmente existe antes de tentar excluí-lo
            if (file_exists($caminhoImagem)) {
                // Excluir a imagem do diretório
                unlink($caminhoImagem);
            }
        }

        // Excluir o PDF associado ao treinamento se existir
        if ($treinamento->pdf_caminho) {
            // Construa o caminho completo para o PDF
            $caminhoPDF = public_path('upload/folder/' . $treinamento->pdf_caminho);
            
            // Verifique se o arquivo PDF realmente existe antes de tentar excluí-lo
            if (file_exists($caminhoPDF)) {
                // Excluir o PDF do diretório
                unlink($caminhoPDF);
            }
        }

        // Excluir o treinamento do banco de dados
        $treinamento->delete();

        // Retornar mensagem de sucesso
        $notification = [
            'message' => 'Treinamento excluído com sucesso!',
            'alert-type' => 'success',
        ];

        // Retornar a notificação ou redirecionar para a página desejada
        return redirect()->back()->with($notification);
    }




}
