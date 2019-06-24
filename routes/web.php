<?php

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

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});


Route::group(['middleware'=>['auth']],function(){

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    

    Route::get('/main', function () {
        return view('contenido/contenido');
    }) ->name('main');
    
    Route::group(['middleware'=>['Secretaria']],function(){


        Route::get('/oficina','OficinaController@index');
        Route::post('/oficina/registrar','OficinaController@store');
        Route::put('/oficina/actualizar','OficinaController@update');
        Route::get('/oficina/selectOficina','OficinaController@selectOficina');
        
        Route::get('/expediente','ExpedienteController@index');
        Route::post('/expediente/registrar','ExpedienteController@store');
        Route::put('/expediente/actualizar','ExpedienteController@update');
        Route::get('/expediente/selectExpediente','ExpedienteController@selectExpediente');

        Route::get('/regexpediente','RegexpedienteController@index');
        Route::post('/regexpediente/registrar','RegexpedienteController@store');
        Route::put('/regexpediente/desactivar','RegexpedienteController@desactivar');

        Route::get('/persona','PersonaController@index');
        Route::post('/persona/registrar','PersonaController@store');
        Route::put('/persona/actualizar','PersonaController@update');
        Route::get('/persona/selectPersona','PersonaController@selectPersona');
                
        
        Route::get('/solicitante', 'SolicitanteController@index');
        Route::post('/solicitante/registrar', 'SolicitanteController@store');
        Route::put('/solicitante/actualizar', 'SolicitanteController@update');
        Route::get('/solicitante/selectSolicitante', 'SolicitanteController@selectSolicitante');

    });
     

    Route::group(['middleware'=>['Administrador']],function(){

        Route::get('/oficina','OficinaController@index');
        Route::post('/oficina/registrar','OficinaController@store');
        Route::put('/oficina/actualizar','OficinaController@update');
        Route::get('/oficina/selectOficina','OficinaController@selectOficina');
        
        Route::get('/expediente','ExpedienteController@index');
        Route::post('/expediente/registrar','ExpedienteController@store');
        Route::put('/expediente/actualizar','ExpedienteController@update');
        Route::get('/expediente/selectExpediente','ExpedienteController@selectExpediente');
        
        
        Route::get('/regexpediente','RegexpedienteController@index');
        Route::post('/regexpediente/registrar','RegexpedienteController@store');
        Route::put('/regexpediente/desactivar','RegexpedienteController@desactivar');
        
        
        Route::get('/persona','PersonaController@index');
        Route::post('/persona/registrar','PersonaController@store');
        Route::put('/persona/actualizar','PersonaController@update');
        Route::get('/persona/selectPersona','PersonaController@selectPersona');
        
        
        Route::get('/rol','RolController@index');
        Route::get('/rol/selectRol','RolController@selectRol');
        
        Route::get('/user','UserController@index');
        Route::post('/user/registrar','UserController@store');
        Route::put('/user/actualizar','UserController@update');
        Route::post('/user/desactivar','UserController@desactivar');
        Route::put('/user/activar','UserController@activar');
        
        
        Route::get('/solicitante', 'SolicitanteController@index');
        Route::post('/solicitante/registrar', 'SolicitanteController@store');
        Route::put('/solicitante/actualizar', 'SolicitanteController@update');
        Route::get('/solicitante/selectSolicitante', 'SolicitanteController@selectSolicitante');
        


    });


});



//Route::get('/home', 'HomeController@index')->name('home');
