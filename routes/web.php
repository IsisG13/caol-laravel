<?php

use App\Http\Controllers\CaolController;
use App\Http\Controllers\CaolControllerGrafico;
use App\Http\Controllers\CaolControllerGraficoCliente;
use App\Http\Controllers\CaolControllerRelatorioCliente;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/resultado-do-botao-relatorio', [CaolController::class, 'exibirResultados']);

Route::get('/resultado-do-botao-relatorio-cliente', [CaolControllerRelatorioCliente::class, 'exibirResultados']);

Route::get('/resultado-do-botao-grafico', [CaolControllerGrafico::class, 'exibirResultados']);

Route::get('/resultado-do-botao-grafico-cliente', [CaolControllerGraficoCliente::class, 'exibirResultados']);
