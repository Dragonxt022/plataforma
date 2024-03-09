<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControlller;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\TreinamentoController;
use App\Http\Controllers\CategoriaNotaController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\InscricaoController; 
use App\Http\Controllers\BannerController;



// Route::get('/', function () {
//     return view('site.inicio');
// });


// Pagina do site
Route::get('/', [TreinamentoController::class, 'PaginaInicio'])->name('site.pagina.inicio');

// PAGINA DE TREINAMENTOS
Route::get('/treinamentos', [TreinamentoController::class, 'Listatreinamento'])->name('site.pagina.treinamentos');

// PAGINA DE DETALHES DOS CURSOS
Route::get('/treinamentos/{slug}', [TreinamentoController::class, 'Detalhestreinamento'])->name('site.treinamentos_detalhes');







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';

// Grupo Administrativo
Route::middleware(['auth', 'role:admin'])->group(function(){
    
    // Autentificação
    Route::get('/admin/dashboard', [AdminControlller::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/sair', [AdminControlller::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/perfil', [AdminControlller::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/perfil/store', [AdminControlller::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/mudar/senha', [AdminControlller::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/atualizar/senha', [AdminControlller::class, 'AdminUpdatePassword'])->name('admin.update.password');


    // Mosta Lista de Usuarios
    Route::get('/admin/lista/usuarios', [AdminControlller::class, 'ListaDeUsuarios'])->name('admin.lista.profile');
    Route::get('/admin/usurio/editar/{usuarios}', [AdminControlller::class, 'edit'])->name('admin.editar.perfil');
    Route::get('/admin/usuarios/cadastrar', [AdminControlller::class, 'cadastrar'])->name('admin.usuarios.cadastrar');
    Route::post('/admin/usuarios/cadastrar', [AdminControlller::class, 'salvar'])->name('admin.usuarios.salvar');
    Route::post('admin/atualizar/perfil/{id}', [AdminControlller::class, 'atualizaPerfil'])->name('admin.atualizar.perfil');
    Route::delete('/admin/usuarios/{id}', [AdminControlller::class, 'destroy'])->name('admin.usuarios.destroy');


    // Rotas para Empresas
    Route::get('/admin/empresas/lista', [EmpresaController::class, 'ListaDeEmpressas'])->name('admin.lista.empressas');
    Route::get('/admin/empresas/cadastrar', [EmpresaController::class, 'create'])->name('admin.empresas.create');
    Route::post('/admin/empresas/store', [EmpresaController::class, 'store'])->name('admin.empresas.store');
    Route::get('/empresas/{empresa}/editar', [EmpresaController::class, 'edit'])->name('admin.editar.empresa');
    Route::put('/empresas/{empresa}', [EmpresaController::class, 'update'])->name('admin.empresas.update');
    Route::delete('/admin/empresas/{empresa}', [EmpresaController::class, 'destroy'])->name('admin.empresas.destroy');



    // Rotas para Treinamentos
    Route::get('/admin/treinamentos/listar', [TreinamentoController::class, 'index'])->name('admin.treinamentos.index');
    Route::get('/admin/treinamentos/cadastrar', [TreinamentoController::class, 'create'])->name('admin.treinamentos.create');
    Route::post('/admin/treinamentos/store', [TreinamentoController::class, 'store'])->name('admin.treinamentos.store');
    Route::get('/admin/treinamentos/{treinamento}/editar', [TreinamentoController::class, 'edit'])->name('admin.treinamentos.edit');
    Route::put('/admin/treinamentos/{treinamento}', [TreinamentoController::class, 'update'])->name('admin.treinamentos.update');
    Route::delete('/admin/treinamentos/{treinamento}', [TreinamentoController::class, 'destroy'])->name('admin.treinamentos.destroy');



    // Rotas para Lista de Categoria
    Route::get('/admin/categorias', [CategoriaNotaController::class, 'index'])->name('admin.categorias.index');
    Route::post('/admin/categorias', [CategoriaNotaController::class, 'store'])->name('admin.categorias.store');
    Route::get('/admin/categorias/{categoria}/editar', [CategoriaNotaController::class, 'edit'])->name('admin.categorias.edit');
    Route::put('/admin/categorias/{categoria}', [CategoriaNotaController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/admin/categorias/{categoria}', [CategoriaNotaController::class, 'destroy'])->name('admin.categorias.destroy');

    // Rotas para Notas
    Route::get('/admin/notas', [NotasController::class, 'index'])->name('admin.notas.index');
    Route::get('/admin/notas/create', [NotasController::class, 'create'])->name('admin.notas.create');
    Route::post('/admin/notas', [NotasController::class, 'store'])->name('admin.notas.store');
    Route::get('/admin/notas/{nota}', [NotasController::class, 'show'])->name('admin.notas.show');
    Route::get('/admin/notas/{nota}/edit', [NotasController::class, 'edit'])->name('admin.notas.edit');
    Route::put('/admin/notas/{nota}', [NotasController::class, 'update'])->name('admin.notas.update');
    Route::delete('/admin/notas/{nota}', [NotasController::class, 'destroy'])->name('admin.notas.destroy');


    // Gerenciamento de Inscrições
    Route::get('/admin/inscricoes/lista', [InscricaoController::class, 'index'])->name('admin.inscricoes.index');

    Route::put('/admin/inscricoes/{id}/alterar-status', [InscricaoController::class, 'alterarStatus'])->name('admin.alterar.status');


    Route::get('/admin/inscricoes/criar', [InscricaoController::class, 'create'])->name('admin.inscricoes.create');

    Route::post('/admin/inscricoes/store', [InscricaoController::class, 'store'])->name('admin.inscricoes.store');

    Route::get('/admin/inscricoes/{inscricao}', [InscricaoController::class, 'show'])->name('admin.inscricoes.show');

    Route::get('/admin/inscricoes/{inscricao}/edit', [InscricaoController::class, 'edit'])->name('admin.inscricoes.edit');

    Route::put('/admin/inscricoes/{inscricao}', [InscricaoController::class, 'update'])->name('admin.inscricoes.update');

    Route::delete('/admin/inscricoes/{inscricao}', [InscricaoController::class, 'destroy'])->name('admin.inscricoes.destroy');

    // sistema de gerenciamento de banner pagina Incial
    Route::get('/admin/banners/lista', [BannerController::class, 'index'])->name('admin.banners.index');

    // Rota para o formulario
    Route::get('/admin/banners/criar', [BannerController::class, 'create'])->name('admin.banners.create');

    // rota responsavel por criar um novo banner
    Route::post('/admin/banners', [BannerController::class, 'store'])->name('admin.banners.store');

    Route::get('/admin/banners/{banner}/edit', [BannerController::class, 'edit'])->name('admin.banners.edit');

    Route::put('/admin/banners/{banner}', [BannerController::class, 'update'])->name('admin.banners.update');

    Route::delete('/admin/banners/{banner}', [BannerController::class, 'destroy'])->name('admin.banners.destroy');


}); // Fim do Grupo Adim pelo Middleware


Route::middleware(['auth', 'role:agent'])->group(function(){

    Route::get('/agent/dashboard', [AgentControlller::class, 'AgentDashboard'])->name('agent.dashboard');

}); // Fim do Grupo Agent pelo Middleware


Route::get('/admin/login', [AdminControlller::class, 'AdminLogin'])->name('admin.login');

