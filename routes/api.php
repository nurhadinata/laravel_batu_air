<?php

use App\Http\Controllers\MonitoringPointController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\QuantityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Models\Quality;
use App\Models\SamplingTime;

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

Route::get('/titik-pantau', [MonitoringPointController::class, 'index']);

Route::get('/detail-kualitas', [QualityController::class, 'index']);

Route::get('/detail-kuantitas', [QuantityController::class, 'detail']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function(Request $request){
    return response()->json("Hello 2", 200);
});

Route::prefix('/titik-pantau')->group(function(){
    Route::get('/',[MonitoringPointController::class, 'index']);
    Route::get('/{id}',[MonitoringPointController::class, 'show']);
    Route::get('/{id}/kualitas',[MonitoringPointController::class, 'quality']);
    Route::get('/{id}/kuantitas',[MonitoringPointController::class, 'quantity']);
    Route::get('/{id}/kualitas-terbaru',[MonitoringPointController::class, 'latestQuality']);
    Route::get('/{id}/kuantitas-terbaru',[MonitoringPointController::class, 'latestQuality']);
    Route::get('/{id}/detail-kualitas',[MonitoringPointController::class, 'detailQuality']);
    Route::get('/{id}/diagram-kualitas',[MonitoringPointController::class, 'diagramQuality']);
    Route::get('/{id}/tambah-kuantitas',[MonitoringPointController::class, 'addQuantity']);
});

Route::prefix('/laporan')->group(function(){
    Route::get('/kualitas', [ReportController::class, 'reportQuality']);
    Route::get('/kuantitas', [ReportController::class, 'reportQuantity']);
});

Route::prefix('/beranda')->group(function(){
    Route::get('/',[DashboardController::class, 'index']);
    Route::get('/upper', [DashboardController::class, 'upper']);
    Route::get('/middle', [DashboardController::class, 'middle']);
    Route::get('/bottom', [DashboardController::class, 'bottom']);
});

