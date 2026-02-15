<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\EntradasController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/usuarios', [UsuariosController::class, 'getUsuarios']);

Route::middleware('auth.api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/menus', [MenuController::class, 'getMenusUsuario']);
    Route::get('/entradas/dados', [EntradasController::class, 'getEntradas']);
    Route::post('/entradas', [EntradasController::class, 'store']);


});

/*Route::get('/usuarios', [UsuariosController::class, 'getUsuarios'])
    ->middleware(['auth.api', 'permissao:USUARIOS']); */