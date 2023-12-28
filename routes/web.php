<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarController;
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

Route::get('/clients', [ClientController::class, 'index']);

Route::get('/clients/create', [ClientController::class, 'create']);

Route::post('/clients/store', [ClientController::class, 'store']);

Route::get('/clients/edit/{id}', [ClientController::class, 'edit']);

Route::post('/clients/update/{id}', [ClientController::class, 'update']);

Route::delete('/clients/delete/{id}', [ClientController::class, 'destroy']);



Route::get('/cars', function () {
    return view('car.index');
});
Route::get('/cars/update', [CarController::class, 'update']);




Route::get('/', function () {
    return view('welcome');
});
