<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Http\Controllers\Client\ClientAuthenticationController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientOrdersController;

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

Route::get('/',  [ClientAuthenticationController::class, 'loginPage'])->name('login');

Route::get('/login',  [ClientAuthenticationController::class, 'loginPage'])->name('login');

Route::post('/log-in', [ClientAuthenticationController::class, 'logIn']);

Route::get('/create-account',  [ClientAuthenticationController::class, 'createAccountPage'])->name('login');

Route::post('/create', [ClientAuthenticationController::class, 'createAccount']);


Route::get('/log-out',  [ClientAuthenticationController::class, 'logOut']);

Route::get('/dashboard', [ClientController::class, 'dashboard'])->middleware('auth')->name('client-dashboard');

Route::get('/orders', [ClientOrdersController::class, 'index'])->middleware('auth')->name('client-orders');

Route::get('/search-orders', [ClientOrdersController::class, 'search'])->middleware('auth');

Route::get('/cancel-order/{orderId}', [ClientOrdersController::class, 'cancel'])->middleware('auth');

Route::get('/reset-order-status/{orderId}', [ClientOrdersController::class, 'reset'])->middleware('auth');

Route::get('/order/{id}', [ClientOrdersController::class, 'show'])->middleware('auth')->name('client-order');

Route::get('/profile', [ClientController::class, 'profile'])->middleware('auth')->name('client-profile');

Route::post('/save-login-details', [ClientController::class, 'saveLoginDetails'])->middleware('auth');

Route::post('/save-profile', [ClientController::class, 'update'])->middleware('auth');


