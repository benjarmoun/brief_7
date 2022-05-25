<?php

use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ResponcesController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/', [TicketsController::class, 'index'])->name('home')->middleware(['user']);
Route::post('/', [TicketsController::class, 'store'])->name('tickets');
Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.details');
Route::put('/tickets/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');

Route::post('/responce', [ResponcesController::class, 'store'])->name('responce');


Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

