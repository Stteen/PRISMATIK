<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Select2Controller;

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

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function(){

    Route::post('/select2',[Select2Controller::class, 'select2'])->name('select2');

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
 
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

    Route::get('/nuevasOrdenes', function () {
        return view('nuevasOrdenes');
    })->name('nuevasOrdenes');
    
    Route::get('/ordenDespachada', function () {
        return view('ordenDespachada');
    })->name('ordenDespachada');

    Route::get('/ordenProceso', function () {
        return view('ordenProceso');
    })->name('ordenProceso');

    Route::get('/tecnicos', function () {
        return view('tecnicos');
    })->name('tecnicos');
    
    Route::get('/zonas', function () {
        return view('zonas');
    })->name('zonas');

    Route::get('/consultaOrdenes', function () {
        return view('consultaOrdenes');
    })->name('consultaOrdenes');
});
