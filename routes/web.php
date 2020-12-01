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

Route::get('/', function () {
    return view('inicio');
});

Route::get('articulos', function() {
    return view('articulos');
});

Route::resource('ventas', 'VentaController');

/* AJAX */
Route::get('busqueda/clientes', 'BusquedaController@clientes')
    ->name('busqueda.clientes');

Route::get('busqueda/articulos', 'BusquedaController@articulos')
    ->name('busqueda.articulos');
