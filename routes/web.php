<?php

use App\Http\Controllers\QualityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuantityController;
use App\Http\Controllers\SamplingTimeController;
use App\Models\Quality;
use App\Models\Quantity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('admin/input', [AdminController::class,'input'])->name('admin.input');

Route::prefix('/admin/waktu-sampling')->group(function(){
    Route::get('/',[SamplingTimeController::class, 'index'])->name('admin.waktu-sampling');
    Route::post('/',[SamplingTimeController::class, 'store'])->name('admin.waktu-sampling.post');
    Route::patch('/',[SamplingTimeController::class, 'update'])->name('admin.waktu-sampling.update');
    Route::delete('/',[SamplingTimeController::class, 'destroy'])->name('admin.waktu-sampling.destroy');
});

Route::prefix('/admin/kuantitas')->group(function(){
    Route::get('/',[QuantityController::class, 'home'])->name('admin.kuantitas');
});

Route::resource('admin', AdminController::class);


Route::get('admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::get('admin/delete-sample/{id}', [AdminController::class, 'deleteSampling'])->name('admin.deleteSampling');

Route::delete('admin/delete-sample/{id}', [AdminController::class, 'destroySampling'])->name('admin.destroySampling');


Auth::routes();
