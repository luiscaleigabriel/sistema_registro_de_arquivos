<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\ProcessoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;



// Rotas Públicas
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [HomeController::class, 'contactoSubmit'])->name('contacto.submit');

// Rotas de Autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/registro', [AuthController::class, 'showRegister'])->name('registro');
    Route::post('/registro', [AuthController::class, 'register'])->name('registro.submit');

    Route::get('/esqueci-senha', [AuthController::class, 'showPasswordRequest'])->name('password.request');
    Route::post('/esqueci-senha', [AuthController::class, 'sendPasswordReset'])->name('password.email');

    Route::get('/verificar-email/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->name('verification.verify');
});

// Rotas Protegidas - Sistema Interno
Route::middleware(['auth.check'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Geral (redireciona)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Área do Aluno
    Route::middleware(['aluno'])->prefix('aluno')->name('aluno.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'alunoDashboard'])->name('dashboard');

        // Processos
        Route::get('/processos', [ProcessoController::class, 'alunoIndex'])->name('processos');
        Route::post('/processos', [ProcessoController::class, 'store'])->name('processos.store');
        Route::get('/processos/novo', [ProcessoController::class, 'create'])->name('processos.create');
        Route::get('/processos/{id}/edit', [ProcessoController::class, 'edit'])->name('processos.edit');
        Route::put('/processos/{id}/finalizar', [ProcessoController::class, 'finalizar'])->name('processos.finalizar');
        Route::put('/processos/{id}', [ProcessoController::class, 'update'])->name('processos.update');
        Route::get('/processos/{id}', [ProcessoController::class, 'alunoShow'])->name('processo.view');

        // Inscrições
        Route::get('/inscricoes', [InscricaoController::class, 'alunoIndex'])->name('inscricoes');
        Route::get('/inscricoes/{id}', [InscricaoController::class, 'alunoShow'])->name('inscricao.view');
        Route::get('/inscricoes/nova', [InscricaoController::class, 'create'])->name('nova-inscricao');
        Route::post('/inscricoes', [InscricaoController::class, 'store'])->name('inscricao.store');
        Route::post('/inscricoes/{id}/teste', [InscricaoController::class, 'fazerTeste'])->name('inscricao.teste');
        Route::post('/inscricoes/{id}/validar', [InscricaoController::class, 'validar'])->name('inscricao.validar');

        // Documentos
        Route::get('/documentos', [DocumentoController::class, 'alunoIndex'])->name('documentos');
        Route::get('/documentos/novo', [DocumentoController::class, 'create'])->name('documentos.create');
        Route::post('/documentos', [DocumentoController::class, 'store'])->name('documento.store');
        Route::get('/documentos/{id}/download', [DocumentoController::class, 'download'])->name('documento.download');
        Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('documento.destroy');

        // Perfil
        Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('perfil');
        Route::put('/perfil', [UsuarioController::class, 'updatePerfil'])->name('perfil.update');
    });

    // Área do Secretário
    // Route::middleware(['secretario'])->prefix('secretario')->name('secretario.')->group(function () {
    //     Route::get('/dashboard', [DashboardController::class, 'secretarioDashboard'])->name('dashboard');
    //     Route::get('/processos', [ProcessoController::class, 'secretarioIndex'])->name('processos');
    //     Route::get('/processos/{id}/analisar', [ProcessoController::class, 'analisar'])->name('processo.analisar');
    //     Route::post('/processos/{id}/analisar', [ProcessoController::class, 'processarAnalise'])->name('processo.analisar.store');
    //     Route::get('/inscricoes', [InscricaoController::class, 'secretarioIndex'])->name('inscricoes');
    //     Route::get('/inscricoes/{id}/avaliar', [InscricaoController::class, 'avaliar'])->name('inscricao.avaliar');
    //     Route::post('/inscricoes/{id}/avaliar', [InscricaoController::class, 'processarAvaliacao'])->name('inscricao.avaliar.store');
    //     Route::get('/documentos', [DocumentoController::class, 'secretarioIndex'])->name('documentos');
    //     Route::post('/documentos/{id}/validar', [DocumentoController::class, 'validar'])->name('documento.validar');
    //     Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos');
    //     Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios');
    //     Route::get('/relatorios/gerar', [RelatorioController::class, 'gerar'])->name('relatorios.gerar');
    //     Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])->name('configuracoes');
    // });

    // Área do Administrador
    // Route::middleware(['administrador'])->prefix('admin')->name('admin.')->group(function () {
    //     Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    //     Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
    //     Route::get('/usuarios/novo', [UsuarioController::class, 'create'])->name('usuarios.novo');
    //     Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    //     Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
    //     Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    //     Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    //     Route::get('/processos', [ProcessoController::class, 'adminIndex'])->name('processos');
    //     Route::get('/processos/{id}/arquivar', [ProcessoController::class, 'arquivar'])->name('processo.arquivar');
    //     Route::get('/inscricoes', [InscricaoController::class, 'adminIndex'])->name('inscricoes');
    //     Route::get('/relatorios', [RelatorioController::class, 'adminIndex'])->name('relatorios');
    //     Route::post('/relatorios/gerar', [RelatorioController::class, 'gerarAdmin'])->name('relatorios.gerar.admin');
    //     Route::get('/configuracoes', [ConfiguracaoController::class, 'adminIndex'])->name('configuracoes');
    //     Route::post('/configuracoes', [ConfiguracaoController::class, 'update'])->name('configuracoes.update');
    //     Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria');
    //     Route::get('/backup', [BackupController::class, 'index'])->name('backup');
    //     Route::post('/backup/gerar', [BackupController::class, 'gerar'])->name('backup.gerar');
    // });
});
