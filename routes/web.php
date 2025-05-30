<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SimulacaoController;
use Illuminate\Support\Facades\Auth;



Route::redirect('/', '/login');

// ROTAS DE LOGIN E CADASTRO
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); // <--- aqui
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'register'])->name('cadastro.submit');
;

// ROTAS AUTENTICADAS
Route::middleware(['auth'])->group(function () {
    
    // DASHBOARD
    Route::get('/dashboard', [SimulacaoController::class, 'dashboard'])->name('dashboard');
    Route::delete('/simulacoes/{id}', [SimulacaoController::class, 'destroy'])->name('simulacao.destroy');
    Route::get('/simulacao/{id}/editar', [SimulacaoController::class, 'edit'])->name('simulacao.editar');
    Route::put('/simulacao/{id}', [SimulacaoController::class, 'update'])->name('simulacao.update');
    
    // LOGOUT
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/'); // ou a página que quiser após logout
    })->name('logout');
    
    // SIMULADOR
    Route::prefix('simulador')->group(function () {
        Route::get('/bemvindo', [SimulacaoController::class, 'bemvindo'])->name('simulador.bemvindo');

        // CONTRATO
        Route::get('/contrato', [SimulacaoController::class, 'contrato'])->name('simulador.contrato');
        Route::post('/contrato', [SimulacaoController::class, 'salvarContrato'])->name('simulador.contrato.salvar');

        // RENDA
        Route::get('/renda', [SimulacaoController::class, 'renda'])->name('simulador.renda');
        Route::post('/renda', [SimulacaoController::class, 'salvarRenda'])->name('simulador.renda.salvar');

        // GASTOS
        Route::get('/gastos', [SimulacaoController::class, 'gastos'])->name('simulador.gastos');
        Route::post('/gastos', [SimulacaoController::class, 'salvarGastos'])->name('simulador.gastos.salvar');

        // PLANO
        Route::get('/plano', [SimulacaoController::class, 'planoAcao'])->name('simulador.plano');
        Route::post('/plano', [SimulacaoController::class, 'salvarPlanoAcao'])->name('simulador.plano.salvar');

        // ANÁLISE
        Route::get('/analise', [SimulacaoController::class, 'analise'])->name('simulador.analise');
        Route::get('/simulador/analise', [SimulacaoController::class, 'analise'])->name('simulador.analise');


        // FINALIZAR
        Route::get('/finalizar', [SimulacaoController::class, 'finalizar'])->name('simulador.finalizar');
    });
});
