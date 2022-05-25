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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function(){
 

});

Route::get('/proveedores', function () {
    return view('proveedores');
})->name('proveedores');

Route::get('/clientes', function () {
    return view('clientes');
})->name('clientes');

Route::get('/productos', function () {
    return view('productos');
})->name('productos');

Route::get('/ordenServicio', function () {
    return view('ordenServicio');
})->name('ordenServicio');

