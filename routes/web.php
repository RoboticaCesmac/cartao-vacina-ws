<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() { return redirect()->route('login'); });

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/logar', 'LoginController@logar')->name('logar');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/nova-senha', 'LoginController@recuperarSenha')->name('senha.recuperar');
Route::post('/nova-senha', 'LoginController@salvarNovaSenha')->name('senha.nova');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // USUARIOS
    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'UsuariosController@index')->name('usuarios.listar');
        Route::get('/novo', 'UsuariosController@novo')->name('usuarios.novo');
        Route::post('/cadastrar', 'UsuariosController@cadastrar')->name('usuarios.cadastrar');
        Route::get('/edicao/{id}', 'UsuariosController@edicao')->name('usuarios.edicao');
        Route::post('/editar/{id}', 'UsuariosController@editar')->name('usuarios.editar');
        Route::get('/excluir/{id?}', 'UsuariosController@excluir')->name('usuarios.excluir');
    });

    /** RELATORIOS */
    Route::group(['prefix' => 'relatorios'], function () {
        Route::get('/sintomaticos', 'RelatorioController@sintomaticos')->name('relatorio.sintomaticos');
        Route::get('/estatistica', 'RelatorioController@estatisticas')->name('relatorio.estatistica');
    });
});

