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

Route::resource('users', TestController::class);

// Route::controller(UserController::class)->group(function(){
    // Route::get('/users','index')->name('users.index')->middleware('auth');

    // // Route::get('/users/create','create_user')->middleware('auth')->name('users.create');

    // Route::post('/users/create','store')->middleware('auth')->name('users.store');

    // Route::get('/users/{id}/edit','edit')->middleware('auth');

    // Route::post('/users/{id}/edit','update')->middleware('auth');

    // Route::get('/users/{id}/delete','destroy')->middleware('auth');

    // Route::get('/users/{id}','show')->middleware('auth')->name('users.show');
// });