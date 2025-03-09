<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClienteController;
use App\Http\Controllers\API\ProcessoController;
use App\Http\Controllers\API\DocumentoController;
use App\Http\Controllers\API\TarefaController;
use App\Http\Controllers\API\FinanceiroController;
use App\Http\Controllers\API\DashboardController;

// Rotas públicas
Route::post('/login', [AuthController::class, 'login']);

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Rotas de clientes
    Route::apiResource('clientes', ClienteController::class);
    
    // Rotas de processos
    Route::apiResource('processos', ProcessoController::class);
    Route::post('/processos/{id}/notas', [ProcessoController::class, 'adicionarNota']);
    
    // Rotas de documentos
    Route::apiResource('documentos', DocumentoController::class);
    
    // Rotas de tarefas
    Route::apiResource('tarefas', TarefaController::class);
    
    // Rotas financeiras
    Route::apiResource('financeiro', FinanceiroController::class);
    
    // Dashboard
    Route::get('/dashboard/diretor', [DashboardController::class, 'diretor']);
    Route::get('/dashboard/advogado', [DashboardController::class, 'advogado']);
    
    // Sedes
    Route::get('/sedes', function() {
        return response()->json(App\Models\Sede::all());
    });
    
    // Usuários (para seleção em formulários)
    Route::get('/usuarios/advogados', function() {
        return response()->json(App\Models\User::where('nivel', 'ADVOGADO')->get());
    });
    Route::get('/ping', function() {
        return response()->json(['message' => 'pong']);
    });

});


