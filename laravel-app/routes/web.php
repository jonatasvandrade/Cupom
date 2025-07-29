<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\ProfileController;

// Rotas protegidas por autenticação e verificação de email
Route::middleware(['auth', 'verified'])->group(function() {

    // Dashboard - mostra produtos e formulário de cupom
    Route::get('/dashboard', [CupomController::class, 'showForm'])->name('dashboard');

    // Aplica cupom
    Route::post('/aplicar-cupom', [CupomController::class, 'applyCoupon'])->name('aplicar-cupom');

    // Remove cupom
    Route::post('/remover-cupom', [CupomController::class, 'removeCoupon'])->name('remover-cupom');

    // Rotas de perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
