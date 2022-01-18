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
    return view('welcome');
});

// AUTH Custom
// Route::get('/register', [App\Http\Controllers\Auth\LoginController::class, 'viewRegister'])->name('register.index');
// Route::post('/register', [App\Http\Controllers\Auth\LoginController::class, 'attemptRegister'])->name('register');
// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'viewLogin'])->name('login.index');
// Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'attemptLogin'])->name('login');
// Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
