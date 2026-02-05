<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
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

// Rotas Protegidas (serão implementadas na FASE 3)
Route::middleware(['auth.check'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // // Dashboard Geral
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // // Área do Aluno
    // Route::middleware(['aluno'])->prefix('aluno')->name('aluno.')->group(function () {
    //     Route::get('/dashboard', [DashboardController::class, 'alunoDashboard'])->name('dashboard');
    // });

    // // Área do Secretário
    // Route::middleware(['secretario'])->prefix('secretario')->name('secretario.')->group(function () {
    //     Route::get('/dashboard', [DashboardController::class, 'secretarioDashboard'])->name('dashboard');
    // });

    // // Área do Administrador
    // Route::middleware(['administrador'])->prefix('admin')->name('admin.')->group(function () {
    //     Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    // });
});
