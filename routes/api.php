<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\LibraryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rotas protegidas por Sanctum: 
|   - Requerem header: Authorization: Bearer <token>
|   - Token obtido via login
|
*/

// Rotas públicas
Route::post('/register-client', [AuthController::class, 'registerClient']);
Route::post('/register-company', [AuthController::class, 'registerCompany']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas autenticadas
Route::middleware('auth:sanctum')->group(function () {
    // Autenticação
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Perfil do Cliente
    Route::prefix('client')->group(function () {
        Route::get('/profile', [ClientController::class, 'show']);
        Route::put('/profile', [ClientController::class, 'update']);
    });

    // Perfil da Empresa
    Route::prefix('company')->group(function () {
        Route::get('/profile', [CompanyController::class, 'show']);
        Route::put('/profile', [CompanyController::class, 'update']);
    });

    // Gerenciamento de Jogos
    Route::prefix('games')->group(function () {
        Route::get('/', [GameController::class, 'index']);
        Route::post('/', [GameController::class, 'store']);
        Route::get('/{game}', [GameController::class, 'show']);
        Route::put('/{game}', [GameController::class, 'update']);
        Route::delete('/{game}', [GameController::class, 'destroy']);
    });

    // Carrinho
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/', [CartController::class, 'store']);
        Route::delete('/{id}', [CartController::class, 'destroy']);
    });

    // Biblioteca
    Route::prefix('library')->group(function () {
        Route::get('/', [LibraryController::class, 'index']);
        Route::post('/', [LibraryController::class, 'store']);
        Route::delete('/{id}', [LibraryController::class, 'destroy']);
    });

    // Suporte
    Route::prefix('support')->group(function () {
        Route::post('/', [SupportController::class, 'store']);
    });
});

