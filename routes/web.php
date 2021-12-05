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
Route::get('admin/register', [App\Http\Controllers\AdminController::class, 'register'])->name('admin.register');
Route::get('teams/{teamId}', [App\Http\Controllers\TeamController::class, 'getMembersNotLogin'])->name('members.show');
Route::get('teams/export/{id}', [App\Http\Controllers\TeamController::class, 'exportTeamInfoCsvFile'])->name('teams.export');

Route::post('teams', [App\Http\Controllers\HomeController::class, 'getTeamsBySlug'])->name('teams.search');

Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('teams/', [App\Http\Controllers\AdminController::class, 'getTeams'])->name('admin.teams.show');
    Route::get('users/', [App\Http\Controllers\AdminController::class, 'getUsers'])->name('admin.users.show');

    Route::post('users/search', [App\Http\Controllers\AdminController::class, 'getUsersByEmailOrPhone'])->name('admin.users.search');

    Route::delete('users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

Route::group(['prefix' => 'users','middleware'=>'auth'], function() {
    Route::get('{userId}/teams/', [App\Http\Controllers\UserController::class, 'getTeams'])->name('user.teams.show');
    Route::get('{userId}/teams/{teamId}', [App\Http\Controllers\TeamController::class, 'getMembers'])->name('user.members.show');
    Route::get('{userId}/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::get('{userId}/password', [App\Http\Controllers\UserController::class, 'password'])->name('user.password');

    Route::post('teams', [App\Http\Controllers\TeamController::class, 'add'])->name('user.teams.add');
    Route::post('members', [App\Http\Controllers\MemberController::class, 'add'])->name('user.members.add');

    Route::delete('teams/{id}', [App\Http\Controllers\TeamController::class, 'delete'])->name('user.teams.delete');
    Route::delete('members/{id}', [App\Http\Controllers\MemberController::class, 'delete'])->name('user.members.delete');

    Route::put('teams', [App\Http\Controllers\TeamController::class, 'update'])->name('user.teams.update');
    Route::put('members', [App\Http\Controllers\MemberController::class, 'update'])->name('user.members.update');
    Route::put('profiles', [App\Http\Controllers\UserController::class, 'update'])->name('user.profiles.update');
    Route::put('password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.password.update');
});
