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

Route::get('/', function () {
    return view('contenido/contenido');
});

Route::get('/oficina','OficinaController@index');
Route::post('/oficina/registrar','OficinaController@store');
Route::put('/oficina/actualizar','OficinaController@update');

Route::get('/expediente','ExpedienteController@index');
Route::post('/expediente/registrar','ExpedienteController@store');
Route::put('/expediente/actualizar','ExpedienteController@update');


Route::get('/persona','PersonaController@index');
Route::post('/persona/registrar','PersonaController@store');
Route::put('/persona/actualizar','PersonaController@update');


Route::get('/rol','RolController@index');
Route::get('/rol/selectRol','RolController@selectRol');

Route::get('/user','UserController@index');
Route::post('/user/registrar','UserController@store');
Route::put('/user/actualizar','UserController@update');
Route::post('/user/desactivar','UserController@desactivar');
Route::put('/user/activar','UserController@activar');
