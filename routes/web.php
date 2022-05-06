<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;

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
    Route::get('/',function(){
        return view('pages.dashboard.index');
    })->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('devices', DeviceController::class);

    Route::get('/kontrol-lampu', function () {
        return view('pages.controls.lampu');
    });
});