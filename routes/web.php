<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LampController;

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

Route::get('/login',[AuthController::class, 'index'])->name('login');
Route::post('/post-login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware'=>['auth']], function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::post('/',[DashboardController::class,'addDevice']);
    Route::get('/kontrol-lampu', [LampController::class,'index']);
    Route::post('/kontrol-lampu', [LampController::class,'addDevice']);
    Route::resource('users', UserController::class);
    Route::resource('devices', DeviceController::class);

});