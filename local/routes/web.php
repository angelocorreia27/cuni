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
    Route::resource('reproducao', 'ReproducaoController');
    Route::resource('gestantes', 'GestantesController');
    Route::resource('racas', 'RacaController');
    Route::resource('gaiolas', 'GaiolaController');
    Route::resource('dominios', 'DominioController');
    Route::resource('reposicoes', 'ReposicaoController');
    Route::resource('maternidades', 'MaternidadeController');
    Route::resource('obitos', 'ObitoController');
    Route::resource('engordas', 'EngordaController');
    Route::resource('abates', 'AbateController');
    Route::resource('cobricoes','CobricaoController');

    Route::resource('lista_cobricao','ListaCobricaoController'); 
    Route::resource('lista_palpacao','ListaPalpacaoController'); 
    Route::resource('lista_ninho','ListaCNinhoController'); 
    Route::resource('lista_vpartos','ListaVPartosController');
    Route::resource('lista_desmame','ListaDesmameController');
});

Route::get('bandas','CobricaoController@getBanda');
Route::get('getListTatuagem/{sexo}/{banda}','CobricaoController@getListTatuagem');
Route::get('contact', 'ContactController@index');