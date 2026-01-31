<?php

use Illuminate\Support\Facades\Route;

/*
| Site
*/

Route::livewire('/', 'pages::site.index')->name('site.index');
Route::livewire('/sobre', 'pages::site.about')->name('site.about');
Route::livewire('/cursos', 'pages::site.cursos')->name('site.cursos');
Route::middleware(['auth', 'is_student'])->group( function() {
    Route::livewire('/inscricao', 'pages::site.inscricao')->name('site.inscricao');
});

/*
| Auth
*/
Route::middleware('guest')->group( function() {
    Route::livewire('/login', 'pages::auth.login')->name('login');
});

/*
| Student Dashboard
*/

Route::middleware(['auth', 'is_student'])->group( function() {
    Route::livewire('/painel/aluno', 'pages::dashboard.aluno.index')->name('aluno.index');
});
