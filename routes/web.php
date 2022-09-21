<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ConnectionController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\ItemAccountController;

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

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UsersController::class);
    Route::resource('role', RolesController::class);
    Route::resource('subscriber', SubscriberController::class);
    Route::resource('product', ProductController::class);
    Route::resource('connection', ConnectionController::class);
    Route::resource('item-account', ItemAccountController::class);
    Route::resource('employee', EmployeeController::class);
});
