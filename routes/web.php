<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControlller;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\TreinamentoController;
use App\Http\Controllers\CategoriaNotaController;
use App\Http\Controllers\NotasController;


Route::get('/', function () {
    return view('index');
});


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



    // // Rotas para Treinamentos
    Route::get('/admin/treinamentos', [TreinamentoController::class, 'index'])->name('admin.treinamentos.index');
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

}); // Fim do Grupo Adim pelo Middleware


Route::middleware(['auth', 'role:agent'])->group(function(){

    Route::get('/agent/dashboard', [AgentControlller::class, 'AgentDashboard'])->name('agent.dashboard');

}); // Fim do Grupo Agent pelo Middleware


Route::get('/admin/login', [AdminControlller::class, 'AdminLogin'])->name('admin.login');