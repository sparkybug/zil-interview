<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route to access the user list page
// Route::get('/users/index', [UserController::class, 'index'])->name('users.index');

// Route to access show user page
// Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// Route to create users
// Route::get('/users/create', [UserController::class, 'create'])->middleware('auth')->name('users.create');

// Route to store the newly created users
// Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::controller(UserController::class)->group(function(){
    Route::get('users','index')->middleware('auth')->name('users.index');
    Route::get('users/create','create')->middleware('auth')->name('users.create');
    Route::post('users/create','store')->middleware('auth')->name('users.store');
    Route::get('users/{id}/edit','edit')->middleware('auth');
    Route::post('users/{id}/edit','update')->middleware('auth');
    Route::get('users/{id}/delete','destroy')->middleware('auth');
    Route::get('users/{id}','show')->middleware('auth')->name('users.show');
});