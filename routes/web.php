<?php

use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Página inicial pública apresentando TODOS os dados do TCC IAFit
Route::get('/', [ExercicioController::class, 'home'])->name('home');

// Painel de controle (Breeze) apresentando TODOS os dados do TCC + gestão
Route::get('/dashboard', [ExercicioController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rotas do CRUD protegidas por auth + middleware personalizado
Route::middleware(['auth', 'auditoria.crud'])->group(function () {
    Route::resource('exercicios', ExercicioController::class);
});

// Perfil do usuário (Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rota Fallback (obrigatória para rotas inexistentes)
Route::fallback(function () {
    return response()->view('fallback', [], 404);
});