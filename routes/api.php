<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\JwtMiddleware;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::prefix('admin')->middleware([CheckAdminRole::class])->group(function () {
    Route::get('/', [AdminController::class, 'get_Articles']);
    Route::post('/', [AdminController::class, 'create_Article']);
    Route::put('/{id}', [AdminController::class, 'update_Article']);
    Route::delete('/{id}', [AdminController::class, 'delete_Article']);
});


