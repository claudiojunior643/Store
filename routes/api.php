<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VehicleController;

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


Route::get('/ping', function(){
    return ['pong'=>true];
});

Route::get('/vehicle', [VehicleController::class, 'list']);



// User routes
Route::prefix('user')->group(function () {
  Route::post('/', [UserController::class, 'create']);
  Route::put('/edit/{id}', [UserController::class, 'update']);
  Route::get("/delete/{id}", [VehicleController::class, 'deleteuser']);
});

// Auth routes
Route::prefix('auth')->group(function () {
  Route::post('/login', [UserController::class, 'login']);
  Route::post('/logout', [UserController::class, 'logout']);
});

// Order routes
Route::post('/order', [OrderController::class, 'orderBuy']);

Route::post('auth/414', 'AuthController@anauthorized')->name('login');


