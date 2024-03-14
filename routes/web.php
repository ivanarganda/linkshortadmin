<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UrlsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/users/{search?}', [UsersController::class, 'index'])->name('users');
Route::get('/users/details/{detail}', [UsersController::class, 'show']);
Route::post('/users/update/{id}', [UsersController::class, 'update']);
Route::get('/users/delete/{id}', [UsersController::class, 'delete']);

Route::get('/urls/{search?}', [UrlsController::class , 'index'])->name('urls');
Route::get('/urls/details/{detail}', [UrlsController::class, 'details']);
Route::post('/urls/update/{id}', [UrlsController::class, 'update']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/stats/{search?}', [ StatsController::class , 'index' ]);

Route::get('/settings/{id?}', [ SettingsController::class , 'index' ]);
Route::get('/settings/delete/{id}', [ SettingsController::class , 'delete' ]);