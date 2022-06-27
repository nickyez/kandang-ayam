<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceForUserController;
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
    Route::put('/update-lampu', [LampController::class,'update']);
    Route::post('/kontrol-lampu', [LampController::class,'addDevice']);
    Route::resource('users', UserController::class);
    Route::group(['middleware'=>['admin']],function(){
        Route::resource('devices', DeviceController::class);
    });
    Route::group(['middleware'=>['user']],function(){
        Route::resource('device', DeviceForUserController::class);
    });

});