<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/cadastro', function () {
    return view('usuario_cadastro');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/opcoes_cadastro', function () {
    return view('opcoes_cadastro');
});

Route::get('/usuario', function () {
    return view('usuario');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/informacoes', function () {
    return view('informacoes');
});

Route::get('/adicionar_contato', function () {
    return view('adicionar_contato');
});

Route::get('/adicionar_endereco', function () {
    return view('adicionar_endereco');
});

Route::get('/backoffice_cadastro', function () {
    return view('backoffice_cadastro');
});

Route::get('/docs', function () {
    return view('swagger');
});
