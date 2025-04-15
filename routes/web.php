<?php

use Illuminate\Support\Facades\Route;
// Importa os controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CodigoErroController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProfileController; // Controller do Breeze
// Importa os controllers do Admin (atenção aos namespaces)
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TecnicoController as AdminTecnicoController;
use App\Http\Controllers\Admin\CodigoErroController as AdminCodigoErroController;
use App\Http\Controllers\Admin\SolucaoController as AdminSolucaoController;
use App\Http\Controllers\Admin\ManualController as AdminManualController;
use App\Http\Controllers\Admin\ImagemController as AdminImagemController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\ComentarioController as AdminComentarioController;
use App\Http\Controllers\Admin\MarcaController as AdminMarcaController;
use App\Http\Controllers\Admin\ModeloController as AdminModeloController;
// Nota: Os controllers de Código de Erro, Manual e Vídeo do Admin usarão os mesmos controllers
// da área pública, mas dentro do grupo de rotas admin.

// Área pública
Route::get('/', [HomeController::class, 'index'])->name('home'); // Nomeia a rota home
Route::get('/codigos', [CodigoErroController::class, 'index'])->name('codigos.index');
// Usa o model binding com slug
Route::get('/codigo/{codigoErro}', [CodigoErroController::class, 'show'])->name('codigos.show');
Route::get('/manuais', [ManualController::class, 'index'])->name('manuais.index'); // Rota pública para listar manuais
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index'); // Rota pública para listar vídeos

// Rotas de autenticação geradas pelo Breeze (não mexer diretamente aqui)
require __DIR__.'/auth.php';

// Área protegida (usuário logado - admin ou tecnico)
Route::middleware(['auth', 'verified'])->group(function () { // Adiciona 'verified' se usar verificação de email
    // Rota do dashboard padrão do Breeze
    Route::get('/dashboard', function () {
        // Redireciona admin para o painel admin, técnico para o dashboard normal
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        // TODO: Criar view para dashboard do técnico
        return view('dashboard');
    })->name('dashboard');

    // Rotas de perfil (gerenciadas pelo Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para SALVAR comentários (requer ID e tipo do comentavel) - ACESSÍVEL A TODOS LOGADOS
    // Usa o mesmo controller do Admin, pois a lógica é a mesma
    Route::post('/comentarios/{comentavel_type}/{comentavel_id}', [App\Http\Controllers\Admin\ComentarioController::class, 'store'])
        ->name('comentarios.store') // Nome genérico para salvar comentários
        ->where('comentavel_id', '[0-9]+') // Garante que o ID é numérico
        ->where('comentavel_type', '[a-z_]+'); // Garante que o tipo é uma string (ex: codigo_erro)

    // Download de Manuais (requer autenticação)
    Route::get('/manuais/download/{manual}', [App\Http\Controllers\Admin\ManualController::class, 'download'])->name('manuais.download'); // Corrigido para usar AdminController que tem o método
});

// Área administrativa (apenas admin logado)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD de Técnicos (Users com role 'tecnico')
    Route::resource('tecnicos', AdminTecnicoController::class);

    // CRUD de Marcas
    Route::resource('marcas', AdminMarcaController::class);

    // CRUD de Modelos
    Route::resource('modelos', AdminModeloController::class);

    // CRUD de Códigos de Erro
    Route::resource('codigos', AdminCodigoErroController::class);

    // CRUD de Soluções
    Route::resource('solucoes', AdminSolucaoController::class);

    // CRUD de Manuais
    Route::resource('manuais', AdminManualController::class);
    // Adicionar rota de download separada, pois não é padrão do resource
    Route::get('manuais/download/{manual}', [AdminManualController::class, 'download'])->name('manuais.download');

    // CRUD de Imagens (sem create/store autônomo)
    Route::resource('imagens', AdminImagemController::class)->except(['create', 'store', 'show']);

    // CRUD de Vídeos (sem create/store autônomo)
    Route::resource('videos', AdminVideoController::class)->except(['create', 'store', 'show']);

    // Exclusão de Comentários (APENAS ADMIN PODE EXCLUIR PELA ROTA)
    Route::delete('/comentarios/{comentario}', [App\Http\Controllers\Admin\ComentarioController::class, 'destroy'])->name('comentarios.destroy');
});
