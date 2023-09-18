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

// Route::view('users/trashed', 'users.trashed');

// Route::resource('users', TestController::class);

Route::resource('users', UserController::class)->except([
    'destroy'
]);

// Route::view('users/create', 'users.trashed');

// Route::resource('users', 'UserController')->middleware('auth')->parameters([
//     'users' => 'user' // Use 'user' as the parameter name instead of 'id'
// ])->except([
//     'destroy' // Exclude the 'destroy' method from the resource route
// ]);

// Route to view soft-deleted users
Route::get('users/trashed', 'UserController@trashed')->name('users.trashed');