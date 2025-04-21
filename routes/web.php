<?php

use Illuminate\Support\Facades\Route;
// Importa os controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CodigoErroController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProfileController; // Controller do Breeze
use App\Http\Controllers\BuscaController; // Importa o novo controller
use App\Http\Controllers\TecnicoDashboardController; // Importa o controller do dashboard do técnico
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
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\LikeController;
// Nota: Os controllers de Código de Erro, Manual e Vídeo do Admin usarão os mesmos controllers
// da área pública, mas dentro do grupo de rotas admin.

// Área pública
Route::get('/', [HomeController::class, 'index'])->name('home'); // Nomeia a rota home
Route::get('/codigos', [CodigoErroController::class, 'index'])->name('codigos.index');
// Usa o model binding com slug
Route::get('/codigo/{codigoErro}', [CodigoErroController::class, 'show'])->name('codigos.show');
Route::get('/manuais', [ManualController::class, 'index'])->name('manuais.index'); // Rota pública para listar manuais
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index'); // Rota pública para listar vídeos
// Rota para a página de resultados da busca
Route::get('/busca', [BuscaController::class, 'index'])->name('busca.index');

// Rotas públicas para Marcas
Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas.index');
Route::get('/marcas/{marca}', [MarcaController::class, 'show'])->name('marcas.show'); // Usará o slug se configurado no model

// Rotas públicas para Modelos
Route::get('/modelos', [ModeloController::class, 'index'])->name('modelos.index');
Route::get('/modelos/{modelo}', [ModeloController::class, 'show'])->name('modelos.show'); // Usará o slug se configurado no model

// Rota pública para visualizar PDF do Manual
Route::get('/manuais/view/{manual}', [ManualController::class, 'viewPdf'])->name('manuais.view');

// Rotas de autenticação geradas pelo Breeze (não mexer diretamente aqui)
require __DIR__.'/auth.php';

// Rota do Dashboard (com middleware de autenticação)
Route::get('/dashboard', function () {
    // Redireciona admin para o painel admin
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    // Chama o controller do dashboard do técnico
    return app(TecnicoDashboardController::class)->index();
})->middleware(['auth', 'verified'])->name('dashboard');

// Área protegida (usuário logado - admin ou tecnico)
Route::middleware(['auth', 'verified'])->group(function () { // Adiciona 'verified' se usar verificação de email
    // Rotas de perfil (gerenciadas pelo Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas de Comentários (Store, Edit, Update, Destroy)
    // Usa o mesmo controller do Admin para consistência
    Route::post('/comentarios/{comentavel_type}/{comentavel_id}', [App\Http\Controllers\Admin\ComentarioController::class, 'store'])
        ->name('comentarios.store')
        ->where('comentavel_id', '[0-9]+')
        ->where('comentavel_type', '[a-z_]+');

    Route::get('/comentarios/{comentario}/edit', [App\Http\Controllers\Admin\ComentarioController::class, 'edit'])
        ->name('comentarios.edit'); // Rota para mostrar form de edição

    Route::match(['put', 'patch'], '/comentarios/{comentario}', [App\Http\Controllers\Admin\ComentarioController::class, 'update'])
        ->name('comentarios.update'); // Rota para processar a atualização

    Route::delete('/comentarios/{comentario}', [App\Http\Controllers\Admin\ComentarioController::class, 'destroy'])
        ->name('comentarios.destroy'); // Rota de exclusão existente

    // Download de Manuais (requer autenticação)
    Route::get('/manuais/download/{manual}', [App\Http\Controllers\ManualController::class, 'download'])->name('manuais.download');

    // Rotas para Likes/Unlikes de Comentários
    Route::post('/comentarios/{comentario}/like', [LikeController::class, 'like'])
        ->name('comments.like');
    Route::delete('/comentarios/{comentario}/unlike', [LikeController::class, 'unlike'])
        ->name('comments.unlike');
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
    Route::resource('codigos', AdminCodigoErroController::class)->parameters([
        'codigos' => 'codigo_erro' // Alterando o nome do parâmetro da rota
    ]);

    // CRUD de Soluções - Especifica o nome do parâmetro como 'solucao'
    Route::resource('solucoes', AdminSolucaoController::class)->parameters([
        'solucoes' => 'solucao' // Garante que o parâmetro seja {solucao}
    ]);

    // CRUD de Manuais - Especifica o nome do parâmetro como 'manual'
    Route::resource('manuais', AdminManualController::class)->parameters([
        'manuais' => 'manual' // Garante que o parâmetro seja {manual} e não {manuai}
    ]);

    // CRUD de Imagens (sem create/store autônomo)
    Route::resource('imagens', AdminImagemController::class)->except(['create', 'store', 'show']);

    // CRUD de Vídeos (sem create/store autônomo)
    Route::resource('videos', AdminVideoController::class)->except(['create', 'store', 'show']);

    // Rotas para Importação
    Route::prefix('importar')->name('import.')->group(function () {
        Route::get('/codigos', [ImportController::class, 'create'])->name('codigos.form'); // Exibe o formulário
        Route::post('/codigos', [ImportController::class, 'store'])->name('codigos.process'); // Processa a importação
    });
});
