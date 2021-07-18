<?php

use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class,'index'])->name('home');
Route::get('/login', [UserController::class,'login'])->name('login');
Route::post('/login', [UserController::class,'authenticate'])->name('login.submit');
Route::get('/signup', [UserController::class,'signup'])->name('signup');
Route::post('/signup', [UserController::class,'register'])->name('signup.submit');
Route::get('/logout', [UserController::class,'logout'])->name('logout');
