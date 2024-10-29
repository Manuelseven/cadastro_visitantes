<?php


use App\Http\Controllers\VisitanteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('visitantes.index') : redirect()->route('login');
});





Route::middleware(['auth'])->group(function () {
    Route::get('/visitantes', [VisitanteController::class, 'index'])->name('visitantes.index');
    Route::get('/visitantes/create', [VisitanteController::class, 'create'])->name('visitantes.create');
    Route::post('/visitantes', [VisitanteController::class, 'store'])->name('visitantes.store');
    Route::get('/visitantes/{visitante}/edit', [VisitanteController::class, 'edit'])->name('visitantes.edit');
    Route::post('/visitantes/{visitante}', [VisitanteController::class, 'update'])->name('visitantes.update');
    Route::delete('/visitantes/{visitante}', [VisitanteController::class, 'destroy'])->name('visitantes.destroy');
    Route::get('/visitantes/{visitante}', [VisitanteController::class, 'show'])->name('visitantes.show');
    Route::get('/visitantes/search', [VisitanteController::class, 'search'])->name('visitantes.search');
});

require __DIR__ . '/auth.php';
