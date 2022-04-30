<?php

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
    return view('pages.dashboard.index');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/users', function () {
    return view('pages.users.index');
});

Route::get('/devices', function () {
    return view('pages.devices.index');
});

Route::get('/kontrol-lampu', function () {
    return view('pages.controls.lampu');
});
