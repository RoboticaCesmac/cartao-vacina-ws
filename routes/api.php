<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Não autenticado
Route::post('/login', 'Api\UsuariosController@logar');
Route::put('/senha', 'Api\UsuariosController@recuperarSenha');


Route::group(['prefix' => 'usuarios'], function () {
    Route::post('/', 'Api\UsuariosController@cadastrar');
});

//Autenticado
Route::group(['middleware' => ['jwt']], function () {   

    //Usuários
    Route::group(['prefix' => 'usuarios'], function () {
        Route::put('/', 'Api\UsuariosController@atualizar');
    });
});