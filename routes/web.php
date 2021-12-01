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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/team', [App\Http\Controllers\TeamController::class, 'index'])->name('team');

Route::post('/team', [App\Http\Controllers\TeamController::class, 'add'])->name('team');

Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
});
