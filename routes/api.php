<?php

use App\Http\Controllers\api\InformationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\RequestController;
use App\Http\Controllers\LiveLocationController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\SecurityController;
use App\Models\LiveLocation;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
Route::post('/scanner/gate/{code}', [ScreeningController::class, 'scanner_process'])->name('gate.checkin');

Route::post('/scanner/test-token', function (Request $request) {
    $token = $request->header('Authorization');

    if ($token === 'Bearer rahasia123') {
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Token valid!',
            'data_dari_qr' => $request->input('code')
        ]);
    } else {
        return response()->json([
            'status' => 'gagal',
            'pesan' => 'Token tidak valid.'
        ], 401);
    }
});

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
