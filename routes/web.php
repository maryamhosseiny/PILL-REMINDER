<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\web\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'register']);
Route::get('/dashboard', [UserController::class, 'dashboard']);

Route::get('/', function () {
    return view('welcome');
});
