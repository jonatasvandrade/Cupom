<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CupomController;

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CupomController;
use Illuminate\Support\Facades\Route;

Route::get('produtos/{id}', [ProdutoController::class, 'show']);
Route::post('produtos', [ProdutoController::class, 'store']);
Route::get('produtos', [ProdutoController::class, 'index']);


//
Route::get('cupons', [CupomController::class, 'index']);
Route::get('/cupons/{id}', [CupomController::class, 'show']);
Route::post('/cupons/aplicar', [CupomController::class, 'aplicarCupomParaUsuario']);
