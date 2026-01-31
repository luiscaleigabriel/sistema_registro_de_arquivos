<?php

use Illuminate\Support\Facades\Route;

/*
| Site
*/

Route::livewire('/', 'pages::site.index')->name('site.index');
Route::livewire('/sobre', 'pages::site.about')->name('site.about');
Route::livewire('/cursos', 'pages::site.cursos')->name('site.cursos');
Route::livewire('/inscricao', 'pages::site.inscricao')->name('site.inscricao');

/*
| Auth
*/

Route::livewire('/login', 'pages::auth.login')->name('login');
