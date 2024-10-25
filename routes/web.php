<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

// Rotas para Pedidos (Orders)
Route::get('orders', [OrderController::class, 'index'])->name('orders.index'); // Listar pedidos
Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create'); // Exibir formulário de criação
Route::post('orders', [OrderController::class, 'store'])->name('orders.store'); // Armazenar novo pedido
Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show'); // Exibir detalhes de um pedido específico
Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit'); // Exibir formulário de edição
Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update'); // Atualizar pedido
Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Excluir pedido

// Rota para logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rota para o painel do administrador (apenas para administradores)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Rotas para o gerenciamento de usuários (apenas para administradores)
    Route::get('users', [UserController::class, 'index'])->name('users.index'); // Listar usuários
    Route::get('users/create', [UserController::class, 'create'])->name('users.create'); // Criar novo usuário
    Route::post('users', [UserController::class, 'store'])->name('users.store'); // Armazenar novo usuário
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Editar usuário
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update'); // Atualizar usuário
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Excluir usuário
});

// Rota para o painel do vendedor (apenas autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/vendedor/dashboard', [VendedorController::class, 'index'])->name('vendedor.dashboard');
    
    // Rota para o painel da transportadora
    Route::get('/transportadora/dashboard', [TransportadoraController::class, 'index'])->name('transportadora.dashboard');
});

// Rota para administrador enviar o e-mail de redefinição de senha
Route::post('users/{user}/send-reset-password', [PasswordResetLinkController::class, 'sendAdminResetLink'])
    ->name('users.send-reset-password')
    ->middleware(['auth', 'admin']);

// Rota para a página inicial
Route::get('/', function () {
    return view('welcome');
});

// Rota para o dashboard geral (protegido por autenticação)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Importando as rotas de autenticação padrão do Laravel
require __DIR__ . '/auth.php';
