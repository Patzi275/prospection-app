<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProspectionController;
use App\Http\Controllers\AuthController;

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

Route::get('/login', [AuthController::class, 'login_show'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::redirect('/', '/prospections/create');
    Route::resource('prospections', ProspectionController::class);
    Route::get('/prospections-export', [ProspectionController::class, 'export'])->name('prospections.export');
});

// Just to help
Route::get('/create-user/{name}/{password}', [AuthController::class, 'createUser']);