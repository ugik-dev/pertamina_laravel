<?php

use App\Http\Controllers\api\InformationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\RequestController;
use App\Http\Controllers\LiveLocationController;
use App\Http\Controllers\SecurityController;
use App\Models\LiveLocation;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/login-live-location', [LoginController::class, 'loginLiveLocation']);
Route::post('/faskes', [InformationController::class, 'faskes']);
Route::get('/content/{slug}', [InformationController::class, 'index']);
Route::get('/content', [InformationController::class, 'index']);
Route::middleware('
')->post('/request', [RequestController::class, 'post']);
Route::middleware('auth:sanctum')->post('/send-live-location', [LiveLocationController::class, 'update_location']);
// Route::get('/checkin/{code}', [SecurityController::class, 'checkin']);
// Route::get('/checkout/{code}', [SecurityController::class, 'checkout']);
Route::middleware('gate.api')->group(function () {
    Route::prefix('gate')->group(function () {
        Route::get('healty', [SecurityController::class, 'healty']);
        Route::get('checkin/{code}', [SecurityController::class, 'checkin_gate']);
        Route::get('checkout/{code}', [SecurityController::class, 'checkout_gate']);
    });
});
