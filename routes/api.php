<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiclesController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login',[AuthController::class, 'Login']);

Route::post('/register',[AuthController::class, 'Register']);

Route::get('/user',[UserController::class, 'User'])->middleware('auth:api');

Route::get('/vehicles',[VehiclesController::class, 'index'])->middleware('auth:api');

Route::post('/addvehicles', [VehiclesController::class, 'store'])->middleware('auth:api');