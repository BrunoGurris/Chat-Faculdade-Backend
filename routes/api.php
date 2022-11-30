<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);

/* Rotas para logados */
Route::middleware(['apiJWT'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/messages', [ChatController::class, 'getMessages']);
    Route::post('/messages', [ChatController::class, 'saveMessage']);
});
/* */
