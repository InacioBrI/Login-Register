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

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ROTAS AUTENTICADAS
Route::middleware(['auth'])->group(function () {
    
    // LOGOUT
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/'); // ou a página que quiser após logout
    })->name('logout');
    

});
