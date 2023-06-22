<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\api\UserController;
use \App\Http\Controllers\api\PillController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/user/login', [UserController::class, 'login']);
Route::post('/user/register', [UserController::class, 'register']);

Route::middleware('auth:api')->post('/pill', [PillController::class, 'create']);
Route::middleware('auth:api')->get('/pill', [PillController::class, 'index']);
