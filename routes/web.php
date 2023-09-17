<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create_user'])->name('users.create');

// Route::view('users/create', 'users.create');

// Route::resource('users', TestController::class);

Route::resource('users', UserController::class);

// Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');

Route::controller(UserController::class)->group(function(){
    Route::get('/users/trashed', 'trashed')->name('users.trashed');
    Route::get('/users/restore/{user}', 'restore')->name('users.restore');
    Route::delete('/users/delete-permanently/{user}', 'deletePermanently')->name('users.delete-permanently');
});