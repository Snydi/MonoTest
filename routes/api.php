<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CarBrandController;
use App\Http\Controllers\API\ApiRequestController;
use App\Http\Middleware\LogApiRequests;
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

Route::middleware([ LogApiRequests::class])->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});
Route::middleware(['auth:sanctum', LogApiRequests::class])->group(function ()
{
    Route::get('/clients', [ClientController::class, 'index']);
    Route::post('/clients/store', [ClientController::class, 'store']);
    Route::get('/clients/edit/{id}', [ClientController::class, 'edit']);
    Route::post('/clients/update/{id}', [ClientController::class, 'update']);
    Route::delete('/clients/delete/{id}', [ClientController::class, 'destroy']);

    Route::get('/cars', [CarController::class, 'index']);
    Route::get('/cars/get-by-client', [CarController::class, 'getByClient']);
    Route::post('/cars/store/{client_id}', [CarController::class, 'store']);
    Route::post('/cars/update/{id}', [CarController::class, 'update']);
    Route::delete('/cars/delete/{id}', [CarController::class, 'destroy']);

    Route::get('/car-brands/search/{brand}', [CarBrandController::class, 'searchBrands']);

    Route::get('/requests/search/{route}', [ApiRequestController::class , 'search']);
    Route::get('/requests/sort/{method}', [ApiRequestController::class , 'sort']);
});






