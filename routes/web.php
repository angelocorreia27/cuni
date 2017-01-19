<?php

Route::singularResourceParameters();


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', 'Auth\LoginController@logout');


Route::group(['middleware' => ['web']], function(){
	Route::resource('providers', 'ProviderController');
    Route::resource('animais', 'AnimalController');
    Route::resource('reprodutores', 'ReproducaoController');
    Route::resource('racas', 'RacaController');
    Route::resource('gaiolas', 'GaiolaController');
    Route::resource('dominios', 'DominioController');
    Route::resource('reposicoes', 'ReposicaoController');
    Route::resource('maternidades', 'MaternidadeController');
    Route::resource('obitos', 'ObitoController');
    Route::resource('engorda', 'EngordaController');
    Route::resource('abates', 'AbateController');
});